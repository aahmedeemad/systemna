<?php 
session_start();
include('../DB/Database.php');
$DB = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["Email"], FILTER_SANITIZE_EMAIL);
    $username=$_POST['username'];

    try{
        $sql="INSERT INTO employee VALUES (NULL, '" . $name . "' ,  '" . $username . "' , '" . $_POST["password"] . "' , '" . $email . "' , '" . $_POST['phone'] . "', '" . $_POST["ssn"] . "' , 2 , 1 , 'user')";
        $DB->query($sql);
        $DB->execute();
        $lid = $DB->lastInsertedId();
        $sql="INSERT INTO add_info VALUES($lid , NULL , NULL , NULL, 0, 0,0)";

        
        $DB->query($sql);
        $DB->execute();
        $Message="<h3 style='color:green;'>Signup Complete.<h3>";
        header("Location:../index.php?Message={$Message}");
    }
    catch (Exception $e) {
        $Message="<h3 style='color:red;'>Opss..Something went wrong !<h3>";
        header("Location:../index.php?Message={$Message}");
    }

 
}
?>