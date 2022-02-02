<?php
include("conexion.php");
$id=$_POST["id"];
$usuario_nuevo = $_POST["usuario"];
$clave_nueva = $_POST["password"];
$dependencia = $_POST["fk_id_dependencia"];
$sentencia = "update administradores set usuario='$usuario_nuevo', password='$clave_nueva', fk_id_dependencia='$dependencia' where id='$id'";
$resultado = mysqli_query($conexion,$sentencia);
if($resultado){
    header("location:index.php");
}
else{
    //header("location:error_actualizando.php");
    echo "Error -> ".mysqli_error($conexion);
}
?>