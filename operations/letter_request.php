<?php

include "../DB/Database.php";
$DB = new Database();

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $status = $_GET['status'];
    $userid = $_GET['userid'];
    
    $sql = "update requests set Status='$status' where Request_id = '$id';";
    $DB->query($sql);
    $DB->execute();
    $sql="insert into notifications (status,userid,notidata) values ('0','$userid','An action has been made to a letter request.')";
    $DB->query($sql);
    $DB->execute();
  header("Location: ../pages/letterRequests.php");
}