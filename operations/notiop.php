<?php
session_start(); /* Starting the session */
include('../DB/Database.php'); /* Including the DB */
$DB = new Database(); /* Making a DB object */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type']) && $_POST['type'] == "setnotidata")
    {
        try {
            $uid = $_SESSION['id']; /* Getting the user ID */
            $sql = "SELECT * FROM notifications WHERE userid = $uid AND status = 0 "; /* SQL query to get the data from the DB */
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            for($i=$DB->numRows(); $i>0; --$i){ /* iterating the results by the num of rows */
                $x=$DB->getdata(); /* creates an array of the output result */
                echo ($i) . "- <a href='" . $x[$i-1]->notihref . "' style='text-decoration: none; color: #DAA520;'>" . $x[$i-1]->notidata . "</a><hr>"; /* Printing the output */
            }
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while getting notifications data");
        }
    }
    else if (isset($_POST['type']) && $_POST['type'] == "markread")
    {
        try {
            $uid = $_SESSION['id']; /* Getting the user ID */
            $sql = " UPDATE notifications SET status = 1 WHERE userid = $uid AND status = 0 "; /* SQL query to set the data into the DB */
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while setting notifications read");
        }
    }
    else if(isset($_POST['nid']))
    {
        try {
            $nid = $_POST['nid'];
            $sql = "DELETE FROM notifications WHERE ID = '$nid'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while deleting notifications");
        }
    }
    else if(isset($_POST['all']) && $_POST['all'] == "1")
    {
        try {
            $uid = $_SESSION['id'];
            $sql = "DELETE FROM notifications WHERE userid = '$uid'";
            $DB->query($sql);
            $DB->execute();
            echo "all";
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while deleting notifications");
        }
    }
}
else 
{
    header("location: ../pages/index.php"); /* Redirecting to mainpage if the user tried to get into this page without 'POST' method */
}
?>