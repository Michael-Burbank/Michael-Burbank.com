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

    // Enable verbose debug output
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;      
    
    // Set mailer to use SMTP
    $mail->isSMTP();             
    
    // Specify main and backup SMTP servers
    $mail->Host       = 'localhost';     
    // Enable SMTP authentication              
    $mail->SMTPAuth   = false;                    
    // SMTP username               
    $mail->Username   = 'admin@michael-burbank.com';     
    // SMTP password       
    $mail->Password   = $_ENV['SMTP_PASSWORD'];     
    // Enable TLS encryption, `tls` also accepted                       
    $mail->SMTPSecure = false;        
    // TCP port to connect to
    $mail->Port       = 587;                                    

    // Recipients

    // Add a recipient
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($receiving_email_address);                

    // Content

    // Set email format to HTML
    $mail->isHTML(true);                                        
    $mail->Subject = $subject;
    // Convert newlines to <br> tags for HTML
    $mail->Body    = nl2br($message);           
    // Plain text version for non-HTML mail clients                
    $mail->AltBody = strip_tags($message);                      
    $mail->send();
    echo '<div style="background-color: green; color: white; padding: 10px;">Message has been sent</div>';

} catch (Exception $e) {
    echo 'Message could not be sent. ';
}
// } catch (Exception $e) {
//     echo 'Message could not be sent.';
// }
