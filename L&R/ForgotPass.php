
<?php
  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
$NewPass = generateRandomString(6);
?>
<?php
  include "../DB/Database.php";
  if(isset($_POST['Reset']))
  {
    $DataBase = new Database();
    $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    $sql = "SELECT id FROM employee 
            WHERE email = '$mail';";
    $DataBase->query($sql);
    $DataBase->execute();
    $User_id = $DataBase->getdata();
 
    if($DataBase->numRows() > 0)
    {
      echo $User_id[0]->id;
    }
    else 
    {
      echo "<script>alert('This email is invaild !');</script>";
    }
   $sql2 = "UPDATE employee
            SET password ='$NewPass';";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Your Password</title>
    <link rel="stylesheet" href="../css/ForgotPass-style.css">
    <link rel="stylesheet" href="../css/all.min.css">
        <script src="../js/jquery-3.4.1.min.js"></script>
        <script src="../js/backend.js"></script>
    </head>
<body>
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
                  <input placeholder="Email" type="text" name="mail" style="margin-left:20px">
                </div>
</div>        
    <input type="text" name="idhidden"  id="idhidden" hidden value="<?php echo $User_id[0]->id?>">
    <input type="text" name="newpasshidden" id="newpasshidden" hidden value="<?php echo $NewPass ?>">
    <input type="text" name="messagehidden" id="messagehidden" hidden value="Temprory Password !">
              <input type="submit"class="button" id="Reset" name="Reset" value="Reset">
            </form>
    </div>
</body>
</html>