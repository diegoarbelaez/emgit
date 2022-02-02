<?php

include("conexion.php");
/*
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$sentencia = "INSERT INTO tareas (nombre,descripcion) values ('$nombre', '$descripcion')";
$sentencia = "INSERT into actividades(descripcion,fk_id_contrato) values ('$actividad',$fk_id_contrato)";
$resultado = mysqli_query($con,$sentencia) or die($con);*/


$actividad = $_POST["descripcion"];
$fk_id_contrato =$_POST["fk_id_contrato"];
$sentencia = "INSERT into actividades(descripcion,fk_id_contrato) values ('$actividad',$fk_id_contrato)";
$conexion->query($sentencia);
echo "Agregado correctamente a la base de datos";



?>