<?php
if(!isset($_GET['id']))die();
$stud_id=$_GET['id'];
include "admin_boiler.php";

$res=$conn->query("select * from Student where username='".htmlspecialchars($_GET['id'])."';");
if($res->num_rows==0){
    echo "No such Student.";
    die();
}
$d1=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Details</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:#000000;">
<div class="container-fluid p-5 bg-dark text-white text-center border">
            <h1 class="display-1">Student List</h1>
            <p>Analyse, Edit, Delete Student Records</p>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link" href="admin_page.php">Terminal</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link active" href="admin_student_list.php">Student List</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="admin_company.php">Companies</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="admin_roles.php">Roles</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="admin_graduate_batch.php">Graduate Current Batch</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="logout_testing.php">Logout</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="statistics.php">Placement Statistics</a>
			  </li>
			</ul>
	    </nav>
        </div>
        <div class="container mt-4 text-white">
    <form action="student_edit.php" method="POST">
        <div class="row gy-6">
            <div class="col">
                <input type="hidden" name="username" value="<?php echo $d1['username'];?>">
                <label for="RollNumber">Roll Number:</label>
                <input type="text" class="form-control" name="RollNumber" value="<?php echo $d1['RollNumber'];?>">
            </div>
            <div class="col">
                <label for="alumni_name">Name:</label>
                <input type="text" class="form-control" name="alumni_name" value="<?php echo $d1['student_name'];?>">
            </div>
        </div>
        <br>
        <div class="row gy-6">
            <div class="col">
                <label for="alumni_phone">Phone:</label>
                <input type="text" class="form-control" name="alumni_phone" value="<?php echo $d1['student_phone'];?>">
            </div>
            <div class="col">
                <label for="alumni_email">Email:</label>
                <input type="text" class="form-control" name="alumni_email" value="<?php echo $d1['student_email'];?>">
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
                <input type="text" class="form-control" name="batch" value="<?php echo $d1['Batch'];?>">
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
        <br>
        <div class="row gy-6 text-center">
            <div class="col">
                <input type="submit" class="btn btn-outline-primary" value="Update">
            </div>
            <div class="col">
                <form action="student_delete.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $d1['username'] ?>">
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
            <div class="col">
                <form action="student_role_applications.php" method="GET">
                    <input type="hidden" name="id" value="<?php echo $d1['username']; ?>">
                    <button type="submit" class="btn btn-outline-warning">Roles Eligible</button>
                </form>
            </div>
        </div>
        <br>
</form>
        </div>
</body>
</html>