<?php

// require('connectsession.php');
// require 'phpmailer/src/Exception.php';
// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

set_time_limit(195);
$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp-mail.outlook.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'dikshya080@outlook.com';
    $mail->Password   = 'fxjsslcnfvlcrbzx';
    $mail->Port       = 587;
    $mail->SMTPSecure = 'tls';

    $_SESSION['payment'] = $_SESSION['totalAmount'];

    $mail->setFrom('dikshya080@outlook.com', 'Administrator');
    if (!$conn) {
        $error = oci_error();
        echo "Database connection failed: " . $error['message'];
        exit;
    }

    $query = "SELECT EMAIL FROM USERR WHERE ROLE = 'Trader'";
    $stmt = oci_parse($conn, $query);
    oci_execute($stmt);

    while ($row = oci_fetch_assoc($stmt)) {
        $invoicID = rand(0,10000);
        $email = $row['EMAIL'];
        $mail->addAddress($email, 'Trader');

        $mail->isHTML(true);
        $mail->Subject = 'Invoice';
        $mail->Body = '
        A customer has made a purchase. The generated invoice is as follows.<br>
        Please contact the administrator if you need a proper invoice.<br>
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
                <td style="border: 1px solid black; padding: 5px;">'.$invoiceID.'</td>
                <td style="border: 1px solid black; padding: 5px;">'.$_SESSION['payment'].'</td>
                <td style="border: 1px solid black; padding: 5px;">IT Service</td>
                <td style="border: 1px solid black; padding: 5px;">Jackie Robert</td>
            </tr>
        </table>
        <br>
        Your amount will be deposited in your account soon.
    ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent to '.$email.'<br>';
        }

        $mail->clearAddresses();
    }

    echo '<script>
       window.location.href = "customer-info.php";
      </script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
