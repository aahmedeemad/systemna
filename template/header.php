<?php
session_start();
global $pageTitle;
include('../DB/Database.php');
$DB = new Database();
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
    </head>

    <body>
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script>

            $(document).ready(function () {
                $('.pages_edit').text(
                    '<?php
                    echo ('Edit');
                    ?>'
                );

                $('#faq_add').text(
                    '<?php
                    echo ('Add Question');
                    ?>'
                );

                $('#usrs_Counter').text(
                    '<?php
                    $sql = "SELECT * FROM employee WHERE accepted = 2 ";
                    $DB->query($sql);
                    $DB->execute();
                    echo ($DB->numRows());
                    ?>'
                );

                $('#noti_Counter').text(
                    '<?php
                    $uid = $_SESSION['id'];
                    $sql = " SELECT * FROM notifications WHERE  userid = $uid AND status = 0 ";
                    $DB->query($sql);
                    $DB->execute();
                    echo ($DB->numRows());
                    ?>'
                );

                $('#notidata').html(
                    '<?php
                    $uid = $_SESSION['id'];
                    $sql = "SELECT * FROM notifications WHERE userid = $uid AND status = 0 ";
                    $DB->query($sql);
                    $DB->execute();
                    for($i=$DB->numRows(); $i>0; --$i){
                        $x=$DB->getdata();
                        echo "<hr>" . ($i) . "- " . $x[$i-1]->notidata ;
                    }
                    ?>'
                ).css('height', '20vw');

                $('#noti_Button').click(function () {
                    // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
                    $('#notifications').fadeToggle('fast', 'linear');
                    return false;
                });

                //HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
                $(document).click(function () {
                    $('#notifications').hide();
                });

                $('#notifications').click(function () {
                    // DO NOTHING WHEN CONTAINER IS CLICKED.
                    return false;
                });
            });

                var markRead = new XMLHttpRequest();
                markRead.open('GET','../template/mark_read.php');
                markRead.onreadystatechange = function() {
                    if (markRead.readyState === 4) {
                        document.getElementById('notidata').innerHTML = ' ';
                        document.getElementById('noti_Counter').innerHTML = '0';
                    }
                };

                var editFAQ = new XMLHttpRequest();
                editFAQ.open('GET','../pages/viewFAQ.php');
                editFAQ.onreadystatechange = function() {
                    if (editFAQ.readyState === 4) {
                        document.location.replace('../pages/viewFAQ.php');
                    }
                };

                var addFAQ = new XMLHttpRequest();
                addFAQ.open('GET','../pages/AddQuestion.php');
                addFAQ.onreadystatechange = function() {
                    if (addFAQ.readyState === 4) {
                        document.location.replace('../pages/AddQuestion.php');
                    }
                };

        </script>
        <div class="container-custom">
            <header class="header">
                <div class="navbar-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <a style="text-decoration: none;" href="<?php echo $_SESSION['type']=='admin' ? 'index.php' : '../pages/MakeLetter.php'  ?>"><div class="logo-name"><strong style="color: #DAA520">System</strong><strong style="color: white">na</strong></div></a>
                <div class="right"><a style="text-decoration: none; color:white;" href="../pages/logout.php">Logout</a>
                </div>
            </header>
            <div class="mainPage">
                <?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){ ?>
                <div class="sidenav-custom">
                    <div class="sidenav-header">
                        <div class="avatar"><img src="../template/avatar.jpg" alt="" class="rounded-circle"></div>
                        <div class="title">
                            <a style="text-decoration: none;" href="../pages/profile.php"><h1 class="name"><?php echo $_SESSION['name']; ?></h1></a>
                            <div class="position">Admin</div>
                        </div>
                    </div>
                    <ul>
                        <li class="sidenav-button"><a href="<?php echo $_SESSION['type']=='admin' ? 'index.php' : '../pages/MakeLetter.php'  ?>"><i class='fas fa-home fa-sm icon-button'></i><span class="button-text"> Home</span></a></li>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa-user fa-sm icon-button'></i><span class="button-text"> Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/waitingUsers.php"><i class='fas fa-clock fa-sm icon-button'></i><span class="button-text"> Waiting Users <div id="usrs_Counter"></div> </span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/MakeLetter.php"><i class='fas fa-envelope fa-sm icon-button'></i><span class="button-text"> Request Letters</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/viewRequest.php"><i class='fas fa-clock fa-sm icon-button'></i><span class="button-text"> View Requests</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/AddNewLetter.php"><i class='fas fa-envelope fa-sm icon-button'></i><span class="button-text"> Add New type of letter</span></a></li><li class="sidenav-button"></li>

                        <li class="sidenav-button"><a href="../pages/letter_requests.php"><i class='fas fa-question-circle fa-sm icon-button'></i><span class="button-text"> Letter Requests</span></a></li><li class="sidenav-button"></li>

                        <li class="sidenav-button"><a href="../pages/faq.php"><i class='fas fa-question-circle fa-sm icon-button'></i><span class="button-text"> FAQ </span></a></li><li class="sidenav-button"></li>
                    </ul>
                </div>
                <?php }else if(isset($_SESSION['type']) && $_SESSION['type']=='user'){ ?>
                <div class="sidenav-custom">
                    <div class="sidenav-header">
                        <div class="avatar"><img src="../template/avatar.jpg" alt="" class="rounded-circle"></div>
                        <div class="title">
                            <a style="text-decoration: none;" href="../pages/profile.php"><h1 class="name"><?php echo $_SESSION['name']; ?></h1></a>
                            <div class="position">Employee</div>
                        </div>
                    </div>
                    <ul>
                        <li class="sidenav-button"><a href="<?php echo $_SESSION['type']=='admin' ? 'index.php' : '../pages/MakeLetter.php'  ?>"><i class='fas fa-home fa-sm icon-button'></i><span class="button-text"> Home</span></a></li>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa-user fa-sm icon-button'></i><span class="button-text"> Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button" id="noti_Container"><a id="noti_Button"><i class='fas fa fa-bell  fa-sm icon-button'></i><span class="button-text"> Notifications
                            <div id="noti_Counter"></div><!--SHOW NOTIFICATIONS COUNT.-->
                            <div id="notifications"><!--THE NOTIFICAIONS DROPDOWN BOX.-->
                                <div id="notidata"></div>
                                <div id="markAll" onclick="markRead.send()">Mark All as Read</div>
                            </div>
                            </span></a></li>
                        <li class="sidenav-button"><a href="../pages/MakeLetter.php"><i class='fas fa-envelope fa-sm icon-button'></i><span class="button-text"> Request Letters</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/viewRequest.php"><i class='fas fa-clock fa-sm icon-button'></i><span class="button-text"> View Requests</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/faq.php"><i class='fas fa-question-circle fa-sm icon-button'></i><span class="button-text"> FAQ</span></a></li><li class="sidenav-button"></li>

                    </ul>
                </div>
                <?php }else if(isset($_SESSION['type']) && $_SESSION['type']=='qc'){ ?>
                <div class="sidenav-custom">
                    <div class="sidenav-header">
                        <div class="avatar"><img src="../template/avatar.jpg" alt="" class="rounded-circle"></div>
                        <div class="title">
                            <a style="text-decoration: none;" href="../pages/profile.php"><h1 class="name"><?php echo $_SESSION['name']; ?></h1></a>
                            <div class="position">QC</div>
                        </div>
                    </div>
                    <ul>
                        <li class="sidenav-button"><a href="<?php echo $_SESSION['type']=='admin' ? 'index.php' : '../pages/MakeLetter.php'  ?>"><i class='fas fa-home fa-sm icon-button'></i><span class="button-text"> Home</span></a></li>
                        <li class="sidenav-button"><a href="../pages/profile.php"><i class='fas fa-user fa-sm icon-button'></i><span class="button-text"> Profile</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button" id="noti_Container">
                            <a id="noti_Button"><i class='fas fa fa-bell  fa-sm icon-button'></i><span class="button-text"> Notifications
                                <div id="noti_Counter"></div><!--SHOW NOTIFICATIONS COUNT.-->
                                <div id="notifications"><!--THE NOTIFICAIONS DROPDOWN BOX.-->
                                    <div id="notidata"></div>
                                    <div id="markAll">Mark All as Read</div>
                                </div>
                                </span>
                            </a>
                        </li>
                        <li class="sidenav-button"><a href="../pages/MakeLetter.php"><i class='fas fa-envelope fa-sm icon-button'></i><span class="button-text"> Request Letters</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/viewRequest.php"><i class='fas fa-clock fa-sm icon-button'></i><span class="button-text"> View Requests</span></a></li><li class="sidenav-button"></li>
                        <li class="sidenav-button"><a href="../pages/faq.php"><i class='fas fa-question-circle fa-sm icon-button'></i><span class="button-text"> FAQ</span></a></li><li class="sidenav-button"></li>
                    </ul>
                </div>

                <?php } else header("Location:../index.php") ?>
                <div class="content">
