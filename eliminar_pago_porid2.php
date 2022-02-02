<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

$id_pago = $_POST["id_pago"];
$sentencia = "select * from pagos where id_pago = $id_pago";
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
                    <div>Eliminar Pago
                        <div class="page-title-subheading">Eliminar un pago de un contrato
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
                                <h5 class="card-title">Eliminar pago por ID</h5>
                                <form method="POST" action="eliminar_pago_porid3.php">
                                    <div class="position-relative form-group">
                                        <br><b>Datos del Pago:</b><br><br>
                                        <b>Fecha: </b><?php echo $fila["fecha_pago"] ?><br>
                                        <b>Valor Bruto: </b>$<?php echo number_format($fila["valor_bruto"]) ?><br>
                                        <b>Descuentos: </b>$<?php echo number_format($fila["descuentos"]) ?><br>
                                        <b>Valor Neto: </b>$<?php echo number_format($fila["valor_neto"]) ?><br>
                                        <b>Saldo: </b>$<?php echo number_format($fila["saldo"]) ?><br>
                                    </div>
                                    <input type="hidden" name="id_pago" value="<?php echo $fila["id_pago"] ?>">
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
                            <h5 class="card-title">PAGO NO ENCONTRATO EN LA BASE DE DATOS</h5>
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