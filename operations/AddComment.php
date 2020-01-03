<?php
include "../DB/Database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['AddC']) && isset($_GET['Request_id']) && isset($_GET['user_id']))
{
    $DataBase = new Database();

    $val = filter_var($_POST['Comment'], FILTER_SANITIZE_STRING);
    $R_id = $_GET['Request_id'];
    $U_id = $_GET['user_id'];

    $sql = "INSERT INTO Comment(Comment_value , Request_id , user_id)
            VALUES ('$val','$R_id','$U_id');" ;

    $DataBase->query($sql);
    $DataBase->execute();

    header("Location: ../pages/QualityControl.php");
}
else
 {
      header("Location: ../QualityControl.php");
      echo "<script>alert('Couldn't add the Comment try again!');</script>";
 }
?>