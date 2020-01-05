<?php
include "../DB/Database.php";

if (isset($_POST['AddC'])) // If he clicked on the button to submit his comment
{
    $DataBase = new Database(); // Making an instance of the Db
    $val = filter_var($_POST['Comment'], FILTER_SANITIZE_STRING); // Getting comment and filters it from any html tags or SQL injection
    $R_id = $_POST['Request_id'];
    $U_id = $_POST['User_id'];

    // Query to insert the comment
    $sql = "INSERT INTO comment(Comment_value , Request_id , user_id)
            VALUES ('$val','$R_id','$U_id');" ;

    $DataBase->query($sql); // Sending the query
    $DataBase->execute(); // Running the query

    header("Location: ../pages/viewComment.php");
}
else // if there was an error while adding the comment
 {
      header("Location: ../pages/viewComment.php");
 }
?>