<?php


?>


<?php
// // Enable error reporting for debugging
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require '../vendor/autoload.php';

// // Define the receiving email address
// $receiving_email_address = 'mike.w.burbank@gmail.com';

// // Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   // Validate form data
//   $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//   $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//   $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//   $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//   if ($name && $email && $subject && $message) {
//     $mail = new PHPMailer(true);

//     try {
//       // Server settings
//       $mail->isSMTP();
//       $mail->Host       = 'smtp.gmail.com';
//       $mail->SMTPAuth   = true;
//       $mail->Username   = 'mike.w.burbank@gmail.com'; // Your Gmail address
//       $mail->Password   = 'xjzgyuixmuvpsjwz'; // App Password via GMAIL Security
//       $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
//       $mail->Port = 465;

//       // Recipients
//       $mail->setFrom($email, $name);
//       $mail->addAddress($receiving_email_address);

//       // Content
//       $mail->isHTML(true);
//       $mail->Subject = $subject;
//       $mail->Body    = $message;
//       $mail->AltBody = strip_tags($message);

//       $mail->send();
//       echo 'Message has been sent';
//     } catch (Exception $e) {
//       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
//   } else {
//     echo 'Invalid form data. Please check your inputs.';
//   }
// } else {
//   echo 'Invalid request method.';
// }
?>

<?php
// Include Composer's autoload file
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Validate and sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$name = sanitize_input($_POST['name']);
$email = filter_var(sanitize_input($_POST['email']), FILTER_VALIDATE_EMAIL);
$subject = sanitize_input($_POST['subject']);
$message = sanitize_input($_POST['message']);

if (!$email) {
    echo 'Invalid email address.';
    exit;
}

$receiving_email_address = 'mike.w.burbank@gmail.com';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mike.w.burbank@gmail.com';
    $mail->Password = 'yxbxfrzotwvnrpsx';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress($receiving_email_address);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>