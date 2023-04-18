<?php
session_start();
if(!isset($_GET['id'])){
    if(!isset($_SESSION['username'])){
        die();
    }else{
        $stud_id=$_SESSION['username'];
    }
}else{
    $stud_id=$_GET['id'];
}

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

$res=$conn->query("select * from Alumni where username='".htmlspecialchars($stud_id)."';");
if($res->num_rows==0){
    echo "No such person.";
    die();
}
$d1=$res->fetch_assoc();
var_dump($d1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Details</title>
</head>
<body>
    <form action="alumni_edit.php" method="POST">
    <input type="hidden" name="username" value="<?php echo $d1['username'];?>"/>
RollNumber: <input type="text" name="RollNumber" value="<?php echo $d1['RollNumber'];?>"/></br>
alumni_name: <input type="text" name="alumni_name" value="<?php echo $d1['alumni_name'];?>"/></br>
alumni_phone: <input type="text" name="alumni_phone" value="<?php echo $d1['alumni_phone'];?>"/></br>
alumni_email: <input type="text" name="alumni_email" value="<?php echo $d1['alumni_email'];?>"/></br>
DoB: <input type="text" name="DoB" value="<?php echo $d1['DoB'];?>"/></br>
Batch: <input type="text" name="batch" value="<?php echo $d1['batch'];?>"/></br>
degree: <input type="text" name="degree" value="<?php echo $d1['degree'];?>"/></br>
branch: <input type="text" name="branch" value="<?php echo $d1['branch'];?>"/></br>
marks_10: <input type="text" name="marks_10" value="<?php echo $d1['marks_10'];?>"/></br>
marks_12: <input type="text" name="marks_12" value="<?php echo $d1['marks_12'];?>"/></br>
sem1_spi: <input type="text" name="sem1_spi" value="<?php echo $d1['sem1_spi'];?>"/></br>
sem2_spi: <input type="text" name="sem2_spi" value="<?php echo $d1['sem2_spi'];?>"/></br>
sem3_spi: <input type="text" name="sem3_spi" value="<?php echo $d1['sem3_spi'];?>"/></br>
sem4_spi: <input type="text" name="sem4_spi" value="<?php echo $d1['sem4_spi'];?>"/></br>
sem5_spi: <input type="text" name="sem5_spi" value="<?php echo $d1['sem5_spi'];?>"/></br>
sem6_spi: <input type="text" name="sem6_spi" value="<?php echo $d1['sem6_spi'];?>"/></br>
sem7_spi: <input type="text" name="sem7_spi" value="<?php echo $d1['sem7_spi'];?>"/></br>
sem8_spi: <input type="text" name="sem8_spi" value="<?php echo $d1['sem8_spi'];?>"/></br>
password: <input type="text" name="password" value="<?php echo $d1['password'];?>"/></br>
placed_company: <input type="text" name="placed_company" value="<?php echo $d1['placed_company'];?>"/></br>
sem8_spi: <input type="number" name="ctc" value="<?php echo $d1['ctc'];?>"/></br>
<input type="submit">
</form>

</body>
</html>