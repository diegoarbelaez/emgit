<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "megareporte_candelaria";
$conexion = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conexion->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
}
?>