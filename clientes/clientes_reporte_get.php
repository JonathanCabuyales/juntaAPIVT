<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Content-Type: text/html;charset=utf-8");

// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
// mb_internal_encoding('UTF-8');
 
// // Esto le dice a PHP que generaremos cadenas UTF-8
// mb_http_output('UTF-8');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonBarrio = json_decode($json);


$barrio = $jsonBarrio;


if ($barrio == 'TODO') {
    $query = "SELECT * FROM clientes cli, tipocliente tcl
    WHERE cli.id_cli = tcl.id_cli
    AND tcl.estado_tcli = 'ACTIVO'
    ORDER BY direccion_cli DESC, apellidos_cli DESC";
}else{
    $query = "SELECT * FROM clientes cli, tipocliente tcl
    WHERE cli.direccion_cli = '$barrio'
    AND cli.id_cli = tcl.id_cli
    AND tcl.estado_tcli = 'ACTIVO'
    ORDER BY direccion_cli DESC, apellidos_cli DESC";
}

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