<?php
include("conexion.php");
$id_tarea_eliminar = $_POST["id_tarea_eliminar"];
$sentencia = "DELETE FROM pagos WHERE id_pago=$id_tarea_eliminar";
$resultado = mysqli_query($conexion,$sentencia) or die($conexion);
echo "Borrado correctamente de BD la tarea ".$id_tarea_eliminar;
?>