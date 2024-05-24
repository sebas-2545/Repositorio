<?php
include ("../../loginphp/conexion.php");

$is=$_POST['id_user'];
$fecharegi=$_POST['fecharegi'];
$identidad=$_POST['identidad'];
$nombre=$_POST['nombre'];
$ficha=$_POST['ficha'];
$correo=$_POST['correo'];
$celular=$_POST['celular'];
$nivel=$_POST['nivel'];
$programa=$_POST['programa'];
$instructor=$_POST['instructor'];
$productiva=$_POST['productiva'];
$fechainicio=$_POST['fechainicio'];
$fechacierre=$_POST['fechacierre'];
$ciudad=$_POST['ciudad'];
$jefe=$_POST['jefe'];
$direccem=$_POST['direccem'];
$correojefe=$_POST['correjefe'];
$celujefe=$_POST['celujefe'];
$instructoseg=$_POST['instructoseg'];
$alternativa=$_POST['alternativa'];
$text="SELECT * FROM user WHERE id='$is'";
$te=$conexion->query($text);
$res=$te->fetch_assoc();
$car=$res['id'];
$que="SELECT * FROM registroetapaproductiva where id_user='$car'";
$resul=$conexion->query($que);
$row=$resul->fetch_assoc();
if($resul->num_rows > 0){
    $id=$row['Id'];
   $upa="UPDATE registroetapaproductiva 
   SET
       NumeroDocumentoIdentidad = '$identidad',
       NombreCompleto = '$nombre',
       NumeroFicha = '$ficha',
       CorreoElectronico = '$correo',
       NivelAcademico = '$nivel',
       ProgramaFormacion = '$programa',
       NumeroCelular = '$celular',
       EmpresaInicioEtapaProductiva = '$productiva',
       FechaInicioEtapa = '$fechainicio',
       FechaFinEtapa = '$fechacierre',
       NombreInstructorLectivo = '$instructor',
       DireccionEmpresa = '$direccem',
       MunicipioCiudad = '$ciudad',
       NombreJefeInmediato = '$jefe',
       TelefonoJefeInmediato = '$celujefe',
       CorreoJefeInmediato = '$correojefe',
       TipoAlternativaEtapaProductiva = '$alternativa',
       DocumentosEntregados = 'si',
       id_intructor = '$instructoseg'
   WHERE id = '$id'";
   if ($conexion->query($upa) === true) {
    echo "<script>
    alert ('SE ACTULIZARON SUS DATOS');

    window.location='../../aprendiz/editar.php'
  </script>";    

}else {

   echo "error" . $upa ."<br>" . $conexion->error;
   
}
}else{
    $confirmar=$_POST['confirmar'];

    $sql= "INSERT INTO registroetapaproductiva (FechaRegistro,NumeroDocumentoIdentidad,NombreCompleto,NumeroFicha,CorreoElectronico,
    NivelAcademico,ProgramaFormacion,NumeroCelular,EmpresaInicioEtapaProductiva,FechaInicioEtapa,FechaFinEtapa,NombreInstructorLectivo,
    DireccionEmpresa,MunicipioCiudad,NombreJefeInmediato,TelefonoJefeInmediato,CorreoJefeInmediato,TipoAlternativaEtapaProductiva,DocumentosEntregados,id_user,id_intructor ) 
    VALUES ('$fecharegi','$identidad','$nombre','$ficha','$correo','$nivel','$programa','$celular','$productiva','$fechainicio','$fechacierre','$instructor',
    '$direccem','$ciudad','$jefe','$celujefe','$correojefe','$alternativa','$confirmar','$is','$instructoseg')";
    
    if ($conexion->query($sql) === true) {

        echo "<script>
        alert ('ESTA ESCHO EL REGISTRO');
    
        window.location='../../aprendiz/editar.php'
      </script>";    
    }else {
    
       echo "error" . $sql ."<br>" . $conexion->error;
       
    }
}
?>