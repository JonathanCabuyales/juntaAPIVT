<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$jwt = $_GET['token'];

$query = "SELECT secuencial 
FROM facturas
ORDER BY id_fac DESC LIMIT 1";

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

if($get){
    echo json_encode(
        array(
            'data'=> $data,
            'message' => 'correcto',
            'status' => 'success'
        )
    ); 
}else{
    echo mysqli_error($con);

}