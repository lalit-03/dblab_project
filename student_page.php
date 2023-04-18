<?php
include "student_boiler.php";
$stud = $conn->query("select * from Student where username='".$_SESSION['username']."';");
if($stud->num_rows==0)die();
$res = $stud->fetch_assoc();
$username = $res['username'];
$RollNumber = $res['RollNumber'];
$student_name = $res['student_name'];
$student_phone = $res['student_phone'];
$student_email = $res['student_email'];
$DoB = $res['DoB'];
$Batch = $res['Batch'];
$degree = $res['degree'];
$branch = $res['branch'];
$marks_10 = $res['marks_10'];
$marks_12 = $res['marks_12'];
$sem1_spi = $res['sem1_spi'];
$sem2_spi = $res['sem2_spi'];
$sem3_spi = $res['sem3_spi'];
$sem4_spi = $res['sem4_spi'];
$sem5_spi = $res['sem5_spi'];
$sem6_spi = $res['sem6_spi'];
$sem7_spi = $res['sem7_spi'];
$sem8_spi = $res['sem8_spi'];
// $placed_company = $res['placed_company'];
// $ctc = $res['ctc'];
// $password = $res['password'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;">
<div class="container-fluid p-5 bg-primary text-white text-center">
    <h1>Hi <?php echo $res['student_name'];?></h1>
    <p>Welcome to TPC portal, change your password or check roles you are elligible for.</p>
</div>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="student_page.php">Profile</a>
                
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="student_passwd.php?id=<?php echo $_SESSION['username']?>">Change Password</a>
                    <!-- <a class="nav-link active" href="company_page.php">Create Offers</a> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="student_role_applications.php?id=<?php echo $_SESSION['username'] ?>">Check Eligible Roles</a>
                    <!-- <a class="nav-link" href="company_roles.php">Previous Offers</a> -->
                </li>
                <li>
                    <a class="nav-link" href="logout_testing.php">Logout</a>
                </li>
            </ul>
	</nav>
    <div class="container mt-4">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<div class="card">
					<div class="card-header text-center">
						<h3>Student Profile</h3>
					</div>
					<div class="card-body text-center">
						<h5><strong>Username:</strong> <?php echo $username; ?></h5>
						<h5><strong>Roll Number: </strong><?php echo $RollNumber; ?></h5>
						<h5><strong>Name: </strong><?php echo $student_name; ?></h5>
						<h5><strong>Phone: </strong><?php echo $student_phone; ?></h5>
						<h5><strong>Email: </strong><?php echo $student_email; ?></h5>
						<h5><strong>Date of Birth: </strong><?php echo $DoB; ?></h5>
						<h5><strong>Batch: </strong><?php echo $Batch; ?></h5>
						<h5><strong>Degree: </strong><?php echo $degree; ?></h5>
						<h5><strong>Branch: </strong><?php echo $branch; ?></h5>
						<h5><strong>10th Marks: </strong><?php echo $marks_10; ?></h5>
						<h5><strong>12th Marks: </strong><?php echo $marks_12; ?></h5>
						<h5><strong>Semester 1 SPI: </strong><?php echo $sem1_spi; ?></h5>
						<h5><strong>Semester 2 SPI: </strong><?php echo $sem2_spi; ?></h5>
						<h5><strong>Semester 3 SPI: </strong><?php echo $sem3_spi; ?></h5>
						<h5><strong>Semester 4 SPI: </strong><?php echo $sem4_spi; ?></h5>
						<h5><strong>Semester 5 SPI: </strong><?php echo $sem5_spi; ?></h5>
						<h5><strong>Semester 6 SPI: </strong><?php echo $sem6_spi; ?></h5>
						<h5><strong>Semester 7 SPI: </strong><?php echo $sem7_spi; ?></h5>
						<h5><strong>Semester 8 SPI: </strong><?php echo $sem8_spi; ?></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
    <br>
</body>
</html>