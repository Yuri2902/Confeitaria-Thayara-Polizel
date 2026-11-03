<?php

function buscarPedidos(PDO $conexao): array
{
    $sql = "SELECT p.id_pedido, p.data_emissao, p.data_entrega, p.valor_total,
                   u.nome AS cliente_nome, u.email AS cliente_email
            FROM pedidos p
            JOIN usuarios u ON u.id = p.id_usuario
            ORDER BY p.id_pedido DESC";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function buscarItensDoPedido(PDO $conexao, int $idPedido): array
{
    $sql = "SELECT descricao, quantidade, preco_unitario, preco_total
            FROM itens_pedido
            WHERE id_pedido = :id_pedido";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':id_pedido', $idPedido, PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}
