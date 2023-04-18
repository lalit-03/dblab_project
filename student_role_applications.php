<?php
if(!isset($_GET['id'])){
    die();
}
$stud_id=$_GET['id'];
include "student_boiler.php";

$stud = $conn->query("select (IF(sem1_spi > 0, sem1_spi, 0) + IF(sem2_spi > 0, sem2_spi, 0) + IF(sem3_spi > 0, sem3_spi, 0) + IF(sem4_spi > 0, sem4_spi, 0) + IF(sem5_spi > 0, sem5_spi, 0) + IF(sem6_spi > 0, sem6_spi, 0) + IF(sem7_spi > 0, sem7_spi, 0) + IF(sem8_spi > 0, sem8_spi, 0)) / ((sem1_spi > 0) + (sem2_spi > 0) + (sem3_spi > 0) + (sem4_spi > 0) + (sem5_spi > 0) + (sem6_spi > 0) + (sem7_spi > 0) + (sem8_spi > 0)) AS CPI, username, ifnull(ctc,0) as ctc1 from Student where username='".$_GET['id']."';");
if($stud->num_rows==0)die();
$res = $stud->fetch_assoc();
$cpi = $res["CPI"];
$eligible = $conn->query("select company_name,role_id,Role_Name,min_cpi,description,mode_of_interview,ctc from Roles natural join Company where min_cpi<=".$cpi." and ctc>=".$res['ctc1']." order by ctc desc;");
if($eligible->num_rows > 0){
    $output = '';
while ($row = $eligible->fetch_assoc()) {
    $ress1 = $conn->query("select count(*) as c from Offers where username='" . $_GET['id'] . "' and role_id=" . $row['role_id'] . ";");
    $q1 = $ress1->fetch_assoc();
    $exists = $q1['c'];
    $output .= "<div class='card'>
                    <div class='card-body text-center'>
                        <input type='hidden' name='role".$row['role_id']."' value='No'/>
                        <input type='checkbox' name='role".$row['role_id']."' ".($exists?"checked='checked'":"")." value='Yes'/> 
                        <h5 class='card-title'>Company: " . $row['company_name'] . "</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>Role: " . $row['Role_Name'] . "</h6>
                        <p class='card-text'>Description: " . $row['description'] . "</p>
                        <p class='card-text'>Mode of interview: " . ($row['mode_of_interview'] ? "Online" : "Offline") . "</p>
                        <p class='card-text'>CTC: " . $row['ctc'] . "</p>
                    </div>
                </div><br>";
}
}else{
    $output = "<div class='alert alert-danger text-center'><strong>No roles elligible</strong></div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Eligible Roles</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;">
<div class="container-fluid p-5 bg-primary text-white text-center">
        <h1>Elligible Roles</h1>
        <p>Check and select roles you are elligible for.</p>
    </div>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="student_page.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="student_passwd.php?id=<?php echo $_SESSION['username']?>">Change Password</a>
                <!-- <a class="nav-link active" href="company_page.php">Create Offers</a> -->
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="student_role_applications.php?id=<?php echo $_SESSION['username'] ?>">Check Eligible Roles</a>
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
    <br>
    <?php
        if(isset($output))
            echo $output;
    ?>
    <div class="row gy-6">
    <form action="./apply.php" method="POST">
        <input type='hidden' name='id' value='<?php echo $res['username']; ?>'/>
    <div class="row gy-6">
        <input type="submit" value="OK" class="btn btn-primary btn-large justify-content-center">
    </div>
    </form>
    </div>
    </div>
</body>
</html>