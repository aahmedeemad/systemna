<html>
    <head>
        <title>Welcome to SYSTEMNA</title>
        <link rel="icon" href="/template/logo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .vertical {
                display: block;
                border-left: 0.5vw solid black;
                height: 99.5vh;
            }
            .horizontal {
                display: none;
                border-bottom: 1vw solid black;
                width: 99.5vw;
            }
            .login {
                padding: 0vw 5vw 0vw 5vw;
            }
            .paddingview {
                padding: 0vw 10vw 0vw 10vw;
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
            table td {
                display: inline-block;
            }
        </style>
    </head>
    
    <body>
        <table style="width: 100%; text-align: center;">
            <tr>
                <td>
                    <div class="paddingview">
                        <img src="template/logo.png" alt="SYSTEMNA Logo" style="align:center; width: 200px; height:200px;">
                        <h1 style="font-size: 3em;">Welcome to <strong style="color: #DAA520">SYSTEM</strong><strong>NA</strong>!</h1>
                        <br><br><br>
                        <h2 style="text-decoration: underline; font-size: 2em;">-Mission-</h2>
                        <br>
                        <p style="font-size: 1.5em;">Delivering HR papers in ease for both the employer and the HR staff, also aiming for greener environment reducing paperwork going towards a sustainable goal.</p>
                        <br><br>
                        <h2 style="text-decoration: underline; font-size: 2em;">-Vision-</h2>
                        <br>
                        <p style="font-size: 1.5em;">Making the HR papers process easier and accessible for everyone and going toward a sustainable goal of reducing(and eliminating) paperwork in the company.</p>
                    </div>
                </td>
                <td><div class = "vertical"></div></td>
                <td><div class = "horizontal"></div></td>
                <td><div class = "login"><?php include "L&R/Login_Register.php"; ?></div></td>
            </tr>
        </table>
    </body>
</html>
