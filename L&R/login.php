<?php
session_start();
include('../DB/Database.php');
$DB = new Database();

if($_SERVER['REQUEST_METHOD']=='POST') {
    try {
        $username = filter_var($_POST["Username"], FILTER_SANITIZE_STRING);
        $sql="SELECT * FROM employee where username= '".$username."' and password = '".sha1($_POST["Password"])."'";
        $DB->query($sql);
        $DB->execute();
    } catch (Exception $e) {
        $Message = "something gone wrong. ";
        header("Location:../index.php?Message={$Message}");
    }
    if($DB->numRows()==0) {
        $Message = "wrong username or password. ";
        header("Location:../index.php?Message={$Message}");
    }
    else {
        $x=$DB->getdata();
        $_SESSION['name']=$x[0]->fullname;
        $_SESSION['password']=$x[0]->password;
        $_SESSION['username']=$x[0]->username;
        $_SESSION['email']=$x[0]->email;
        $_SESSION['ssn']=$x[0]->ssn;
        $_SESSION['status']=$x[0]->accepted;
        $_SESSION['activity']=$x[0]->active;
        $_SESSION['type']=$x[0]->privilege;
        $_SESSION['id']=$x[0]->id;
        if(!empty($_POST['remember'])) {
            setcookie("username", $_POST['username'], time()+(10 * 365 * 24 * 60 * 60));
            setcookie("password", $_POST['password'], time()+(10 * 365 * 24 * 60 * 60));
        }else{
            if(ISSET($_COOKIE['username'])) {
                setcookie("username", "");
            }
            if(ISSET($_COOKIE['password'])) {
                setcookie("password", "");
            }
        }
        if($_SESSION['type']=='admin') {
            header('Location:../pages/index.php');}
        else if($_SESSION['type']=='user') {
            header('Location:../pages/MakeLetter.php');
        }
        else if($_SESSION['type']=='qc') {
//            echo "aaa";
            header('Location:../pages/QualityControl.php');
        }
        if($_SESSION['status'] == 2) {
            $Message = "Your account is still pending";
            header("Location:../index.php?Message={$Message}");
        }
        elseif($_SESSION['status'] == 0) {
            $Message = "Unfortunely your account information has been rejected";
            header("Location:../index.php?Message={$Message}");
        }
    }
}
?>
