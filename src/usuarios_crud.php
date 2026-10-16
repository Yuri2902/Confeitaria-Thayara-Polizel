<?php

function buscarUsuarioPorEmail(PDO $conexao, string $email): ?array
{
    $sql = "SELECT id, nome, email, senha, perfil
            FROM usuarios
            WHERE email = :email
            LIMIT 1";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':email', $email);
    $consulta->execute();

    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    return $usuario === false ? null : $usuario;
}

function inserirUsuario(PDO $conexao, string $nome, string $email, string $senha, string $dataNasc, string $endereco, string $telefone, string $perfil = 'cliente'): void
{
    $sql = "INSERT INTO usuarios (nome, email, senha, data_nasc, endereco, telefone, perfil)
            VALUES (:nome, :email, :senha, :data_nasc, :endereco, :telefone, :perfil)";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':nome', $nome);
    $consulta->bindValue(':email', $email);
    $consulta->bindValue(':senha', password_hash($senha, PASSWORD_DEFAULT)); //guarda o hash, nunca a senha
    $consulta->bindValue(':data_nasc', $dataNasc);
    $consulta->bindValue(':endereco', $endereco);
    $consulta->bindValue(':telefone', $telefone);
    $consulta->bindValue(':perfil', $perfil);

    $consulta->execute();
}
