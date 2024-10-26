<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dotenv\Dotenv;

// require '/home/o56n6o9odjy1/public_html/vendor/autoload.php';
require '../vendor/autoload.php';
// Load environment variables from hashed_smtp_password.env file
$dotenv = Dotenv::createImmutable(__DIR__, 'hashed_smtp_password.env');
$dotenv->load();

$receiving_email_address = 'admin@michael-burbank.com';

// Sanitize input data
$from_name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
$from_email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
$subject = isset($_POST['subject']) ? filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
$message = isset($_POST['message']) ? filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';

// Validate email address
if (!filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email address.');
}
$config['protocol'] = "mail";
$config['smtp_port'] = 587;

$mail = new PHPMailer(true);

try {
    // Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'localhost';                   // Specify main and backup SMTP servers
    $mail->SMTPAuth   = false;                                   // Enable SMTP authentication
    $mail->Username   = 'admin@michael-burbank.com';            // SMTP username
    $mail->Password   = $_ENV['SMTP_PASSWORD'];                            // SMTP password
    $mail->SMTPSecure = false;        // Enable TLS encryption, `tls` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($receiving_email_address);                // Add a recipient

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = nl2br($message);                           // Convert newlines to <br> tags for HTML
    $mail->AltBody = strip_tags($message);                      // Plain text version for non-HTML mail clients

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. \n Please try again later.';
}
