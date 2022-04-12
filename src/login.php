<html>

<head>
    <title>DiLaurentis - Login</title>
    <link href="../css/style.css" rel="stylesheet">
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
    <div class="container">
        <h1>Welcome Back!</h1>
        <form class="user" action=# method=post>
            <input type="text" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="login">
            <input type="password" id="password" placeholder="Password" name="password">                      
            <input type="submit" name="button" value="Login">                                               
        </form>                       
        <a href="register.php">Create an Account!</a>                            
    </div>
</body>
</html>