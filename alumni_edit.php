<?php
if(!isset($_POST['username'])){
    die();
}
$stud_id=$_POST["username"];
session_start();
ini_set('display_errors', 1);
error_reporting(-1);

    if($_SESSION['user_type'] != 'admin'){
        if(!isset($stud_id))$stud_id=$_SESSION['username'];
        if(!($_SESSION['user_type'] == 'alumni' && $_SESSION['username'] == $stud_id)){
            $message=urlencode("Unauthorized Access! How dare you 😡");
            header("Location:login.php?message=".$message);
        }
    }

    $host = 'localhost';
    $username = 'test';
    $password = 'test';
    $database = 'dblab_project';

    $conn = new mysqli($host, $username, $password, $database);
    $output="";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
$ctc=0;
if($_POST['ctc']!="")$ctc=$_POST['ctc'];
$query=("update Alumni set RollNumber='".htmlspecialchars($_POST['RollNumber'])."',alumni_name='".htmlspecialchars($_POST['alumni_name'])."',alumni_phone='".htmlspecialchars($_POST['alumni_phone'])."',alumni_email='".htmlspecialchars($_POST['alumni_email'])."',DoB='".htmlspecialchars($_POST['DoB'])."',Batch='".htmlspecialchars($_POST['Batch'])."',degree='".htmlspecialchars($_POST['degree'])."',branch='".htmlspecialchars($_POST['branch'])."',marks_10='".htmlspecialchars($_POST['marks_10'])."',marks_12='".htmlspecialchars($_POST['marks_12'])."',sem1_spi='".htmlspecialchars($_POST['sem1_spi'])."',sem2_spi='".htmlspecialchars($_POST['sem2_spi'])."',sem3_spi='".htmlspecialchars($_POST['sem3_spi'])."',sem4_spi='".htmlspecialchars($_POST['sem4_spi'])."',sem5_spi='".htmlspecialchars($_POST['sem5_spi'])."',sem6_spi='".htmlspecialchars($_POST['sem6_spi'])."',sem7_spi='".htmlspecialchars($_POST['sem7_spi'])."',sem8_spi='".htmlspecialchars($_POST['sem8_spi'])."',password='".htmlspecialchars($_POST['password'])."',placed_company='".htmlspecialchars($_POST['placed_company'])."',ctc=".htmlspecialchars($ctc)." where username='".htmlspecialchars($_POST['username'])."';");
if($conn->query($query)){
    header("Location: ./alumni_page.php?id=".$_POST['username']);
}else{
    echo $conn->error;
}