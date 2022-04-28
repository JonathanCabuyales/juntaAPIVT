<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header("Content-Type: text/html;charset=utf-8");

// Esto le dice a PHP que usaremos cadenas UTF-8 hasta el final
// mb_internal_encoding('UTF-8');
 
// // Esto le dice a PHP que generaremos cadenas UTF-8
// mb_http_output('UTF-8');

include ("../conexion/bd.php");



$query = "SELECT cli.id_cli, nombres_cli, apellidos_cli, ciruc_cli, 
direccion_cli, email_cli, telefono_cli, descripcion_tcli, estado_tcli 
FROM clientes cli, tipocliente tcli
WHERE cli.id_cli = tcli.id_cli
AND estado_tcli = 'ACTIVO'
ORDER BY direccion_cli DESC, apellidos_cli DESC";



$get = mysqli_query($con, $query);


$data = array();

if ($get) {
    $array = array();
    while ($fila = mysqli_fetch_assoc($get) ) {	
        // echo json_encode($fila);
        // $texto = $fila["apellidos_cli"];
        // $data[] = array_map('utf8_encode', $fila);
        $data[] = $fila;

        // echo $texto;
    }
}else{
    echo "fallo no hay nada";
    $res = null;
    echo mysqli_error($con);
}

$res = $data;
echo json_encode($res);
echo mysqli_error($con);