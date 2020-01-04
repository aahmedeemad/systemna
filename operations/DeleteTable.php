<?php
session_start();
if(!isset($_SESSION['type']))  header('Location:../index.php');
else if($_SESSION['type']!='admin')  header('Location:../pages/MakeLetter.php');
else {
    try {
        include "../DB/Database.php";
        $DB = new Database();
        if(isset($_GET['id'])){//make employee not active
            $d_id = $_GET['id'];
            $sql = "UPDATE employee SET active=0 WHERE id = '$d_id'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }   
        else if(isset($_GET['wid'])){//make waiting employee not active
            $d_id = $_GET['wid'];
            $sql = "UPDATE employee SET active=0 WHERE id = '$d_id'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }
        else if(isset($_GET['qid'])){//delete faq
            $qid = $_GET['qid'];
            $sql = "DELETE FROM faq WHERE ID = '$qid'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }
        else if(isset($_GET['lid'])){//delete letter types
            $lid = $_GET['lid'];
            $sql = "DELETE FROM requests_types WHERE type_id = '$lid'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        } 
        else { header("Location: ../pages/index.php"); }
    } 
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        error_log("Error while viewing faqs");
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
    }
}
?>