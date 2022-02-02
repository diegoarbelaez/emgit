<?php
include("conexion.php");
$usuario_nuevo = $_POST["usuario"];
$clave_nueva = $_POST["password"];
$dependencia = $_POST["fk_id_dependencia"];
$sentencia = "insert into administradores (usuario,password,fk_id_dependencia) values ('$usuario_nuevo', '$clave_nueva', $dependencia)";
//echo $sentencia;
$resultado = mysqli_query($conexion,$sentencia);
if($resultado){
    header("location:index.php");
}
else{
    //header("location:error_actualizando.php");
    echo "Error -> ".mysqli_error($conexion);
}
?>