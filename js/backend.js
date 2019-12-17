$(document).ready(function () {
    $(".navbar-toggle").on("click", function () {
        $(".sidenav-custom").animate({ width: "toggle" }, 350);
    });

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
        var defaultFullname = $("#fullnameEdit")[0]['defaultValue'];
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
                    if (html == "true") {
                        $("#fullname").toggleClass("hidden");
                        $(".input-fullname").toggleClass("hidden");
                        $(".save-fullname").toggleClass("hidden");
                        $(".cancel-fullname").toggleClass("hidden");
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Success");
                        $(".popup-content").text("Your Request Has Been Submitted Successfully");
                        $(".modal").css("display", "block");
                    } else {
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Failed");
                        $(".popup-content").text(html);
                        $(".modal").css("display", "block");
                    }
                },
                beforeSend: function () {
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");
                }
            });
        }
    });

    /************************************ Updated ************************************/
    $(".save-basic-info").on("click", function () {
        var ssn = $("#ssnEdit").val();
        var defaultSSN = $("#ssnEdit")[0]['defaultValue'];
        var bdate = $("#birthdateEdit").val();
        var defaultBdate = $("#birthdateEdit")[0]['defaultValue'];
        var loc = $("#locationEdit").val();
        var defaultLoc = $("#locationEdit")[0]['defaultValue'];
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
                    if (html == "true") {
                        $("#ssn").toggleClass("hidden");
                        $("#birthdate").toggleClass("hidden");
                        $("#location").toggleClass("hidden");
                        $(".input-basic-info").toggleClass("hidden");
                        $(".save-basic-info").toggleClass("hidden");
                        $(".cancel-basic-info").toggleClass("hidden");
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Success");
                        $(".popup-content").text("Your Request Has Been Submitted Successfully");
                        $(".modal").css("display", "block");
                    } else {
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Failed");
                        $(".popup-content").text(html);
                        $(".modal").css("display", "block");
                    }
                },
                beforeSend: function () {
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");
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
                    "&type=birthdate",
                success: function (html) {
                    if (html == "true") {
                        $("#ssn").toggleClass("hidden");
                        $("#birthdate").toggleClass("hidden");
                        $("#location").toggleClass("hidden");
                        $(".input-basic-info").toggleClass("hidden");
                        $(".save-basic-info").toggleClass("hidden");
                        $(".cancel-basic-info").toggleClass("hidden");
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Success");
                        $(".popup-content").text("Your Request Has Been Submitted Successfully");
                        $(".modal").css("display", "block");
                    } else {
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Failed");
                        $(".popup-content").text(html);
                        $(".modal").css("display", "block");
                    }
                },
                beforeSend: function () {
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");
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
                    if (html == "true") {
                        $("#ssn").toggleClass("hidden");
                        $("#birthdate").toggleClass("hidden");
                        $("#location").toggleClass("hidden");
                        $(".input-basic-info").toggleClass("hidden");
                        $(".save-basic-info").toggleClass("hidden");
                        $(".cancel-basic-info").toggleClass("hidden");
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Success");
                        $(".popup-content").text("Your Request Has Been Submitted Successfully");
                        $(".modal").css("display", "block");
                    } else {
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Failed");
                        $(".popup-content").text(html);
                        $(".modal").css("display", "block");
                    }
                },
                beforeSend: function () {
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");
                }
            });
        }

    });

    /************************************ Updated ************************************/
    $(".save-contact-info").on("click", function () {
        var email = $("#emailEdit").val();
        var defaultEmail = $("#emailEdit")[0]['defaultValue'];
        var phone = $("#phoneEdit").val();
        var defaultPhone = $("#phoneEdit")[0]['defaultValue'];
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
                    if (html == "true") {
                        $("#mail").toggleClass("hidden");
                        $("#phone").toggleClass("hidden");
                        $(".input-contact-info").toggleClass("hidden");
                        $(".save-contact-info").toggleClass("hidden");
                        $(".cancel-contact-info").toggleClass("hidden");
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Success");
                        $(".popup-content").text("Your Request Has Been Submitted Successfully");
                        $(".modal").css("display", "block");
                    } else {
                        $(".popup-notification h2").text("Failed");
                        $(".popup-content").text(html);
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");
                        $(".modal").css("display", "block");
                    }
                },
                beforeSend: function () {
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");
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
                    if (html == "true") {
                        $("#mail").toggleClass("hidden");
                        $("#phone").toggleClass("hidden");
                        $(".input-contact-info").toggleClass("hidden");
                        $(".save-contact-info").toggleClass("hidden");
                        $(".cancel-contact-info").toggleClass("hidden");
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");

                        $(".popup-notification h2").text("Success");
                        $(".popup-content").text("Your Request Has Been Submitted Successfully");
                        $(".modal").css("display", "block");
                    } else {
                        $(".popup-notification h2").text("Failed");
                        $(".popup-content").text(html);
                        $(".loading").toggleClass("hidden");
                        $(".profile").toggleClass("hidden");
                        $(".modal").css("display", "block");
                    }
                },
                beforeSend: function () {
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");
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
            data:
                "id=" +
                id +
                "&value=" +
                pass +
                "&value=" +
                pass +
                "&type=password",
            success: function (html) {
                console.log(html);
                if (html == "true") {

                    //                    $("#username").toggleClass("hidden");
                    $("#password").toggleClass("hidden");
                    $(".input-company-info").toggleClass("hidden");
                    $(".save-company-info").toggleClass("hidden");
                    $(".cancel-company-info").toggleClass("hidden");
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");

                    $(".popup-notification h2").text("Success");
                    $(".popup-content").text("Your Request Has Been Submitted Successfully");
                    $(".modal").css("display", "block");
                } else {
                    $(".popup-notification h2").text("Failed");
                    $(".popup-content").text(html);
                    $(".loading").toggleClass("hidden");
                    $(".profile").toggleClass("hidden");
                    $(".modal").css("display", "block");
                }
            },
            beforeSend: function () {
                $(".loading").toggleClass("hidden");
                $(".profile").toggleClass("hidden");
            }
        });
    });



    $(".eyeedit").on('click', function () {
        if ($("#passwordEdit").attr("type") == 'text')
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
            } else {
                alert("Not a valid image!");
            }
        } else {
            alert("Input something!");
        }
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
            } else {
                alert("Not a valid image!");
            }
        } else {
            alert("Input something!");
        }
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
            } else {
                alert("Not a valid image!");
            }
        } else {
            alert("Input something!");
        }
    }

    $(".national-picture-input").on("change", function () {
        uploadNationalIdPicture();
    });

    $(".national-camera-button").on("click", function () {
        $(".national-picture-input").click();
    });

    $(".sal").on("click", function (event) {
        $(this)
            .closest("div")
            .attr("contenteditable", "true");
        $(this).focus();
        $(this).addClass("input");
        $(this).keyup(function () {
            var test = $(this)
                .html()
                .replace("<br>", "");

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
        $(this).removeClass("input");
        var row = $(this).closest("tr");
        var rowIndex = row.index();
        var c = $("#Display")
            .find("tr:eq(" + rowIndex + ")")
            .find("td:eq(2)");
        var test = $(this).html();
        test = test.replace("<br>", "");

        if (!test.match(/^[0-9]+$/)) {
            alert("Salary must be a number");
            window.location.replace("index.php");
        } else {
            $.ajax({
                method: "POST",
                url: "../operations/EditTable.php",
                data: { test: test, id: c.text() },
                success: function (msg) {
                    alert("Salary Updated!");
                    window.location.replace("index.php");
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
        if (selected == "email") selection = 5;
        if (selected == "ssn") selection = 7;
        if (selected == "username") selection = 4;
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
    $(".modify").on('click', function () { $(this).hide(); });
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
            alert("Data Saved Successfully");
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
            alert("Message Sent Successfully");
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
            alert("your request has been placed successfully");
            type_name = $("input[name=Letterbuttonn]:checked").val();
        } else {
            alert("you have an error completing your request");
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
    $("#submits").on("click", function () {
        //    if ($("#searched").val() == "" || $("#searched").val() == " ") {
        //      alert("error: Enter something to search for!");
        //      return false;
        //    }
        var page = $("#faqdiv");
        var pageText = page.html();
        var newHtml = pageText.replace(/<span>/g, "").replace(/<\/span>/g, "");
        var searchedText = $("#searched").val();
        var theRegEx = new RegExp("(" + searchedText + ")(?!([^<]+)?>)", "gi");
        newHtml = newHtml.replace(theRegEx, "<span>$1</span>");
        page.html(newHtml);
    });
    //  $("#searched").keyup(function() {
    //    if ($("#searched").val() == "" || $("#searched").val() == " ") {
    //      location.reload();
    //    }
    //  });
});
