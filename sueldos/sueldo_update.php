<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

include ("../conexion/bd.php");

$json = file_get_contents('php://input');
 
$jsonSueldo = json_decode($json);

if (!$jsonSueldo) {
    exit("No hay datos para registrar");
}

$id_sueldos = $jsonSueldo->id_sueldos;
$id_usuario = $jsonSueldo->id_usuario;
$sueldo = $jsonSueldo->sueldo;
$diastrabajados = $jsonSueldo->diastrabajados;
$horasextras = $jsonSueldo->horasextras;
$calculo_horas = $jsonSueldo->calculo_horas;
$tipohoras = $jsonSueldo->tipohoras;
$bonostransporte = $jsonSueldo->bonostransporte;
$bonosalimentacion = $jsonSueldo->bonosalimentacion;
$otrosingresos = $jsonSueldo->otrosingresos;
$decimotercer = $jsonSueldo->decimotercer;
$decimocuarto = $jsonSueldo->decimocuarto;
$totalingresos = $jsonSueldo->totalingresos;
$iessindividual = $jsonSueldo->iessindividual;
$iesspatronal = $jsonSueldo->iesspatronal;
$iesstotal = $jsonSueldo->iesstotal;
$anticipos = $jsonSueldo->anticipos;
$prestamos_oficina = $jsonSueldo->prestamos_oficina;
$prestamo_hipotecario = $jsonSueldo->prestamo_hipotecario;
$prestamo_quirografario = $jsonSueldo->prestamo_quirografario;
$otrosegresos = $jsonSueldo->otrosegresos;
$total_egresos = $jsonSueldo->total_egresos;
$neto_recibir = $jsonSueldo->neto_recibir;
$aprobado = $jsonSueldo->aprobado;
$contrato = $jsonSueldo->contrato;
$actafiniquito = $jsonSueldo->actafiniquito;


$query = "UPDATE sueldos SET
id_usuario = '$id_usuario', 
sueldo = '$sueldo', 
diastrabajados= '$diastrabajados',
horasextras = '$horasextras',
calculo_horas = '$calculo_horas',
tipohoras = '$tipohoras',
bonostransporte = '$bonostransporte', 
bonosalimentacion = '$bonosalimentacion',
otrosingresos = '$otrosingresos',
decimotercer = '$decimotercer', 
decimocuarto = '$decimocuarto',
totalingresos = '$totalingresos',
iessindividual = '$iessindividual',
iesspatronal = '$iesspatronal',
iesstotal = '$iesstotal',
anticipos = '$anticipos',
prestamos_oficina = '$prestamos_oficina',
prestamo_hipotecario = '$prestamo_hipotecario',
prestamo_quirografario = '$prestamo_quirografario',
otrosegresos = '$otrosegresos', 
total_egresos= '$total_egresos', 
neto_recibir= '$neto_recibir', 
contrato = '$contrato', 
aprobado = '$aprobado', 
actafiniquito = '$actafiniquito'
WHERE id_sueldos = '$id_sueldos'";

$update = mysqli_query($con, $query);

header('Content-Type: application/json');
echo json_encode($update);