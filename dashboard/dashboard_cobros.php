<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");

$query = "SELECT * FROM 
(SELECT ROUND(SUM(pre.total_prefac), 2) Enero 
FROM prefactura pre WHERE pre.fechapago_prefac BETWEEN '2022-01-01 01:00:00' AND '2022-01-31 20:00:00' AND pre.facturagenerada_prefac = 'S') ENERO, 
(SELECT ROUND(SUM(pre.total_prefac), 2) Febrero
FROM prefactura pre WHERE pre.fechapago_prefac BETWEEN '2022-02-01 01:00:00' AND '2022-02-28 20:00:00' AND pre.facturagenerada_prefac = 'S') FEBRERO,
(SELECT ROUND(SUM(pre.total_prefac), 2) Marzo 
FROM prefactura pre WHERE pre.fechapago_prefac BETWEEN '2022-03-01 01:00:00' AND '2022-03-25 20:00:00' AND pre.facturagenerada_prefac = 'S') MARZO,
(SELECT ROUND(SUM(pre.total_prefac), 2) Abril
FROM prefactura pre WHERE pre.fechapago_prefac BETWEEN '2022-04-01 01:00:00' AND '2022-04-30 20:00:00' AND pre.facturagenerada_prefac = 'S') ABRIL";


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