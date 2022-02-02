<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

$id_log = $_POST["id_log"];
$sentencia = "select * from log where id_log = $id_log";
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
                    <div>Editar Hecho / Cambiar Fecha
                        <div class="page-title-subheading">Modificar la información de un hecho sobre un cotrato
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <?php
        if ($_SESSION['user'] == 'jariasduran@hotmail.com') {
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Editar fecha un hecho </h5>
                            <form method="POST" action="escribir_edicion_fecha_hecho.php">
                                <div class="position-relative form-group">
                                    <br><b>Descripción del Hecho:</b>
                                    <?php echo $fila["hecho"] ?>
                                </div>
                                <input type="hidden" name="id_log" value="<?php echo $fila["id_log"] ?>">
                                <div class="position-relative form-group">
                                    <input type="date" name="date" class="form-control" value="<?php 
                                    $fecha = new DateTime($fila["fecha"]);
                                    echo $fecha->format('Y-m-d'); 
                                    ?>" >
                                </div>
                                <button class="mt-1 btn btn-primary">Actualizar</button>
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
        ?>
    </div>
    <?php include("pie.php"); ?>
</div>