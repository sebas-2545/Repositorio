<?php
include ("../../loginphp/conexion.php");

$contraseña=$_POST['pass'];
$email=$_POST['email'];
$cedula=$_POST['user'];
$rol=5;
$secret= password_hash($contraseña,PASSWORD_DEFAULT);

$sql = "SELECT * FROM user WHERE cedula = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $cedula);
$stmt->execute();
$resul = $stmt->get_result();

if ($resul->num_rows > 0) {
    echo "<script>
    alert('USUARIO YA REGISTRADO');
    window.location='../../loginphp/loginAprendiz.php';
</script>";
}else {
    $sql="INSERT INTO user (cedula,email,contrasena,id_rol) VALUES ('$cedula','$email','$secret','$rol')";
    if ($conexion->query($sql) === true) {

        header("Location: ../../loginphp/loginAprendiz.php") ;
    
    }else {
    
       echo "error" . $sql ."<br>" . $conn->error;
       
    }
}

?>