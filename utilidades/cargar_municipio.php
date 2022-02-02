<?php 
include("../conexion.php");
$id = $_POST['id']; //id del departamento para recuperar el nombre del municipio
$query = "SELECT * FROM `municipios` WHERE departamento_id = $id ORDER BY municipio ASC";
$result = mysqli_query($conexion,$query);
if(!$result){
	echo "Error ->".mysqli_error($conexion);
}
$municipio = '';
while($row = $result->fetch_array(MYSQLI_ASSOC)){
	$municipio .= "<option value='$row[id_municipio]'>$row[municipio]</option>";
}
echo $municipio;
?>
