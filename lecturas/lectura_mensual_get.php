<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");

$anio = new DateTime();
$year = $anio->format("Y");

$mes = new DateTime();
$month = $mes->format("m");

$fecha1 = $year.'-'.$month.'-25';

$fechaFin = new DateTime();
$fechaFin->modify('last day of this month');
$fechaFin->format('Y-m-d'); // imprime por ejemplo: 31/12/2012
$fecha2 = date_format($fechaFin,"Y-m-d");

$query = "select * from lecturas lec, clientes cli 
WHERE lec.fechalecact_lec BETWEEN '$fecha1 00:00:00' and '$fecha2 23:59:59'
AND lec.id_med = cli.id_cli
ORDER BY cli.direccion_cli DESC";

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