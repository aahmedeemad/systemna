$(document).ready(function () {

    setcounters(); /* Calling the function to set the numbers of counters on site starting*/
    setInterval(setcounters, 1000); /* Calling the function to update the numbers of counters every 10 seconds */
    getnotifications(); /* Calling the function to get the notifications data from DB */
    setInterval(getnotifications, 1000); /* Calling the function to update the content of notifications every 10 seconds */
    sendcalmails(); /* Calling the function to send holiday emails */

    function sendcalmails() { /* A function to send holiday emails */
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
            if (curdd == holidd && curmm == holimm) { /* Checking if the current day is a holiday */
                jQuery.ajax({ /* Send notifiation */
                    type: "POST",
                    url: "../operations/massmsging.php",
                    data: "notification=" + content + "&type=notiall",
                    success: function (html) {
                        /*console.log(html);
                        jQuery.ajax({ // Send mail //
                            type: "POST",
                            url: "../operations/massmsging.php",
                            data: "mailsubject=" + mailsubj + "&mailcontent=" + content + "&type=mailall",
                            success: function (html) {
                                console.log(html);
                            }
                        });*/
                    }
                });
            }
        }
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
        return false;
    });

    //$('#notifications').click(function () { /* Do nothing when notifications are clicked */
    //    return false;
    //});


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
        $(".modal").css("display", "block");
    }


    /******* Confirmation delete popup *******/
    function confirmation(body, url, data) {
        $(".confirmation-content").text(body);
        $("#confirmationButton").on("click", function () {
            jQuery.ajax({
                type: "GET",
                url: url,
                success: function (html) {
                    $(".modalConfirmation").css("display", "none");
                    popup(true, "Deleted");
                    $(data).hide();
                }
            });
        })
        $(".modalConfirmation").css("display", "block");
    }

    /******* Confirm delete popup *******/
    $(".deleteConfirmation").on("click", function (e) {
        e.preventDefault(); /* to prevent href action */
        confirmation("Are you sure ?", this.href, $(this).closest('tr')); /* show to confirmation popup */
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
        document.cookie = "theme=darktheme; expires= Thu, 01 Jan 2021 00:00:00 UTC; path=/;";
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
    }

    function light() { /* Changing everything to light */
        document.cookie = "theme=lighttheme; expires= Thu, 01 Jan 2021 00:00:00 UTC; path=/;";
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
        if (e.target == $(".modal")[0]) {
            $(".modal").css("display", "none");
        }
    });

    /* Close button in popup */
    $(".popup-close").on("click", function () {
        $(".modal").css("display", "none");
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
                    if (type == "fullname") fullnameToggle();
                    else if (type == "ssn" || type == "bdate" || type == "location") basicInfoToggle();
                    else if (type == "email" || type == "phone") contactInfoToggle();
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
    });

    $(".save-contact-info").on("click", function () {
        var email = $("#emailEdit").val();
        var defaultEmail = $("#emailEdit")[0]["defaultValue"];
        var phone = $("#phoneEdit").val();
        var defaultPhone = $("#phoneEdit")[0]["defaultValue"];
        var id = $("#id").text();
        if (email != defaultEmail) submitEdit(id, "email", defaultEmail, email);
        if (phone != defaultPhone) submitEdit(id, "phone", defaultPhone, phone);
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

    function uploadProfilePicture() {
        var input = document.getElementById("profile-picture-input");
        file = input.files[0];
        if (file != undefined) {
            formData = new FormData();
            if (file.type.match(/.jpeg/)) {
                formData.append("image", file);
                $.ajax({
                    url: "../operations/uploadUserImage.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $(".profile-picture").attr("src", data);
                        window.location.reload();
                    }
                });
            } else { popup(false, "Not a valid image!"); }
        } else { popup(false, "Input something!"); }
    }

    $(".profile-picture-input").on("change", function () {
        uploadProfilePicture();
    });

    $(".profile-camera-button").on("click", function () {
        $(".profile-picture-input").click();
    });



    /********************************************               END PROFILE           ********************************************/

    /******************************************** START PN (Passport And National ID) ********************************************/

    function uploadPassportPicture() {
        var input = document.getElementById("passport-picture-input");
        file = input.files[0];
        if (file != undefined) {
            formData = new FormData();
            if (file.type.match(/.jpeg/)) {
                formData.append("image", file);
                $.ajax({
                    url: "../operations/uploadPassportImage.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $(".passport-picture").attr("src", data);
                        window.location.reload();
                    }
                });
            } else { popup(false, "Not a valid image!"); }
        } else { popup(false, "Input something!"); }
    }

    $(".passport-picture-input").on("change", function () {
        uploadPassportPicture();
    });

    $(".passport-camera-button").on("click", function () {
        $(".passport-picture-input").click();
    });

    function uploadNationalIdPicture() {
        var input = document.getElementById("national-picture-input");
        file = input.files[0];
        if (file != undefined) {
            formData = new FormData();
            if (file.type.match(/.jpeg/)) {
                formData.append("image", file);
                $.ajax({
                    url: "../operations/uploadNationalImage.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $(".national-picture").attr("src", data);
                        window.location.reload();
                    }
                });
            } else { popup(false, "Not a valid image!"); }
        } else { popup(false, "Input something!"); }
    }


    $(".national-picture-input").on("change", function () {
        uploadNationalIdPicture();
    });

    $(".national-camera-button").on("click", function () {
        $(".national-picture-input").click();
    });

    /******************************************** END PN (Passport And National ID) ********************************************/
    var orig;
    $(".sal").on("click", function (event) {
        $(this)
            .closest("div")
            .attr("contenteditable", "true");
        $(this).focus();
        $(this).addClass("input");
        orig = $(this).text();
        $(this).keyup(function () {
            var test = $(this)
                .text();

            if (!test.match(/^[0-9]+$/)) {
                $(this).removeClass("input");
                $(this).addClass("wr");
            } else {
                $(this).removeClass("wr");
                $(this).addClass("input");
            }
        });
    });

    $(".sal").on("focusout", function (event) {
        var tsal = $(this);
        $(this).removeClass("input");
        var row = $(this).closest("tr");
        var rowIndex = row.index();
        var c = $("#Display")
            .find("tr:eq(" + rowIndex + ")")
            .find("td:eq(1)");
        var test2 = $(this).html();
        test2 = test2.replace("<br>", "");

        if (!test2.match(/^[0-9]+$/)) {
            popup(false, "Salary must be a number!");
        } else {
            loading(true);
            $.ajax({
                method: "POST",
                url: "../operations/EditTable.php",
                data: { test: test2, id: c.text() },
                success: function (msg) {
                    if (msg == '0') { popup(false, "User needs to be accepted to update his salary!"); loading(false); tsal.text(orig); }
                    else {
                        loading(false);
                        popup(true, "Salary Updated!");
                        sendnoti(c.text(), "You salary has been updated to " + test2 + " EGP.", '../pages/profile.php');
                    }
                }
            });
        }
    });

    $("#tblsearch").keyup(function () {
        search_table($(this).val());
        alert($("#Display tr").length);
    });

    function search_table(value) {
        var selected = $("#choice")
            .children("option:selected")
            .val();
        var selection;
        if (selected == "email") selection = 3;
        if (selected == "ssn") selection = 4;
        if (selected == "username") selection = 2;
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

    $(".modify").on("click", function () {
        var thisBtn = $(this);
        var Eindex = $(this)
            .closest("tr")
            .index();
        var idMod = $("#Display")
            .find("tr:eq(" + Eindex + ")")
            .find("td:eq(1)")
            .text();
        var typeM;
        var otherButton;
        if ($(this).val() == "+HR") {
            typeM = "admin";
            otherButton = 6;
        } else if ($(this).val() == "+QC") {
            typeM = "qc";
            otherButton = 7;
        }
        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/EditTable.php",
            data: { type: typeM, mid: idMod },
            success: function (msg) {
                loading(false);
                if (msg != 1) popup(false, "User needs to be accepted to do this action!");
                else {
                    thisBtn.css("background-color", "grey");
                    $("#Display")
                        .find("tr:eq(" + Eindex + ")")
                        .find("td:eq(" + otherButton + ")")
                        .html("");
                    if (thisBtn.val() == "+HR") {
                        sendnoti(idMod, "Congratulations you have been promoted to an HR!", '../pages/profile.php');
                        sendmail(idMod, "Congratulations on your Promotion", "Congratulations you have been promoted to an HR!");
                    }
                    else if (thisBtn.val() == "+QC") {
                        sendnoti(idMod, "Congratulations you have been promoted to an QC!", '../pages/profile.php');
                        sendmail(idMod, "Congratulations on your Promotion", "Congratulations you have been promoted to an QC!");
                    }
                }
            }
        });
    });

    $(".accept").click(function () {
        var Row = $(this).closest("tr");
        var Did = $("#tblRequests")
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(2)")
            .text();
        var Type = $("#tblRequests")
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(6)")
            .text();
        var Rid = $("#tblRequests")
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(1)")
            .text();
        var Value = $("#tblRequests")
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
            .find("td:eq()")
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
        var Rid = $("#Display")
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

    $("#AddLetterbtn").click(function () {
        function checkAvai() {
            jQuery.ajax({
                url: "AddNewLetter.php",
                data: "Name=" + $("#Name").val(),
                type: "POST",
                success: function (data) { }
            });
        }
        var a = document.getElementById("Name").value;
        var b = document.getElementById("description").value;

        if (a == "" || b == "") {
            popup(false, "Please enter the Letter data correctly !");
            return 0;
        }
        if (a != "" && b != "") {
            jQuery.ajax({
                type: "POST",
                url: "../operations/getudata.php",
                data: { getid: 1 },
                success: function (data) {
                    sendnoti(data, "Your New Type of Letter Has Been Added Successfully!", '../pages/MakeLetter.php');
                    sendmail(data, "Letter placed", "Your New Type of Letter Has Been Added Successfully!")
                    loading(true);
                    popup(true, "Letter Added Successfully");
                }
            });
        }
        var dataa = document.getElementById('body').value;
        dataa = '<pre>' + dataa + '</pre>';
        if (dataa.includes('(.NAME.)') && dataa.includes('(.SALARY.)') && dataa.includes('(.DATE.)')) {
            jQuery.ajax({
                url: "../operations/newLetter.php",
                data: 'body=' + dataa + '&Name=' + $("#Name").val() + '&description=' + $("#description").val(),
                type: "POST",
                success: function (data) {
                    loading(false);
                    popup(data);
                },
                beforeSend: function () {
                    loading(true);
                }

            });
        } else {
            popup('please fill Name, Salary and Date');
        }
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

    /*  var arr = [];
      var counter = 0;
      var cntr1 = 0;
      var cntr2 = 0;
      var cntr3 = 0;
      var cntr4 = 0;

      $("#btn2").click(function() {
          $("#btn2").toggleClass("Letterbutton1");
          arr.push("General HR letter");
          counter++;
          cntr1++;
          if (cntr1 % 2 == 0) {
              arr.splice(arr.indexOf("General HR letter"), 1);
              arr.splice(arr.indexOf("General HR letter"), 1);
          }
      });
      $("#btn3").click(function() {
          $("#btn3").toggleClass("Letterbutton1");
          arr.push("Embassy HR letter");
          counter++;
          cntr2++;
          if (cntr2 % 2 == 0) {
              arr.splice(arr.indexOf("Embassy HR letter"), 1);
              arr.splice(arr.indexOf("Embassy HR letter"), 1);
          }
      });
      $("#btn4").click(function() {
          $("#btn4").toggleClass("Letterbutton1");
          arr.push("Letter directed to specific organization");
          counter++;
          cntr3++;
          if (cntr3 % 2 == 0) {
              arr.splice(arr.indexOf("Letter directed to specific organization"), 1);
              arr.splice(arr.indexOf("Letter directed to specific organization"), 1);
          }
      });
      $("#btn5").click(function() {
          $("#btn5").toggleClass("Letterbutton1");
          arr.push("Letter to whom might concern");
          counter++;
          cntr4++;
          if (cntr4 % 2 == 0) {
              arr.splice(arr.indexOf("Letter to whom might concern"), 1);
              arr.splice(arr.indexOf("Letter to whom might concern"), 1);
          }
      });*/


    /******************************************************************************************************************
    * MakeLetter.php
    * apply button
    * revised by Mark
    ******************************************************************************************************************/
    $("#applyForLetterBtn").click(function () {
        var salary;
        var priority;
        var type_name;
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
            $.ajax({
                type: "POST",
                url: "../operations/addletter.php",
                data: "salary=" + salary + "&priority=" + priority + "&type_name=" + type_name + "&type=addLetter",
                success: function (html) {
                    loading(false);
                    if (html == "true")
                        popup(true, "Letter Added Successfully");
                    else
                        popup(false, html);
                    sendnoti(id, "Letter Request Added Successfully!", '../pages/viewRequest.php');
                    sendmail(id, "Letter Added", "You Letter Request has been Added Successfully!");
                },
                beforeSend: function () {
                    loading(true);
                }
            });
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
                    $('#notidata').text('You have no new notifications, you will be alereted when you recieve somethings new.')
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
        $('#notidata').text('You have no new notifications, you will be alereted when you recieve somethings new.')
            .css('text-align', 'center'); /* Replacing the data when markall is clicked */
        $('#markAll').css('display', 'none'); /* Hiding the markall button when markall is clicked */
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
        if (hr == true && !text.includes("(.HR.)")) {
            text = text.replace('HR', "(.HR.) ");
            $("#letterBodyArea").val() = text;
        }
        if (n == true && !text.includes("(.NAME.)")) {
            text = text.replace('NAME', "(.NAME.) ");
            $("#letterBodyArea").val() = text;
        }
        if (s == true && !text.includes("(.SALARY.)")) {
            text = text.replace('SALARY', "(.SALARY.)");
            $("#letterBodyArea").val() = text;
        }
        if (d == true && !text.includes("(.DATE.)")) {
            text = text.replace('DATE', "(.DATE.) ");
            $("#letterBodyArea").val() = text;
        }
        if (p == true && !text.includes("(.POSITION.)")) {
            text = text.replace('POSITION', "(.POSITION.) ");
            $("#letterBodyArea").val() = text;
        }
        if (startdate == true && !text.includes("(.START.)")) {
            text = text.replace('START', "(.START.) ");
            $("#letterBodyArea").val() = text;
        }
    });

    /*  $("#AddLetterbtn").on("click", function () {
        var dataa=document.getElementById('body').value;
        dataa='<pre>'+dataa+'</pre>';
        if (dataa.includes('(.NAME.)') && dataa.includes('(.SALARY.)') && dataa.includes('(.DATE.)')){
            jQuery.ajax({
                url: "../operations/newLetter.php",
                data:'body='+dataa+'&Name='+$("#Name").val()+'&description='+$("#description").val(),
                type:"POST",
                success:function(data)
                {
                    loading(false);
                    popup(data);
                },
                beforeSend: function () {
                    loading(true);
                }

            });
        } else {
            popup('please fill Name, Salary and Date');
        }
    });*/

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
