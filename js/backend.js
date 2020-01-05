$(document).ready(function () {

    setcounters(); /* Calling the function to set the numbers of counters on site starting*/
    setInterval(setcounters, 1000); /* Calling the function to update the numbers of counters every 10 seconds */
    getnotifications(); /* Calling the function to get the notifications data from DB */
    setInterval(getnotifications, 1000); /* Calling the function to update the content of notifications every 10 seconds */
    sendcalmails(); /* Calling the function to send holiday emails */

    function hasOneDayPassed() { /* A function to check if one day has passed */
        var date = new Date().toLocaleDateString(); /* get today's date */
        if (localStorage.yourapp_date == date) /* check if there's a date in localstorage and it's equal to the above */
            return false;
        /* this occurs when a day has passed */
        localStorage.yourapp_date = date;
        return true;
    }

    function sendcalmails() { /* A function to send holiday emails */
        jQuery.ajax({
            type: "POST",
            url: "../operations/getudata.php",
            data: { getid: 1 },
            success: function (data) {
                if (data != 8) return false;
                if (!hasOneDayPassed()) return false; /* If a day hasen't passed it won't run */
                var CD = new Date(); /* Making a date object */
                var curdd = CD.getDate(); /* Getting the current day */
                var curmm = CD.getMonth() + 1; /*Getting the current month */
                var holidays = ["07/01", "25/01", "19/04", "20/04", "25/04", "01/05", "23/05", "23/07", "29/07", "30/07", "20/08", "06/10", "28/10"];
                sendbdmail(curdd, curmm); /* Adding the holidays in Egypt */
                /* Setting the subject and content of mail and notification*/
                var content = "SYSTEMNA wishes you a happy holiday, tomorrow is a day off!";
                var mailsubj = "Happy Holiday";
                for (var i = 0; i < holidays.length; i++) { /* Iterating by the number of holidays */
                    holidd = holidays[i].slice(0, 2); /* Get the day part of date */
                    holimm = holidays[i].slice(3, 5); /* Get the month part of date */
                    /* Get the day before the holiday */
                    if (holidd == '01') {
                        holidd = 30;
                        if (holimm == '01') {
                            holimm = 12;
                        } else {
                            holimm -= 1;
                        }
                    } else {
                        holidd = holidd - 1;
                    }
                    if (curdd == (holidd) && curmm == holimm) { /* Checking if the next day is a holiday */
                        jQuery.ajax({ /* Send notifiation */
                            type: "POST",
                            url: "../operations/massmsging.php",
                            data: "notification=" + content + "&type=notiall",
                            success: function (html) {
                                console.log(html);
                                jQuery.ajax({ // Send mail //
                                    type: "POST",
                                    url: "../operations/massmsging.php",
                                    data: "mailsubject=" + mailsubj + "&mailcontent=" + content + "&type=mailall",
                                    success: function (html) {
                                        console.log(html);
                                    }
                                });
                            }
                        });
                    }
                }
            }
        });
    }

    function sendbdmail(curdd, curmm) { /* A function to send birthday emails */
        /* Setting the subject and content of mail and notification*/
        var content = "SYSTEMNA wishes you a happy birthday!";
        var mailsubj = "Happy Birthday";
        jQuery.ajax({
            type: "POST",
            url: "../operations/getudata.php",
            data: { getbd: 1 },
            success: function (data) {
                birthday = data;
                jQuery.ajax({
                    type: "POST",
                    url: "../operations/getudata.php",
                    data: { getid: 1 },
                    success: function (data) {
                        bddd = birthday.slice(8, 10); /* Get the day part of date */
                        bdmm = birthday.slice(5, 7); /* Get the month part of date */
                        if (curdd == bddd && curmm == bdmm) { /* Checking if the current day is the user's birthday */
                            sendmail(data, mailsubj, content);
                            sendnoti(data, content, '');
                        }
                    }
                });
            }
        });
    }

    $('.pages_edit').text('Edit'); /* Setting the text for admin's edit button */
    $('#faq_add').text('Add Question'); /* Setting the text for admin's add question button */
    $('#add_letter').text('Add new type of letter'); /* Setting the text for admin's add letter button */

    $('#noti_Button').click(function () { /* Toggle notification window */
        $('#notifications').fadeToggle('fast', 'linear');
        return false;
    });

    $(document).click(function () { /* Closes the notification window when clicked anywhere in the page */
        $('#notifications').fadeOut('fast', 'linear');
    });


    /******* Loading circle when get data with ajax *******/
    function loading(status) {
        if (status == true) {
            $(".loading").removeClass("hidden");
            $(".content").addClass("hidden");
        }
        else if (status == false) {
            $(".loading").addClass("hidden");
            $(".content").removeClass("hidden");
        }
    }

    /******* Popup to show result of ajax *******/
    function popup(head, body) {
        head = head == true ? "Success" : "Failed";
        $(".popup-notification h2").text(head);
        $(".popup-content").html(body);
        $(".modalPopup").css("display", "block");
    }


    /******* Confirmation delete popup *******/
    function confirmation(body, url, data, tag) {
        $(".confirmation-content").text(body);
        $("#confirmationButton").on("click", function () {
            jQuery.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function (html) {
                    if (html == "true") {
                        $(".modalConfirmation").css("display", "none");
                        popup(true, "Deleted");
                        $(tag).hide();
                    }
                    else if (html == "all") {
                        $(".modalConfirmation").css("display", "none");
                        window.location.reload();
                    }
                    else {
                        $(".modalConfirmation").css("display", "none");
                        popup(false, html);
                    }
                }
            });
        })
        $(".modalConfirmation").css("display", "block");
    }

    /******* Confirm delete popup *******/
    $(".deleteConfirmation").on("click", function (e) {
        e.preventDefault(); /* to prevent href action */
        confirmation("Are you sure ?", this.href, this.id, $(this).closest('tr')); /* show to confirmation popup */
    });

    /******* Show / Hide side navigation *******/
    $(".navbar-toggle").on("click", function () {
        $(".sidenav-custom").animate({ width: "toggle" }, 350);
    });

    $("#themeToggle").on("click", function toggleTheme() { /* Adding the theme toggle function */
        var themecookie = getCookie("theme"); /* Getting the cookie and adding it in a var */
        /* Checking the cookie value and setting the theme opposite to it */
        if (themecookie == "darktheme") {
            light();
        }
        else if (themecookie == "lighttheme") {
            dark();
        }
    });

    function dark() { /* Changing everything to dark */
        var d = new Date();
        d.setTime(d.getTime() + (24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = "theme=darktheme; " + expires + "; path=/;";
        $("#themeToggleBtn").html("🌝");
        $("#notifications").css("background-color", "#2d3035");
        $("#notifications").css("color", "white");
        $(".header").css("background-color", "#2d3035");
        $(".header").css("color", "white");
        $("#na").css("color", "white");
        $("#alogout").css("color", "white");
        $(".sidenav-custom").css("background-color", "#2d3035");
        $(".sidenav-custom .sidenav-header .title .position").css("color", "white");
        $(".sidenav-custom .sidenav-button a").css("color", "white");
        $(".content").css("background-color", "#202020");
        $(".content").css("color", "white");
        $("tr").css("color", "white");
        $("tr:nth-child(even)").css("background", "#303030");
        $("tr:nth-child(even)").css("color", "white");
        $(".profile").css("background-color", "#303030");
        $(".profile-left").css("background-color", "#424242");
        $(".profile-right-up").css("background-color", "#424242");
        $(".profile-right-down").css("background-color", "#585858");
        $(".profile-left").css("box-shadow", "5px 5px #000");
        $(".profile-right-up").css("box-shadow", "5px 5px #000");
        $(".profile-right-down").css("box-shadow", "5px 5px #000");
        $("#Comment_Value").css("color", "white");
        $(".modal-content").css("background-color", "#585858");
        $(".modal-content").css("color", "white");
    }

    function light() { /* Changing everything to light */
        var d = new Date();
        d.setTime(d.getTime() + (24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = "theme=lighttheme; " + expires + "; path=/;";
        $("#themeToggleBtn").html("🌚");
        $("#notifications").css("background-color", "white");
        $("#notifications").css("color", "#212529");
        $(".header").css("background-color", "white");
        $(".header").css("color", "#212529");
        $("#na").css("color", "#212529");
        $("#alogout").css("color", "#212529");
        $(".sidenav-custom").css("background-color", "white");
        $(".sidenav-custom .sidenav-header .title .position").css("color", "#212529");
        $(".sidenav-custom .sidenav-button a").css("color", "#212529");
        $(".content").css("background-color", "#f5f5f5");
        $(".content").css("color", "#212529");
        $("tr").css("color", "black");
        $("tr:nth-child(even)").css("background", "#e8e8e8");
        $("tr:nth-child(even)").css("color", "black");
        $(".profile").css("background-color", "#e0e0e0");
        $(".profile-left").css("background-color", "#f5f5f5");
        $(".profile-right-up").css("background-color", "#f5f5f5");
        $(".profile-right-down").css("background-color", "#f5f5f5");
        $(".profile-left").css("box-shadow", "5px 5px #aaa");
        $(".profile-right-up").css("box-shadow", "5px 5px #aaa");
        $(".profile-right-down").css("box-shadow", "5px 5px #aaa");
        $("#Comment_Value").css("color", "black");
        $(".modal-content").css("background-color", "white");
        $(".modal-content").css("color", "black");
    }

    function getCookie(name) { /* Getting the desiered cookie value by its name */
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "="); /* Splitting it into parts to get the value */
        if (parts.length == 2) return parts.pop().split(";").shift(); /* Returning the value of the cookie only */
    };

    var themecookie = getCookie("theme"); /* Getting the cookie and adding it in a var */
    /* Checking the cookie value and setting the theme according to it */
    if (themecookie == "darktheme") {
        dark();
    } else if (themecookie == "lighttheme") {
        light();
    };

    $(window).click(function (e) {
        if (e.target == $(".modalPopup")[0]) {
            $(".modalPopup").css("display", "none");
        }
    });

    /* Close button in popup */
    $(".popup-close").on("click", function () {
        $(".modalPopup").css("display", "none");
    });


    /* Cancle button in confirmation popup */
    $(".confirmation-close").on("click", function () {
        $(".modalConfirmation").css("display", "none");
    });

    /******************************************** START PROFILE ********************************************/

    /* Show / Hide fullname and fullname input */
    function fullnameToggle() {
        $("#fullname").toggleClass("hidden");
        $(".input-fullname").toggleClass("hidden");
        $(".save-fullname").toggleClass("hidden");
        $(".cancel-fullname").toggleClass("hidden");
    }

    function basicInfoToggle() {
        $("#ssn").toggleClass("hidden");
        $("#birthdate").toggleClass("hidden");
        $("#location").toggleClass("hidden");
        $(".input-basic-info").toggleClass("hidden");
        $(".save-basic-info").toggleClass("hidden");
        $(".cancel-basic-info").toggleClass("hidden");
    }

    function contactInfoToggle() {
        $("#mail").toggleClass("hidden");
        $("#phone").toggleClass("hidden");
        $(".input-contact-info").toggleClass("hidden");
        $(".save-contact-info").toggleClass("hidden");
        $(".cancel-contact-info").toggleClass("hidden");
    }

    function companyInfoToggle() {
        $("#password").toggleClass("hidden");
        $(".input-company-info").toggleClass("hidden");
        $(".save-company-info").toggleClass("hidden");
        $(".cancel-company-info").toggleClass("hidden");
    }

    $(".edit-fullname").on("click", fullnameToggle);
    $(".cancel-fullname").on("click", fullnameToggle);

    $(".edit-basic-info").on("click", basicInfoToggle);
    $(".cancel-basic-info").on("click", basicInfoToggle);

    $(".edit-contact-info").on("click", contactInfoToggle);
    $(".cancel-contact-info").on("click", contactInfoToggle);

    $(".edit-company-info").on("click", companyInfoToggle);
    $(".cancel-company-info").on("click", companyInfoToggle);

    function submitEdit(id, type, oldValue, newValue) {
        $.ajax({
            type: "POST",
            url: "../operations/editProfile.php",
            data:
            "id=" + id +
            "&oldvalue=" + oldValue +
            "&value=" + newValue +
            "&type=" + type,
            success: function (html) {
                loading(false);
                if (html == "true") {
                    popup(true, "Your Request Has Been Submitted Successfully");
                } else { popup(false, html); }
            },
            beforeSend: function () {
                loading(true);
            }
        });
    }

    $(".save-fullname").on("click", function () {
        var fullname = $("#fullnameEdit").val();
        var defaultFullname = $("#fullnameEdit")[0]["defaultValue"];
        var id = $("#id").text();
        if (fullname != defaultFullname) submitEdit(id, "fullname", defaultFullname, fullname);
        fullnameToggle();
    });

    $(".save-basic-info").on("click", function () {
        var ssn = $("#ssnEdit").val();
        var defaultSSN = $("#ssnEdit")[0]["defaultValue"];
        var bdate = $("#birthdateEdit").val();
        var defaultBdate = $("#birthdateEdit")[0]["defaultValue"];
        var loc = $("#locationEdit").val();
        var defaultLoc = $("#locationEdit")[0]["defaultValue"];
        var id = $("#id").text();
        if (ssn != defaultSSN) submitEdit(id, "ssn", defaultSSN, ssn);
        if (bdate != defaultBdate) submitEdit(id, "bdate", defaultBdate, bdate);
        if (loc != defaultLoc) submitEdit(id, "location", defaultLoc, loc);
        basicInfoToggle();
    });

    $(".save-contact-info").on("click", function () {
        var email = $("#emailEdit").val();
        var defaultEmail = $("#emailEdit")[0]["defaultValue"];
        var phone = $("#phoneEdit").val();
        var defaultPhone = $("#phoneEdit")[0]["defaultValue"];
        var id = $("#id").text();
        if (email != defaultEmail) submitEdit(id, "email", defaultEmail, email);
        if (phone != defaultPhone) submitEdit(id, "phone", defaultPhone, phone);
        contactInfoToggle();
    });

    $(".save-company-info").on("click", function () {
        var pass = $("#passwordEdit").val();
        var id = $("#id").text();
        $.ajax({
            type: "POST",
            url: "../operations/editProfile.php",
            data: "id=" + id + "&value=" + pass + "&type=password",
            success: function (html) {
                loading(false);
                if (html == "truePass") {
                    companyInfoToggle();
                    popup(true, "Your Password Has Been Changed Successfully");
                } else { popup(false, html); }
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });

    $(".eyeedit").on("click", function () {
        if ($("#passwordEdit").attr("type") == "text")
            $("#passwordEdit").attr("type", "password");
        else {
            $("#passwordEdit").attr("type", "text");
        }
    });
    
    function uploadPhoto(elementID, url, imgSrc) {
         var input = document.getElementById(elementID);
        file = input.files[0];
        if (file != undefined) {
            formData = new FormData();
            if (file.type.match(/.jpeg/)) {
                formData.append("image", file);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $(imgSrc).attr("src", data);
                        window.location.reload();
                    }
                });
            } else { popup(false, "Not a valid image!"); }
        } else { popup(false, "Input something!"); }
    }

    $(".profile-picture-input").on("change", function () {
        uploadPhoto("profile-picture-input", "../operations/uploadUserImage.php", ".profile-picture");
    });

    $(".profile-camera-button").on("click", function () {
        $(".profile-picture-input").click();
    });



    /********************************************               END PROFILE           ********************************************/

    /******************************************** START PN (Passport And National ID) ********************************************/

    /* upload passport photo */
    
    $(".passport-picture-input").on("change", function () {
        uploadPhoto("passport-picture-input", "../operations/uploadPassportImage.php", ".passport-picture")
    });

    $(".passport-camera-button").on("click", function () {
        $(".passport-picture-input").click();
    });
    
    /* upload National ID photo */
    $(".national-picture-input").on("change", function () {
        uploadPhoto("national-picture-input", "../operations/uploadNationalImage.php", ".national-picture");
    });

    $(".national-camera-button").on("click", function () {
        $(".national-picture-input").click();
    });

    /******************************************** END PN (Passport And National ID) ********************************************/

    var orig;
    $(".sal").on("click", function (event) { //when the salary is clicked on
        $(this)
            .closest("div")
            .attr("contenteditable", "true"); //make div of salary editable
        $(this).focus();
        $(this).addClass("input");  //make div look like an input field
        orig = $(this).text();  //save original salary value
        $(this).keyup(function (e) {
            var test = $(this)
            .text();
            if (!test.match(/^[0-9]+$/)) { // if input value is not a number
                $(this).removeClass("input"); //remove class input
                $(this).addClass("wr");  //add class wrong
            } else {
                $(this).removeClass("wr");  // remove class wrong
                $(this).addClass("input");  // add class input
            }
        });
    });

    $(".sal").on("focusout", function (event) {

        var tsal = $(this);  // save salary object
        $(this).removeClass("input");  //remove input class
        var row = $(this).closest("tr");
        var rowIndex = row.index();
        var c = $("#Display")
        .find("tr:eq(" + rowIndex + ")")
        .find("td:eq(1)");  // get the cell contatining user id
        var test2 = $(this).text();
        //test2 = test2.replace("<br>", "");

        if (!test2.match(/^[0-9]+$/)) {
            popup(false, "Salary must be a number!");  // give error if salary not a number
        } else {
            loading(true);
            $.ajax({
                method: "POST",
                url: "../operations/EditTable.php",
                data: { test: test2, id: c.text() }, // send id and salary value in post by ajax
                success: function (msg) {
                    if (msg == '0') { popup(false, "User needs to be accepted to update his salary!"); loading(false); tsal.text(orig); tsal.html("<div>" + tsal.text() + "</div>"); }
                    // if user not accepted give error + set salary value to original
                    else {
                        tsal.html("<div>" + tsal.text() + "</div>"); // resets html in case user presses on breakline
                        loading(false);
                        popup(true, "Salary Updated!");
                        sendnoti(c.text(), "You salary has been updated to " + test2 + " EGP.", '../pages/profile.php'); // send notification with salary change
                    }
                }
            });
        }
    });

    $(".position").on("click", function (event) {
        $(this)
            .closest("div")
            .attr("contenteditable", "true");
        $(this).focus();
        $(this).addClass("input");
        orig = $(this).text();
        $(this).keyup(function (e) {
            var test = $(this)
            .text();
        });
    });

    $(".position").on("focusout", function (event) {

        var tsal = $(this);
        $(this).removeClass("input");
        var row = $(this).closest("tr");
        var rowIndex = row.index();
        var c = $("#Display")
        .find("tr:eq(" + rowIndex + ")")
        .find("td:eq(1)");
        var test2 = $(this).text();
        //test2 = test2.replace("<br>", "");

        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/EditTable.php",
            data: { position: test2, id: c.text() },
            success: function (msg) {
                if (msg == '0') { popup(false, "User needs to be accepted to update his position!"); loading(false); tsal.text(orig); tsal.html("<div>" + tsal.text() + "</div>"); }
                else {
                    tsal.html("<div>" + tsal.text() + "</div>");
                    loading(false);
                    popup(true, "Position Updated!");
                    sendnoti(c.text(), "You Position has been updated to " + test2, '../pages/profile.php');
                }
            }
        });

    });

    $("#tblsearch").keyup(function () {
        search_table($(this).val());
    });

    function search_table(value) {
        var selected = $("#choice")
            .children("option:selected")
            .val(); // get selected choice from drop down
        var selection; //column of selection
        if (selected == "email") selection = 3;
        if (selected == "ssn") selection = 4;
        if (selected == "username") selection = 2;
        $("#Display tr").each(function () { // for every row 
            var found = "false";
            var x = $(this).find("td:eq(" + selection + ")"); // search in selected column
            if (
                x
                    .text()
                    .toLowerCase()
                    .indexOf(value.toLowerCase()) >= 0 //check if input exist in table
            ) {
                found = "true";
            }

            if (found == "true") { // if found show containing row
                $(this).show();
            } else {
                $(this).hide(); // if not hide row 
                $("#must").show();
            }
        });
    }

    $(".modify").on("click", function () {
        var thisBtn = $(this);
        var thisTd = $(this)
            .closest("td");
        var Eindex = $(this) // row index of button
            .closest("tr")
            .index();
        var idMod = $("#Display") // id cell in same row
            .find("tr:eq(" + Eindex + ")")
            .find("td:eq(1)")
            .text();
        var typeM;
        if ($(this).val() == "+HR") { // if hr button clicked chane type to admin
            typeM = "admin";
        } else if ($(this).val() == "+QC") {  // if +qc button clicked chane type to qc
            typeM = "qc";
        }
        else if ($(this).val() == "-QC") {  // if -qc button clicked chane type to qc
            typeM = "user";
        }
        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/EditTable.php",
            data: { type: typeM, mid: idMod },
            success: function (msg) {
                loading(false);
                if (msg != 1) popup(false, "User needs to be accepted to do this action!"); // check if user is accepted first
                else {
                    if (thisBtn.val() == "+HR") {
                        thisBtn.closest('tr').hide(); // hide table row if promoted to admin
                        sendnoti(idMod, "Congratulations you have been promoted to an HR!", '../pages/profile.php');
                        sendmail(idMod, "Congratulations on your Promotion", "Congratulations you have been promoted to an HR!");
                    }
                    else if (thisBtn.val() == "+QC") {
                        thisBtn.val('-QC');
                        thisBtn.css("background-color", "#ff0000"); // if promoted to qc change colour and value of button
                        sendnoti(idMod, "Congratulations you have been promoted to an QC!", '../pages/profile.php');
                        sendmail(idMod, "Congratulations on your Promotion", "Congratulations you have been promoted to an QC!");
                    }
                    else if (thisBtn.val() == "-QC") {
                        thisBtn.val('+QC');
                        thisBtn.css("background-color", "#1c87c9"); // if promoted to qc change colour and value of button
                        sendnoti(idMod, "you have been demoted to an user!", '../pages/profile.php');
                        sendmail(idMod, "Demotion", "You have been demoted to user!");
                    }
                }
            }
        });
    });

    $(".accept").click(function () {
        var Row = $(this).closest("tr");
        var Did = $("#tblRequests")
            .find("tr:eq(" + Row.index() + ")") // get id of user
            .find("td:eq(2)")
            .text();
        var Type = $("#tblRequests") // type of data to be changed
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(6)")
            .text();
        var Rid = $("#tblRequests") // id of request
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(1)")
            .text();
        var Value = $("#tblRequests") // new value to be added
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(5)")
            .text();
        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/editProfileTBL.php",
            data: { type: Type, id: Did, rid: Rid, value: Value },
            success: function (msg) {
                loading(false);
                Row.hide();
                sendnoti(Did, "Your profile " + Type + " change request has been accepted!", '../pages/profile.php');
                sendmail(Did, "Profile Changes", "Your profile " + Type + " change request has been accepted!");
            }
        });
    });

    $(".reject").click(function () {
        var Row = $(this).closest("tr");
        var Did = $("#tblRequests")
        .find("tr:eq(" + Row.index() + ")")
        .find("td:eq(2)")
        .text();
        var Type = $("#tblRequests")
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(6)")
            .text();
        var Row = $(this).closest("tr");
        var Rid = $("#tblRequests")
        .find("tr:eq(" + Row.index() + ")")
        .find("td:eq(1)")
        .text();
        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/editProfileTBL.php",
            data: { reqId: Rid },
            success: function (msg) {
                loading(false);
                Row.hide();
                sendnoti(Did, "Your profile " + Type + " change request has been rejected!", '../pages/profile.php');
                sendmail(Did, "Profile Changes", "Unfortunely, Your profile " + Type + " change request has been rejected!");

            }
        });
    });

    $(".user-accept").click(function () {
        var Row = $(this).closest("tr");
        var Rid = $("#Display") // get id of user
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(1)")
            .text();
        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/EditTable.php",
            data: { aid: Rid },
            success: function (msg) {
                loading(false);
                Row.hide();
                sendmail(Rid, "SYSTEMNA", "Congratulations! You have been accepted at SYSTEMNA! you can now log in using your account.");
                sendnoti(Rid, "Welcome to SYSTEMNA!", '../pages/profile.php');
            }
        });
    });

    $(".user-reject").click(function () {
        var Row = $(this).closest("tr");
        var Rid = $("#Display")
        .find("tr:eq(" + Row.index() + ")")
        .find("td:eq(1)")
        .text();
        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/EditTable.php",
            data: { rid: Rid },
            success: function (msg) {
                loading(false);
                Row.hide();
                sendmail(Rid, "SYSTEMNA", "Unfortunely you didn't meet the requriments at SYSTEMNA, if you want to re-apply please fill the signup form again.");
            }
        });
    });

    $("#QCtblsearch").keyup(function () {
        search_QCtable($(this).val());
    });

    function search_QCtable(value) {
        var selected = $("#choice")
        .children("option:selected")
        .val();
        var selection;
        if (selected == "empname") selection = 2;
        if (selected == "requestname") selection = 3;
        if (selected == "empid") selection = 4;
        $("#Display tr").each(function () {
            var found = "false";
            var x = $(this).find("td:eq(" + selection + ")");
            if (
                x
                .text()
                .toLowerCase()
                .indexOf(value.toLowerCase()) >= 0
            ) {
                found = "true";
            }

            if (found == "true") {
                $(this).show();
            } else {
                $(this).hide();
                $("#must").show();
            }
        });
    }
    // function to add new question to faq
    $("#faqaddques").on("click", function () {
        var question = $("#question").val();
        var answer = $("#answer").val();
        var requested_by = $("#requested_by").val();
        if (question == "") {
            popup(false, "Please enter the question");
            return 0;
        } else if (answer == "") {
            popup(false, "Please enter the answer");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/faqop.php",
            data: "question=" + question + "&answer=" + answer + "&requested_by=" + requested_by + "&type=faqaddques",
            success: function (html) {
                jQuery.ajax({
                    type: "POST",
                    url: "../operations/getudata.php",
                    data: { getid: 1 },
                    success: function (data) {
                        sendnoti(data, "Your Question Has Been Added Successfully!", '../pages/faq.php');
                        //sendmail(data, "Question placed", "Your Question Has Been Added Successfully!");
                    }
                });
                loading(false);
                popup(true, "Your Question Has Been Added Successfully!");
                setInterval(window.location.replace("../pages/faq.php"), 7000);
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });

    /* Function to submit an inquiry in FAQ page */
    $("#faqsubmit").on("click", function () {
        /* Getting the subject and content data */
        var subject = $("#faqinputtext").val();
        var content = $("#faqtextarea").val();
        if (subject == "") { /* Conditions */
            popup(false, "Please enter the subject");
            return 0;
        } else if (content == "") {
            popup(false, "Please enter the content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/faqop.php",
            data: "subject=" + subject + "&content=" + content + "&type=faqinq",
            success: function (html) {
                jQuery.ajax({
                    type: "POST",
                    url: "../operations/getudata.php",
                    data: { getid: 1 },
                    success: function (data) {
                        sendnoti(data, "We recived your message successfully!", '');
                        sendmail(data, "Message recieved", "We recived your message successfully and we are going to work on it , thank you!");
                    }
                });
                loading(false);
                popup(true, "Sent");
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });


    /******************************************************************************************************************
    * MakeLetter.php
    * apply button
    * revised by Mark
    ******************************************************************************************************************/
    $("#applyForLetterBtn").click(function () {
        var salary;
        var priority;
        var type_name;
        var info = '0';
        var id = $("#id").val();
        if (
            ($('#rdbtn1').is(':checked') || $('#rdbtn2').is(':checked')) &&
            ($('#rdbtn3').is(':checked') || $('#rdbtn4').is(':checked')) &&
            $("input[name=Letterbuttonn]:checked")
        ) {
            if ($('#rdbtn1').is(':checked')) { priority = 1; }
            else if ($('#rdbtn2').is(':checked')) { priority = 0; }

            if ($('#rdbtn3').is(':checked')) { salary = 1; }
            else if ($('#rdbtn4').is(':checked')) { salary = 0; }

            type_name = $("input[name=Letterbuttonn]:checked").val();
            var x = document.getElementById(type_name);
            if (x != null) {
                info = x.value;
            }
            if (info != '') {
                $.ajax({
                    type: "POST",
                    url: "../operations/addletter.php",
                    data: "salary=" + salary + "&priority=" + priority + "&type_name=" + type_name + "&type=addLetter" + "&info=" + info,
                    success: function (html) {
                        loading(false);
                        if (html == "true") {
                            popup(true, "Letter Added Successfully");
                            sendnoti(id, "Letter Request Added Successfully!", '../pages/viewRequest.php');
                            sendmail(id, "Letter Added", "You Letter Request has been Added Successfully!");
                        }
                        else
                            popup(false, html);
                    },
                    beforeSend: function () {
                        loading(true);
                    }
                });
            } else popup(false, 'fill textfield');
        } else { popup(false, "You have to select type, salary and priority"); }

    });

    //    $("#editLetterButton").click(function() {
    //        if (
    //            (document.getElementById("rdbtn1").checked ||
    //             document.getElementById("rdbtn2").checked) &&
    //            (document.getElementById("rdbtn3").checked ||
    //             document.getElementById("rdbtn4").checked) &&
    //            !document.getElementsByClassName("Letterbuttonn").checked
    //        ) {
    //            alert("your request has been placed successfully");
    //            type_name = $("input[name=Letterbuttonn]:checked").val();
    //        } else {
    //            alert("you have an error completing your request");
    //        }
    //        if (document.getElementById("rdbtn1").checked) {
    //            priority = 1;
    //        } else if (document.getElementById("rdbtn2").checked) {
    //            priority = 0;
    //        }
    //        if (document.getElementById("rdbtn3").checked) {
    //            salary = 1;
    //        } else if (document.getElementById("rdbtn4").checked) {
    //            salary = 0;
    //        }
    //        var value;
    //
    //        jQuery.ajax({
    //            method: "POST",
    //            url: "editLetter.php",
    //            data: { salary: salary, priority: priority, type_name: type_name,  },
    //            success: function(data2) {}
    //        });
    //    });

    /* Function to search in FAQ */
    $("#searched").keyup(function () {
        //    if ($("#searched").val() == "" || $("#searched").val() == " ") {
        //      alert("error: Enter something to search for!");
        //      return false;
        //    }
        var searchedText = $("#searched").val(); /* Getting the searched word */
        var page = $("#faqdiv"); /* Getting the page */
        var pageText = page.html(); /* Getting the page content */
        var newHtml = pageText.replace(/<span>/g, "").replace(/<\/span>/g, ""); /* Replacing spaces with spans */
        if (searchedText != "") {  /* Conditions */
            var theRegEx = new RegExp("(" + searchedText + ")(?!([^<]+)?>)", "gi");  /* Getting the searched text in the whole page */
            newHtml = newHtml.replace(theRegEx, "<span>$1</span>");  /* Re adding the page content with the searched text highlighted */
        }
        page.html(newHtml);
    });
    //  $("#searched").keyup(function() {
    //    if ($("#searched").val() == "" || $("#searched").val() == " ") {
    //      location.reload();
    //    }
    //  });



    /********************** Send notfications and mails **********************/
    /* Function to send notification to all users on mass messaging */
    $("#notisendall").on("click", function () {
        /* Setting the content */
        var data = $("#massnoti").val();
        if (data == "") { /* Conditions */
            popup(false, "Please enter notification content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "notification=" + data + "&type=notiall",
            success: function (html) {
                loading(false);
                if (html == "true") {
                    popup(true, "Sent");
                } else { popup(false, html); }
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });

    /* Function to send notification to specific user on mass messaging */
    $("#notisendone").on("click", function () {
        /* Setting the user ID and content */
        var id = $("#notione").val();
        var data = $("#massnoti").val();
        if (id <= 0) { /* Conditions */
            popup(false, "Please choose a user from the list");
            return 0;
        } else if (data == "") {
            popup(false, "Please enter notification content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "id=" + id + "&notification=" + data + "&type=notione",
            success: function (html) {
                loading(false);
                if (html == "true") {
                    popup(true, "Sent");
                } else { popup(false, html); }
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });

    /* Function to send mail to all users on mass messaging */
    $("#mailsendall").on("click", function () {
        /* Setting the mail subject and content */
        var mailsubject = $("#mailsubject").val();
        var mailcontent = $("#mailcontent").val();
        if (mailsubject == "") { /* Conditions */
            popup(false, "Please enter mail subject");
            return 0;
        } else if (mailcontent == "") {
            popup(false, "Please enter mail content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "mailsubject=" + mailsubject + "&mailcontent=" + mailcontent + "&type=mailall",
            success: function (html) {
                loading(false);
                if (html == "true") {
                    popup(true, "Sent");
                } else { popup(false, html); }
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });

    /* Function to send mail to specific user on mass messaging */
    $("#mailsendone").on("click", function () {
        /* Setting the mail subject and content */
        var mailsubject = $("#mailsubject").val();
        var mailcontent = $("#mailcontent").val();
        var email = $("#mailone").val();
        if (email <= 0) { /* Conditions */
            popup(false, "Please choose a user from the list");
            return 0;
        } else if (mailsubject == "") {
            popup(false, "Please enter mail subject");
            return 0;
        } else if (mailcontent == "") {
            popup(false, "Please enter mail content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "email=" + email + "&mailsubject=" + mailsubject + "&mailcontent=" + mailcontent + "&type=mailone",
            success: function (html) {
                loading(false);
                if (html == "true") {
                    popup(true, "Sent");
                } else { popup(false, html); }
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });

    /* Function to send mails to users */
    function sendmail(userid, mailsubject, mailcontent) {
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "uid=" + userid + "&mailsubject=" + mailsubject + "&mailcontent=" + mailcontent + "&type=sendmailfn",
            success: function (html) {
                console.log(html);
            }
        });
    }

    /* Function to send notifications to users */
    function sendnoti(userid, noticontent, notihref) {
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "uid=" + userid + "&noticontent=" + noticontent + "&notihref=" + notihref + "&type=sendnotifn",
            success: function (html) {
                console.log(html);
            }
        });
    }

//    /* Function to send mail with letter to user */
//    $("#sendletteronmail").on("click", function () {
//        $.ajax({
//            type: "POST",
//            url: "../operations/massmsging.php",
//            data: "type=sendlettermail",
//            success: function (html) {
//                loading(false);
//                if (html == "true") {
//                    popup(true, "Sent");
//                } else { popup(false, html); }
//            },
//            beforeSend: function () {
//                loading(true);
//            }
//        });
//    });

    function setCounter(type, tag) {
        $.ajax({
            type: "POST",
            url: "../operations/counterops.php",
            data: "type=" + type,
            success: function (html) {
                $(tag).text(html);
                if (html > "0") { /* If there is data, show the counter. */
                    $(tag).css("display", "inline-block");
                }
            },
        });
    }


    /* Function to set all the counters */
    function setcounters() {
        setCounter('setnoticounter', '#noti_Counter'); /* Function to set the notifications counter */
        setCounter('setprofilecounter', '#profile_Counter'); /* Function to set the users profile edits counter */
        setCounter('setusrsletterrequestscounter', '#usrsletterrequests_Counter'); /* Function to set the users letter requests counter */
        setCounter('setownletterrequestscounter', '#ownletterrequests_Counter'); /* Function to set the own letter requests counter */
        setCounter('setownletterrequestscounter', '#ownletterrequests_Counter'); /* Function to set the own letter requests counter */
        setCounter('setusrscounter', '#usrs_Counter'); /* Function to set the users counter */
    }

    /* Function to get the notifications */
    function getnotifications() {
        $.ajax({
            type: "POST",
            url: "../operations/notiop.php",
            data: "type=setnotidata",
            success: function (html) {
                if (html != '') { /* Print the notifications if not empty */
                    $('#notidata').html(html).css('text-align', 'left');
                    $('#markAll').css('display', 'block');
                } else { /* Print this message if empty */
                    $('#notidata').text('You have no new notifications, you will be alereted when you recieve something new.')
                        .css('text-align', 'center');
                    $('#markAll').css('display', 'none'); /* Hide mark all button if no notifications */
                }
            },
        });
    }

    /* Notifications Mark All function */
    $("#markAll").on("click", function () {
        $.ajax({
            type: "POST",
            url: "../operations/notiop.php",
            data: "&type=markread",
        });
        $('#noti_Counter').css('display', 'none'); /* Hiding the counter when markall is clicked */
        $('#notidata').text('You have no new notifications, you will be alereted when you recieve something new.')
            .css('text-align', 'center'); /* Replacing the data when markall is clicked */
        $('#markAll').css('display', 'none'); /* Hiding the markall button when markall is clicked */
    });

    /* Notifications View All function */
    $("#viewAll").on("click", function () {
        document.location.replace('../pages/notis.php');;
    });

    $("#add_letter").on("click", function () { /* Function to change page on admin only button click */
        document.location.replace('../pages/AddNewLetter.php');;
    });

    $("#faq_edit").on("click", function () { /* Function to change page on admin only button click */
        document.location.replace('../pages/viewFAQ.php');
    });

    $("#faq_add").on("click", function () { /* Function to change page on admin only button click */
        document.location.replace('../pages/AddQuestion.php');
    });

    $("#letter_edit").on("click", function () { /* Function to change page on admin only button click */
        document.location.replace('../pages/allLetters.php');
    });


    /************* ADD NEW LETTER ******************/

    $("#letterBodyArea").on('keyup', function () {
        var text = document.getElementById('letterBodyArea').value;
        var n = text.includes('NAME');
        var s = text.includes('SALARY');
        var d = text.includes('DATE');
        var p = text.includes('POSITION');
        var startdate = text.includes('START');
        var hr = text.includes('HR');
        var additional = text.includes('ADDITIONAL');
        var addtest;
        var add = document.getElementById('add_info').value;

        if (add == '' || add.match(/^ *$/) !== null) {
            addtest = false;
        }
        else {

            addtest = true;
        }


        if (addtest == true && additional == true && !text.includes("(.ADDITIONAL.)")) {
            text = text.replace('ADDITIONAL', "(.ADDITIONAL.) ");
            document.getElementById('letterBodyArea').value = text;
        }


        if (n == true && !text.includes("(.NAME.)")) {
            text = text.replace('NAME', "(.NAME.) ");
            document.getElementById('letterBodyArea').value = text;
        }
        if (s == true && !text.includes("(.SALARY.)")) {
            text = text.replace('SALARY', "(.SALARY.)");
            document.getElementById('letterBodyArea').value = text;
        }
        if (d == true && !text.includes("(.DATE.)")) {
            text = text.replace('DATE', "(.DATE.) ");
            document.getElementById('letterBodyArea').value = text;
        }
        if (p == true && !text.includes("(.POSITION.)")) {
            text = text.replace('POSITION', "(.POSITION.) ");
            document.getElementById('letterBodyArea').value = text;
        }
        if (startdate == true && !text.includes("(.START.)")) {
            text = text.replace('START', "(.START.) ");
            document.getElementById('letterBodyArea').value = text;
        }
    });

    function Letter(type) {
        var name = $("#Name").val();
        var description = $("#description").val();
        var letterBodyArea = $("#letterBodyArea").val();
        var add = $("#add_info").val();
        var id = type == "update" ? "&id=" + $("#id").val() : ""; // check if it is add or update
        if (name == '' || description == '' || letterBodyArea == '') {
            loading(false);
            popup(false, 'please fill all fileds.');
        }
        else {
            if (add != '' || add.match(/^ *$/) == null) {
                if (add.includes('what') || add.includes('where') || add.includes('who') || add.includes('when')) {
                    if (letterBodyArea.includes('(.NAME.)') && letterBodyArea.includes('(.SALARY.)') && letterBodyArea.includes('(.DATE.)') && letterBodyArea.includes('(.ADDITIONAL.)')) {
                        jQuery.ajax({
                            url: "../operations/newLetter.php",
                            data: 'body=' + letterBodyArea + '&Name=' + name + '&description=' + description + '&add=' + add + id,
                            type: "POST",
                            success: function (data) {
                                loading(false);
                                if (data == "Letter updated" || data == "Letter created")
                                    popup(true, data);
                                else
                                    popup(false, data);
                            },
                            beforeSend: function () {
                                loading(true);
                            }

                        });
                    }
                    else { popup(false, 'please fill Name, Salary and Date,Additional info if added'); }
                }
                else { popup(false, 'please add valid WH question'); }
            } else if (letterBodyArea.includes('(.NAME.)') && letterBodyArea.includes('(.SALARY.)') && letterBodyArea.includes('(.DATE.)')) {
                jQuery.ajax({
                    url: "../operations/newLetter.php",
                    data: 'body=' + letterBodyArea + '&Name=' + name + '&description=' + description + '&add=0' + id,
                    type: "POST",
                    success: function (data) {
                        loading(false);
                        popup(true, data);
                    },
                    beforeSend: function () {
                        loading(true);
                    }

                });
            }
            else { popup(false, 'please fill Name, Salary and Date,Additional info if added'); }
        }
    }

    $("#AddLetterbtn").on("click", function () {
        ;
        Letter("add");
    });
    $("#UpdateLetterbtn").on("click", function () {
        Letter("update");
    });


    /**************** LetterRequests ********************/

    $(".letterstd").on("click", function () {
        jQuery.ajax({
            url: "view_employee.php",
            data: 'id=' + this.id,
            type: "POST",
            success: function (data) {
                loading(false);
                $("#body").html(data);
            },
            beforeSend: function () {
                loading(true);
            }
        });
    });
});
