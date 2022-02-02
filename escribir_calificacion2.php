<?php
include("conexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';

//print_r($_POST);
$id_contratista = $_POST["id_contratista"];
$html = "";

foreach ($_POST as $name => $value) {
    $parametros = explode("_", $name);
    if ($parametros[0] == 'cal') {
        $id_log = $parametros[1];
        $calificacion = $value;
        $sentencia = "UPDATE log set calificacion=$calificacion where id_log=$id_log";
        $resultado = mysqli_query($conexion, $sentencia);
        // Prepara el reporte HTML para agregar al correo que va a salir
        $sentencia2 = "select * from log where id_log='$id_log'";
        $resultado2 = mysqli_query($conexion, $sentencia2);
        $fila = mysqli_fetch_object($resultado2);
        $log = $fila->hecho;
        $calificacion = $fila->calificacion;
        switch ($calificacion) {
            case 1:
                $estimacion = '<p class="rojo" >Huy! definitivamente algo no anda bien, debes llamar al supervisor y comprender por qué no valoró tu hecho OJO!</p>';
                break;
            case 2:
                $estimacion = '<p class="rojo">Hiciste un gran esfuerzo pero no es suficiente, parece que debes documentar mejor este hecho.... intenta de nuevo</p>';
                break;
            case 3:
                $estimacion = '<p class="naranja">hmmm... aceptable, pero puedes mejorar, quizás argumentando mejor y presentando evidencias puede ayudarte</p>';
                break;
            case 4:
                $estimacion = '<p class="verde">Bien hecho! casi logras la excelencia en la presentación de evidencias sobre este hecho, te invitamos a que lo perfecciones, estas cerca!</p>';
                break;
            case 5:
                $estimacion = '<p class="azul">En realidad haces un excelente trabajo! gracias por tu compromiso!</p>';
                break;
        }
        $estrellas_amarillas = $calificacion;
        $estrellas_html = "";
        for ($i = 0; $i < $estrellas_amarillas; $i++) {
            $estrellas_html.= '<span class="float-left"><img src="http://www.alcaldiaparatodos.com/sevilla/megainforme/images/estrella_amarilla.png"></span>';
        }
        $estrellas_blancas = 5 - $estrellas_amarillas;
        for ($i = 0; $i < $estrellas_blancas; $i++) {
            $estrellas_html.= '<span class="float-left"><img src="http://www.alcaldiaparatodos.com/sevilla/megainforme/images/estrella_blanca.png"></span>';
        }
        $html .= '
        <table class="bg_white" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr style="border-top: 2px solid rgba(0,0,0,.05);">
                <td valign="middle" width="80%" style="text-align:left; padding: 0 2.5em;">
                    <div class="product-entry">
                        <div class="text">
                            <h3>Hecho Reportado:</h3>
                            <p>' . $log . '</p>
                        </div>
                    </div>
                </td>
                <td valign="middle" width="20%" style="text-align:left; padding: 0 2.5em;">
                    <span class="price" style="color: #000; font-size: 20px;">Calificación: ' . $calificacion .' Estrellas<br>'. $estrellas_html. '<br>'.$estimacion. '</span>
                </td>
            </tr>
        ';
    } else if ($parametros[0] == 'retro') {
        //echo "retroalimentación id_log " . $parametros[1] . "->" . $value;
        //echo "<br>";
        $retroalimentacion = $value;
        $html .= '
            <tr>
                <td valign="middle" width="80%" style="padding: 0 2.5em;">
                    <div class="product-entry">
                        <div class="text">
                            <h3>Retroalimentación:</h3>
                            <p style="color:green">' . $retroalimentacion . '</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        ';
    } else {
        //No hace nada porque lo que está recibiendo es el ID del contratista
    }
}

/*$sentencia = "UPDATE log set calificacion=$calificacion where id_log=$id_log";
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
}*/

//HTML del email
$mensaje = '<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldnt be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldnt be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/4f4fd81a40.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- CSS Reset : BEGIN -->
    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }
        .rojo{
            color:red;
            font-size:10px;
        }
        .naranja{
            color:orange;
            font-size:10px;
        }
        .verde{
            color:green;
            font-size:10px;
        }
        .azul{
            color:blue;
            font-size:10px;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],
        /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesnt work, add a .g-img class to any image in question. */
        img.g-img+div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size youd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u~div .email-container {
                min-width: 320px !important;
            }
        }

        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u~div .email-container {
                min-width: 375px !important;
            }
        }

        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u~div .email-container {
                min-width: 414px !important;
            }
        }
    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>
        .primary {
            background: #17bebb;
        }

        .bg_white {
            background: #ffffff;
        }

        .bg_light {
            background: #f7fafa;
        }

        .bg_black {
            background: #000000;
        }

        .bg_dark {
            background: rgba(0, 0, 0, .8);
        }

        .email-section {
            padding: 2.5em;
        }

        /*BUTTON*/
        .btn {
            padding: 10px 15px;
            display: inline-block;
        }

        .btn.btn-primary {
            border-radius: 5px;
            background: #17bebb;
            color: #ffffff;
        }

        .btn.btn-white {
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }

        .btn.btn-white-outline {
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }

        .btn.btn-black-outline {
            border-radius: 0px;
            background: transparent;
            border: 2px solid #000;
            color: #000;
            font-weight: 700;
        }

        .btn-custom {
            color: rgba(0, 0, 0, .3);
            text-decoration: underline;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Work Sans", sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }

        body {
            font-family: "Work Sans", sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0, 0, 0, .4);
        }

        a {
            color: #17bebb;
        }

        table {}

        /*LOGO*/

        .logo h1 {
            margin: 0;
        }

        .logo h1 a {
            color: #17bebb;
            font-size: 24px;
            font-weight: 700;
            font-family: "Work Sans", sans-serif;
        }

        /*HERO*/
        .hero {
            position: relative;
            z-index: 0;
        }

        .hero .text {
            color: rgba(0, 0, 0, .3);
        }

        .hero .text h2 {
            color: #000;
            font-size: 34px;
            margin-bottom: 15px;
            font-weight: 300;
            line-height: 1.2;
        }

        .hero .text h3 {
            font-size: 24px;
            font-weight: 200;
        }

        .hero .text h2 span {
            font-weight: 600;
            color: #000;
        }


        /*PRODUCT*/
        .product-entry {
            display: block;
            position: relative;
            float: left;
            padding-top: 20px;
        }

        .product-entry .text {
            width: 100%;
            padding-left: 20px;
        }

        .product-entry .text h3 {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .product-entry .text p {
            margin-top: 0;
        }

        .product-entry img,
        .product-entry .text {
            float: left;
        }

        ul.social {
            padding: 0;
        }

        ul.social li {
            display: inline-block;
            margin-right: 10px;
        }

        /*FOOTER*/

        .footer {
            border-top: 1px solid rgba(0, 0, 0, .05);
            color: rgba(0, 0, 0, .5);
        }

        .footer .heading {
            color: #000;
            font-size: 20px;
        }

        .footer ul {
            margin: 0;
            padding: 0;
        }

        .footer ul li {
            list-style: none;
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: rgba(0, 0, 0, 1);
        }


        @media screen and (max-width: 500px) {}
    </style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        </div>
        <div style="max-width: 1024px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                    <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td class="logo" style="text-align: left;">
                                    <h1><a href="#">Reporte de Calificación MegaInforme</a></h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                <tr>
                    <td valign="middle" class="hero bg_white" style="padding: 2em 0 2em 0;">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="padding: 0 2.5em; text-align: left;">
                                    <div class="text">
                                        <h2>El supervisor de tu contrato ha calificado los hechos sobre tus actividades</h2>
                                        <h3>Aquí encontrarás una retroalimentación</h3>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->
                <tr>
' . $html . '
<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
<tr>
    <td valign="middle" class="bg_light footer email-section">
        <table>
            <tr>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td style="text-align: left; padding-right: 10px;">
                                <h3 class="heading">Recuerda</h3>
                                <p>Si alimentas día a día tus informes, tendrás la mejor sustentación en tus contratos</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr><!-- end: tr -->
<tr>
    <td class="bg_white" style="text-align: center;">
        <p>MegaInforme hace tus informes por ti</a></p>
    </td>
</tr>
</table>

</div>
</center>
</body>

</html>';
////INICIO MENSAJE
////FIN DE MENSAJE
//Trae la información del contratista para capturar el correo
$sentencia3 = "select * from contratista where id_contratista='$id_contratista'";
$resultado3 = mysqli_query($conexion, $sentencia3);
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
$mail->Username = "plataformas.sevilla.valle@gmail.com";
$mail->Password = "Kuzavy46";
$mail->CharSet = 'UTF-8';
$mail->setFrom('plataformas.sevilla.valle@gmail.com', 'Administrador Megareporte');
$mail->addReplyTo('plataformas.sevilla.valle@gmail.com', 'Administrador Megareporte');
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

//echo $mensaje;
header("Location:informacion_contratista2.php?id_contratista=".base64_encode($id_contratista));
