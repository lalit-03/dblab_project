<?php
require_once "admin_boiler.php";
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Company</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">    
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// function show_company() {
		// 	var table = document.getElementById("table");
		// 	var button = document.getElementById("tcompany_data");
		// 	if (table.style.display === "none") {
		// 		table.style.display = "table";
		// 		button.innerHTML = "Hide Table";
		// 	} else {
		// 		table.style.display = "none";
		// 		button.innerHTML = "Show Table";
		// 	}
		// }

        function confirmDelete() {
			return confirm("Are you sure you want to delete this company? All Roles and Offers will also be deleted along with it.");
		}

        function showEditForm(id) {
			var form_div = document.getElementById("temp");
			if (form_div.style.display === "none") {
            	form_div.style.display = "block";
        	}
			var companyRow = document.getElementById("company_" + id);
			var companyUserName = companyRow.cells[0].innerHTML;
			var companyName = companyRow.cells[1].innerHTML;
			var companyEmail = companyRow.cells[2].innerHTML;
			var companyHiring = companyRow.cells[3].innerHTML;
			var companyPassword = companyRow.cells[4].innerHTML;
			var form = document.getElementById('edit_form');
			document.getElementById('show_username').innerHTML = companyUserName;
			form.elements["company_username"].value = companyUserName;
			form.elements["new_company_name"].value = companyName;
			form.elements["new_company_email"].value = companyEmail;
			form.elements["new_company_hiring_since_when"].value = companyHiring;
			form.elements["new_password"].value = companyPassword;
			form.style.display = "block";
		}

        function hideEditForm() {
			var form = document.getElementById("temp");
			// var companyRow = document.getElementById("company_" + id);
			form.style.display = "none";
			// companyRow.style.display = "table-row";
		}
	</script>
</head>
<body style="background-color:#000000;">
	<div class="container-fluid p-5 bg-dark text-white text-center border">
				<h1 class="display-1">Company List</h1>
				<p>Analyse, Edit, Delete Company Records.</p>
				<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
				<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="admin_page.php">Terminal</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="admin_student_list.php">Student List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="admin_company.php">Companies</a>
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
	<br>
	<div class="container mt-3">
		<!-- <div class="row gy-6">
			<button id="company_data" onclick="show_company()" type="submit" class="btn btn-danger btn-large justify-content-center">Show Table</button>
		</div>
		<br> -->
	<!-- <button id="company_data" onclick="show_company()">Show Table</button> -->
	
	<table class='table table-dark table-stripe table-hover' id="table">
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>E-Mail</th>
			<th>Hiring Since</th>
			<th>Password</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php
            $sql = "SELECT * FROM Company";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr id='company_" . $row["company_username"] . "'><td>" . $row["company_username"]. "</td><td>" . $row["company_name"]. "</td><td>" . $row["company_email"]. "</td><td>" . $row["hiring_since_when"]. "</td><td>" . $row["password"]. "</td>
                        <td><button class='btn btn-outline-warning' onclick=showEditForm('" . $row["company_username"] . "')>Edit</button></td>
                        <td><form action='' method='POST' onsubmit='return confirmDelete()'><input type='hidden' name='company_username' value='" . $row['company_username'] . "'/><button type='submit' name='delete' class='btn btn-outline-danger'>Delete</button></form></td></tr>";
                }
            } else {
                echo "0 results";
            }
            if(isset($_POST['delete'])) {
				$id = $_POST['company_username'];
                $del_offers = "DELETE FROM `Offers` where `role_id` in (select `id` from `Roles` WHERE `company_username` = '$id')";
                if ($conn->query($del_offers) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
                $del_roles = "DELETE FROM `roles` WHERE `company_username` = '$id'";
				if ($conn->query($del_roles) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
				$sql = "DELETE FROM `Company` WHERE `company_username` = '$id'";
				if ($conn->query($sql) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
					ob_end_flush();
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
			}

			if(isset($_POST['update'])){
				$id = $_POST['company_username'];
				$company_name = $_POST['new_company_name'];
				$company_email = $_POST['new_company_email'];
				$hiring_since_when = $_POST['new_company_hiring_since_when'];
				$password = $_POST['new_password'];
				$update_company = "UPDATE `Company` set `company_name` = '$company_name', `company_email` = '$company_email', `hiring_since_when` = '$hiring_since_when', `password` = '$password' WHERE `company_username` = '$id'";
				if ($conn->query($update_company) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
					ob_end_flush();
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
			}			
			?>
			<div class='container text-white' id = 'temp' style = 'display:none'>
            <form method="POST" id = 'edit_form' action = ''>
				<h3>Edit Company:</h3>
				<div class='form-group'>
					<label> Company Username: </label> <span id='show_username' class='text-white'></span> 
					<input type='hidden' class='form-control' name='company_username'/>
				</div>
				<div class='form-group'>
					<label>Name:</label>
					<input type="text" class='form-control' name="new_company_name">
				</div>
				<div class='form-group'>
					<label>E-mail:</label>
					<input type="text" class='form-control' name="new_company_email">
				</div>
				<div class='form-group'>
					<label>Hiring Since When:</label>
					<input type="text" class='form-control' name="new_company_hiring_since_when">
				</div>
				<div class='form-group'>
					<label>Password</label>
					<input type="text" class='form-control' name="new_password"><br>
				</div>
				<button type='submit' class='btn btn-primary' name='update'>Update</button>
				<button type='button' class='btn btn-secondary' onclick='hideEditForm()'>Cancel</button><br>
            </form>
			</div>
	</table>
	</div>
</body>
</html>
