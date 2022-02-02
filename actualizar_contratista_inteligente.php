<?php
include("conexion.php");

//print_r($_POST);
$id_contratista = $_POST["id_contratista"];

foreach($_POST as $nombre => $valor){
    $sentencia = "update contratista set ".$nombre."='".$valor."' where id_contratista=".$id_contratista.PHP_EOL;
    $resultado = mysqli_query($conexion,$sentencia);
    //echo $sentencia;
    if($resultado){
       header("location:editar_contratista.php?id_contratista=".base64_encode($id_contratista));
    }
    else {
        mysqli_error("Error ->".$resultado);
    }
}
