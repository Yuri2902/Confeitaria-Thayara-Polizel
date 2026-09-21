<?php
require_once __DIR__ . '/../config.php';

// Nome do arquivo da página atual, usado para o <title> e para destacar
// o link certo no menu (antes o "Home" ficava marcado como ativo em
// qualquer página, porque a classe "active" estava fixa no HTML).
$paginaAtual = basename($_SERVER['PHP_SELF']);

function classeAtiva(string $arquivo, string $paginaAtual): string {
  return $arquivo === $paginaAtual ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'Thayara Polizel – Confeitaria Artesanal' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

  <header>
    <!-- TOPO -->
    <div class="topo-localizacao">📍 Retirada: Rua Zike Tuma 576– São Paulo, SP</div>

    <!-- Menu Usuarios -->
    <div class="py-2" style="background-color: var(--marrom-escuro); padding-left:24px; padding-right:24px; display:flex; gap:8px; align-items:center;">
      <a href="<?= BASE_URL ?>/login.php" class="btn btn-sm btn-outline-light">
        <i class="bi bi-people"></i> Usuário
      </a>
      <a href="<?= BASE_URL ?>/administradora/cardapio-adm.php" class="btn btn-sm btn-outline-light">
        <i class="bi bi-building-lock"></i> Administradora
      </a>
      <button id="btn-libras" type="button" aria-pressed="false" class="btn btn-sm btn-outline-light">
        Ativar Libras (VLibras)
      </button>
    </div>

    <!-- NAVBAR Bootstrap Navbar -->
    <nav class="navbar-thay">
      <a href="<?= BASE_URL ?>/index.php" class="brand">
        <img src="<?= BASE_URL ?>fotos/LogoBarra.png" alt="Logo Thayara" onerror="this.style.display='none'">
        Thayara Polizel
      </a>
      <button type="button" class="navbar-toggler-thay" onclick="toggleMenu()" aria-label="Menu">☰</button>
      <ul class="nav-links">
        <li><a href="<?= BASE_URL ?>/index.php" class="<?= classeAtiva('index.php', $paginaAtual) ?>">Home</a></li>
        <li><a href="<?= BASE_URL ?>/cardapio/cardapio.php" class="<?= classeAtiva('cardapio.php', $paginaAtual) ?>">Cardápio</a></li>
        <li><a href="<?= BASE_URL ?>/guia.php" class="<?= classeAtiva('guia.php', $paginaAtual) ?>">Guia de Encomendas</a></li>
        <li>
          <a href="<?= BASE_URL ?>/carrinho.php" class="carrinho-link <?= classeAtiva('carrinho.php', $paginaAtual) ?>" title="Carrinho">
            🛒
            <span class="badge-carrinho" style="display:none;">0</span>
          </a>
        </li>
      </ul>
    </nav>
  </header>

  <main class="flex-grow-1">

<script>
const btnLibras = document.getElementById('btn-libras');
let librasCarregado = false;
let librasAtivo = false;

function carregarVLibras() {
  document.body.insertAdjacentHTML('beforeend', `
    <div vw class="enabled" id="vlibras-container">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>
  `);

  const script = document.createElement('script');
  script.src = 'https://vlibras.gov.br/app/vlibras-plugin.js';
  script.onload = () => {
    new window.VLibras.Widget('https://vlibras.gov.br/app');
    setTimeout(() => {
      document.querySelector('[vw-access-button]')?.click();
    }, 800);
  };
  document.body.appendChild(script);
}

btnLibras.addEventListener('click', () => {
  librasAtivo = !librasAtivo;

  if (librasAtivo && !librasCarregado) {
    librasCarregado = true;
    carregarVLibras();
  }

  document.querySelectorAll('[vw]').forEach(el => {
    if (librasAtivo) {
      el.style.removeProperty('display');
    } else {
      el.style.setProperty('display', 'none', 'important');
    }
  });

  btnLibras.setAttribute('aria-pressed', librasAtivo);
  btnLibras.classList.toggle('active', librasAtivo);
  btnLibras.textContent = librasAtivo ? 'Desativar Libras' : 'Ativar Libras (VLibras)';
});
</script>