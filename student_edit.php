<?php
if(!isset($_POST['username'])){
    die();
}
$stud_id=$_POST["username"];
include "admin_boiler.php";
$query=("update Student set RollNumber='".htmlspecialchars($_POST['RollNumber'])."',student_name='".htmlspecialchars($_POST['alumni_name'])."',student_phone='".htmlspecialchars($_POST['alumni_phone'])."',student_email='".htmlspecialchars($_POST['alumni_email'])."',DoB='".htmlspecialchars($_POST['DoB'])."',Batch='".htmlspecialchars($_POST['batch'])."',degree='".htmlspecialchars($_POST['degree'])."',branch='".htmlspecialchars($_POST['branch'])."',marks_10='".htmlspecialchars($_POST['marks_10'])."',marks_12='".htmlspecialchars($_POST['marks_12'])."',sem1_spi='".htmlspecialchars($_POST['sem1_spi'])."',sem2_spi='".htmlspecialchars($_POST['sem2_spi'])."',sem3_spi='".htmlspecialchars($_POST['sem3_spi'])."',sem4_spi='".htmlspecialchars($_POST['sem4_spi'])."',sem5_spi='".htmlspecialchars($_POST['sem5_spi'])."',sem6_spi='".htmlspecialchars($_POST['sem6_spi'])."',sem7_spi='".htmlspecialchars($_POST['sem7_spi'])."',sem8_spi='".htmlspecialchars($_POST['sem8_spi'])."',password='".htmlspecialchars($_POST['password'])."' where username='".htmlspecialchars($_POST['username'])."';");
if($conn->query($query)){
    header("Location: ./student_details.php?id=".$_POST['username']);
}else{
    echo $conn->error;
}