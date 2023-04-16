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

    
    if (isset($_POST['query'])) {
        
        $query = $_POST['query'];

        
        if ($result = $conn->query($query)) {
            
            if ($result->num_rows > 0) {
                $output = "";
                $output .= '<table class="table">';
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
    <body>
        <div class="container mt-4">
            <form method="POST">
                <div class="form-group">
                    <label for="query">Enter MySQL query:</label>
                    <textarea class="form-control" id="query" name="query" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Execute</button>
            </form>
        </div>
        <a href="./admin_student_list.php"><button class="btn btn-primary">Student List</button></a>
    </body>
</html>
<?php
    if(isset($output))
        echo $output;
?>
