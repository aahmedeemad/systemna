<?php
include "../DB/Database.php";

if (isset($_GET['id']))
{
    $DataBase = new Database();
    $id = $_GET['id'];
    $sql = "UPDATE comment
            SET Value =
            WHERE Comment_id = '$id';";
    $DataBase->query($sql);
    $DataBase->execute();

    header("Location: ../pages/viewComment.php");
}
else
 {
      header("Location: ../viewComment.php");
      echo "<script>alert('Couldn't edit the Comment try again!');</script>";
 }
?>
<form action="" method="post">
    <input type="text" palceholder="Enter your comment here">
    <input type="submit" >
</form>