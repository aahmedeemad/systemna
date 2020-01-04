<?php
session_start(); /* Starting the session */
include('../DB/Database.php'); /* Including the DB */
$DB = new Database(); /* Making a DB object */

use PHPMailer\PHPMailer\PHPMailer; /* Namespace alias. */
use PHPMailer\PHPMailer\Exception; /* Namespace alias. */

require '../composer/vendor/autoload.php'; /* Include the Composer generated autoload.php file. */

date_default_timezone_set('Etc/UTC'); /* Set the script time zone to UTC. */

$mail = new PHPMailer(TRUE); /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail->SMTPOptions = array('ssl'=>array('verify_peer'=>false, 'verify_peer_name'=>false, 'allow_self_signed'=>true));
$mail->isSMTP(); /* Use SMTP. */
$mail->Host = 'smtp.gmail.com'; /* Google (Gmail) SMTP server. */
$mail->Port = 587; /* SMTP port. */
$mail->SMTPAuth = true; /* Set authentication. */
$mail->SMTPSecure = 'tls'; /* Set authentication. */
$mail->Username = 'systemnamiu@gmail.com'; /* Username (email address). */
$mail->Password = 'tpwvzpocyggbhmlr'; /* Google account password. */
$mail->setFrom('systemnamiu@gmail.com', $_SESSION["name"] . ' from SYSTEMNA'); /* Set the mail sender. */
$mail->CharSet = 'utf-8';
$mail->isHTML(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['type'] == "notiall")
    {
        try {
            $sql = "SELECT * FROM employee WHERE accepted = 1"; /* SQL query to get the data from the DB */
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            $x = $DB->getdata(); /* creates an array of the output result */
            $y = $DB->numRows();
            for ($i=0; $i<$y; $i++) {
                if (isset($_POST['notification'])) {
                    $notification = filter_var($_POST['notification'], FILTER_SANITIZE_STRING);
                    $uid = $x[$i]->id;
                     /* SQL query to set the data into the DB */
                    $sql = "INSERT INTO notifications (status, userid, notidata, notihref) VALUES ('0','$uid','$notification','')";
                    $DB->query($sql); /* Using the query function made in DB/Database.php */
                    $DB->execute(); /* Using the excute function made in DB/Database.php */
                }
            }
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while sending notification to all users");
        }
    }
    else if ($_POST['type'] == "notione")
    {
        try {
            $uid = $_POST['id'];
            if (isset($_POST['notification'])) {
                $notification = filter_var($_POST['notification'], FILTER_SANITIZE_STRING);
                /* SQL query to set the data into the DB */
                $sql = "INSERT INTO notifications (status, userid, notidata, notihref) VALUES ('0','$uid','$notification','')";
                $DB->query($sql); /* Using the query function made in DB/Database.php */
                $DB->execute(); /* Using the excute function made in DB/Database.php */
            }
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while sending notification to one user");
        }
    }
    else if ($_POST['type'] == "mailall")
    {
        try {
            $sql = "SELECT * FROM employee WHERE accepted = 1"; /* SQL query to get the data from the DB */
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            $x = $DB->getdata(); /* creates an array of the output result */
            $y = $DB->numRows(); /* getting the num of rows */
            if (isset($_POST['mailsubject']) && isset($_POST['mailcontent'])) {
                $mailsubject = filter_var($_POST['mailsubject'], FILTER_SANITIZE_STRING);
                $mailcontent = filter_var($_POST['mailcontent'], FILTER_SANITIZE_STRING);
                $mail->Subject = "$mailsubject"; /* Set the subject. */
                //$mail->Body = "$mailcontent"; /* Set the mail message body. */
                for ($i=0; $i<$y; $i++) {
                    $umail = $x[$i]->email;
                    $uname = $x[$i]->fullname;
                    $email_vars = array(
                        'name' => $uname,
                        'content' => $mailcontent,
                    );
                    /* Importing the mail template */
                    $body = file_get_contents('../template/htmlemail.html');
                    if(isset($email_vars)){
                        foreach($email_vars as $k=>$v){
                            /* Replace the values in {} in template to vars in function */
                            $body = str_replace('{'.strtoupper($k).'}', $v, $body);
                        }
                    }
                    $mail->MsgHTML($body);
                    $mail->addAddress("$umail", "$uname"); /* Add a recipient. */
                    $mail->send(); /* Send the mail. */
                    $mail->ClearAddresses(); /* Removes the data after sending. */
                }
            }
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while sending mail to all users");
        }
    }
    else if ($_POST['type'] == "mailone")
    {
        try {
            $umail = $_POST['email']; /* Getting the user email */
            /* SQL query to get the data from the DB */
            $sql = "SELECT fullname FROM employee WHERE email='$umail' ";
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            $x = $DB->getdata(); /* creates an array of the output result */
            $uname = $x[0]->fullname;
            if (isset($_POST['mailsubject']) && isset($_POST['mailcontent'])) {
                $mailsubject = filter_var($_POST['mailsubject'], FILTER_SANITIZE_STRING);
                $mailcontent = filter_var($_POST['mailcontent'], FILTER_SANITIZE_STRING);
                $mail->Subject = "$mailsubject"; /* Set the subject. */
                $email_vars = array(
                    'name' => $uname,
                    'content' => $mailcontent,
                );
                /* Importing the mail template */
                $body = file_get_contents('../template/htmlemail.html');
                if(isset($email_vars)){
                    foreach($email_vars as $k=>$v){
                        /* Replace the values in {} in template to vars in function */
                        $body = str_replace('{'.strtoupper($k).'}', $v, $body);
                    }
                }
                $mail->MsgHTML($body);
                //$mail->Body = "$mailcontent"; /* Set the mail message body. */
                $mail->addAddress("$umail", "$uname"); /* Add a recipient. */
                $mail->send(); /* Send the mail. */
            }
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while sending mail to one user");
        }
    }
    else if ($_POST['type'] == "sendmailfn")
    {
        try {
            $uid = $_POST['uid']; /* Getting the user ID */
            $sql = "SELECT * FROM employee WHERE id='$uid' "; /* SQL query to get the data from the DB */
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            $x = $DB->getdata(); /* creates an array of the output result */
            $uname = $x[0]->fullname;
            $umail = $x[0]->email;
            $mailsubject = $_POST['mailsubject'];
            $mailcontent = $_POST['mailcontent'];
            $mail->setFrom('systemnamiu@gmail.com', 'From SYSTEMNA'); /* Set the mail sender. */
            $mail->Subject = "$mailsubject"; /* Set the subject. */
            $email_vars = array(
                'name' => $uname,
                'content' => $mailcontent,
            );
            /* Importing the mail template */
            $body = file_get_contents('../template/htmlemail.html');
            if(isset($email_vars)){
                foreach($email_vars as $k=>$v){
                    /* Replace the values in {} in template to vars in function */
                    $body = str_replace('{'.strtoupper($k).'}', $v, $body);
                }
            }
            $mail->MsgHTML($body);
            //$mail->Body = "$mailcontent"; /* Set the mail message body. */
            $mail->addAddress("$umail", "$uname"); /* Add a recipient. */
            $mail->send(); /* Send the mail. */
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error in send mail to one user function");
        }
    }
    else if ($_POST['type'] == "sendnotifn")
    {
        try {
            $uid = $_POST['uid']; /* Getting the user ID */ /* Getting the user ID */
            $notification = $_POST['noticontent'];
            $notihref = $_POST['notihref']; 
            /* SQL query to set the data into the DB */
            $sql = "INSERT INTO notifications (status, userid, notidata, notihref) VALUES ('0','$uid','$notification','$notihref')";
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error in send notification to one user function");
        }
    }
    else if ($_POST['type'] == "newusermail")
    {
        try {
            $umail = $_POST['email']; /* Getting the user email */
            $uname = $_POST['name'];
            if (isset($_POST['mailsubject']) && isset($_POST['mailcontent'])) {
                $mailsubject = filter_var($_POST['mailsubject'], FILTER_SANITIZE_STRING);
                $mailcontent = filter_var($_POST['mailcontent'], FILTER_SANITIZE_STRING);
                $mail->Subject = "$mailsubject"; /* Set the subject. */
                $email_vars = array(
                    'name' => $uname,
                    'content' => $mailcontent,
                );
                /* Importing the mail template */
                $body = file_get_contents('../template/htmlemail.html');
                if(isset($email_vars)){
                    foreach($email_vars as $k=>$v){
                        /* Replace the values in {} in template to vars in function */
                        $body = str_replace('{'.strtoupper($k).'}', $v, $body);
                    }
                }
                $mail->MsgHTML($body);
                //$mail->Body = "$mailcontent"; /* Set the mail message body. */
                $mail->addAddress("$umail", "$uname"); /* Add a recipient. */
                $mail->send(); /* Send the mail. */
            }
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while sending mail to one user");
        }
    }
    else if ($_POST['type'] == "sendlettermail")
    {
        try {
            $uid = $_SESSION["id"]; /* Getting the user ID */
            $sql = "SELECT * FROM employee WHERE id='$uid' "; /* SQL query to get the data from the DB */
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            $x = $DB->getdata(); /* creates an array of the output result */
            $uname = $x[0]->fullname;
            $umail = $x[0]->email;
            $mailsubject = 'Your Requested HR Letter';
            $mailcontent = 'Kindly find attached the requested HR letter';
            $mail->setFrom('systemnamiu@gmail.com', 'From SYSTEMNA'); /* Set the mail sender. */
            $mail->Subject = "$mailsubject"; /* Set the subject. */
            $email_vars = array(
                'name' => $uname,
                'content' => $mailcontent,
            );
            /* Importing the mail template */
            $body = file_get_contents('../template/htmlemail.html');
            if(isset($email_vars)){
                foreach($email_vars as $k=>$v){
                    /* Replace the values in {} in template to vars in function */
                    $body = str_replace('{'.strtoupper($k).'}', $v, $body);
                }
            }
            $mail->MsgHTML($body);
            $mail->addStringAttachment(file_get_contents($contenturl), 'SYSTEMNA HR Letter.pdf');
            //$mail->Body = "$mailcontent"; /* Set the mail message body. */
            $mail->addAddress("$umail", "$uname"); /* Add a recipient. */
            $mail->send(); /* Send the mail. */
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error in send letter mail to user");
        }
    }
}
else 
{
    header("location: ../index.php"); /* Redirecting to mainpage if the user tried to get into this page without 'POST' method */
}
?>