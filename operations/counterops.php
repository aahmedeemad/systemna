<?php
session_start();
include('../DB/Database.php');
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['type'] == "setnoticounter")
    {
        $uid = $_SESSION['id'];
        $sql = " SELECT * FROM notifications WHERE userid = $uid AND status = 0 ";
        $DB->query($sql);
        $DB->execute();
        $num = $DB->numRows();
        echo("$num");
    }
}
else 
{
    header("location: ../index.php");
}
?>