<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php
include("conexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';

//Variables ingresando

$actividad = $_POST["actividad"];
$log = $_POST["log"];
//$foto =$_POST["foto"];
$id_contratista = $_SESSION["id_contratista"];
//capturar el id de contrato, se necesita abajo en el header(Location)
$sentencia3 = "select * from contratista where id_contratista=$id_contratista";
$resultado3 = $conexion->query($sentencia3);
$fila3 = $resultado3->fetch_object();
$id_contrato = $fila3->fk_id_contrato;



if ($_FILES['foto']['size'] == 0 || $_FILES['foto']['error'] == 4 || empty($_FILES['foto'])) {
    //echo "no venia archivo";
    $target_file = '';
    // Inserta los datos son Soporte, sin evidencia
    $sentencia = "INSERT INTO log (hecho,fk_id_actividad,fk_id_contratista) values ('$log',$actividad,$id_contratista)";
    if (isset($_POST["fecha_reporte"])) {
        $fecha_reporte = $_POST["fecha_reporte"] . ' 12:00:00';
        $sentencia = "INSERT INTO log (hecho,fk_id_actividad,fk_id_contratista,fecha) values ('$log',$actividad,$id_contratista,'$fecha_reporte')";
    }
    $conexion->query($sentencia);
    //echo $sentencia;
    //Enviar correo al supervisor del contrato
    enviarCorreo($conexion, $id_contrato, $fila3, $log, $target_file);
    header("Location:confirmacion_log.php?id_contrato=" . base64_encode($id_contrato));
} else {
    $target_dir = "evidencias/" . $fila3->nombres . "/";
    $carpeta = $target_dir;
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }
    $target_file = $carpeta . basename($_FILES["foto"]["name"]);
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
        $errors[] = "Lo sentimos, archivo ya existe. Cambia el nombre del archivo";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["foto"]["size"] > 9524288) {
        $errors[] = "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 5 MB";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt"  && $imageFileType != "zip"
    ) {
        $errors[] = "Lo sentimos, sólo archivos JPG, JPEG, PNG, GIF, DOCX, XLSX, PDF  son permitidos.";
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
        header("Location:error_carga_log.php?id_contrato=" . base64_encode($id_contrato) . "&error=$errors[0]");
    }
    if (isset($messages)) {
        // Inserta los datos si todo está OK
        //ACTIVADO TEMPORALMENTE PARA PERMITIR A LOS CONTRATISTAS SUBIR HECHOS EN DIFERENTE FECHA
        $sentencia = "INSERT INTO log (hecho,fk_id_actividad,fk_id_contratista) values ('$log',$actividad,$id_contratista)";
        if (isset($_POST["fecha_reporte"])) {
            $fecha_reporte = $_POST["fecha_reporte"] . ' 12:00:00';
            $sentencia = "INSERT INTO log (hecho,fk_id_actividad,fk_id_contratista,fecha) values ('$log',$actividad,$id_contratista,'$fecha_reporte')";
        }
        //echo $sentencia;
        if ($conexion->query($sentencia) === TRUE) {
            //echo "Agregado correctamente a la BD";
            $id_insertado = $conexion->insert_id;
        } else {
            // echo "Error: " . $sentencia . "<br>" . $conexion->error;
        }
        $sentencia2 = "INSERT INTO soportes (ruta,fk_id_log) values ('$target_file',$id_insertado)";
        //echo $sentencia2;
        if ($conexion->query($sentencia2) === TRUE) {
            //echo "Agregado correctamente a la BD";
        } else {
            //echo "Error: " . $sentencia . "<br>" . $conexion->error;
        }
        enviarCorreo($conexion, $id_contrato, $fila3, $log, $target_file);
        header("Location:confirmacion_log.php?id_contrato=" . base64_encode($id_contrato));
    }
}

function enviarCorreo($conexion, $id_contrato, $fila3, $log, $target_file)
{
    //Enviar correo al supervisor del contrato
    $sentencia4 = "select * from contrato where id_contrato = $id_contrato";
    //echo $sentencia4;
    $resultado4 = $conexion->query($sentencia4);
    //Enviar el Correo de notificación, según los datos del id_contratista
    $fila4 = $resultado4->fetch_object();
    $correo_supervisor1 = $fila4->correo_supervisor1;
    $correo_supervisor2 = $fila4->correo_supervisor2;
    $correo_supervisor1 = "diegoarbelaez.co@gmail.com";
    $correo_supervisor2 = "diegoking@hotmail.com";
    //echo $correo_supervisor;
    //$correo_supervisor = "diegoarbelaez.co@gmail.com";
    //Obtengo el nombre del contratista
    $nombre_contratista = $fila3->nombres . ' ' . $fila3->apellidos;

    //HTML del email
    $mensaje = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=500px, initial-scale=1.0">
                    <title>El Contratista ' . $nombre_contratista . ' acaba de agregar un Hecho sobre su contrato</title>
                </head>
                <body>
                    <p>Hecho:</p>
                    <br>
                    <br>
                    <p>' . $log . '</p>
                    <br>
                    <br>
                    <p>
                    Ya puedes calificar este hecho
                    <br>
                    <br>
                    Recuerda, si calificas rápido, rápidamente los contratistas tendrán retroalimentación sobre sus hechos reportados
                    <br>
                    <br>
                    Ingresa a MegaReporte y revisa tu actividad
                    <br>
                    <br>
                    Recuerda! MegaReporte hace las cosas más fáciles para ti!
                    </p>
                    <p> Se adjuntan las evidencias </p>
                </body>
                </html>';
    //PHP Mailer
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "sumoalequipo.sevilla@gmail.com";
    $mail->Password = "Kuzavy46";
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('mega.reporte.col@gmail.com', 'Administrador Megareporte');
    $mail->addReplyTo('mega.reporte.col@gmail.com', 'Administrador Megareporte');
    $mail->addAddress($correo_supervisor1, 'Administrador Megareporte');
    $mail->addCC($correo_supervisor2, 'Administrador Megareporte');
    $mail->Subject = 'Nuevo hecho reportado por ' . $nombre_contratista;
    $mail->msgHTML($mensaje, __DIR__);
    $mail->AltBody = 'Este es un texto alternativo';
    $mail->addAttachment($target_file);
    /*if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        //echo "Message sent!";
    }*/
}
function save_mail($mail)
{
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}

?>