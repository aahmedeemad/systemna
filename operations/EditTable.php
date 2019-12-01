<?php
include "../Database.php";
$DB2 = new Database();
if(isset($_POST['test'])){
    $sal=$_POST['test']; 
    $id=$_POST['id']; 
    $sql = "update add_info set salary='$sal' where emp_id = '$id';";
    $DB2->query($sql);
    $DB2->execute();
    $assign = $DB2->numRows();
    if($assign)
     header("Location: ../index.php");
    else 
    {
     $sql = "insert into add_info(emp_id,salary) values ('$id','$sal');";
     $DB2->query($sql);
     $DB2->execute();
     header("Location: ../index.php");
    }
}
if(isset($_GET['accepted'])){
    $accepted = $_GET['accepted'];
    $ID = $_GET['id'];
     if($accepted==0){
        $sql = "update employee set accepted=1 where id = '$ID';";
        $DB2->query($sql);
        $DB2->execute();
     }
     else if($accepted==1){
        $sql = "update employee set accepted=0 where id = '$ID';";
        $DB2->query($sql);
        $DB2->execute();
     }
     else if($accepted==2){
        $sql = "update employee set accepted=0 where id = '$ID';";
        $DB2->query($sql);
        $DB2->execute();
     }
    header("Location: ../index.php");

}
?>