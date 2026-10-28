<?php
$pageTitle = 'Carrinho – Thayara Polizel';
require_once __DIR__ . '/config.php';
require_once BASE_PATH . '/includes/cabecalho.php';

if (!estaLogado()) {
    echo "<script>
            alert('Por favor, faça login para acessar o carrinho.');
            window.location.href = 'login.php';
          </script>";
    exit;
}
?>

  <section style="background:linear-gradient(135deg,var(--superficie-2),var(--fundo));padding:40px 0 20px;text-align:center;">
    <h1>Seu Carrinho</h1>
    <p class="subtitulo">Revise seus itens antes de finalizar o pedido</p>
  </section>

  <section class="container py-5">
    <div class="row g-4">

      <!-- LISTA DE ITENS -->
      <div class="col-lg-8">
        <a href="<?= BASE_URL ?>/cardapio/cardapio.php" style="color:var(--texto-suave);font-size:13px;text-decoration:none;">← Voltar ao Cardápio</a>
        <div class="painel-carrinho mt-3" id="lista-carrinho">
          <!-- preenchido pelo JS -->
        </div>
      </div>

      <!-- RESUMO -->
      <div class="col-lg-4">
        <div class="resumo-carrinho" id="resumo" style="display:none;">
          <h2 style="font-size:1.1rem;margin-bottom:16px;">Resumo do Pedido</h2>
          <div class="linha">
            <span>Subtotal</span>
            <span id="subtotal">R$ 0,00</span>
          </div>
          <div class="linha">
            <span>Taxa de embalagem</span>
            <span>R$ 0,00</span>
          </div>

          <?php if (!empty($usuarioAtual['data_nasc']) && date('m-d') === date('m-d', strtotime($usuarioAtual['data_nasc']))): ?>
            <div class="linha text-success">
              <span>🎁 Desconto Aniversário (10%)</span>
              <span id="desconto">-R$ 0,00</span>
            </div>
          <?php endif; ?>

          <div class="linha total">
            <span>Total</span>
            <span id="total">R$ 0,00</span>
          </div>

          <div style="margin-top:20px; background:var(--superficie); border-radius: 8px; padding:14px; font-size:13px;">
            <strong style="color:var(--titulo);">📋 Dados do Pedido</strong>
            <div style="margin-top:10px; display:flex; flex-direction:column; gap:8px;">
              <p class="mb-1"><strong>Cliente:</strong> <?= htmlspecialchars($usuarioAtual['nome'], ENT_QUOTES, 'UTF-8') ?></p>
              <p class="mb-1"><strong>E-mail:</strong> <?= htmlspecialchars($usuarioAtual['email'], ENT_QUOTES, 'UTF-8') ?></p>
              <div>
                <small class="form-text text-muted">Data desejada p/ retirada:</small>                
                <input type="date" id="campo-data" class="campo-pedido" min="<?= date('Y-m-d') ?>">
              </div>
              <textarea id="campo-obs" class="campo-pedido" placeholder="Observações (opcional)"></textarea>
            </div>
          </div>

          <button type="button" class="btn-thay btn-thay-primary w-100 mt-3" onclick="finalizarPedido()"
            style="border:none;font-family:'Lato',sans-serif;width:100%;display:block;text-align:center;">
            💬 Finalizar via WhatsApp
          </button>

          <button type="button" class="btn-thay btn-thay-outline w-100 mt-2" onclick="confirmarLimpar()"
            style="border:1.5px solid var(--borda); font-family:'Lato',sans-serif; width:100%; display:block; text-align:center;font-size:12px;">
            🗑 Limpar carrinho
          </button>
        </div>
      </div>

    </div>
  </section>

<!-- RODAPÉ -->
<?php require_once BASE_PATH. '/includes/rodape.php';?>
  
  <script>
    function fmt(v) { return 'R$ ' + Number(v).toFixed(2).replace('.', ','); }

    const ehAniversariante = <?= (!empty($usuarioAtual['data_nasc']) && date('m-d') === date('m-d', strtotime($usuarioAtual['data_nasc']))) ? 'true' : 'false' ?>;

    function renderizarCarrinho() {
      const itens = carregarCarrinho();
      const lista = document.getElementById('lista-carrinho');
      const resumo = document.getElementById('resumo');

      if (itens.length === 0) {
        lista.innerHTML = `
          <div class="empty-state">
            <div class="icone">🛒</div>
            <h2 style="font-size:1.2rem;">Seu carrinho está vazio</h2>
            <p>Adicione produtos do cardápio para fazer seu pedido.</p>
            <a href="<?= BASE_URL ?>/cardapio/cardapio.php" class="btn-thay btn-thay-primary" style="text-decoration:none;">Ver Cardápio</a>
          </div>`;
        resumo.style.display = 'none';
        return;
      }

      resumo.style.display = 'block';

      lista.innerHTML = itens.map(item => `
        <div class="item-carrinho" id="item-${item.id}">
          <img src="${item.img}" alt="${item.nome}"
            onerror="this.src='https://placehold.co/70x70/f7e0db/6b4032?text=?'">
          <div class="info">
            <div class="nome">${item.nome}</div>
            <div class="preco">${fmt(item.preco)} / unidade</div>
          </div>
          <div class="controle-qtd">
            <button type="button" class="btn-qtd" onclick="mudarQtd(${item.id}, -1)">−</button>
            <span class="qtd-display">${item.qtd}</span>
            <button type="button" class="btn-qtd" onclick="mudarQtd(${item.id}, +1)">+</button>
          </div>
          <div style="min-width:70px;text-align:right;font-weight:700;color:var(--titulo);font-size:14px;">
            ${fmt(item.preco * item.qtd)}
          </div>
          <button type="button" class="btn-remover" onclick="remover(${item.id})" title="Remover">✕</button>
        </div>
      `).join('');

      const subtotal = totalValor();
      let desconto = 0;

      if(ehAniversariante){
        desconto = subtotal * 0.10;
      }
      const totalFinal = subtotal - desconto; 
      document.getElementById('subtotal').textContent = fmt(subtotal);

      const elementoDesconto = document.getElementById('desconto');
      if(elementoDesconto){
            elementoDesconto.textContent = '- ' + fmt(desconto);
      }

      document.getElementById('total').textContent = fmt(totalFinal);
    }

    function mudarQtd(id, delta) {
      const novaQtd = alterarQtd(id, delta);
      renderizarCarrinho();
    }

    function remover(id) {
      removerItem(id);
      renderizarCarrinho();
    }

    function confirmarLimpar() {
      if (confirm('Deseja remover todos os itens do carrinho?')) {
        limparCarrinho();
        renderizarCarrinho();
      }
    }

    function finalizarPedido() {
      const itens = carregarCarrinho();
      if (itens.length === 0) { alert('Seu carrinho está vazio!'); return; }

      const nome  = "<?= htmlspecialchars($usuarioAtual['nome'], ENT_QUOTES, 'UTF-8') ?>";
      const data  = document.getElementById('campo-data').value.trim();
      const obs   = document.getElementById('campo-obs').value.trim();

      const subtotal = totalValor();
      const desconto = ehAniversariante ? (subtotal * 0.10) : 0;
      const totalFinal = subtotal - desconto;
      
      let msg = `*Olá, Thayara!* Quero fazer um pedido 🎉\n\n`;
      msg += `*Nome:* ${nome}\n`;
      if (data) msg += `*Retirada:* ${data}\n`;
      msg += `\n*Itens do Pedido:*\n`;
      itens.forEach(i => {
        msg += `• ${i.nome} x${i.qtd} — ${fmt(i.preco * i.qtd)}\n`;
      });
      msg += `\n*Subtotal:* ${fmt(subtotal)}\n`;
      if (ehAniversariante) {
        msg += `*Desconto Aniversário (10%):* -${fmt(desconto)}\n`;
      }
      msg += `\n*Total Final: ${fmt(totalFinal)}*`;
      if (obs) msg += `\n\n*Obs:* ${obs}`;

      // Número de WhatsApp fictício — substituir pelo real
      const numero = '5511955557777';
      const url = `https://wa.me/${numero}?text=${encodeURIComponent(msg)}`;
      window.open(url, '_blank');
    }

    renderizarCarrinho();
  </script>