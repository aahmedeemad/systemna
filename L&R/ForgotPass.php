<?php
include "../DB/Database.php";

function generateRandomString($length) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

$NewPass = generateRandomString(10);

if(isset($_POST['Reset']))
{
  $DataBase = new Database();
  $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
  $sql = " SELECT id FROM employee WHERE email = '$mail' ";
  $DataBase->query($sql);
  $DataBase->execute();
  $User_id = $DataBase->getdata();
  if($DataBase->numRows() > 0)
  {
    $sql2 = " UPDATE employee SET password = '" . sha1($NewPass). "' WHERE email = '$mail' ";
    $DataBase->query($sql2);
    $DataBase->execute();
  }
  else
  {
    echo "<script>alert('This email is invaild !');</script>";
  }
}
?>
<head>
  <title>Reset Your Password</title>
  <link rel="stylesheet" href="../css/ForgotPass-style.css">
  <link rel="stylesheet" href="../css/all.min.css">
  <script src="../js/jquery-3.4.1.min.js"></script>
</head>
<body>
  <script>
    function resetpass(){
      var mail = document.getElementById('forgotpassmail').value;
      var name = '';
      var newpass = document.getElementById('newpasshidden').value;
      var mailsubject = 'Your new password';
      var mailcontent = 'Your new Password is ' + newpass + ' You can change your password from your profile';
      jQuery.ajax({
        type: 'POST',
        url: '../operations/massmsging.php',
        data: 'email=' + mail + '&name=' + name + '&mailsubject='+ mailsubject + '&mailcontent=' + mailcontent + '&type=newusermail',
        success: function (data) {
        }
      }); 
    }
  </script>
  <div id="popup1" class="overlay">
    <div class="popup" id='popup'>
      <h2>Temprory Password</h2>
      <a class="close" href="">&times;</a>
      <div class="content">
        An email will been sent to you with your new password then you can change it from your profile.
      </div>
    </div>
  </div>
  <div class="align">
    <div class="card" id="card">
      <form method="POST" action="ForgotPass.php">
        <div class="inputs">
          <h1 class="heading">Forgot Your Password ?</h1>
          <div class="input">
            <i class="fas fa-envelope-open"></i>
            <input placeholder="Email" id="forgotpassmail" type="text" name="mail" style="margin-left:20px">
          </div>
        </div>
        <input type="text" name="newpasshidden" id="newpasshidden" hidden value="<?php echo ($NewPass) ?>">
        <input type="submit" class="button" name="Reset" value="Reset" onclick="resetpass()">
      </form>
    </div>
  </div>
</body>