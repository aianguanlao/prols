<?php
	include_once "Swift-5.1.0\lib\swift_required.php";

	$subject = 'Hello from Mandrill, PHP!';
	$from = array('aian@prols.local' =>'Your Name');
	$to = array(
	 'christian.guanlao@searchoptmedia.com'  => 'Recipient1 Name',
	);

	$text = "Mandrill speaks plaintext";
	$html = "<em>Mandrill speaks <strong>HTML</strong></em>";

	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl');
	$transport->setUsername('christian.guanlao@searchoptmedia.com');
	$transport->setPassword("silveravalanche");
	$swift = Swift_Mailer::newInstance($transport);

	$message = new Swift_Message($subject);
	$message->setFrom($from);
	$message->setBody($html, 'text/html');
	$message->setTo($to);
	$message->addPart($text, 'text/plain');

	if ($recipients = $swift->send($message, $failures))
	{
	 echo 'Message successfully sent!';
	} else {
	 echo "There was an error:\n";
	 print_r($failures);
	}
?>