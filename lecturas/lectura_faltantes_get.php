<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");


$query = "SELECT DISTINCT id_med,fechalecant_lec, lecturaant_lec, fechalecact_lec, 
lecturaact_lec, consumo_lec, foto_lec from lecturas 
WHERE fechalecact_lec BETWEEN '2021-09-01 00:00:00' AND '2021-10-24 23:59:59'";

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