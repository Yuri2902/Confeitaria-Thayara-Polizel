<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/src/loja_crud.php';

exigirAdmin();

$erro    = null;
$salvou  = isset($_GET['ok']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aberta   = isset($_POST['loja_aberta']); //checkbox desmarcado nem vem no post
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($mensagem === '') {
        $mensagem = MENSAGEM_PADRAO;
    }

    try {
        definirStatusLoja($conexao, $aberta, $mensagem);
        header('Location: ' . BASE_URL . '/administradora/loja-status.php?ok=1');
        exit;
    } catch (Throwable $e) {
        $erro = "Não foi possível salvar. Detalhes: <br>" . $e->getMessage();
    }
}

try {
    $lojaAberta = lojaEstaAberta($conexao);
    $mensagem   = mensagemLojaFechada($conexao);
} catch (Throwable $e) {
    $erro       = "Não foi possível ler o status da loja. Detalhes: <br>" . $e->getMessage();
    $lojaAberta = true;
    $mensagem   = MENSAGEM_PADRAO;
}

$pageTitle = 'Status da Loja – Painel Administrativo';
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="mb-4 border rounded-3 p-4" style="border-color: var(--borda) !important;">

    <h3 class="text-center"><i class="bi bi-shop"></i> Status da Loja</h3>
    <p class="text-center" style="color:var(--texto-suave);">
        Com a loja fechada, quem acessar o site vê uma tela de aviso no lugar
        da vitrine. Você continua navegando normalmente enquanto estiver logada.
    </p>

    <div class="text-center mb-4">
        <span class="status-loja <?= $lojaAberta ? 'aberta' : 'fechada' ?>">
            <?= $lojaAberta ? '🟢 Loja aberta — recebendo pedidos' : '🔴 Loja fechada — clientes veem o aviso' ?>
        </span>
    </div>

<?php if ($erro): ?>
    <p class="alert alert-danger"><?= $erro ?></p>
<?php elseif ($salvou): ?>
    <p class="alert alert-success text-center">Status atualizado com sucesso.</p>
<?php endif; ?>

    <form action="" method="post" class="w-75 mx-auto">

        <div class="form-check form-switch fs-5 mb-4">
            <input class="form-check-input" type="checkbox" role="switch"
                   name="loja_aberta" id="loja_aberta" <?= $lojaAberta ? 'checked' : '' ?>>
            <label class="form-check-label" for="loja_aberta">
                Loja aberta para pedidos
            </label>
        </div>

        <div class="form-group mb-3">
            <label for="mensagem" class="form-label">Aviso exibido aos clientes:</label>
            <textarea name="mensagem" id="mensagem" class="form-control" rows="5"
                      placeholder="<?= htmlspecialchars(MENSAGEM_PADRAO, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></textarea>
            <small style="color:var(--texto-suave);">
                Pode usar quebras de linha — elas aparecem na tela de aviso do jeito que você digitar.
                Se deixar em branco, o site usa o texto padrão.
            </small>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-success" type="submit">
                <i class="bi bi-check-circle"></i> Salvar
            </button>

            <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/loja-fechada.php" target="_blank">
                <i class="bi bi-eye"></i> Pré-visualizar o aviso
            </a>

            <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/administradora/cardapio-adm.php">
                <i class="bi bi-arrow-left"></i> Voltar ao cardápio
            </a>
        </div>

    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>
