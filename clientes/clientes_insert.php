<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');
header("Content-Type: text/html;charset=utf-8");

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonCliente = json_decode($json);

if (!$jsonCliente) {
    exit("No hay datos para registrar");
}

$nombres = $jsonCliente->nombres_cli;
$apellidos = $jsonCliente->apellidos_cli;
$ciruc = $jsonCliente->ciruc_cli;
$direccion = $jsonCliente->direccion_cli;
$email = $jsonCliente->email_cli;
$telefono = $jsonCliente->telefono_cli;

// para que pueda captar las tildes
$acentos = $con->query("SET NAMES 'utf8'");

$apellidos = html_entity_decode($apellidos, ENT_QUOTES | ENT_HTML401, "UTF-8");
$fechaactual = date('Y-m-d h:i:s', time());

$query = "INSERT INTO clientes (
    nombres_cli, 
    apellidos_cli, 
    ciruc_cli, 
    direccion_cli, 
    email_cli, 
    telefono_cli) 
    VALUES (
        '$nombres', 
        '$apellidos', 
        '$ciruc', 
        '$direccion', 
        '$email',
        '$telefono')";

$insert = mysqli_query($con, $query);

if($insert){
    $id_cli = mysqli_insert_id($con); 

    $querytipo = "INSERT INTO tipocliente (
        id_cli,
        descripcion_tcli,
        estado_tcli
    )
    VALUES (
        '$id_cli',
        'NORMAL',
        'ACTIVO'
    )";


    $inserttipo = mysqli_query($con, $querytipo);

    $querylecturas = "INSERT INTO lecturas (
        id_med,
        fechalecant_lec,
        lecturaant_lec,
        fechalecact_lec,
        lecturaact_lec,
        consumo_lec,
        foto_lec
    )
    VALUES (
        '$id_cli',
        '$fechaactual',
        '0',
        '$fechaactual',
        '0',
        '0',
        '0'
    )";
    

    $insertlecturas = mysqli_query($con, $querylecturas);

    if($inserttipo && $insertlecturas){
        echo json_encode(true);  
    }else{
        echo json_encode(false);
    }
}