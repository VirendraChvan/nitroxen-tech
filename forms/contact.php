<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Ensure PHPMailer is installed via composer

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'Contact Form Submission';
    $message = $_POST['message'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'chavanvirendra11@gmail.com'; // Sender Gmail
        $mail->Password   = 'jwyk ncgo jrwb qphq'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('chavanvirendra11@gmail.com', 'Website Contact Form');
        $mail->addAddress('pviruc678@gmail.com'); // Receiver email

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        $mail->AltBody = "Name: {$name}\nEmail: {$email}\nMessage:\n{$message}";

        $mail->send();
        echo 'Message has been sent successfully!';
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
