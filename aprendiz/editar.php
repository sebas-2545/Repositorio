<?php
include ("../loginphp/conexion.php");
session_start();

if(isset($_SESSION['cedula'])){
    $cedula=$_SESSION['cedula'];
    $id_rol= $_SESSION['id_rol'];
    $use="SELECT * FROM user WHERE cedula='$cedula'";
    $res=$conexion->query($use);
    $row=$res->fetch_assoc();
    $id=$row['id'];

    $eta="SELECT * FROM registroetapaproductiva where id_user='$id'";
    $ress=$conexion->query($eta);

    if($id_rol!=5){
        header("Location:  ../loginphp/loginAprendiz.php");
    }
    if ($ress->num_rows > 0) {
        $r=$ress->fetch_assoc();
        $te=$r['Id'];
        $sq="SELECT * FROM usuarios WHERE idusuarios='$r[id_intructor]'";
        $s = $conexion->query($sq);
        $rr= $s->fetch_assoc();
        $extt ="Pdf";
        $url='../assets/controller/pdf.php?id='.$te;
        $numero = "+57" . $rr['Celular'];

    $mensaje = "Hola";
    
    $whatsapp_url = 'https://api.whatsapp.com/send?phone=' . $numero . '&text=' . urlencode($mensaje);
    $destinatario = $rr['Correo']; 
    
    $asunto = 'Documentos del aprendiz ' . $r['NumeroFicha']; 
   
    $cuerpo = "Buen dia Instructor "  ."%0A".
     "Soy " . $r['NombreCompleto']."%0A".
     "del " .$r['ProgramaFormacion']."%0A" ;
    $enlace_mailto = 'mailto:' . $destinatario . '?subject=' . $asunto . '&body=' . $cuerpo;

    }
 
}else{
    header("Location:  ../loginphp/loginAprendiz.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="es">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Sistema - Panel Principal</title>
		<link rel="shortcut icon" href="../assets/etapa/icono.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/datatables/datatables.css" />
		<link href="../assets/css/hebbo.css" rel="stylesheet">
        <link href="../assets/css/editar.css" rel="stylesheet">

		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<script src="../assets/js/ace-extra.min.js"></script>

	</head>

	<body class="no-skin">
		<?php require_once("encabeza.php"); ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container','fixed')}catch(e){}
			</script>
				
				<!-- MOSTRAR EL MENU  -->
				<?php require_once("menulateral.php"); ?>
				<!-- fin Menu Lateral -->

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="aprendiz.php">Inicio</a>
							</li>
							<li class="active">Panel Principal</li>
						</ul><!-- /.breadcrumb -->

						<!--
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Buscar ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div> /.nav-search -->
					</div>

					<div class="page-content">

						<div class="row">
						<div class="boton-flotante">


<a href="<?php echo '../assets/controller/Controllerpdf.php?id='.$te;?>" class="Btn">
   <svg class="svgIcon" viewBox="0 0 384 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"></path></svg>
   <span class="icon2"></span>
   <span class="tooltip">Download</span>
</a>

</div>
    <form action="../assets/controller/ControllerRegistro_productivo.php" method="post">
    <input type="text"  name="id_user" value="<?php echo $id;  ?>"  id="mi_input" style="display: none;">
    <header>
        <div class="logo-minis">
            <img src="https://www.dnp.gov.co/img/LOGO-COLOMBIA-POTENCIA-DE-LA-VIDA-1.png" alt="Logo Ministerio">
            <div class="fecha">
                <input type="text"  name="id" value=" <?php echo $id  ?>"id="mi_input" style="display: none;">
                <p>Fecha : </p>
                <input type="text"  name="fecharegi" value="<?php echo date("Y-m-d");  ?> "  id="mi_input" >
           </div>  
        </div>
        <div class="mensa">
            <?php
                $fechaEspecifica = $r['FechaInicioEtapa'];
                $fechaEspecificaDateTime = new DateTime($fechaEspecifica);
                $fechaActualDateTime = new DateTime();
                $diferencia = $fechaEspecificaDateTime->diff($fechaActualDateTime);
                $diferenciaMeses = $diferencia->y * 12 + $diferencia->m;
                
                if ($diferenciaMeses >= 1 && $diferencia->invert == 0 && $r['FechaFormalizacion'] == NULL) {
                    echo '<div class="custom-alert custom-rojo">ENVIE DOCUMENTOS PARA FORMALIZAR.</div>';
                } elseif ($diferenciaMeses >= 3 && $diferencia->invert == 0 && $r['FechaEvaluacionParcial'] == NULL) {
                    echo '<div class="custom-alert custom-amarillo">CONTACTE SU INSTRUCTOR PARA HACER EL SEGUIMIENTO PARCIAL.</div>';
                } elseif ($diferenciaMeses >= 6 && $diferencia->invert == 0 && $r['FechaEvaluacionFinal'] == NULL) {
                    echo '<div class="custom-alert custom-zapote">CONTACTE SU INSTRUCTOR PARA HACER EL SEGUIMIENTO FINAL.</div>';
                } else {
                    echo '<div class="custom-alert custom-verde">ESTÁ TODO AL DÍA.</div>';
                }
                ?>
        </div>

        <div class="logo-sena">
            <img src="../assets/images/SENA-removebg-preview.png" alt="Logo Sena">
        </div>
    </header>
    <div class="info-des">
        <div class="info-superior">
            <p>LISTA DE CHEQUEO DEL APRENDIZ EN SU ETAPA PRODUCTIVA</p>
        </div>
        <div class="info-central">
            <div class="central-pt1">Resultado de Aprendizaje: </div>
            <div class="central-pt2">Aplicar en la resolución de problemas reales del sector productivo, los conocimientos, habilidades y destrezas pertinentes a
                                    las competencias del programa de formación asumiendo estrategias y metodologías de autogestión</div>
        </div>
        <div class="central-inferior">
            <p>Información registrada del aprendiz de la etapa productiva que desarrollo para su certificación final es:</p>
        </div>
    </div>
    <div class="info-apren">
        <div class="apren-ced">
            <p>Documento de Identidad:</p>
            <input type="number" name="identidad" id="" value="<?php if($ress->num_rows>0){ echo $r['NumeroDocumentoIdentidad']; } ?>" readonly>
        </div>
        <div class="apren-nom-cor">
            <div class="apren-nom">
                <p>NOMBRE DEL APRENDIZ:</p>
                <input type="text" name="nombre" id=""  value="<?php if($ress->num_rows>0){ echo $r['NombreCompleto']; } ?>">
            </div>
            <div class="apren-corr">
                <p>Correo:</p>
                <input type="email" value="<?php if($ress->num_rows>0){ echo $r['CorreoElectronico']; } ?>" name="correo">
            </div>
        </div>
        <div class="apren-cel">
            <p>Celular:</p>
            <input type="number" name="celular" id="" value="<?php if($ress->num_rows>0){ echo $r['NumeroCelular']; } ?>" >
        </div>
    </div>
    <div class="info-extra">
        <div class="info-title"><p>DATOS DEL PROGRAMA DE FORMACION</p></div>
        <div class="info-cur">
            <div class="fechas">
                <div class="ficha">
                    <p>FICHA:</p>
                    <input type="number" name="ficha" value="<?php if($ress->num_rows>0){ echo $r['NumeroFicha']; } ?>" >
                </div>
                <div class="fecha-1">
                    <p>Fecha Inicio:</p>
                    <input type="date" name="Fecha_Inicio" id="" readonly>
                </div>
                <div class="fecha-2">
                    <p>Fecha Fin:</p>
                    <input type="date" name="Fecha_Fin" id="" readonly>
                </div>
            </div>
            <div class="info-mas">
                <div class="tip-for">
                    <p>TIPO DE FORMACIÓN:</p>
                     <select name="nivel" id="">
                        <option value="<?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?> "><?php if($ress->num_rows>0){ echo $r['NivelAcademico']; } ?></option>
                        <option value="Tecnico">Tecnico</option>
                        <option value="Tecnologo">Tecnologo</option>
                        <option value="Operario">Operario</option>
                     </select>
                </div>
                <div class="nom-form">
                    <p>NOMBRE PROGRAMA FORMACIÓN:</p>
                    <input type="text" name="programa"  placeholder="Analisis y desarrollo de sofware"   value="<?php if($ress->num_rows>0){ echo $r['ProgramaFormacion']; } ?>" required>
                </div>
                <div class="nom-inst">
                    <p>Instructor técnico etapa lectiva:</p>
                    <input type="text" name="instructor" id="" value="<?php if($ress->num_rows>0){ echo $r['NombreInstructorLectivo']; } ?>">
                </div>
            </div>
        </div>
        <div class="title-empre">
            <p>Datos de la Empresa donde realiza su etapa productiva:</p>
        </div>
        <div class="info-empre">
            <div class="fechas-2">
                <div class="nomb-emp">
                    <p>Nombre Empresa:</p>
                    <input type="text" name="productiva" id=""  value="<?php if($ress->num_rows>0){ echo $r['EmpresaInicioEtapaProductiva']; } ?>">
                </div>
                <div class="emp-fecha-1">
                    <p>Fecha Inicio:</p>
                    <input type="date" name="fechainicio"  placeholder="Juan Perez"   value="<?php if($ress->num_rows>0){ echo $r['FechaInicioEtapa']; } ?>">
                </div>
                <div class="emp-fecha-2">
                    <p>Fecha Fin:</p>
                    <input type="date" name="fechacierre" id="" value="<?php if($ress->num_rows>0){ echo $r['FechaFinEtapa']; } ?>">
                </div>
                <div class="dire-emp">
                    <p>Dirección de la empresa: </p>
                    <input type="text" name="direccem" id="" value="<?php if($ress->num_rows>0){ echo $r['DireccionEmpresa']; } ?>">
                </div>
            </div>
            <div class="info-men">
                <div class="nn-sup">
                    <p>Nombre Supervisor:</p>
                    <input type="text" name="jefe" id="" value="<?php if($ress->num_rows>0){ echo $r['NombreJefeInmediato']; } ?>">
                </div>
                <div class="cel-sup">
                    <p>Celular:</p>
                    <input type="tel" name="celujefe" id="" value="<?php if($ress->num_rows>0){ echo $r['TelefonoJefeInmediato']; } ?>">
                </div>
                <div class="cor-sup">
                    <p>Correo:</p>
                    <input type="email" name="correjefe" id="" value="<?php if($ress->num_rows>0){ echo $r['CorreoJefeInmediato']; } ?>">
                </div>
                <div class="mun-sup">
                    <p>Municipio:</p>
                    <input type="text" name="ciudad"  value="<?php if($ress->num_rows>0){ echo $r['MunicipioCiudad']; } ?>" id="">
                </div>
            </div>
        </div>
        <div class="info-final">
            <div class="nose-part1">
                <div class="nose-izq">
                    <div class="alt-pro">
                        <p>Alternativa Etapa Productiva:</p>
                        <select name="alternativa" id=""  required>
                            <option value="<?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>"    >   <?php if($ress->num_rows>0){ echo $r['TipoAlternativaEtapaProductiva']; } ?>  </option>
                            <option value="Contrato de aprendizaje">Contrato de aprendizaje</option>
                            <option value="Vinculo Laboral">Vinculo Laboral</option>
                            <option value="Pasantía - PYME">Pasantía - PYME</option>
                            <option value="Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro">Pasantía. Institución estatal nacional, territorial, o una ONG, o una entidad sin animo de lucro</option>
                            <option value="Proyecto productivo">Proyecto productivo</option>
                            <option value=" Pasantía - Proyecto productivo - Unidad productiva familiar"> Pasantía - Proyecto productivo - Unidad productiva familiar</option>
                            <option value="Monitoría">Monitoría</option>
                        </select>
                    </div>
                    <div class="inst-segi">
                        <p>Instructor Seguimiento: </p>
                        <select name="instructoseg" id=""   required>
                <option value="<?php if($ress->num_rows>0){ echo $rr['idusuarios']; } ?>"><?php if($ress->num_rows>0){ echo $rr['Nombre']; } ?></option>
                <?php
                $sql = "SELECT * FROM usuarios";
                $res = $conexion->query($sql); 
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='" . $row['idusuarios'] . "'>" . $row['Nombre'] . "</option>";
                }
                ?>
            </select>
                    </div>
                    <div class="nose-cor">
                        <p>Correo instructor</p>
                        <input type="text" value="<?php if($ress->num_rows>0){ echo $rr['Correo']; } ?>" name="" id="">

                    </div>
                </div>
               
            </div>
            <div class="nose-part2">
                <p>Lista de chequeo de solicitud de Paz y Salvo</p>
            </div>
        </div>
    </div>
    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>numero</th>
                    <th>Evidencia / Lista de Chequeo</th>
                    <th>CUMPLE</th>
                    <th>NO CUMPLE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>_Formato GFPI-F-023 Planeación (numeral 1 y 2)</td>
                    <td><input type="radio" name="cumple_1" value="si" <?php if($ress->num_rows>0){ if ($r['FormatoGFPIF023'] == 'si'){ echo 'checked'; } }?> disabled></td>
                    <td><input type="radio" name="cumple_1" value="no" <?php if($ress->num_rows>0) if ($r['FormatoGFPIF023'] == 'no') echo 'checked'; ?>   disabled></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td> _Contrato de aprendizaje o Certificación Laboral o Certificación desarrollo EP</td>
                    <td><input type="radio" name="cumple_2" value="si" <?php if($ress->num_rows>0) if ($r['CopiaContrato'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_2" value="no" <?php if($ress->num_rows>0) if ($r['CopiaContrato'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td> _Formato GFPI-F-165 Selección EP</td>
                    <td><input type="radio" name="cumple_3" value="si" <?php if($ress->num_rows>0) if ($r['FormatoGFPIF165'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_3" value="no" <?php  if($ress->num_rows>0) if ($r['FormatoGFPIF165'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td> _Cámara de comercio o RUT de la empresa (Solo PYMES o unidad productiva familiar)
                    </td>
                    <td><input type="radio" name="cumple_4" value="si" <?php if($ress->num_rows>0) if ($r['RUToNIT'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_4" value="no" <?php  if($ress->num_rows>0) if ($r['RUToNIT'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>_Certificación EPS</td>
                    <td><input type="radio" name="cumple_5" value="si" <?php if($ress->num_rows>0) if  ($r['EPS'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_5" value="no" <?php if($ress->num_rows>0) if ($r['EPS'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>_Certificación ARL</td>
                    <td><input type="radio" name="cumple_6" value="si"  <?php if($ress->num_rows>0) if ($r['ARL'] == 'si') echo 'checked'; ?> disabled></td>
                     <td><input type="radio" name="cumple_6" value="no" <?php if($ress->num_rows>0) if ($r['ARL'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td> _Formato GFPI-F-023 Evaluaciones (Parcial y Final)</td>
                    <td><input type="radio" name="cumple_7" value="si" <?php if($ress->num_rows>0) if ($r['FormatoGFPIF023Completo'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_7" value="no" <?php  if($ress->num_rows>0) if ($r['FormatoGFPIF023Completo'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td> _Formato GFPI-F-147 Bitácoras (12 Documentos en PDF)</td>
                    <td> <p> <?php if($ress->num_rows>0){ echo $r['FormatoGFPIF147Bitacoras']; } ?></p></td>
                    <td><p></p></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td> _Certificación Final de Etapa Productiva</td>
                    <td><input type="radio" name="cumple_9" value="si" <?php if($ress->num_rows>0) if ($r['CertificacionFinalizacion'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_9" value="no" <?php if($ress->num_rows>0)  if ($r['CertificacionFinalizacion'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td> _Juicio Evaluativo Reporte</td>
                    <td><input type="radio" name="cumple_10" value="si" <?php if($ress->num_rows>0) if ($r['EstadoPorCertificar'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_10" value="no" <?php if($ress->num_rows>0) if ($r['EstadoPorCertificar'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td> _Documento Identidad</td>
                    <td><input type="radio" name="cumple_11" value="si" <?php if($ress->num_rows>0) if ($r['CopiaCedula'] == 'si') echo 'checked'; ?> disabled></td>
                     <td><input type="radio" name="cumple_11" value="no" <?php if($ress->num_rows>0) if ($r['CopiaCedula'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>_Certificado TyT (Solo para Tecnólogos)</td>
                    <td><input type="radio" name="cumple_12" value="si" <?php if($ress->num_rows>0) if ($r['PruebasTyT'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_12" value="no" <?php if($ress->num_rows>0) if ($r['PruebasTyT'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td> _Certificación Carnet (Evidencia de destruccion del carnet)</td>
                    <td><input type="radio" name="cumple_13" value="si" <?php if($ress->num_rows>0) if ($r['DestruccionCarnet'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_13" value="no" <?php if($ress->num_rows>0) if ($r['DestruccionCarnet'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td> _Certificado APE (Agencia Publica de Empleo del SENA)</td>
                    <td><input type="radio" name="cumple_14" value="si" <?php  if($ress->num_rows>0) if ($r['CertificadoAPE'] == 'si') echo 'checked'; ?> disabled></td>
                    <td><input type="radio" name="cumple_14" value="no" <?php  if($ress->num_rows>0) if ($r['CertificadoAPE'] == 'no') echo 'checked'; ?> disabled></td>
                </tr>
                </tbody>
            </table>
    </div>
    <div class="jucicio">
        <p><b>Juicio de valor: </b>Para aprobar el resultado de aprendizaje, el aprendiz debe cumplir el 100% de las evidencias descritas en el cuadro anterior. En caso de no alcanzar el porcentaje, el
            aprendiz presentará de nuevo la evidencia dentro de las fechas del programa de formación para la solicitud del paz y salvo.</p>
    </div>
    <div class="observacion">
        <p>Observaciones:</p>
        <input name="observacion" placeholder="<?php if($ress->num_rows>0) echo $r['observaciones']?>"  readonly>
    </div>

    <div class="Estado">
        <p>JUICIO PARA SOLICITAR EL PAZ Y SALVO:</p>
         <p><?php if($ress->num_rows>0) echo $r['Estado']; ?> </p>
    </div>

<div class="secu">
    
<a href="<?php echo $whatsapp_url; ?>" class="whatsapp-button">WhatsApp</a>
<a href="<?php echo $enlace_mailto; ?>" class="animated-button">
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
                </svg>
                <span class="text">EMAIL TO</span>
                <span class="circle"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                <path
                    d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
                </svg>
</a>
    <button class="brn" type="submit">

<div class="svg-wrapper-1">
  <div class="svg-wrapper">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 24 24"
      width="24"
      height="24"
    >
      <path fill="none" d="M0 0h24v24H0z"></path>
      <path
        fill="currentColor"
        d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z"
      ></path>
    </svg>
  </div>
</div>
<span>ENVIA</span>
</button>
</div>
</form>
    <footer>
        <p><b>SENA DE CLASE MUNDIAL</b></p>
        <p>CENTRO INDUSTRIA Y CONSTRUCCION - REGIONAL TOLIMA</p>
        <div class="redes-footer">
           
        </div>
								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
			<?php require_once("piedepagina.php"); ?>
			<!-- /.Pie de pagina -->
			
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<script src="../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.index.min.js"></script>
		<script src="../assets/js/jquery.flot.min.js"></script>
		<script src="../assets/js/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script src="../assets/datatables/datatables.min.js"></script>
		<script src="../assets/datatables/revisar.js"></script>
	</body>
</html>
