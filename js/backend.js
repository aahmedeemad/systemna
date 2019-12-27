$(document).ready(function () {

    setcounters();

    if ($('#profile_Counter').text() == "0") {
        $('#profile_Counter').css("display", "none");
    }
    else if ($('#usrsletterrequests_Counter').text() == "0") {
        $('#usrsletterrequests_Counter').css("display", "none");
    }
    else if ($('#ownletterrequests_Counter').text() == "0") {
        $('#ownletterrequests_Counter').css("display", "none");
    }
    else if ($('#usrs_Counter').text() == "0") {
        $('#usrs_Counter').css("display", "none");
    }

    $('.pages_edit').text('Edit');
    $('#faq_add').text('Add Question');
    $('#add_letter').text('Add new type of letter');

    $('#noti_Button').click(function () {
        // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
        $('#notifications').fadeToggle('fast', 'linear');
        return false;
    });

    //HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
    $(document).click(function () {
        $('#notifications').hide();
    });

    $('#notifications').click(function () {
        // DO NOTHING WHEN CONTAINER IS CLICKED.
        return false;
    });

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

    function popup(head, body) {
        head = head == true ? "Success" : "Failed";
        $(".popup-notification h2").text(head);
        $(".popup-content").text(body);
        $(".modal").css("display", "block");
    }

    $(".navbar-toggle").on("click", function () {
        $(".sidenav-custom").animate({ width: "toggle" }, 350);
    });

    function dark() {
        document.cookie = "theme=darktheme; expires= Thu, 01 Jan 2050 20:00:00 UTC; path=/;";
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
        $("tr:nth-child(even)").css("background", "black");
        $("tr:nth-child(even)").css("color", "white");
        $(".profile").css("background-color", "#303030");
        $(".profile-left").css("background-color", "#585858");
        $(".profile-right-up").css("background-color", "#585858");
        $(".profile-right-down").css("background-color", "#585858");
    }

    function light() {
        document.cookie = "theme=lighttheme; expires= Thu, 01 Jan 2050 20:00:00 UTC; path=/;";
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
    }

    $("#darkmode").on("click", dark);
    $("#lightmode").on("click", light);

    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    };
    var themecookie = getCookie("theme");
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

    $(".popup-close").on("click", function () {
        $(".modal").css("display", "none");
    });

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
        //        $("#username").toggleClass("hidden");
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

    /************************************ Updated ************************************/
    $(".save-fullname").on("click", function () {
        var fullname = $("#fullnameEdit").val();
        var defaultFullname = $("#fullnameEdit")[0]["defaultValue"];
        var id = $("#id").text();
        if (fullname != defaultFullname) {
            $.ajax({
                type: "POST",
                url: "../operations/editProfile.php",
                data:
                    "id=" +
                    id +
                    "&oldvalue=" +
                    defaultFullname +
                    "&value=" +
                    fullname +
                    "&type=fullname",
                success: function (html) {
                    console.log(html);
                    loading(false);
                    if (html == "true") {
                        fullnameToggle();
                        popup(true, "Your Request Has Been Submitted Successfully");
                    } else { popup(false, html); }
                },
                beforeSend: function () {
                    loading(true);
                }
            });
        }
    });

    /************************************ Updated ************************************/
    $(".save-basic-info").on("click", function () {
        var ssn = $("#ssnEdit").val();
        var defaultSSN = $("#ssnEdit")[0]["defaultValue"];
        var bdate = $("#birthdateEdit").val();
        var defaultBdate = $("#birthdateEdit")[0]["defaultValue"];
        var loc = $("#locationEdit").val();
        var defaultLoc = $("#locationEdit")[0]["defaultValue"];
        var id = $("#id").text();
        if (ssn != defaultSSN) {
            $.ajax({
                type: "POST",
                url: "../operations/editProfile.php",
                data:
                    "id=" +
                    id +
                    "&oldvalue=" +
                    defaultSSN +
                    "&value=" +
                    ssn +
                    "&type=ssn",
                success: function (html) {
                    loading(false);
                    if (html == "true") {
                        basicInfoToggle();
                        popup(true, "Your Request Has Been Submitted Successfully");
                    } else { popup(false, html); }
                },
                beforeSend: function () {
                    loading(true);
                }
            });
        }
        if (bdate != defaultBdate) {
            $.ajax({
                type: "POST",
                url: "../operations/editProfile.php",
                data:
                    "id=" +
                    id +
                    "&oldvalue=" +
                    defaultBdate +
                    "&value=" +
                    bdate +
                    "&type=bdate",
                success: function (html) {
                    loading(false);
                    if (html == "true") {
                        basicInfoToggle();
                        popup(true, "Your Request Has Been Submitted Successfully");
                    } else { popup(false, html); }
                },
                beforeSend: function () {
                    loading(true);
                }
            });
        }

        if (loc != defaultLoc) {
            $.ajax({
                type: "POST",
                url: "../operations/editProfile.php",
                data:
                    "id=" +
                    id +
                    "&oldvalue=" +
                    defaultLoc +
                    "&value=" +
                    loc +
                    "&type=location",
                success: function (html) {
                    console.log(html);
                    loading(false);
                    if (html == "true") {
                        basicInfoToggle();
                        popup(true, "Your Request Has Been Submitted Successfully");
                    } else { popup(false, html); }
                },
                beforeSend: function () {
                    loading(true);
                }
            });
        }
    });

    /************************************ Updated ************************************/
    $(".save-contact-info").on("click", function () {
        var email = $("#emailEdit").val();
        var defaultEmail = $("#emailEdit")[0]["defaultValue"];
        var phone = $("#phoneEdit").val();
        var defaultPhone = $("#phoneEdit")[0]["defaultValue"];
        var id = $("#id").text();
        if (email != defaultEmail) {
            $.ajax({
                type: "POST",
                url: "../operations/editProfile.php",
                data:
                    "id=" +
                    id +
                    "&oldvalue=" +
                    defaultEmail +
                    "&value=" +
                    email +
                    "&type=email",
                success: function (html) {
                    console.log(html);
                    loading(false);
                    if (html == "true") {
                        contactInfoToggle();
                        popup(true, "Your Request Has Been Submitted Successfully");
                    } else { popup(false, html); }
                },
                beforeSend: function () {
                    loading(true);
                }
            });
        }
        if (phone != defaultPhone) {
            $.ajax({
                type: "POST",
                url: "../operations/editProfile.php",
                data:
                    "id=" +
                    id +
                    "&oldvalue=" +
                    defaultPhone +
                    "&value=" +
                    phone +
                    "&type=phone",
                success: function (html) {
                    console.log(html);
                    loading(false);
                    if (html == "true") {
                        contactInfoToggle();
                        popup(true, "Your Request Has Been Submitted Successfully");
                    } else { popup(false, html); }
                },
                beforeSend: function () {
                    loading(true);
                }
            });
        }
    });

    /************************************ Updated ************************************/
    $(".save-company-info").on("click", function () {
        var pass = $("#passwordEdit").val();
        //        var defaultPass = $("#passwordEdit")[0]['defaultValue'];
        var id = $("#id").text();

        $.ajax({
            type: "POST",
            url: "../operations/editProfile.php",
            data: "id=" + id + "&value=" + pass + "&value=" + pass + "&type=password",
            success: function (html) {
                console.log(html);
                loading(false);
                if (html == "true") {
                    companyInfoToggle();
                    popup(true, "Your Request Has Been Submitted Successfully");
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
                    if (msg == 0) { popup(false, "User needs to be accepted to update his salary!"); loading(false); tsal.text(orig); }
                    else {
                        loading(false);
                        popup(true, "Salary Updated!");
                    }
                }
            });
        }
    });
    $("#tblsearch").keyup(function () {
        search_table($(this).val());
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
            .find("td:eq(5)")
            .text();
        var Rid = $("#tblRequests")
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(1)")
            .text();
        var Value = $("#tblRequests")
            .find("tr:eq(" + Row.index() + ")")
            .find("td:eq(4)")
            .text();
        loading(true);
        $.ajax({
            method: "POST",
            url: "../operations/editProfileTBL.php",
            data: { type: Type, id: Did, rid: Rid, value: Value },
            success: function (msg) {
                loading(false);
                Row.hide();
            }
        });
    });
    $(".reject").click(function () {
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
    $("#btn1").click(function () {
        function checkAvai() {
            jQuery.ajax({
                url: "AddQuestion.php",
                data: "question=" + $("#question").val(),
                type: "POST",
                success: function (data) { }
            });
        }
        var a = document.getElementById("question").value;
        var b = document.getElementById("answer").value;
        var c = document.getElementById("requested_by").value;
        if (a != "" && b != "") {
            loading(true);
            popup(true, "Your Question Has Been Added Successfully");
            jQuery.ajax({
               type: "POST",
               url: "../operations/getid.php",
               data:{x:1},
               success: function(data) {
                 sendnoti(data,"Your Question Has Been Added Successfully");
                 sendmail(data,"Letter placed","Your Question Has Been Added Successfully");

               }
              });
            //alert("Data Saved Successfully");
        }
    });
    $("#btn2").click(function () {
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
        if (a != "" && b != "") {
            loading(true);
            popup(true, "Letter Added Successfully");
            jQuery.ajax({
               type: "POST",
               url: "../operations/getid.php",
               data:{x:1},
               success: function(data) {
                 sendnoti(data,"Your New Type of Letter Has Been Added Successfully");
                 sendmail(data,"Letter placed","Your New Type of Letter Has Been Added Successfully");

               }
              });
            //alert("Letter Added Successfully");
        }
    });

    $("#faqsubmit").click(function () {
        function checkAvai() {
            jQuery.ajax({
                url: "faq.php",
                data: "faqinputtext=" + $("#faqinputtext").val(),
                type: "POST",
                success: function (data) { }
            });
        }
        var a = document.getElementById("faqinputtext").value;
        var b = document.getElementById("faqtextarea").value;
        if (a != "" && b != "") {
          loading(true);
          popup(true, "Message Sent Successfully");
          jQuery.ajax({
             type: "POST",
             url: "../operations/getid.php",
             data:{x:1},
             success: function(data) {
               sendnoti(data,"We recived your message successfully");
               sendmail(data,"message recieved","We recived your message successfully and we are going to work on it , thank you");

             }
            });
            //alert("Message Sent Successfully");
        }
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

    $("#submitbtn").click(function () {

        if (
            (document.getElementById("rdbtn1").checked ||
                document.getElementById("rdbtn2").checked) &&
            (document.getElementById("rdbtn3").checked ||
                document.getElementById("rdbtn4").checked) &&
            !document.getElementsByClassName("Letterbuttonn").checked
        ) {
            popup(true, "your request has been placed successfully");
              type_name = $("input[name=Letterbuttonn]:checked").val();
            jQuery.ajax({
               type: "POST",
               url: "../operations/getid.php",
               data:{x:1},
               success: function(data) {
                 sendnoti(data,"your Letter request has been placed successfully");
                 sendmail(data,"Letter placed","your Letter request has been placed successfully");

               }
              });

            //  alert("your request has been placed successfully");


        } else {
            popup(false, "you have an error completing your request");
            //  alert("you have an error completing your request");
        }
        if (document.getElementById("rdbtn1").checked) {
            priority = 1;
        } else if (document.getElementById("rdbtn2").checked) {
            priority = 0;
        }
        if (document.getElementById("rdbtn3").checked) {
            salary = 1;
        } else if (document.getElementById("rdbtn4").checked) {
            salary = 0;
        }
        var value;

        jQuery.ajax({
            method: "POST",
            url: "MakeLetter.php",
            data: { salary: salary, priority: priority, type_name: type_name },
            success: function (data2) { }
        });

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

    $("#searched").keyup(function () {
        //    if ($("#searched").val() == "" || $("#searched").val() == " ") {
        //      alert("error: Enter something to search for!");
        //      return false;
        //    }
        var searchedText = $("#searched").val();
        var page = $("#faqdiv");
        var pageText = page.html();
        var newHtml = pageText.replace(/<span>/g, "").replace(/<\/span>/g, "");
        if (searchedText != "") {
            var theRegEx = new RegExp("(" + searchedText + ")(?!([^<]+)?>)", "gi");
            newHtml = newHtml.replace(theRegEx, "<span>$1</span>");
        }
        page.html(newHtml);
    });
    //  $("#searched").keyup(function() {
    //    if ($("#searched").val() == "" || $("#searched").val() == " ") {
    //      location.reload();
    //    }
    //  });



    /********************** Send notfications and mails **********************/
    $("#notisendall").on("click",function(){
        var data = $("#massnoti").val();
        if (data=="") {
            popup(false, "Please enter notification content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "notification=" + data + "&type=notiall",
            success: function (html) {
                console.log(html);
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

    $("#notisendone").on("click",function(){
        var id = $("#notione").val();
        var data = $("#massnoti").val();
        if (id<=0) {
            popup(false, "Please choose a user from the list");
            return 0;
        } else if (data=="") {
            popup(false, "Please enter notification content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "id=" + id + "&notification=" + data + "&type=notione",
            success: function (html) {
                console.log(html);
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

    $("#mailsendall").on("click",function(){
        var mailsubject = $("#mailsubject").val();
        var mailcontent = $("#mailcontent").val();
        if (mailsubject=="") {
            popup(false, "Please enter mail subject");
            return 0;
        } else if (mailcontent=="") {
            popup(false, "Please enter mail content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "mailsubject=" + mailsubject + "&mailcontent=" + mailcontent + "&type=mailall",
            success: function (html) {
                console.log(html);
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

    $("#mailsendone").on("click",function(){
        var mailsubject = $("#mailsubject").val();
        var mailcontent = $("#mailcontent").val();
        var email = $("#mailone").val();
        if (email<=0) {
            popup(false, "Please choose a user from the list");
            return 0;
        } else if (mailsubject=="") {
            popup(false, "Please enter mail subject");
            return 0;
        } else if (mailcontent=="") {
            popup(false, "Please enter mail content");
            return 0;
        }
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "email=" + email + "&mailsubject=" + mailsubject + "&mailcontent=" + mailcontent + "&type=mailone",
            success: function (html) {
                console.log(html);
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

    function sendmail(userid, mailsubject, mailcontent){
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "uid=" + userid + "&mailsubject=" + mailsubject + "&mailcontent=" + mailcontent + "&type=sendmailfn",
            success: function (html) {
                console.log(html);
            }
        });
    }

    function sendnoti(userid, noticontent){
        $.ajax({
            type: "POST",
            url: "../operations/massmsging.php",
            data: "uid=" + userid + "&noticontent=" + noticontent + "&type=sendnotifn",
            success: function (html) {
                console.log(html);
            }
        });
    }

    function setcounters(){
        $.ajax({
            type: "POST",
            url: "../operations/counterops.php",
            data: "type=setnoticounter",
            success: function (html) {
                $('#noti_Counter').text(html);
                if (html == "0") {
                    $('#noti_Counter').css("display", "none");
                }
            },
        });
    }

    $("#add_letter").on("click",function(){
        document.location.replace('../pages/AddNewLetter.php');;
    });

    $("#faq_edit").on("click",function(){
        document.location.replace('../pages/viewFAQ.php');
    });

    $("#faq_add").on("click",function(){
        document.location.replace('../pages/AddQuestion.php');
    });

    $("#letter_edit").on("click",function(){
        document.location.replace('../pages/allLetters.php');
    });

    $("#markAll").on("click",function(){
        $.ajax({
            type: "POST",
            url: "../operations/mark_read.php",
            data: "&type=markread",
        });
        document.getElementById('notidata').innerHTML = ' ';
        document.getElementById('noti_Counter').innerHTML = '0';
    });

});
