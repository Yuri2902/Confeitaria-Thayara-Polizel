<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/src/utils.php";
require_once BASE_PATH . "/src/cardapio_crud.php";
require_once BASE_PATH . "/includes/cabecalho.php";

$id = sanitizar($_GET['id'], 'inteiro');
$erro = null;

if(!$id){
    header("location:cardapio-adm.php");
    exit;
}

try {
    $produto = buscarProdutoPorId($conexao, $id);
    if(!$produto) $erro = "Produto não encontrado";
} catch (Throwable $e) {
    $erro = "Erro ao buscar produto <br>" . $e->getMessage();
}

if (isset($_GET['confirmar-exclusao']) && !$erro) {
    try {
        $caminhoBanco = $produto['img'] ?? '';

        if (!empty($caminhoBanco)) {
            $origem = BASE_PATH . "/" . $caminhoBanco;
            $destino = BASE_PATH . "/fotos/backup/". basename($caminhoBanco);
        
            if (file_exists($origem)) {
                rename($origem, $destino);
            }    
        }

        excluirProduto($conexao, $id);
        header("location:cardapio-adm.php");
        exit; 
    } catch (Throwable $e) {
        $erro = "Erro ao excluir produto: <br>".$e->getMessage();
    }
}

?>

<section class="mb-4 border rounded-3 p-4">
    <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Produto</h3>
    
    <?php if($erro){ ?>
        <p class="alert alert-danger text-center"><?= $erro ?></p>

    <?php } else { ?>

        <div class="alert alert-danger w-50 text-center mx-auto">
            <p>Deseja realmente excluir o Produto <b><?= $produto['nome'] ?? '' ?> - ID: <?= $produto['id'] ?? '' ?></b></p>
            <a class="btn btn-secondary" href="cardapio-adm.php"><i class="bi bi-x-circle"></i> Não</a>
            <a class="btn btn-danger" href="?id=<?= $produto['id'] ?? '' ?>&confirmar-exclusao"><i class="bi bi-check-circle"></i> Sim</a>
        </div>

    <?php } ?>

</section>

<?php require_once BASE_PATH . "/includes/rodape.php"; ?>