<?php
  /**
  * Requires the "PHP Email Form" library
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

// TODO!: Use below for Contact.php Inquiry Web Form. 
//TODO!: Implement Google restAPI / GMAIL SMTP?

// TODO!: PHP Mailer to send emails. https://mailtrap.io/blog/phpmailer/
// TODO!: Mailgun SMTP https://try.mailgun.com/smtp-services/?utm_source=google&utm_medium=cpc&utm_campaign=NA%20%7C%20SMTP&utm_id=15620044732&utm_content=151447402754&utm_term=smtp%20php&gad_source=1&gclid=Cj0KCQjwjNS3BhChARIsAOxBM6qgi6mvJF9Lyh9Jx-9Nl-UzxiJYWYMLjXMI3dRp7BEmOgPNtNCOpXQaAsVcEALw_wcB

// TODO!: symfony mailer php
//TODO!: https://gist.github.com/daveh/1164348fe21a6e7363d28c7b94c9eb3f
// TODO!: https://www.namecheap.com/support/knowledgebase/article.aspx/10038/31/how-to-configure-a-contact-form-with-us/#smtp


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
  // $contact->smtp = array(
  //   'host' => 'smtp.gmail.com', // TODO: <= SMTP
  //   'username' => 'burbank536@gmail.com',   // TODO: <= Email add.
  //   'password' => '#_ENTER WHEN_READY',     // TODO: <= Email pass.
  //   'port' => '587'          // TODO: <= Default Port #. SSL
  // );
  

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  echo $contact->send();
?>
