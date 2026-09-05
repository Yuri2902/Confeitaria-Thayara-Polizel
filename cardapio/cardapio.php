<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/cardapio_crud.php';

$erro = null;
$produtosBanco = [];

//tentativa de conexão com o banco
try {
  $produtosBanco = buscarCardapio($conexao);
} catch (Throwable $e) {
  $erro = "Falha ao buscar Cardapio. Detalhes: <br>" .$e->getMessage();
}
?>

  <!-- Cabeçalho da página -->
  <div style="background:linear-gradient(135deg,#f7e0db,#fff8f6); padding:40px 0 20px; text-align:center;">
    <h1>Nosso Cardápio</h1>
    <p class="subtitulo">Explore nossa vitrine de produtos artesanais de alta qualidade</p>
  </div>

  <?php if($erro){ ?>
    <p class="alert alert-danger text-center"><?= $erro ?></p>
  <?php } ?>

  <!-- Filtro de categorias -->
  <div class="container my-4 text-center">
    <div class="d-flex gap-2 justify-content-center flex-wrap" id="filtros">
      <button class="btn-thay btn-thay-primary ativo-filtro" data-cat="todos">Todos</button>
      <button class="btn-thay btn-thay-outline" data-cat="brigadeiro">Brigadeiros</button>
      <button class="btn-thay btn-thay-outline" data-cat="mini">Mini Doces</button>
      <button class="btn-thay btn-thay-outline" data-cat="caixa">Caixas</button>
    </div>
  </div>

  <!-- GRID DE PRODUTOS -->
  <div class="container pb-5">
    <div class="row g-4" id="grid-produtos">

      <!-- Os cards são gerados pelo JS abaixo para evitar repetição -->

    </div>
  </div>
  
  <script>
    // ── CATÁLOGO DE PRODUTOS ──────────────────────────────────────
    const produtos = <?= json_encode($produtosBanco) ?>;
    console.log("Produtos vindos do banco:", produtos);

    // ── RENDERIZAR CARDS ──────────────────────────────────────────
    function renderizarCards(filtro = 'todos') {
      const grid = document.getElementById('grid-produtos');
      const lista = filtro === 'todos' ? produtos : produtos.filter(p => p.cat === filtro);

      grid.innerHTML = lista.map(p => `
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card-produto">
            <div class="card-img-wrap">
              <img src="<?= BASE_URL ?>/${p.img}" alt="${p.nome}" loading="lazy"
                onerror="this.src='https://placehold.co/300x300/f7e0db/6b4032?text=${encodeURIComponent(p.nome)}'">
            </div>
            <div class="card-body">
              <div class="card-title">${p.nome}</div>
              <div class="card-preco">R$ ${Number(p.preco).toFixed(2).replace('.', ',')}</div>
              <div class="controle-qtd">
                <button class="btn-qtd" onclick="decrementar(${p.id})">−</button>
                <span class="qtd-display" id="qtd-${p.id}">1</span>
                <button class="btn-qtd" onclick="incrementar(${p.id})">+</button>
              </div>
              <button class="btn-add" id="btn-${p.id}" onclick="adicionarAoCarrinho(${p.id})">
                🛒 Adicionar
              </button>
            </div>
          </div>
        </div>
      `).join('');
    }

    // ── CONTROLE DE QUANTIDADE LOCAL (antes de adicionar) ────────
    const qtdsLocais = {};

    function incrementar(id) {
      qtdsLocais[id] = (qtdsLocais[id] || 1) + 1;
      document.getElementById('qtd-' + id).textContent = qtdsLocais[id];
    }

    function decrementar(id) {
      qtdsLocais[id] = Math.max(1, (qtdsLocais[id] || 1) - 1);
      document.getElementById('qtd-' + id).textContent = qtdsLocais[id];
    }

    function adicionarAoCarrinho(id) {
      const p = produtos.find(x => x.id === id);
      const qtd = qtdsLocais[id] || 1;
      adicionarItem({ ...p, qtd });

      // Feedback visual no botão
      const btn = document.getElementById('btn-' + id);
      const original = btn.textContent;
      btn.textContent = '✔ Adicionado!';
      btn.classList.add('adicionado');
      setTimeout(() => {
        btn.textContent = original;
        btn.classList.remove('adicionado');
        qtdsLocais[id] = 1;
        document.getElementById('qtd-' + id).textContent = 1;
      }, 1800);
    }

    // ── FILTROS ───────────────────────────────────────────────────
    document.getElementById('filtros').addEventListener('click', e => {
      const btn = e.target.closest('[data-cat]');
      if (!btn) return;
      document.querySelectorAll('#filtros [data-cat]').forEach(b => {
        b.classList.remove('btn-thay-primary', 'ativo-filtro');
        b.classList.add('btn-thay-outline');
      });
      btn.classList.add('btn-thay-primary', 'ativo-filtro');
      btn.classList.remove('btn-thay-outline');
      renderizarCards(btn.dataset.cat);
    });

    renderizarCards();
  </script>

<!-- RODAPÉ -->
<?php require_once BASE_PATH. '/includes/rodape.php'?>