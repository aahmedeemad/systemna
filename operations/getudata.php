<?php
session_start(); /* Starting the session */
include('../DB/Database.php'); /* Including the DB */
$DB = new Database(); /* Making a DB object */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['getid']))
	{
		$uid = $_SESSION['id'];
		echo $uid;
	}
	elseif(isset($_POST['getbd']))
	{
		try {
            $uid = $_SESSION['id'];
            /* SQL query to get the data from the DB */
            $sql = " SELECT bdate FROM add_info WHERE emp_id = $uid ";
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            $x=$DB->getdata(); /* creates an array of the output result */
            echo($x[0]->bdate); /* Printing the output */
        }
        catch(Exception $e)
        {
            echo "Error please try again later";
            error_log("error while getting user birthday");
        }
	}
}
else 
{
    header("location: ../index.php"); /* Redirecting to mainpage if the user tried to get into this page without 'POST' method */
}
?>