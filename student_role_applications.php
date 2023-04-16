<?php
include "admin_boiler.php";
if(!isset($_GET['id'])){
    die();
}
$stud = $conn->query("select * from student where username='".$_GET['id']."';");
if($stud->num_rows==0)die();
$res = $stud->fetch_assoc();
$cpi = ($res['sem1_spi']+$res['sem2_spi']+$res['sem3_spi']+$res['sem4_spi']+$res['sem5_spi']+$res['sem6_spi']+$res['sem7_spi']+$res['sem8_spi'])/8;
$eligible = $conn->query("select company_name,role_id,Role_Name,min_cpi,description,mode_of_interview,ctc from roles natural join company where min_cpi<=".$cpi." order by ctc desc;");
if($eligible->num_rows > 0){
    while($row = $eligible->fetch_assoc()){
        $ress1 = $conn->query("select count(*) as c from offers where username='".$_GET['id']. "' and role_id=".$row['role_id'].";");
        $q1 = $ress1->fetch_assoc();
        $exists = $q1['c'];
        $output .= "<div class='something'><input type='hidden' name='role".$row['role_id']."'value='No'/><input type='checkbox' name='role".$row['role_id']."' ".($exists?"checked='checked'":"")." value='Yes'/> Company: ". $row['company_name']."</br> Role: ".$row['Role_Name']."</br>Description: ".$row['description']."</br>Mode of interview".($row['mode_of_interview']?"Online":"Offline")."</br> CTC: ".$row['ctc']."</div>";
    }
}else{
    echo "No eligible roles right now.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
    <title>Eligible Roles</title>
</head>
<body>
    <form action="./apply.php" method="POST">
        <input type='hidden' name='id' value='<?php echo $res['username']; ?>'/>
        <?php echo $output;?>
        <input type="submit"/>
    </form>
    
</body>
</html>