<?php
session_start();
include('../DB/Database.php');
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['type'] == "addLetter")
    {


          $emp_id=$_SESSION['id'];
          $priority=$_POST['priority'];
          $Status=2;
          $salary=$_POST['salary'];
          $date=date('Y/m/d h:i:s');
          $type_name=$_POST['type_name'];

          $sql="INSERT INTO requests (emp_id,Status,priority,salary,date,type_name)
            VALUES ('$emp_id','$Status','$priority','$salary','$date','$type_name') ";
          $DB->query($sql);
          $DB->execute();

          //header("location: .php");
      }
    }
else
{
    header("location: ../MakeLetter.php");
}
?>
