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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Your Password</title>
    <link rel="stylesheet" href="../css/ForgotPass-style.css">
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
          <form>
              <div class="inputs">
                  <h1 class="heading">Forgot Your Password ?</h1>
                <div class="input">
                  <input placeholder="Email" type="text">
                  <img src="img/blackmail.svg">
                </div>
</div>
              <a class="button" href="#popup1">Reset</a>
            </form>
            <ul>
      <li>
        <span>Dark</span>
        <span>Light</span>
      </li>
    </ul>
    </div>
</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script>
  $(document).ready(function(){
    $('ul').click(function(){
      $('ul').toggleClass('active')
      $('.card').toggleClass('Light')
      $('.button').toggleClass('Light')
      $('input').toggleClass('Light')
    })
  })
</script>
</html>