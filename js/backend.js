$(document).ready(function() {
  $(".navbar-toggle").on("click", function() {
    $(".sidenav").animate({ width: "toggle" }, 350);
  });

  function fullnameToggle() {
    $("#fullname").toggleClass("hidden");

    $(".input-fullname").toggleClass("hidden");
    $(".save-fullname").toggleClass("hidden");
    $(".cancel-fullname").toggleClass("hidden");
    //        $('.profile-left').toggle();
    //        $('.profile-right').toggle();
    //        $('.edit-profile').toggle();
  }

  function basicInfoToggle() {
    $("#ssn").toggleClass("hidden");
    $("#birthdate").toggleClass("hidden");
    $("#location").toggleClass("hidden");

    $(".input-basic-info").toggleClass("hidden");
    $(".save-basic-info").toggleClass("hidden");
    $(".cancel-basic-info").toggleClass("hidden");
    //        $('.profile-left').toggle();
    //        $('.profile-right').toggle();
    //        $('.edit-profile').toggle();
  }

  function contactInfoToggle() {
    $("#mail").toggle();
    $("#phone").toggle();

    $(".input-contact-info").toggle();

    $(".save-contact-info").toggle();
    $(".cancel-contact-info").toggle();
  }

  function companyInfoToggle() {
    $("#username").toggle();
    $("#password").toggle();

    $(".input-company-info").toggle();

    $(".save-company-info").toggle();
    $(".cancel-company-info").toggle();
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
      url: "editProfile.php",
      data: "id=" + id + "&fullname=" + fullname + "&type=fullname",
      success: function(html) {
        //                console.log(html);
        if (html == "true") {
          $(".profile-left").html(
            '<div class="alert alert-success"><strong>Message Sent!</strong></div>'
          );
        }
      },
      beforeSend: function() {
        //                $("#add_err2").html("loading...");
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
      url: "editProfile.php",
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
        //                console.log(html);
        if (html == "true") {
          $(".profile-left").html(
            '<div class="alert alert-success"><strong>Message Sent!</strong></div>'
          );
        }
      },
      beforeSend: function() {
        //                $("#add_err2").html("loading...");
      }
    });
  });

  $(".save-contact-info").on("click", function() {
    console.log("aaa");
    var email = $("#emailEdit").val();
    var phone = $("#phoneEdit").val();
    var id = $("#id").text();
    $.ajax({
      type: "POST",
      url: "editProfile.php",
      data:
        "id=" +
        id +
        "&email=" +
        email +
        "&phone=" +
        phone +
        "&type=contact-info",
      success: function(html) {
        console.log(html);
        if (html == "true") {
          $(".profile-right-up").html(
            '<div class="alert alert-success"><strong>Message Sent!</strong></div>'
          );
        }
      },
      beforeSend: function() {
        //                $("#add_err2").html("loading...");
      }
    });
  });
  $(".save-company-info").on("click", function() {
    console.log("aaaa");
    var uname = $("#usernameEdit").val();
    var pass = $("#passwordEdit").val();
    var id = $("#id").text();
    $.ajax({
      type: "POST",
      url: "editProfile.php",
      data:
        "id=" + id + "&uname=" + uname + "&pass=" + pass + "&type=company-info",
      success: function(html) {
        console.log(html);
        if (html == "true") {
          $(".profile-right-down").html(
            '<div class="alert alert-success"><strong>Message Sent!</strong></div>'
          );
        }
      },
      beforeSend: function() {
        //                $("#add_err2").html("loading...");
      }
    });
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
    } else {
      $.ajax({
        method: "POST",
        url: "operations/EditTable.php",
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
  });
});
