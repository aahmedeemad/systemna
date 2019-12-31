<?php
session_start();
include('../DB/Database.php');
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == "addLetter")
    {
        try {
            $emp_id=$_SESSION['id'];
            $priority=$_POST['priority'];
            $Status=2;
            $salary=$_POST['salary'];
            $date=date('Y/m/d h:i:s');
            $type_name=$_POST['type_name'];

            $sql="INSERT INTO request (emp_id,Status,priority,salary,date,type_name)
            VALUES ('$emp_id','$Status','$priority','$salary','$date','$type_name') ";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }  catch (Exception $e) {
            echo "<div class='alert alert-danger'>Error please try again later</div>";
        }
    }
}
else { header("location: ../pages/viewRequest.php"); }
?>
