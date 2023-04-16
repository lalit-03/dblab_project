<?php
require_once "admin_boiler.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Roles</title>
	<script>
		function show_roles() {
			var table = document.getElementById("table");
			var button = document.getElementById("role_data");
			if (table.style.display === "none") {
				table.style.display = "table";
				button.innerHTML = "Hide Table";
			} else {
				table.style.display = "none";
				button.innerHTML = "Show Table";
			}
		}

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

        function hideEditForm(id) {
			var form = document.getElementById("editForm");
			var roleRow = document.getElementById("role_" + id);
			form.style.display = "none";
			roleRow.style.display = "table-row";
		}
	</script>
</head>
<body>
	<button id="role_data" onclick="show_roles()">Show Table</button>
	
	<table id="table" style="display: none" border=1>
		<tr>
			<th>ID</th>
			<th>Company</th>
            <th>Role Name</th>
			<th>Min CPI</th>
			<th>Min Qualification</th>
			<th>Role Description</th>
            <th>Mode of Interview</th>
            <th>CTC</th>
            <th>Sector</th>
            <th>Eligible Batches</th>
		</tr>
		<?php
            $sql = "SELECT * FROM Roles ORDER BY `company_username`";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr id='role_" . $row["role_id"] . "'><td>" . $row["role_id"]. "</td><td>" . $row["company_username"]. "</td><td>" . $row["Role_Name"]. "</td><td>" . $row["min_cpi"]. "</td><td>" . $row["min_qualification"]. "</td>
                        <td>" . $row["description"]. "</td><td>" . $row["mode_of_interview"]. "</td><td>" . $row["ctc"]. "</td><td>" . $row["Sector"]. "</td><td>" . $row["batch"]. "</td>
                        <td><button onclick=showEditForm('" . $row["role_id"] . "')>Edit</button></td>
                        <td><form action='' method='POST' onsubmit='return confirmDelete()'><input type='hidden' name='role_id' value='" . $row['role_id'] . "'/><input type='submit' name='delete' value='Delete'/></form></td></tr>";
                }
            } else {
                echo "0 results";
            }
            if(isset($_POST['delete'])) {
				$id = $_POST['role_id'];
                $del_offers = "DELETE FROM `offers` where `role_id` = '$id'";
                if ($conn->query($del_offers) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
                $del_role = "DELETE FROM `roles` WHERE `role_id` = '$id'";
				if ($conn->query($del_role) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
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
				$update_role = "UPDATE `roles` set `Role_Name` = '$role_name', `min_cpi` = '$role_cpi', 
                                `min_qualification` = '$role_qual', `description` = '$role_desc' ,
                                `mode_of_interview` = '$role_interview', `ctc` = '$role_ctc', `sector` = '$role_sector',
                                `batch` = '$role_batch' WHERE `role_id` = '$id'";
				if ($conn->query($update_role) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
			}			

			?>
			<div class='container' id = 'temp' style = 'display:none'>
            <form method="POST" id = 'edit_form' action = ''>
				<h3>Edit Role</h3>
                <label> Role ID: </label> <span id = 'show_ID'></span> <br>
				<input type="hidden" name="role_id"/>
                <label> Role Company: </label> <span id = 'show_role_company'></span> <br>
                <input type="hidden" name="role_company"/>
				<label>Role Name:</label> &emsp;
				<input type="text" name="new_role_name"><br>
				<label>Min CPI:</label> &emsp;
				<input type="text" name="new_role_cpi"><br>
				<label>Min Qualification:</label> &emsp;
				<input type="text" name="new_role_qual"><br>
				<label>Role Description:</label> &emsp;
				<input type="text" name="new_role_desc"><br>
				<label>Mode Of Interview:</label> &emsp;
				<input type="text" name="new_role_interview"><br>
				<label>CTC:</label> &emsp;
				<input type="text" name="new_role_ctc"><br>
				<label>Sector:</label> &emsp;
				<input type="text" name="new_role_sector"><br>
				<label>Eligible Batch:</label> &emsp;
				<input type="text" name="new_role_batch"><br>
				<input type="submit" name="update" value="update">
				<button onclick="hideEditForm()">Cancel</button>
            </form>
			</div>

	</table>
</body>
</html>
