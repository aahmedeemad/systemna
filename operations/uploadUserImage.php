<?php
move_uploaded_file($_FILES["image"]["tmp_name"], __DIR__. 
                   "/../usersImages/". "1.jpeg");
include "../DB/Database.php";
$DB = new Database();
$sql = "UPDATE add_info SET profile_picture = 1 WHERE emp_id = 1";
$DB->query($sql);
//$DB->bind(':id',1);
$DB->execute();
if($DB->numRows() > 0)
{
    echo "/../usersImages/". "1.jpeg";
}else 
{
    echo "avatar.jpg";
}
?>