<?php

include("conexion.php");
/*
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$sentencia = "INSERT INTO tareas (nombre,descripcion) values ('$nombre', '$descripcion')";
$sentencia = "INSERT into actividades(descripcion,fk_id_contrato) values ('$actividad',$fk_id_contrato)";
$resultado = mysqli_query($con,$sentencia) or die($con);*/

/*
$actividad = $_POST["descripcion"];
$fk_id_contrato =$_POST["fk_id_contrato"];
$sentencia = "INSERT into actividades(descripcion,fk_id_contrato) values ('$actividad',$fk_id_contrato)";
$conexion->query($sentencia);
echo "Agregado correctamente a la base de datos";*/

$nombres_hijo = $_POST["nombres_hijo"];
$apellidos_hijo = $_POST["apellidos_hijo"];
$tipo_documento_hijo = $_POST["tipo_documento_hijo"];
$numero_documento_hijo = $_POST["numero_documento_hijo"];
$fecha_nacimiento_hijo = $_POST["fecha_nacimiento_hijo"];
$sexo = $_POST["sexo"];
$id_contratista = $_POST["id_contratista"];

$sentencia = "INSERT into hijos (nombres, apellidos,fecha_nacimiento,tipo_documento,numero_documento,sexo,fk_id_contratista) values ('$nombres_hijo','$apellidos_hijo','$fecha_nacimiento_hijo','$tipo_documento_hijo','$numero_documento_hijo','$sexo',$id_contratista)";
$resultado = mysqli_query($conexion, $sentencia);
if ($resultado) {
    echo "Agregado correctamente a la base de datos";
    //echo "Sentencia ->" . $sentencia;
} else {
    echo "Error" . mysqli_error($conexion);
}
