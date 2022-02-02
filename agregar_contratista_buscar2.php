<?php
include("conexion.php");

$cedula = $_POST["cedula"];
$sentencia = "SELECT * FROM contratista_2021 where cedula = '$cedula' ";


$resultado = $conexion->query($sentencia);

if ($resultado->num_rows > 0) {
    header("Location: agregar_contratista_existente.php?cedula=".base64_encode($cedula));
    }
else {
    header("Location: agregar_contratista2.php");
}

?>