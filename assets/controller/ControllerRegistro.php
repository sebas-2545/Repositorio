<?php
include ("../../loginphp/conexion.php");

$contraseña=$_POST['pass'];
$email=$_POST['email'];
$cedula=$_POST['user'];
$rol=5;
$secret= password_hash($contraseña,PASSWORD_DEFAULT);

$sql="INSERT INTO user (cedula,email,contrasena,id_rol) VALUES ('$cedula','$email','$secret','$rol')";

if ($conexion->query($sql) === true) {

    header("Location: ../../loginphp/loginAprendiz.php") ;

}else {

   echo "error" . $sql ."<br>" . $conn->error;
   
}
?>