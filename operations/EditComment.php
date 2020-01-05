<?php 
$pageTitle = "SYSTEMNA | Edit Comment";
include "../template/header.php"; 
?>
<?php
if (isset($_GET['id']))
{
    $id = $_GET['id'];
    if($id ==0) // Tried to write id=0
    {
        header("Location: ../pages/viewComment.php");
    }
    else
    {
        $DataBase = new Database();
        // SQL Query
        $sql = "SELECT Comment_value FROM comment 
                WHERE Comment_id = '$id';";
        $DataBase->query($sql);
        $DataBase->execute();
        try
        {
            $Comment = $DataBase->getData();
        }
        catch(Exception $e)
        {
            $_SESSION['error'] = 'error in sql';
            echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
            error_log("Error while editing QC comment !");
        }
    }
}
if(isset($_POST['submit1'])) // When he click on update comment btn
{
    $DataBase1 = new Database();
    $id = $_GET['id'];
    $Value = filter_var( $_POST['Comment'],FILTER_SANITIZE_STRING); // Filter it from html tags and SQL injection

    // SQL Query
    $sql2 = "UPDATE Comment 
             SET Comment_value= '$Value'
             WHERE Comment_id = '$id';";
    $DataBase1->query($sql2);
    $DataBase1->execute();

    header("Location: ../pages/viewComment.php");
}
else if(!isset($_GET['id'])) // If he tried to access it from the url
{
    header("Location: ../pages/viewComment.php");
}
?>
<h2 style="text-align:center;">Edit your comment here</h2>
<div class="CommentForum">
<form method="post">
    <textarea type="text" name="Comment" id="Comment_Value" rows="4" cols="30"><?php echo $Comment[0]->Comment_value?></textarea>
    <br>
    <input type="submit" name="submit1" value="Update" id="UpBttn">
</form>
</div>

<?php include "../template/footer.php"; 