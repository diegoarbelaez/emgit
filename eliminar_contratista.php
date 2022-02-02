<?php
include("conexion.php");
$id_contratista=base64_decode($_GET["id_contratista"]);
//$sentencia = "DELETE FROM contrato where id_contrato=$id_contrato";
$sentencia = "UPDATE contratista set activado=0 where id_contratista=$id_contratista";
$resultado = $conexion->query($sentencia);
/*$sentencia2 = "DELETE FROM actividades where fk_id_contrato=$id_contrato";
$resultado2 = $conexion->query($sentencia2);*/
header("Location:contenedor_gestionar_contratistas.php");
?>