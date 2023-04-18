<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
    if($_SESSION['user_type'] != 'admin'){
        $message=urlencode("Unauthorized Access! How dare you 😡");
        header("Location:login.php?message=".$message);
    }

    $host = 'localhost';
    $username = 'test';
    $password = 'test';
    $database = 'dblab_project';

    $conn = new mysqli($host, $username, $password, $database);
    $output="";
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $page=1;
    $batch="";
    $branch="";
    if(isset($_GET['page_no']))$page=$_GET['page_no'];
    if(isset($_GET['batch']))$batch=$_GET['batch'];
    if(isset($_GET['branch']))$branch=$_GET['branch'];
    $result = $conn->query("select student_name, RollNumber, username, student_email from Student ".($batch!=""||$branch!=""?(" where ".($batch!=""?"batch = ".$batch." ":"").($batch!=""&&$branch!=""?" and ":"").($branch!=""?" branch='".$branch."' ":"")):"") ." order by RollNumber limit 100 offset ".(100*($page-1)).";");
    if($result->num_rows > 0){
        $output .= "<table class='table table-dark table-stripe table-hover'><thead><tr><th>Name</th><th>Roll Number</th><th>Email</th></tr></thead><tbody>";
        while($row = $result->fetch_assoc()){
            $output .= "<tr><td><a href='./student_details.php?id=". $row['username'] ."'>". $row['student_name'] . "</a></td><td>". $row['RollNumber'] ."</td><td>". $row['student_email'] ."</td></tr>";
        }
        $output .= "</tbody></table>";
    } else {
        $output = "No data available";
    }
    
$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MySQL Console</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">    
        <script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body style="background-color:#000000;">
    <div class="container-fluid p-5 bg-dark text-white text-center border">
            <h1 class="display-1">Student List</h1>
            <p>Analyse, Edit, Delete Student Records.</p>
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
        <div class="container mt-3">
            <form action='./admin_student_list.php' method="GET">
                <div class = "row gy-6">
                    <div class = "col">
                        <label for="batch" class="form-label" style="color: white;">Batch:</label>
                        <input class="form-control form-control-md" name='batch' type='number' value="<?php echo $batch;?>"/>
                    </div>
                    <div class = "col">
                        <label for="branch" class="form-label" style="color: white;">Branch:</label>
                        <input class="form-control form-control-md" name='branch' type='text' value="<?php echo $branch;?>"/>
                    </div>
                </div>
                <br>
                <div class="row gy-6">
                    <div class = "col">
                        <div class = "row gy-6">
                            <button type="submit" class="btn btn-danger btn-lg justify-content-center">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <?php echo $output;?></br>
            <?php 
                echo '<div class="row gy-6 justify-content-center">';
                echo "<div class='col-md-4 text-center'><div class='alert alert-info'><strong>Page Number: ".$page."</strong></div></div>";

                if($page>1){
                    echo "<div class='col-md-4 text-right'><a href='./admin_student_list.php?page_no=".($page-1)."&batch=".$batch."&branch=".$branch."'><button type='button' class='btn btn-primary btn-lg'> <-Previous Page</button></a></div>";
                }
                if($result->num_rows == 100){
                    echo "<div class='col-md-4 text-left'><a href='./admin_student_list.php?page_no=".($page+1)."&batch=".$batch."&branch=".$branch."'><button type='button' class='btn btn-primary btn-lg'>Next Page -> </button></a></div>";
                }
                echo '</div>';
            ?>
        </div>
    </body>
</html>