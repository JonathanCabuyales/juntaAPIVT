<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


include ("../conexion/bd.php");

$json = file_get_contents('php://input');

$fechainicio = $_GET["fechainicio"];
$fechafin = $_GET["fechafin"];

$data=array(); 


$query = "SELECT u.nombres, u.apellidos, u.ciruc, s.id_usuario,s.id_sueldos, s.sueldo, s.diastrabajados, s.horasextras, s.calculo_horas, s.tipohoras,s.bonostransporte, s.bonosalimentacion, s.otrosingresos, s.decimotercer, s.decimocuarto, s.totalingresos, s.iessindividual, s.iesspatronal, s.iesstotal, s.anticipos, s.prestamos_oficina, s.prestamo_hipotecario, s.prestamo_quirografario, s.otrosegresos, s.total_egresos, s.neto_recibir, s.contrato, s.aprobado, s.actafiniquito, s.create_at FROM sueldos s, usuarios u WHERE s.id_usuario = u.id_usuario
AND s.create_at BETWEEN '$fechainicio' AND '$fechafin'";

$get = mysqli_query($con, $query);

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