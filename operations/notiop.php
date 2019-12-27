<?php
session_start();
include('../DB/Database.php');
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['type'] == "setnotidata")
    {
        $uid = $_SESSION['id'];
        $sql = "SELECT * FROM notifications WHERE userid = $uid AND status = 0 ";
        $DB->query($sql);
        $DB->execute();
        for($i=$DB->numRows(); $i>0; --$i){
            $x=$DB->getdata();
            echo ($i) . "- " . $x[$i-1]->notidata . "<hr>";
        }
    }
}
else 
{
    header("location: ../index.php");
}
?>