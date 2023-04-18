<?php
require_once "company_boiler.php";
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Roles</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">    
	<script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// function show_roles() {
		// 	var table = document.getElementById("table");
		// 	var button = document.getElementById("role_data");
		// 	if (table.style.display === "none") {
		// 		table.style.display = "table";
		// 		button.innerHTML = "Hide Table";
		// 	} else {
		// 		table.style.display = "none";
		// 		button.innerHTML = "Show Table";
		// 	}
		// }

        function confirmDelete() {
			return confirm("Are you sure you want to delete this Role? All Roles and Offers will also be deleted along with it.");
		}

        function showEditForm(id) {
			var form_div = document.getElementById("temp");
			if (form_div.style.display === "none") {
            	form_div.style.display = "block";
        	}
			debugger;
			var roleRow = document.getElementById("role_" + id);
			var roleID = roleRow.cells[0].innerHTML;
			var roleCompany = roleRow.cells[1].innerHTML;
            var roleName = roleRow.cells[2].innerHTML;
			var roleCPI = roleRow.cells[3].innerHTML;
			var roleQual = roleRow.cells[4].innerHTML;
			var roleDesc = roleRow.cells[5].innerHTML;
            var roleInterview = roleRow.cells[6].innerHTML;
            var roleCTC = roleRow.cells[7].innerHTML;
            var roleSector = roleRow.cells[8].innerHTML;
            var roleBatch = roleRow.cells[9].innerHTML;
			var form = document.getElementById('edit_form');
			document.getElementById('show_ID').innerHTML = roleID;
			form.elements["role_id"].value = roleID;
            document.getElementById('show_role_company').innerHTML = roleCompany;
			form.elements["role_company"].value = roleCompany;
            form.elements['new_role_name'].value = roleName;
			form.elements["new_role_cpi"].value = roleCPI;
			form.elements["new_role_qual"].value = roleQual;
			form.elements["new_role_desc"].value = roleDesc;
            form.elements['new_role_interview'].value = roleInterview;
            form.elements['new_role_ctc'].value = roleCTC;
            form.elements['new_role_sector'].value = roleSector;
            form.elements['new_role_batch'].value = roleBatch;
			form.style.display = "block";
		}

        function hideEditForm() {
			var form = document.getElementById("temp");
			// var roleRow = document.getElementById("role_" + id);
			form.style.display = "none";
			// roleRow.style.display = "table-row";
		}
	</script>
</head>
<body style="background-color:powderblue;">
<div class="container-fluid p-5 bg-primary text-white text-center">
		<h1 class="display-1">Previous Offers</h1>
		<p>Edit or delete the previous offers created.</p>
	</div>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark justify-content-center">
			<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="company_page.php">Create Offers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="company_roles.php">Previous Offers</a>
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
	<br>
	<div class="container mt-3">
	<!-- <div class="row gy-6">
		<button id="role_data" onclick="show_roles()" class="btn btn-danger btn-large justify-content-center">Show Roles</button>
	</div> -->
	<!-- <br> -->
	
	<table class='table table-striped table-hover' id="table">
		<tr>
			<th>ID</th>
			<th>Company</th>
            <th>Role Name</th>
			<th>Min CPI</th>
			<th>Min Qualification</th>
			<th>Role Description</th>
            <th>Mode of Interview </th>
            <th>CTC</th>
            <th>Sector</th>
            <th>Eligible Batches</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php
            $usr = $_SESSION['username'];
            $sql = "SELECT * FROM Roles where company_username='$usr'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr id='role_" . $row["role_id"] . "'><td>" . $row["role_id"]. "</td><td>" . $row["company_username"]. "</td><td>" . $row["Role_Name"]. "</td><td>" . $row["min_cpi"]. "</td><td>" . $row["min_qualification"]. "</td>
                        <td>" . $row["description"]. "</td><td>" . $row["mode_of_interview"]. "</td><td>" . $row["ctc"]. "</td><td>" . $row["Sector"]. "</td><td>" . $row["batch"]. "</td>
                        <td><button class='btn btn-warning' onclick=showEditForm('" . $row["role_id"] . "')>Edit</button></td>
                        <td><form action='' method='POST' onsubmit='return confirmDelete()'><input type='hidden' name='role_id' value='" . $row['role_id'] . "'/><button class='btn btn-danger' type='submit' name='delete'>Delete</button></form></td></tr>";
                }
            } else {
                echo "0 results";
            }
            if(isset($_POST['delete'])) {
				$id = $_POST['role_id'];
                $del_offers = "DELETE FROM `Offers` where `role_id` = '$id'";
                if ($conn->query($del_offers) === TRUE) {
				    header("Location:admin_page.php");
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
                $del_role = "DELETE FROM `Roles` WHERE `role_id` = '$id'";
				if ($conn->query($del_role) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
					ob_end_flush();
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
			}

			if(isset($_POST['update'])){
				$id = $_POST['role_id'];
				$role_company = $_POST['role_company'];
                $role_name = $_POST['new_role_name'];
				$role_cpi = $_POST['new_role_cpi'];
				$role_qual = $_POST['new_role_qual'];
				$role_desc = $_POST['new_role_desc'];
                $role_interview = $_POST['new_role_interview'];
                $role_ctc = $_POST['new_role_ctc'];
                $role_sector = $_POST['new_role_sector'];
                $role_batch = $_POST['new_role_batch'];
				$update_role = "UPDATE `Roles` set `Role_Name` = '$role_name', `min_cpi` = '$role_cpi', 
                                `min_qualification` = '$role_qual', `description` = '$role_desc' ,
                                `mode_of_interview` = '$role_interview', `ctc` = '$role_ctc', `sector` = '$role_sector',
                                `batch` = '$role_batch' WHERE `role_id` = '$id'";
				if ($conn->query($update_role) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
					ob_end_flush();
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
			}			
			?>
	<div class='container text-white' id='temp' style='display:none'>
    <form method='POST' id='edit_form' action=''>
        <h3 class='text-white'>Edit Role</h3>
        <div class='form-group'>
            <label> Role ID: </label> <span id='show_ID' class='text-white'></span> <br>
            <input type='hidden' name='role_id' />
        </div>
        <div class='form-group'>
            <label> Role Company: </label> <span id='show_role_company' class='text-white'></span> <br>
            <input type='hidden' name='role_company' />
        </div>
        <div class='form-group'>
            <label>Role Name:</label>
            <input type='text' class='form-control' name='new_role_name'>
        </div>
        <div class='form-group'>
            <label>Min CPI:</label>
            <input type='text' class='form-control' name='new_role_cpi'>
        </div>
        <div class='form-group'>
            <label>Min Qualification:</label>
            <input type='text' class='form-control' name='new_role_qual'>
        </div>
        <div class='form-group'>
            <label>Role Description:</label>
            <input type='text' class='form-control' name='new_role_desc'>
        </div>
        <div class='form-group'>
            <label>Mode Of Interview(0:Offline, 1:Online):</label>
            <input type='text' class='form-control' name='new_role_interview'>
        </div>
        <div class='form-group'>
            <label>CTC:</label>
            <input type='text' class='form-control' name='new_role_ctc'>
        </div>
        <div class='form-group'>
            <label>Sector:</label>
            <input type='text' class='form-control' name='new_role_sector'>
        </div>
        <div class='form-group'>
            <label>Eligible Batch:</label>
            <input type='text' class='form-control' name='new_role_batch'>
        </div>
        <button type='submit' class='btn btn-primary' name='update'>Update</button>
        <button type='button' class='btn btn-secondary' onclick='hideEditForm()'>Cancel</button>
    </form>
</div>


	</table>
	</div>
</body>
</html>
