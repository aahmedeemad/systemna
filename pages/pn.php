<!--Passport And Nantional Pictures Upload-->

<?php 
$pageTitle = "SYSTEMNA | Passport And National ID";
include "../template/header.php"; 

if (isset($_GET['id']))
{
    if($_SESSION['type'] != "admin") header("location: MakeLetter.php");
    $noEdit = true;
    $id = $_GET['id'];
}
else {
    $noEdit = false;
    $id = $_SESSION['id'];
}

$sql="SELECT * FROM employee e , add_info a WHERE e.id = a.emp_id AND e.id = ".$id."" ;
$DB->query($sql);
$DB->execute();
$info=$DB->getdata();

if($DB->numRows() > 0)
{
?>

<div class="pn">
    <div class="pnleft">
        <div class="pntitle">Passport <span style="color: #DAA520">Photo</span></div>
        <img src="<?php echo $info[0]->passport_picture == 0 ? "../template/noImage.png" :  "../passportImages/". $info[0]->id . ".jpeg" ?>" class="passport-picture">
        <?php if($noEdit == false) { ?>
        <div class="passport-image">
            <i class="fa fa-camera passport-camera-button"></i>
            <input id="passport-picture-input" class="passport-picture-input hidden" type="file" accept="image/*"/>
        </div>

        <?php } ?>
    </div>
    <div class="pnline"></div>
    <div class="pnright">
        <div class="pntitle">National ID <span style="color: #DAA520">Photo</span></div>
        <img src="<?php echo $info[0]->passport_picture == 0 ? "../template/noImage.png" :  "../nationalImages/". $info[0]->id . ".jpeg" ?>" class="national-picture">
        <?php if($noEdit == false) { ?>
        <div class="national-image">
            <i class="fa fa-camera national-camera-button"></i>
            <input id="national-picture-input" class="national-picture-input hidden" type="file" accept="image/*"/>
        </div>
        <?php } ?>
    </div>
</div>

<?php
} else {
    echo "<div>ERROR!! Please Logout And Login Again</div>";
}
?>
<?php include "../template/footer.php"; ?>
