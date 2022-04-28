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
$cancelada_mul = $jsonMulta->cancelada_mul;
$valor_mul = $jsonMulta->valor_mul;
$valorpagado_mul = $jsonMulta->valorpagado_mul;
$saldo_mul = $jsonMulta->saldo_mul;
$fechapago = $jsonMulta->fechapago;

$query = "UPDATE multas set cancelada_mul = '$cancelada_mul',
valor_mul = '$valor_mul',
saldo_mul = '$saldo_mul',
valorpagado_mul = '$valorpagado_mul',
fechapago = '$fechapago'
WHERE id_mul = '$id_mul'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);