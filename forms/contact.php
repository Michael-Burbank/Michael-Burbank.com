<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dotenv\Dotenv;

require '../vendor/autoload.php';
// Load environment variables from hashed_smtp_password.env file
try {
    $dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
} catch (Exception $e) {
    // Handle the exception or log it
    error_log('Could not load .env file: ' . $e->getMessage());
}
$receiving_email_address = $_ENV['RECEIVING_EMAIL_ADDRESS'];

// Sanitize and validate input data
$from_name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
$from_email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
$subject = isset($_POST['subject']) ? filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
$message = isset($_POST['message']) ? filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';

// Validate required fields
if (empty($from_name) || empty($from_email) || empty($subject) || empty($message)) {
    echo 'All fields are required.';
    exit;
}

// Validate email address
if (!filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email address.';
    exit;
}

$mail = new PHPMailer(true);
try {
    // Server settings

    // Enable verbose debug output
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->SMTPDebug = false;
    
    // Set mailer to use SMTP
    $mail->isSMTP();             
    
    // Specify main and backup SMTP servers
    $mail->Host       = $_ENV['HOSTNAME'];    
    // Enable SMTP authentication              
    $mail->SMTPAuth   = $_ENV['SMTP_AUTH'];                    
    // SMTP username               
    $mail->Username   = $_ENV['USERNAME'];     
    // SMTP password       
    $mail->Password   = $_ENV['SMTP_PASSWORD'];     
    // Enable TLS encryption, `tls` also accepted                       
    $mail->SMTPSecure = $_ENV['SMTPSecure'];  
    // TCP port to connect to
    $mail->Port = $_ENV['Port'];         

    // Recipients
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($receiving_email_address);             // Add a recipient

    // $mail->SMTPOptions = array(
    //     'ssl' => array(
    //     'verify_peer' => false,
    //     'verify_peer_name' => false,
    //     'allow_self_signed' => true,
    //     ),
    // );

    // Content
    $mail->isHTML(true);                                     // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = nl2br($message);                        // Convert newlines to <br> tags for HTML
    $mail->AltBody = strip_tags($message);                   // Plain text version for non-HTML mail clients

    // Send the email and check for success
    if ($mail->send()) {
        echo '<div style="background-color: green; color: white; padding: 10px;">Message has been sent</div>';
    } 
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' + $mail->ErrorInfo;
}
