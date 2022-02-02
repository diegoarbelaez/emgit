<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>
<?php
$id_contratista = $_SESSION["id_contratista"];
$clave = $_POST["clave_actual"];
$nueva_clave1 = $_POST["nueva_clave1"];
$nueva_clave2 = $_POST["nueva_clave2"];

$sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
$id_contrato = $fila->id_contrato;
?>
<link href="estilos_timeline.css" rel="stylesheet">

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Información del Contratista
                        <div class="page-title-subheading">Información perteneciente a un contratista
                        </div>
                    </div>
                    <div>
                        <img width="80" class="rounded-circle" style="margin-left: 15px;" src="<?php echo $fila->foto; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <?php
        if ($clave == $fila->password) {
            if ($nueva_clave1 == $nueva_clave2) {
                //Cambiar la contraseña
                $sentencia_update = "update contratista set password = '$nueva_clave1' where id_contratista = $id_contratista";
                $resultado_update = $conexion->query($sentencia_update);
                if ($resultado_update) {
                    //Confirmación de cambio de contraseña
        ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Cambiar Clave de acceso a MegaInforme</h5>
                                    <br>
                                    <div class="card-border mb-3 card card-body border-success">
                                        <h5 class="card-title">Cambio de contraseña exitoso</h5>Ya puedes iniciar sesión con tu nueva contraseña
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php

                }
            } else {
                //Clave nueva no coincide
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Cambiar Clave de acceso a MegaInforme</h5>

                                <div class="card-border mb-3 card card-body border-danger">
                                    <h5 class="card-title">No coinciden las contraseñas nuevas</h5>Debes confirmar que ingresaste y confirmaste bien la nueva contraseña
                                </div>

                                <form action="registrar_cambio_clave.php" method="POST">
                                    <div class="position-relative form-group row">
                                        <div class="col-md-6">
                                            <label class="">Contraseña Actual</label>
                                            <input name="clave_actual" id="telefono" placeholder="Digite la contraseña actual" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="position-relative form-group row">
                                        <div class="col-md-6">
                                            <label class="">Nueva Contraseña</label>
                                            <input name="nueva_clave1" id="telefono" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="position-relative form-group row">
                                        <div class="col-md-6">
                                            <label class="">Confirmar Contraseña Nueva</label>
                                            <input name="nueva_clave2" id="telefono" type="password" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">CAMBIAR CONTRASEÑA</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
        } else {
            //Clave incorrecta
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Cambiar Clave de acceso a MegaInforme</h5>

                            <div class="card-border mb-3 card card-body border-danger">
                                <h5 class="card-title">Contraseña incorrecta</h5>La contraseña ingresada no es la correcta
                            </div>

                            <form action="registrar_cambio_clave.php" method="POST">
                                <div class="position-relative form-group row">
                                    <div class="col-md-6">
                                        <label class="">Contraseña Actual</label>
                                        <input name="clave_actual" id="telefono" placeholder="Digite la contraseña actual" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="position-relative form-group row">
                                    <div class="col-md-6">
                                        <label class="">Nueva Contraseña</label>
                                        <input name="nueva_clave1" id="telefono" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="position-relative form-group row">
                                    <div class="col-md-6">
                                        <label class="">Confirmar Contraseña Nueva</label>
                                        <input name="nueva_clave2" id="telefono" type="password" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">CAMBIAR CONTRASEÑA</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <?php include("pie.php"); ?>
    </div>