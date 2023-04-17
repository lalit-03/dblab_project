<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
    if($_SESSION['user_type'] != 'company'){
        $message=urlencode("Unauthorized Access!");
        header("Location:login.php?message=".$message);
    }

    $host = 'localhost';
    $username = 'test';
    $password = 'test';
    $database = 'dblab_project';

    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit();
    }
    elseif (isset($_POST['offer_ids'])) {
        $offer_ids = $_POST['offer_ids'];
        foreach ($offer_ids as $offer_id) {
            $sql = "UPDATE Offers SET selected=1 WHERE id=".$offer_id;
            if ($conn->query($sql) != TRUE) {
                $output = "<div class='alert alert-danger'>Error executing SQL query: " . $conn->error . "</div>" . $conn->error;
            }
        }
    }
    else {
        $output = "";
        $elig = 0;
        $sql = "SELECT id AS offer_id, role_id, student_name, (IF(sem1_spi > 0, sem1_spi, NULL) + IF(sem2_spi > 0, sem2_spi, NULL) + IF(sem3_spi > 0, sem3_spi, NULL) + IF(sem4_spi > 0, sem4_spi, NULL) + IF(sem5_spi > 0, sem5_spi, NULL) + IF(sem6_spi > 0, sem6_spi, NULL) + IF(sem7_spi > 0, sem7_spi, NULL) + IF(sem8_spi > 0, sem8_spi, NULL)) / ((sem1_spi > 0) + (sem2_spi > 0) + (sem3_spi > 0) + (sem4_spi > 0) + (sem5_spi > 0) + (sem6_spi > 0) + (sem7_spi > 0) + (sem8_spi > 0)) AS CPI, marks_10, marks_12, DoB, RollNumber 
            FROM Student 
            NATURAL JOIN Offers 
            WHERE Offers.selected = 0 order by CPI";
        if ($result = $conn->query($sql)) {
            $output .= "<form method='POST' action='selection_company.php'>";
            $output .= "<table class='table'>";
            $output .= "<thead><tr>";
            $output .= "<th>Select</th>";
            $elig = $result->num_rows;
            while ($field = $result->fetch_field()) {
                $output .= "<th>" . $field->name . "</th>";
            }
            $output .= "</tr></thead>";

            $output .= "<tbody>";
            while ($row = $result->fetch_assoc()) {
                $output .= "<tr>";
                $output .= "<td><input type='checkbox' name='offer_ids[]' value='" . $row['offer_id'] . "'></td>";
                foreach ($row as $key => $value) {
                    $output .= "<td>" . $value . "</td>";
                }
                $output .= "</tr>";
            }
            $output .= "</tbody></table>";
            $output .= "<button type='submit' class='btn btn-primary'>Submit</button>";
            $output .= "</form>";
        } else {
            $output .= "<div class='alert alert-danger'>Error executing SQL query: " . $conn->error . "</div>";
        }
        
    }
    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Select Students</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;">
	<div class="container-fluid p-5 bg-primary text-white text-center">
		<h1 class="display-1">Select Students</h1>
		<p>Select students who applied for your offers.</p>
	</div>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="company_page.php">Create Offers</a>
                </li>
                <li class="nav-item">
                    <a class = "nav-link active" href="selection_company.php">Select Students</a>
                </li>
                <li class = "navbar-nav">
                    <a class="nav-link" href="edit_company.php">Edit Profile</a>
                </li>
            </ul>
	</nav>
    <?php
            if(isset($message)){
                echo $message;
            }
    ?>
    <div class="container mt-3">
		
        <?php 
        if (isset($output) && $elig > 0){
            echo $output;    
        }
        else {
            echo "<div class='alert alert-info' style='text-align: center;'><strong>No students to chose from.<strong></div>            ";
        }
        ?>
	</div>
</body>

</html>