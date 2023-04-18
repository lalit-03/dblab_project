<?php
include "admin_boiler.php";
if(!isset($_POST['batch']))die();

$conn->query("insert into Alumni select username,RollNumber, student_name as alumni_name, student_phone as alumni_phone, student_email as alumni_email, DoB, batch, degree, branch, marks_10,marks_12,sem1_spi,sem2_spi,sem3_spi,sem4_spi,sem5_spi,sem6_spi,sem7_spi,sem8_spi,placed_company,ctc,password from Student where batch=".$_POST['batch'].";");
$conn->query("delete from Offers where username in (select username from Student where batch=".$_POST['batch'].");");
$conn->query("delete from Student where batch=".$_POST['batch'].";");
header('Location: ./admin_page.php');