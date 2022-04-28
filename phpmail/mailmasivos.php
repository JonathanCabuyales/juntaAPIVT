<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

$people = array(
    array('mail' => 'andresalquinga@hotmail.com'),
    array('mail' => 'andresalquinga@hotmail.com')
);

include ("../conexion/bd.php");

$query = "SELECT id_cli, email_cli FROM clientes
WHERE email_cli != '1@hotmail.com'";

$get = mysqli_query($con, $query);

$data = array();

if ($get) {
    $array = array();
    while ($fila = mysqli_fetch_assoc($get) ) {	
        // echo json_encode($fila);
        $data[] = array_map('utf8_encode', $fila);
    }
}else{
    $res = array();
}

$res = $data;

$nombreUsuario = 'Junta De Agua Potable De Amaguaña JAAPSA';
$telefonoUsuario = '0962871530';
$mensajeUsuario = 'mensaje de prueba con html';
$correoUsuario = 'melida.suntaxi@jaapssa.com';

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
  
  
  $mensaje = "<!DOCTYPE html>
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
      width: 90%;
      font-size: 20px;
      margin: 0 auto 40px;
      color: #eee;
    }

    .texto {
      margin-top: 20px;
      color: #fff;
      text-align: center;
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
        <div class='texto'>

          <h3>JUNTA ADMINISTRADORA DE AGUA POTABLE Y SANEAMIENTO
          </h3>

          <h3>“SAN JUAN DE AMAGUAÑA”</h3>
          <p style='text-align: right;'>Amaguaña, 23 de noviembre de 2021.</p>
          <br>
          <p><i>
              “Sus voces están escuchándose y están demostrándole a nuestros ancestros que sus luchas no fueron en vano.
              Ahora nos queda una cosa más que debemos hacer: caminar hacia nuestro verdadero poder, que es el voto”.
            </i>
          </p>
          <br>
          <h4>CONVOCATORIA</h4>
          <br>

          <p style='text-align: justify;'>La Comisión Electoral de la Junta San Juan de Amaguaña, hace llegar un saludo
            cordial.
            De conformidad con el estatuto vigente, y el Art:10, convoca a sus usuarios a la asamblea general ordinaria
            para la Elección de la nueva directiva periodo 2021 – 2023.
            Que se llevará a cabo el día domingo 28 de noviembre de 2021, en la cancha deportiva de la Junta. Hora: 9:00
            Con el siguiente orden del día:
          </p>
          <br>
          <ul style='list-style: none; text-align: left;'>
            <li>1.- Constatación del quórum.</li>
            <li>2.- Elección de la nueva directiva.</li>
            <li>3.- Proclamación de resultados y posesión de la directiva.</li>
          </ul>
          <br>
          <p style='text-align: justify;'>
            Recuerde aplicar las normas de bioseguridad:
            Usar la mascarilla, el lavado de manos, uso del alcohol y el distanciamiento social.
            Agradecemos su puntual asistencia.
          </p>
          <br>
          <p style='text-align: justify;'><b>NOTA: La asistencia es obligatoria del titular de la acometida con su
            cédula de identificación. En caso de no
            asistir será sancionado con 20 dólares de acuerdo con el Art:38
            Solicitamos llegar media hora antes para registrar su asistencia.</b>
          </p>

          <br><br>
          <p style='text-align: justify;'> Atentamente
            LA COMISIÓN ELECTORAL.</p>

        </div>
      </div>
    </div>
  </div>
</body>

</html>";

    //para el envío en formato HTML 
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  // More headers
  $headers .= "From: <$correoUsuario>" . "\r\n";
  $headers .= "Cc: $to" . "\r\n";


    
    for($i = 0; $i < count($res); ++$i) {
        $res[$i]['email_cli'];

        // esta funcion ejecuta el correo PHP
    $sendMail = mail($res[$i]['email_cli'], $subject, $mensaje, $headers);

    if( $sendMail ) {
        echo json_encode(true);
    } else {
        echo json_encode(array(
            'error' => true,
            'mensaje' => "Hubo un problema al enviar su mensaje. Intentélo mas terde."
    ));
  } 
    }

?>