<?php
include('../DB/Database.php');
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['type'] == "notiall")
    {
        $sql = "SELECT * FROM employee";
        $DB->query($sql);
        $DB->execute();
        $x=$DB->getdata();
        $y=$DB->numRows();
        for ($i=0; $i<$y; $i++) {
            if (isset($_POST['notification'])) {
                $notification=filter_var($_POST['notification'], FILTER_SANITIZE_STRING);
                $uid=$x[$i]->id;
                $sql2="INSERT INTO notifications (status, userid, notidata) VALUES ('0','$uid','$notification')";
                $DB->query($sql2);
                $DB->execute();
            }
        }
        echo "true";
    }
    else if ($_POST['type'] == "notione")
    {
        //        $sql = "SELECT * FROM employee";
        //        $DB->query($sql);
        //        $DB->execute();
        //        $x=$DB->getdata();
        //        $y=$DB->numRows();
        $uid = $_POST['id'];
        if (isset($_POST['notification'])) {
            $notification=filter_var($_POST['notification'], FILTER_SANITIZE_STRING);
            $sql2="INSERT INTO notifications (status, userid, notidata) VALUES ('0','$uid','$notification')";
            $DB->query($sql2);
            $DB->execute();
        }
        echo "true";
    }
}
else 
{
    header("location: ../index.php");
}
?>