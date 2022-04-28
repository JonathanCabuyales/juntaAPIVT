<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include ("../conexion/bd.php");

$query = "SELECT cli.id_cli, cli.nombres_cli, cli.apellidos_cli, cli.ciruc_cli, cli.direccion_cli, 
cli.email_cli, cli.telefono_cli, prefac.id_prefac, prefac.id_usuario, prefac.servicios_prefac, 
prefac.impuesto_prefac, prefac.neto_prefac, prefac.total_prefac, prefac.metodo_prefac, prefac.convenio, 
prefac.mesesatraso_prefac, prefac.monto_con, prefac.numerospagos_con, prefac.valorpagos_con, prefac.cuotasporpagar_con, prefac.facturagenerada_prefac
FROM prefactura prefac, clientes cli
where prefac.id_cli = cli.id_cli
ORDER BY cli.direccion_cli, prefac.facturagenerada_prefac, prefac.id_cli";

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