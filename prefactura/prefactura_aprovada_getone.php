<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonPrefactura = json_decode($json);

if (!$jsonPrefactura) {
    exit("No hay id del cliente");
}

$id_cli = $jsonPrefactura;

$query = "SELECT cli.id_cli, cli.nombres_cli, cli.apellidos_cli, cli.ciruc_cli, 
cli.direccion_cli, cli.email_cli, cli.telefono_cli, prefac.id_prefac, prefac.id_usuario, 
prefac.servicios_prefac, prefac.impuesto_prefac, prefac.neto_prefac, prefac.total_prefac, 
prefac.metodo_prefac, prefac.convenio, prefac.mesesatraso_prefac, prefac.monto_con, prefac.numerospagos_con,
prefac.valorpagos_con, prefac.cuotasporpagar_con, prefac.fechapago_prefac, prefac.fondosocial_prefac, prefac.interes_prefac
FROM prefactura prefac, clientes cli 
WHERE prefac.id_cli = '$id_cli' 
AND cli.id_cli = '$id_cli'
AND facturagenerada_prefac = 'S'
ORDER BY prefac.fechapago_prefac DESC
";

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