<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Path to Composer autoload

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subscriberEmail = $_POST['email'] ?? '';

    if (filter_var($subscriberEmail, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';  // SMTP server (use SendGrid if on Render)
            $mail->SMTPAuth   = true;
            $mail->Username   = 'chavanvirendra11@gmail.com';  // Your sender email
            $mail->Password   = 'jwyk ncgo jrwb qphq';  // ⚠️
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Email content
            $mail->setFrom('chavanvirendra11@gmail.com', 'Newsletter Bot');
            $mail->addAddress('pviruc678@gmail.com'); // Receiver email (you)
            
            $mail->isHTML(true);
            $mail->Subject = "New Newsletter Subscription";
            $mail->Body    = "A new user has subscribed: <strong>{$subscriberEmail}</strong>";
            $mail->AltBody = "A new user has subscribed: {$subscriberEmail}";

            $mail->send();
            echo "success"; // AJAX expects this
        } catch (Exception $e) {
            echo "error: {$mail->ErrorInfo}";
        }
    } else {
        echo "invalid";
    }
} else {
    echo "forbidden";
}
?>
