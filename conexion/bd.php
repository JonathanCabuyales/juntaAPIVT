<?php
$bd = "localhost";
$contrasena = "";
$usuario = "root";
$nombre_base_de_datos = "jaapssa_contable";

// $bd = "localhost";
// $contrasena = "4956andres";
// $usuario = "jaapssa_vtAND";
// $nombre_base_de_datos = "jaapssa_contable";

// $con = new PDO('mysql:host=localhost;dbname=' . $nombre_base_de_datos, $usuario, $contraseña);
$con = mysqli_connect($bd, $usuario, $contrasena, $nombre_base_de_datos);

mysqli_set_charset($con,"utf8");

if(!$con){
    die("Connection Failed :". mysqli_connect_error());
}