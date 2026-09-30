<?php
require_once __DIR__ . "/config.php";

$erro = null;

if (estaLogado()) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = trim($_POST['nome'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $senha     = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar_senha'] ?? '';

    if ($nome === '' || $email === '' || $senha === '' || $confirmar === '') {
        $erro = "Preencha todos os campos.";
    } elseif (mb_strlen($nome) > 100) {
        $erro = "O nome deve ter no máximo 100 caracteres.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
        $erro = "E-mail inválido.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } elseif ($senha !== $confirmar) {
        $erro = "As senhas não conferem.";
    } else {
        try {
            $stmt = $conexao->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $erro = "Este e-mail já está cadastrado.";
            } else {
                $hash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt = $conexao->prepare(
                    "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)"
                );
                $stmt->execute([$nome, $email, $hash]);

                tentarLogin($conexao, $email, $senha);
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            }
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $erro = "Não foi possível concluir o cadastro.";
        }
    }
}

$pageTitle = 'Cadastro – Thayara Polizel';
require_once BASE_PATH . "/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4"
style="border-color: var(--borda) !important;">

    <h1 class="mb-2">Confeitaria Artesanal</h1>
    <h2 class="fs-6 lead">Thayara Polizel</h2>

    <hr>
    <h3>Cadastro</h3>
    <p class="lead">Cadastre seu email e senha para acessar o sistema.</p>

<?php if ($erro): ?>
    <p class="alert alert-danger w-50 mx-auto"><?= $erro ?></p>
<?php endif; ?>

    <form action="" method="post" class="w-50 mx-auto text-start mt-3">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" maxlength="100" required
                   value="<?= htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirmar_senha" class="form-label">Confirmar senha:</label>
            <input type="password" name="confirmar_senha" id="confirmar_senha" class="form-control" required>
        </div>

        <button type="submit" class="btn text-white" style="background-color: var(--marrom-escuro);">Criar</button>
        <button class="btn text-white" style="background-color: var(--marrom-escuro);"><a class="text-decoration-none text-white" href="<?= BASE_URL ?>/login.php">Já tem uma conta? Clique aqui para logar</a></button>
    </form>

</section>

<?php require_once BASE_PATH. "/includes/rodape.php" ?>
