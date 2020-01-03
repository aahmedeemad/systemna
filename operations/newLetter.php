<?php
include('../DB/Database.php');
$DB = new Database();
if (isset($_POST['body'])) {
    try{
    $body=filter_var($_POST['body'], FILTER_SANITIZE_STRING);
    $body='<pre>'.$body.'</pre>';
    $Name=filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
     $description=filter_var($_POST['description'], FILTER_SANITIZE_STRING);
     $add=filter_var($_POST['add'], FILTER_SANITIZE_STRING);
    $sql="INSERT INTO requests_types (Name,description,body,additional_info) VALUES ('$Name','$description','$body','$add') ";
    $DB->query($sql);
    $DB->execute();
    }catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        error_log("Error while deleting request");
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
    }
        echo ' letter created ';
    /*header("location: ../pages/allLetters.php");*/
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
