<!doctype html>
<?php 
    include 'config.php';
?>
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
    <li style="float: left; padding-top: 12px; padding-left: 15px">
    <input type="text" id="myFilter" class="form-control" onkeyup="myFunctionCateg()" placeholder="Procure pela categoria">
    <input type="text" id="myFilterPrec" class="form-control" onkeyup="myFunctionPrec()" placeholder="Procure por preço">
    </li>
</ul>
<?php
    echo "<script>
            function myFunctionCateg() {
              var input, filter, cards, cardContainer, title, i;
              input = document.getElementById(\"myFilter\");
              filter = input.value.toUpperCase();
              cardContainer = document.getElementById(\"myProducts\");
              cards = cardContainer.getElementsByClassName(\"card\");
              for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector(\".cardCategory\");
                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                  cards[i].style.display = \"\";
                } else {
                  cards[i].style.display = \"none\";
                }
              }
            }

            function myFunctionPrec() {
              var input, filter, cards, cardContainer, title, i;
              input = document.getElementById(\"myFilterPrec\");
              filter = input.value.toUpperCase();
              cardContainer = document.getElementById(\"myProducts\");
              cards = cardContainer.getElementsByClassName(\"card\");
              for (i = 0; i < cards.length; i++) {
                title = cards[i].querySelector(\".cardPrice\");
                if (title.innerText.includes(filter)) {
                  cards[i].style.display = \"\";
                } else {
                  cards[i].style.display = \"none\";
                }
              }
            }
        </script>";

    $sql = "SELECT * FROM anuncios";
    $result = mysqli_query($con, $sql);

if($result != null){
    echo "<div class=\"row\" id=\"myProducts\">";
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
            echo "<p class=\"cardCategory\"> <span>Categoria do serviço:</span> ".$categoryTitle."</p>";
            echo "<p class=\"cardPrice\"> <span>Preço por hora: R$</span> ".$row['preco']."</p>";
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
