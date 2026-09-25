<?php
require_once __DIR__ . '/usuarios_crud.php';

function iniciarSessao(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function tentarLogin(PDO $conexao, string $email, string $senha): bool
{
    $usuario = buscarUsuarioPorEmail($conexao, $email);

    if ($usuario === null) {
        return false;
    }

    if (!password_verify($senha, $usuario['senha'])) {
        return false;
    }

    iniciarSessao();
    session_regenerate_id(true); //evita session fixation

    $_SESSION['usuario'] = [
        'id'     => (int) $usuario['id'],
        'nome'   => $usuario['nome'],
        'email'  => $usuario['email'],
        'perfil' => $usuario['perfil'],
    ];

    return true;
}

function fazerLogout(): void
{
    iniciarSessao();
    $_SESSION = [];
    session_destroy();
}

function usuarioLogado(): ?array
{
    iniciarSessao();
    return $_SESSION['usuario'] ?? null;
}

function estaLogado(): bool
{
    return usuarioLogado() !== null;
}

function ehAdministrador(): bool
{
    $usuario = usuarioLogado();
    return $usuario !== null && $usuario['perfil'] === 'admin';
}

function exigirAdmin(): void
{
    if (ehAdministrador()) {
        return;
    }

    header('Location: ' . BASE_URL . '/login.php?erro=acesso');
    exit;
}
