<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
    if($_SESSION['user_type'] != 'admin'){
        $message=urlencode("Unauthorized Access! How dare you 😡");
        header("Location:login.php?message=".$message);
    }

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'dblab_project';

    $conn = new mysqli($host, $username, $password, $database);
    $output="";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>