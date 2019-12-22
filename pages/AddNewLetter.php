<?php
$pageTitle = "SYSTEMNA | Add Letter";
include "../template/header.php";
?>

<?php
if (isset($_POST['Name'])) {
    $Name=filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $description=filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $sql="INSERT INTO requests_types (Name,description) VALUES ('$Name','$description') ";
    $DB->query($sql);
    $DB->execute();
    header("location: viewRequest.php");
}
?>

<h3> Add New Type of Letter </h3>
<hr>

<div>
    <form id="Addquestionform" method='post'>
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
