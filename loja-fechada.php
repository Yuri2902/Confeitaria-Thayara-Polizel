<?php
require_once __DIR__ . '/config.php';

$pageTitle = 'Loja temporariamente fechada – Thayara Polizel';
$mensagem  = mensagemLojaFechada($conexao);

http_response_code(503); //loja fechada é temporário, não usa 404
?>
<!DOCTYPE html>
<html lang="pt-BR">
<?php require_once BASE_PATH . '/includes/head.php'; ?>

<body>
  <main class="tela-fechada">
    <div class="cartao">

      <img class="simbolo" src="<?= BASE_URL ?>/fotos/apple-touch-icon.png"
           alt="Símbolo da confeitaria Thayara Polizel"
           onerror="this.style.display='none'">

      <span class="selo">Pausa nas encomendas</span>

      <h1>Voltamos já, já</h1>

      <p class="recado"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></p>

      <div class="contatos">
        <a class="btn-thay btn-thay-primary" style="text-decoration:none;"
           href="https://wa.me/5511999999999" target="_blank" rel="noopener">
          💬 Falar no WhatsApp
        </a>
        <a class="btn-thay btn-thay-outline" style="text-decoration:none;"
           href="https://instagram.com" target="_blank" rel="noopener">
          📸 Instagram
        </a>
      </div>

      <p class="rodape-aviso">
        &copy; <?= date('Y') ?> Thayara Polizel – Confeitaria Artesanal<br>
        Retirada: Rua Zike Tuma 576 – São Paulo, SP<br>
        <a href="<?= BASE_URL ?>/login.php">Área da administradora</a>
      </p>

    </div>
  </main>

  <script src="<?= BASE_URL ?>/js/tema.js"></script>
</body>
</html>
