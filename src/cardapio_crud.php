<?php

function buscarCardapio(PDO $conexao): array
{
    $sql = "SELECT id, nome, preco, img, cat FROM produtos";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);//sem o fetchAll, não retornaria em array
}

function inserirProduto(PDO $conexao, string $nome, float $preco, string $cat, string $img): void
{
    $sql = "INSERT INTO produtos (nome, preco, cat, img)
            VALUES(:nome, :preco, :cat, :img)";
    
    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(':nome', $nome);
    $consulta->bindValue(':preco', $preco);
    $consulta->bindValue(':cat', $cat);
    $consulta->bindValue(':img', $img);

    $consulta->execute();
}