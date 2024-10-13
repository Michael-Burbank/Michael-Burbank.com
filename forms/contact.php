<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

require '/home/o56n6o9odjy1/public_html/PHPMailer/src/Exception.php';
require '/home/o56n6o9odjy1/public_html/PHPMailer/src/PHPMailer.php';
require '/home/o56n6o9odjy1/public_html/PHPMailer/src/SMTP.php';
// Web/Michael-Burbank.com/PHPMailer
  $receiving_email_address = 'admin@michael-burbank.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include $php_email_form ;
  } else {
    die( 'Unable to load the "PHP Email Form" library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // SMTP server settings
  $contact->smtp = [
    'host' => 'localhost',
    'username' => 'admin@michael-burbank.com',
    'password' => 'P0wer623!', 
    'port' => '25', 
    'SMTP Authentication' => 'False', 
    // 'SMTPAutoTLS' => 'False',
    'SSL/TLS' => 'False',
    'Send mail from' => 'admin@michael-burbank.com'
  ];


  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
