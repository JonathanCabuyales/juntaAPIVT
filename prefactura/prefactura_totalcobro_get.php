<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

include ("../conexion/bd.php");

$query = "select pre.id_prefac, pre.id_cli, pre.id_usuario, pre.servicios_prefac, pre.impuesto_prefac, pre.neto_prefac, pre.total_prefac, pre.metodo_prefac, pre.convenio, pre.mesesatraso_prefac, pre.facturagenerada_prefac, pre.monto_con, pre.numerospagos_con, pre.valorpagos_con, pre.cuotasporpagar_con, pre.fechaultimopago_con, pre.fechacreacion_con, cli.nombres_cli, cli.apellidos_cli, cli.direccion_cli FROM prefactura pre, clientes cli WHERE pre.id_cli = cli.id_cli AND pre.facturagenerada_prefac = 'S' ORDER BY cli.direccion_cli ASC";

$get = mysqli_query($con, $query);

$data = array();

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