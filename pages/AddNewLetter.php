<?php
ob_start();
$pageTitle = "SYSTEMNA | Add Letter";
include "../template/header.php";
if($_SESSION['type']=='user') header('Location:MakeLetter.php');

if(isset($_GET['id'])){

    $sql="SELECT * FROM requests_types WHERE type_id =" . $_GET['id'];
    $DB->query($sql);
    $DB->execute();
    $x = $DB->getdata();
?>

<h3> Edit Letter </h3>
<hr>

<div>
    <form id="Addquestionform" method='post' action="../operations/newLetter.php">
        <input type="hidden" name="id" class="hidden" value="<?php echo $x[0]->Type_id; ?>">
        <h4>Letter Name: </h4>
        <input type="text" id="Name" name="Name" placeholder="new letter name.." value="<?php echo $x[0]->Name; ?>" required>
        <br>
        <h4>Letter description: </h4>
        <textarea id="description" name="description" placeholder="description of the new letter.." required><?php echo $x[0]->description; ?></textarea>
        <br>
        <br>
        <br>
        <br>
        <input type="submit" name="updateLetter" id="updateLetter" value="Update Letter">
    </form>
</div>

<?php } else { ?>
<br>
<h3> Add New Type of Letter </h3>
<hr>
<br>
<div>
    <form id="Addquestionform" method='post' action="../operations/newLetter.php">
        <h4>Letter Name: </h4>
        <input type="text" id="Name" name="Name" placeholder="new letter name.." required>
        <br>
        <h4>Letter description: </h4>
        <textarea id="description" name="description" placeholder="description of the new letter.." required></textarea>
        <br>
        <br>
        <input type="submit" name="addLetter" id = "AddLetterbtn" value="Add Letter">
    </form>
</div>

<?php
}
ob_end_flush();
include "../template/footer.php";
?>
