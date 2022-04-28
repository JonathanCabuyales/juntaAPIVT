<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonProdServ = json_decode($json);

if (!$jsonProdServ) {
    exit("No hay datos para registrar");
}

$id_proser = $jsonProdServ->id_proser;
$cantidadfinal_proser = $jsonProdServ->cantidadfinal_proser;

$query = "UPDATE productos_servicios SET 
cantidadfinal_proser = '$cantidadfinal_proser'
WHERE id_proser = $id_proser ";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);