<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer's autoloader
require 'vendor/autoload.php';

// Initialize response array
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form fields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $messageBody = $_POST['message'];

    // Email details
    $to = "sherabten098@gmail.com";
    $subject = "New message from $name";
    $body = "Name: $name\nEmail: $email\n\n$messageBody";

    // Send email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'sherabten098@gmail.com';               // SMTP username
        $mail->Password   = 'gpffkvbrkbuadxcg';                     // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress($to);                                     // Add a recipient

        // Content
        $mail->isHTML(false);                                       // Set email format to plain text
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();

        // Set success response
        $response['status'] = 'success';
    } catch (Exception $e) {
        // Set error response
        $response['status'] = 'error';
    }

    // Send JSON response
    echo json_encode($response);
}
?>
