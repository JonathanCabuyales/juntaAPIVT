<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

$aprobada = $_POST['data'];
$id_prefac = $_POST['id'];

$json = file_get_contents('php://input');
 
$jsonMulta = json_decode($aprobada);

$fecha= $jsonMulta->fecha;
$num_autorizacion = $jsonMulta->numeroAutorizacion;
$estado = $jsonMulta->estado;


$query = "INSERT INTO facturas_aprobadas(
    fecha_acceso,
    num_autorizacion,
    estado,
    id_prefac
) VALUES(
    '$fecha',
    '$num_autorizacion',
    '$estado',
    '$id_prefac'
)";

echo json_encode(
    array(
        'insertado' => $aprobada,
        'insertado' => $jsonMulta,
        'message' => 'ok'
    )
    );

/* try{
    include('../conexion/bd.php');
    $get = mysqli_query($con, $query);
    if($get){
        echo json_encode(
            array(
                'insertado' => $get,
                'message' => 'ok'
            )
            );
    }else{
        echo json_encode(
            array(
                'insertado' => $get,
                'message' => 'error'
            )
            );
    }
}catch(Exception $e){
    echo json_encode(
        array(
            'insertado' => $get,
            'message' => 'error',
            'Exception' => $e->getMessage()
        )
        );

} */