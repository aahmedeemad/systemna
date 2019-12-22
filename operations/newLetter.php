<?php
include('../DB/Database.php');
$DB = new Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Name=filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $description=filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $sql="INSERT INTO requests_types (Name,description) VALUES ('$Name','$description') ";
    $DB->query($sql);
    $DB->execute();
    header("location: ../pages/viewRequest.php");
} else { header("Location: ../index.php"); }

?>