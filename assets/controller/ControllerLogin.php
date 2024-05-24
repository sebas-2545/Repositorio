<?php

include ("../../loginphp/conexion.php");

session_start();

$cedula=$_POST['user'];
$contrasena=$_POST['pass'];
//user
$sql="SELECT * FROM user WHERE cedula = '$cedula'";
$res=$conexion->query($sql);
$row=$res->fetch_assoc();
//user
if($res->num_rows > 0){
        $id_rol=$row['id_rol'];
        if($id_rol==5){
            if(password_verify($contrasena,$row['contrasena'])){
                $_SESSION['id_rol']=$id_rol;
                $_SESSION['cedula'] = $cedula;
                $id=$row['id'];
                $cons="SELECT * FROM registroetapaproductiva WHERE id_user='$id'";
                $sisa=$conexion->query($cons);
                if($sisa->num_rows > 0){
                    header("Location: ../../aprendiz/aprendiz.php");
                    exit;

                }else{
                    
                    header("Location: ../../aprendiz/aprendiz.php");
                    exit;
                }
            }else{
               echo "<script>
				alert ('El usuario o clave incorrecta');

				window.location='../../loginphp/loginAprendiz.php';
			  </script>";
            }
        }
}else {
       echo "<script>
        alert ('El usuario o clave incorrecta');

        window.location='../../loginphp/loginAprendiz.php';
        </script>";
}

?>