<?php
include("conexion.php");
$id_contrato = base64_decode($_GET["id_contrato"]);
$id_log = base64_decode($_GET["id_log"]);
$sentencia2 = "DELETE FROM soportes where fk_id_log=$id_log";
$resultado2 = $conexion->query($sentencia2);
$sentencia = "DELETE FROM log where id_log=$id_log";
$resultado = $conexion->query($sentencia);
header("Location:ver_actividades.php?id_contrato=".base64_encode($id_contrato));
?>