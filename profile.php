<?php include "template/header.php"; ?>

<?php
$sql="SELECT * FROM employee e , add_info a WHERE e.id = a.emp_id AND e.id = 1" ;
$DB->query($sql);
$DB->execute();
$info=$DB->getdata();

?>
<?
if($DB->numRows() > 0)
{
?>

<img src="profileBackground.jpg" alt="" class="profile-background">
<div class="profile">


    <div class="profile-left">
        <!--        <div class="user-sex"><i class="fas fa-venus"></i></div>-->
        <div class="image-container">
            <img src="<?php echo $info[0]->profile_picture == 0 ? "avatar.jpg" :  "usersImages/". $info[0]->id . ".jpeg" ?>" class="profile-picture">
            <input id="profile-image-upload" class="hidden" type="file" accept="image/*"> 
            <div class="p-image">
                <i class="fa fa-camera upload-button"></i>
                <input id="file-upload" class="file-upload hidden" type="file" accept="image/*"/>
            </div>
        </div>

        <div id="id" style="display:none">1</div>
        <div id="fullname" class="user-name"><?php echo $info[0]->fullname; ?>
            <span class="edit edit-fullname"><i class="fas fa-pen"></i></span>
        </div> 

        <div class="input-edit input-fullname hidden" ><input id="fullnameEdit" type="text" value="<?php echo $info[0]->fullname; ?>"></div>
        <div class="save save-fullname hidden"><span><i class="fas fa-check"></i></span></div>
        <div class="cancel cancel-fullname hidden"><span><i class="fas fa-times"></i></span></div>


        <div class="user-position"><?php echo $info[0]->privilege; ?></div>
        <div class="title-info">Basic Info <span class="edit edit-basic-info"><i class="fas fa-pen"></i></span></div>
        <hr>
        <div id="ssn"><i class="fas fa-id-card fa-fw"></i> <?php echo $info[0]->ssn; ?></div>
        <div id="birthdate"><i class="fas fa-birthday-cake fa-fw"></i> <?php echo $info[0]->bdate; ?></div>
        <div id="location"><i class="fas fa-globe-europe fa-fw"></i> <?php echo $info[0]->location; ?></div>

        <div class="input-edit input-basic-info hidden"  ><i class="fas fa-id-card fa-fw"></i><input id="ssnEdit" type="text" value="<?php echo $info[0]->ssn; ?>"></div>
        <div class="input-edit input-basic-info hidden" ><i class="fas fa-birthday-cake fa-fw"></i><input id="birthdateEdit" type="date" value="<?php echo $info[0]->bdate; ?>"></div>
        <div class="input-edit input-basic-info hidden"><i class="fas fa-globe-europe fa-fw"></i><input  id="locationEdit" type="text" value="<?php echo $info[0]->location; ?>"></div>

        <div class="save save-basic-info hidden">Save</div>
        <div class="cancel cancel-basic-info hidden">Cancel</div>
    </div>

    <div class="profile-right">
        <div class="profile-right-up">
            <div class="title-info">Contact Info <span class="edit edit-contact-info"><i class="fas fa-pen"></i></span></div>
            <hr>
            <div id="mail"><i class="fas fa-envelope fa-fw"></i> <?php echo $info[0]->email; ?></div> 
            <div id="phone"><i class="fas fa-phone fa-fw"></i> <?php echo $info[0]->phone; ?></div>

            <div class="input-edit input-contact-info hidden"><i class="fas fa-envelope fa-fw"></i><input id="emailEdit" type="email" value="<?php echo $info[0]->email; ?>"></div>
            <div class="input-edit input-contact-info hidden"><i class="fas fa-phone fa-fw"></i><input id="phoneEdit" type="number" value="<?php echo $info[0]->phone; ?>"></div>

            <div class="save save-contact-info hidden">Save</div>
            <div class="cancel cancel-contact-info hidden">Cancel</div>

        </div>

        <div class="profile-right-down">
            <div class="title-info">Company Info <span class="edit edit-company-info"><i class="fas fa-pen"></i></span></div>
            <hr>

            <div id="username"><i class="fas fa-user fa-fw"></i> <?php echo $info[0]->username; ?></div>
            <div id="password">
                <i class="fas fa-key fa-fw"></i> 
                <span class="starts">********</span> 
                <span class="pass hidden"><?php echo $info[0]->password; ?></span> 
                <span class="eye">
                    <i class="far fa-eye"></i>
                </span>
            </div>

            <div class="input-edit input-company-info hidden"><i class="fas fa-user fa-fw"></i><input id="usernameEdit" type="text" value="<?php echo $info[0]->username; ?>"></div>
            <div class="input-edit input-company-info hidden"><i class="fas fa-key fa-fw"></i><input id="passwordEdit" type="password" value="<?php echo $info[0]->password; ?>"><span class="eye eyeedit"><i class="far fa-eye"></i></span></div>

            <!--            <div id="salary"><i class="fas fa-money-bill-alt"></i> 2000<span style="color : green;">$</span></div>-->

            <div class="save save-company-info hidden">Save</div>
            <div class="cancel cancel-company-info hidden">Cancel</div>
        </div>
    </div>
</div>

<?php
} else {
    echo "<div>ERROR!! Please Logout And Login Again</div>";
}
?>

<?php include "template/footer.php"; ?>
