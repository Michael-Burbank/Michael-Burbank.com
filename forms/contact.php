<?php
  /**
  * Requires the "PHP Email Form" library
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

// TODO!: Use below for Contact.php Inquiry Web Form. 
//TODO!: Implement Google restAPI / GMAIL SMTP?
  $receiving_email_address = '#';

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


// TODO!: Finish setting up SMTP prot. requirements for GMAIL PHP Web Contact form. 

// TODO!: Implement Google API => Mail - Contact.php Web form - Inquiry => GMAIL

// TODO!: SMTP to send emails. Enter correct SMTP credentials
  $contact->smtp = array(
    'host' => 'smtp.gmail.com', // TODO: <= SMTP
    'username' => 'example',   // TODO: <= Email add.
    'password' => 'pass',     // TODO: <= Email pass.
    'port' => '587'          // TODO: <= Default Port #.
  );
  

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>
