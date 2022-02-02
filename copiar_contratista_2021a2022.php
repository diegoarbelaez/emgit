<?php
include("conexion.php");
$id_contratista = $_POST["id_contratista"];
$sentencia_copiar = "INSERT INTO contratista SELECT * from contratista_2021 where id_contratista = $id_contratista";
$resultado = mysqli_query($conexion, $sentencia_copiar);
if (!$resultado) {
    echo "error copiando contratista" . mysqli_error($conexion);
} else {
    //echo "<br>insertado con exito";
    $sentencia_update = "update contratista set fk_id_contrato = 9999 where id_contratista=$id_contratista";
    $resultado_update = mysqli_query($conexion, $sentencia_update);
    if (!$resultado_update) {
        echo "error actualizando contratista al contrato 9999 por default";
    } else {
        //echo "<br>actualizado con éxito";
        //Inserta los hijos
        $sentencia_hijos = "INSERT into hijos select * from hijos_2021 where fk_id_contratista = $id_contratista";
        $resultado_hijos = mysqli_query($conexion, $sentencia_hijos);
        if (!$resultado_hijos) {
            echo "error insertando los hijos del contratista";
        } else {
            header("Location:confirmacion_copia_contratista.php?id_contratista=".base64_encode($id_contratista));      
        }
    }
}

//Inserta en Tabla Contratista Y Asocia el contrato default 9999




//Inserta los Hijos
