<?php 
  require_once __DIR__ . '/config.php';
  require_once BASE_PATH . '/includes/cabecalho.php';
?>

  <!-- HERO BANNER -->
  <div class="banner-thay">
    <h1>Doces feitos com alma</h1>
    <p>Confeitaria artesanal com criações personalizadas para tornar seus momentos ainda mais especiais. Cada peça feita com amor, dedicação e ingredientes selecionados.</p>
    <div class="botoes">
      <a href="<?= BASE_URL ?>/cardapio.php" class="btn-thay btn-thay-primary">Ver Cardápio Completo</a>
      <a href="<?= BASE_URL ?>/guia.php" class="btn-thay btn-thay-outline" style="color:#fff;border-color:rgba(255,255,255,0.7);">Monte Seu Bolo</a>
    </div>
  </div>

  <!-- SOBRE -->
  <div class="container secao">
    <div class="row align-items-center g-5">
      <div class="col-md-6 text-center">
        <img src="fotos/thay foto menor.jpg" alt="Thayara Polizel"
          style="width:220px;height:220px;object-fit:cover;border-radius:50%;box-shadow:0 6px 24px rgba(107,64,50,0.2);border:5px solid var(--rosa-pastel);"
          onerror="this.style.display='none'">
      </div>
      <div class="col-md-6">
        <h2>Sobre a Thayara</h2>
        <p>Olá! Sou a <strong>Thayara Polizel</strong>, e trabalho de forma artesanal e solo em cada criação que sai da minha confeitaria. Aqui não há produção em massa — cada doce, cada bolo, cada detalhe recebe minha atenção pessoal e dedicada.</p>
        <p>Por ser uma <strong>produção individual</strong>, garanto cuidado total em cada etapa: desde a escolha dos ingredientes mais frescos até a montagem personalizada.</p>
        <p>Meu compromisso é fazer com que cada momento especial da sua vida seja ainda mais doce. ✨</p>
        <a href="<?= BASE_URL ?>/guia.php" class="btn-thay btn-thay-outline">Monte seu pedido →</a>
      </div>
    </div>
  </div>

  <!-- NOSSOS PRODUTOS -->
  <div style="background:var(--rosa-pastel); padding: 60px 0;">
    <div class="container">
      <div class="secao-titulo">
        <h2>Nossos Produtos</h2>
        <p class="subtitulo">Clique para explorar o cardápio completo</p>
      </div>
      <div class="row g-4 justify-content-center">
        <div class="col-6 col-md-4">
          <a href="<?= BASE_URL ?>/cardapio.php" class="card-categoria">
            <img src="fotos/MiniBolo1.png" alt="Mini Bolos" onerror="this.src='https://placehold.co/400x300/f7e0db/6b4032?text=Mini+Bolos'">
            <div class="cat-label">Mini Bolos</div>
          </a>
        </div>
        <div class="col-6 col-md-4">
          <a href="<?= BASE_URL ?>/cardapio.php" class="card-categoria">
            <img src="fotos/BoloDecorado1.png" alt="Bolos Decorados" onerror="this.src='https://placehold.co/400x300/f7e0db/6b4032?text=Bolos+Decorados'">
            <div class="cat-label">Bolos Decorados</div>
          </a>
        </div>
        <div class="col-6 col-md-4">
          <a href="<?= BASE_URL ?>/cardapio.php" class="card-categoria">
            <img src="fotos/Kit1.png" alt="Kit Festa" onerror="this.src='https://placehold.co/400x300/f7e0db/6b4032?text=Kit+Festa'">
            <div class="cat-label">Kit Festa</div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- DEPOIMENTOS -->
  <div class="container secao">
    <div class="secao-titulo">
      <h2>O Que Dizem Nossos Clientes</h2>
      <p class="subtitulo">Feedbacks reais de quem já pediu</p>
    </div>
    <div class="row g-3 justify-content-center">
      <div class="col-6 col-md-3">
        <img src="fotos/feedback2.png" alt="Depoimento" class="feedback-img w-100"
          onerror="this.style.display='none'">
      </div>
      <div class="col-6 col-md-3">
        <img src="fotos/feedback4.png" alt="Depoimento" class="feedback-img w-100"
          onerror="this.style.display='none'">
      </div>
      <div class="col-6 col-md-3">
        <img src="fotos/feedback3.png" alt="Depoimento" class="feedback-img w-100"
          onerror="this.style.display='none'">
      </div>
      <div class="col-6 col-md-3">
        <img src="fotos/feedback1.png" alt="Depoimento" class="feedback-img w-100"
          onerror="this.style.display='none'">
      </div>
    </div>
  </div>

<!-- RODAPÉ -->
<?php require_once BASE_PATH. '/includes/rodape.php'?>