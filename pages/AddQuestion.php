<?php
$pageTitle = "SYSTEMNA | Add Question";
include "../template/header.php";
?>
<?php if($_SESSION['type']=='user') header('Location:MakeLetter.php'); ?>
<br>
<h3> Add New Question </h3>
<hr>
<br>
<div>
    <form id="Addquestionform" method='post'>
        <h4>Question: </h4>
        <input type="text" id="question" name="Question" placeholder="Your question..">
        <br>
        <h4>Answer: </h4>
        <textarea id="answer" name="Answer" placeholder="Question's Answer.."></textarea>
        <br>
        <h4>Requested by: </h4>
        <input type="text" id="requested_by" name="requested_by" placeholder="Requested by.." >
        <br>
        <br>
        <input type="button" id="faqaddques" value="Add Question">
    </form>
</div>

<?php include "../template/footer.php"; ?>
