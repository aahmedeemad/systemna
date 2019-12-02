<?php include "../template/header.php"; 
if (isset($_POST['Question'])) {


$Question=$_POST['Question'];
$Answer=$_POST['Answer'];
$Added_by=1;
$sql="INSERT INTO faq (Question,Answer,Added_by) VALUES ('$Question','$Answer','$Added_by') ";

$DB->query($sql);
$DB->execute();
}
?>



<h3> Add New Question </h3>
<hr>
<br>


<div>
  <form id="Addquestionform" action="faq.php" method='post'>
    <h4>Question : </h4>
    <input type="text" id="question" name="Question" placeholder="Your question.." required><br>
    <h4>Answer : </h4>
    <textarea id="answer" name="Answer" placeholder="Question's Answer.." required></textarea>
    <br>
    <br>
    <br>
    <input type="submit" id = "btn1" value="Add Question">

  </form>
</div>

<?php include "../template/footer.php"; ?>
