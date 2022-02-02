<?php
include("conexion.php");
$id_rubro = base64_decode(filter_input(INPUT_GET, 'id_rubro'));

$sentencia = "DELETE FROM codigos where id_codigo = $id_rubro";
$conexion->query($sentencia);

header("Location:editar_rubro.php");
