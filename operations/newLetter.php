<?php
include('../DB/Database.php');
$DB = new Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addLetter'])) {
    $Name=filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $description=filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $sql="INSERT INTO requests_types (Name,description) VALUES ('$Name','$description') ";
    $DB->query($sql);
    $DB->execute();
    header("location: ../pages/allLetters.php");
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateLetter'])) {
    $Name=filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $description=filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $id=$_POST['id'];
    $sql="UPDATE requests_types SET Name = '$Name' , description = '$description' WHERE type_id = '$id'";
    $DB->query($sql);
    $DB->execute();
    header("location: ../pages/allLetters.php");
} else { header("Location: ../index.php"); }

?>
