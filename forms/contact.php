<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Define the receiving email address
$receiving_email_address = 'burbank536@gmail.com';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    if ($name && $email && $subject && $message) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'burbank536@gmail.com'; // Your Gmail address
            $mail->Password   = 'yxbxfrzotwvnrpsx'; // Your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress($receiving_email_address);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = strip_tags($message);

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Invalid form data. Please check your inputs.';
    }
} else {
    echo 'Invalid request method.';
}
?>

<?php
/**
 * Requires the "PHP Email Form" library
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// $receiving_email_address = 'mike.w.burbank@gmail.com';

// if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
//   include($php_email_form);
// } else {
//   die('Unable to load the "PHP Email Form" Library!');
// }

// $contact = new PHP_Email_Form;
// $contact->ajax = true;

// $contact->to = $receiving_email_address;
// $contact->from_name = $_POST['name'];
// $contact->from_email = $_POST['email'];
// $contact->subject = $_POST['subject'];


// TODO!: Finish setting up SMTP prot. requirements for GMAIL PHP Web Contact form. 

// TODO!: Implement Google API => Mail - Contact.php Web form - Inquiry => GMAIL

// TODO!: SMTP to send emails. Enter correct SMTP credentials
// $contact->smtp = array(
//   'host' => 'smtp.gmail.com', 
//   'username' => 'burbank536@gmail.com',   
//   'password' => 'yxbxfrzotwvnrpsx',     
//   'port' => '465',
//   'encryption' => 'ssl'
// );


// $contact->add_message($_POST['name'], 'From');
// $contact->add_message($_POST['email'], 'Email');
// $contact->add_message($_POST['message'], 'Message', 10);

// echo $contact->send();

?>