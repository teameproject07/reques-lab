<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

function send_mail($recipient, $subject, $message)
{
    $mail = new PHPMailer();

    // Set up SMTP
    $mail->isSMTP();
    $mail->SMTPDebug = 0;  // Disable debug output to avoid header issues
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Host = 'smtp.gmail.com';

    // Email account credentials
    $mail->Username = 'langch4444@gmail.com';
    $mail->Password = 'hoph fdff cnlw czxb'; // Use environment variables or a safer method to store sensitive info

    // Email settings
    $mail->isHTML(true);
    $mail->setFrom('langch4444@gmail.com', 'My Website');
    $mail->addAddress($recipient, 'Esteemed Customer');
    $mail->Subject = $subject;
    $mail->Body = $message;

    try {
        // Attempt to send the email
        if ($mail->send()) {
            return true;
        } else {
            error_log("Email sending failed: " . $mail->ErrorInfo); // Log error for debugging
            return false;
        }
    } catch (Exception $e) {
        error_log("Exception occurred while sending email: " . $e->getMessage()); // Log exception for debugging
        return false;
    }
}
?>

