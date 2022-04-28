<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

include ("../conexion/bd.php");

$fechaInicio = new DateTime();
$fechaInicio->modify('first day of this month');
$fechaInicio->format('Y-m-d'); // imprime por ejemplo: 01/12/2012
$fecha1 = date_format($fechaInicio,"Y-m-d");

$fechaFin = new DateTime();
$fechaFin->modify('last day of this month');
$fechaFin->format('Y-m-d'); // imprime por ejemplo: 31/12/2012
$fecha2 = date_format($fechaFin,"Y-m-d");

$data=array(); 

$query = "SELECT u.nombres, u.apellidos, s.id_usuario,s.id_sueldos, s.sueldo, s.diastrabajados, s.horasextras, s.calculo_horas, s.tipohoras,s.bonostransporte, s.bonosalimentacion, s.otrosingresos, s.decimotercer, s.decimocuarto, s.totalingresos, s.iessindividual, s.iesspatronal, s.iesstotal, s.anticipos, s.prestamos_oficina, s.prestamo_hipotecario, s.prestamo_quirografario, s.otrosegresos, s.total_egresos, s.neto_recibir, s.contrato, s.aprobado, s.actafiniquito, s.create_at FROM sueldos s, usuarios u WHERE s.id_usuario = u.id_usuario
AND s.create_at BETWEEN '$fecha1 00:00:00' AND '$fecha2 23:59:59'";

$get = mysqli_query($con, $query);


if ($get) {
    $array = array();
    while ($fila = mysqli_fetch_assoc($get)) {	
        // echo json_encode($fila);
        $data[] = array_map('utf8_encode', $fila);
    }
}else{
    $data = null;
}

$res = $data;

echo json_encode($res); 
echo mysqli_error($con);