<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

$json = file_get_contents('php://input');
 
$jsonPrefactura = json_decode($json);


$nombreUsuario = 'Junta De Agua Potable De Amaguaña JAAPSA';
$telefonoUsuario = '0962871530';
$mensajeUsuario = 'mensaje de prueba con html';
$correoUsuario = 'melida.suntaxi@jaapssa.com';
  
$cliente = $jsonPrefactura->cliente;
$consumo = $jsonPrefactura->consumo;
$excedente = $jsonPrefactura->excedente;
$interesmora = $jsonPrefactura->interes;
$otrosvalores = $jsonPrefactura->otrosvalores;
$fondosocial = $jsonPrefactura->fondosocial;
$valoratraso = $jsonPrefactura->valoratrasado;
$valoragua = $jsonPrefactura->valormesatual;
$totalapagar = $jsonPrefactura->totalapagar;
$fechalectura = date('d-m-Y');
$mailsocio = $jsonPrefactura->mail;
$coutaconvenio = $jsonPrefactura->coutaconvenio;

if($coutaconvenio == ''){
    $detalles = "<ul>
            <li><b>Consumo de agua:</b> $consumo m3</li>
            <li><b>Excedente:</b> $excedente m3</li>
            <li><b>Interes Por mora:</b> $interesmora $</li>
            <li><b>Valores Atrasados:</b> $valoratraso $</li>
            <li><b>Otros Valores: </b> $otrosvalores $</li>
            <li><b>Fondo Social:</b> $fondosocial $</li>
            <li><b>Valor Agua: </b> $valoragua $</li>
          </ul>";
}else{
    $detalles = "<ul>
            <li><b>Consumo de agua:</b> $consumo m3</li>
            <li><b>Excedente:</b> $excedente m3</li>
            <li><b>Interes Por mora:</b> $interesmora $</li>
            <li><b>Valores Atrasados:</b> $valoratraso $</li>
            <li><b>Otros Valores: </b> $otrosvalores $</li>
            <li><b>Valor couta convenio: </b> $coutaconvenio $</li>
            <li><b>Fondo Social:</b> $fondosocial $</li>
            <li><b>Valor Agua: </b> $valoragua $</li>
          </ul>";
}

  $email = $mailsocio;

  // Las 2 primeras lineas habilitan el informe de errores
  ini_set( 'display_errors', 1 );
  error_reporting( E_ALL );

  // de quien es el mensaje
  $from = $correoUsuario;
  // para quien es el mensaje
  $to = $email;
  // asunto del mensaje
  $subject = "AVISO DE COBRO !IMPORTANTE!";
  // cual es el mensaje
  
//   echo json_encode($mailsocio);
  
  
  $mensaje = "
    <!DOCTYPE html>
<html lang='es'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Mensaje</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .container {
      max-width: 1000px;
      width: 90%;
      margin: 0 auto;
    }

    .bg-dark {
      background: #a0a0a0;
      margin-top: 40px;
      padding: 20px 0;
    }

    .alert {
      font-size: 1.5em;
      position: relative;
      padding: .75rem 1.25rem;
      margin-bottom: 2rem;
      border: 1px solid transparent;
      border-radius: .25rem;
    }

    .alert-primary {
      color: #fff;
      background-color: #48494a;
      border-color: #48494a;
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
    }

    .mensaje {
      width: 80%;
      font-size: 20px;
      margin: 0 auto 40px;
      color: #eee;
    }

    .texto {
      margin-top: 20px;
      color: #fff;
    }

    .footer {
      width: 100%;
      background: #4f4f50;
      text-align: center;
      color: #ddd;
      padding: 10px;
      font-size: 14px;
    }

    .footer span {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class='container'>
    <div class='bg-dark'>
      <div class='alert alert-primary'>
        <span style='text-align: center;'>JUNTA AGUA POTABLE SAN JUAN DE AMAGUAÑA (JAAPSSA)</span>
      </div>

      <div class='mensaje'>
        <h3 style='text-align: center; color: #000000;'>AVISO DE COBRO</h3>
        <div class='texto'>


          Estimado/a $cliente, nuevamente nos ponemos en contacto con usted en relación con la incidencia
          de cobro realizada el mes vigente.

          <br>
          <br>
          En ella hacemos referencia a los valores que a la fecha $fechalectura mantiene,
          del contrato con JAAPSSA, valores que se detallan a continuación.

          <br>
          <br>
          Detalles:

          <br>
          <br>
          ".$detalles."
          <br><br>
          <span style='color: #000000'><b>Total A PAGAR:</b> $totalapagar $</span>
          <br>
          <br>
          El pago lo puede realizar en nuestra agencia de racuadación ubicada en San Juan De La Cruz, Ricardo Alvarez
          S3-51 Y Nela Martínez (Amaguaña).
          <br>
          <br>
          <b>Nota: </b>Si ya realizo el pago haga caso omiso a este mensaje.

        </div>
      </div>

      <div class='footer'>
        Para mayor información puede comunicarse al <span>$telefonoUsuario</span> o escribir a
        <span>$correoUsuario</span>
      </div>
    </div>
  </div>
</body>

</html>
  ";

  //para el envío en formato HTML 
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  // More headers
  $headers .= "From: <$correoUsuario>" . "\r\n";
  $headers .= "Cc: $to" . "\r\n";

  // esta funcion ejecuta el correo PHP
  $sendMail = mail($to, $subject, $mensaje, $headers);

  if( $sendMail ) {
    echo json_encode(true);
  } else {
    echo json_encode(array(
      'error' => true,
      'mensaje' => "Hubo un problema al enviar su mensaje. Intentélo mas terde."
    ));
  } 


?>