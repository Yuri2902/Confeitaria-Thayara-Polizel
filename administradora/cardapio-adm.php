<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/cardapio_crud.php';

$erro = null;
$produtosBanco = [];

//tentativa de conexão com o banco
try {
  $produtosBanco = buscarCardapio($conexao);
} catch (Throwable $e) {
  $erro = "Falha ao buscar Cardapio. Detalhes: <br>" .$e->getMessage();
}
?>

<section class="text-center mb-4 border rounded-3 p-4" style="border-color: #3d2314 !important;">
    <h3><i class="bi bi-cup-straw"></i> Cardapio</h3>

<?php if($erro){ ?>
    <p class="alert alert-danger text-center"><?= $erro ?></p>
<?php } ?>

    <P>
        <a class="btn text-white" style="background-color: #3d2314;" href="<?= BASE_URL ?>/administradora/cardapio-adm_inserir.php"><i class="bi bi-plus-circle"></i> Adicionar novo produto</a>
    </P>

    <div class="table-responsive">
        <table class="table table-hover caption-top">
            <caption>Quantidade de registros: <?= count($produtosBanco) ?> </caption>
            <thead class="align-middle table-light">
                <tr>
                    <th>Imagem</th>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>

<?php  foreach($produtosBanco as $produtos): ?>
                <tr>
                    <td><img src="<?= BASE_URL ?>/<?= $produtos['img'] ?>" width="50" /></td>
                    <td><?= $produtos['id'] ?></td>
                    <td><?= $produtos['nome'] ?></td>
                    <td><?= $produtos['preco'] ?></td>
                    <td><?= $produtos['cat'] ?></td>
                    <td><a href="" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a></td>
                    <td><a href="" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Excluir</a></td>
                </tr>
<?php  endforeach; ?>

            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . "/includes/rodape.php"; ?>