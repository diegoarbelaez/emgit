<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>

<?php
$id_contratista = base64_decode($_GET["id_contratista"]);
$id_log = base64_decode($_GET["id_log"]);
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
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Información sobre el contratista</h5>

                        <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label><input name="nombres" id="nombres" placeholder="Nombres" type="text" class="form-control" value="<?php echo $fila->nombres; ?>"></div>
                        <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label><input name="apellidos" id="apellidos" placeholder="Apellidos" type="text" class="form-control" value="<?php echo $fila->apellidos; ?>"></div>
                        <div class="position-relative form-group"><label for="Cedula" class="">Cedula</label><input name="cedula" id="cedula" placeholder="Cédula" type="text" class="form-control" value="<?php echo $fila->cedula; ?>"></div>
                        <div class="position-relative form-group"><label for="Telefono" class="">Teléfono</label><input name="telefono" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" value="<?php echo $fila->telefono; ?>"></div>
                        <div class="position-relative form-group"><label for="Telefono" class="">Nivel Educativo</label><input name="nivel_educativo" id="nivel_educativo" placeholder="Nivel Educativo" type="text" class="form-control" value="<?php echo $fila->nivel_educativo; ?>"></div>
                        <div class="position-relative form-group"><label for="Telefono" class="">Contrato Asignado</label>
                            <table>
                                <tr>
                                    <td><input name="contrato_asignado" id="contrato_asignado" type="text" class="form-control" value="<?php echo $fila->numero ?>"></td>
                                    <td><a href="visualizar_contrato.php?id_contrato=<?php echo base64_encode($fila->fk_id_contrato) ?>" class="btn btn-success">Ver Contrato</a></td>
                                </tr>
                            </table>
                        </div>
                        <div class="position-relative form-group"><label for="Telefono" class="">Dependencia</label><input name="dependencia" id="nivel_educativo" placeholder="Nivel Educativo" type="text" class="form-control" value="<?php echo $fila->nombre; ?>"></div>
                        <!-- <button class="mt-1 btn btn-primary">Regresar</button> -->
                        <a href="index.php" class="mt-1 btn btn-primary">REGRESAR</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="tracking">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Calificar este hecho sobre esta actividad</h5>
                            <div class="tracking-list">
                                <form action="escribir_calificacion.php" method="POST">
                                    <?php
                                    $sentencia = "SELECT * FROM log where id_log=$id_log";
                                    $resultado = mysqli_query($conexion, $sentencia);
                                    $fila = mysqli_fetch_object($resultado);
                                    $calificacion = $fila->calificacion;
                                    ?>
                                    <br><br>
                                    <p><strong>Hecho reportado por el contratista:</strong></p>
                                    <p><?php echo $fila->hecho ?></p>
                                    <div class="position-relative form-group"><label for="Nombres" class=""><b>Calificacion</b></label>
                                        <select name="calificacion" id="calificacion" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="position-relative form-group"><label for="exampleText" class="">Enviar Retroalimentación</label>
                                        <textarea name="retroalimentacion" id="descripcion" class="form-control"></textarea>
                                    </div>
                                    <br>
                                    <input type="hidden" name="id_contratista" value="<?php echo $id_contratista; ?>">
                                    <input type="hidden" name="id_log" value="<?php echo $id_log; ?>">
                                    <button class="mt-1 btn btn-primary">Calificar</button>
                                    <?php /*
                                $sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato";
                                $resultado = mysqli_query($conexion, $sentencia);
                                while ($fila = mysqli_fetch_object($resultado)) {
                                    //print_r($fila);
                                    //echo "<p><strong>" . $fila->descripcion . "</strong>";
                                ?>
                                    <div class="tracking-item">
                                       
                                       
                                   
                                <?php
                                    $id_actividad = $fila->id_actividad;
                                    $fecha1= date("Y-m-01");
                                    $sentencia2 = "SELECT * from log WHERE fk_id_actividad=$id_actividad and fecha > '$fecha1' order by fecha desc";
                                    //echo $sentencia2;
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    while ($fila2 = mysqli_fetch_object($resultado2)) {
                                        //print_r($fila2);
                                        $id_log = $fila2->id_log;
                                        $sentencia3 = "select * from soportes where fk_id_log=$id_log";
                                        $resultado3 = mysqli_query($conexion, $sentencia3);
                                        $ruta = '<p class="text-danger">No se encontraron evidencias</p>';
                                        if ($fila3 = mysqli_fetch_object($resultado3)) {
                                            $ruta = '<a href="contratistas/'.$fila3->ruta.'" class="btn btn-success" target="blank">Ver Evidencias</a>';
                                        }
                                        ?> 
                                         <div class="tracking-icon status-intransit">
                                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                            </svg>
                                        </div>
                                         <div class="tracking-date"><?php 
                                        // echo $fila2->fecha 
                                        $fecha1 = new DateTime( $fila2->fecha );
                                        $fecha1->modify('-5 hours');
                                        echo $fecha1->format('Y-m-j h:i:s');

                                         ?></div>
                                        <div class="tracking-content"><p><strong>Hecho reportado por el contratista:</strong></p><p><?php echo $fila2->hecho ?></p><p><b>Calificación: </b><?php echo $fila2->calificacion ?></p><?php echo "<br><br><strong>Actividad a la que corresponde del contrato:</strong> " . $fila->descripcion . ""; ?>
                                        <br><?php echo $ruta;?><a href="calificar_log.php?id_log=<?php echo $id_log ?>&id_contratista=<?php echo $id_contratista ?>" class="btn btn-danger" style="margin-left: 5px">Calificar este Hecho</a><br><br><br></div> <?php 
                                    }
                                    echo '<br></div>';
                                }
                                */ ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>