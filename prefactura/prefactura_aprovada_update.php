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

$id_prefac = $jsonPrefactura;

// para que pueda captar las tildes y 単
// $acentos = $con->query("SET NAMES 'utf8'");

$query = "UPDATE prefactura set facturagenerada_prefac = 'S'
WHERE id_prefac = '$id_prefac'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);