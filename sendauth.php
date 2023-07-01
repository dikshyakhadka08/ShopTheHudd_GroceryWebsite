<?php
require('connection.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$authCodes = array(
    "12345", "98765", "54321", "67890", "01234", "56789", "43210", "87654", "21098", "34567",
    "90123", "45678", "89012", "34567", "67890", "12345", "56789", "01234", "45678", "89012",
    "23456", "78901", "32109", "76543", "09876", "54321", "98765", "43210", "87654", "21098",
    "65432", "10987", "76543", "21098", "09876", "54321", "98765", "43210", "87654", "32109",
    "56789", "01234", "45678", "90123", "34567", "89012", "23456", "78901", "12345", "67890",
    "11111", "22222", "33333", "44444", "55555", "66666", "77777", "88888", "99999", "00000",
    // Add more values manually here
    "24680", "13579", "86420", "97531", "74103", "58246", "69357", "40718", "82963", "51479",
    "12312", "45645", "78978", "10101", "13131", "40404", "92929", "78787", "57575", "18181",
    "24681", "13579", "86421", "97531", "74103", "58246", "69357", "40718", "82963", "51479",
    "12313", "45646", "78979", "10102", "13132", "40405", "92930", "78788", "57576", "18182",
    // ... and so on
  );
  for ($i = 0; $i < 150; $i++) {
    $authCode = "";
    for ($j = 0; $j < 5; $j++) {
      $digit = mt_rand(0, 9);
      $authCode .= $digit;
    }
    $authCodes[] = $authCode;
  }
$codes =[142223,32111,123743,561111,456111,987000,123670,653232];
$valkey = array_rand($codes);
$val = $codes[$valkey];

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'dikshya080@outlook.com';                     //SMTP username
    $mail->Password   = 'fxjsslcnfvlcrbzx';    
                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->Port = 587;                    //SMTP port
    $mail->SMTPSecure = "tls";
    //Recipients
    $mail->setFrom('dikshya080@outlook.com', 'Administrator');
    $mail->addAddress($_SESSION['emailtosend'], 'User, ');   
    //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the mail for email verification';
    $mail->Body    = '<br>The code for authentication is: ' . $val;
    $mail->AltBody = '';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

echo '<script>window.location.href = "login.php"</script>';


?>