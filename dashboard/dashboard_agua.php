<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");

$fechaInicio = new DateTime();
$fechaInicio->modify('first day of this month');
$fechaInicio->format('Y-m-d'); // imprime por ejemplo: 01/12/2012
$fecha1 = date_format($fechaInicio,"Y-m-d");

$fechaFin = new DateTime();
$fechaFin->modify('last day of this month');
$fechaFin->format('Y-m-d'); // imprime por ejemplo: 31/12/2012
$fecha2 = date_format($fechaFin,"Y-m-d");

$query = "SELECT * FROM (select ROUND(SUM(lec.consumo_lec), 2) 'CUENDINACHICO' 
from lecturas lec, clientes cli 
where cli.id_cli = lec.id_med AND cli.direccion_cli = 'CUENDINA CHICO' 
AND lec.fechalecact_lec BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:00') CUENDINA,
(select ROUND(SUM(lec.consumo_lec), 2) 'ELROSARIO' 
from lecturas lec, clientes cli 
where cli.id_cli = lec.id_med AND cli.direccion_cli = 'EL ROSARIO' 
AND lec.fechalecact_lec BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:00') ROSARIO,
(select ROUND(SUM(lec.consumo_lec), 2) 'GUAMBA' 
from lecturas lec, clientes cli 
where cli.id_cli = lec.id_med AND cli.direccion_cli = 'GUAMBA' 
AND lec.fechalecact_lec BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:00') GUAMBA,
(select ROUND(SUM(lec.consumo_lec), 2) 'SANJUAN' 
from lecturas lec, clientes cli 
where cli.id_cli = lec.id_med AND cli.direccion_cli = 'SAN JUAN' 
AND lec.fechalecact_lec BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:00') SANJUAN,
(select ROUND(SUM(lec.consumo_lec), 2) 'SANLUIS' 
from lecturas lec, clientes cli 
where cli.id_cli = lec.id_med AND cli.direccion_cli = 'SAN LUIS' 
AND lec.fechalecact_lec BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:00') SANLUIS,
(select ROUND(SUM(lec.consumo_lec), 2) 'SANTAROSA' 
from lecturas lec, clientes cli 
where cli.id_cli = lec.id_med AND cli.direccion_cli = 'SANTA ROSA' 
AND lec.fechalecact_lec BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:00') SANTAROSA;";


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