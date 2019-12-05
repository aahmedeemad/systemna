$(document).ready(function() {
  $(".navbar-toggle").on("click", function() {
    $(".sidenav").animate({ width: "toggle" }, 350);
  });

  $(window).click(function(e) {
    if (e.target == $(".modal")[0]) {
      $(".modal").css("display", "none");
    }
  });

  $(".popup-close").on("click", function() {
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
    $("#username").toggleClass("hidden");
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

  $(".save-fullname").on("click", function() {
    console.log("a");
    var fullname = $("#fullnameEdit").val();
    var id = $("#id").text();
    $.ajax({
      type: "POST",
      url: "../operations/editProfile.php",
      data: "id=" + id + "&fullname=" + fullname + "&type=fullname",
      success: function(html) {
        if (html == "true") {
          $("#fullname").toggleClass("hidden");
          $(".input-fullname").toggleClass("hidden");
          $(".save-fullname").toggleClass("hidden");
          $(".cancel-fullname").toggleClass("hidden");
          $(".loading").toggleClass("hidden");
          $(".profile").toggleClass("hidden");
          $(".modal").css("display", "block");
        }
      },
      beforeSend: function() {
        $(".loading").toggleClass("hidden");
        $(".profile").toggleClass("hidden");
      }
    });
  });

  $(".save-basic-info").on("click", function() {
    console.log("aa");
    var ssn = $("#ssnEdit").val();
    var bdate = $("#birthdateEdit").val();
    var loc = $("#locationEdit").val();
    var id = $("#id").text();
    $.ajax({
      type: "POST",
      url: "../operations/editProfile.php",
      data:
        "id=" +
        id +
        "&ssn=" +
        ssn +
        "&bdate=" +
        bdate +
        "&loc=" +
        loc +
        "&type=basic-info",
      success: function(html) {
        if (html == "true") {
          console.log(html);
          $("#ssn").toggleClass("hidden");
          $("#birthdate").toggleClass("hidden");
          $("#location").toggleClass("hidden");
          $(".input-basic-info").toggleClass("hidden");
          $(".save-basic-info").toggleClass("hidden");
          $(".cancel-basic-info").toggleClass("hidden");
          $(".loading").toggleClass("hidden");
          $(".profile").toggleClass("hidden");
          $(".modal").css("display", "block");
        }
      },
      beforeSend: function() {
        $(".loading").toggleClass("hidden");
        $(".profile").toggleClass("hidden");
      }
    });
  });

  $(".save-contact-info").on("click", function() {
    var email = $("#emailEdit").val();
    var phone = $("#phoneEdit").val();
    var id = $("#id").text();
    $.ajax({
      type: "POST",
      url: "../operations/editProfile.php",
      data:
        "id=" +
        id +
        "&email=" +
        email +
        "&phone=" +
        phone +
        "&type=contact-info",
      success: function(html) {
        if (html == "true") {
          $("#mail").toggleClass("hidden");
          $("#phone").toggleClass("hidden");
          $(".input-contact-info").toggleClass("hidden");
          $(".save-contact-info").toggleClass("hidden");
          $(".cancel-contact-info").toggleClass("hidden");
          $(".loading").toggleClass("hidden");
          $(".profile").toggleClass("hidden");
          $(".modal").css("display", "block");
        }
      },
      beforeSend: function() {
        $(".loading").toggleClass("hidden");
        $(".profile").toggleClass("hidden");
      }
    });
  });
  $(".save-company-info").on("click", function() {
    console.log("aaaa");
    var uname = $("#usernameEdit").val();
    var pass = $("#passwordEdit").val();
    console.log(uname);
    console.log(pass);
    var id = $("#id").text();
    $.ajax({
      type: "POST",
      url: "../operations/editProfile.php",
      data:
        "id=" + id + "&uname=" + uname + "&pass=" + pass + "&type=company-info",
      success: function(html) {
        if (html == "true") {
          $("#username").toggleClass("hidden");
          $("#password").toggleClass("hidden");
          $(".input-company-info").toggleClass("hidden");
          $(".save-company-info").toggleClass("hidden");
          $(".cancel-company-info").toggleClass("hidden");
          $(".loading").toggleClass("hidden");
          $(".profile").toggleClass("hidden");
          $(".modal").css("display", "block");
        }
      },
      beforeSend: function() {
        $(".loading").toggleClass("hidden");
        $(".profile").toggleClass("hidden");
      }
    });
  });

  $(".eye").hover(
    function() {
      $("#password .starts").toggleClass("hidden");
      $("#password .pass").toggleClass("hidden");
    },
    function() {
      $("#password .starts").toggleClass("hidden");
      $("#password .pass").toggleClass("hidden");
    }
  );

  $(".eyeedit").hover(
    function() {
      $("#passwordEdit").attr("type", "text");
    },
    function() {
      $("#passwordEdit").attr("type", "password");
    }
  );

  $(".profile-picture").hover(
    function() {
      $(".addicon").css("display", "block");
    },
    function() {
      $(".addicon").css("display", "none");
    }
  );

  $(".addicon").on("click", function() {
    $("#profile-image-upload").click();
  });

  function uploadFile() {
    var input = document.getElementById("file-upload");
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
          success: function(data) {
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

  $(".file-upload").on("change", function() {
    uploadFile();
  });

  $(".upload-button").on("click", function() {
    $(".file-upload").click();
  });

  $(document).on("click", ".sal", function(event) {
    event.preventDefault();
    $(this)
      .closest("div")
      .attr("contenteditable", "true");
    $(this).focus();
    $(this).addClass("input");
    $(this).keyup(function() {
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

  $(document).on("focusout", ".sal", function(event) {
    $(this).removeClass("input");
    var row = $(this).closest("tr");
    var rowIndex = row.index();
    var c = $("#Display")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(2)");
    event.preventDefault();
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
        success: function(msg) {
          alert("Salary Updated!");
          window.location.replace("index.php");
        }
      });
    }
  });
  $("#tblsearch").keyup(function() {
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
    $("#Display tr").each(function() {
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
  $("#btn1").click(function() {
    function checkAvai() {
      jQuery.ajax({
        url: "AddQuestion.php",
        data: "question=" + $("#question").val(),
        type: "POST",
        success: function(data) {}
      });
    }
    var a = document.getElementById("question").value;
    var b = document.getElementById("answer").value;
    if (a != "" && b != "") {
      alert("Data Saved Successfully");
    }
  });

  $("#faqsubmit").click(function() {
    function checkAvai() {
      jQuery.ajax({
        url: "faq.php",
        data: "faqinputtext=" + $("#faqinputtext").val(),
        type: "POST",
        success: function(data) {}
      });
    }
    var a = document.getElementById("faqinputtext").value;
    var b = document.getElementById("faqtextarea").value;
    if (a != "" && b != "") {
      alert("Message Sent Successfully");
    }
  });

  var arr = [];
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
  });

  $("#submitbtn").click(function() {
    if (
      (document.getElementById("rdbtn1").checked ||
        document.getElementById("rdbtn2").checked) &&
      (document.getElementById("rdbtn3").checked ||
        document.getElementById("rdbtn4").checked) &&
      arr != "" &&
      Boolean(counter)
    ) {
      alert("your request has been placed Successfully");
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
    jQuery.ajax({
      method: "POST",
      url: "lettertypes.php",
      data: { arr: arr, salary: salary, priority: priority },

      success: function(data2) {}
    });
  });
  $("#searched").keyup(function() {
    var page = $("#faqdiv");
    var pageText = page
      .text()
      .replace("<span>", "")
      .replace("</span>");
    var searchedText = $("#searched").val();
    var theRegEx = new RegExp("(" + searchedText + ")", "igm");
    var newHtml = pageText.replace(theRegEx, "<span>$1</span>");
    page.html(newHtml);
  });
  $(document).on("click", "#EditFAQ", function(event) {
    var row = $(this).closest("tr");
    var rowIndex = row.index();
    var Q = $("#Display")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(3)");
    Q.closest("div");
    Q.attr("contenteditable", "true");
    var A = $("#Display")
      .find("tr:eq(" + rowIndex + ")")
      .find("td:eq(4)");
    A.closest("div");
    A.attr("contenteditable", "true");
    A.addClass("input");
  });
});
