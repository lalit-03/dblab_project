<?php
if(!isset($_GET['id']))die();
$stud_id=$_GET['id'];
include "admin_boiler.php";

$res=$conn->query("select * from Student where username='".htmlspecialchars($_GET['id'])."';");
if($res->num_rows==0){
    echo "No such student.";
    die();
}
$d1=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
</head>
<body>
    <form action="student_edit.php" method="POST">
    <input type="hidden" name="username" value="<?php echo $d1['username'];?>"/>
RollNumber: <input type="text" name="RollNumber" value="<?php echo $d1['RollNumber'];?>"/></br>
student_name: <input type="text" name="student_name" value="<?php echo $d1['student_name'];?>"/></br>
student_phone: <input type="text" name="student_phone" value="<?php echo $d1['student_phone'];?>"/></br>
student_email: <input type="text" name="student_email" value="<?php echo $d1['student_email'];?>"/></br>
DoB: <input type="text" name="DoB" value="<?php echo $d1['DoB'];?>"/></br>
Batch: <input type="text" name="Batch" value="<?php echo $d1['Batch'];?>"/></br>
degree: <input type="text" name="degree" value="<?php echo $d1['degree'];?>"/></br>
branch: <input type="text" name="branch" value="<?php echo $d1['branch'];?>"/></br>
marks_10: <input type="text" name="marks_10" value="<?php echo $d1['marks_10'];?>"/></br>
marks_12: <input type="text" name="marks_12" value="<?php echo $d1['marks_12'];?>"/></br>
sem1_spi: <input type="text" name="sem1_spi" value="<?php echo $d1['sem1_spi'];?>"/></br>
sem2_spi: <input type="text" name="sem2_spi" value="<?php echo $d1['sem2_spi'];?>"/></br>
sem3_spi: <input type="text" name="sem3_spi" value="<?php echo $d1['sem3_spi'];?>"/></br>
sem4_spi: <input type="text" name="sem4_spi" value="<?php echo $d1['sem4_spi'];?>"/></br>
sem5_spi: <input type="text" name="sem5_spi" value="<?php echo $d1['sem5_spi'];?>"/></br>
sem6_spi: <input type="text" name="sem6_spi" value="<?php echo $d1['sem6_spi'];?>"/></br>
sem7_spi: <input type="text" name="sem7_spi" value="<?php echo $d1['sem7_spi'];?>"/></br>
sem8_spi: <input type="text" name="sem8_spi" value="<?php echo $d1['sem8_spi'];?>"/></br>
password: <input type="text" name="password" value="<?php echo $d1['password'];?>"/></br>
<input type="submit">
<a href="student_delete.php?id=<?php echo $d1['username'] ?>"><input type="button" value="delete"></a>
<a href="student_role_applications.php?id=<?php echo $d1['username'] ?>"><input type="button" value="Roles Eligible"></a>
</form>

</body>
</html>