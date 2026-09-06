<?php
require_once __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thayara Polizel – Confeitaria Artesanal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>

  <!-- TOPO -->
  <div class="topo-localizacao">📍 Retirada: Rua Zike Tuma 576– São Paulo, SP</div>

  <!-- Menu Usuarios -->
  <div class="py-2" style="background-color: #3d2314;">
        <div class="container">
          <a href="<?= BASE_URL ?>/login.php" class="btn btn-sm btn-outline-light">
                <i class="bi bi-people"></i> Usuário
            </a>
        </div>
    </div>

  <!-- NAVBAR Bootstrap Navbar -->
  <nav class="navbar-thay">
    <a href="<?= BASE_URL ?>/index.php" class="brand">
      <img src="<?= BASE_URL ?>fotos/LogoBarra.png" alt="Logo Thayara" onerror="this.style.display='none'">
      Thayara Polizel
    </a>
    <button class="navbar-toggler-thay" onclick="toggleMenu()" aria-label="Menu">☰</button>
    <ul class="nav-links">
      <li><a href="<?= BASE_URL ?>/index.php" class="active">Home</a></li>
      <li><a href="<?= BASE_URL ?>/cardapio/cardapio.php">Cardápio</a></li>
      <li><a href="<?= BASE_URL ?>/guia.php">Guia de Encomendas</a></li>
      <li>
        <a href="<?= BASE_URL ?>/carrinho.php" class="carrinho-link" title="Carrinho">
          🛒
          <span class="badge-carrinho" style="display:none;">0</span>
        </a>
      </li>
    </ul>
  </nav>