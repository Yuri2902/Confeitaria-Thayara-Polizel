<?php
require_once __DIR__ . '/../config.php';
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'Thayara Polizel – Confeitaria Artesanal' ?></title>

  <!-- favicon -->
  <link rel="icon" href="<?= BASE_URL ?>/fotos/favicon.ico" sizes="any">
  <link rel="icon" type="image/png" href="<?= BASE_URL ?>/fotos/favicon.png" sizes="32x32">
  <link rel="apple-touch-icon" href="<?= BASE_URL ?>/fotos/apple-touch-icon.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

  <script>
    //aplica o tema aqui no head pra não piscar branco antes de escurecer
    (function () {
      var tema;
      try { tema = localStorage.getItem('thay_tema'); } catch (e) { tema = null; }

      if (!tema) {
        var sistemaEscuro = window.matchMedia &&
                            window.matchMedia('(prefers-color-scheme: dark)').matches;
        tema = sistemaEscuro ? 'escuro' : 'claro';
      }

      document.documentElement.setAttribute('data-tema', tema);
      document.documentElement.setAttribute('data-bs-theme', tema === 'escuro' ? 'dark' : 'light');
    })();
  </script>
</head>
