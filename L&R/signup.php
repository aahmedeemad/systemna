<?php 
session_start();
include('../DB/Database.php');
$DB = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["Email"], FILTER_SANITIZE_EMAIL);
    $username=$_POST['username'];

    try{
        $sql="INSERT INTO employee(username,fullname,n_id,password,email,accepted,active,privilege) VALUES('".$username."' ,  '".$name."' ,  '".$_POST["ssn"]."' , '".$_POST["password"]."' , '".$email."' ,'0','1','user' )  ";
        $DB->query($sql);
        $DB->execute();

        $sql="INSERT INTO add_info VALUES(".$DB->lastInsertedId()." ,  '".$_POST['phone']."' ,  NULL , '".$_POST["ssn"]."' , NULL ,NULL,0)";            

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