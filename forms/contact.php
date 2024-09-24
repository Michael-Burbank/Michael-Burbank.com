<?php
  // Ensure the PHP_Email_Form class is included
  if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
  } else {
    die('Unable to load the "PHP Email Form" Library!');
  }

  // Create a new instance of the PHP_Email_Form class
  $contact = new PHP_Email_Form;

  // Set the recipient email address
  $contact->to = 'mike.w.burbank@gmail.com';

  // Set the sender's name and email address
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];

  // Set the email subject
  $contact->subject = $_POST['subject'];

  // Add the message content
  $contact->add_message($_POST['name'], 'From');
  $contact->add_message($_POST['email'], 'Email');
  $contact->add_message($_POST['message'], 'Message', 10);

  // Send the email and output the result
  echo $contact->send();
?>