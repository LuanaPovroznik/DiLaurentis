<?php
    require('verification.php');
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/new_post_style.css">
    <title>Novo anúncio</title>
</head>

<?php
include 'config.php';

if(@$_REQUEST['botao'] == "Add") {
    @$tituloAnuncio = $_POST["tituloAnuncio"];
    @$descricaoAnuncio = $_POST["descricaoAnuncio"];
    @$categoriaAnuncio = $_POST["categoria"];
    @$precoAnuncio = $_POST["precoAnuncio"];
    @$userId = $_SESSION['id'];

    @$getCategoryId = mysqli_query($con, "SELECT id FROM categoria WHERE titulo = '".@$categoriaAnuncio."'");
    while(@$resultCategory = mysqli_fetch_array($getCategoryId)){
        @$categoryId = @$resultCategory['id'];
    }

    $sql = "INSERT INTO anuncios (isActive, titulo, descricao, categoria, usuario, preco) VALUES (0, '$tituloAnuncio', '$descricaoAnuncio', $categoryId, $userId, $precoAnuncio)";


    if (mysqli_query($con, $sql)) {
        echo "Anúncio adicionado com sucesso.";
        header("Refresh:3");
    } else {
        echo "Erro ao tentar adicionar anúncio.";
		echo mysqli_error($con);
        header("Refresh:7");
    }
}
?>

<body>
<ul>
    <li><a href="index.php">Página Inicial</a></li>
    <li style="float: right"><a href="logout.php">Logout</a></li>
</ul>
<h2 style="text-align: center">di<span>laurentis</span></h2>
    <div class="container">
        <form action="" method="POST">
            <h3> Cadastrar <span>novo anúncio</span> </h3>
            <label for="tituloAnuncio"><span>Título:</span></label><br>
            <input type="text" name="tituloAnuncio" id="inputTitulo" maxlength="60" required><br><br>
            <label for="descricaoAnuncio"><span>Descrição:</span></label><br>
            <textarea name="descricaoAnuncio" id="inputDescricao" required></textarea><br><br>
            <label for="precoAnuncio"><span>Preço por hora:</span></label><br>
            <input type="number" name="precoAnuncio" id="precoAnuncio" required><br><br>
            <label for="categoriaAnuncio"><span>Categoria:</span></label><br><br>
            <?php
            $sqlGet = "SELECT titulo FROM categoria ORDER BY titulo ASC";
            $resultGet = mysqli_query($con, $sqlGet);
            echo '<select name="categoria" id="categoriaAnuncio">';
            while($row = mysqli_fetch_array($resultGet)){
                echo "<option value='{$row['titulo']}'>" . $row['titulo'] . "</option>";
            }
            echo '</select';
            ?>
            <br>
            <input type="submit" name="botao" value="Add" class="button" style="float: right"><br>
        </form>
    </div>
</body>
</html>
