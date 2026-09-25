<?php
require_once __DIR__ . '/../config.php';
?>
  </main>

  <!-- REDES SOCIAIS / RODAPÉ  -->
  <footer class="rodape">
    <div class="social-icons">
      <a href="https://instagram.com" target="_blank" rel="noopener" title="Instagram">
        <img src="<?= BASE_URL ?>/fotos/IconInstagram.png" alt="Instagram" onerror="this.parentElement.textContent='📸'">
      </a>
      <a href="https://wa.me/5511999999999" target="_blank" rel="noopener" title="WhatsApp">
        <img src="<?= BASE_URL ?>/fotos/IconWhatsapp.png" alt="WhatsApp" onerror="this.parentElement.textContent='💬'">
      </a>
    </div>
    <p style="margin:0; font-size:13px; color:var(--rosa-pastel);">
      &copy; <?= date('Y') ?> Thayara Polizel – Confeitaria Artesanal · Zona Sul, São Paulo
    </p>
    <p style="margin-top:6px; font-size:11px; color:var(--rosa-pastel); opacity:0.85;">
      Pedidos com antecedência mínima de 72h
    </p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>/js/carrinho.js"></script>
  <script src="<?= BASE_URL ?>/js/tema.js"></script>
</body>
</html>
