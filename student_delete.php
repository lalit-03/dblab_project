<?php
include "admin_boiler.php";
if(!isset($_GET['id'])){
    die();
}
$query=("delete from Student where username='". $_GET['id'] ."';");
if($conn->query($query)){
    header("Location: admin_page.php");
}else{
    echo $conn->error;
}