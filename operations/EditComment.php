<?php 
$pageTitle = "SYSTEMNA | Edit Comment";
include "../template/header.php"; 
?>
<?php
if (isset($_GET['id']))
{
    $id = $_GET['id'];
    if($id ==0)
    {
        header("Location: ../pages/viewComment.php");
    }
    else
    {
        $DataBase = new Database();
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
            error_log("Error while getting QC comment !");
        }
    }
}
if(isset($_POST['submit1']))
{
    $DataBase1 = new Database();
    $id = $_GET['id'];
    $Value = filter_var( $_POST['Comment'],FILTER_SANITIZE_STRING);
    $sql2 = "UPDATE Comment 
            SET Comment_value= '$Value'
            WHERE Comment_id = '$id';";
    $DataBase1->query($sql2);
    $DataBase1->execute();

    header("Location: ../pages/viewComment.php");
}
else if(!isset($_GET['id']))
{
    header("Location: ../pages/viewComment.php");
}
?>
<form action="" method="post" class="CommentForum">
    <h2 style="text-align:center;">Edit your comment here</h2>
    <input type="text" name="Comment" value="<?php echo $Comment[0]->Comment_value?>">
    <br>
    <input type="submit" name="submit1" value="Update" id="UpBttn">
</form>
<?php include "../template/footer.php"; 