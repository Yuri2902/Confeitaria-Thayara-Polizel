<?php
require_once __DIR__ . "/config.php";

$erro = null;

if (estaLogado()) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

if (isset($_GET['erro']) && $_GET['erro'] === 'acesso') {
    $erro = "Faça login como administradora para acessar essa página.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = "Preencha o e-mail e a senha.";
    } else {
        try {
            if (tentarLogin($conexao, $email, $senha)) {
                $destino = ehAdministrador()
                    ? BASE_URL . '/administradora/cardapio-adm.php'
                    : BASE_URL . '/index.php';

                header('Location: ' . $destino);
                exit;
            }

            $erro = "E-mail ou senha inválidos.";

        } catch (Throwable $e) {
            $erro = "Não foi possível verificar o login. Detalhes: <br>" . $e->getMessage();
        }
    }
}

$pageTitle = 'Login – Thayara Polizel';
require_once BASE_PATH . "/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4"
style="border-color: var(--borda) !important;">

    <h1 class="mb-2">Confeitaria Artesanal</h1>
    <h2 class="fs-6 lead">Thayara Polizel</h2>

    <hr>
    <h3>Login</h3>
    <p class="lead">Entre com seu email e senha para acessar o sistema.</p>

<?php if ($erro): ?>
    <p class="alert alert-danger w-50 mx-auto"><?= $erro ?></p>
<?php endif; ?>

    <form action="" method="post" class="w-50 mx-auto text-start mt-3">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" required
                   value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" required>
        </div>

        <button type="submit" class="btn text-white" style="background-color: var(--marrom-escuro);">Entrar</button>
    </form>

</section>

<?php require_once BASE_PATH. "/includes/rodape.php" ?>
