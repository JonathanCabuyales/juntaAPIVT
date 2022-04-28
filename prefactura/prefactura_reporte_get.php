<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");

$query = "SELECT cli.direccion_cli, prefac.facturagenerada_prefac, COUNT(prefac.facturagenerada_prefac) AS clientes, ROUND(SUM(prefac.total_prefac - prefac.neto_prefac), 2) AS Fondosocial,
ROUND(SUM(prefac.neto_prefac), 2) AS Neto,
ROUND(SUM(prefac.total_prefac), 2) AS Total
FROM prefactura prefac, clientes cli
where prefac.id_cli = cli.id_cli
AND prefac.create_at BETWEEN '2021-09-01 00:00:00' AND '2021-09-30 23:59:59'
GROUP BY cli.direccion_cli, prefac.facturagenerada_prefac";

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