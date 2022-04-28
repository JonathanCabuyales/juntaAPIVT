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
$convenio = $jsonPrefactura->convenio;
$cuotasporpagar_con = $jsonPrefactura->cuotasporpagar_con;
$monto_con = $jsonPrefactura->monto_con;
$fechacreacion_con = $jsonPrefactura->fechacreacion_con;
$numerospagos_con = $jsonPrefactura->numerospagos_con;
$servicios_prefac = $jsonPrefactura->servicios_prefac;
$valorpagos_con = $jsonPrefactura->valorpagos_con;
        

// para que pueda captar las tildes y 単
// $acentos = $con->query("SET NAMES 'utf8'");

$query = "UPDATE prefactura set convenio = '$convenio', cuotasporpagar_con = '$cuotasporpagar_con', monto_con = '$monto_con',
fechacreacion_con = '$fechacreacion_con', numerospagos_con = '$numerospagos_con', servicios_prefac = '$servicios_prefac', 
valorpagos_con = '$valorpagos_con'
WHERE id_prefac = '$id_prefac'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);