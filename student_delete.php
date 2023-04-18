<?php
include "admin_boiler.php";
if(!isset($_GET['id'])){
    die();
}
$conn->query("delete from Offers where username='".$_GET['id']."';");
$conn->query("delete from Student where username='". $_GET['id'] ."';");

header("Location: admin_page.php");
