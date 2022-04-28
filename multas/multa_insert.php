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

$id_cli = $jsonMulta->id_cli;
$tipo_mul= $jsonMulta->tipo_mul;
$descripcion_mul= $jsonMulta->descripcion_mul;
$detalles_mul = $jsonMulta->detalles_mul;
$valor_mul= $jsonMulta->valor_mul;
$saldo_mul= $jsonMulta->saldo_mul;
$cancelada_mul= $jsonMulta->cancelada_mul;
$fechapago= $jsonMulta->fechapago;
$valorpagado_mul= $jsonMulta->valorpagado_mul;

$query = "INSERT multas (
        id_cli, 
        tipo_mul, 
        descripcion_mul,
        detalles_mul,
        valor_mul, 
        saldo_mul, 
        cancelada_mul, 
        fechapago, 
        valorpagado_mul) 
    VALUES (
        '$id_cli', 
        '$tipo_mul', 
        '$descripcion_mul',
        '$detalles_mul',
        '$valor_mul', 
        '$saldo_mul', 
        '$cancelada_mul', 
        '$fechapago', 
        '$valorpagado_mul')";

$insert = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($insert);