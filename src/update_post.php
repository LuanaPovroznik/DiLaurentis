<html>
    <head>
        <link rel="stylesheet" href="../css/posts_page_style.css">
    </head>
<?php
    include 'config.php';
    include 'verification.php';
    @$userLogin = $_SESSION['login'];
    @$userId = $_SESSION['id'];

    $sql = "SELECT * FROM anuncios";
    $result = mysqli_query($con, $sql);

   
        if($result != null){
            echo "<div class=\"row\">";
            while($row = mysqli_fetch_array($result)){
                if ($row['isActive'] == 1){
                    echo "<form action=\"\" method=\"POST\">";
                    echo "<div class=\"column\">";
                    
                    echo "<div class=\"card\">";
                    echo "<div class=\"upper-line\">";
                    echo "</div>";
                    echo "<div class=\"container\">";
                    $postId = $row['id'];
                    echo "<span name=\"postId\">$postId</span>";
                    $titulo =$row['titulo'];
                    echo "<h4><b> Titulo: <input type=\"text\" name=\"tituloAnuncio\" id=\"inputTitulo\" maxlength=\"60\" placeholder=\"$titulo\"></b></h4>";
                    $descricao =$row['descricao'];
                    echo "<p> <span>Descrição do serviço:</span> <input type=\"text\" name=\"descricao\" id=\"descricao\" maxlength=\"60\" placeholder=\"$descricao\"></p>";
                    @$categId = $row['categoria'];
                    @$getCategoryTitle = mysqli_query($con, "SELECT titulo FROM categoria WHERE id = $categId");
                    while(@$resultCategoryTitle = mysqli_fetch_array($getCategoryTitle)){
                        @$categoryTitle = @$resultCategoryTitle['titulo'];
                    }
                    echo "<p> <span>Categoria do serviço:</span> ".$categoryTitle."</p>";
                    $preco =$row['preco'];
                    echo "<p> <span>Preço por hora: R$</span> <input type=\"number\" name=\"precoAnuncio\" id=\"precoAnuncio\" placeholder=\"$preco\"></p>";
                    if($userId == $row['usuario']){
                        echo "<input type=\"submit\" name=\"botao\" id=\"update\" value=\"Update\" class=\"button\"><br> ";
                    }
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

if(@$_REQUEST['botao'] == "Update"){
    $insere = "UPDATE anuncios SET 
        isActive = 1
        , titulo = '{$_POST['tituloAnuncio']}'
        , descricao = '{$_POST['descricao']}'
        , usuario = '{$_SESSION['id']}'
        , preco = '{$preco}'
        WHERE id = $postId";
        $result_update = mysqli_query($con, $insere);
        if ($result_update) echo "<h2> Anuncio $postId atualizado com sucesso!!!</h2>";
        else echo "<h2> Nao consegui atualizar!!!</h2>";    
    exit; 
}
?>
</html>
