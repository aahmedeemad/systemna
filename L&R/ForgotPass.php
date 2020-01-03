<head>
  <title>Reset Your Password</title>
  <link rel="stylesheet" href="../css/ForgotPass-style.css">
  <link rel="stylesheet" href="../css/all.min.css">
  <script src="../js/jquery-3.4.1.min.js"></script>
</head>
<body>
  <div id="popup1" class="overlay">
    <div class="popup" id='popup'>
      <h2>Password Reset</h2>
      <a class="close" href="">&times;</a>
      <div class="content">
        An email will been sent to you with your new password then you can change it from your profile.
      </div>
    </div>
  </div>
  <div class="align">
    <div class="card" id="card">
      <form method="POST">
        <div class="inputs">
          <h1 class="heading">Forgot Your Password ?</h1>
          <div class="input">
            <i class="fas fa-envelope-open"></i>
            <input placeholder="Email" id="forgotpassmail" type="text" name="mail" style="margin-left:20px">
          </div>
        </div>
        <input type="button" class="button" id="Reset" name="Reset" value="Reset">
      </form>
    </div>
  </div>
</body>
<script src="../js/forgotpassjs.js"></script>