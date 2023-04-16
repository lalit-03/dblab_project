<?php
include "admin_boiler.php";
if(!isset($_POST['id'])){
    die();
}
$stud = $conn->query("select * from student where username='".$_POST['id']."';");
if($stud->num_rows==0)die();
$res = $stud->fetch_assoc();
foreach($_POST as $role => $val){
    if(substr($role,0,4)!="role")continue;
    $r1=htmlspecialchars(substr($role,4));
    $res1 = $conn->query("select count(*) as c from offers where username='".$_POST['id']. "' and role_id=".$r1.";");
    $q1 = $res1->fetch_assoc();
    $exists = $q1['c'];
    if(!$q1){
        echo $conn->error;
        continue;
    }
    if($val=="Yes"){
        if($exists)continue;
        else $conn->query("insert into offers(username,role_id) values('".$_POST['id']."',".$r1.");");
    }else{
        if(!$exists)continue;
        else $conn->query("delete from offers where username='".$_POST['id']. "' and role_id=".$r1.";");
    }
}
header("Location: ./student_details.php?id=".$_POST['id']);