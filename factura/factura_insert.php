<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

// require ("../conexion/bd.php");

$json = file_get_contents('php://input');

$jsonPrefactura = json_decode($json);

if (!$jsonPrefactura) {
    exit("No hay datos para registrar");
}

// Valor nueva instalacion recibe un booleano 0 es falso y 1 es verdadero
// estado_ins verifica si esta activa la cuenta o no recibe una letra A activo N no activo

$secuencial = $jsonPrefactura->secuencial;
$id_cli = $jsonPrefactura->ciruc_cliente;
$id_usuario = $jsonPrefactura->id_usuario;
$servicios_fac = $jsonPrefactura->servicios_prefac;
// $id_con = $jsonPrefactura->id_con;
$impuesto_fac = $jsonPrefactura->impuesto_prefac;
$fondosocial_fac = $jsonPrefactura->fondosocial_prefac;
$neto_fac = $jsonPrefactura->neto_prefac;
$total_fac = $jsonPrefactura->total_prefac;
$metodo_fac = $jsonPrefactura->metodo_prefac;
$mesesatraso_fac = $jsonPrefactura->mesesatraso_prefac;
$generada_fac = $jsonPrefactura->generada_prefac;
// $numeroautrizacion = $jsonPrefactura->numeroautorizacion;
// $claveacceso = $jsonPrefactura->claveacceso;
// $fechaacceso = $jsonPrefactura->fechaacceso;
$estado = $jsonPrefactura->estado;
$id_prefactura = $jsonPrefactura->id_prefac;

$claveacceso = $jsonPrefactura->claveacceso;

/* $id_cli = intval($id_cli);
$id_usuario = intval($id_usuario);

$impuesto_fac = floatval($impuesto_fac);
$fondosocial_fac = floatval($fondosocial_fac);
$neto_fac = floatval($neto_fac);
$total_fac = floatval($total_fac);

$mesesatraso_fac = intval($mesesatraso_fac); */

$query = "INSERT INTO facturas
(secuencial, 
id_cli, 
id_usuario, 
servicios_fac, 
impuesto_fac, 
fondosocial_fac, 
neto_fac, 
total_fac, 
metodo_fac, 
mesesatraso_fac, 
generada_fac, 
numeroautorizacion, 
claveacceso, 
fechacceso, 
estado, 
id_prefactura) 
VALUES ('$secuencial',
'$id_cli', 
'$id_usuario', 
'$servicios_fac', 
'$impuesto_fac',
'$fondosocial_fac', 
'$neto_fac', 
'$total_fac', 
'$metodo_fac', 
'$mesesatraso_fac' ,
'$generada_fac', 
'', 
'$claveacceso', 
'', 
'$estado', 
'$id_prefactura')";

/* 

*/


try{
    include('../conexion/bd.php');
    $insert = mysqli_query($con, $query);
    header('Content-Type: application/json');
    echo json_encode(
        array(
            'insert' => $insert,
            'id_cli' => gettype($id_cli),
            'id_usuario' => gettype($id_usuario),
            'json' => $jsonPrefactura
        )
    );
}catch(Exception $e){
    header('Content-Type: application/json');
        echo json_encode(
            array(
                'insert' => $insert,
                'id_cli' => gettype($id_cli),
                'id_usuario' => gettype($id_usuario),
                'e' => $e->getMessage()
                // 'json' => $jsonPrefactura
            )
        );
}