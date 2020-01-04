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
    echo "true";
//    header("Location: ../pages/viewComment.php");
}
else
 {
      header("Location: ../pages/viewComment.php");
//      echo "<script>alert('Couldn't delete the Comment try again!');</script>";
 }
?>