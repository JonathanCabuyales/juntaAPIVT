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

// Valor nueva instalacion recibe un booleano 0 es falso y 1 es verdadero
// estado_ins verifica si esta activa la cuenta o no recibe una letra A activo N no activo

$id_cli = $jsonPrefactura->id_cli;
$id_usuario = $jsonPrefactura->id_usuario;
$fondosocial_prefac = $jsonPrefactura->fondosocial_prefac;
$servicios_prefac = $jsonPrefactura->servicios_prefac;
$impuesto_prefac = $jsonPrefactura->impuesto_prefac;
$neto_prefac = $jsonPrefactura->neto_prefac;
$total_prefac = $jsonPrefactura->total_prefac;
$metodo_prefac = $jsonPrefactura->metodo_prefac;
$convenio = $jsonPrefactura->convenio;
$mesesatraso_prefac = $jsonPrefactura->mesesatraso_prefac;
$facturagenerada_prefac = $jsonPrefactura->facturagenerada_prefac;
$monto_con = $jsonPrefactura->monto_con;
$numerospagos_con = $jsonPrefactura->numerospagos_con;
$valorpagos_con = $jsonPrefactura->valorpagos_con;
$cuotasporpagar_con = $jsonPrefactura->cuotasporpagar_con;
$fechaultimopago_con = $jsonPrefactura->fechaultimopago_con;
$fechacreacion_con = $jsonPrefactura->fechacreacion_con;

$query = "INSERT INTO prefactura (id_cli, id_usuario, servicios_prefac, impuesto_prefac, fondosocial_prefac,neto_prefac, total_prefac, metodo_prefac, convenio, mesesatraso_prefac, facturagenerada_prefac, monto_con, numerospagos_con, valorpagos_con, cuotasporpagar_con, fechaultimopago_con, fechacreacion_con) 
VALUES ('$id_cli', '$id_usuario', '$servicios_prefac', '$impuesto_prefac', '$neto_prefac', '$fondosocial_prefac','$total_prefac', '$metodo_prefac', '$convenio', '$mesesatraso_prefac', '$facturagenerada_prefac' ,'$monto_con', '$numerospagos_con', '$valorpagos_con', '$cuotasporpagar_con', '', '')";

$insert = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($insert);