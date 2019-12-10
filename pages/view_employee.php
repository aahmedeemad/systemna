  <?php 
$pageTitle = "SYSTEMNA | Profile";
include('../DB/Database.php');
$DB = new Database();
?>

<?php
$sql="SELECT * FROM employee e , requests r ,add_info a WHERE e.id = r.emp_id AND r.Request_id = ".$_POST['id']." and a.emp_id=r.emp_id" ;
$DB->query($sql);
$DB->execute();
$info=$DB->getdata();

?>
<?php
if($DB->numRows() > 0)
{
?>

<img src="../template/profileBackground.jpg" alt="" class="profile-background">
<div class="loading hidden"></div>
<div id="myModal" class="modal">
    <div class="popup-notification" id='popup'>
        <h2>Success</h2>
        <a class="popup-close" href="">&times;</a>
        <div class="popup-content">
            Your Request Has Been Submitted Successfully
        </div>
    </div>

</div>




<div class="profile">


    <div class="profile-left">
        <div class="image-container">
            <img src="<?php echo $info[0]->profile_picture == 0 ? "../template/avatar.jpg" :  "../usersImages/". $info[0]->id . ".jpeg" ?>" class="profile-picture">
            <div class="p-image">
                <i class="fa fa-camera profile-camera-button"></i>
                <input id="profile-picture-input" class="profile-picture-input hidden" type="file" accept="image/*"/>
            </div>
        </div>

        <div id="id" style="display:none"><?php echo $info[0]->id ?></div>
        <div id="fullname" class="user-name"><?php echo $info[0]->fullname; ?>
        </div> 


        <div class="user-position"><?php echo $info[0]->privilege; ?></div>
        <div class="title-info">Basic Info </span></div>
        <hr>
        <div id="ssn"><i class="fas fa-id-card fa-fw"></i> <?php echo $info[0]->ssn; ?></div>
        <div id="birthdate"><i class="fas fa-birthday-cake fa-fw"></i> <?php echo $info[0]->bdate == NULL ? "--" : $info[0]->bdate; ?></div>
        <div id="location"><i class="fas fa-globe-europe fa-fw"></i> <?php echo $info[0]->location == NULL ? "--" : $info[0]->location; ?></div>

    </div>

    <div class="profile-right">
        <div class="profile-right-up">
            <div class="title-info">Contact Info</div>
            <hr>
            <div id="mail"><i class="fas fa-envelope fa-fw"></i> <?php echo $info[0]->email; ?></div> 
            <div id="phone"><i class="fas fa-phone fa-fw"></i> <?php echo $info[0]->phone; ?></div>

            
            
        </div>

        <div class="profile-right-down">
            <div class="title-info">Company Info </div>
            <hr>

            <div id="username"><i class="fas fa-user fa-fw"></i> <?php echo $info[0]->username; ?></div>
          
            
        </div>
    </div>
</div>

<?php
} else {
    echo "<div>ERROR!! user not accepted</div>";
}
?>


