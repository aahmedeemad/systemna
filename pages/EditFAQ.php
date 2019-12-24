<?php
ob_start();
$pageTitle = "SYSTEMNA | Edit FAQ";
include "../template/header.php"; 
if($_SESSION['type']=='user') header('Location:MakeLetter.php');
?>
<h3> Edit Questions </h3>
<hr>
<br>
<?php
if(isset($_GET['id']))
{
    if(isset($_POST['EditFAQ'])){
        $Question = filter_var($_POST["Question"], FILTER_SANITIZE_STRING);
        $Answer = filter_var($_POST["Answer"], FILTER_SANITIZE_STRING);
        $sql="update faq set Question = '$Question', Answer = '$Answer' where ID='".$_GET['id']."' ";
        $DB->query($sql);
        $DB->execute();
        header('Location:viewFAQ.php');
    }
    try
    {
        $sql="select * from faq where ID='".$_GET['id']."' ";
        $DB->query($sql);
        $DB->execute();
        $x = $DB->getdata();
?>
<div>
    <form id="Addquestionform" method='post' action=''>
        <h4>Question : </h4>
        <input type="text" id="question" name="Question" placeholder="Your question.." required
               value="<?php echo $x[0]->Question?>">
        <br>
        <h4>Answer : </h4>
        <textarea id="answer" name="Answer" placeholder="Question's Answer.."
                  required><?php echo $x[0]->Answer ?></textarea>
        <br>
        <br>
        <br>
        <input type="submit" id="btn1" value="Update Question" name='EditFAQ'>
    </form>
</div>
<?php
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }
} else header("location: index.php");
?>
<?php 
include "../template/footer.php"; 
ob_end_flush();
?>