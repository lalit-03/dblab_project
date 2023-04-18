<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    // Connect to the MySQL database
    $db_host = 'localhost';
    $db_user = 'test';
    $db_password = 'test';
    $db_name = 'dblab_project';
    
    $db = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($type == 'admin') {
        $sql = "SELECT * FROM admin WHERE username='$username'";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = 'admin';
                header("Location: admin_page.php");
            }
        }
        // echo $_SESSION['first_name'] . $_SESSION['last_name'];
        // Authentication failed
        $error = 'Invalid admin username or password';
    }
    
    elseif ($type == 'company') {
        $sql = "SELECT company_username, password FROM Company WHERE company_username='$username'";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                $_SESSION['username'] = $row['company_username'];
                $_SESSION['user_type'] = 'company';
                header("Location: company_page.php");
            }
        }

        $error = 'Invalid company username or password';
    }

    elseif ($type == 'student') {
        $sql = "SELECT username, password FROM Student WHERE username='$username'";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = 'student';
                header("Location: student_page.php");
            }
        }
        // echo $_SESSION['first_name'] . $_SESSION['last_name'];
        // Authentication failed
        $error = 'Invalid student username or password';
    }
    else {
        $sql = "SELECT username, password FROM Alumni WHERE username='$username'";
        $result = $db->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = 'alumni';
                header("Location: alumni_page.php");
            }
        }
        // echo $_SESSION['first_name'] . $_SESSION['last_name'];
        // Authentication failed
        $error = 'Invalid student username or password';
    }
    // echo $_SESSION['first_name'] . $_SESSION['last_name'];
    // Authentication failed
}

// Display the login form
?>

<!-- <?php
    if(isset($_GET['message'])){
        echo $_GET['message'];
    }
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Portal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:#42f5b0;">
    <div class="container-fluid p-5 bg-success text-white text-center">
		<h1 class="display-1">Login Portal</h1>
		<p>Select your profile type and enter your username and password to login.</p>
	</div>
    <nav class="navbar navbar-expand-sm bg-success navbar-dark justify-content-center">
		
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link active" href="login.php">Login Page</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="student_registration.php">Student Registration</a>
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
	<div class="container mt-3">
        <?php
            if(isset($_GET['message'])){
                $msg = $_GET['message'];
                echo "<div class='alert alert-info justify-content-center text-center'><strong>$msg</strong></div>";
            }
        ?>
        <form method="post" action="login.php">
            <div style = "display: flex; flex-direction: row; justify-content: center; gap: 50px">
                <div class="form-check" >
                    <input type="radio" class="form-check-input" id="admin" name="type" value="admin" checked>
                    <label class="form-check-label" for="admin">Admin</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="company" name="type" value="company">
                    <label class="form-check-label" for="company">Company</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="student" name="type" value="student">
                    <label class="form-check-label" for="student">Student</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="alumni" name="type" value="alumni">
                    <label class="form-check-label" for="alumni">Alumni</label>
                </div>
            </div>
            <br>
            <div class="row gy-6">
                <label for="username" class="form-label">Username:</label>
				<input class="form-control form-control-lg" type="username" name="username" required placeholder="Enter your username">
            </div>
            <br>
            <div class="row gy-6">
				<label for="password" class="form-label">Password:</label>
				<input class="form-control form-control-lg"  type="password" name="password" required placeholder="Enter your password">
			</div>
			<div class="row gy-6">
                <hr>
                <input type="submit" value="Login" class="btn btn-success btn-large justify-content-center">
            </div>
        </form>
        <?php if (isset($error)): 
            echo "<hr><div class='alert alert-danger text-center'><strong>$error</strong></div>";    
        ?>
        <?php endif; ?>
    </div>
</body>

</html>
