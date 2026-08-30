<?php
require_once __DIR__ . "/config.php";
require_once BASE_PATH . "/includes/cabecalho.php";
?>

<section class="text-center mb-4 border rounded-3 p-4"
style="border-color: #3d2314 !important;">

    <h1 class="mb-2">Confeitaria Artesanal</h1>
    <h2 class="fs-6 lead">Thayara Polizel</h2>

    <hr>
    <h3>Login</h3>
    <p class="lead">Entre com seu email e senha para acessar o sistema.</p>

    <form action="" method="post" class="w-50 mx-auto text-start mt-3">
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>

        <button type="submit" class="btn text-white" style="background-color: #3d2314;">Entrar</button>
    </form>

</section>

<?php require_once BASE_PATH. "/includes/rodape.php" ?>