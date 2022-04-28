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

$id_med = $lectura->id_med;
$fechalecant_lec = $lectura->fechalecant_lec;
$lecturaant_lec = $lectura->lecturaant_lec;
$fechalecact_lec = $lectura->fechalecact_lec;
$lecturaact_lec = $lectura->lecturaact_lec;
$consumo_lec = $lectura->consumo_lec;
$foto_lec = $lectura->foto_lec;

$query = "INSERT INTO lecturas (id_med, fechalecant_lec, lecturaant_lec, fechalecact_lec, lecturaact_lec, consumo_lec, foto_lec) 
VALUES ('$id_med', '$fechalecant_lec', '$lecturaant_lec', '$fechalecact_lec', '$lecturaact_lec', '$consumo_lec', '$foto_lec')";

$insert = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($insert);