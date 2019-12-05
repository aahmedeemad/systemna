<?php 
session_start();
include('../DB/Database.php');
$DB = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["Email"], FILTER_SANITIZE_EMAIL);
    $username=$_POST['username'];

    try{
        $sql="INSERT INTO employee(username,fullname,ssn,password,email,accepted,active,privilege) VALUES('".$username."' ,  '".$name."' ,  '".$_POST["ssn"]."' , '".$_POST["password"]."' , '".$email."' ,'0','1','user' )  ";
        $DB->query($sql);
        $DB->execute();
        $lid = $DB->lastInsertedId();
        $sql="INSERT INTO add_info(emp_id,phone,bdate,salary,passport_id,profile_picture,passport_picture,n_id_picture)
         VALUES('$lid' ,  '".$_POST['phone']."' ,  NULL , NULL ,NULL,0,0,0)";            

        $DB->query($sql);
        $DB->execute();
        $Message="<h3 style='color:green;'>signup complete.<h3>";
        header("Location:../index.php?Message={$Message}");
    }
    catch (Exception $e) {
        $Message="opss.. something went wrong.";
        header("Location:../index.php?Message={$Message}");
    }

 
}
?>