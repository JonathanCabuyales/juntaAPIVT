<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$get = mysqli_query($con, "SELECT mul.id_mul,
  mul.id_cli,
  mul.tipo_mul,
  mul.descripcion_mul,
  mul.valor_mul,
  mul.saldo_mul,
  mul.cancelada_mul,
  mul.fechapago,
  mul.valorpagado_mul,
  cli.nombres_cli,
  cli.apellidos_cli,
  cli.direccion_cli
 FROM multas mul, clientes cli 
 WHERE mul.id_cli = cli.id_cli
 AND mul.cancelada_mul = 'NO'");

// AND mul.cancelada_mul = 'SI'
// AND cli.direccion_cli = '$barrio'
$data = array();

// WHERE create_at BETWEEN '$fechaActual 00:00:00' AND '$fechaActual 23:59:59'
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