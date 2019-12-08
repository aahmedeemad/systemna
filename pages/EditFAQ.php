<?php
include "../template/header.php"; 
if(!isset($_SESSION['username'])){header('Location:../index.php');}
 if($_SESSION['type']=='user'){header('Location:lettertypes.php');} 
if(isset($_GET['id']))
{
   $sql="select * from faq where ID='".$_GET['id']."' ";
   $DB->query($sql);
   $DB->execute();
   $x = $DB->getdata();
}
 
?>
<h3> Edit Questions </h3>
<hr>
<br>
<div>
    <form id="Addquestionform" method='post'>
        <h4>Question : </h4>
        <input type="text" id="question" name="Question" placeholder="Your question.." required
            value="<?php echo $x[0]->Question?>">
        <br>
        <h4>Answer : </h4>
        <textarea id="answer" name="Answer" placeholder="Question's Answer.." required
            value=><?php echo $x[0]->Answer ?></textarea>
        <br>
        <br>
        <br>
        <input type="submit" id="btn1" value="Add Question">
    </form>
</div>
<?php include "../template/footer.php"; ?>