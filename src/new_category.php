<?php
    include "verification.php";
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/new_category_style.css">
    <title>Nova categoria</title>
</head>

<?php
    include 'config.php';

    if(@$_REQUEST['botao'] == "Add") {
        @$tituloCategoria = $_POST["tituloCategoria"];
        @$descricaoCategoria = $_POST["descricaoCategoria"];

        $sql = "INSERT INTO categoria (titulo, descricao) VALUES ('$tituloCategoria', '$descricaoCategoria')";

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
<ul>
    <li><a href="index.php">Página Inicial</a></li>
    <li style="float: right"><a href="logout.php">Logout</a></li>
</ul>
<h2 style="text-align: center">di<span>laurentis</span></h2>
<div class="container">
    <form action="" method="POST">
        <h3> Cadastrar <span>nova categoria</span> </h3>
        <label for="tituloCategoria">Título:</label><br>
        <input type="text" name="tituloCategoria" id="inputTituloCategoria" maxlength="60" required><br>
        <label for="descricaoCategoria">Descrição:</label><br>
        <textarea name="descricaoAnuncio" id="inputDescricao"></textarea><br><br>
        <input type="submit" name="botao" value="Add" class="button" style="float: right"><br>
    </form>
</div>
</body>
</html>
