<?php
include "../DB/Database.php";

if(isset($_POST['AddC']) && isset($_GET['Request_id']))
{
    $DataBase = new Database();

    $val = $_POST['Comment'];
    $R_id = $_GET['Request_id'];

    $sql = "INSERT INTO Comment(Value , Request_id) VALUES ('$val','$R_id')" ;

    $DataBase->query($sql);
    $DataBase->execute();

    header("Location: ../pages/QualityControl.php");
}
else { header("Location: ../index.php"); }
?>