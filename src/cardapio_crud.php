<?php

function buscarCardapio(PDO $conexao): array
{
    $sql = "SELECT id, nome, preco, img, cat FROM produtos";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);//sem o fetchAll, não retornaria em array
}