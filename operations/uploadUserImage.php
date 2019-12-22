<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    session_start();
    move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__. 
                       "/../usersImages/". $_SESSION['id'] . ".jpeg");
    include "../DB/Database.php";
    $DB = new Database();
    $sql = "UPDATE add_info SET profile_picture = 1 WHERE emp_id = " . $_SESSION['id'];
    $DB->query($sql);
    //$DB->bind(':id',1);
    $DB->execute();
    if($DB->numRows() > 0)
    {
        echo "/../usersImages/". $_SESSION['id'] . ".jpeg";
    }else 
    {
        echo "avatar.jpg";
    }

} else { header("Location: ../index.php"); }
?>