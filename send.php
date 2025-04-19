<?php
// Manually include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Use the proper namespaces for PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure these fields are passed from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ranjitrautaray475@gmail.com';
        $mail->Password   = 'xeic ubof gibs euzo';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // ----- Email to the client -----
        $mail->setFrom('ranjitrautaray475@gmail.com', 'Contact Form');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Thank you for your submission!';
        $mail->Body    = "Hello $name,<br><br>Thank you for Contacting me ! I will get back to you soon <br><br>Your Details:<br>Name: $name<br>Email: $email<br><br>We will get back to you shortly.";

        $mail->send();

        // ----- Email to the admin -----
        $mail->clearAddresses();
        $mail->addAddress('ranjitrautaray475@gmail.com', 'Ranjit Rautaray');

        $mail->isHTML(true);
        $mail->Subject = 'New Form Submission';
        $mail->Body    = "You have received a new form submission.<br><br>
                          <strong>Name:</strong> $name<br>
                          <strong>Email:</strong> $email<br>
                          <strong>Message:</strong><br>$message";

        $mail->send();

        echo 'Message has been sent to both client and admin!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
