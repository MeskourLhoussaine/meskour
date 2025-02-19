<?php
// Active l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Adresse email de réception
$receiving_email_address = 'meskour.lhoussaine642@gmail.com';

// Charge la bibliothèque PHP Email Form
if (file_exists($php_email_form = '../vendor/php-email-form/php-email-form.php')) {
  include($php_email_form);
} else {
  die('Unable to load the "PHP Email Form" Library!');
}

// Initialise la classe PHP_Email_Form
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Configure les destinataires et les informations du formulaire
$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Ajoute les messages du formulaire
$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Envoie l'email et renvoie une réponse JSON
if ($contact->send()) {
  echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
} else {
  echo json_encode(['success' => false, 'message' => 'Failed to send message.']);
}
?>