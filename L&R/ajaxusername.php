<?php 
session_start();
include('../DB/Database.php');
$DB = new Database();

if(isset($_POST['username'])){

    $username=$_POST['username'];
    $filteredname = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    if($filteredname == $username && strlen($filteredname)>2){
        try{
            $sql="SELECT * FROM employee where username= '".$filteredname."'  ";
            $DB->query($sql);
            $DB->execute();
            if($DB->numRows()>0)
            {
                echo"username already exists.";
            }
            else
            {
                echo'valid username';
            }
        }catch (Exception $e) {


        }

    }
    else{

        echo"invalid username";
    }

}

if(isset($_POST['mail'])){
    $mail=$_POST['mail'];
    $email = filter_var($mail, FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        try{
            $sql="SELECT * FROM employee where email= '".$email."'  ";
            $DB->query($sql);
            $DB->execute();
            if($DB->numRows()>0)
            {
                echo"email already exists.";
            }
            else
            {
                echo'valid mail';

            }
        }catch (Exception $e) {


        }

    }
    else
    {

        echo"invalid mail";
    }
}





if(isset($_POST['ssn'])){
    $ssn=$_POST['ssn'];
    if(!filter_var($ssn, FILTER_VALIDATE_INT) === false && strlen((string)$ssn)==14 && $ssn>0){
        try{
            $sql="SELECT * FROM employee where ssn= '".$ssn."'  ";
            $DB->query($sql);
            $DB->execute();
            if($DB->numRows()>0)
            {
                echo"ssn already exists.";

            }

            else{

                echo'valid ssn';

            }
        }catch (Exception $e) {
            echo $e->getMessage();

        }

    }


    else{

        echo"invalid ssn";
    }


}



