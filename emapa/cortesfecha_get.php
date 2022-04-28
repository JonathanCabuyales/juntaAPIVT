<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


include ("../conexion/bd.php");

$json = file_get_contents('php://input');

$fechaInicio = $_GET["fechadesde"];
$fechaFin = $_GET["fechahasta"];

$get = mysqli_query($con, "SELECT * FROM novedad
WHERE create_at BETWEEN '$fechaInicio 00:00:00' AND '$fechaFin 23:59:59'
AND novedadCorte = ' SERVICIO CORTADO '
ORDER BY id_nov DESC");

$data = array();

// WHERE create_at BETWEEN '$fechaActual 00:00:00' AND '$fechaActual 23:59:59'
if ($get) {
    $array = array();
    while ($fila = mysqli_fetch_assoc($get) ) {	
        // echo json_encode($fila);
        $data[] = array_map('utf8_encode', $fila);
    }
}else{
    echo "fallo no hay nada";
    $res = null;
    echo mysqli_error($con);
}

$res = $data;

echo json_encode($res); 
echo mysqli_error($con);