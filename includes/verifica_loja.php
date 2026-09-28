<?php
require_once __DIR__ . '/../config.php';

$paginasSempreLiberadas = ['login.php', 'logout.php', 'loja-fechada.php'];

$arquivoAtual = basename($_SERVER['PHP_SELF']);
$ehPaginaAdmin = strpos($_SERVER['PHP_SELF'], '/administradora/') !== false;

$precisaVerificar = !in_array($arquivoAtual, $paginasSempreLiberadas, true)
                    && !$ehPaginaAdmin
                    && !ehAdministrador();

if ($precisaVerificar && !lojaEstaAberta($conexao)) {
    require_once BASE_PATH . '/loja-fechada.php';
    exit;
}
