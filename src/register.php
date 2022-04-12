<html>
<head>
    <title>DiLaurentis - Register</title>
    <?php include ('config.php');  ?>
    <link href="../css/style.css" rel="stylesheet">
</head>
    <body>
    <?php $id = @$_REQUEST['id'];

        if (@$_REQUEST['button'] == "Excluir") {
            $query_excluir = "DELETE FROM user WHERE id='$id'";
            $result_excluir = mysqli_query($con, $query_excluir);        
            if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
            else echo "<h2> Nao consegui excluir!!!</h2>";
        }

        if (@$_REQUEST['id'] and !$_REQUEST['button']){
            $query = "SELECT * FROM user WHERE id='{$_REQUEST['id']}'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);	
            foreach( $row as $key => $value ){
            $_POST[$key] = $value;
            }
        }

        if (@$_REQUEST['button'] == "Gravar"){
        $password = md5($_POST['password']);
    
            if (!$_REQUEST['id']){
                $insere = "INSERT into user (isAdm, login, first_name, last_name, password) VALUES ('{$_POST['isAdm']}', '{$_POST['login']}', '{$_POST['first_name']}', '{$_POST['last_name']}', '$password')";
                $result_insere = mysqli_query($con, $insere);        
                if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
                else echo "<h2> Nao consegui inserir!!!</h2>";        
            } else {
                $insere = "UPDATE user SET 
                    isAdm = '{$_POST['isAdm']}'
                    , login = '{$_POST['login']}'
                    , first_name = '{$_POST['first_name']}'
                    , last_name = '{$_POST['last_name']}'
                    , password = '{$_POST['password']}'
                    WHERE id = '{$_REQUEST['id']}'
                ";
                $result_update = mysqli_query($con, $insere);
                if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
                else echo "<h2> Nao consegui atualizar!!!</h2>";        
            }
        }
    ?>
     <h1 class="h4 text-gray-900 mb-4">Cadastro de Usuarios</h1>
    <form action="register.php" method="post" name="user">
        <input type="text" placeholder="Login" name="login" value="<?php echo @$_POST['login']; ?>">  
        <input type="text" placeholder="first name" name="first_name" value="<?php echo @$_POST['first_name']; ?>">
        <input type="text" placeholder="last name" name="last_name" value="<?php echo @$_POST['last_name']; ?>">
        <input type="password" id="password" name="password" value="<?php echo @$_POST['password']; ?>" placeholder="password">
        <div>
            <span>Nivel:</span>              
                <div>
                    <input type="radio" name="isAdm" value="ADM" <?php echo (@$_POST['isAdm'] == "0" ? " checked" : "" );?> > ADM  
                    <input type="radio" name="isAdm" value="USER" <?php echo (@$_POST['isAdm'] == "1" ? " checked" : "" );?> > USER
                </div>
        </div>
            </div>
            <input type="submit" value="Gravar" name="button">
            <hr>
            <input type="submit" value="Excluir" name="botao">
            <input type="reset" value="Novo" name="novo">
            <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>">
               
    </form>
    </body>
</html>