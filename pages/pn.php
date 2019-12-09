<!--Passport And Nantional Pictures Upload-->

<?php 
$pageTitle = "SYSTEMNA | Passport And National ID";
include "../template/header.php"; 
?>

<?php
$sql="SELECT * FROM employee e , add_info a WHERE e.id = a.emp_id AND e.id = ".$_SESSION['id']."" ;
$DB->query($sql);
$DB->execute();
$info=$DB->getdata();

?>
<?php
if($DB->numRows() > 0)
{
?>

<div class="pn">
    <div class="pnleft">
        <div class="pntitle">Passport <span style="color: #DAA520">Photo</span></div>
        <img src="<?php echo $info[0]->passport_picture == 0 ? "../template/avatar.jpg" :  "../passportImages/". $info[0]->id . ".jpeg" ?>" class="passport-picture">
        <div class="passport-image">
            <i class="fa fa-camera passport-camera-button"></i>
            <input id="passport-picture-input" class="passport-picture-input hidden" type="file" accept="image/*"/>
        </div>
    </div>
    <div class="pnline"></div>
    <div class="pnright">
        <div class="pntitle">National ID <span style="color: #DAA520">Photo</span></div>
        <img src="<?php echo $info[0]->passport_picture == 0 ? "../template/avatar.jpg" :  "../nationalImages/". $info[0]->id . ".jpeg" ?>" class="national-picture">
        <div class="national-image">
            <i class="fa fa-camera national-camera-button"></i>
            <input id="national-picture-input" class="national-picture-input hidden" type="file" accept="image/*"/>
        </div>
    </div>
</div>

<?php
} else {
    echo "<div>ERROR!! Please Logout And Login Again</div>";
}
?>

<?php include "../template/footer.php"; ?>
