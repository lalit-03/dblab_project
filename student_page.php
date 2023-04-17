<?php
include "student_boiler.php";
$stud = $conn->query("select * from Student where username='".$_SESSION['username']."';");
if($stud->num_rows==0)die();
$res = $stud->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <h1>Hi <?php echo $res['student_name'];?></h1>
<a href="student_passwd.php?id=<?php echo $_SESSION['username']?>"><button>Change Password</button></a>
<a href="student_role_applications.php?id=<?php echo $_SESSION['username'] ?>"><button>Check Eligible Roles</button></a>
</body>
</html>