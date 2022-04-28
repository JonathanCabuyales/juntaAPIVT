<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');

$jsonLectura = json_decode($json);

if (!$jsonLectura) {
    exit("No hay id del medidor");
}

$id_med = $jsonLectura;

$query = "SELECT * FROM lecturas lec, clientes cli
WHERE lec.id_med = '$id_med' 
AND lec.id_med = cli.id_cli
ORDER BY fechalecact_lec DESC";

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