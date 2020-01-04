<?php
include "../DB/Database.php";

if (isset($_POST['id'])) 
{
    $DataBase = new Database();
    $id = $_POST['id'];
    $sql = "DELETE FROM comment
            WHERE Comment_id = '$id';";
    $DataBase->query($sql);
    $DataBase->execute();
    header("Location: ../pages/viewComment.php");
}
else if(!isset($_GET['id']))
{
    header("Location: ../pages/viewComment.php");
}
else
 {
      header("Location: ../pages/viewComment.php");
 }
?>