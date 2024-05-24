<?php

include("configuracion.php");// recibe un parámetro que es el archivo de variales

// Crear instancia de Mysql

$conexion = new mysqli($server, $user, $password, $bd);

// Verificar la conexion

if ($conexion->connect_error) {
    die("Fallo la conexion: " . $conexion->connect_error);
  } else{
 

}

?>