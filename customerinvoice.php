<?php
require('connectsession.php');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
// require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;        // Enable verbose debug output
    $mail->isSMTP();                              // Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';  // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                     // Enable SMTP authentication
    $mail->Username   = 'dikshya080@outlook.com';  // SMTP username
    $mail->Password   = 'fxjsslcnfvlcrbzx';       // SMTP password
    $mail->Port       = 587;                      // SMTP port
    $mail->SMTPSecure = "tls";                     // Enable TLS encryption

//This is for checking only
    $_SESSION['payment'] = $_SESSION['totalAmount'];

$invoiceIiD = rand(0,10000);
    // Recipients
    $mail->setFrom('dikshya080@outlook.com', 'Administrator');
    $mail->addAddress($_SESSION['email'], 'User');   // Add customer email as recipient

    // Content
    $mail->isHTML(true);                          // Set email format to HTML
    $mail->Subject = 'Invoice';
    $mail->Body = '
    <h1>Invoice</h1>
    <p>Payment Details:</p>
    <table style="border-collapse: collapse;">
        <tr>
            <th style="border: 1px solid black; padding: 5px;">Invoice ID</th>
            <th style="border: 1px solid black; padding: 5px;">Amount</th>
            <th style="border: 1px solid black; padding: 5px;">Processed By</th>
            <th style="border: 1px solid black; padding: 5px;">Verified By</th>
        </tr>
        <tr>
            <td style="border: 1px solid black; padding: 5px;">'.$invoiceIiD.'</td>
            <td style="border: 1px solid black; padding: 5px;">'.$_SESSION['payment'].'</td>
            <td style="border: 1px solid black; padding: 5px;">IT Service</td>
            <td style="border: 1px solid black; padding: 5px;">Jackie Robert</td>
        </tr>
    </table>
    <br>
';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    require('traderinvoice.php');
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>