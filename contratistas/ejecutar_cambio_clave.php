<?php
include("conexion.php");
$id_contratista = $_POST["id_usuario"];
$sentencia = "select * from contratista where id_contratista=$id_contratista";
$resultado = mysqli_query($conexion,$sentencia);
$fila = mysqli_fetch_assoc($resultado);

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
                            <form action="recuperar_clave.php" method="POST">
                                <div class="form-group">
                                    <label class="form-label" for="title">Usuario</label>
                                    <input id="usuario" name="correo" type="text" class="form-control" readonly value="<?php echo $fila["usuario"] ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="title">Escriba su nueva contraseña</label>
                                    <input id="pass" type="password" name="password" class="form-control" placeholder="contraseña" />
                                </div>
                                <div>
                                    <div class="float-right"><button type="submit" id="btn-login" name="btn-login" class="btn btn-success" id="showtoast">CAMBIAR CONTRASEÑA</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container h-100"> -->

</body>

</html>