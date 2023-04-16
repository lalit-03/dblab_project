<?php
require_once "admin_boiler.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Display Data from SQL Table</title>
	<script>
		function show_company() {
			var table = document.getElementById("table");
			var button = document.getElementById("tcompany_data");
			if (table.style.display === "none") {
				table.style.display = "table";
				button.innerHTML = "Hide Table";
			} else {
				table.style.display = "none";
				button.innerHTML = "Show Table";
			}
		}

        function confirmDelete() {
			return confirm("Are you sure you want to delete this company? All Roles and Offers will also be deleted along with it.");
		}

        function showEditForm(id) {
			var form_div = document.getElementById("temp");
			if (form_div.style.display === "none") {
            	form_div.style.display = "block";
        	}
			debugger;
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
			form.elements["new_company_password"].value = companyPassword;
			form.style.display = "block";
		}

        function hideEditForm(id) {
			var form = document.getElementById("editForm");
			var companyRow = document.getElementById("company_" + id);
			form.style.display = "none";
			companyRow.style.display = "table-row";
		}
	</script>
</head>
<body>
	<button id="company_data" onclick="show_company()">Show Table</button>
	
	<table id="table" style="display: none" border=1>
		<tr>
			<th>Username</th>
			<th>Name</th>
			<th>E-Mail</th>
			<th>Hiring Since</th>
			<th>Password</th>
		</tr>
		<?php
            $sql = "SELECT * FROM Company";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr id='company_" . $row["company_username"] . "'><td>" . $row["company_username"]. "</td><td>" . $row["company_name"]. "</td><td>" . $row["company_email"]. "</td><td>" . $row["hiring_since_when"]. "</td><td>" . $row["company_password"]. "</td>
                        <td><button onclick=showEditForm('" . $row["company_username"] . "')>Edit</button></td>
                        <td><form action='' method='POST' onsubmit='return confirmDelete()'><input type='hidden' name='company_username' value='" . $row['company_username'] . "'/><input type='submit' name='delete' value='Delete'/></form></td></tr>";
                }
            } else {
                echo "0 results";
            }
            if(isset($_POST['delete'])) {
				$id = $_POST['company_username'];
                $del_offers = "DELETE FROM `offers` where `role_id` in (select `id` from `roles` WHERE `company_username` = '$id')";
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
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
			}

			if(isset($_POST['update'])){
				$id = $_POST['company_username'];
				$company_name = $_POST['new_company_name'];
				$company_email = $_POST['new_company_email'];
				$hiring_since_when = $_POST['new_company_hiring_since_when'];
				$company_password = $_POST['new_company_password'];
				$update_company = "UPDATE `Company` set `company_name` = '$company_name', `company_email` = '$company_email', `hiring_since_when` = '$hiring_since_when', `company_password` = '$company_password' WHERE `company_username` = '$id'";
				if ($conn->query($update_company) === TRUE) {
				    header("Location: ".$_SERVER['PHP_SELF']);
				} else {
				    echo "Error deleting record: " . $conn->error;
				}
			}			

			?>
			<div class='container' id = 'temp' style = 'display:none'>
            <form method="POST" id = 'edit_form' action = ''>
				<h3>Edit Company: <span id = 'show_username'></span></h3>
				<input type="hidden" name="company_username"/>
				<label>Name:</label> &emsp;
				<input type="text" name="new_company_name"><br>
				<label>E-mail:</label> &emsp;
				<input type="text" name="new_company_email"><br>
				<label>Hiring Since When:</label> &emsp;
				<input type="text" name="new_company_hiring_since_when"><br>
				<label>Password</label> &emsp;
				<input type="text" name="new_company_password"><br>
				<input type="submit" name="update" value="update">
				<button onclick="hideEditForm()">Cancel</button>
            </form>
			</div>

	</table>
</body>
</html>
