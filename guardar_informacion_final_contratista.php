<?php

include("conexion.php");

/*
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$cedula = $_POST["cedula"];
$telefono = $_POST["telefono"];
$nivel_educativo = $_POST["nivel_educativo"];
$fk_id_contrato = $_POST["fk_id_contrato"];
$fk_id_dependencia = $_POST["fk_id_dependencia"];
$correo = $_POST["correo"];
$password = $_POST["password"];



$fecha_expedicion = $_POST["fecha_expedicion"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$sexo = $_POST["sexo"];
$grupo_sanguineo = $_POST["grupo_sanguineo"];
$direccion_residencia = $_POST["direccion_residencia"];
$tipo_vivienda = $_POST["tipo_vivienda"];
$barrio = $_POST["barrio"];
$telefono_emergencias = $_POST["telefono_emergencias"];
$estado_civil = $_POST["estado_civil"];
$numero_hijos = $_POST["numero_hijos"];
$enfermedad = $_POST["enfermedad"];
$tratamiento = $_POST["tratamiento"];
$alergias = $_POST["alergias"];*/



$correo = $_POST["correo"];
$password = $_POST["password"];
$id_contratista = $_POST["id_contratista"];

$sentencia = "update contratista set 
usuario = '$correo',
password = '$password'
WHERE id_contratista=$id_contratista";

if ($conexion->query($sentencia) === TRUE) {
    header("Location:registro_guardado.php");
} else {
    echo "Error: " . $sentencia . "<br>" . $conexion->error;
}


//$foto = $_POST["foto"];

//echo count($_FILES["file0"]["name"]);exit;
//var_dump($_POST);
//var_dump($_FILES);

/*

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["foto"]["type"])) {
    //var_dump($_POST);
    //echo "Entró";
    $target_dir = "fotos/";
    $carpeta = $target_dir;
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    $target_file = $carpeta . rand(1000, 9999) . '-' . basename($_FILES["foto"]["name"]); //. rand(1000,9999); // Se pone el aleatorio, para que no genere error si el archivo ya existe
    //echo "Nombre del Archivo ->".$target_file;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            $errors[] = "El archivo es una imagen - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $errors[] = "El archivo no es una imagen.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $errors[] = "Lo sentimos, archivo ya existe.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["foto"]["size"] > 5524288) {
        $errors[] = "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 5 MB";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $errors[] = "Lo sentimos, sólo archivos JPG, JPEG, PNG & GIF  son permitidos.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errors[] = "Lo sentimos, tu archivo no fue subido.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $messages[] = "El Archivo ha sido subido correctamente.";
        } else {
            $errors[] = "Lo sentimos, hubo un error subiendo el archivo.";
        }
    }

    if (isset($errors)) {
        $mensajes = '';
        foreach ($errors as $error) {
            $mensajes = $mensajes . "<p>$error</p>";
            //echo "<p>$error</p>";
        }
        header("location:error_registro.php");
    }

    if (isset($messages)) {
        // Inserta los datos si todo está OK
        //$sentencia = "INSERT INTO `contratista`(`cedula`, `nombres`, `apellidos`, `telefono`, `nivel_educativo`, `foto`, `fk_id_dependencia`, `fk_id_contrato`,usuario,password) VALUES ('$cedula','$nombres','$apellidos','$telefono','$nivel_educativo','$target_file',$fk_id_dependencia,$fk_id_contrato,'$correo','$password')";
        $sentencia = "INSERT INTO `contratista`(
            `cedula`,
            `nombres`, 
            `apellidos`, 
            `telefono`, 
            `nivel_educativo`,
            `foto`, 
            `fk_id_dependencia`, 
            `fk_id_contrato`,
            usuario,
            password,
            fecha_expedicion,
            fecha_nacimiento,
            sexo,
            grupo_sanguineo,
            direccion_residencia,
            tipo_vivienda,
            barrio,
            telefono_emergencias,
            estado_civil,
            numero_hijos,
            enfermedad,
            tratamiento,
            alergias) 
            VALUES (
                '$cedula',
                '$nombres',
                '$apellidos',
                '$telefono',
                '$nivel_educativo',
                '$target_file',
                $fk_id_dependencia,
                $fk_id_contrato,
                '$correo',
                '$password',
                '$fecha_expedicion',
                '$fecha_nacimiento',
                '$sexo',
                '$grupo_sanguineo',
                '$direccion_residencia',
                '$tipo_vivienda',
                '$barrio',
                '$telefono_emergencias',
                '$estado_civil',
                '$numero_hijos',
                '$enfermedad',
                '$tratamiento',
                '$alergias'
                )";
        
        //echo $sentencia;
        if ($conexion->query($sentencia) === TRUE) {
            //echo "Agregado correctamente a la BD";
            
        } else {
            echo "Error: " . $sentencia . "<br>" . $conexion->error;
        }
        $conexion->close();
    }
}

*/

?>