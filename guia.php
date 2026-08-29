<?php
require_once __DIR__ . '/config.php';
require_once BASE_PATH . '/includes/cabecalho.php';
?>

  <div style="background:linear-gradient(135deg,#f7e0db ,#fff8f6);padding:40px 0 20px;text-align:center;">
    <h1>Guia de Encomendas</h1>
    <p class="subtitulo">Tudo que você precisa saber para montar seu pedido perfeito</p>
  </div>

  <div class="container py-5">

    <!-- TAMANHOS E RENDIMENTO -->
    <h2 class="text-center mb-4">Tamanhos e Rendimento</h2>
    <div class="row g-4 mb-5 justify-content-center">

      <div class="col-6 col-md-3">
        <div class="guia-card text-center">
          <span class="tamanho-badge">15 cm</span>
          <h3 style="font-size:1rem;margin:8px 0 4px;">Bolo Redondo Pequeno</h3>
          <div class="rendimento">10–12</div>
          <p style="font-size:12px;color: #7a5a52 ;margin:0;">pessoas</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="guia-card text-center">
          <span class="tamanho-badge">20 cm</span>
          <h3 style="font-size:1rem;margin:8px 0 4px;">Bolo Redondo Médio</h3>
          <div class="rendimento">20–22</div>
          <p style="font-size:12px;color: #7a5a52;margin:0;">pessoas</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="guia-card text-center">
          <span class="tamanho-badge">25 cm</span>
          <h3 style="font-size:1rem;margin:8px 0 4px;">Bolo Redondo Grande</h3>
          <div class="rendimento">30–35</div>
          <p style="font-size:12px;color: #7a5a52;margin:0;">pessoas</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="guia-card text-center">
          <span class="tamanho-badge">30 cm</span>
          <h3 style="font-size:1rem;margin:8px 0 4px;">Bolo Redondo Extra</h3>
          <div class="rendimento">45–50</div>
          <p style="font-size:12px;color: #7a5a52 ;margin:0;">pessoas</p>
        </div>
      </div>

    </div>

    <!-- RECHEIOS -->
    <h2 class="text-center mb-4">Escolha os Recheios</h2>
    <div class="row g-4 mb-5">

      <!-- Clássicos -->
      <div class="col-md-6">
        <div class="guia-card">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
            <h3 style="font-size:1.1rem;margin:0;">Recheios Clássicos</h3>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:var(--rosa-escuro);">R$ 90,00/kg</span>
              <p style="font-size:11px;color: #7a5a52 ;margin:0;">Escolha até 2 sabores</p>
            </div>
          </div>
          <div>
            <span class="tag-recheio">Brigadeiro</span>
            <span class="tag-recheio">Beijinho</span>
            <span class="tag-recheio">Brigadeiro com Coco</span>
            <span class="tag-recheio">Doce de Leite com Coco</span>
            <span class="tag-recheio">Leite Ninho</span>
            <span class="tag-recheio">Doce de Leite com Abacaxi</span>
            <span class="tag-recheio">Brigadeiro com Morango</span>
            <span class="tag-recheio">Leite Ninho com Morango</span>
            <span class="tag-recheio">Brigadeiro com Abacaxi</span>
            <span class="tag-recheio">Surpresa de Uva</span>
            <span class="tag-recheio">Beijinho com Morango</span>
            <span class="tag-recheio">Sensação</span>
            <span class="tag-recheio">Mousse de Chocolate</span>
            <span class="tag-recheio">Mousse de Limão</span>
            <span class="tag-recheio">Mousse de Maracujá</span>
            <span class="tag-recheio">Mousse de Oreo</span>
            <span class="tag-recheio">Mousse de Ovomaltine Chocolate</span>
            <span class="tag-recheio">Mousse de Ovomaltine Branco</span>
            <span class="tag-recheio">Merengue</span>
            <span class="tag-recheio">Beijinho com Abacaxi</span>
            <span class="tag-recheio">Paçoca</span>
          </div>
        </div>
      </div>

      <!-- Premium -->
      <div class="col-md-6">
        <div class="guia-card">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:8px;">
            <h3 style="font-size:1.1rem;margin:0;">Sabores Exclusivos ⭐</h3>
            <div>
              <span style="font-size:1.3rem;font-weight:700;color:#c96a5a;">R$ 130,00/kg</span>
              <p style="font-size:11px;color:#7a5a52;margin:0;">Ingredientes selecionados</p>
            </div>
          </div>
          <div>
            <span class="tag-recheio premium">Pistache</span>
            <span class="tag-recheio premium">Ouro Branco</span>
            <span class="tag-recheio premium">Leite Ninho com Nutella</span>
            <span class="tag-recheio premium">Leite Ninho com Nozes</span>
            <span class="tag-recheio premium">Ganache</span>
            <span class="tag-recheio premium">Floresta Negra</span>
            <span class="tag-recheio premium">Kit Kat Branco</span>
            <span class="tag-recheio premium">Kit Kat ao Leite</span>
          </div>
        </div>
      </div>

    </div>

    <!-- REGRAS -->
    <div class="guia-card" style="max-width:640px;margin:0 auto 50px;">
      <h2 style="font-size:1.1rem;margin-bottom:14px;">📌 Regras de Seleção</h2>
      <ul style="font-size:14px;color:#7a5a52;padding-left:18px;margin:0;">
        <li style="margin-bottom:8px;">Você pode combinar até <strong>2 sabores</strong> diferentes por bolo.</li>
        <li style="margin-bottom:8px;">O preço final depende do <strong>peso total</strong> e dos recheios escolhidos.</li>
        <li style="margin-bottom:8px;">Recheios premium possuem ingredientes selecionados e sabores exclusivos.</li>
        <li style="margin-bottom:8px;">Pedidos com antecedência mínima de <strong>72 horas</strong>.</li>
        <li>Retirada somente na <strong>Zona Sul de São Paulo</strong>.</li>
      </ul>
    </div>

    <!-- CTA -->
    <div class="text-center">
      <p style="color:#7a5a52;font-size:14px;margin-bottom:16px;">Pronto para montar seu pedido?</p>
      <a href="<?= BASE_URL ?>/cardapio.php" class="btn-thay btn-thay-primary" style="text-decoration:none;margin-right:10px;">Ver Cardápio</a>
      <a href="<?= BASE_URL ?>/carrinho.php" class="btn-thay btn-thay-outline" style="text-decoration:none;">Ver Carrinho 🛒</a>
    </div>

  </div>

<!-- RODAPÉ -->
<?php require_once BASE_PATH. '/includes/rodape.php'?>