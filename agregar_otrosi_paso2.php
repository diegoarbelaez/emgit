<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>

<?php
$id_contrato = $_POST["id_contrato"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$monto_otrosi = $_POST["monto_otrosi"];
$cuotas_otrosi = $_POST["cuotas_otrosi"];
$numero_otrosi = $_POST["numero"];

//Traigo la información del contrato para hacer validaciones
$sentencia_contrato = "select * from contrato where id_contrato=$id_contrato";
$resultado_contrato = mysqli_query($conexion, $sentencia_contrato);
$fila_contrato = mysqli_fetch_assoc($resultado_contrato);

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
                    <div>Agregar Otrosí al contrato
                        <div class="page-title-subheading">Proceso de extensión en tiempo y dinero de un contrato
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <?php
        /*Hago las validaciones
        1. La fecha de inicio del Otrosí, no puede ser antes de la fecha de finalización del contrato
        2. ---
        3. ---
        */
        $fecha_fin_contrato = $fila_contrato["fecha_fin"];
        if ($fecha_fin_contrato > $fecha_inicio) {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="tracking">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Por favor confirmar los datos para proceder</h5>
                                <div class="alert alert-danger fade show" role="alert">Error: Fecha de Inicio del Otrosí es antes de terminar el contrato actual.
                                    <br>Por favor revisar e intentar nuevamente
                                </div>
                                <a href="visualizar_contrato.php?id_contrato=<?php echo base64_encode($id_contrato) ?>" class="mb-2 mr-2 btn btn-danger"">REGRESAR</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else { //No contenía errores
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="tracking">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Por favor confirmar los datos para proceder</h5>
                                <div class="alert alert-danger fade show" role="alert">Atención, esta acción no tiene retroceso o forma de regresar el contrato a un estado inicial
                                    <br>Por tal motivo debe estar seguro de que el otrosí se puede generar
                                </div>
                                <div>
                                    <p>ESTOS SON LOS DATOS DEL OTROSÍ A GENERARSE:
                                    <table class="table-bordered" width="30%">
                                        <tr>
                                            <td width="40%"><b>Número del Otrosí: </b></td>
                                            <td><?php echo $numero_otrosi ?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><b>Fecha Inicio: </b></td>
                                            <td><?php echo $fecha_inicio ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Fecha Finalización: </b></td>
                                            <td><?php echo $fecha_fin ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Número de Cuotas </b></td>
                                            <td><?php echo $cuotas_otrosi ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Valor del Otrosí:</b></td>
                                            <td><?php echo "$" . number_format($monto_otrosi) ?></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <form action="agregar_otrosi_escribir_bd.php" method="POST">
                                        <table width="30%">
                                            <tr>
                                                <td width="40%">
                                                    <input type="hidden" name="id_contrato" value="<?php echo $id_contrato ?>">
                                                    <input type="hidden" name="fecha_inicio" value="<?php echo $fecha_inicio ?>">
                                                    <input type="hidden" name="fecha_fin" value="<?php echo $fecha_fin ?>">
                                                    <input type="hidden" name="cuotas_otrosi" value="<?php echo $cuotas_otrosi ?>">
                                                    <input type="hidden" name="monto_otrosi" value="<?php echo $monto_otrosi ?>">
                                                    <input type="hidden" name="numero" value="<?php echo $numero_otrosi ?>">
                                                    <button class="mb-2 mr-2 btn btn-success">CONFIRMAR</button>
                                                </td>
                                                <td>
                                                    <a href="visualizar_contrato.php?id_contrato=<?php echo base64_encode($id_contrato) ?>" class="mb-2 mr-2 btn btn-danger"">REGRESAR</a> 
                                                </td>
                                            </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <?php include("pie.php"); ?>
    </div>