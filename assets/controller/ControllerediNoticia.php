<?php

include ("../../loginphp/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Obtener el id de la noticia
    echo $id;
    $titulo = $_POST['titulo'];
    $empresa = $_POST['empresa'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    // Consulta SQL para actualizar la noticia existente
    $sql = "UPDATE noticias SET Titulo='$titulo', Empresa='$empresa', Correo='$correo', Mensaje='$mensaje'  WHERE id='$id'";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
        alert ('Noticia actualizada exitosamente');

        window.location='../../private/vernoti.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
