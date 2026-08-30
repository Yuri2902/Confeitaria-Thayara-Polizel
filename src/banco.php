<?php

//credenciais
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "confeitaria_artesanal";

try {
    $conexao = new PDO(
    "mysql:host=$servidor; dbname=$banco; charset=utf8", $usuario, $senha
    );

    //habilitando o lançamento de erros e exceções
    $conexao -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Conexão realizada com sucesso";

} catch (Throwable $erro) {
    die("Falha na Conexão: ". $erro->getMessage());
}