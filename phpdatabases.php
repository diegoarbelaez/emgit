<?php
//leer datos desde la BD
$sentencia = "SELECT * FROM dependencia order by id_dependencia desc";
$resultado = $conexion->query($sentencia);
if ($resultado) {
    while ($fila = $resultado->fetch_object()) {
        echo '<option>' . $fila->nombre . '</option>';
    }
}


//Sentencia para agregar registros a la BD

$sentencia = "INSERT INTO `contrato`(`numero`, `nombre`, `fecha_inicio`, `fecha_fin`, `objeto`, `valor`, `fk_id_dependencia`) VALUES ('$numero','$nombre','$fecha_inicio','$fecha_fin','$objeto',$valor,$dependencia)";
echo $sentencia;
if ($conexion->query($sentencia) === TRUE) {
  echo "Agregado correctamente a la BD";
} else {
  echo "Error: " . $sentencia . "<br>" . $conexion->error;
}
$conexion->close();

?>
