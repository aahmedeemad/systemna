<?php
session_start();
include('../DB/Database.php');
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['type'] == "faqinq")
    {
        if (isset($_POST['subject']) && isset($_POST['content'])) {
            $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
            $message = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
            $requester_name = $_SESSION['username'];
            $requester_email = $_SESSION['email'];
            $requester_id = $_SESSION['id'];
            $sql = "INSERT INTO inquiries (subject, message, requester_name, requester_email, requester_id) VALUES ('$subject', '$message', '$requester_name', '$requester_email', '$requester_id') ";
            $DB->query($sql);
            $DB->execute();
        }
    }
}
else 
{
    header("location: ../index.php");
}
?>