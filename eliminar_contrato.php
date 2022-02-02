<?php
include("conexion.php");
$id_contrato=base64_decode($_GET["id_contrato"]);
//$sentencia = "DELETE FROM contrato where id_contrato=$id_contrato";
$sentencia = "UPDATE contrato set activo=0 where id_contrato=$id_contrato";
$resultado = $conexion->query($sentencia);
/*$sentencia2 = "DELETE FROM actividades where fk_id_contrato=$id_contrato";
$resultado2 = $conexion->query($sentencia2);*/
header("Location:contenedor_gestionar_contratos.php")
?>