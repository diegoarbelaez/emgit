<?php include("conexion.php") ?>
<?php
//Traigo la información del usuario
$usuario = $_SESSION["user"];
$sentencia = "select * from contratista where usuario='$usuario' and activado = 1";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_object($resultado);
$id_contratista = $fila->id_contratista;
//Traigo la información del contrato
$sentencia3 = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
$resultado3 = $conexion->query($sentencia3);
$fila3 = $resultado3->fetch_object();
$id_contrato = $fila3->id_contrato;
?>
<link href="../estilos_timeline.css" rel="stylesheet">
<style>
    td {
        padding-top: 0px;
        padding-left: 0px;
        padding-bottom: 0px;
        padding-right: 0px;
    }
</style>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-help1 icon-gradient bg-night-fade">
                        </i>
                    </div>
                    <div>Información de interés / Métricas
                        <div class="page-title-subheading">Aquí tienes algunas estadísticas sobre la ejecución de tu contrato
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Numero de Actividades</div>
                            <div class="widget-subheading">Actividades del contrato</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>
                                    <?php
                                    $sentencia2 = "select count(*) as total_contratos from actividades INNER JOIN contrato on actividades.fk_id_contrato=contrato.id_contrato INNER JOIN contratista on contratista.fk_id_contrato=contrato.id_contrato where contratista.id_contratista =$id_contratista";
                                    //echo $sentencia2;
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    $fila2 = mysqli_fetch_object($resultado2);
                                    echo $fila2->total_contratos;
                                    ?>
                                </span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Hechos sobre el contrato</div>
                            <div class="widget-subheading">Reportes publicados</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>
                                    <?php
                                    $sentencia2 = "select count(*) as total_reportes from log where fk_id_contratista =$id_contratista";
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    $fila2 = mysqli_fetch_object($resultado2);
                                    echo $fila2->total_reportes;
                                    ?>
                                </span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Última conexión</div>
                            <div class="widget-subheading">fecha y hora de conexión</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>
                                    <?php
                                    $sentencia2 = "select * from log where fk_id_contratista =$id_contratista order by fecha desc limit 1";
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    // echo $resultado->num_rows;
                                    //var_dump($resultado);
                                    if ($resultado2->num_rows > 0) {
                                        $fila2 = mysqli_fetch_object($resultado2);
                                        $date = date_create($fila2->fecha);
                                        $date->modify('-5 hours');
                                        echo $date->format('j-n / H:i');
                                    } else {
                                        echo "Sin reportes";
                                    }
                                    ?>
                                </span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Products Sold</div>
                            <div class="widget-subheading">Revenue streams</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning"><span>$14M</span></div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header">Actividad reciente
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-focus">Este mes</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th width="20%">Contratista</th>
                                    <th width="60%" align="left" class="text-center">Hechos</th>
                                    <th width="15%" class="text-center">Estrellas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sentencia = "SELECT c.id_contratista, l.hecho as hecho, c.nombres as nombres, c.apellidos as apellidos, c.foto as foto, l.calificacion, l.fecha FROM log l JOIN contratista c ON c.id_contratista = l.fk_id_contratista GROUP BY c.id_contratista, l.calificacion ORDER BY l.calificacion DESC, l.fecha DESC LIMIT 25";
                                $resultado = mysqli_query($conexion, $sentencia);
                                $i = 1;
                                while ($fila2 = mysqli_fetch_object($resultado)) {
                                ?>
                                    <tr>
                                        <td class="text-center text-muted td_dash" style="padding-top: 0px; padding-right: 0px; padding-left: 0px; padding-bottom: 0px;"><?php echo $i ?></td>
                                        <td style="padding-top: 0px; padding-right: 0px; padding-left: 0px; padding-bottom: 0px;">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            <img width="40" class="rounded-circle" src="../<?php echo $fila2->foto ?>" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading"><?php echo $fila2->nombres ?></div>
                                                    </div>
                                                </div>
                                            </div>
                    </div>
                    </td>
                    <td style="padding-top: 0px; padding-right: 0px; padding-left: 0px; padding-bottom: 0px;"><?php echo mb_strimwidth(strip_tags($fila2->hecho), 0, 100) . "..." ?></td>
                    <td style="padding-top: 0px; padding-right: 0px; padding-left: 0px; padding-bottom: 0px; text-align:center;">
                        <div class="badge badge-warning"><?php echo $fila2->calificacion ?></div>
                    </td>
                    </tr>
                <?php
                                    $i++;
                                }
                ?>

                </tbody>
                </table>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="main-card mb-3 card">
                <div class="card-header">Top de contratistas
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Este mes</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Contratista</th>
                                <th class="text-center">Hechos</th>
                                <th class="text-center">Promedio Estrellas</th>
                                <th class="text-center">Última Conexión</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $fecha1 = date("Y-m-01");
                            $sentencia2 = "SELECT log.fk_id_contratista, contratista.foto, contratista.nombres, contratista.apellidos, count(*) as total_hechos, AVG(calificacion) as promedio_estrellas, max(log.fecha) as ultimo_reporte from log INNER JOIN contratista on log.fk_id_contratista = contratista.id_contratista where fecha > '$fecha1' GROUP BY fk_id_contratista ORDER BY total_hechos desc limit 10";
                            $resultado2 = mysqli_query($conexion, $sentencia2);
                            $i = 1;
                            while ($fila2 = mysqli_fetch_object($resultado2)) {
                            ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $i ?></td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" src="../<?php echo $fila2->foto ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $fila2->nombres ?></div>
                                                    <div class="widget-subheading opacity-7"><?php echo $fila2->apellidos ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $fila2->total_hechos ?></td>
                                    <td class="text-center">
                                        <div class="badge badge-warning"><?php echo round($fila2->promedio_estrellas, 1); ?></div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">
                                            <?php
                                            $date = date_create($fila2->ultimo_reporte);
                                            $date->modify('-5 hours');
                                            echo $date->format('j-n-y / h:i a');
                                            ?>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <!-- METRICAS DE COSAS -->
    <!-- <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-danger">71%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">De tus tareas están calificadas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-success">99%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 99%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Expenses Target</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-warning">32%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Spendings Target</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-info mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-info">89%</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Totals Target</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Estos son los hechos que has registrado para este contrato en este mes</h5>
                    <div class="tracking-list">
                        <?php
                        $sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato limit 10";
                        $resultado = mysqli_query($conexion, $sentencia);
                        while ($fila = mysqli_fetch_object($resultado)) {
                            //print_r($fila);
                            echo "<p><strong>" . $fila->descripcion . "</strong>";
                        ?>
                            <div class="tracking-item">



                                <?php
                                $id_actividad = $fila->id_actividad;
                                $fecha1 = date("Y-m-01");
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
                                        $ruta = '<a href="' . $fila3->ruta . '" class="btn btn-success" target="blank">Ver Evidencias</a>';
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
                                        <br><?php echo $ruta; ?><br><br><br>
                                    </div> <?php
                                        }
                                        echo '<br></div>';
                                    }
                                            ?>
                            </div>
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