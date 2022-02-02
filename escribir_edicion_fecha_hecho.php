<?php
include("conexion.php");
$date = $_POST["date"] . " 12:00:00";
$id_log = $_POST["id_log"];
$sentencia = "update log set fecha = '$date' where id_log = $id_log";
$resultado = mysqli_query($conexion,$sentencia);
//echo $sentencia;
header("Location: confirmacion_cambio_fecha.php");
?>