<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// header('Content-Type: application/json');

$usuario = $_GET['usuario'];
$password = $_GET['password'];


$query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasenia='$password'";


try{
    include('../conexion/bd.php');

    $result = mysqli_query($con, $query);

    $array = array();
    while ($fila = mysqli_fetch_assoc($result) ) {	
        // echo json_encode($fila);
        $data[] = array_map('utf8_encode', $fila);
    }

    $res = $data;

    if(sizeof($res) > 0){
        echo json_encode(
            array(
                'data' => $res[0],
                'encontrado' => true,
                'tamanio'=> sizeof($res)
            )
            );
    }else{
        echo json_encode(
            array(
                'data' => $res[0],
                'encontrado' => false,
                'tamanio'=> sizeof($res)
            )
            );
    }
}
catch(Exception $e){
    echo json_encode(
        array(
            'erro' => $e->getMessage()
        )
    );
}
