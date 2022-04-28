<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonMulta = json_decode($json);

if (!$jsonMulta) {
    exit("No hay id del cliente");
}

$id_cli = $jsonMulta;

$query = "SELECT mul.id_mul, mul.id_cli, mul.cancelada_mul, mul.valor_mul, mul.fechapago, mul.saldo_mul, cli.nombres_cli, 
cli.apellidos_cli, cli.direccion_cli, cli.ciruc_cli, mul.descripcion_mul, mul.create_at, mul.valorpagado_mul
FROM clientes cli, multas mul,
WHERE mul.id_cli = '$id_cli'
AND mul.id_cli = cli.id_cli
AND mul.cancelada_mul = 'NO'";

$get = mysqli_query($con, $query);

$data = array();

if ($get) {
    $array = array();
    while ($fila = mysqli_fetch_assoc($get) ) {	
        // echo json_encode($fila);
        $data[] = array_map('utf8_encode', $fila);
    }
}else{
    $res = array();
}

$res = $data;

echo json_encode($res); 
echo mysqli_error($con);