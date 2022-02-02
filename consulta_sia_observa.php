<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>
<?php
$id_contratista = base64_decode($_GET["id_contratista"]);
$sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
$id_contrato = $fila->id_contrato;
$fk_id_dependencia = $fila->fk_id_dependencia;
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Generación de Informes para entes de control
                        <div class="page-title-subheading">Informes de Supervisión e Informes de Contratistas
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
                        <h5 class="card-title">INFORMACIÓN SOBRE EL CONTRATISTA -> <?php echo $id_contratista ?></h5>
                        <br>
                        <img width="100" class="rounded-circle" src="<?php echo $fila->foto; ?>" alt=""><br>
                        <br>
                        <b>Nombre: </b><?php echo $fila->nombres ?> <?php echo $fila->apellidos ?><br>
                        <b>Número de Contrato: </b><?php echo $fila->numero ?><br>
                        <b>Fecha de Inicio Contrato: </b><?php echo $fila->fecha_inicio ?><br>
                        <b>Fecha Finalización Contrato: </b><?php echo $fila->fecha_fin ?><br>
                        <b>Dependencia: </b><?php echo $fila->nombre ?><br>
                        <b>Supervisor: </b><?php echo $fila->supervisor1 ?><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="tracking">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Generación de Informes de para este contratista</h5>
                            <div>
                                Aquí encontrará las últimas 5 fechas donde el contratista ha generado el informe de Contratista<br><br>
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>Fecha Generación</th>
                                                <th>Fecha Inicial del Informe Generado</th>
                                                <th>Fecha Final del Informe Generado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sentencia_fechas = "select * from fecha_informes_contratista where fk_id_contratista = $id_contratista order by fecha_generacion desc limit 5";
                                            $resultado_fechas = mysqli_query($conexion, $sentencia_fechas);
                                            while ($fila_fechas = mysqli_fetch_assoc($resultado_fechas)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo restar_fecha($fila_fechas["fecha_generacion"]); ?></td>
                                                    <td><?php echo $fila_fechas["fecha_inicio"]; ?></td>
                                                    <td><?php echo $fila_fechas["fecha_fin"]; ?></td>
                                                    <td><a href="plantilla_siaobserva_contratista_get.php?id_contratista=<?php echo base64_encode($id_contratista); ?>&fecha_inicio=<?php echo base64_encode($fila_fechas["fecha_inicio"]); ?>&fecha_fin=<?php echo base64_encode($fila_fechas["fecha_fin"]); ?>" target="new" class="btn btn-success">ABRIR ESTE INFORME</a></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <b>SI DESEA, TAMBIÉN PUEDE GENERAR EL INFORME DE CONTRATISTA PARA FECHAS ESPECÍFICAS</b><br><br>
                                <form action="plantilla_siaobserva_contratista_post.php" target="blank" method="POST">
                                    <table>
                                        <tr>
                                            <td style="padding-right: 22px">
                                                <div>
                                                    <label>Fecha de Inicio</label>
                                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="" value="" required>
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
                                                    <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>" </div>
                                                    <button class="btn btn-success" style="margin-left: 12px; margin-top: 7px;">GENERAR INFORME DE CONTRATISTA</button>
                                                </div>
                                            </td>


                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="tracking">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">GENERAR INFORMES DE SUPERVISIÓN</h5>
                            <div>
                                Aquí encontrará las últimas 5 fechas donde el contratista ha generado el informe de Contratista<br><br>
                                <div class="table-responsive">
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>Fecha Generación</th>
                                                <th>Fecha Inicial del Informe Generado</th>
                                                <th>Fecha Final del Informe Generado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sentencia_fechas = "select * from fecha_informes_supervision where fk_id_contratista = $id_contratista order by fecha_reporte desc limit 5";
                                            if ($resultado_fechas = mysqli_query($conexion, $sentencia_fechas)) {
                                                while ($fila_fechas = mysqli_fetch_assoc($resultado_fechas)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo restar_fecha($fila_fechas["fecha_reporte"]); ?></td>
                                                        <td><?php echo $fila_fechas["fecha_inicio"]; ?></td>
                                                        <td><?php echo $fila_fechas["fecha_fin"]; ?></td>
                                                        <td><a href="plantilla_siaobserva_supervisor_get.php?id_fecha=<?php echo $fila_fechas["id_fecha"]; ?>" target="new" class="btn btn-danger">VER INFORME DE SUPERVISION</a></td>
                                                    </tr>
                                            <?php
                                                }
                                            } else { echo "Error->".mysqli_error($conexion);}
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>

<?php
function restar_fecha($fecha){
    $nueva_fecha = strtotime ( '-5 hour' , strtotime ( $fecha ) ) ;
    $nueva_fecha = date ('Y-m-d h:i:s',$nueva_fecha);
    return $nueva_fecha;
}
?>