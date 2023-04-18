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
// var_dump($d1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Alumni Dashboard </title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container-fluid p-5 bg-primary text-white text-center">
    <h1>Hi <?php echo $d1['alumni_name'];?></h1>
    <p>Welcome to TPC portal, update your password and other details.</p>
</div>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="student_page.php">Alumni Dashboard</a>
                </li>
                <li>
                    <a class="nav-link" href="logout_testing.php">Logout</a>
                </li>
				
            </ul>
	</nav>
<div class="container mt-4">
<form action="alumni_edit.php" method="POST">
    <div class="row gy-6">
        <div class="col">
            <input type="hidden" name="username" value="<?php echo $d1['username'];?>">
            <label for="RollNumber">Roll Number:</label>
            <input type="text" class="form-control" name="RollNumber" value="<?php echo $d1['RollNumber'];?>">
        </div>
        <div class="col">
            <label for="alumni_name">Mame:</label>
            <input type="text" class="form-control" name="alumni_name" value="<?php echo $d1['alumni_name'];?>">
        </div>
    </div>
    <br>
    <div class="row gy-6">
        <div class="col">
            <label for="alumni_phone">Phone:</label>
            <input type="text" class="form-control" name="alumni_phone" value="<?php echo $d1['alumni_phone'];?>">
        </div>
        <div class="col">
            <label for="alumni_email">Email:</label>
            <input type="text" class="form-control" name="alumni_email" value="<?php echo $d1['alumni_email'];?>">
        </div>
    </div>
    <br>
    <div class="row gy-6">
        <div class="col">
            <label for="DoB">DoB:</label>
            <input type="text" class="form-control" name="DoB" value="<?php echo $d1['DoB'];?>">
        </div>
        <div class="col">
            <label for="batch">Batch:</label>
            <input type="text" class="form-control" name="batch" value="<?php echo $d1['batch'];?>">
        </div>
        <div class="col">
            <label for="degree">Degree:</label>
            <input type="text" class="form-control" name="degree" value="<?php echo $d1['degree'];?>">
        </div>
        <div class="col">
            <label for="branch">Branch:</label>
            <input type="text" class="form-control" name="branch" value="<?php echo $d1['branch'];?>">
        </div>
    </div>
    <br>
    <div class="row gy-6">
        <div class="col">
            <label for="marks_10">Marks 10:</label>
            <input type="text" class="form-control" name="marks_10" value="<?php echo $d1['marks_10'];?>">
        </div>
        <div class="col">
            <label for="marks_12">Marks12:</label>
            <input type="text" class="form-control" name="marks_12" value="<?php echo $d1['marks_12'];?>">
        </div>
    </div>
    <br>
    <div class="row gy-6">
        <div class="col">
            <label for="sem1_spi">Semester 1 SPI</label>
            <input type="text" class="form-control" name="sem1_spi" value="<?php echo $d1['sem1_spi'];?>">
        </div>
        <div class="col">
            <label for="sem2_spi">Semester 2 SPI:</label>
            <input type="text" class="form-control" name="sem2_spi" value="<?php echo $d1['sem2_spi'];?>">
        </div>
        <div class="col">
            <label for="sem3_spi">Semester 3 SPI:</label>
            <input type="text" class="form-control" name="sem3_spi" value="<?php echo $d1['sem3_spi'];?>">
        </div>
        <div class="col">
            <label for="sem4_spi">Semester 4 SPI:</label>
            <input type="text" class="form-control" name="sem4_spi" value="<?php echo $d1['sem4_spi'];?>">
        </div>
    </div>
    <br>
    <div class="row gy-6">
        <div class="col">
            <label for="sem5_spi">Semester 5 SPI:</label>
            <input type="text" class="form-control" name="sem5_spi" value="<?php echo $d1['sem5_spi'];?>">
        </div>
        <div class="col">
            <label for="sem6_spi">Semester 6 SPI:</label>
            <input type="text" class="form-control" name="sem6_spi" value="<?php echo $d1['sem6_spi'];?>">
        </div>
        <div class="col">
            <label for="sem7_spi">Semester 7 SPI:</label>
            <input type="text" class="form-control" name="sem7_spi" value="<?php echo $d1['sem7_spi'];?>">
        </div>
        <div class="col">
            <label for="sem8_spi">Semester 8 SPI:</label>
            <input type="text" class="form-control" name="sem8_spi" value="<?php echo $d1['sem8_spi'];?>">
        </div>
    </div>
    <br>
    <div class="row gy-6">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" value="<?php echo $d1['password'];?>">
    </div>
    <br>
    <div class="row gy-6">
        <div class="col">
            <label for="placed_company">Placed Company:</label>
            <input type="text" class="form-control" name="placed_company" value="<?php echo $d1['placed_company'];?>">
        </div>
        <div class="col">
            <label for="ctc">CTC:</label>
            <input type="number" class="form-control" name="ctc" value="<?php echo $d1['ctc'];?>">
        </div>
    </div>
</form>
<br>
<div class="row gy-6">
    <input type="submit" class="btn btn-primary" value="Update">
</div>
<br>


<!-- <form action="alumni_edit.php" method="POST">
    <input type="hidden" name="username" value="<?php echo $d1['username'];?>"/>
    RollNumber: <input type="text" name="RollNumber" value="<?php echo $d1['RollNumber'];?>"/></br>
    alumni_name: <input type="text" name="alumni_name" value="<?php echo $d1['alumni_name'];?>"/></br>
    alumni_phone: <input type="text" name="alumni_phone" value="<?php echo $d1['alumni_phone'];?>"/></br>
    alumni_email: <input type="text" name="alumni_email" value="<?php echo $d1['alumni_email'];?>"/></br>
    DoB: <input type="text" name="DoB" value="<?php echo $d1['DoB'];?>"/></br>
    Batch: <input type="text" name="batch" value="<?php echo $d1['batch'];?>"/></br>
    degree: <inpput type="text" name="degree" value="<?php echo $d1['degree'];?>"/></br>
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
    ctc: <input type="number" name="ctc" value="<?php echo $d1['ctc'];?>"/></br> -->
</div>
</form>

</body>
</html>