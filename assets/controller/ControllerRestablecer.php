<?php

include ("../../loginphp/conexion.php");

$email=$_POST['id'];
$contrasena=$_POST['contra'];
$ver=$_POST['contra2'];
$sql="SELECT * FROM user WHERE id = '$email'";
$res=$conexion->query($sql);
if($res->num_rows > 0){
    
    $row=$res->fetch_assoc();
    
    if ($contrasena == $ver) {
        $secret= password_hash($contrasena,PASSWORD_DEFAULT);
        $updat="UPDATE user SET contrasena = '$secret' WHERE id = '$email'";
        $conexion->query($updat);
        header("Location: ../../loginphp/loginAprendiz.php") ;

        
    }else{
        echo "<script>
        alert ('Las contraseñas no son las mismas');

        window.location='../../loginphp/restablecer.php';
        </script>";
    }
    
   
}else{
    echo "<script>
        alert ('Error');

        window.location='../../loginphp/restablecer.php';
        </script>";
}
?>