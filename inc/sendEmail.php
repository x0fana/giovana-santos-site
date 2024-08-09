<?php

// Replace this with your own email address
$siteOwnersEmail = 'xofanart@hotmail.com';


if($_POST) {

   $name = trim(stripslashes($_POST['contactName']));
   $email = trim(stripslashes($_POST['contactEmail']));
   $subject = trim(stripslashes($_POST['contactSubject']));
   $contact_message = trim(stripslashes($_POST['contactMessage']));

   // Check Name
	if (strlen($name) < 2) {
		$error['name'] = "Por favor, preencha com seu nome.";
	}
	// Check Email
	if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
		$error['email'] = "Por favor, preencha com um e-mail válido.";
	}
	// Check Message
	if (strlen($contact_message) < 15) {
		$error['message'] = "Escreva sua mensagem. Deve ter pelo menos 15 caracteres.";
	}
   // Subject
	if ($subject == '') { $subject = "Envio de formulário de contato"; }


   // Set Message
   $message .= "Enviado por: " . $name . "<br />";
	$message .= "E-mail: " . $email . "<br />";
   $message .= "Menssagem: <br />";
   $message .= $contact_message;
   $message .= "<br /> ----- <br /> Este e-mail foi enviado do formulário de contato do seu site. <br />";

   // Set From: header
   $from =  $name . " <" . $email . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


   if (!$error) {

      ini_set("sendmail_from", $siteOwnersEmail); // for windows server
      $mail = mail($siteOwnersEmail, $subject, $message, $headers);

		if ($mail) { echo "OK"; }
      else { echo "Algo deu errado. Por favor, tente novamente."; }
		
	} # end if - no validation error

	else {

		$response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
		$response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
		$response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;
		
		echo $response;

	} # end if - there was a validation error

}

?>