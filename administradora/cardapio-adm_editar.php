<?php
require_once __DIR__ . "/../config.php";
require_once BASE_PATH . "/src/cardapio_crud.php";
require_once BASE_PATH . "/includes/cabecalho.php";
require_once BASE_PATH . "/src/utils.php";

$id = sanitizar($_GET['id'], 'inteiro');
$erro = null;

if(!$id){
    header("location:cardapio-adm.php");
    exit;
}

try {
    $produto = buscarProdutoPorId($conexao, $id);
    if(!$produto) $erro = "Usuário não encontrado";
} catch (Throwable $e) {
    $erro = "Erro ao buscar usuário <br>" . $e->getMessage();
}

?>

<section class="mb-4 border rounded-3 p-4" style="border-color: #3d2314 !important;">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto</h3>

    <?php if($erro){ ?>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php } ?>
    
    <form action="" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input required value="<?= $produto['nome'] ?? '' ?>" type="text" name="nome" id="nome" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="preco" class="form-label">Preço:</label>
            <input required value="<?= $produto['preco'] ?? '' ?>" type="number" name="preco" id="preco" class="form-control" min="0" step="0.01">
        </div>

        <div class="form-group mb-3">
            <label for="cat" class="form-label">Categoria:</label>
            <select name="cat" id="cat" class="form-select">
                <?php 
                    $categorias = [
                        'brigadeiro' => 'Brigadeiro',
                        'caixa' => 'Caixa',
                        'mini' => 'Mini'
                    ];

                    foreach($categorias as $chave => $valor){
                        $selecionado = (($produto['cat'] ?? '') == $chave) ? 'selected' : '';
                        echo "<option value='$chave' $selecionado>$valor</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="img" class="form-label">Imagem do Produto: <small class="text-muted">(Deixe em branco para manter a atual)</small>:</label>

            <div class="d-flex align-items-center gap-3">
                <img src="<?= BASE_URL ?>/<?= $produto['img'] ?? '' ?>" width="50" />
                <input type="file" name="img" id="img" class="form-control" accept="image/*" required>
                <small class="form-text text-muted">Selecione um arquivo apenas se desejar alterar a imagem atual.</small>
            </div>
        </div>
        
        <button class="btn btn-success my-4" type="submit">
            <i class="bi bi-check-circle"></i> Salvar
        </button>
    </form>

</section>

<?php require_once BASE_PATH . "/includes/rodape.php"; ?>