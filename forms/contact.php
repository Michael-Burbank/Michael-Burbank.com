<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$receiving_email_address = 'burbank536@gmail.com';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'burbank536@gmail.com'; // Your Gmail address
    $mail->Password   = 'yxbxfrzotwvnrpsx'; // Your Gmail app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Recipients
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress($receiving_email_address);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['message'];
    $mail->AltBody = strip_tags($_POST['message']);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


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