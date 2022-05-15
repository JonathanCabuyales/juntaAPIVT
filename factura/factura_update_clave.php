<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$clave = $_GET['claveacceso'];
$id = $_GET['id'];

$query = "UPDATE prefactura 
SET claveacceso = '$clave'
WHERE id_prefac = '$id'";

$get = mysqli_query($con, $query);

/* $data = array();

if ($get) {
    
}else{
    $res = array();
} */

// $res = $data;

if($get){
    echo json_encode(
        array(
            'data'=> $get,
            'message' => 'correcto',
            'status' => 'success'
        )
    ); 
}else{
    echo json_encode(
        array(
            'data'=> $get,
            'message' => 'no correcto',
            'status' => 'error'
        )
    ); 
    // echo mysqli_error($con);

}