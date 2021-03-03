<?php

$from_name = htmlspecialchars($_POST['s'],ENT_QUOTES,'UTF-8');
$to = htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');
$contenido = htmlspecialchars($_POST['c'],ENT_QUOTES,'UTF-8');

require "PHPMailer/PHPMailerAutoload.php";

try
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
}
    
?>