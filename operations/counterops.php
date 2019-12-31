<?php
session_start(); /* Starting the session */
include('../DB/Database.php'); /* Including the DB */
$DB = new Database(); /* Making a DB object */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == "setnoticounter")
    {
        $uid = $_SESSION['id'];
        /* SQL query to get the data from the DB */
        $sql = " SELECT * FROM notifications WHERE userid = $uid AND status = 0 ";
        $DB->query($sql); /* Using the query function made in DB/Database.php */
        $DB->execute(); /* Using the excute function made in DB/Database.php */
        echo($DB->numRows()); /* Printing the output */
    }
    else if ($_POST['type'] == "setprofilecounter")
    {
        $uid = $_SESSION['id'];
        /* SQL query to get the data from the DB */
        $sql= " SELECT * FROM update_info left join employee on update_info.UID = employee.id WHERE update_info.Status = 2 and UID <> '$uid' ";
        $DB->query($sql); /* Using the query function made in DB/Database.php */
        $DB->execute(); /* Using the excute function made in DB/Database.php */
        echo ($DB->numRows()); /* Printing the output */
    }
    else if ($_POST['type'] == "setusrsletterrequestscounter")
    {
        /* SQL query to get the data from the DB */
        $sql = " SELECT e.fullname, rt.Name, r.Request_id, r.emp_id, r.type_name, r.Status, r.priority, r.salary FROM requests r, employee e, requests_types rt WHERE e.id=r.emp_id AND r.type_name=rt.Name ";
        $DB->query($sql); /* Using the query function made in DB/Database.php */
        $DB->execute(); /* Using the excute function made in DB/Database.php */
        echo ($DB->numRows()); /* Printing the output */
    }
    else if ($_POST['type'] == "setownletterrequestscounter")
    {
        /* SQL query to get the data from the DB */
        $sql = " SELECT * FROM requests INNER join requests_types on requests.type_name=requests_types.Name WHERE emp_id='".$_SESSION['id']."' ";
        $DB->query($sql); /* Using the query function made in DB/Database.php */
        $DB->execute(); /* Using the excute function made in DB/Database.php */
        echo ($DB->numRows()); /* Printing the output */
    }
    else if ($_POST['type'] == "setusrscounter")
    {
        /* SQL query to get the data from the DB */
        $sql = " SELECT * FROM employee WHERE accepted = 2 ";
        $DB->query($sql); /* Using the query function made in DB/Database.php */
        $DB->execute(); /* Using the excute function made in DB/Database.php */
        echo ($DB->numRows()); /* Printing the output */
    }
}
else 
{
    header("location: ../index.php"); /* Redirecting to mainpage if the user tried to get into this page without 'POST' method */
}
?>