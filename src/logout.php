<?php

    session_start();
    session_unset();
    session_destroy();

echo "<script>alert('Você saiu!');top.location.href='login.php';</script>";
?>