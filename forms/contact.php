<?php
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

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include $php_email_form;
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';
$contact->from_email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
$contact->subject = isset($_POST['subject']) ? filter_var($_POST['subject'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : '';

$contact->smtp = [
    'host' => $_ENV['HOSTNAME'],
    'username' => $_ENV['USERNAME'],
    'password' => $_ENV['SMTP_PASSWORD'],
    'port' => $_ENV['Port'],
    'encryption' => $_ENV['SMTPSecure'],
    'auth' => $_ENV['SMTP_AUTH']
];

$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

echo $contact->send();