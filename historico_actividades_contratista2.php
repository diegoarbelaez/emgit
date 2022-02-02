<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>

<?php
$id_contratista = $_POST["id_contratista"];
$fecha_inicio = $_POST["fecha_inicio"] . " 00:00:00";
$fecha_final = $_POST["fecha_fin"] . " 23:59:59";


$sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
//echo $sentencia;
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
        <div class="row">
            <div class="col-md-12">
                <div id="tracking">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Generación de Informes de Supervisión para este contratista</h5>
                            <div>
                                <form action="pre_informe_supervision.php" target="blank" method="POST">
                                    <table>
                                        <tr>
                                            <td style="padding-right: 22px">
                                                <div>
                                                    <label>Fecha de Inicio</label>
                                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="" value="" required>
                                                    <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>" </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label>Fecha de Finalizacion</label>
                                                    <input type="date" name="fecha_fin" id="fecha" class="form-control" placeholder="" value="" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label></label><br>
                                                    <button class="btn btn-success" style="margin-left: 12px; margin-top: 7px;">Generar Informe de Supervisión</button>
                                                </div>
                                            </td>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="tracking">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Ver Histórico de Actividades del Contratista</h5>
                            <div>
                                <form action="historico_actividades_contratista2.php" target="blank" method="POST">
                                    <table>
                                        <tr>
                                            <td style="padding-right: 22px">
                                                <div>
                                                    <label>Fecha de Inicio</label>
                                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="" value="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label>Fecha de Finalizacion</label>
                                                    <input type="date" name="fecha_fin" id="fecha" class="form-control" placeholder="" value="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label></label><br>
                                                    <button class="btn btn-danger" style="margin-left: 12px; margin-top: 7px;">Ver Actividades</button>
                                                </div>
                                            </td>
                                    </table>
                                    <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="tracking">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Actividades del mes para este contratista</h5>
                            <div class="tracking-list">
                                <form action="escribir_calificacion2.php" method="POST">
                                    <?php
                                    $sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato";
                                    $resultado = mysqli_query($conexion, $sentencia);
                                    while ($fila = mysqli_fetch_object($resultado)) {
                                        //print_r($fila);
                                        //echo "<p><strong>" . $fila->descripcion . "</strong>";
                                    ?>
                                        <div class="tracking-item">



                                            <?php
                                            $id_actividad = $fila->id_actividad;
                                            //$fecha1 = date("Y-m-01");
                                            $sentencia2 = "SELECT * from log WHERE fk_id_actividad=$id_actividad and fecha between '$fecha_inicio' and '$fecha_final' order by fecha desc";
                                            //echo $sentencia2;
                                            $resultado2 = mysqli_query($conexion, $sentencia2);
                                            $id_log = "";
                                            while ($fila2 = mysqli_fetch_object($resultado2)) {
                                                //print_r($fila2);
                                                $id_log = $fila2->id_log;
                                                $sentencia3 = "select * from soportes where fk_id_log=$id_log";
                                                $resultado3 = mysqli_query($conexion, $sentencia3);
                                                $ruta = '<p class="text-danger">No se encontraron evidencias</p>';
                                                if ($fila3 = mysqli_fetch_object($resultado3)) {
                                                    $ruta = '<a href="contratistas/' . $fila3->ruta . '" class="btn btn-success" target="blank">Ver Evidencias</a>';
                                                }
                                            ?>
                                                <div class="tracking-icon status-intransit">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                </div>
                                                <div class="tracking-date"><?php
                                                                            // echo $fila2->fecha 
                                                                            $fecha1 = new DateTime($fila2->fecha);
                                                                            $fecha1->modify('-5 hours');
                                                                            echo $fecha1->format('Y-m-j h:i:s');

                                                                            ?></div>
                                                <div class="tracking-content">
                                                    <p><strong>Hecho reportado por el contratista:</strong></p>
                                                    <p><?php echo $fila2->hecho ?></p>
                                                    <p>
                                                        <b>Calificación: </b>
                                                        <?php
                                                        $estrellas_amarillas = $fila2->calificacion;
                                                        for ($i = 0; $i < $estrellas_amarillas; $i++) {
                                                            echo '<span class="float-left"><i class="text-warning fa fa-star"></i></span>';
                                                        }
                                                        $estrellas_blancas = 5 - $estrellas_amarillas;
                                                        for ($i = 0; $i < $estrellas_blancas; $i++) {
                                                            echo '<span class="float-left"><i class="text-light fa fa-star"></i></span>';
                                                        }


                                                        ?>

                                                        <?php
                                                        if ($fila2->calificacion == 0) {
                                                            echo '<span class="text-danger">Sin calificar aún...</span>';
                                                        } else {
                                                            echo $fila2->calificacion;
                                                        }

                                                        ?>
                                                    </p><?php echo "<br><br><strong>Actividad a la que corresponde del contrato:</strong> " . $fila->descripcion . ""; ?>
                                                    <br><?php echo $ruta; ?>

                                                    <!-- <a href="calificar_log.php?id_log=<?php /* echo $id_log */ ?>&id_contratista=<?php /*echo $id_contratista */ ?>" class="btn btn-danger" style="margin-left: 5px">Calificar este Hecho</a> -->


                                                    <div class="position-relative form-group"><label for="Nombres" class=""><b>Calificacion</b></label>
                                                        <select name="cal_<?php echo $id_log ?>" id="calificacion" class="form-control col-4">
                                                            <option valule="<?php echo $fila2->calificacion ?>" selected="selected"><?php echo $fila2->calificacion ?></option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                    <div class="position-relative form-group"><label for="exampleText" class="">Escribir Retroalimentación</label>
                                                        <textarea name="retro_<?php echo $id_log ?>" id="descripcion" rows="6" class="form-control col-6"></textarea>
                                                    </div>
                                                    <br>

                                                    <br>
                                                    <br>
                                                    <br>
                                                </div> <?php
                                                    }
                                                    echo '<br></div>';
                                                }
                                                        ?>
                                        </div>
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success col-4">CALIFICAR INFORME</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("pie.php"); ?>
    </div>