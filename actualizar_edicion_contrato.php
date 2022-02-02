<?php
include("conexion.php");
$id_contrato = $_POST["id_contrato"];
$numero=$_POST["numero"];
$fecha_inicio=$_POST["fecha_inicio"];
$fecha_fin=$_POST["fecha_fin"];
$objeto=$_POST["objeto"];
$valor=$_POST["valor"];
$codigo=$_POST["codigo"];
$codigo2=$_POST["codigo2"];
$codigo3=$_POST["codigo3"];
$supervisor_1 = $_POST["supervisor_1"];
$supervisor_2 = $_POST["supervisor_2"];
$supervisor_3 = $_POST["supervisor_3"];
$correo_supervisor_1 = $_POST["correo_supervisor_1"];
$correo_supervisor_2 = $_POST["correo_supervisor_2"];
$correo_supervisor_3 = $_POST["correo_supervisor_3"];
$numero_cuotas = $_POST["numero_cuotas"];
$sentencia = "UPDATE contrato set numero='$numero', fecha_inicio='$fecha_inicio', fecha_fin='$fecha_fin', objeto='$objeto', valor=$valor, indicador='$codigo', indicador2='$codigo2', indicador3='$codigo3', supervisor1='$supervisor_1', supervisor2='$supervisor_2', supervisor3='$supervisor_3', correo_supervisor1='$correo_supervisor_1', correo_supervisor2='$correo_supervisor_2', correo_supervisor3='$correo_supervisor_3', numero_cuotas=$numero_cuotas where id_contrato=$id_contrato";
$resultado = $conexion->query($sentencia);
//echo $sentencia;
header("Location:visualizar_contrato.php?id_contrato=".base64_encode($id_contrato));
?>