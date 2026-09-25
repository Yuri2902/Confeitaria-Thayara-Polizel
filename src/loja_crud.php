<?php

const CHAVE_LOJA_ABERTA   = 'loja_aberta';
const CHAVE_LOJA_MENSAGEM = 'loja_mensagem';

const MENSAGEM_PADRAO = "Estamos temporariamente fora do ar para novos pedidos.\n\nObrigada pela paciência — em breve as encomendas voltam a ser aceitas por aqui. 💗";

function buscarConfiguracao(PDO $conexao, string $chave, ?string $padrao = null): ?string
{
    $sql = "SELECT valor FROM configuracoes WHERE chave = :chave LIMIT 1";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':chave', $chave);
    $consulta->execute();

    $linha = $consulta->fetch(PDO::FETCH_ASSOC);

    return $linha === false ? $padrao : $linha['valor'];
}

function salvarConfiguracao(PDO $conexao, string $chave, string $valor): void
{
    //insere ou atualiza no mesmo comando, chave é PRIMARY KEY
    $sql = "INSERT INTO configuracoes (chave, valor)
            VALUES (:chave, :valor)
            ON DUPLICATE KEY UPDATE valor = :valor2";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':chave', $chave);
    $consulta->bindValue(':valor', $valor);
    $consulta->bindValue(':valor2', $valor);
    $consulta->execute();
}

function lojaEstaAberta(PDO $conexao): bool
{
    try {
        return buscarConfiguracao($conexao, CHAVE_LOJA_ABERTA, '1') === '1';
    } catch (Throwable $e) {
        return true; //se der erro no banco, assume loja aberta
    }
}

function mensagemLojaFechada(PDO $conexao): string
{
    try {
        $mensagem = buscarConfiguracao($conexao, CHAVE_LOJA_MENSAGEM, MENSAGEM_PADRAO);
    } catch (Throwable $e) {
        $mensagem = MENSAGEM_PADRAO;
    }

    return trim((string) $mensagem) === '' ? MENSAGEM_PADRAO : $mensagem;
}

function definirStatusLoja(PDO $conexao, bool $aberta, string $mensagem): void
{
    salvarConfiguracao($conexao, CHAVE_LOJA_ABERTA, $aberta ? '1' : '0');
    salvarConfiguracao($conexao, CHAVE_LOJA_MENSAGEM, $mensagem);
}
