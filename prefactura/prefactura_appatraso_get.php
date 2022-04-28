<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonPrefactura = json_decode($json);

if (!$jsonPrefactura) {
    exit("No hay id del cliente");
}

$id_cli = $jsonPrefactura;

$query = "SELECT * FROM prefactura prefac
WHERE prefac.id_cli = '$id_cli' 
AND facturagenerada_prefac = 'N'";

$get = mysqli_query($con, $query);

$data = array();

if ($get) {
    $array = array();
    while ($fila = mysqli_fetch_assoc($get) ) {	
        // echo json_encode($fila);
        $data[] = array_map('utf8_encode', $fila);
    }
}else{
    echo "fallo no hay nada";
    $res = null;
    echo mysqli_error($con);
}

$res = $data;

echo json_encode($res); 
echo mysqli_error($con);