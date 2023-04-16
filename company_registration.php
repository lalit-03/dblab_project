
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
        $company_name = $_POST["company_name"];
        $username = $_POST["company_username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $year = date("Y"); 

        $user_query = "SELECT * FROM tpc.Company WHERE company_username='$username'";
        $result = mysqli_query($conn, $user_query);
        $count = mysqli_num_rows($result);
        
        if($count == 0) {
            if (empty($company_name) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                $error="Please fill out all the required fields.<br>";
            } elseif ($password != $confirm_password) {
                $error="The passwords do not match.<br>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error="Invalid email format.<br>";
            } elseif (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])(?=.*[a-zA-Z]).{8,}$/", $password)) {
                $error="Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.<br>";
            } else {
                $sql = "INSERT INTO tpc.Company VALUES ('$username', '$password', '$company_name', '$email', '$year')";
                if (mysqli_query($conn, $sql)) {
                    $message=urlencode("Registration Successful!");
                    header("Location:login.php?message=".$message);
                } else {
                    $error="Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        else {
            $error="Username has been take try another.<br>";
        }
    }


    // Close the database connection
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Company Registration Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;">
	<div class="container-fluid p-5 bg-primary text-white text-center">
		<h1 class="display-1">Company Registration Form</h1>
		<p>Enter company name and email, create a username and password to register.</p>
	</div>
	<nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link" href="login.php">Login Page</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="student_registration.php">Student Registration</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link active" href="company_registration.php">Company Registration</a>
			  </li>
			</ul>
	</nav>
	<div class="container mt-3">
		<form action="company_registration.php" method="post">
			<div class="row gy-3">
                <div class="col">
					<label for="company_name" class="form-label">Company Name:</label>
					<input class="form-control form-control-lg" type="text" name="company_name" required placeholder="Example Pvt. Ltd.">
                </div>
                <div class="col">
					<label for="company_username" class="form-label">Username:</label>
					<input class="form-control form-control-lg" type="text" name="company_username" required placeholder="ExamplePvtLtd">
                </div>
			</div>
            <hr>
			<div class="row gy-6">
				<label for="email" class="form-label">Email:</label>
				<input class="form-control" type="email" name="email" required placeholder="hr@example.com"><br><br>
			</div>
            <hr>
			<div class="row gy-6">
                <label for="password" class="form-label">Password:</label>
                <input class="form-control form-control-md"  type="password" name="password" required placeholder="Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character."><br><br>
			</div>
            <hr>

			<div class="row gy-6">
                <label for="confirm_password" class="form-label">Confirm Password:</label>
                <input class="form-control form-control-md" type="password" name="confirm_password" required placeholder="Repeat password to confirm""><br><br>
			</div>
			<div class="row gy-6">
				<hr>
				<input type="submit" value="Register" class="btn btn-success btn-large justify-content-center">
			</div>
		</form>
        <?php if (isset($error)): 
            echo "<hr><div class='alert alert-danger justify-content-center'><strong>$error</strong></div>";    
        ?>
        <?php endif; ?>
	</div>
</body>
</html>