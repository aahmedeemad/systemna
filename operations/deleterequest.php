<?php
session_start();
if(!isset($_SESSION['type']))  header('Location:../index.php');
else {
    include "../DB/Database.php";
    if(isset($_GET['id'])){
        $DB = new Database();
        $d_id = $_GET['id'];
        $Status = $_GET['Status'];
        $sql = "Delete FROM requests WHERE 	Request_id = '$d_id' AND Status=2 " ;

        $DB->query($sql);
        $DB->execute();

        header("Location: ../pages/viewRequest.php");
    } else { header("Location: ../index.php"); }
}
?>
