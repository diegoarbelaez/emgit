<?php
include("conexion.php");
$fk_id_contratista = $_POST["id_contratista"];
    $sentencia = "SELECT * FROM hijos WHERE fk_id_contratista=$fk_id_contratista";
    //echo $sentencia;
    $resultado = mysqli_query($conexion,$sentencia);
    if(!$resultado){
        die("Error en Query". mysqli_error($conexion));
    }
    $json = array();
    while($row=mysqli_fetch_array($resultado)){
        $json[] = array ( // llenamos el Array con objetos de la base de datos
            'id_hijo' => $row["id_hijo"],
            'nombres' => $row["nombres"],
            'apellidos' => $row["apellidos"],
            'fecha_nacimiento' => $row["fecha_nacimiento"],
            'tipo_documento' => $row["tipo_documento"],
            'numero_documento' => $row["numero_documento"],
            'sexo' => $row["sexo"]
        );
    }
    $jsonstring=json_encode($json); // Codifica los valores en formato JSON
    echo $jsonstring;
?>