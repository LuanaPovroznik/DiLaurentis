<html>
    <a href="logout.php">Logout</a> <br>
    <a href="register.php">Register</a> <br>
    <a href="login.php">Login</a> <br>
    Entrei <?php require('verification.php'); echo $_SESSION["login"]; ?>
</html>