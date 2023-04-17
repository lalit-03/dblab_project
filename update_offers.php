<?php
session_start();
ini_set('display_errors', 1);
error_reporting(-1);
    if($_SESSION['user_type'] != 'company'){
        $message=urlencode("Unauthorized Access!");
        header("Location:login.php?message=".$message);
    }

// check if the form has been submitted
if (isset($_POST['submit'])) {
    $host = 'localhost';
    $username = 'test';
    $password = 'test';
    $database = 'dblab_project';

    $conn = new mysqli($host, $username, $password, $database);
    // get the selected offer ids from the checkboxes
    $selectedIds = $_POST['selected_ids'];

    // check if there are any selected offers
    if (!empty($selectedIds)) {

        // build the update query with the selected ids
        $selectedIdsStr = implode(",", $selectedIds);
        $updateQuery = "UPDATE Offers SET selected=1 WHERE offer_id IN ($selectedIdsStr)";
        
        // execute the update query
        require_once "config.php";
        if (mysqli_query($conn, $updateQuery)) {
            $message = "<div class='alert alert-info justify-content-center text-center'><strong>Selected Offers Updated!</strong></div>";
        } else {
            $message = "<div class='alert alert-danger justify-content-center text-center'><strong>Error: " . mysqli_error($conn) . "</strong></div>";
        }
        
    } else {
        $message = "<div class='alert alert-warning justify-content-center text-center'><strong>No Offers Selected!</strong></div>";
    }
    echo $message;
}

// redirect back to the offers page with the message
#header("Location: selection_company.php?message=" . urlencode($message));
exit();
?>
