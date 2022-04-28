<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");

$query = "SELECT cli.id_cli, cli.nombres_cli, cli.apellidos_cli, cli.ciruc_cli, cli.direccion_cli, 
cli.email_cli, cli.telefono_cli, id_prefac, id_usuario, servicios_prefac, impuesto_prefac, fondosocial_prefac, interes_prefac, neto_prefac, total_prefac,
metodo_prefac, convenio, mesesatraso_prefac, monto_con, numerospagos_con, valorpagos_con, cuotasporpagar_con
FROM prefactura prefac, clientes cli
where prefac.id_cli = cli.id_cli
AND prefac.facturagenerada_prefac = 'N'
AND prefac.mesesatraso_prefac > '1'
ORDER BY prefac.mesesatraso_prefac ASC, cli.direccion_cli DESC";

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