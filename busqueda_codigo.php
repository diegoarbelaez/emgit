<?php
include("conexion.php");

$html = '';
$key = $_POST['codigo'];

$sentencia = "select * from codigos where codigo like '%" . $key . "%' limit 3";

$result = $conexion->query($sentencia);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<div><a class="suggest-element" data="' . $row['codigo'] . '" id="' . $row['id_codigo'] . '">' . $row['codigo'] . " - " . $row['descripcion'] . '</a></div>';
    }
}
echo $html;
