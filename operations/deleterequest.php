<?php
session_start();
$d_id = $_POST['id'];
if(!isset($_SESSION['type']))  
{
    header('Location:../index.php');
}
else if($_SESSION['type']!='admin')
{
  header('Location:../pages/MakeLetter.php');
}
else {
    if(isset($_POST['id'])){
        try
        {
            include "../DB/Database.php";
            $DB = new Database();
            
            $sql = "Delete FROM requests WHERE 	Request_id = '$d_id' AND Status=2 " ;

            $DB->query($sql);
            $DB->execute();
            echo "true";
            //        header("Location: ../pages/viewRequest.php");
        } catch(Exception $e)
        {
            $_SESSION['error'] = 'error in sql';
            error_log("Error while deleting request");
            echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
        }
    } 
    else 
    {
         header("Location: ../index.php"); 
    }
}
?>
