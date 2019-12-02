<?php 
session_start();
$SESSION['username']="Mark Refaat Ramzy";
include('../DB/Database.php');
$DB = new Database();
?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/all.min.css">
        <link rel="stylesheet" href="../css/popup.css">
        <link rel="icon" type="image/png" href="../template/logo.png">
        <title>Admin Page</title>
    </head>

    <body>
        <div class="container">
            <header class="header">
                <div class="navbar-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <a style="text-decoration: none;" href=""><div class="logo-name"><strong style="color: #DAA520">System</strong><strong style="color: white">na</strong></div></a>
                <div class="right"><a style="text-decoration: none; color:white;" href="../pages/logout.php">Logout</a>
                </div>
            </header>
            <div class="mainPage">
                <?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){ ?>
                <div class="sidenav">

                    <div class="sidenav-header">
                        <div class="avatar"><img src="../template/avatar.jpg" alt="" class="rounded-circle"></div>
                        <div class="title">
                            <a style="text-decoration: none;" href="../pages/profile.php"><h1 class="name"><?php echo $_SESSION['name']; ?></h1></a>
                            <div class="position">Admin</div>
                        </div>
                    </div>
                    <ul>
                        <li class="sidenav-button"><a href="../pages/index.php"><i class='fas fa-home fa-sm icon-button'></i><span class="button-text"> Home</span></a></li>
                        <li class="sidenav-button"><a href="../pages/AddQuestion.php"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> Add Question</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/faq.php"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> FAQ</span></a></li><li class="sidenav-button"></li>

                    </ul>
                </div>
                <?php }else if(isset($_SESSION['type']) && $_SESSION['type']=='user'){ ?>

                <div class="sidenav">

                    <div class="sidenav-header">
                        <div class="avatar"><img src="../template/avatar.jpg" alt="" class="rounded-circle"></div>
                        <div class="title">
                            <a style="text-decoration: none;" href="../pages/profile.php"><h1 class="name"><?php echo $_SESSION['name']; ?></h1></a>
                            <div class="position">Employee</div>
                        </div>
                    </div>
                    <ul>
                        <li class="sidenav-button"><a href="../pages/faq.php"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> FAQ</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/lettertypes.php"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> Letters</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/inquiries.php"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> Inquiries</span></a></li><li class="sidenav-button"></li>
                    </ul>
                </div>
                <?php } else header("Location:../index.php") ?>
                <div class="content">
