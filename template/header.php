<?php
session_start();
global $pageTitle;
include('../DB/Database.php');
$DB = new Database();
if(!isset($_SESSION['type'])) header("Location:../index.php");
?>
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/all.min.css">
        <link rel="stylesheet" href="../css/popup.css">
        <link rel="icon" type="image/png" href="../template/logo.png">
        <title><?php echo $pageTitle;?></title>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/backend.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>

    <body>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <div class="container-custom">
            <header class="header">
                <div class="navbar-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <a style="text-decoration: none;" href="<?php echo $_SESSION['type']=='admin' ? 'index.php' : '../pages/MakeLetter.php'  ?>"><div class="logo-name"><strong style="color: #DAA520">System</strong><strong style="color: #212529" id="na">na</strong></div></a>
                <span id="noti_Container" style="padding-left: 1em;">
                    <a id="noti_Button">
                        <i class='fas fa fa-bell  fa-sm icon-button'></i>
                        <div class="counter" id="noti_Counter"></div><!--SHOW NOTIFICATIONS COUNT.-->
                        <div id="notifications"><!--THE NOTIFICAIONS DROPDOWN BOX.-->
                            <div id="notidata"></div>
                            <div id="markAll">Mark All as Read</div>
                        </div>
                    </a>
                </span>
                <div class="right" id="themeToggle" style="cursor:pointer;"><button type="button" id="themeToggleBtn">🌛</button></div>
                <div class="right"><a id="alogout" style="text-decoration:none; color: #212529;" href="../pages/logout.php">Logout</a>
                </div>
            </header>
            <div class="mainPage">
                <?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){ ?>
                <div class="sidenav-custom">
                    <a style="text-decoration: none;" href="../pages/profile.php">
                        <div class="sidenav-header">
                            <div class="avatar"><img src="<?php echo file_exists('../usersImages/' . $_SESSION['id'] . '.jpeg') ? '../usersImages/' . $_SESSION['id'] . '.jpeg' : '../template/avatar.jpg'; ?>" alt="" class="rounded-circle-custom"></div>
                            <div class="title">
                                <h1 class="name"><?php
                                $fullname = $_SESSION["name"];
                                $fLetter = substr($fullname, 0, 1).'.';
                                $Lname = substr($fullname, strpos($fullname, ' ', 0));
                                $newname = $fLetter . $Lname;
                                echo($newname);
                                ?></h1>
                                <div class="position">Admin</div>
                            </div>
                        </div>
                    </a>
                    <ul>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa fa-id-card fa-sm icon-button'></i><span class="button-text">Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/index.php"><i class='fas fa-home fa-sm icon-button'></i><span class="button-text">Dashboard</span></a></li>
                        <li class="sidenav-button"><a href="../pages/MakeLetter.php"><i class='fas fa fa-plus fa-sm icon-button'></i><span class="button-text">Request Letter</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/viewRequest.php"><i class='fas fa-user fa-sm icon-button'></i><span class="button-text">Your Requests <div class="counter" id="ownletterrequests_Counter"></div></span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/waitingUsers.php"><i class='fas fa fa-bell fa-sm icon-button'></i><span class="button-text">Pending Users <div class="counter" id="usrs_Counter"></div></span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/letter_requests.php"><i class='fas fa fa-users fa-sm icon-button'></i><span class="button-text">Users Requests <div class="counter" id="usrsletterrequests_Counter"></div></span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/profileRequests.php"><i class='fas fa-clock fa-sm icon-button'></i><span class="button-text">Profile Requests <div class="counter" id="profile_Counter"></div></span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/inquiries.php"><i class='fas fa-envelope fa-sm icon-button'></i><span class="button-text">Inquiries</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/massmsgs.php"><i class='fa fa-comments fa-sm icon-button'></i><span class="button-text">Mass Messaging</span></a></li><li class="sidenav-button"></li>
                    </ul>
                </div>
                <?php }else if(isset($_SESSION['type']) && $_SESSION['type']=='user'){ ?>
                <div class="sidenav-custom">
                    <a style="text-decoration: none;" href="../pages/profile.php">
                        <div class="sidenav-header">
                            <div class="avatar"><img src="<?php echo file_exists('../usersImages/' . $_SESSION['id'] . '.jpeg') ? '../usersImages/' . $_SESSION['id'] . '.jpeg' : '../template/avatar.jpg'; ?>" alt="" class="rounded-circle-custom"></div>
                            <div class="title">
                                <h1 class="name"><?php
                                $fullname = $_SESSION["name"];
                                $fLetter = substr($fullname, 0, 1).'.';
                                $Lname = substr($fullname, strpos($fullname, ' ', 0));
                                $newname = $fLetter . $Lname;
                                echo($newname);
                                ?></h1>
                                <div class="position">Employee</div>
                            </div>
                        </div>
                    </a>
                    <ul>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa-user fa-sm icon-button'></i><span class="button-text">Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/MakeLetter.php"><i class='fas fa-envelope fa-sm icon-button'></i><span class="button-text">Request Letter</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/viewRequest.php"><i class='fas fa-clock fa-sm icon-button'></i><span class="button-text">Your Requests <div class="counter" id="ownletterrequests_Counter"></div></span></a></li><li class="sidenav-button"></li>

                    </ul>
                </div>
                <?php }else if(isset($_SESSION['type']) && $_SESSION['type']=='qc'){ ?>
                <div class="sidenav-custom">
                    <a style="text-decoration: none;" href="../pages/profile.php">
                        <div class="sidenav-header">
                            <div class="avatar"><img src="<?php echo file_exists('../usersImages/' . $_SESSION['id'] . '.jpeg') ? '../usersImages/' . $_SESSION['id'] . '.jpeg' : '../template/avatar.jpg'; ?>" alt="" class="rounded-circle-custom"></div>
                            <div class="title">
                                <h1 class="name"><?php
                                $fullname = $_SESSION["name"];
                                $fLetter = substr($fullname, 0, 1).'.';
                                $Lname = substr($fullname, strpos($fullname, ' ', 0));
                                $newname = $fLetter . $Lname;
                                echo($newname);
                                ?></h1>
                                <div class="position">QC</div>
                            </div>
                        </div>
                    </a>
                    <ul>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa-user fa-sm icon-button'></i><span class="button-text"> Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/QualityControl.php"><i class='fas fa-home fa-sm icon-button'></i><span class="button-text">Dashboard</span></a></li>
                        <li class="sidenav-button"><a href="../pages/MakeLetter.php"><i class='fas fa-envelope fa-sm icon-button'></i><span class="button-text">Request Letter</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/viewRequest.php"><i class='fas fa-clock fa-sm icon-button'></i><span class="button-text">Your Requests <div class="counter" id="ownletterrequests_Counter"></div></span></a></li><li class="sidenav-button"></li>
                    </ul>
                </div>

                <?php } else header("Location:../index.php"); ?>
                <div id="myModal" class="modal">
                    <div class="popup-notification" id='popup'>
                        <h2></h2>
                        <a class="popup-close" href="">&times;</a>
                        <div class="popup-content"></div>
                    </div>
                </div>
                <div class="loading hidden"></div>
                <div class="content">