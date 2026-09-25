<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/verifica_loja.php';

//nome do arquivo atual, usado pro título da aba e pro menu ativo
$paginaAtual = basename($_SERVER['PHP_SELF']);

function classeAtiva(string $arquivo, string $paginaAtual): string {
  return $arquivo === $paginaAtual ? 'active' : '';
}

$usuarioAtual = usuarioLogado();
$lojaAberta = ehAdministrador() ? lojaEstaAberta($conexao) : true; //só consulta pra admin, que é quem vê a tarja
?>

<!DOCTYPE html>
<html lang="pt-BR">
<?php require_once BASE_PATH . '/includes/head.php'; ?>

<body>

  <header>

    <?php if (!$lojaAberta && ehAdministrador()): ?>
      <div class="barra-loja-fechada">
        ⚠️ A loja está FECHADA — os clientes estão vendo o aviso.
        <a href="<?= BASE_URL ?>/administradora/loja-status.php">Reabrir a loja</a>
      </div>
    <?php endif; ?>

    <!-- TOPO -->
    <div class="topo-localizacao">📍 Retirada: Rua Zike Tuma 576– São Paulo, SP</div>

    <!-- Menu Usuarios -->
    <div class="py-2" style="background-color: var(--marrom-escuro);">
          <div class="container d-flex flex-wrap align-items-center gap-2">

            <?php if ($usuarioAtual === null): ?>
              <a href="<?= BASE_URL ?>/login.php" class="btn btn-sm btn-outline-light">
                <i class="bi bi-people"></i> Usuário
              </a>
            <?php else: ?>
              <span class="text-white small">
                <i class="bi bi-person-check"></i>
                Olá, <?= htmlspecialchars($usuarioAtual['nome'], ENT_QUOTES, 'UTF-8') ?>
              </span>

              <?php if (ehAdministrador()): ?>
                <a href="<?= BASE_URL ?>/administradora/cardapio-adm.php" class="btn btn-sm btn-outline-light">
                  <i class="bi bi-gear"></i> Painel
                </a>
              <?php endif; ?>

              <a href="<?= BASE_URL ?>/logout.php" class="btn btn-sm btn-outline-light">
                <i class="bi bi-box-arrow-right"></i> Sair
              </a>
            <?php endif; ?>

            <button type="button" id="btn-tema" class="btn-tema ms-auto" aria-pressed="false">
              <span class="icone-tema" aria-hidden="true">🌙</span>
              <span class="texto-tema">Modo escuro</span>
            </button>

          </div>
      </div>

    <!-- NAVBAR Bootstrap Navbar -->
    <nav class="navbar-thay">
      <a href="<?= BASE_URL ?>/index.php" class="brand">
        <img src="<?= BASE_URL ?>/fotos/LogoBarra.png" alt="Logo Thayara" onerror="this.style.display='none'">
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

  <main>
