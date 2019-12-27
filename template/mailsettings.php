<?php

use PHPMailer\PHPMailer\PHPMailer; /* Namespace alias. */
use PHPMailer\PHPMailer\Exception; /* Namespace alias. */
require '../composer/vendor/autoload.php'; /* Include the Composer generated autoload.php file. */
date_default_timezone_set('Etc/UTC'); /* Set the script time zone to UTC. */
$mail = new PHPMailer(TRUE); /* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail->SMTPOptions = array('ssl'=>array('verify_peer'=>false, 'verify_peer_name'=>false, 'allow_self_signed'=>true));
$mail->isSMTP(); /* Use SMTP. */
$mail->Host = 'smtp.gmail.com'; /* Google (Gmail) SMTP server. */
$mail->Port = 587; /* SMTP port. */
$mail->SMTPAuth = true; /* Set authentication. */
$mail->SMTPSecure = 'tls'; /* Set authentication. */
$mail->Username = 'systemnamiu@gmail.com'; /* Username (email address). */
$mail->Password = 'tpwvzpocyggbhmlr'; /* Google account password. */

?>