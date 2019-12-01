<?php 
session_start();
include('Database.php');
$DB = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $name = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["Email"], FILTER_SANITIZE_EMAIL);

    $sql="SELECT * FROM employee where username= '".$username."'  ";
    $DB->query($sql);
    $DB->execute();
    if($DB->numRows()>0)
    {
        $_SESSION['error']="username already exists.";
        header('Location:Login_Register.php');

    }

    elseif(isset($_SESSION['error'])){

        unset($_SESSION['error']);

        try{
            $sql="insert into employee(username,fullname,n_id,password,email,accepted,active,privilege) values('".$username."' ,  '".$name."' ,  '".$_POST["ssn"]."' , '".$_POST["password"]."' , '".$email."' ,'2','1','user' )  ";
            $DB->query($sql);
            $DB->execute();
        }
        catch (Exception $e) {
            $_SESSION['error']="data already exists.";
            header('Location:Login_Register.php');
        }

    }
    else{

        try{
            $sql="insert into employee(username,fullname,n_id,password,email,accepted,active,privilege) values('".$username."' ,  '".$name."' ,  '".$_POST["ssn"]."' , '".$_POST["password"]."' , '".$email."' ,'0','1','user' )  ";
            $DB->query($sql);
            $DB->execute();
        }
        catch (Exception $e) {
            $_SESSION['error']="username already exists.";
            header('Location:Login_Register.php');
        }

    }
}
?>