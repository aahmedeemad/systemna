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
                            <span style="color:red; font-size:20px; font-weight:bold; position:relative; bottom:15px;" ><?php if(!empty( $_REQUEST['Message'])){echo $_REQUEST['Message'];} ?></span>
                            <div class="input">
                                <input required placeholder="Username" name="Username" type="text">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="input">
                                <input required placeholder="Password" name="Password" type="password">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <label>
                            <p style="color: #DAA520;"><input type="checkbox" name="remember_me" id="remember_me" style="left: 100px;"> Remember Me</p></label>
                        <a href="L&R/ForgotPass.php" class="FP" name='FP'>Forgot your password ?</a>
                        <button>Login</button>
                    </form>
                </div>
                <div class="Signuptab" id="Signuptab" style=" display: none;">
                    <form action="L&R/signup.php"  method="post">
                        <div class="inputs">
                            <span style="  color:red;" id="error"></span>
                            <h1 class="heading">Join us !</h1>
                            <div class="input">
                                <input  required onblur="validateFName(this)" name="fullname" id="fullname" placeholder="Full Name" type="text">
                                <i class="fas fa-user"></i>
                            </div>
                            <span style="color:red; display:block; margin-bottom:20px;" id="name"></span>
                            <div class="input">
                                <input required onblur="checkmail()" id="Email" name="Email" placeholder="E-mail" type="text">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span style=" color:red; display:block; margin-bottom:20px;" id="mail"></span>
                            <div class="input">
                                <input  onblur="checkuserr()" id="UserNamee" name="username" placeholder="User Name" type="text">
                                <i class="fas fa-user-circle"></i>
                            </div>  
                            <span style=" color:red; display:block; margin-bottom:20px;" id="username"> </span>
                            <div class="input">
                                <input  onblur="validateNumber(this)" required  name="phone" placeholder="Telephone Number" type="text">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <span style="color:red; display:block; margin-bottom:20px;" id="number"></span>
                            <div class="input">
                                <input onblur="checkssn()" id="SSN" required placeholder="Social Security Number" name="ssn"  type="text">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <span style=" color:red; display:block; margin-bottom:20px;" id="ssn"></span>
                            <div class="input">
                                <input onblur="validatepassword(this)" required placeholder="Password"  name="password" type="password">
                                <i class="fas fa-lock"></i>
                            </div>
                            <span style="color:red; display:block; margin-bottom:20px;" id="password"></span>
                        </div>
                        <input class ="submit" id="newusersubmit" type="submit" onclick="return check();"  value="Register">
                    </form>
                </div>
            </div>
        </div>