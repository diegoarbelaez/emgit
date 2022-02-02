<?php
include("conexion.php");

//print_r($_POST);
$id_contratista = $_POST["id_contratista"];

// Cargar imagen
$vars = get_defined_vars();
extract($vars['_POST']);
extract($vars['_FILES']);
$rutafoto = filter_input(INPUT_COOKIE, 'rutafoto');
$tipo_archivo = $upload_image['type'];
$tmp_archivo = $upload_image['tmp_name'];

if ($upload_image['error'] == 0) {
    if ($tipo_archivo == 'image/png') {
        // Consultar path de la foto
        $sentencia = "SELECT foto FROM contratista WHERE id_contratista = $id_contratista";
        $resultado = $conexion->query($sentencia);
        $fila = $resultado->fetch_object();

        // Subir imagen
        $path = '../' . $fila->foto;
        move_uploaded_file($tmp_archivo, $path);
    }
}

foreach ($_POST as $nombre => $valor) {
    $sentencia = "update contratista set " . $nombre . "='" . $valor . "' where id_contratista=" . $id_contratista . PHP_EOL;
    $resultado = mysqli_query($conexion, $sentencia);
    //echo $sentencia;
    if ($resultado) {
        header("location:mi_cuenta.php?id_contratista=" . base64_encode($id_contratista));
    } else {
        mysqli_error("Error ->" . $resultado);
    }
}
