<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonProdServ = json_decode($json);

if (!$jsonProdServ) {
    exit("No hay datos para registrar");
}

$codigo_proser = $jsonProdServ->codigo_proser;
$categoria_proser = $jsonProdServ->categoria_proser;
$nombre_proser = $jsonProdServ->nombre_proser;
$descripcion_proser = $jsonProdServ->descripcion_proser;
$precio_proser = $jsonProdServ->precio_proser;
$cantidadfinal_proser = $jsonProdServ->cantidadfinal_proser;
$cantidad_proser = $jsonProdServ->cantidad_proser;
$IVA_proser = $jsonProdServ->IVA_proser;
$tipobien_proser= $jsonProdServ->tipobien_proser;
$unidadmedida_proser= $jsonProdServ->unidadmedida_proser;
$marca_proser= $jsonProdServ->marca_proser;
$modelo_proser= $jsonProdServ->modelo_proser;
$serie_proser= $jsonProdServ->serie_proser;
$estado_proser= $jsonProdServ->estado_proser;
$foto= $jsonProdServ->foto;

$query = "INSERT INTO productos_servicios 
(codigo_proser, 
categoria_proser, 
nombre_proser, 
descripcion_proser, 
precio_proser, 
cantidad_proser, 
cantidadfinal_proser,
IVA_proser,
tipobien_proser,
 unidadmedida_proser, 
 marca_proser, 
 modelo_proser, 
 serie_proser, 
 estado_proser, 
 foto)
VALUES('$codigo_proser',
'$categoria_proser', 
'$nombre_proser', 
'$descripcion_proser', 
'$precio_proser', 
'$cantidad_proser', 
'$cantidadfinal_proser',
'$IVA_proser',
'$tipobien_proser', 
'$unidadmedida_proser', 
'$marca_proser', 
'$modelo_proser', 
'$serie_proser', 
'$estado_proser', 
'$foto')";

$insert = mysqli_query($con, $query);

echo json_encode($insert);