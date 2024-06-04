<?php

include ("../../loginphp/conexion.php");

$email=$_POST['id'];
$contrasena=$_POST['contra'];
$ver=$_POST['contra2'];
$sql="SELECT * FROM usuarios WHERE idusuarios = '$email'";
$res=$conexion->query($sql);

if($res->num_rows > 0){
    
    $row=$res->fetch_assoc();
    
    if ($contrasena == $ver) {
        $secret= password_hash($contrasena,PASSWORD_DEFAULT);
        $updat="UPDATE usuarios SET Password = '$secret' WHERE idusuarios= '$email'";
        $conexion->query($updat);
        header("Location: ../../loginphp/index.php") ;

        
    }else{
        echo "<script>
        alert ('Las contraseñas no son las mismas');

        window.location='../../loginphp/restablecerins.php';
        </script>";
    }
    
   
}else{
    echo "<script>
        alert ('Error');

        window.location='../../loginphp/restablecerins.php';
        </script>";
}
?>