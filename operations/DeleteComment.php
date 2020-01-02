<?php
include "../DB/Database.php";

if (isset($_GET['id'])) 
{
    $DataBase = new Database();
    $id = $_GET['id'];
    $sql = "DELETE FROM comment
            WHERE Comment_id = '$id';";
    $DataBase->query($sql);
    $DataBase->execute();

    header("Location: ../pages/viewComment.php");
}
else
 {
      header("Location: ../pages/viewComment.php");
      echo "<script>alert('Couldn't delete the Comment try again!');</script>";
 }
?>