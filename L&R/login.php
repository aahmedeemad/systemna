<?php



session_start();
include('../DB/Database.php');
$DB = new Database();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $username = filter_var($_POST["Username"], FILTER_SANITIZE_STRING);
    $sql="SELECT * FROM employee where username= '".$username."' and password = '".$_POST["Password"]."' ";
    $DB->query($sql);
    $DB->execute();
    if($DB->numRows()==0)
    {
        $_SESSION['error1']="wrong username or password";
        header('Location:Login_Register.php');

    }else if(isset($_SESSION['error1'])){
        unset($_SESSION['error1']);
        $x=$DB->getdata();

        $_SESSION['username']=$x[0]->fullname;
        $_SESSION['username']=$x[0]->username;
        $_SESSION['username']=$x[0]->email;
        $_SESSION['username']=$x[0]->n_id;
        $_SESSION['username']=$x[0]->accepted;
        $_SESSION['username']=$x[0]->active;
        $_SESSION['username']=$x[0]->gender;
        $_SESSION['username']=$x[0]->privilege;

        if(!empty($_POST['remember'])){
            setcookie("username", $_POST['username'], time()+(10 * 365 * 24 * 60 * 60));
            setcookie("password", $_POST['password'], time()+(10 * 365 * 24 * 60 * 60));
        }else{
            if(ISSET($_COOKIE['username'])){
                setcookie("username", "");
            }

            if(ISSET($_COOKIE['password'])){
                setcookie("password", "");
            }


        }
        header('Location:hello.php');   
    }
    else {

        $x=$DB->getdata();

        $_SESSION['username']=$x[0]->fullname;
        $_SESSION['username']=$x[0]->username;
        $_SESSION['username']=$x[0]->email;
        $_SESSION['username']=$x[0]->n_id;
        $_SESSION['username']=$x[0]->accepted;
        $_SESSION['username']=$x[0]->active;
        $_SESSION['username']=$x[0]->gender;
        $_SESSION['username']=$x[0]->privilege;


        if(!empty($_POST['remember'])){
            setcookie("username", $_POST['username'], time()+(10 * 365 * 24 * 60 * 60));
            setcookie("password", $_POST['password'], time()+(10 * 365 * 24 * 60 * 60));
        }else{
            if(ISSET($_COOKIE['username'])){
                setcookie("username", "");
            }

            if(ISSET($_COOKIE['password'])){
                setcookie("password", "");
            }


        }
        header('Location:hello.php');   

    }
}



?>