<?php session_start();
    session_destroy();
    header("Location:login.php?message=Logged Out Successfully!");
    exit()
?>