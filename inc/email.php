<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
require ("PHPMailer-master/src/Exception.php");

if($_POST) {

        $name = trim(stripslashes($_POST['contactName']));
        $email = trim(stripslashes($_POST['contactEmail']));
        $subject = trim(stripslashes($_POST['contactSubject']));
        $contact_message = trim(stripslashes($_POST['contactMessage']));
    
        
        $error = array();

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
     

        if( count($error) == 0 ){
     
            // Set Message
            
            $message = "Enviado por: " . $name . "<br />";
            $message .= "E-mail: " . $email . "<br />";
            $message .= "Menssagem: <br />";
            $message .= $contact_message;
            $message .= "<br /> ----- <br /> Este e-mail foi enviado do formulário de contato do seu site. <br />";

            
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->isSMTP(); // Não modifique
            $mail->Host       = 'mail.josimar.net';  // SEU HOST (HOSPEDAGEM)
            $mail->SMTPAuth   = true;                        // Manter em true
            $mail->Username   = 'giovana@josimar.net';   //SEU USUÁRIO DE EMAIL
            $mail->Password   = 'xQ3&fem7nDEs';                   //SUA SENHA DO EMAIL SMTP password
            $mail->SMTPSecure = 'ssl';    //TLS OU SSL-VERIFICAR COM A HOSPEDAGEM
            $mail->Port       = 465;     //TCP PORT, VERIFICAR COM A HOSPEDAGEM
            $mail->CharSet = 'UTF-8';    //DEFINE O CHARSET UTILIZADO
            
            //Recipients
            $mail->setFrom('giovana@josimar.net', 'Giovana');  //DEVE SER O MESMO EMAIL DO USERNAME
            $mail->addAddress('xofanart@hotmail.com');     // QUAL EMAIL RECEBERÁ A MENSAGEM!
            // $mail->addAddress('ellen@example.com');    // VOCÊ pode incluir quantos receptores quiser
            $mail->addReplyTo($email, $name);  //AQUI SERA O EMAIL PARA O QUAL SERA RESPONDIDO                  
            // $mail->addCC('cc@example.com'); //ADICIONANDO CC
            // $mail->addBCC('bcc@example.com'); //ADICIONANDO BCC

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Mensagem do Formulário'; //ASSUNTO
            $mail->Body    = $message;  //CORPO DA MENSAGEM
            $mail->AltBody = $message;  //CORPO DA MENSAGEM EM FORMA ALT

            // $mail->send();
            if(!$mail->Send()) {
                //echo "<script>alert('Erro ao enviar o E-Mail');window.location.assign('index.php');</script>";
                echo "Houve um problema ao enviar sua mensagem";
             }else{
                //echo "<script>alert('E-Mail enviado com sucesso!');window.location.assign('index.php');</script>";
                echo "OK";
             }
        }else{
                
                echo "<ul>";
                    foreach($error as $erro){
                        echo "<li> $erro </li>"; 
                    }
                echo "</ul>";
        }


         


}else{
    echo "deu erro filho da puta!";
}





    


    
