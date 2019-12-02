<?php

session_start();




?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login/Register</title>
        <link rel="stylesheet" href="css/Login_Register-style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="js/registerValidate.js"> </script>
    </head>
    <body>
        <div class="align">
            <div class="card" id="card">
                <div class="head">
                    <div></div>
                    <a id="login" class="selected">Login</a>
                    <a id="Register">Register</a>
                    <div></div>
                </div>
                <div class="Logintab" id="Logintab" style="display: block;">

                    <form action="L&R/login.php" method="post">
                        <div class="inputs">
                            <h1 class="heading">Welcome back !</h1>
                            <span style="color:red; font-weight:bold; position:relative; left:35px; bottom:15px;" ><?php if(isset($_SESSION['error1'])){echo $_SESSION['error1']; } ?></span>
                            <div class="input">
                                <input required placeholder="Username" name="Username" type="text">
                                <img src="L&R/imgs/user.svg">
                            </div>
                            <div class="input">
                                <input required placeholder="Password" name="Password" type="password">
                                <img src="L&R/imgs/pass.svg">
                            </div>
                        </div>
                        <label>

                            <input type="checkbox" name="remember_me" id="remember_me">
                            Remember Me</label>
                        <a href="L&R/ForgotPass.php" class="FP" name='FP'>Forgot your password ?</a>
                        <button>Login</button>
                    </form>
                </div>
                <div class="Signuptab" id="Signuptab" style=" display: none;">
                    <form action="L&R/signup.php"  method="post">
                        <div class="inputs">

                            <span style="  color:red;" id="error"><?php if(isset($_SESSION['error'])){echo $_SESSION['error']; } ?></span>
                            <h1 class="heading">Join us !</h1>
                            <div class="input">

                                <input  required onblur="validateFName(this)" name="fullname" id="fullname" placeholder="Full Name" type="text">
                                <img src="L&R/imgs/user.svg">
                                   
                            </div>
                                <span style="color:red; display:block; margin-bottom:20px;" id="name"></span>
                            <div class="input">
                                <input required onblur="validateEmail(this)" name="Email" placeholder="E-mail" type="text">
                                <img src="L&R/imgs/blackmail.svg">
                            </div>
                                <span style=" color:red; display:block; margin-bottom:20px;" id="mail"></span>
                            <div class="input">
                                <input onblur="validateUsername(this)"  name="username" placeholder="User Name" type="text">
                                <img src="L&R/imgs/user.svg">
                            </div>  
                                <span style=" color:red; display:block; margin-bottom:20px;" id="username"> </span>
                            <div class="input">
                                <input  onblur="validateNumber(this)" required  name="Telephone Number" placeholder="Telephone Number" type="text">
                                <img src="L&R/imgs/phone-call.svg">
                            </div>
                                <span style="color:red; display:block; margin-bottom:20px;" id="number"></span>
                            <div class="input">
                                <input onblur="validateSSN(this)" required placeholder="Social Security Number" name="ssn"  type="text">
                                <i class="fa fa-id-card-o" style="width: 16px; position: absolute; left: 19px;"></i>
                            </div>
                                <span style=" color:red; display:block; margin-bottom:20px;" id="ssn"></span>
                            <div class="input">
                                <input onblur="validatepassword(this)" required placeholder="Password"  name="password" type="password">
                                <img src="L&R/imgs/pass.svg">
                            </div>
                                <span style="color:red; display:block; margin-bottom:20px;" id="password"></span>
                            <div class="input">
                                <input  type="file" placeholder="Upload File">
                            </div>
                        </div>
                        <input class ="submit"  type="submit" onclick="return check();"  value="Register">
                    </form>
                </div>
                <ul>
                    <li>
                        <span>Dark</span>
                        <span>Light</span>
                    </li>
                </ul>
            </div>
        </div>
    </body>
   
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/Login_Register-script.js"></script>
    <?php
if(isset($_SESSION['error'])){ echo "<script>document.getElementById('Register').click();</script>"; }
?>

    <script>
        
        $(document).ready(function(){
            $('ul').click(function(){
                $('ul').toggleClass('active')
                $('.card').toggleClass('Light')
                $('button').toggleClass('Light')
                $('a').toggleClass('Light')
                $('.head').toggleClass('Light')
                $('.heading').toggleClass('Light')
                $('input').toggleClass('Light')
                $('label').toggleClass('Light')
            })
        })
    </script>
</html>
