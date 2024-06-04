<?php
include ("../../loginphp/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id']; // Obtener el id de la noticia

    // Consulta SQL para eliminar la noticia
    $sql = "DELETE FROM noticias WHERE id='$id'";

    
    if ($conexion->query($sql) === TRUE) {
        echo "<script>
        alert ('Noticia ELIMINADA exitosamente');

        window.location='../../private/vernoti.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}
?>
