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

$query = "DELETE FROM prefactura WHERE id_prefac = '$id_prefac'";

$delete = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($delete);
