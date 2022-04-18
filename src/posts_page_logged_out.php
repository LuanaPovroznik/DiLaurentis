<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/posts_page_style.css">
    <title>Anúncios</title>
</head>
<body>
<ul>
    <li style="float: right"><a href="login.php">Login</a></li>
</ul>
<?php
    include 'config.php';

    $sql = "SELECT * FROM anuncios";
    $result = mysqli_query($con, $sql);

if($result != null){
    echo "<div class=\"row\">";
    while($row = mysqli_fetch_array($result)){
        if ($row['isActive'] == 1){
            echo "<form action=\"\" method=\"POST\">";
            echo "<div class=\"column\">";
            $postId = $row['id'];
            echo "<input type=\"hidden\" value=\"$postId\" name=\"postId\">";
            echo "<div class=\"card\">";
            echo "<div class=\"upper-line\">";
            echo "</div>";
            echo "<div class=\"container\">";
            echo "<h4><b><span>Serviço ofertado:</span> ".$row['titulo']."</b></h4>";
            echo "<p> <span>Descrição do serviço:</span> ".$row['descricao']."</p>";
            @$categId = $row['categoria'];
            @$getCategoryTitle = mysqli_query($con, "SELECT titulo FROM categoria WHERE id = $categId");
            while(@$resultCategoryTitle = mysqli_fetch_array($getCategoryTitle)){
                @$categoryTitle = @$resultCategoryTitle['titulo'];
            }
            echo "<p> <span>Categoria do serviço:</span> ".$categoryTitle."</p>";
            echo "<p> <span>Preço por hora: R$</span> ".$row['preco']."</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
        }
    }
    echo "</div>";
} else {
    echo "There is no post.";
    header("Refresh:7");
}
?>
</body>
</html>
