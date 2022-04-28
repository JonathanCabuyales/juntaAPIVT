<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonMulta = json_decode($json);

if (!$jsonMulta) {
    exit("No hay datos para registrar");
}

$id_mul = $jsonMulta->id_mul;
$descripcion_mul = $jsonMulta->descripcion_mul;

$query = "UPDATE multas set descripcion_mul = '$descripcion_mul'
WHERE id_mul = '$id_mul'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);