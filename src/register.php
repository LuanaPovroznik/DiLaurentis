<html>
<head>
    <title>DiLaurentis - Register</title>
    <?php include ('config.php');  ?>
    <link href="../css/register_style.css" rel="stylesheet">
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
                if(@$_POST['isAdm'] == "ADM"){
                    @$userIsAdmin = 1;
                } else {
                    @$userIsAdmin = 0;
                }
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
        <input type="text" placeholder="Username" onfocusout="checkUser()" name="login" id= "login" value="<?php echo @$_POST['login']; ?>" required>
        <script>
            function checkUser() {
                fetch("http://localhost/dilaurentis/src/check_user.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                    },
                    body: `login=${document.getElementById("login").value}`,
                }).then((response) => response.text())
                    .then((res) => {
                        document.getElementById("result").innerHTML = res;
                        letRegister();
                    });
            }
        </script>
        <p id="result" style="color: lightcoral; font-style: italic; font-size: small"></p>
        <input type="text" placeholder="Nome" name="first_name" value="<?php echo @$_POST['first_name']; ?>" required>
        <input type="text" placeholder="Sobrenome" name="last_name" value="<?php echo @$_POST['last_name']; ?>" required>
        <input type="password" id="password" name="password" value="<?php echo @$_POST['password']; ?>" placeholder="Senha" required>
        <div>
            <br><span>Nivel:</span>
            <div>
                <br>
                <input type="radio" name="isAdm" value="ADM" <?php echo (@$_POST['isAdm'] == "0" ? " checked" : "" );?> > ADM
                <input type="radio" name="isAdm" value="USER" <?php echo (@$_POST['isAdm'] == "1" ? " checked" : "" );?> > USER
            </div>
        </div><br>
        <script>
            function letRegister(){
                userAvaiable = document.getElementById("result").innerHTML.valueOf();
                if(userAvaiable == "Esse login já existe em nosso sistema."){
                    document.getElementById("buttonGravar").style.backgroundColor="grey";
                    document.user.button.disabled=true
                } else {
                    document.getElementById("buttonGravar").style.backgroundColor="#008CBA";
                    document.user.button.disabled=false
                }
            }
        </script>
    <input type="submit" value="Gravar" id="buttonGravar" name="button" class="button" style="float: right">
        <a href="login.php">
            <button type="button" class="button" style="float: right">Já tenho uma conta</button>
        </a>
    <input type="submit" value="Excluir" name="botao">
    <input type="reset" value="Novo" name="novo">
    <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>">

    </form>
</div>
    </body>
</html>