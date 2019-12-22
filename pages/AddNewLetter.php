
<?php
$pageTitle = "SYSTEMNA | Add Letter";
include "../template/header.php";
?>

<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}
if($_SESSION['type']=='user'){header('Location:MakeLetter.php');}    ?>


<h3> Add New Type of Letter </h3>
<hr>

<div>
    <form id="Addquestionform" method='post' action="../operations/newLetter.php">
        <h4>Letter Name: </h4>
        <input type="text" id="Name" name="Name" placeholder="new letter name.." required>
        <br>
        <h4>Letter description: </h4>
        <textarea id="description" name="description" placeholder="description of the new letter.." required></textarea>
        <br>
        <br>
        <br>
        <br>
        <input type="submit" id = "btn2" value="Add Letter">
    </form>
</div>

<?php include "../template/footer.php"; ?>
