<?php
include "../DB/Database.php";
$DB2 = new Database();
$d_id = $_GET['id'];
$sql = "Delete FROM requests WHERE 	Request_id = '$d_id'";
$DB2->query($sql);
$DB2->execute();
header("Location: ../viewRequest.php");
?>
