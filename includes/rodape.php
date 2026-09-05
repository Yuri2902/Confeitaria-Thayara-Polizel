<?php
require_once __DIR__ . '/../config.php';
?>
<!-- REDES SOCIAIS / RODAPÉ  -->
  <div class="rodape">
    <div class="social-icons">
      <a href="https://instagram.com" target="_blank" title="Instagram">
        <img src="fotos/IconInstagram.png" alt="Instagram" onerror="this.parentElement.textContent='📸'">
      </a>
      <a href="https://wa.me/5511999999999" target="_blank" title="WhatsApp">
        <img src="fotos/IconWhatsapp.png" alt="WhatsApp" onerror="this.parentElement.textContent='💬'">
      </a>
    </div>
    <p style="margin:0; font-size:13px; color:var(--rosa-pastel);">
      &copy; 2026 Thayara Polizel – Confeitaria Artesanal · Zona Sul, São Paulo
    </p>
    <p style="margin-top:6px; font-size:11px; color:var(--rosa-claro); opacity:0.7;">
      Pedidos com antecedência mínima de 72h
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>/js/carrinho.js"></script>
</body>
</html>