<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

$numero_contrato = $_POST["numero_contrato"];
$sentencia = "select * from otrosi inner join contrato on contrato.id_contrato=otrosi.fk_id_contrato where contrato.numero='$numero_contrato'";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_assoc($resultado);

?>
<!-- Logica de inserción en la base de datos usando AJAX -->


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Eliminar Otrosi
                        <div class="page-title-subheading">Eliminar un Otrosí de un contrato
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <?php
        if (mysqli_num_rows($resultado) > 0) {
            if ($_SESSION['user'] == 'jariasduran@hotmail.com') {
        ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Eliminar Otrosí</h5>
                                <form method="POST" action="eliminar_pago_otrosi3.php">
                                    <div class="position-relative form-group">
                                        <br><b>Datos encontrados:</b><br><br>
                                        <b>Número de Contrato: </b><?php echo $fila["numero"] ?><br>
                                        <b>Nombre del Contrato: </b><?php echo $fila["nombre"] ?><br>
                                        <b>Valor del Otrosí: </b>$<?php echo number_format($fila["monto_otrosi"]) ?><br>
                                    </div>
                                    <input type="hidden" name="id_contrato" value="<?php echo $fila["id_contrato"] ?>">
                                    <input type="hidden" name="id_otrosi" value="<?php echo $fila["id_otrosi"] ?>">
                                    <button class="mt-1 btn btn-danger">ELIMINAR</button>
                                    <a href="index.php" class="btn btn-success" style="margin-top: 4px;">CANCELAR</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                //No tiene permisos
            ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">NO TIENE PERMISOS PARA HACER ESTA ACTIVIDAD</h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            //No tiene permisos
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">OTROSI NO ENCONTRATO EN LA BASE DE DATOS</h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <?php include("pie.php"); ?>
</div>