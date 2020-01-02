<?php
ob_start();
session_start();
global $pageTitle;
include('../DB/Database.php');
$DB = new Database();
if(!isset($_SESSION['type'])) header("Location:../index.php");

/* TEMP
array( "name" => "", "href" => "../pages/.php", "class" => "fas fa-sm icon-button" ),
*/

$hrPages = array(
    array( "name" => "Profile", "href" => "../pages/profile.php", "class" => "fas fa-id-card fa-sm icon-button" ),
    array( "name" => "Documents", "href" => "../pages/pn.php", "class" => "fas fa-file-upload fa-sm icon-button" ),
    array( "name" => "Dashboard", "href" => "../pages/index.php", "class" => "fas fa-home fa-sm icon-button" ), 
    array( "name" => "Request Letter", "href" => "../pages/MakeLetter.php", "class" => "fas fa fa-plus fa-sm icon-button" ),
    array( "name" => "Your Requests <div class='counter' id='ownletterrequests_Counter'></div>", "href" => "../pages/viewRequest.php", "class" => "fas fa-user fa-sm icon-button" ),
    array( "name" => "Pending Users <div class='counter' id='usrs_Counter'></div>", "href" => "../pages/waitingUsers.php", "class" => "fas fa-bell fa-sm icon-button" ),
    array( "name" => "Users Requests <div class='counter' id='usrsletterrequests_Counter'></div>", "href" => "../pages/letterRequests.php", "class" => "fas fa-users fa-sm icon-button" ),
    array( "name" => "Profile Requests <div class='counter' id='profile_Counter'></div>", "href" => "../pages/profileRequests.php", "class" => "fas fa-clock fa-sm icon-button" ),
    array( "name" => "Inquiries", "href" => "../pages/inquiries.php", "class" => "fas fa-envelope fa-sm icon-button" ),
    array( "name" => "Mass Messaging", "href" => "../pages/massmsgs.php", "class" => "fas fa-comments fa-sm icon-button" ),
    array( "name" => "Logout", "href" => "../pages/logout.php", "class" => "fa fa-sign-out-alt fa-sm icon-button" ),
);

$employeePages = array(
    array( "name" => "Profile", "href" => "../pages/profile.php", "class" => "fas fa-id-card fa-sm icon-button" ),
    array( "name" => "Documents", "href" => "../pages/pn.php", "class" => "fas fa-file-upload fa-sm icon-button" ),
    array( "name" => "Request Letter", "href" => "../pages/MakeLetter.php", "class" => "fas fa-envelope fa-sm icon-button" ),
    array( "name" => "Your Requests <div class='counter' id='ownletterrequests_Counter'></div>", "href" => "../pages/viewRequest.php", "class" => "fas fa-clock fa-sm icon-button" ),
    array( "name" => "Logout", "href" => "../pages/logout.php", "class" => "fa fa-sign-out-alt fa-sm icon-button" ),  
);

$qcPages = array(
    array( "name" => "Profile", "href" => "../pages/profile.php", "class" => "fas fa-id-card fa-sm icon-button" ), 
    array( "name" => "Documents", "href" => "../pages/pn.php", "class" => "fas fa-file-upload fa-sm icon-button" ),
    array( "name" => "Dashboard", "href" => "../pages/QualityControl.php", "class" => "fas fa-home fa-sm icon-button" ),
    array( "name" => "Request Letter", "href" => "../pages/MakeLetter.php", "class" => "fas fa-envelope fa-sm icon-button" ),
    array( "name" => "Your Requests <div class='counter' id='ownletterrequests_Counter'></div>", "href" => "../pages/viewRequest.php", "class" => "fas fa-clock fa-sm icon-button" ),
    array( "name" => "Your Comments", "href" => "../pages/viewComment.php", "class" => "fa fa-comment fa-sm icon-button" ),
    array( "name" => "Logout", "href" => "../pages/logout.php", "class" => "fa fa-sign-out-alt fa-sm icon-button" ),  
);                        

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/all.min.css">
        <link rel="stylesheet" href="../css/popup.css">
        <link rel="icon" type="image/png" href="../template/logo.png">
        <title><?php echo $pageTitle; ?></title>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/backend.js"></script>
        <script src="../js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container-custom">
            <header class="header">
                <div class="navbar-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <img src="../template/logo.png" alt="SYSTEMNA Logo" style="width: 25px; height: 25px;">
                <a style="text-decoration: none;" href="<?php echo $_SESSION['type']=='admin' ? 'index.php' : '../pages/MakeLetter.php'  ?>"><div class="logo-name"><strong style="color: #DAA520">System</strong><strong style="color: #212529" id="na">na</strong></div></a>
                <span id="noti_Container" style="padding-left: 1em;">
                    <a id="noti_Button">
                        <i class='fas fa fa-bell  fa-sm icon-button'></i>
                        <div class="counter" id="noti_Counter"></div> <!-- Show notifications count -->
                        <div id="notifications"> <!-- Notifications box -->
                            <div id="notidata"></div> <!-- Notifications Data -->
                            <div id="markAll">Mark All as Read</div> <!-- Notifications mark all as read button -->
                        </div>
                    </a>
                </span>
                <!-- Theme toggle -->
                <div class="right" id="themeToggle" style="cursor:pointer;"><span id="themeToggleBtn">🌚</span></div>
            </header>
            <div class="mainPage">
                <div class="sidenav-custom">
                    <a style="text-decoration: none;" href="../pages/profile.php">
                        <div class="sidenav-header">
                            <div class="avatar"><img src="<?php echo file_exists('../usersImages/' . $_SESSION['id'] . '.jpeg') ? '../usersImages/' . $_SESSION['id'] . '.jpeg' : '../template/avatar.jpg'; ?>" alt="" class="rounded-circle-custom"></div>
                            <div class="title">
                                <h1 class="name"><!-- Getting the first name initial then the lastname -->
                                    <?php
                                    $fullname = $_SESSION["name"];
                                    $fLetter = substr($fullname, 0, 1).'.';
                                    $Lname = substr($fullname, strpos($fullname, ' ', 0));
                                    $newname = $fLetter . $Lname;
                                    echo($newname);
                                    ?>
                                </h1>
                                <div class="position">
                                    <?php 
                                    if($_SESSION['type'] == "admin")
                                        echo "Admin";
                                    else if ($_SESSION['type'] == "user")
                                        echo "Employee";
                                    else if ($_SESSION['type'] == "qc")
                                        echo "QC";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul>
                        <?php 
                        if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){
                            for($i =0 ; $i<count($hrPages); $i++) {
                                echo "<li class='sidenav-button'>";
                                echo "<a href='" . $hrPages[$i]['href'] . "'>";
                                echo "<i class='" . $hrPages[$i]['class'] . "'></i>";
                                echo "<span class='button-text'>" . $hrPages[$i]['name'] . "</span>";
                                echo "</a>";
                                echo "</li>";
                            }
                        }else if(isset($_SESSION['type']) && $_SESSION['type']=='user'){
                            for($i =0 ; $i<count($qcPages); $i++) {
                                echo "<li class='sidenav-button'>";
                                echo "<a href='" . $qcPages[$i]['href'] . "'>";
                                echo "<i class='" . $qcPages[$i]['class'] . "'></i>";
                                echo "<span class='button-text'>" . $qcPages[$i]['name'] . "</span>";
                                echo "</a>";
                                echo "</li>";
                            }
                        }else if(isset($_SESSION['type']) && $_SESSION['type']=='qc'){

                            for($i =0 ; $i<count($qcPages); $i++) {
                                echo "<li class='sidenav-button'>";
                                echo "<a href='" . $qcPages[$i]['href'] . "'>";
                                echo "<i class='" . $qcPages[$i]['class'] . "'></i>";
                                echo "<span class='button-text'>" . $qcPages[$i]['name'] . "</span>";
                                echo "</a>";
                                echo "</li>";
                            }
                        } else header("Location:../index.php");
                        ?>
                    </ul>
                </div>
                <!-- Popup -->
                <div id="myModal" class="modal">
                    <div class="popup-notification" id='popup'>
                        <h2></h2>
                        <a class="popup-close" href="">&times;</a>
                        <div class="popup-content"></div>
                    </div>
                </div>


                <!--  Confirmation Popup  -->
                <div id="myModal" class="modalConfirmation">
                    <div class="confirmation-notification" id='confirmation'>
                        <h2>Confirm ?</h2>
                        <div class="confirmation-content"></div>
                        <div style="float: right; padding:5px;">
                            <input type="button" value="Confirm" id="confirmationButton">
                            <input type="button" value="Cancle" class="confirmation-close">
                        </div>
                    </div>
                </div>

                <!-- Loading -->
                <div class="loading hidden"></div>

                <div class="content">