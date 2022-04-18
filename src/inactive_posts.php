<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/posts_page_style.css">
    <title>Anúncios inativados</title>
</head>
<body>
<ul>
    <li><a href="index.php">Página Inicial</a></li>
    <li style="float: right"><a href="logout.php">Logout</a></li>
</ul>

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
        if ($row['isActive'] == 0){
            echo "<form action='' method=\"POST\">";
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

            // BOTÕES DEVEM ESTAR DISPONÍVEIS APENAS PARA ADMINS
            @$getUserAdmin = mysqli_query($con, "SELECT * FROM user WHERE id = $userId");
            while(@$resultUserAdmin = mysqli_fetch_array($getUserAdmin)){
                @$userIsAdmin = @$resultUserAdmin['isAdm'];
            }
            if($userIsAdmin == 1){
                echo "<button type=\"submit\" name=\"botao\" value=\"deletar anúncio\" class=\"button\">deletar anúncio</button>";
                echo "<button type=\"submit\" name=\"botao\" value=\"ativar anúncio\" class=\"button\">ativar anúncio</button>";
            }

            // BOTÃO DISPONÍVEL APENAS PARA O USUÁRIO QUE CRIOU O ANÚNCIO
            if($userId == $row['usuario']){
                echo "<a><button type=\"submit\" name=\"botao\" value=\"gerenciar anúncio\" class=\"button\">gerenciar anúncio</button></a>";
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

if(@$_REQUEST['botao'] == "deletar anúncio"){
    @$postToDelete = $_POST["postId"];
    $deletePost = "DELETE FROM anuncios WHERE id = $postToDelete";

    if(mysqli_query($con, $deletePost)){
        echo "Anúncio deletado com sucesso.";
        header("Refresh: 3");
    } else {
        echo "Erro ao deletar anúncio.";
        header("Refresh: 3");
    }
}

if(@$_REQUEST['botao'] == "ativar anúncio"){
    @$postToActivate = $_POST["postId"];
    $activePost = "UPDATE anuncios SET isActive = 1 WHERE id = $postToActivate";

    if(mysqli_query($con, $activePost)){
        echo "Anúncio ativado com sucesso.";
        header("Refresh: 3");
    } else {
        echo "Erro ao ativar anúncio.";
        header("Refresh: 3");
    }
}
?>
</body>
</html>
