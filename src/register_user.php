<html>
<head>
    <title>DiLaurentis - Register</title>
    <?php include ('config.php');  ?>
    <link href="../css/register_style.css" rel="stylesheet">
</head>
    <body>
    <?php $id = @$_REQUEST['id'];

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
                @$userIsAdmin = 0;                
                $insere = "INSERT into user (isAdm, login, first_name, last_name, password) VALUES ('{$userIsAdmin}', '{$_POST['login']}', '{$_POST['first_name']}', '{$_POST['last_name']}', '$password')";
                $result_insere = mysqli_query($con, $insere);        
                if ($result_insere){
                    echo "<script>alert('Cadastrado com sucesso!'); top.location.href='login.php';</script>";
                } else {
                    echo "<h2> Nao consegui inserir!!!</h2>";
                }
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
    <h2 style="text-align: center">di<span>laurentis</span></h2>
<div class="container">
    <h2>Cadastro <span>de Usuarios</span></h2>
    <form action="register.php" method="post" name="user">
        <input type="text" placeholder="Username" name="login" value="<?php echo @$_POST['login']; ?>" required>
        <input type="text" placeholder="Nome" name="first_name" value="<?php echo @$_POST['first_name']; ?>" required>
        <input type="text" placeholder="Sobrenome" name="last_name" value="<?php echo @$_POST['last_name']; ?>" required>
        <input type="password" id="password" name="password" value="<?php echo @$_POST['password']; ?>" placeholder="Senha" required>
    <input type="submit" value="Gravar" name="button" class="button" style="float: right">
        <a href="login.php">
            <button type="button" class="button" style="float: right">Já tenho uma conta</button>
        </a>
    <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>">

    </form>
</div>
    </body>
</html>