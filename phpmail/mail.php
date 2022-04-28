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
$telefono = $params->telefono;
$correo = $params->correo;
$mensaje = $params->mensaje;


$mail = new PHPMailer(true);

try {

    $bodyMensaje = "<h2>Datos de la persona a Contactar</h2>" . "<br> <b>Nombres:  </b>" . $nombres . "<br><br><b>Celular:  </b> " . $telefono . "<br><br><b>Correo:  </b> " .$correo . "<br><br><b>Mensaje:  </b> " . $mensaje;  

    //Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.vt-proyectos.com.ec';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'comunicacion@vt-proyectos.com.ec';                     // SMTP username
    $mail->Password   = 'proyectosvtcomunicacion';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('andresalquinga@hotmail.com', 'Informacion');
    $mail->addAddress('andresalquinga@hotmail.com', 'Informacion');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Informacion sobre VT proyectos';
    $mail->Body    = $bodyMensaje;

    // '<h2>Datos de la persona a Contactar</h2>
    // <ul style="list-style: none;">
    //   <li><b>Nombres:</b> $nombres </li>
    //   <li><b>Correo:</b> </li>
    //   <li><b>Celular:</b> </li>
    // </ul>'

    $mail->send();
    echo 'El mensaje se envio correctamente';
} catch (Exception $e) {
    echo "Hubo un errro al enviar el mensaje: {$mail->ErrorInfo}";
}

// class Result {}

//     $response = new Result();
//     $response->resultado = 'OK';
//     $response->mensaje = 'Mensaje Enviado';

//     header('Content-Type: application/json');
//     echo json_encode($response);  
// ?>