<?php

$from_name = htmlspecialchars($_POST['s'],ENT_QUOTES,'UTF-8');
$to = htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');
$contenido = htmlspecialchars($_POST['c'],ENT_QUOTES,'UTF-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/*try
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Host = 'mail.hielosanisidro.com';
        $mail->Port = 465;  
        $mail->Username = 'hielo@hielosanisidro.com';
        $mail->Password = 'hielosanisidro';   
   
   //   $path = 'reseller.pdf';
   //   $mail->AddAttachment($path);
   
        $mail->IsHTML(true);
        $mail->From="richardefio879@gmail.com";
        $mail->FromName=$from_name;
        $mail->Sender="richardefio879@gmail.com";
        $mail->addAddress('richardefio879@gmail.com', $from_name);
        //$mail->addAddress('johnny_1691@hotmail.com');     //opcional
        $mail->AddReplyTo("richardefio879@gmail.com", "Richard Efio Rivas");
        $mail->Subject = "Mensaje de Richard Efio Rivas";

        $mensaje = 'Hola <strong>'.$from_name.'</strong>,';
        $mensaje .='<p>Confirmamos tu mensaje con el siguiente detalle:</p>';
        $mensaje .=            '<p>---------------------------------</p>';
        $mensaje .=            '<p>'.utf8_decode($contenido).'</p>';
        $mensaje .=            '<p>---------------------------------</p>';
        $mensaje .=            '<p></p>';
        $mensaje .=            '<p><strong>Estaremos en contacto a la brevedad posible.</p></strong>';
        $mensaje .=            '<p>Atte. <strong>Ing. Richard Efio Rivas</p></strong>';

        //$mail->Body = 'Hola '.$from_name.'<p>'.$contenido.'</p>';
        $mail->Body = $mensaje;
        $mail->AltBody = $contenido;
        $mail->AddAddress($to);
        $mail->Send();
        echo 1;
} catch (Exception $e) {
        echo 0;
}*/

$sender = 'richardefio879@gmail.com';
$senderName = 'Richard Efio Rivas';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'richard879@hotmail.com';

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = 'AKIATXAQNIB4SUN5C5OA';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'BNvipKjXW+SLF5s8njw25mhtPom+6h6Gy4YOqJjjgr2a';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
//$configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'email-smtp.us-east-2.amazonaws.com';
$port = 587;

// The subject line of the email
$subject = 'Amazon SES test (SMTP interface accessed using PHP)';

// The plain-text body of the email
$bodyText =  "Email Test\r\nThis email was sent through the
    Amazon SES SMTP interface using the PHPMailer class.";

// The HTML-formatted body of the email
$bodyHtml = '<h1>Email Test</h1>
    <p>This email was sent through the
    <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
    interface using the <a href="https://github.com/PHPMailer/PHPMailer">
    PHPMailer</a> class.</p>';

$mail = new PHPMailer(true);

try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
    $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    echo "Email sent!" , PHP_EOL;
} catch (phpmailerException $e) {
    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}

    
?>