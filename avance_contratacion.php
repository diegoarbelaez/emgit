<?php
include("encabezado.php");
include("nav.php");
include("conexion.php");
?>
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
                    <div>Avance Plan de Desarrollo
                        <div class="page-title-subheading">Aquí tienes información relevante sobre la ejecució según los presupuestos y contratos
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Ejecución de Contratación
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-focus">Dependencia: TODAS LAS DEPENDENCIASç <?php //echo $dependencia ?></button>
                            </div>
                        </div>
                    </div>
                    <?php
                    $sentencia_bpin = "select * from codigos_bpin";
                    $resultado_bpin = mysqli_query($conexion, $sentencia_bpin);
                    while ($fila_bpin = mysqli_fetch_assoc($resultado_bpin)) {
                    ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fila_bpin["nombre"] ?></h5>
                            <b>Recurso:</b> <?php echo $fila_bpin["recurso"] ?><br>
                            <b>Valor:</b> $<?php echo number_format($fila_bpin["valor"]) ?><br>
                            <b>Codigo BPIN:</b> <?php echo $fila_bpin["codigo_bpin"] ?><br>
                            <b>Rubro :</b> <?php echo $fila_bpin["rubro"] ?><br>
                            <br>
                            Contratos Asociados a este Rubro Prespuestal y Código BPIN
                            <br>

                            <?php
                            $sentencia_contratos = "select * from contrato where activo = 1 and indicador like '%" . $fila_bpin["rubro"] . "%' or indicador2 like '%" . $fila_bpin["rubro"] . "%' or indicador3 like '%" . $fila_bpin["rubro"] . "%'";
                            $resultado_contratos = mysqli_query($conexion, $sentencia_contratos);
                            $sumatoria_contratos = 0;
                            $encontro_contratos = 0;
                            $id_contrato = 0;
                            $array_pagos= array();
                            while ($fila_contratos = mysqli_fetch_assoc($resultado_contratos)) {
                                echo "<a href=visualizar_contrato.php?id_contrato=" . base64_encode($fila_contratos["id_contrato"]) . " target=new>" . $fila_contratos["numero"] . "</a> - Valor Contrato $" . number_format($fila_contratos["valor"]);
                                //Busca los pagos hechos al contrato
                                $sentencia_pagos = "select * from pagos where fk_id_contrato=" . $fila_contratos["id_contrato"];
                                $resultado_pagos = mysqli_query($conexion, $sentencia_pagos);
                                $monto_pagado = 0;
                                while ($fila_pagos = mysqli_fetch_assoc($resultado_pagos)) {
                                    $monto_pagado += $fila_pagos["valor_bruto"];
                                    array_push($array_pagos, $monto_pagado);
                                }
                                echo " - Valor Pagado: $" . number_format($monto_pagado) . "<br>";
                                $sumatoria_contratos += $fila_contratos["valor"];
                                $encontro_contratos++;
                                $id_contrato = $fila_contratos["id_contrato"];
                            }
                            echo "<br><b>Valor Presupuestado a Ejecutar:</b> $" . number_format($sumatoria_contratos);
                            echo "<br><b>Valor Ejecutado al momento:</b> $" . number_format(array_sum($array_pagos));
                            //Si encuentra contrato, suma el valor Ejecutado del contrato, busca en los pagos
                            if ($encontro_contratos > 0) {
                                echo "<br><b>Valor Ejecutado:</b> $" . number_format(array_sum($array_pagos));
                                echo "<br><b>Cumplimiento: </b>" . round((array_sum($array_pagos) / $fila_bpin["valor"]) * 100, 2) . "%";
                            ?>

                                <div class="mb-3 progress">
                                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuemin="0" style="width: <?php echo ($sumatoria_contratos / $fila_bpin["valor"] * 100) ?>%;"></div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="mb-3 progress">
                                    No se encontraton contratos
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
    <?php include("pie.php"); ?>
</div>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>