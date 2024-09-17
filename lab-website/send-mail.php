<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If using Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = 'langch4444@gmail.com';           // Your Gmail address
        $mail->Password   = 'hoph fdff cnlw czxb';            // Your Gmail password (use app-specific password)
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                              // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);                        // Sender's email and name
        $mail->addAddress('langch4444@gmail.com', 'Admin');   // Add the admin's email

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "<h3>Message from $name ($email)</h3><p>$message</p>";
        $mail->AltBody = "Message from $name ($email): $message"; // Plain text version

        $mail->send();
        // Redirect to Contact.html with success query param
        header('Location: Contact.html?success=true');
        exit();
    } catch (Exception $e) {
        // Redirect to Contact.html with error query param
        header('Location: Contact.html?success=false');
        exit();
    }
} else {
    echo 'Invalid request method.';
}
?>
