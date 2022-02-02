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
$nombres_dependencias = "";
$colores_dependencias = "";
$valores_dependencias = "";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-monitor icon-gradient bg-mean-fruit"> </i>
                    </div>
                    <div>Métricas sobre la contratación - Super Usuario - Control Interno
                        <div class="page-title-subheading">Aquí tienes información relevante sobre los contratos de la alcaldía municipal
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
                                    $sentencia2 = "select count(*) as total from contrato where activo = 1";
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
                                    $sentencia2 = "SELECT count(*) as total_actividades from actividades INNER JOIN contrato on actividades.fk_id_contrato=contrato.id_contrato INNER JOIN dependencia on contrato.fk_id_dependencia=dependencia.id_dependencia where dependencia.id_dependencia > 0";
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
                                    $sentencia2 = "select sum(valor) as valor from contrato where activo=1";
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
                                    <th class="text-center">Dependencia</th>
                                    <th class="text-center">Hechos</th>
                                    <th class="text-center">Promedio Estrellas</th>
                                    <th class="text-center">Último Reporte</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fecha1 = date("Y-m-01");
                                $sentencia2 = "SELECT log.fk_id_contratista, contratista.foto, contratista.nombres, contratista.apellidos, dependencia.nombre as nombre_dependencia, count(*) as total_hechos, AVG(calificacion) as promedio_estrellas, max(log.fecha) as ultimo_reporte from log INNER JOIN contratista on log.fk_id_contratista = contratista.id_contratista inner join dependencia on contratista.fk_id_dependencia = dependencia.id_dependencia where contratista.activado = 1  and fecha > '$fecha1' GROUP BY fk_id_contratista ORDER BY total_hechos desc limit 10";
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
                                                            <a href="informacion_contratista.php?id_contratista=<?php echo $fila2->fk_id_contratista ?>"><img width="40" class="rounded-circle" src="../<?php echo $fila2->foto ?>" alt=""></a>
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading"><a href="informacion_contratista.php?id_contratista=<?php echo $fila2->fk_id_contratista ?>"><?php echo $fila2->nombres ?></a></div>
                                                        <div class="widget-subheading opacity-7"><a href="informacion_contratista.php?id_contratista=<?php echo $fila2->fk_id_contratista ?>"><?php echo $fila2->apellidos ?></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center"><?php echo $fila2->nombre_dependencia ?></td>
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
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Contratación por Dependencia
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-focus">Total Vigencia</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Dependencia</th>
                                    <th class="text-center">Contratos</th>
                                    <th class="text-center">Total Contratación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $fecha1 = date("Y-m-01");
                                $sentencia2 = "select sum(contrato.valor) as valor, count(*) as total_contratos, dependencia.nombre as nombre, dependencia.id_dependencia as id_dependencia from contrato INNER JOIN dependencia on dependencia.id_dependencia=contrato.fk_id_dependencia where contrato.activo=1 GROUP BY dependencia.nombre order by valor DESC";
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
                                                            <a href="visor_dependencia.php?id_dependencia=<?php echo $fila2->id_dependencia ?>">

                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading"><?php echo $fila2->nombre ?></div>
                                                        <?php
                                                        $nombres_dependencias .= '"';
                                                        $nombres_dependencias .= $fila2->nombre;
                                                        $nombres_dependencias .= '",';
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                    </div>
                    </td>
                    <td class="text-center"><?php echo $fila2->total_contratos ?></td>
                    <td class="text-center">
                        <div class="badge badge-warning">
                            <?php
                                    echo "$" . number_format($fila2->valor);
                                    $valores_dependencias .= '"';
                                    $valores_dependencias .= $fila2->valor;
                                    $valores_dependencias .= '",';
                            ?></div>
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
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">DISTRIBUCION DE CONTRATACION POR DEPENDENCIAS</h5>
                    <canvas id="pie-chart" width="800" height="450"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>

<?php include("pie.php"); ?>
</div>
<script>
    new Chart(document.getElementById("pie-chart"), {
        type: 'pie',
        data: {
            labels: [<?php echo $nombres_dependencias ?>],
            datasets: [{
                label: "Population (millions)",
                backgroundColor: ["#EAF4D3", "#094074", "#3C6997", "#5ADBFF", "#AC3931", "#9BC995", "#98B9AB", "#5171A5", "#3F3047", "#EEF36A", "#70D6FF", "#FF70A6", "#FF9770", "#FFD670", "#E9FF70", "#DDDBF1", "#3C4F76", "#AB9F9D"],
                data: [<?php echo $valores_dependencias ?>]
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Distribución de Contratación por Dependencia'
            }
        }
    });
</script>