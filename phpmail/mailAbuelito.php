<?php

header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Headers: *");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';



$json = file_get_contents('php://input');
 
$params = json_decode($json);

$nombres = $params->nombres;
$ciudad = $params->ciudad;
$sector = $params->sector;
$numero = $params->numero;
$mensaje = $params->mensaje;

$mail = new PHPMailer(true);

try {

    $bodyMensaje = "<h2>Datos de la persona a Contactar</h2>" . "<br> <b>Nombre del abuelito  </b>" . $nombres . "<br><br><b>Ciudad:  </b> " . $ciudad . "<br><br><b>Sector:  </b> " .$sector . "<br><br><b>Numero de la persona a contactar:  </b> " . $numero . "<br><br><b>Ciudad:  </b> " . $mensaje;  

    //Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.podriasermiabuelito.org';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'beneficiarios@podriasermiabuelito.org';                     // SMTP username
    $mail->Password   = 'beneficiariospodria';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('beneficiarios@podriasermiabuelito.org', 'Informacion Podria Ser Mi Abuelito');
    $mail->addAddress('beneficiarios@podriasermiabuelito.org', 'Informacion');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Formulario de ayuda para abuelit@s';
    $mail->Body    = $bodyMensaje;

    $mail->send();
    echo 'El mensaje se envio correctamente';
} catch (Exception $e) {
    echo "Hubo un errro al enviar el mensaje: {$mail->ErrorInfo}";
}