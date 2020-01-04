<?php
session_start();
if(!isset($_SESSION['type']))  header('Location:../index.php');
else if($_SESSION['type']!='admin')  header('Location:../pages/MakeLetter.php');
else {
    try {
        include "../DB/Database.php";
        $DB = new Database();
        if(isset($_POST['id'])){
            $d_id = $_POST['id'];
            $sql = "UPDATE employee SET active=0 WHERE id = '$d_id'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }   
        else if(isset($_POST['wid'])){
            $d_id = $_POST['wid'];
            $sql = "UPDATE employee SET active=0 WHERE id = '$d_id'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }
        else if(isset($_POST['qid'])){
            $qid = $_POST['qid'];
            $sql = "DELETE FROM faq WHERE ID = '$qid'";
            $DB->query($sql);
            $DB->execute();
            echo "true";
        }
        else if(isset($_POST['lid'])){
            $lid = $_POST['lid'];
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