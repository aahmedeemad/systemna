<?php
include "../DB/Database.php";

if (isset($_POST['id']))  // Get The id  
{
    
    $id = $_POST['id'];
    if($id ==0) // if he tried to write id = 0
    {
        header("Location: ../pages/viewComment.php");
    }
    else
    {
        $DataBase = new Database(); // Make an instance of the Db
        // SQL Query
        $sql = "DELETE FROM comment
                WHERE Comment_id = '$id';";
        $DataBase->query($sql);
        $DataBase->execute();
        echo "true";
//        header("Location: ../pages/viewComment.php");
    }
}
else // If he tried to access it from the url
 {
      header("Location: ../pages/viewComment.php");
 }
?>