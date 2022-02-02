<?php
include("../conexion.php");
$id_contratista = $_POST["id_contratista"];
$sentencia = "select contratista.departamento as departamento_contratista, departamentos.departamento as nombre_departamento from contratista inner join departamentos on contratista.departamento = departamentos.id_departamento where contratista.id_contratista =$id_contratista";
$resultado = mysqli_query($conexion,$sentencia);
$fila = mysqli_fetch_assoc($resultado);
$departamento_recuperado = $fila["departamento_contratista"];
$nombre_departamento_recuperado =$fila["nombre_departamento"];
$query = 'SELECT * FROM `departamentos` ORDER BY departamento ASC';
$result = $conexion->query($query);
$departamento = '<option selected="selected" value="'.$departamento_recuperado.'">'.$nombre_departamento_recuperado.'</option>';
while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $departamento .= "<option value='$row[id_departamento]'>$row[departamento]</option>";
}
echo $departamento;
?>