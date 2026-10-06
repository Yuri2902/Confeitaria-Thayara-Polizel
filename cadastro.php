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
    $dataNasc  = trim($_POST['data_nasc'] ?? '');
    $endereco  = trim($_POST['endereco'] ?? '');
    $telefone  = trim($_POST['telefone'] ?? '');
    $senha     = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar_senha'] ?? '';

    $telefoneDigitos = preg_replace('/\D/', '', $telefone);
    $dataObj = DateTime::createFromFormat('Y-m-d', $dataNasc);
    $dataValida = $dataObj && $dataObj->format('Y-m-d') === $dataNasc;

    if ($nome === '' || $email === '' || $dataNasc === '' || $endereco === '' || $telefone === '' || $senha === '' || $confirmar === '') {
        $erro = "Preencha todos os campos.";
    } elseif (mb_strlen($nome) > 100) {
        $erro = "O nome deve ter no máximo 100 caracteres.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
        $erro = "E-mail inválido.";
    } elseif (!$dataValida || $dataObj > new DateTime('today')) {
        $erro = "Data de nascimento inválida.";
    } elseif (mb_strlen($endereco) > 255) {
        $erro = "O endereço deve ter no máximo 255 caracteres.";
    } elseif (strlen($telefoneDigitos) < 10 || strlen($telefoneDigitos) > 11) {
        $erro = "Telefone inválido. Informe o DDD e o número.";
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
                    "INSERT INTO usuarios (nome, email, senha, data_nasc, endereco, telefone) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $stmt->execute([$nome, $email, $hash, $dataNasc, $endereco, $telefoneDigitos]);

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
    <p class="lead">Preencha seus dados para acessar o sistema.</p>

<?php if ($erro): ?>
    <p class="alert alert-danger w-50 mx-auto"><?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

    <form action="" method="post" class="w-50 mx-auto text-start mt-3">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" maxlength="100" required
                   value="<?= htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" maxlength="150" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="data_nasc" class="form-label">Data de nascimento:</label>
            <input type="date" name="data_nasc" id="data_nasc" class="form-control" max="<?= date('Y-m-d') ?>" required
                   value="<?= htmlspecialchars($_POST['data_nasc'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço:</label>
            <input type="text" name="endereco" id="endereco" class="form-control" maxlength="255" required
                   value="<?= htmlspecialchars($_POST['endereco'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="tel" name="telefone" id="telefone" class="form-control" maxlength="20" placeholder="(11) 98765-4321" required
                   value="<?= htmlspecialchars($_POST['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
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
        <a class="btn text-white" style="background-color: var(--marrom-escuro);" href="<?= BASE_URL ?>/login.php">Já tem uma conta? Clique aqui para logar</a>
    </form>

</section>

<?php require_once BASE_PATH. "/includes/rodape.php" ?>