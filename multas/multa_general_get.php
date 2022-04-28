<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$query = "SELECT mul.id_mul, mul.id_cli, mul.cancelada_mul, 
mul.valor_mul, mul.fechapago, mul.saldo_mul, mul.valorpagado_mul, mul.detalles_mul,
cli.nombres_cli, cli.apellidos_cli, cli.direccion_cli, cli.ciruc_cli, 
mul.descripcion_mul, mul.create_at 
FROM clientes cli, multas mul
WHERE mul.id_cli = cli.id_cli
ORDER BY create_at DESC";

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