<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
    if($_SESSION['user_type'] != 'company'){
        $message=urlencode("Unauthorized Access!");
        header("Location:login.php?message=".$message);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $host = 'localhost';
        $username = 'test';
        $password = 'test';
        $database = 'dblab_project';
    
        $conn = new mysqli($host, $username, $password, $database);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            exit();
        }
        else {
            $company_username = $_SESSION['username'];
            $role = $_POST['role'];
            $description = $_POST['description'];
            $mincpi = $_POST['mincpi'];
            $degree = $_POST['degree'];
            $sector = $_POST['sector'];
            $mode = $_POST['mode'];
            $ctc = $_POST['ctc'];
            $batch = $_POST['batch'];

            // echo $company_username;
            // echo $role;
            // echo $description;
            // echo $mincpi;
            // echo $degree;
            // echo $sector;
            // echo $mode;
            // echo $ctc;
            // echo $batch;
            if(empty($company_username) || empty($role) || empty($description) || empty($mincpi) || empty($degree) || empty($sector) || empty($mode) || empty($ctc) || empty($batch)) {
                $error="Please fill out all the required fields.<br>";
            }
            else {
                $sql = "INSERT INTO dblab_project.Roles (company_username, Role_Name, min_cpi, min_qualification, description, mode_of_interview, ctc, Sector, batch) values ('$company_username', '$role', $mincpi, '$degree', '$description', $mode, $ctc, '$sector', $batch)";
                if (mysqli_query($conn, $sql)) {
                    $message = "<div class='alert alert-info justify-content-center text-center'><strong>Offer Added!</strong></div>";
                }
                else {
                    $error="Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Company Portal</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;">
	<div class="container-fluid p-5 bg-primary text-white text-center">
		<h1 class="display-1">Create Offers</h1>
		<p>Fill the form to create an offer for the students.</p>
	</div>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="company_page.php">Create Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="company_roles.php">Previous Offers</a>
                </li>
                <li class="nav-item">
                    <a class = "nav-link" href="selection_company.php">Select Students</a>
                </li>
                <li class = "navbar-nav">
                    <a class="nav-link" href="edit_company.php">Edit Profile</a>
                </li>
                <li class = "navbar-nav">
                    <a class="nav-link" href="logout_testing.php">Logout</a>
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
		<form action="company_page.php" method="post">
			<div class="row gy-6">
                <label for="role" class="form-label">Role Title:</label>
                <input class="form-control form-control-lg" type="text" name="role" required placeholder="Role Title">
			</div>
            <br>
            <div class="row gy-6">
                <label for="description" class="form-label">Brief Role Description (255 characters):</label>
                <textarea class="form-control" id="description" name="description" rows="3" style="border: 2px; border-radius: 6px;"></textarea>
            </div>
            <br>
			<div class="row gy-6">
                <div class="col">
                    <label for="mincpi" class="form-label">Minimum CPI:</label>
                    <input class="form-control form-control-md" type="number" step="0.01" name="mincpi" required placeholder="eg.- 7.50">
                </div>
                <div class="col">
                    <label for="degree" class="form-label">Qualification:</label>
                    <select name="degree" id="degree" class="form-control form-control-sm">
                        <option value="BTech/BSc">BTech. / BSc.</option>
                        <option value="MTech/MSc">MTech. /MSc.</option>
                        <option value="PhD">PhD.</option>
                    </select>
                </div>
                <div class="col">
                    <label for="batch" class="form-label">Batch:</label>
                    <input class="form-control form-control-md" type="batch" step="1" name="batch" required placeholder="eg.- 2023">
                </div>
			</div>
            <br>
            <div class="row gy-6">
                <div class="col">
                    <label for="sector" class="form-label">Sector:</label>
                    <input class="form-control form-control-md" type="text" name="sector" required placeholder="eg.- Finance">
                </div>
                <div class="col">
                    <label for="mode" class="form-label">Mode of Interview:</label>
                    <select name="mode" id="mode" class="form-control form-control-md">
                        <option value=1>Offline</option>
                        <option value=2>Online</option>
                    </select>
                </div>
                <div class="col">
                    <label for="ctc" class="form-label">Offered CTC:</label>
                    <input class="form-control form-control-md" type="number" name="ctc" required placeholder="eg.- 1200000">
                </div>
			</div>
            <br>
			<div class="row gy-6">
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