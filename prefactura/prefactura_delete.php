<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonPrefactura = json_decode($json);

if (!$jsonPrefactura) {
    exit("No hay id de la prefactura");
}

$id_prefac = $jsonPrefactura;

$query = "DELETE FROM prefactura WHERE id_prefac = '$id_prefac'";

$delete = mysqli_query($con, $query);

echo json_encode($delete); 
echo mysqli_error($con);