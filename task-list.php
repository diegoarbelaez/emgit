<?php
include("conexion.php");
    $sentencia = "SELECT * FROM actividades";
    //echo $sentencia;
    $resultado = mysqli_query($conexion,$sentencia);
    if(!$resultado){
        die("Error en Query". mysqli_error($conexion));
    }
    $json = array();
    while($row=mysqli_fetch_array($resultado)){
        $json[] = array ( // llenamos el Array con objetos de la base de datos
           
            'descripcion' => $row["descripcion"]
            
        );
    }
    $jsonstring=json_encode($json); // Codifica los valores en formato JSON
    echo $jsonstring;
?>