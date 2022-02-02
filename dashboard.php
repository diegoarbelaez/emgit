<?php include("conexion.php") ?>
<?php
//Traigo la información del usuario
$usuario = $_SESSION["user"];
//$usuario = 'jsebas';
$sentencia = "select * from administradores INNER JOIN dependencia on dependencia.id_dependencia=administradores.fk_id_dependencia where administradores.usuario='$usuario'";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_object($resultado);
$dependencia = $fila->nombre;
$fk_id_dependencia = $_SESSION["id_dependencia"];
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-monitor icon-gradient bg-mean-fruit"> </i>
                    </div>
                    <div>Métricas sobre la contratación
                        <div class="page-title-subheading">Aquí tienes información relevante sobre los contratos de <?php echo $dependencia ?>
                            <br>

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
                            <div class="widget-heading">Total de contratos activos</div>
                            <div class="widget-subheading">Contractos en ejecución en este momento</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>
                                    <?php
                                    $sentencia2 = "select count(*) as total from contrato where activo = 1 and fk_id_dependencia=$fk_id_dependencia";
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    $fila2 = mysqli_fetch_object($resultado2);
                                    echo $fila2->total;
                                    ?>
                                </span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-love-kiss">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Actividades de los contratos</div>
                            <div class="widget-subheading">Total de actividades que hacen los contratistas</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white">
                                <span>
                                    <?php
                                    $sentencia2 = "SELECT count(*) as total_actividades from actividades INNER JOIN contrato on actividades.fk_id_contrato=contrato.id_contrato INNER JOIN dependencia on contrato.fk_id_dependencia=dependencia.id_dependencia where dependencia.id_dependencia = $fk_id_dependencia";
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    $fila2 = mysqli_fetch_object($resultado2);
                                    echo $fila2->total_actividades;
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Contratación Activa</div>
                            <div class="widget-subheading">Presupuesto de contratos activos</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white">
                                <span>
                                    <?php
                                    $sentencia2 = "select sum(valor) as valor from contrato where activo=1 and fk_id_dependencia =$fk_id_dependencia";
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    $fila2 = mysqli_fetch_object($resultado2);
                                    echo "$" . number_format($fila2->valor);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
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
                                    <th class="text-center">Último Reporte</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fecha1 = date("Y-m-01");
                                $sentencia2 = "SELECT log.fk_id_contratista, contratista.foto, contratista.nombres, contratista.apellidos, count(*) as total_hechos, AVG(calificacion) as promedio_estrellas, max(log.fecha) as ultimo_reporte from log INNER JOIN contratista on log.fk_id_contratista = contratista.id_contratista where contratista.activado = 1 and fk_id_dependencia = $fk_id_dependencia and fecha > '$fecha1' GROUP BY fk_id_contratista ORDER BY total_hechos desc";
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
                                                            <a href="informacion_contratista.php?id_contratista=<?php echo base64_encode($fila2->fk_id_contratista) ?>"><img width="40" class="rounded-circle" src="<?php echo $fila2->foto ?>" alt=""></a>
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading"><a href="informacion_contratista2.php?id_contratista=<?php echo base64_encode($fila2->fk_id_contratista) ?>"><?php echo $fila2->nombres ?></a></div>
                                                        <div class="widget-subheading opacity-7"><a href="informacion_contratista.php?id_contratista=<?php echo base64_encode($fila2->fk_id_contratista) ?>"><?php echo $fila2->apellidos ?></a></div>
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
    <!-- <div class="row">
            <div class="col-md-12">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                            Bandwidth Reports
                        </div>
                        <div class="btn-actions-pane-right">
                            <div class="nav">
                                <a href="javascript:void(0);" class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Tab 1</a>
                                <a href="javascript:void(0);" class="ml-1 btn-pill btn-wide border-0 btn-transition  btn btn-outline-alternate second-tab-toggle-alt">Tab 2</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab-eg-55">
                            <div class="widget-chart p-3">
                                <div style="height: 350px">
                                    <canvas id="myChart" style="max-width: 500px;"></canvas>
                                </div>
                                <div class="widget-chart-content text-center mt-5">
                                    <div class="widget-description mt-0 text-warning">
                                        <i class="fa fa-arrow-left"></i>
                                        <span class="pl-1">175.5%</span>
                                        <span class="text-muted opacity-8 pl-1">increased server resources</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-2 card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">63%</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Generated Leads</div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100" style="width: 63%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">32%</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Submitted Tickers</div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 32%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">71%</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Server Allocation</div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: 71%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="widget-content">
                                            <div class="widget-content-outer">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-numbers fsize-3 text-muted">41%</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <div class="text-muted opacity-6">Generated Leads</div>
                                                    </div>
                                                </div>
                                                <div class="widget-progress-wrapper mt-1">
                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100" style="width: 41%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    <div class="row">
        <div class="col-md-12">
            <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
                <div class="widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left pr-2 fsize-1">
                                <div class="widget-numbers mt-0 fsize-3 text-danger">
                                    <?php
                                    $sentencia = "select count(*) as sin_calificar from log where calificacion = 0";
                                    $resultado = mysqli_query($conexion, $sentencia);
                                    $fila = mysqli_fetch_object($resultado);
                                    $sin_calificar = $fila->sin_calificar;
                                    $sentencia2 = "select count(*) as total from log";
                                    $resultado2 = mysqli_query($conexion, $sentencia2);
                                    $fila2 = mysqli_fetch_object($resultado2);
                                    $total = $fila2->total;
                                    //Validacion para cuando $total es 0, no muestre error por primera vez
                                    if ($total == 0) {
                                        $total = 1;
                                    }
                                    $completado = round(($sin_calificar / $total) * 100);
                                    echo $completado . "%";
                                    ?>
                                </div>
                            </div>
                            <div class="widget-content-right w-100">
                                <div class="progress-bar-xs progress">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="71" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $completado ?>%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left fsize-1">
                            <div class="text-muted opacity-6">Hechos Sin Calificar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>

<?php include("pie.php"); ?>
</div>