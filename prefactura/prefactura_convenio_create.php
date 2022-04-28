<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonPrefactura = json_decode($json);

if (!$jsonPrefactura) {
    exit("No hay datos para registrar");
}

$id_prefac = $jsonPrefactura->id_prefac;
$servicios_prefac = $jsonPrefactura->servicios_prefac;
$interes_prefac = '0';
$neto_prefac = $jsonPrefactura->neto_prefac;
$total_prefac = $jsonPrefactura->total_prefac;
$monto_con = $jsonPrefactura->monto_con;
$valorpagos_con = $jsonPrefactura->valorpagos_con;
$cuotasporpagar_con = $jsonPrefactura->cuotasporpagar_con;
$numerospagos_con = $jsonPrefactura->numerospagos_con;
$fechacreacion_con = $jsonPrefactura->fechacreacion_con;
$convenio = $jsonPrefactura->convenio;

$query = "UPDATE prefactura set 
servicios_prefac = '$servicios_prefac',
interes_prefac = '$interes_prefac',
neto_prefac = '$neto_prefac',
total_prefac = '$total_prefac',
monto_con = '$monto_con',
valorpagos_con = '$valorpagos_con',
cuotasporpagar_con = '$cuotasporpagar_con',
numerospagos_con = '$numerospagos_con',
convenio = '$convenio',
fechacreacion_con = '$fechacreacion_con'
WHERE id_prefac = '$id_prefac'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);