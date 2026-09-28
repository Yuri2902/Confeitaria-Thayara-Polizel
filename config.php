<?php
define('BASE_PATH', __DIR__);
define('BASE_URL', '/Confeitaria-Thayara-Polizel');

//Conexão com o banco em todas as paginas
require_once BASE_PATH . '/src/banco.php';

//Login/sessão e status da loja (aberta ou fechada)
require_once BASE_PATH . '/src/auth.php';
require_once BASE_PATH . '/src/loja_crud.php';

iniciarSessao();
