<?php
include("conexion.php");
$id=$_GET["id"];
$sentencia = "delete from administradores where id=$id";
//echo $sentencia;
$resultado = mysqli_query($conexion,$sentencia);
header("location:index.php");
?>