<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Post</title>
</head>

<?php
include 'config.php';

if(@$_REQUEST['botao'] == "Add") {
    @$tituloAnuncio = $_POST["tituloAnuncio"];
    @$descricaoAnuncio = $_POST["descricaoAnuncio"];
    @$categoriaAnuncio = $_POST["categoriaAnuncio"];

    $sql = "INSERT INTO anuncios (isActive, titulo, descricao, categoria) VALUES (0, '$tituloAnuncio', '$descricaoAnuncio', categoriaAnuncio)";

    //TESTAR E IMPLEMENTAR VALUES DA DATA E USUARIO QUE CADASTROU

    if (mysqli_query($con, $sql)) {
        echo "Anúncio adicionado com sucesso.";
        header("Refresh:3");
    } else {
        echo "Erro ao tentar adicionar anúncio.";
        header("Refresh:7");
    }
}
?>

<body>
    <form action="" method="POST">
        <p> Cadastrar novo anúncio </p>
        <label for="tituloAnuncio">Título:</label><br>
        <input type="text" name="tituloAnuncio" id="inputTitulo" maxlength="60"><br>
        <label for="descricaoAnuncio">Descrição:</label><br>
        <input type="text" name="descricaoAnuncio" id="inputDescricao"><br>
        <label for="categoriaAnuncio">Categoria:</label><br>
        <input type="number" name="categoriaAnuncio" id="inputCategoria"><br>
        <input type="submit" name="botao" value="Add"><br>
    </form>
</body>
</html>
