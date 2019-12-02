<?php 
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
        <link rel="icon" type="image/png" href="logo.png">
        <title>Admin Page</title>
    </head>

    <body>
        <div class="container">
            <header class="header">
                <div class="navbar-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="logo-name"><strong style="color: #DAA520">System</strong><strong>na</strong></div>
                <div class="right">Logout</div>
            </header>
            <div class="mainPage">
                <div class="sidenav">
                    <div class="sidenav-header">
                        <div class="avatar"><img src="../template/avatar.jpg" alt="" class="rounded-circle"></div>
                        <div class="title">
                            <h1 class="name">Mark</h1>
                            <div class="position">Admin</div>
                        </div>
                    </div>
                    <ul>
                        <li class="sidenav-button"><a href="##"><i class='fas fa-home fa-sm icon-button'></i><span class="button-text"> Home</span></a></li>
                        <li class="sidenav-button"><a href="#"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> Pending Members</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="#"><i class='fas fa-users fa-sm icon-button'></i><span class="button-text"> Pending Members</span></a></li><li class="sidenav-button"></li>
                    </ul>
                </div>
                <div class="content">
