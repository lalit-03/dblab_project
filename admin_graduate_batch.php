<?php 
include "admin_boiler.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graduate Batch</title>
</head>
<body>
    <form action="./admin_student_to_alumni.php" method="POST">
        Batch to graduate: <input type='number' name='batch'/></br>
        <input type="submit"/>
    </form>
    Note: This will permanently mark students as alumni. Reversing this action is not trivial.
</body>
</html>