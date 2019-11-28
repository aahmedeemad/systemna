<?php include "template/header.php"; 
if (isset($_POST['question'])) {


$question=$_POST['question'];
$answer=$_POST['answer'];
$sql="INSERT INTO questions (question,answer) VALUES ('$question','$answer') ";

$DB->query($sql);
$DB->execute();
}
?>



<h3> Add New Question </h3>
<hr>
<br>


<div>
  <form id="Addquestionform" action="FAQ.php" method='post'>
    <h4>Question : </h4>
    <input type="text" id="question" name="question" placeholder="Your question.." required><br>
    <h4>Answer : </h4>
    <textarea id="answer" name="answer" placeholder="Question's Answer.." required></textarea>
    <br>
    <br>
    <br>
    <input type="submit" id = "btn1" value="Add Question">

  </form>
</div>

<?php include "template/footer.php"; ?>
