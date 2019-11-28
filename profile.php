<?php include "template/header.php"; ?>

<img src="profileBackground.jpg" alt="" class="profile-background">
<div class="profile">


    <div class="profile-left">
        <!--        <div class="user-sex"><i class="fas fa-venus"></i></div>-->
        <img src="avatar.jpg" class="profile-picture">
        <div id="id" style="display:none">1</div>
        <div id="fullname" class="user-name">Mark Refaat Ramzy 
            <span class="edit edit-fullname"><i class="fas fa-pen"></i></span>
        </div> 
        
        <div class="input-edit input-fullname hidden" ><input id="fullnameEdit" type="text" value="Mark Refaat Ramzy "></div>
        <div class="save save-fullname hidden">S</div>
        <div class="cancel cancel-fullname hidden">C</div>
       
       
        <div class="user-position">Admin</div>
        <div class="title-info">Basic Info <span class="edit edit-basic-info"><i class="fas fa-pen"></i></span></div>
        <hr>
        <div id="ssn"><i class="fas fa-id-card fa-fw"></i> 299052412345</div>
        <div id="birthdate"><i class="fas fa-birthday-cake fa-fw"></i> 24/05/1999</div>
        <div id="location"><i class="fas fa-globe-europe fa-fw"></i> Cairo, Egypt</div>

        <div class="input-edit input-basic-info hidden"  ><i class="fas fa-id-card fa-fw"></i><input id="ssnEdit" type="text" value="299052412345"></div>
        <div class="input-edit input-basic-info hidden" ><i class="fas fa-birthday-cake fa-fw"></i><input id="birthdateEdit" type="date" value="1999-05-24"></div>
        <div class="input-edit input-basic-info hidden"><i class="fas fa-globe-europe fa-fw"></i><input  id="locationEdit" type="text" value="Cairo, Egypt"></div>

        <div class="save save-basic-info hidden">Save</div>
        <div class="cancel cancel-basic-info hidden">Cancel</div>
    </div>

    <div class="profile-right">
        <div class="profile-right-up">
            <div class="title-info">Contact Info <span class="edit edit-contact-info"><i class="fas fa-pen"></i></span></div>
            <hr>
            <div id="mail"><i class="fas fa-envelope fa-fw"></i> Mark.refaat.ramzy@gmail.com</div> 
            <div id="phone"><i class="fas fa-phone fa-fw"></i> 01278249244</div>

            <div class="input-edit input-contact-info hidden"><i class="fas fa-envelope fa-fw"></i><input id="emailEdit" type="email" value="Mark.refaat.ramzy@gmail.com"></div>
            <div class="input-edit input-contact-info hidden"><i class="fas fa-phone fa-fw"></i><input id="phoneEdit" type="number" value="01278249244"></div>

            <div class="save save-contact-info hidden">Save</div>
            <div class="cancel cancel-contact-info hidden">Cancel</div>

        </div>

        <div class="profile-right-down">
            <div class="title-info">Company Info <span class="edit edit-company-info"><i class="fas fa-pen"></i></span></div>
            <hr>

            <div id="username"><i class="fas fa-user fa-fw"></i> Mark19</div>
            <div id="password"><i class="fas fa-key fa-fw"></i> ******** <span class="eye"><i class="far fa-eye"></i></span></div>

            <div class="input-edit input-company-info hidden"><i class="fas fa-user fa-fw"></i><input id="usernameEdit" type="text" value="Mark.refaat.ramzy@gmail.com"></div>
            <div class="input-edit input-company-info hidden"><i class="fas fa-key fa-fw"></i><input id="passwordEdit" type="password" value="01278249244"><span class="eye"><i class="far fa-eye"></i></span></div>

            <!--            <div id="salary"><i class="fas fa-money-bill-alt"></i> 2000<span style="color : green;">$</span></div>-->

            <div class="save save-company-info hidden">Save</div>
            <div class="cancel cancel-company-info hidden">Cancel</div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>
