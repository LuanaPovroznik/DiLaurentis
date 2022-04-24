<html>

<head>
    <title>Login</title>
    <link href="../css/login_style.css" rel="stylesheet">
</head>

<?php
include ('config.php');
session_start(); 

if (@$_REQUEST['button']=="Login")
{
	$login = $_POST['login'];
	$password = md5($_POST['password']);
	
	$query = "SELECT * FROM user WHERE login = '$login' AND password = '$password' ";
	$result = mysqli_query($con, $query);
	while ($coluna=mysqli_fetch_array($result)) 
	{
		$_SESSION["id"]= $coluna["id"]; 
		$_SESSION["login"] = $coluna["login"]; 
		$_SESSION["isAdm"] = $coluna["isAdm"];

		$isAdm = $coluna['isAdm'];
		if($isAdm == "0"){ 
			header("Location: index.php"); 
			exit; 
		}
		
		if($isAdm == "1"){ 
			header("Location: index.php"); 
			exit; 
		}
	}
	
}
?>

<body>
<h2 style="text-align: center">di<span>laurentis</span></h2>
    <div class="container">
        <h1>Seja <span>bem vindo</span></h1>
        <form class="user" action=# method=post>
            <input type="text" aria-describedby="emailHelp" placeholder="Enter username" name="login" required><br><br>
            <input type="password" id="password" placeholder="Password" name="password" required> <br><br>
            <a href="register.php"><button type="button" class="button" style="float: left">Crie sua conta</button></a>
            <input type="submit" name="button" value="Login" class="button" style="float: right"><br>
        </form>
        <a href="posts_page_logged_out.php"><button type="button" class="button" style="float: left; width: 100%">Visualizar anúncios</button></a>
    </div>
</body>
</html>