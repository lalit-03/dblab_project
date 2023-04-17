<?php
if(!isset($_POST['id'])){
    die();
}
$stud_id=$_POST['id'];
include "student_boiler.php";

$stud = $conn->query("select * from Student where username='".$_POST['id']."';");
if($stud->num_rows==0)die();
$res = $stud->fetch_assoc();
if($res['password']==$_POST['old']){
    $conn->query("update Student set password='".$_POST['new']."' where username='". $_POST['id']."';");
    header('Location: ./student_page.php');
}else{
    echo "Incorrect old password.";
}