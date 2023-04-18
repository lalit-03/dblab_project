<?php
if(!isset($_GET['id'])){
    die();
}
$stud_id=$_GET['id'];
include "student_boiler.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;">
    <div class="container-fluid p-5 bg-primary text-white text-center">
        <h1>Change your password</h1>
        <p>Enter you old and new password to change it.</p>
    </div>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="student_page.php">Profile</a>
            
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="student_passwd.php?id=<?php echo $_SESSION['username']?>">Change Password</a>
                <!-- <a class="nav-link active" href="company_page.php">Create Offers</a> -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_role_applications.php?id=<?php echo $_SESSION['username'] ?>">Check Eligible Roles</a>
                <!-- <a class="nav-link" href="company_roles.php">Previous Offers</a> -->
            </li>
            <li>
                <a class="nav-link" href="logout_testing.php">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="statistics.php">Placement Statistics</a>
                </li>
        </ul>
    </nav>
    <div class="container mt-4">
    <form class="form-horizontal" action="./student_change_password.php" method="POST">
    <div class="form-group">
        <div class="row gy-6">
        <input type='hidden' name='id' value='<?php echo $stud_id;?>'/>
        <label class="form-label">Old Password:</label>
            <input type="password" class="form-control form-control-lg" name='old'/>
        </div>
    </div>
    <br>
    <div class="form-group">
        <div class="row gy-6">
        <label class="form-label">New Password:</label>
            <input type="password" class="form-control form-control-lg" name='new'/>
        </div>
    </div>
    <br><br>
    <div class="row gy-6">
        <input type="submit" value="Change Password" class="btn btn-primary btn-large justify-content-center">
        <!-- <input type='submit' class="btn btn-primary" value="Change Password"/> -->
    </div>
    </form>

    </div>
</body>
</html>