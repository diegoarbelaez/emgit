<?php
include("conexion.php");
$id_contratista=$_POST["id_contratista"];
$nombres = $_POST["nombres"];
$apellidos  = $_POST["apellidos"];
$cedula  = $_POST["cedula"];
$telefono  = $_POST["telefono"];
$usuario = $_POST["usuario"];
$contrasena  = $_POST["contrasena"];

//$sentencia = "DELETE FROM contrato where id_contrato=$id_contrato";
$sentencia = "UPDATE contratista set nombres='$nombres', apellidos='$apellidos', cedula='$cedula', telefono='$telefono', usuario='$usuario', password='$contrasena' where id_contratista=$id_contratista";
$resultado = $conexion->query($sentencia);
if (!$resultado){
    echo "Error -> ".$conexion->error;
}
//echo $sentencia;
header("Location:contenedor_gestionar_contratistas.php")
?>