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
$fondosocial_prefac = $jsonPrefactura->fondosocial_prefac;
$interes_prefac = $jsonPrefactura->interes_prefac;
$neto_prefac = $jsonPrefactura->neto_prefac;
$total_prefac = $jsonPrefactura->total_prefac;
$mesesatraso_prefac = $jsonPrefactura->mesesatraso_prefac;
$fechacreacion_con = $jsonPrefactura->fechacreacion_con;
$create_at = $jsonPrefactura->create_at;

$query = "UPDATE prefactura set 
servicios_prefac = '$servicios_prefac', 
fondosocial_prefac = '$fondosocial_prefac', 
interes_prefac = '$interes_prefac',
neto_prefac = '$neto_prefac', 
total_prefac = '$total_prefac', 
mesesatraso_prefac = '$mesesatraso_prefac',
fechacreacion_con = '$fechacreacion_con',
create_at = '$create_at'
WHERE id_prefac = '$id_prefac'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);