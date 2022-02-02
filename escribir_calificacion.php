<?php
include("conexion.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';
$calificacion = $_POST["calificacion"];
$id_contratista = $_POST["id_contratista"];
$id_log = $_POST["id_log"];
$retroalimentacion = $_POST["retroalimentacion"];
$sentencia = "UPDATE log set calificacion=$calificacion where id_log=$id_log";
//echo $sentencia;
$resultado = mysqli_query($conexion,$sentencia);
//Enviar el Correo de notificación, según los datos del id_contratista
$sentencia2 = "select * from log where id_log='$id_log'";
$resultado2 = mysqli_query($conexion,$sentencia2);
$fila = mysqli_fetch_object($resultado2);
$log = $fila->hecho;
$calificacion = $fila->calificacion;
switch ($calificacion){
    case 1: $estimacion = '<p style="color:red">Huy! definitivamente algo no anda bien, debes llamar al supervisor y comprender por qué no valoró tu hecho OJO!</p>'; break;
    case 2: $estimacion = '<p style="color:red">Hiciste un gran esfuerzo pero no es suficiente, parece que debes documentar mejor este hecho.... intenta de nuevo</p>';break;
    case 3: $estimacion = '<p style="color:orange">hmmm... aceptable, pero puedes mejorar, quizás argumentando mejor y presentando evidencias puede ayudarte</p>';break;
    case 4: $estimacion = '<p style="color:green">Bien hecho! casi logras la excelencia en la presentación de evidencias sobre este hecho, te invitamos a que lo perfecciones, estas cerca!</p>';break;
    case 5: $estimacion = '<p style="color:blue">En realidad haces un excelente trabajo! gracias por tu compromiso!</p>';break;
}

//HTML del email
$mensaje = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=500px, initial-scale=1.0">
    <title>El Supervisor acaba de calificarte un Hecho sobre tu contrato</title>
</head>
<body>
    <p><b>Hecho:</b></p>
    <br>
    <br>
    <p>'.$log.'</p>
    <br>
    <br>
    <p>
    <b>Calificación:</b> '.$calificacion.' estrellas
    <br>
    <br>
    '.$estimacion.'
    <br>
    <br>
    <br><b>Retroalimentación dada por el Supervisor:</b><br> '.$retroalimentacion.'<br><br>
    Ingresa a MegaReporte y revisa tu actividad
    <br>
    <br>
    Recuerda! MegaReporte hace las cosas más fáciles para ti!
    </p>
</body>
</html>';
//Trae la información del contratista para capturar el correo
$sentencia3 = "select * from contratista where id_contratista='$id_contratista'";
$resultado3 = mysqli_query($conexion,$sentencia3);
$fila3 = mysqli_fetch_object($resultado3);
$correo = $fila3->usuario;
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
$mail->addAddress($correo, 'Administrador Megareporte'); 
$mail->Subject = 'Tarea Calificada';
$mail->msgHTML($mensaje, __DIR__);
$mail->AltBody = 'Este es un texto alternativo';
$mail->addAttachment('images/sumoalequipo.png');
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    //echo "Message sent!";
}
function save_mail($mail)
{
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}
header("Location:informacion_contratista.php?id_contratista=".base64_encode($id_contratista));
