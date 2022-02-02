<?php
include("conexion.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';
$correo = $_POST["correo"];
$sentencia = "select * from contratista where usuario='$correo' and activado = 1";
$resultado = mysqli_query($conexion, $sentencia);
if (mysqli_num_rows($resultado)>0) {
    // Encontró el usuario, enviarle el correo
    $fila = mysqli_fetch_assoc($resultado);
    //HTML del email
    $mensaje = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=500px, initial-scale=1.0">
            <title>Solicitud de Cambio de contraseña para tu acceso a MegaInforme</title>
        </head>
        <body>
            <p><img src="https://mipgenlinea.com/candelaria/contratistas/assets/images/logo-inverse.png>"</p>
            <p><b>Hemos recibido una solicitud de cambio de contraseña para el acceso a MegaInforme</b></p>
            <p>Si has sido tu el que ha solicitado el cambio de clave, por favor haz click aqui -> 
            <form action="https://mipgenlinea.com/candelaria/contratistas/ejecutar_cambio_clave.php" method="POST">
            <button type="submit">CAMBIAR</button>
            <input type="hidden" name="id_usuario" value="'.$fila["id_contratista"].'">
            </form>
            </p>
            <p>Si por el contrario, consideras que ha sido un error o no lo has solicitado, simplemente ignora este mensaje</p>
            <p>Equipo de Soporte de MegaInforme</p>
            </p>
        </body>
        </html>';
    //Trae la información del contratista para capturar el correo
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
    $mail->Subject = 'Solicitud Cambio de Clave';
    $mail->msgHTML($mensaje, __DIR__);
    $mail->AltBody = 'Este es un texto alternativo';
    $mail->addAttachment('');
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        //Presenta el Resultado
?>
        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta http-equiv="Content-Language" content="en">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Ingreso a MegaReporte - Bienvenidos
            </title>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
            <meta name="description" content="Notifications represent one of the best ways to give feedback for various users actions.">
            <meta name="msapplication-tap-highlight" content="no">
            <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
            <link href="./main.css" rel="stylesheet">
        </head>

        <body>
            <div class="container h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <center><img src="images/logo_encabezado.png"></center><br><br>
                        <div class="main-card card">
                            <div class="card-body">
                                <img src="assets/images/logo-inverse.png">
                                <br>
                                <br>
                                <div>
                                    <div class="form-group">
                                        <p>A tu dirección de correo registrada hemos enviado un link para recuperar tu contraseña</p>
                                    </div>
                                    <div>
                                        <div class="float-right"><a href="index.php" id="btn-login" name="btn-login" class="btn btn-success" id="showtoast">REGRESAR</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="container h-100"> -->

        </body>

        </html>
    <?php
    }
} else {
    // No encontró el correo electrónico
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Ingreso a MegaReporte - Bienvenidos
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="Notifications represent one of the best ways to give feedback for various users actions.">
        <meta name="msapplication-tap-highlight" content="no">
        <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
        <link href="./main.css" rel="stylesheet">
    </head>

    <body>
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <center><img src="images/logo_encabezado.png"></center><br><br>
                    <div class="main-card card">
                        <div class="card-body">
                            <img src="assets/images/logo-inverse.png">
                            <br>
                            <br>
                            <div>
                                <div class="form-group">
                                    <p>No hemos encontrado una cuenta con ese correo, debes validar nuevamente o comunicarte con el enlace de contratación</p>
                                </div>
                                <div>
                                    <div class="float-right"><a href="index.php" id="btn-login" name="btn-login" class="btn btn-success" id="showtoast">REGRESAR</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container h-100"> -->

    </body>

    </html>
<?php
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