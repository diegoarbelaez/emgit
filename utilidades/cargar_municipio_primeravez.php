<?php 
include("../conexion.php");
$id_contratista = $_POST["id_contratista"]; // id del contratista para recuerar los datos del contratista
$sentencia = "select contratista.municipio as municipio_contratista, contratista.departamento as departamento, municipios.municipio as nombre_municipio from contratista inner join municipios on contratista.municipio = municipios.id_municipio where contratista.id_contratista =$id_contratista";
$resultado = mysqli_query($conexion,$sentencia);
$fila = mysqli_fetch_assoc($resultado);
$departamento = $fila ["departamento"];
$municipio_recuperado = $fila["municipio_contratista"];
$nombre_municipio_recuperado =$fila["nombre_municipio"];
$query = "SELECT * FROM `municipios` WHERE departamento_id = $departamento ORDER BY municipio ASC";
$result = mysqli_query($conexion,$query);
if(!$result){
	echo "Error ->".mysqli_error($conexion);
}
$municipio = '<option selected="selected" value="'.$municipio_recuperado.'">'.$nombre_municipio_recuperado.'</option>';
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$municipio .= "<option value='$row[id_municipio]'>$row[municipio]</option>";
}
echo $municipio;
?>
