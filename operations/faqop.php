<?php
session_start(); /* Starting the session */
include('../DB/Database.php'); /* Including the DB */
$DB = new Database(); /* Making a DB object */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type']) && $_POST['type'] == "faqinq")
    {
        try {
            if (isset($_POST['subject']) && isset($_POST['content'])) {
                /* Setting the data variables */
                $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
                $message = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
                $requester_name = $_SESSION['username'];
                $requester_email = $_SESSION['email'];
                $requester_id = $_SESSION['id'];
                /* SQL query to get the data from the DB */
                $sql = "INSERT INTO inquiries (subject, message, requester_name, requester_email, requester_id) VALUES ('$subject', '$message', '$requester_name', '$requester_email', '$requester_id') ";
                $DB->query($sql); /* Using the query function made in DB/Database.php */
                $DB->execute(); /* Using the excute function made in DB/Database.php */
            }
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while inserting into inquries table");
        }
    }
    elseif (isset($_POST['type']) && $_POST['type'] == "faqaddques")
    {
        try {
            if (isset($_POST['question']) && isset($_POST['answer'])) {
                /* Setting the data variables */
                $Question = filter_var($_POST['question'], FILTER_SANITIZE_STRING);
                $Answer = filter_var($_POST['answer'], FILTER_SANITIZE_STRING);
                $Added_by = $_SESSION['username'];
                $Requested_by = filter_var($_POST['Requested_by'], FILTER_SANITIZE_STRING);
                /* SQL query to set the data into the DB */
                $sql = "INSERT INTO faq (Question, Answer, Added_by, Requested_by) VALUES ('$Question', '$Answer', '$Added_by', '$Requested_by') ";
                $DB->query($sql); /* Using the query function made in DB/Database.php */
                $DB->execute(); /* Using the excute function made in DB/Database.php */
            }
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while inserting into faq table");
        }
    }
    else if(isset($_POST['nid']))
    {
        try {
            $nid = $_POST['nid'];
            $sql = "DELETE FROM inquiries WHERE id = '$nid'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while deleting inquiry");
        }
    }
    else if(isset($_POST['all']) && $_POST['all'] == "1")
    {
        try {
            $uid = $_SESSION['id'];
            $sql = "DELETE FROM inquiries";
            $DB->query($sql);
            $DB->execute();
            echo "all";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while deleting inquiry");
        }
    }
}
else 
{
    header("location: ../index.php"); /* Redirecting to mainpage if the user tried to get into this page without 'POST' method */
}
?>