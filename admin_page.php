<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
    if($_SESSION['user_type'] != 'admin'){
        $message=urlencode("Unauthorized Access!");
        header("Location:login.php?message=".$message);
    }

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'dblab_project';

    $conn = new mysqli($host, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        if (isset($_POST['query'])) {
            $query = $_POST['query'];
            if ($result = $conn->query($query)) {
                if ($result->num_rows > 0) {
                    $output = "";
                    $output .= '<table class="table table-dark table-striped">';
                    $output .= '<thead><tr>';
                    while ($field = $result->fetch_field()) {
                        $output .= '<th>' . $field->name . '</th>';
                    }
                    $output .= '</tr></thead>';
                    $output .= '<tbody>';
                    while ($row = $result->fetch_assoc()) {
                        $output .= '<tr>';
                        foreach ($row as $value) {
                            $output .= '<td>' . $value . '</td>';
                        }
                        $output .= '</tr>';
                    }
                    $output .= '</tbody></table>';
                } else {
                    $output = "";
                    $output .= '<div class="alert alert-info">Query executed successfully but no rows returned.</div>';
                }
            } else {
                $output = "";
                $output .= '<div class="alert alert-danger">Query execution failed: ' . $conn->error . '</div>';
            }
        }
    } catch (Exception $e) {
        $output = "";
        $output .= '<div class="alert alert-danger"><strong>MySQL fatal exception:</strong> '. $e->getMessage() . '</div>';
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
            <h1 class="display-1">Terminal</h1>
            <p>Enter mysql query and hit the execute button</p>
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
			<ul class="navbar-nav">
			  <li class="nav-item">
			    <a class="nav-link active" href="admin_page.php">Terminal</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="filter.php">Filter Page</a>
			  </li>
			</ul>
	    </nav>
        </div>
        
        <div class="container mt-3">
            <form method="POST">
            <div class = "row gy-6">
                <div class="form-group">
                    <label for="query" class="form-label" style="color: white;">Enter MySQL query:</label>
                    <textarea class="form-control" id="query" name="query" rows="8" style="border: 2px solid #ffffff; border-radius: 4px; background-color:#171414; font-size:30px; color:green;"></textarea>
                </div>
            </div>
            <br>
            <div class="row gy-6">
                <button type="submit" class="btn btn-danger btn-large justify-content-center">Execute</button>
            </div>
            </form>
            <br>
            <?php
            if(isset($output))
                echo $output;
            ?>
        </div>
        <a href="./admin_student_list.php"><button class="btn btn-primary">Student List</button></a>
    </body>
</html>
