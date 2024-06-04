<?php

include ("../../loginphp/conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $empresa = $_POST['empresa'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];
    $fecha = $_POST['fecha'];

    $sql = "INSERT INTO noticias (Titulo, Empresa, Correo, Mensaje,fecha) VALUES ('$titulo', '$empresa', '$correo', '$mensaje' ,'$fecha')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
        alert ('Noticia actualizada exitosamente');

        window.location='../../private/vernoti.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>