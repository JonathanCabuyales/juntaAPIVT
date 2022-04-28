<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');

$lectura = json_decode($json);

if (!$lectura) {
    exit("No hay datos para registrar");
}

$id_lec = $lectura->id_lec;
$lecturaact_lec = $lectura->lecturaact_lec;
$foto_lec = $lectura->foto_lec;

$query = "UPDATE lecturas SET lecturaact_lec = '$lecturaact_lec', foto_lec = '$foto_lec'
WHERE id_lec = '$id_lec'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);