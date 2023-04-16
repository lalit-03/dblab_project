<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
    if($_SESSION['user_type'] != 'admin'){
        $message=urlencode("Unauthorized Access! How dare you 😡");
        header("Location:login.php?message=".$message);
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
    $res = $conn->query("select student_name, RollNumber, username from Student order by RollNumber limit 100;");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            
            $output .= "<a href='./student_details.php?id=". $row['username'] ."'><div class='card'>". $row['student_name'] . $row['RollNumber'] . "</div></a></br>";
        }
    }
    
$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MySQL Console</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        HA HA AHA HA <?php echo $output;?>
    </body>
</html>