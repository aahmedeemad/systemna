<?php
include "../DB/Database.php";
$DB2 = new Database();
if(isset($_POST['type']))
{

    $type = $_POST['type'];
    $rid = $_POST['rid'];
    $id = $_POST['id'];
    $value = $_POST['value'];
    $sql = "UPDATE update_info1 set Status=1 where ID = '$rid';"; 
    $DB2 ->query($sql);
    $DB2 ->execute();

    if($type=='bdate' || $type=='location')
     $sql = "UPDATE add_info set ".$type."='$value' where emp_id = '$id';"; 
    else 
     $sql = "UPDATE employee set ".$type."='$value' where id = '$id';"; 
    $DB2 ->query($sql);
    $DB2 ->execute();
} 
if(isset($_POST['reqId'])){
    $rid = $_POST['reqId'];
    $sql = "UPDATE update_info1 set Status=0 where ID = '$rid';"; 
    $DB2 ->query($sql);
    $DB2 ->execute();

}
?>