<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$mail = new PHPMailer(true);

try {

	//Recipients
	$mail->setFrom('orders@lightsabershop.com', 'Lightsaber Shop');
	$mail->addAddress($_POST['email'], $_POST['name']);
	$mail->addReplyTo('orders@lightsabershop.com', 'Lightsaber Shop');
	$mail->addCC('damian_makkink@outlook.com');

	// Content
	$mail->isHTML(true);
	$mail->Subject = 'Thank you for your order!';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';

	$mail->send();
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}