<?php 
include "admin_boiler.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Graduate Batch</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:#000000;">
        <div class="container-fluid p-5 bg-dark text-white text-center border">
            <h1 class="display-1">Terminal</h1>
            <p>Enter mysql query and hit the execute button</p>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link" href="admin_page.php">Terminal</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="admin_student_list.php">Student List</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="admin_company.php">Companies</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link" href="admin_roles.php">Roles</a>
			  </li>
              <li class="nav-item">
				<a class="nav-link active" href="admin_graduate_batch.php">Graduate Current Batch</a>
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
    <div class="container mt-3">
    
    <form action="./admin_student_to_alumni.php" method="POST">
        <!-- Batch to graduate: <input type='number' name='batch'/></br> -->
        <div class="row gy-6">
				<label for="batch" class="form-label" style="color: white;">Batch to Graduate:</label>
				<input class="form-control" type="number" name="batch" required placeholder="eg.- 2023">
			</div>
        <br>
        <div class="row gy-6">
            <button type="submit" class="btn btn-danger btn-large justify-content-center">Graduate!</button>
        </div>
    </form>
    <br>
    <p style="color: white; text-align: center;"><strong>Note:</strong> This will permanently mark students as alumni. Reversing this action is not trivial.</p>
    </div>
</body>
</html>