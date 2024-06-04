<?php

include ("../../loginphp/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo']; // Obtener el id de la noticia
   
    // Consulta SQL para actualizar la noticia existente
    $sql = "UPDATE texto SET Calendario='$titulo'  WHERE id= 1";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
        alert ('Texto actualizadp exitosamente');

        window.location='../../private/TYT.php';
        </script>";
       
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
