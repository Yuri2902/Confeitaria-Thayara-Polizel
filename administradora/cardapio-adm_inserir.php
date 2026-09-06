<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/cardapio_crud.php';

$erro = null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome = $_POST['nome'];
    $preco = (float) $_POST['preco'];
    $cat = $_POST['cat'];
    $img = $_FILES['img'];

    if(empty($nome) || empty($preco) || empty($cat) || empty($img['name'])){
        $erro = "Preencha todos os campos!";
    }else{
        try {
            $nomeImagem = uniqid() . '_' . $img['name'];
            $enderecoImagem= BASE_PATH . '/fotos/img/' . $nomeImagem;
            
            //guardando a imagem na pasta
            move_uploaded_file($img['tmp_name'], $enderecoImagem);

            $caminhoBanco = 'fotos/img/' . $nomeImagem;
            
            inserirProduto($conexao, $nome, $preco, $cat, $caminhoBanco);
            //redireciona de volta a tela anterior
            header("location:cardapio-adm.php");
            exit;
        } catch (Throwable $e) {
            if ($e->getCode() === '23000') {//verifica se repetiu a chave primaria
                $erro = "Produto já cadastrado.";
            }else{
                $erro = "Erro ao inserir produto. <br>" .$e->getMessage();
            }
        }
    }
}

?>

<section class="mb-4 border rounded-3 p-4" style="border-color: #3d2314 !important;">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto</h3>

    <form action="" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input required value="<?= $_POST['nome'] ?? '' ?>" type="text" name="nome" id="nome" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="preco" class="form-label">Preço:</label>
            <input type="number" name="preco" id="preco" class="form-control" min="0" step="0.01">
        </div>

        <div class="form-group mb-3">
            <label for="cat" class="form-label">Categoria:</label>
            <select name="cat" id="cat" class="form-select">
                <option value=""></option>
                <option value="brigadeiro">Brigadeiro</option>
                <option value="caixa">Caixa</option>
                <option value="mini">Mini</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="img" class="form-label">Imagem do Produto:</label>
            <input type="file" name="img" id="img" class="form-control" accept="image/*" required>
        </div>
        
        <button class="btn btn-success my-4" type="submit">
            <i class="bi bi-check-circle"></i> Salvar
        </button>
    </form>

</section>

<?php require_once BASE_PATH . "/includes/rodape.php"; ?>