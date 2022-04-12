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

    // TESTAR - INSERIR TITULO NAS CATEGORIAS (?)
    if(@$_REQUEST['botao'] == "Add") {
        @$tituloCategoria = $_POST["tituloCategoria"];
        @$descricaoCategoria = $_POST["descricaoCategoria"];

        $sql = "INSERT INTO categoria (titulo, descricao) VALUES ('$tituloCategoria', '$descricaoCategoria')";

        //TESTAR E IMPLEMENTAR VALUES DA DATA E USUARIO QUE CADASTROU

        if (mysqli_query($con, $sql)) {
            echo "Categoria adicionada com sucesso.";
            header("Refresh:3");
        } else {
            echo "Erro ao tentar adicionar nova categoria.";
            header("Refresh:7");
        }
}
?>

<body>
<form action="" method="POST">
    <p> Cadastrar nova categoria </p>
    <label for="tituloCategoria">Título:</label><br>
    <input type="text" name="tituloCategoria" id="inputTituloCategoria" maxlength="60"><br>
    <label for="descricaoCategoria">Descrição:</label><br>
    <input type="text" name="descricaoCategoria" id="inputDescricaoCategoria"><br>
    <input type="submit" name="botao" value="Add"><br>
</form>
</body>
</html>
