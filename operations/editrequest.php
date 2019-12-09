<?php
include "../template/header.php";
$pageTitle = "SYSTEMNA | Edit Letter";

 if(!isset($_SESSION['username'])){header('Location:../index.php');}
    ?>
<?php

if(isset($_GET['id'])){
$DB2 = new Database();
$d_id = $_GET['id'];
$Status = $_POST['Status'];
$sql = "SELECT * FROM requests
 WHERE 	Request_id = '$d_id' AND Status=2 " ;

$DB2->query($sql);
$DB2->execute();

header("Location: ../pages/viewRequest.php");
}

$emp_id=$_SESSION['id'];
echo "<br>";echo "<br>";
echo " Your ID : ";
echo $emp_id ;
echo "<br>";

//for ($i=0; $i <$length ; $i++) {
  // code...

 ?>

  <select id='choice' class='tblselect'>
      <option value="email">Email</option>
      <option value="ssn">SSN</option>
      <option value="username">UserName</option>
  </select>
<?php
//}
 ?>




<?php include "../template/footer.php"; ?>
