<?php   
session_start();
session_unset();
session_destroy();
unset($_COOKIE['username']);
setcookie('username',null , -1 , '/');
unset($_COOKIE['password']);
setcookie('password',null , -1 , '/');
header("location:../index.php"); 
?>