<html>
    <head>
        <title>Welcome to SYSTEMNA</title> <!-- Setting the title -->
        <link rel="icon" href="template/logo.png"> <!-- Adding the tab icon -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login/Register</title>
        <link rel="stylesheet" href="css/Login_Register-style.css">
        <link rel="stylesheet" href="css/all.min.css">
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/registerValidate.js"></script>
        <style>
            .vertical {
                display: block;
                border-left: 0.5vw solid #DAA520;
                height: 99.5vh;
            }
            .horizontal {
                display: none;
                border-bottom: 1vw solid #DAA520;
                width: 99.5vw;
            }
            .login {
                padding: 0vw 5vw 0vw 5vw;
            }
            .paddingview {
                padding: 0vw 10vw 0vw 10vw;
            }
            table th {
                font-weight:normal;
            }
        @media screen and (max-width: 800px) {
            .vertical {
                display: none;
            }
            .horizontal {
                display: block;
                padding-top: 5em;
            }
            .login {
                padding: 2em 0em 5em 0em;
            }
            .paddingview {
                padding: 0em 2em 0em 2em;
            }
            table th {
                display: inline-block;
                font-weight:normal;
            }
        </style>
    </head>
    <body>
        <table style="width: 100%; text-align: center;">
            <tr>
                <th>
                    <div class="paddingview"> <!-- Adding the logo, mission & vision. -->
                        <img src="template/logo.png" alt="SYSTEMNA Logo" style="align:center; width: 200px; height:200px;">
                        <h1 style="font-size: 3em;">Welcome to <strong style="color: #DAA520">SYSTEM</strong><strong class="NA">NA</strong>!</h1>
                        <br><br><br>
                        <h2 style="text-decoration: underline; font-size: 2em;" class="Mission">-Mission-</h2>
                        <br>
                        <p style="font-size: 1.5em;" class="Mpara">Delivering HR papers in ease for both the employer and the HR staff, also aiming for greener environment reducing paperwork going towards a sustainable goal.</p>
                        <br><br>
                        <h2 style="text-decoration: underline; font-size: 2em;" class="Vision">-Vision-</h2>
                        <br>
                        <p style="font-size: 1.5em;" class="Vpara">Making the HR papers process easier and accessible for everyone and going toward a sustainable goal of reducing(and eliminating) paperwork in the company.</p>
                    </div>
                </th>
                <th><div class = "vertical"></div></th> <!-- Vertical line shown on large screens -->
                <th><div class = "horizontal"></div></th> <!-- Horizontal line shown on small screens -->
                <th><div class = "login"><?php include "L&R/Login_Register.php"; ?></div></th> <!-- Including the login form -->
            </tr>
        </table>
    </body>
    <script src="js/Login_Register-script.js"></script>
</html>
