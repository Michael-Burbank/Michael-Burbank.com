<?php
  $receiving_email_address = 'admin@michael-burbank.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // SMTP server settings
  $contact->smtp = [
    'server' => 'localhost',
    'username' => 'admin@michael-burbank.com',
    'password' => 'Turn off', 
    'port' => '25', 
    'SMTP Authentication' => 'Turn off', 
    'SSL' => 'Turn off',
    'send mail from' => 'admin@michael-burbank.com'
  ];


  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
