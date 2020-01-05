<?php 
$pageTitle = "SYSTEMNA | Profile";

?>
<?php
if (isset($_GET['addinfo']))
{
    if($_SESSION['type']!='admin') header('Location:MakeLetter.php');
    echo '
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/backend.js"></script>
        ';
    $noEdit = true;
    $id = $_GET['id'];
    $addinfoo=$_GET['addinfo'];
    echo"<p style='background-color:#dddd59; padding:6px; color:grey'>Additional info of the request : <br>" .$addinfoo. "</p>";
    include'../DB/Database.php';
    $DB=new Database();
}
else {
    include "../template/header.php"; 
    if(isset($_GET['id']))
    {
        if($_SESSION['type']!='admin') header('Location:MakeLetter.php');
        $noEdit = true;
        $id = $_GET['id'];
    }
    else
    {
        $noEdit = false;
        $id = $_SESSION['id'];
    }
}
$sql="SELECT * FROM employee e , add_info a WHERE e.id = a.emp_id AND e.id = " . $id;
try
{
    $DB->query($sql);
    $DB->execute();
    $info=$DB->getdata();

?>
<?php
    if($DB->numRows() > 0)
    {
?>

<img src="../template/profileBackground.jpg" alt="" class="profile-background">

<div class="profile">
    <div class="profile-left">
        <div class="image-container">
            <img src="<?php echo file_exists('../usersImages/' . $id . '.jpeg') ? '../usersImages/' . $id . '.jpeg' : '../template/avatar.jpg'; ?>" class="profile-picture">
            <?php if($noEdit == false) { ?> <div class="p-image">
            <i class="fa fa-camera profile-camera-button"></i>
            <input id="profile-picture-input" class="profile-picture-input hidden" type="file" accept="image/*"/>
            </div> <?php } ?>
        </div>

        <div id="id" class="hidden"><?php echo $info[0]->id ?></div>
        <div id="fullname" class="user-name"><?php echo $info[0]->fullname; ?>
            <?php if($noEdit == false) { ?> <span class="edit edit-fullname"><i class="fas fa-pen"></i></span> <?php } ?>
        </div> 


        <?php if($noEdit == false) { ?>
        <div class="input-edit input-fullname hidden" ><input id="fullnameEdit" type="text" value="<?php echo $info[0]->fullname; ?>"></div>
        <div class="save save-fullname hidden"><span><i class="fas fa-check"></i></span></div>
        <div class="cancel cancel-fullname hidden"><span><i class="fas fa-times"></i></span></div>
        <?php } ?>
        
        <div class="user-privielge"><?php echo strtoupper($info[0]->privilege); ?></div>
        <div class="user-position"><?php echo strtoupper($info[0]->position); ?></div>
        <div class="title-info">Basic Info <?php if($noEdit == false) { ?> <span class="edit edit-basic-info"><i class="fas fa-pen"></i></span> <?php } ?> </div>
        <hr>
        <div id="ssn"><i class="fas fa-id-card fa-fw"></i> <?php echo $info[0]->ssn; ?></div>
        <div id="birthdate"><i class="fas fa-birthday-cake fa-fw"></i> <?php echo $info[0]->bdate == NULL ? "--" : $info[0]->bdate; ?></div>
        <div id="location"><i class="fas fa-globe-europe fa-fw"></i> <?php echo $info[0]->location == NULL ? "--" : $info[0]->location; ?></div>

        <?php if($noEdit == false) { ?>
        <div class="input-edit input-basic-info hidden"  ><i class="fas fa-id-card fa-fw"></i><input id="ssnEdit" type="number" value="<?php echo $info[0]->ssn; ?>"></div>
        <div class="ssnMessage"></div>
        <div class="input-edit input-basic-info hidden" ><i class="fas fa-birthday-cake fa-fw"></i><input id="birthdateEdit" type="date" value="<?php echo $info[0]->bdate; ?>"></div>
        <div class="input-edit input-basic-info hidden"><i class="fas fa-globe-europe fa-fw"></i><input  id="locationEdit" type="text" value="<?php echo $info[0]->location; ?>"></div>

        <div class="save save-basic-info hidden">Save</div>
        <div class="cancel cancel-basic-info hidden">Cancel</div>
        <?php } ?>
    </div>

    <div class="profile-right">
        <div class="profile-right-up">
            <div class="title-info">Contact Info <?php if($noEdit == false) { ?>  <span class="edit edit-contact-info"><i class="fas fa-pen"></i></span> <?php } ?> </div>
            <hr>
            <div id="mail"><i class="fas fa-envelope fa-fw"></i> <?php echo $info[0]->email; ?></div> 
            <div id="phone"><i class="fas fa-phone fa-fw"></i> <?php echo $info[0]->phone; ?></div>

            <?php if($noEdit == false) { ?>
            <div class="input-edit input-contact-info hidden"><i class="fas fa-envelope fa-fw"></i><input id="emailEdit" type="email" value="<?php echo $info[0]->email; ?>"></div>
            <div class="input-edit input-contact-info hidden"><i class="fas fa-phone fa-fw"></i><input id="phoneEdit" type="text" value="<?php echo $info[0]->phone; ?>"></div>

            <div class="save save-contact-info hidden">Save</div>
            <div class="cancel cancel-contact-info hidden">Cancel</div>
            <?php } ?>
        </div>

        <div class="profile-right-down">
            <div class="title-info">Company Info <?php if($noEdit == false) { ?> <span class="edit edit-company-info"><i class="fas fa-pen"></i></span> <?php } ?> </div>
            <hr>
            <div id="username"><i class="fas fa-user fa-fw"></i> <?php echo $info[0]->username; ?></div>
            <div id="password">
                <i class="fas fa-key fa-fw"></i> 
                <span class="starts">********</span>
                <?php if($noEdit == false) { ?>
                <span class="pass hidden"><?php echo $_SESSION['password'] ?></span> 
                <?php } ?>
            </div>
            <?php if($noEdit == false) { ?>
            <div class="input-edit input-company-info hidden"><i class="fas fa-key fa-fw"></i><input id="passwordEdit" type="password" ><span class="eye eyeedit"><i class="far fa-eye"></i></span></div>
            <div class="save save-company-info hidden">Save</div>
            <div class="cancel cancel-company-info hidden">Cancel</div>
            <?php } ?>

        </div>
    </div>
</div>

<?php
    }
    else {
        echo "<div>ERROR!! Please Logout And Login Again</div>";
    }
}
catch(Exception $e)
{
    echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
    $_SESSION['error'] = 'error in sql';
    error_log("error while getting profile");
}
?>

<?php if(!isset($_GET['addinfo'])){ include "../template/footer.php"; }?>
