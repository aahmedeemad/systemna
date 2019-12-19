<?php
include "../DB/Database.php";
$DB2 = new Database();

if(isset($_POST['type'])){
   $id=$_POST['mid'];
   $sql = "select * from employee where id = '$id';";
   try 
   {
   $DB2->query($sql);
   $DB2->execute();
   if($DB2->numRows()>0)
   {
       for($i=0;$i<$DB2->numRows();$i++)
       {$x = $DB2 ->getdata();
        echo $x[$i]->accepted;
        $acc = $x[$i]->accepted; }
        if($acc == 1){
         $type=$_POST['type'];
         $sql = "update employee set privilege='$type' where id = '$id';";
         $DB2->query($sql);
         $DB2->execute();
        }
   }
  }
  catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }
   
}
if(isset($_POST['test'])){
    $sal=$_POST['test']; 
    $id=$_POST['id']; 
    $sql = "update add_info set salary='$sal' where emp_id = '$id';";
    $DB2->query($sql);
    $DB2->execute();
    $assign = $DB2->numRows();
    if($assign)
     header("Location: ../pages/index.php");
    else 
    {
     $sql = "insert into add_info(emp_id,salary) values ('$id','$sal');";
     $DB2->query($sql);
     $DB2->execute();
     header("Location: ../pages/index.php");
    }
}
if(isset($_GET['accepted'])){
    $accepted = $_GET['accepted'];
    $ID = $_GET['id'];
     if($accepted==0){
        $sql = "update employee set accepted=1 where id = '$ID';";
        $DB2->query($sql);
        $DB2->execute();
        $sql = "insert into notifications(status,userid,notidata) values (0,'$ID','Welcome to SYSTEMNA');";
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
    header("Location: ../pages/index.php");

}
?>