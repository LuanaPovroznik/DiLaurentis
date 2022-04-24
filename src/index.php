<?php require('verification.php');?>

<html>
<head>
    <title>Página Inicial</title>
</head>
<link rel="stylesheet" href="../css/index_style.css">
    <body>
    <ul>
        <li><a href="index.php">Página Inicial</a></li>
        <li style="float: right"><a href="logout.php">Logout</a></li>
    </ul>
    <h2 style="text-align: center">di<span>laurentis</span></h2>
        <div class="container">
            <?php
            include "config.php";
            @$userLogin = $_SESSION['login'];
            echo "<h2>Olá, <span>".$_SESSION['login']."</span></h2>";
            echo "<a href=\"new_post.php\"><button type=\"button\" class=\"button\">Cadastrar novo anúncio</button></a>";
            echo "<a href=\"posts_page.php\"><button type=\"button\" class=\"button\">Visualizar anúncios</button></a>";
            echo "<a href=\"my_posts.php\"><button type=\"button\" class=\"button\">Visualizar meus anúncios</button></a>";

            $result = mysqli_query($con, "SELECT * FROM user WHERE login = '".@$userLogin."'");
            while(@$rows = mysqli_fetch_array($result)){
                @$userIsAdm = @$rows['isAdm'];
            }
            if(@$userIsAdm == 1){
                echo "<a href=\"inactive_posts.php\"><button type=\"button\" class=\"button\">Visualizar anúncios inativos</button></a>";
                echo "<a href=\"new_category.php\"><button type=\"button\" class=\"button\">Cadastrar nova categoria</button></a>";
                echo "<a href=\"register.php\"><button type=\"button\" class=\"button\">Cadastrar novo usuario</button></a>";
            }
            ?>
            <br><br>
<!--            <a href="logout.php"><button type="button" class="button" style="float: right">Logout</button></a>-->
        </div>
    </body>
</html>