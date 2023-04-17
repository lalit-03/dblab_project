
<?php
// Connect to the MySQL database
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
if($_SESSION['user_type'] != 'company'){
    $message=urlencode("Unauthorized Access!");
    header("Location:login.php?message=".$message);
}
$host = "localhost";
$username = "test";
$password = "test";
$conn = mysqli_connect($host, $username, $password);

    $com_usrnm = $_SESSION['username'];
    $user_query = "SELECT company_name, company_email, password, hiring_since_when FROM dblab_project.Company WHERE company_username='$com_usrnm'";
    $result = mysqli_query($conn, $user_query);

    $row = mysqli_fetch_assoc($result);
    $comp_name = $row['company_name'];
    $com_email = $row['company_email'];
    $com_password = $row['password'];
    $com_when = $row['hiring_since_when'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the submitted form data
        $new_company_name = $_POST["company_name"];
        $new_email = $_POST["email"];
        $new_when = $_POST["when"];
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
    
        // Get the current company details from the database
        $user_query = "SELECT * FROM dblab_project.Company WHERE company_username='$com_usrnm'";
        $result = mysqli_query($conn, $user_query);
    
        // Check if there is a result
        if ($result && mysqli_num_rows($result) > 0) {
    
            // Get the current company details
            $row = mysqli_fetch_assoc($result);
            $com_name = $row['company_name'];
            $com_email = $row['company_email'];
            $com_password = $row['password'];
            $com_when = $row['hiring_since_when'];
    
            // Check if the old password matches
            if ($old_password == $com_password) {
    
                // Update the company details
                $update_query = "UPDATE dblab_project.Company SET company_name='$new_company_name', company_email='$new_email', hiring_since_when='$new_when'";
                
                // Check if a new password was submitted
                if (!empty($new_password)) {
    
                    $update_query .= ", password='$new_password'";
                }
                // Add the WHERE clause to update only the current company
                $update_query .= " WHERE company_username='$com_usrnm'";
                // Execute the update query
                if (mysqli_query($conn, $update_query)) {
                    // Redirect to the dashboard page
                    $message=urlencode("Update Successful!");
                    header("Location:company_page.php?message=".$message);
                    exit();
                } else {
                    // Display an error message
                    $output= "<div class='alert alert-danger justify-content-center text-center'><strong>Error updating company details:" . mysqli_error($conn) . "</strong></div>";
                }
    
            } else {
                // Display an error message
                $output= "<div class='alert alert-danger justify-content-center text-center'><strong>Incorrect old password</strong></div>";
            }
    
        } else {
            // Display an error message
            $output = "<div class='alert alert-danger justify-content-center text-center'><strong>Error fetching company details: " . mysqli_error($conn) . "</strong></div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Company Edit Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:powderblue;">
	<div class="container-fluid p-5 bg-primary text-white text-center">
		<h1 class="display-1">Company Edit Form</h1>
		<p>Edit company name, email, hiring since when and password.</p>
	</div>
	<nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="company_page.php">Create Offers</a>
                </li>
                <li class="nav-item">
                    <a class = "nav-link" href="selection_company.php">Select Students</a>
                </li>
                <li class = "navbar-nav">
                    <a class="nav-link active" href="edit_company.php">Edit Profile</a>
                </li>
            </ul>
	</nav>
    
	<div class="container mt-3">
        <?php
            if(isset($output)) {
                echo $output;
            }
        ?>
		<form action="edit_company.php" method="post">
			<div class="row gy-3">
                <div class="col">
					<label for="company_name" class="form-label">Company Name:</label>
					<input class="form-control form-control-lg" type="text" name="company_name" required placeholder="<?php echo $comp_name; ?>">
                </div>
			</div>
            <br>
			<div class="row gy-6">
                <div class="col">
	    			<label for="email" class="form-label">Email:</label>
		    		<input class="form-control" type="email" name="email" required placeholder="<?php echo $com_email; ?>">
                </div>
                <div class="col">
	    			<label for="when" class="form-label">Hiring since when:</label>
		    		<input class="form-control" type="number" name="when" step="1" required placeholder="<?php echo $com_when; ?>">
                </div>
			</div>
            <br>
			<div class="row gy-6">
                <div class="col">
                    <label for="old_password" class="form-label">Old Password:</label>
                    <input class="form-control form-control-md"  type="password" name="old_password" required placeholder="Old Password">
                </div>
                <div class="col">
                    <label for="new_password" class="form-label">New / Repeat Password:</label>
                    <input class="form-control form-control-md" type="password" name="new_password" required placeholder="New / Repeat Password">
                </div>

			</div>
            <br>
			<div class="row gy-6">
				<br>
				<input type="submit" value="Update" class="btn btn-success btn-large justify-content-center">
			</div>
		</form>
        <?php if (isset($error)): 
            echo "<br><div class='alert alert-danger justify-content-center'><strong>$error</strong></div>";    
        ?>
        <?php endif; ?>
	</div>
</body>
</html>