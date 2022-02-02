<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar Empresas</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="content">
			<h2>Datos de las empresas &raquo; Agregar datos</h2>
			<hr />
			<?php
			if(isset($_POST['add'])){
				$nit		     = mysqli_real_escape_string($con,(strip_tags($_POST["nit"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$direccion_empresa	 	= mysqli_real_escape_string($con,(strip_tags($_POST["direccion_empresa"],ENT_QUOTES)));//Escanpando caracteres 
				$telefono_empresa	 = mysqli_real_escape_string($con,(strip_tags($_POST["telefono_empresa"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre_responsable	 = mysqli_real_escape_string($con,(strip_tags($_POST["nombre_responsable"],ENT_QUOTES)));//Escanpando caracteres 
				$cedula_responsable	 = mysqli_real_escape_string($con,(strip_tags($_POST["cedula_responsable"],ENT_QUOTES)));//Escanpando caracteres 
				$telefono_responsable	 = mysqli_real_escape_string($con,(strip_tags($_POST["telefono_responsable"],ENT_QUOTES)));//Escanpando caracteres 
				$actividad	     = mysqli_real_escape_string($con,(strip_tags($_POST["fk_actividad"],ENT_QUOTES)));//Escanpando caracteres 	
				$fecha_solicitud = date("Y-m-d");
				$creado_por = $_SESSION["user"];						
				$cek = mysqli_query($con, "SELECT * FROM empresa WHERE id_empresa='$nit'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO empresa (nit,nombre,direccion_empresa,nombre_responsable,cedula_responsable,telefono_responsable,fecha_solicitud,telefono_empresa,fk_actividad,creado_por) VALUES ('$nit','$nombre','$direccion_empresa','$nombre_responsable','$cedula_responsable','$telefono_responsable','$fecha_solicitud','$telefono_empresa','$actividad','$creado_por')") or die(mysqli_error());						
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
				  <label class="col-sm-3 control-label">NIT</label>
				  <div class="col-sm-2">
						<input type="number" name="nit" class="form-control" placeholder="NIT" required>
					</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-3 control-label">Nombre</label>
				  <div class="col-sm-4">
						<input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-3 control-label">Actividad</label>
				  <div class="col-sm-4">
						<input type="text" name="fk_actividad" class="form-control" placeholder="Actividad de la Empresa" required>
					</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-3 control-label">Teléfono</label>
				  <div class="col-sm-4">
						<input type="number" name="telefono_empresa"  class="form-control" placeholder="Teléfono" required>
					</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-3 control-label">Nombre del Responsable</label>
				  <div class="col-sm-4">
						<input type="text" name="nombre_responsable" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-3 control-label">Cedula del Responsable</label>
				  <div class="col-sm-4">
						<input type="number" name="cedula_responsable" class="form-control" placeholder="Cedula del Responsable" required>
					</div>
				</div>
				<div class="form-group">
				  <label class="col-sm-3 control-label">Telefono del Responsable</label>
				  <div class="col-sm-4">
						<input type="number" name="telefono_responsable" class="form-control" placeholder="Teléfono del Responsable" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Dirección</label>
					<div class="col-sm-3">
						<input name="direccion_empresa" class="form-control" placeholder="Dirección" required>
					</div>
				</div>				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>
