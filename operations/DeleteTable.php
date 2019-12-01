<?php
include "../Database.php";
$DB2 = new Database();
$d_id = $_GET['id'];
$sql = "update employee set active=0 where id = '$d_id;'";
$DB2->query($sql);
$DB2->execute();
header("Location: ../index.php");
?>