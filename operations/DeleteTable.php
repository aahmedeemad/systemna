<?php
include "../DB/Database.php";
$DB2 = new Database();
if(isset($_GET['id'])){
$d_id = $_GET['id'];
$sql = "update employee set active=0 where id = '$d_id;'";
$DB2->query($sql);
$DB2->execute();
header("Location: ../pages/index.php");
}
if(isset($_GET['qid'])){
$qid = $_GET['qid'];
$sql = "delete from faq where ID = '$qid';";
$DB2->query($sql);
$DB2->execute();
header("Location: ../pages/viewFAQ.php");

}
?>