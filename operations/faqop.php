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
    } elseif ($_POST['type'] == "faqaddques")
    {
        if (isset($_POST['question']) && isset($_POST['answer'])) {
            $Question = filter_var($_POST['question'], FILTER_SANITIZE_STRING);
            $Answer = filter_var($_POST['answer'], FILTER_SANITIZE_STRING);
            $Added_by = $_SESSION['username'];
            $Requested_by = filter_var($_POST['Requested_by'], FILTER_SANITIZE_STRING);
            $sql = "INSERT INTO faq (Question, Answer, Added_by, Requested_by) VALUES ('$Question', '$Answer', '$Added_by', '$Requested_by') ";
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