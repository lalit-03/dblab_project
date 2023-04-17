<?php
if(!isset($_GET['id'])){
    die();
}
$stud_id=$_GET['id'];
include "student_boiler.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <form action="./student_change_password.php" method="POST">
        <input type='hidden' name='id' value='<?php echo $stud_id;?>'/>
        Old Password: <input type="password" name='old'/></br>
        New Password: <input type="password" name='new'/></br>
        <input type='submit'/>
    </form>
</body>
</html>