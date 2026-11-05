<?php
require_once __DIR__ . '/../config.php';

exigirAdmin();

require_once BASE_PATH . '/src/pedidos_crud.php';

$pageTitle = 'Pedidos – Painel Administrativo';
require_once BASE_PATH . '/includes/cabecalho.php';

$erro = null;
$pedidosBanco = [];

try {
  $pedidosBanco = buscarPedidos($conexao);
} catch (Throwable $e) {
  $erro = "Falha ao buscar pedidos. Detalhes: <br>" .$e->getMessage();
}
?>

<section class="mb-4 border rounded-3 p-4" style="border-color: var(--borda) !important;">
    <h3 class="text-center"><i class="bi bi-receipt"></i> Pedidos</h3>

<?php if($erro){ ?>
    <p class="alert alert-danger text-center"><?= $erro ?></p>
<?php } ?>

    <p class="d-flex gap-2 justify-content-center flex-wrap">
        <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/administradora/cardapio-adm.php"><i class="bi bi-arrow-left"></i> Voltar ao cardápio</a>
    </p>

<?php if (!$erro && empty($pedidosBanco)): ?>
    <p class="text-center" style="color:var(--texto-suave);">Nenhum pedido registrado ainda.</p>
<?php endif; ?>

<?php if (!empty($pedidosBanco)): ?>
    <div class="accordion" id="acordeon-pedidos">
    <?php foreach ($pedidosBanco as $pedido): ?>
        <?php
          $itens = buscarItensDoPedido($conexao, $pedido['id_pedido']);
          $subtotal = array_sum(array_column($itens, 'preco_total'));
          $desconto = $subtotal - $pedido['valor_total'];
          $retirada = $pedido['data_entrega'] ? date('d/m/Y', strtotime($pedido['data_entrega'])) : '—';
          $emissao  = date('d/m/Y', strtotime($pedido['data_emissao']));
        ?>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pedido-<?= $pedido['id_pedido'] ?>">
              <span class="d-flex flex-wrap gap-3 w-100 justify-content-between pe-3">
                <span><strong>Pedido #<?= $pedido['id_pedido'] ?></strong> — <?= htmlspecialchars($pedido['cliente_nome'], ENT_QUOTES, 'UTF-8') ?></span>
                <span>Retirada: <?= $retirada ?></span>
                <span>R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></span>
              </span>
            </button>
          </h2>
          <div id="pedido-<?= $pedido['id_pedido'] ?>" class="accordion-collapse collapse" data-bs-parent="#acordeon-pedidos">
            <div class="accordion-body">
              <p class="mb-1"><strong>Cliente:</strong> <?= htmlspecialchars($pedido['cliente_nome'], ENT_QUOTES, 'UTF-8') ?> (<?= htmlspecialchars($pedido['cliente_email'], ENT_QUOTES, 'UTF-8') ?>)</p>
              <p class="mb-3"><strong>Emitido em:</strong> <?= $emissao ?> &nbsp;·&nbsp; <strong>Retirada:</strong> <?= $retirada ?></p>
              <div class="resumo-carrinho">
                <?php foreach ($itens as $item): ?>
                  <div class="linha">
                    <span><?= htmlspecialchars($item['descricao'], ENT_QUOTES, 'UTF-8') ?> <small>x<?= $item['quantidade'] ?></small></span>
                    <span>R$ <?= number_format($item['preco_total'], 2, ',', '.') ?></span>
                  </div>
                <?php endforeach; ?>
                <div class="linha">
                    <span>Subtotal</span>
                    <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                </div>

                <?php if ($pedido['desconto_aniversario']): ?>
                    <div class="linha text-success">
                        <span>🎁 Desconto Aniversário (10%)</span>
                        <span>- R$ <?= number_format($desconto, 2, ',', '.') ?></span>
                    </div>
                <?php endif; ?>
                <div class="linha total">
                  <span>Total</span>
                  <span>R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

</section>

<?php require_once BASE_PATH . "/includes/rodape.php"; ?>
