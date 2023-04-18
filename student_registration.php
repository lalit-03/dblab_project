<?php
// Connect to the MySQL database
ini_set('display_errors', 1);
error_reporting(-1);
$host = "localhost";
$username = "test";
$password = "test";
$conn = mysqli_connect($host, $username, $password);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Check if the connection was successful
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    else {
        // echo "<b>Connected successfully</b><hr><br>";
        // Get the user input data from the form
        $username = $_POST["username"];
        $rollno = $_POST["rollnumber"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $name = $_POST["studentname"];
		$email = $_POST["studentemail"];
		$phone = $_POST["studentphone"];
		$dob = $_POST["dob"];
		$batch = $_POST["batch"];
		$degree = $_POST["degree"];
		$branch = $_POST["branch"];
		$marks10 = $_POST["marks10"];
		$marks12 = $_POST["marks12"];
		$sem1spi = $_POST["sem1spi"];
		$sem2spi = $_POST["sem2spi"];
		$sem3spi = $_POST["sem3spi"];
		$sem4spi = $_POST["sem4spi"];
		$sem5spi = $_POST["sem5spi"];
		$sem6spi = $_POST["sem6spi"];
		$sem7spi = $_POST["sem7spi"];
		$sem8spi = $_POST["sem8spi"];

		if (empty($sem1spi)) {
			$sem1spi = 0.0;
		}
		if (empty($sem2spi)) {
			$sem2spi = 0.0;
		}
		if (empty($sem3spi)) {
			$sem3spi = 0.0;
		}
		if (empty($sem4spi)) {
			$sem4spi = 0.0;
		}
		if (empty($sem5spi)) {
			$sem5spi = 0.0;
		}
		if (empty($sem6spi)) {
			$sem6spi = 0.0;
		}
		if (empty($sem7spi)) {
			$sem7spi = 0.0;
		}
		if (empty($sem8spi)) {
			$sem8spi = 0.0;
		}

		// echo $username . "<br>";
		// echo $rollno . "<br>";
		// echo $password . "<br>";
		// echo $confirm_password . "<br>";
		// echo $name . "<br>";
		// echo $email . "<br>";
		// echo $phone . "<br>";
		// echo $dob . "<br>";
		// echo $batch . "<br>";
		// echo $degree . "<br>";
		// echo $branch . "<br>";
		// echo $marks10 . "<br>";
		// echo $marks12 . "<br>";
		// echo $sem1spi . "<br>";
		// echo $sem2spi . "<br>";
		// echo $sem3spi . "<br>";
		// echo $sem4spi . "<br>";
		// echo $sem5spi . "<br>";
		// echo $sem6spi . "<br>";
		// echo $sem7spi . "<br>";
		// echo $sem8spi . "<br>";

        $user_query = "SELECT username FROM dblab_project.Student WHERE username='$username'";
        $roll_query = "SELECT RollNumber FROM dblab_project.Student WHERE RollNumber='$rollno'";
        $result = mysqli_query($conn, $user_query);
		$result2 = mysqli_query($conn, $roll_query);
        $count = mysqli_num_rows($result);
		$count2 = mysqli_num_rows($result2);
        if($count == 0 and $count2 == 0) {
            if (empty($username) || empty($rollno) || empty($password) || empty($confirm_password) || empty($name) || empty($email) || empty($phone) || empty($dob) || empty($batch) || empty($degree) || empty($branch) || empty($marks10) || empty($marks12)) {
                $error="Please fill out all the required fields.<br>";
            } elseif ($password != $confirm_password) {
                $error="The passwords do not match.<br>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error="Invalid email format.<br>";
            } elseif (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])(?=.*[a-zA-Z]).{8,}$/", $password)) {
                $error="Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.<br>";
            }
			elseif(!is_numeric($phone) || !strlen($phone)) {
				$error="Invalid Phone";
			}
			else {
                $sql = "INSERT INTO dblab_project.Student (username, RollNumber, student_name, student_phone, student_email, DoB, Batch, degree, branch, marks_10, marks_12, sem1_spi, sem2_spi, sem3_spi, sem4_spi, sem5_spi, sem6_spi, sem7_spi, sem8_spi, password) VALUES ('$username', '$rollno', '$name', '$phone', '$email', '$dob', $batch, '$degree', '$branch', $marks10, $marks12, $sem1spi, $sem2spi, $sem3spi, $sem4spi, $sem5spi, $sem6spi, $sem7spi, $sem8spi, '$password')";
                if (mysqli_query($conn, $sql)) {
                    $message=urlencode("Registration Successful!");
                    header("Location:login.php?message=".$message);
                } else {
                    $error="Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        else {
            $error="Username has been taken, try another. OR The Roll Number has been registered.<br>";
        }
		
    }


    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Student Registration Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;"">
	<div class="container-fluid p-5 bg-primary text-white text-center">
		<h1 class="display-1">Student Registration Form</h1>
		<p>Create a username and password and enter the details carefully.</p>
	</div>
	<nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link" href="login.php">Login Page</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link active" href="student_registration.php">Student Registration</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="company_registration.php">Company Registration</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="alumni_registration.php">Alumni Registration</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="statistics.php">Placement Statistics</a>
			  </li>
			</ul>
	</nav>
<body>
	<div class="container mt-3">
	<?php
		if(isset($error)) {
			echo "<div class='alert alert-danger' style='text-align:center; font-weight:bold;'>$error</div>";
		}
	?>
	<h2>Add Student Record</h2>
	<form method="post" action="student_registration.php">
		<div class="row gy-6">
			<div class = "col">
				<label for="username" class="form-label">Username:</label>
				<input class="form-control form-control-md" type="text" name="username" required placeholder="Create a username.">
			</div>
			<div class="col">
				<label for="rollnumber" class="form-label">Roll Number:</label>
				<input class="form-control form-control-md" type="text" name="rollnumber" required placeholder="Enter Institute's Roll No.">
			</div>
		</div>
		<hr>
		<div class="row gy-6">
			<div class="col">
				<label for="password" class="form-label">Password:</label>
				<input class="form-control form-control-md"  type="password" name="password" required placeholder="Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character."><br><br>
			</div>
			<div class="col">
				<label for="confirm_password" class="form-label">Confirm Password:</label>
				<input class="form-control form-control-md" type="password" name="confirm_password" required placeholder="Repeat password to confirm""><br><br>
			</div>
		</div>
			
		<div class="row gy-6">
			<label for="studentname" class="form-label">Student Name:</label>
			<input class="form-control form-control-lg" type="text" name="studentname" required placeholder="Enter your Full Name"><br><br>
		</div>
		<hr>
		<div class="row gy-6">
			<div class="col">
				<label for="studentphone" class="form-label">Student Phone:</label>
				<input class="form-control form-control-md" type="text" name="studentphone" required placeholder="Enter 10 digit number."><br><br>
			</div>
			<div class="col">
				<label for="studentemail" class="form-label">Student Email:</label>
				<input class="form-control form-control-md" type="email" name="studentemail" required placeholder="Enter institute's email address."><br><br>
			</div>
		</div>
		<div class="row gy-6">
			<div class="col">
				<label for="dob" class="form-label">Date of Birth:</label>
				<input class="form-control form-control-sm" type="date" name="dob" required><br><br>
			</div>
			<div class ="col">
				<label for="batch" class="form-label">Batch:</label>
				<input class="form-control form-control-sm" type="number" name="batch" required placeholder="Graduation Year"><br><br>
			</div>
			<div class="col">
				<label for="degree" class="form-label">Degree:</label>
				<select name="degree" id="degree" class="form-control form-control-sm">
					<option value="BTech/BSc">BTech. / BSc.</option>
					<option value="MTech/MSc">MTech. /MSc.</option>
					<option value="PhD">PhD.</option>
				</select>
			</div>
			<div class="col">
				<label for="branch" class="form-label">Branch:</label>
				<input class="form-control form-control-sm" type="text" name="branch" required placeholder="Branch"><br><br>
			</div>
		</div>

		<div class="row gy-6">
			<div class="col">
				<label for="marks10" class="form-label">10th Marks:</label>
				<input class="form-control form-control-lg" type="number" name="marks10" step="0.01" required placeholder="% rounded off to second place"><br><br>
			</div>
			<div class="col">
				<label for="marks12" class="form-label">12th Marks:</label>
				<input class="form-control form-control-lg" type="number" name="marks12" step="0.01" required placeholder="% rounded off to second place"><br><br>
			</div>
		</div>

		<div class="row gy-6">
			<div class="col">
				<label for="sem1spi" class="form-label">Semester 1 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem1spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>
			<div class="col">
				<label for="sem2spi" class="form-label">Semester 2 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem2spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>
			<div class="col">
				<label for="sem3spi" class="form-label">Semester 3 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem3spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>
			<div class="col">
				<label for="sem4spi" class="form-label">Semester 4 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem4spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>
		</div>

		<div class="row gy-6">
			<div class="col">
				<label for="sem5spi" class="form-label">Semester 5 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem5spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>
			<div class="col">
				<label for="sem6spi" class="form-label">Semester 6 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem6spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>			
			<div class="col">
				<label for="sem7spi" class="form-label">Semester 7 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem7spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>
			<div class="col">
				<label for="sem8spi" class="form-label">Semester 8 SPI:</label>
				<input class="form-control form-control-sm" type="number" name="sem8spi" step="0.01" placeholder="Between 0 and 10"><br><br>
			</div>
		</div>
		<div class="row gy-6">
			<hr>
			<input type="submit" value="Register" class="btn btn-success btn-large justify-content-center">
		</div>
		<?php if (isset($error)){
            echo "<hr><div class='alert alert-danger justify-content-center'><strong>$error</strong></div>";    
		}
        ?>
	</form>	
	</div>
	<br>
</div>
</body>
</html>