<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


include ("../conexion/bd.php");

$json = file_get_contents('php://input');

$fechaInicio = $_GET["fechadesde"];
$fechaFin = $_GET["fechahasta"];

$get = mysqli_query($con, "SELECT * FROM prefactura prefac, clientes cli
WHERE prefac.fechapago_prefac BETWEEN '$fechaInicio 00:00:00' AND '$fechaFin 23:59:59'
AND prefac.facturagenerada_prefac = 'S'
AND prefac.id_cli = cli.id_cli
ORDER BY cli.direccion_cli DESC");

$data = array();

// WHERE create_at BETWEEN '$fechaActual 00:00:00' AND '$fechaActual 23:59:59'
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

echo json_encode($res); 
echo mysqli_error($con);