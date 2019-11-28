<?php include "template/header.php"; ?>



<h3> Add New Question </h3>
<hr>
<br>


<div>
  <form id="Addquestionform" action="FAQ.php" method='post'>
    <h4>Question : </h4>
    <input type="text" id="Question" name="Question" placeholder="Your question.." required><br>
    <h4>Answer : </h4>
    <textarea id="Answer" name="Answer" placeholder="Question's Answer.." required></textarea>
    <br>
    <br>
    <br>
    <input type="submit" id = "btn1" value="Add Question">

  </form>
</div>

<?php include "template/footer.php"; ?>
