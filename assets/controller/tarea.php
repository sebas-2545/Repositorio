    <?php

include ("../../loginphp/conexion.php");
    if(isset($_GET['id'])){
    $tarea=$_GET['PENDIENTE'];
    $car=$_GET['id'];

    $upa="UPDATE registroetapaproductiva 
        SET tarea='$tarea' where id = '$car'";
        if ($conexion->query($upa) === true) {
            echo "<script>
            alert ('Acabas de pedir la respuesta Maagna');
        
            window.location='../../private/Miaprendiz.php'
            </script>";  
        }else {
        
        echo "error" . $sql ."<br>" . $conn->error;
        
        }
    }
    ?>