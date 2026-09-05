<?php
require_once __DIR__ . '/config.php';
require_once BASE_PATH . '/includes/cabecalho.php';
?>

  <div style="background:linear-gradient(135deg,var(--rosa-pastel),var(--rosa-fundo));padding:40px 0 20px;text-align:center;">
    <h1>Seu Carrinho</h1>
    <p class="subtitulo">Revise seus itens antes de finalizar o pedido</p>
  </div>

  <div class="container py-5">
    <div class="row g-4">

      <!-- LISTA DE ITENS -->
      <div class="col-lg-8">
        <a href="<?= BASE_URL ?>/cardapio/cardapio.php" style="color:var(--marrom-claro);font-size:13px;text-decoration:none;">← Voltar ao Cardápio</a>
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
          <div class="linha total">
            <span>Total</span>
            <span id="total">R$ 0,00</span>
          </div>

          <div style="margin-top:20px; background:#ffffff; border-radius: 8px; padding:14px; font-size:13px;">
            <strong style="color:#6b4032;">📋 Dados do Pedido</strong>
            <div style="margin-top:10px; display:flex; flex-direction:column; gap:8px;">
              <input type="text" id="campo-nome" placeholder="Seu nome completo"
                style="border:1px solid #e5a095; border-radius: 8px; padding:8px 12px; font-size:13px; width:100%; outline:none; font-family:'Lato',sans-serif;">
              <input type="tel" id="campo-tel" placeholder="WhatsApp (ex: 11 9 9999-9999)"
                style="border:1px solid #e5a095; border-radius:8px; padding:8px 12px; font-size:13px; width:100%; outline:none; font-family:'Lato',sans-serif;">
              <input type="text" id="campo-data" placeholder="Data desejada p/ retirada"
                style="border:1px solid #e5a095; border-radius:8px; padding:8px 12px; font-size:13px; width:100%; outline:none; font-family:'Lato',sans-serif;">
              <textarea id="campo-obs" placeholder="Observações (opcional)"
                style="border:1px solid #e5a095;border-radius:8px; padding:8px 12px; font-size:13px; width:100%; outline:none; font-family:'Lato',sans-serif;resize:vertical;min-height:60px;"></textarea>
            </div>
          </div>

          <button class="btn-thay btn-thay-primary w-100 mt-3" onclick="finalizarPedido()"
            style="border:none;font-family:'Lato',sans-serif;width:100%;display:block;text-align:center;">
            💬 Finalizar via WhatsApp
          </button>

          <button class="btn-thay btn-thay-outline w-100 mt-2" onclick="confirmarLimpar()"
            style="border:1.5px solid #e5a095; font-family:'Lato',sans-serif; width:100%; display:block; text-align:center;font-size:12px;">
            🗑 Limpar carrinho
          </button>
        </div>
      </div>

    </div>
  </div>

<!-- RODAPÉ -->
<?php require_once BASE_PATH. '/includes/rodape.php'?>
  
  <script>
    function fmt(v) { return 'R$ ' + Number(v).toFixed(2).replace('.', ','); }

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
            <button class="btn-qtd" onclick="mudarQtd(${item.id}, -1)">−</button>
            <span class="qtd-display">${item.qtd}</span>
            <button class="btn-qtd" onclick="mudarQtd(${item.id}, +1)">+</button>
          </div>
          <div style="min-width:70px;text-align:right;font-weight:700;color:var(--marrom);font-size:14px;">
            ${fmt(item.preco * item.qtd)}
          </div>
          <button class="btn-remover" onclick="remover(${item.id})" title="Remover">✕</button>
        </div>
      `).join('');

      const total = totalValor();
      document.getElementById('subtotal').textContent = fmt(total);
      document.getElementById('total').textContent = fmt(total);
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

      const nome  = document.getElementById('campo-nome').value.trim();
      const tel   = document.getElementById('campo-tel').value.trim();
      const data  = document.getElementById('campo-data').value.trim();
      const obs   = document.getElementById('campo-obs').value.trim();

      if (!nome || !tel) {
        alert('Por favor, preencha seu nome e WhatsApp para finalizar.');
        return;
      }

      let msg = `*Olá, Thayara!* Quero fazer um pedido 🎉\n\n`;
      msg += `*Nome:* ${nome}\n`;
      if (data) msg += `*Retirada:* ${data}\n`;
      msg += `\n*Itens do Pedido:*\n`;
      itens.forEach(i => {
        msg += `• ${i.nome} x${i.qtd} — ${fmt(i.preco * i.qtd)}\n`;
      });
      msg += `\n*Total: ${fmt(totalValor())}*`;
      if (obs) msg += `\n\n*Obs:* ${obs}`;

      // Número de WhatsApp fictício — substituir pelo real
      const numero = '5511999999999';
      const url = `https://wa.me/${numero}?text=${encodeURIComponent(msg)}`;
      window.open(url, '_blank');
    }

    renderizarCarrinho();
  </script>