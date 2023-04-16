<?php
include "admin_boiler.php";
if(!isset($_GET['id'])){
    die();
}
$query=("delete from student where username='". $_GET['id'] ."';");
if($conn->query($query)){
    header("Location: ./admin_student_powers_hahaha.php");
}else{
    echo $conn->error;
}