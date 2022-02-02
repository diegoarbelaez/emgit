<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

$numero_contrato = $_POST["numero_contrato"];
$sentencia = "select * from contrato inner join contratista on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contrato.fk_id_dependencia=dependencia.id_dependencia where contrato.numero='$numero_contrato' and contrato.activo=1";
$resultado = $conexion->query($sentencia);

if (mysqli_num_rows($resultado) > 0) {

    $fila = $resultado->fetch_object();

    $nombres =$fila->nombres;
    $apellidos = $fila->apellidos;


    $numero = $fila->numero;
    $fecha_inicio = $fila->fecha_inicio;
    $fecha_fin = $fila->fecha_fin;
    $valor = $fila->valor;
    $objeto = $fila->objeto;
    $dependencia = $fila->fk_id_dependencia;
    $indicador = $fila->indicador;
    $indicador2 = $fila->indicador2;
    $indicador3 = $fila->indicador3;
    $numero_cuotas = $fila->numero_cuotas;
    $supervisor1 = $fila->supervisor1;
    $supervisor2 = $fila->supervisor2;
    $supervisor3 = $fila->supervisor3;
    $correo_supervisor_1 = $fila->correo_supervisor1;
    $correo_supervisor_2 = $fila->correo_supervisor2;
    $correo_supervisor_3 = $fila->correo_supervisor3;
    $otrosi_contrato = $fila->otrosi;
    $id_contrato = $fila->id_contrato;


    $sentencia2 = "SELECT nombre from dependencia where id_dependencia = $dependencia";
    $restulado2 = $conexion->query($sentencia2);
    $fila2 = $restulado2->fetch_object();
    $nombre_dependencia = $fila2->nombre;
}




?>
<!-- Logica de inserción en la base de datos usando AJAX -->

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js" crossorigin="anonymous" defer></script>

<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">





<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Visor Detallado de un Contrato
                        <div class="page-title-subheading">Hechos, Pagos, Detalles de un contrato
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <?php
        if (mysqli_num_rows($resultado) > 0) {
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Detalles del Contrato</h5>
                            <table class="mb-0 table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row"><b>Número</b></th>
                                        <td><?php echo $numero; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Contratista</b></th>
                                        <td><?php echo $nombres . " ". $apellidos; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Fecha de Inicio</b></th>
                                        <td><?php echo $fecha_inicio; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Fecha de Finalización</b></th>
                                        <td><?php
                                            $fecha_fin_mostrar = $fila->fecha_fin;
                                            if ($otrosi_contrato > 0) {
                                                $sentencia_fecha_final_otrosi = "SELECT * FROM otrosi where fk_id_contrato = $fila->id_contrato";
                                                $resultado_fecha_otrosi = mysqli_query($conexion, $sentencia_fecha_final_otrosi);
                                                $fila_otrosi = mysqli_fetch_assoc($resultado_fecha_otrosi);
                                                $fecha_fin_mostrar = $fila_otrosi["fecha_fin"];
                                            }
                                            echo $fecha_fin_mostrar;
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Valor</b></th>
                                        <td><?php echo "$" . number_format($valor); ?></td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <th scope="row"><b>Numero de Cuotas</b></th>
                                        <td><?php echo $numero_cuotas ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Supervisor 1</b></th>
                                        <td><?php echo $supervisor1; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Correo Supervisor 1</b></th>
                                        <td><?php echo $correo_supervisor_1; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Supervisor 2</b></th>
                                        <td><?php echo $supervisor2; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Correo Supervisor 2</b></th>
                                        <td><?php echo $correo_supervisor_2; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Supervisor 3</b></th>
                                        <td><?php echo $supervisor3; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Correo Supervisor 3</b></th>
                                        <td><?php echo $correo_supervisor_3; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Objeto</b></th>
                                        <td><?php echo $objeto; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Dependencia</b></th>
                                        <td><?php echo $nombre_dependencia; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Indicador 1</b></th>
                                        <td><?php echo "Indicador ->" . $indicador . "<br>";
                                            $sentencia_bpin = "select * from codigos_bpin where rubro like '%$indicador%'";
                                            $resultado_bpin = mysqli_query($conexion, $sentencia_bpin);
                                            $fila_bpin = mysqli_fetch_assoc($resultado_bpin);
                                            //echo $sentencia_bpin;
                                            echo $fila_bpin["codigo_bpin"] . "<br>";
                                            echo $fila_bpin["nombre"];

                                            ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Indicador 2</b></th>
                                        <td><?php echo $indicador2; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Indicador 3</b></th>
                                        <td><?php echo $indicador3; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <?php
                            if ($otrosi_contrato == 0) {
                            ?>
                                <!-- Deja este espacio para validar cuando el contrato tiene otrosi -->
                            <?php
                            } else {
                            ?>
                                <div>
                                    <p><b>ESTE CONTRATO TIENE UN OTROSI GENERADO CON LOS SIGUIENTES DATOS:</b>
                                        <?php

                                        $sentencia_consulta_otrosi = "select * from otrosi where fk_id_contrato=$id_contrato";
                                        $resultado_consulta_otrosi = mysqli_query($conexion, $sentencia_consulta_otrosi);
                                        $fila_otrosi = mysqli_fetch_assoc($resultado_consulta_otrosi);

                                        ?>
                                    <table class="table-bordered" width="70%">
                                        <tr>
                                            <td width="40%"><b>Fecha Inicio: </b></td>
                                            <td><?php echo $fila_otrosi["fecha_inicio"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Fecha Finalización: </b></td>
                                            <td><?php
                                                //Valida si hay Otrosi, para mostrar la fecha de final del otrosi, no del contrato
                                                $fecha_fin_mostrar = $fila->fecha_fin;
                                                if ($otrosi_contrato > 0) {
                                                    $sentencia_fecha_final_otrosi = "SELECT * FROM otrosi where fk_id_contrato = $fila->id_contrato";
                                                    $resultado_fecha_otrosi = mysqli_query($conexion, $sentencia_fecha_final_otrosi);
                                                    $fila_otrosi = mysqli_fetch_assoc($resultado_fecha_otrosi);
                                                    $fecha_fin_mostrar = $fila_otrosi["fecha_fin"];
                                                }
                                                echo $fecha_fin_mostrar;
                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Número de Cuotas </b></td>
                                            <td><?php echo $fila_otrosi["cuotas_otrosi"]; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Valor del Otrosí:</b></td>
                                            <td><?php echo "$" . number_format($fila_otrosi["monto_otrosi"]); ?></td>
                                        </tr>
                                    </table>
                                    <br>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Pagos del contrato</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <td>
                                        <center><b>ID Pago</b></center>
                                    </td>
                                    <td>
                                        <center><b>Fecha de Pago</b></center>
                                    </td>
                                    <td>
                                        <center><b>Valor Bruto</b></center>
                                    </td>
                                    <td>
                                        <center><b>Descuentos</b></center>
                                    </td>
                                    <td>
                                        <center><b>Valor Neto Pagado</b></center>
                                    </td>
                                    <td>
                                        <center><b>Saldo</b></center>
                                    </td>
                                </thead>
                                <?php
                                $sentencia_pagos = "select * from pagos where fk_id_contrato=$id_contrato order by id_pago asc";
                                $resultado_pagos = mysqli_query($conexion, $sentencia_pagos);
                                while ($fila_pagos = mysqli_fetch_assoc($resultado_pagos)) {
                                ?>
                                    <tr>
                                        <td><?php echo $fila_pagos["id_pago"]; ?></td>
                                        <td><?php echo $fila_pagos["fecha_pago"]; ?></td>
                                        <td><?php echo "$" . number_format($fila_pagos["valor_bruto"]); ?></td>
                                        <td><?php echo "$" . number_format($fila_pagos["descuentos"]); ?></td>
                                        <td><?php echo "$" . number_format($fila_pagos["valor_neto"]); ?></td>
                                        <td><?php echo "$" . number_format($fila_pagos["saldo"]); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                            <form action="pre2_informe_supervision.php" method="POST">
                                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha_inicio ?>">
                                <input type="hidden" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin ?>">
                                <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">
                                <input type="hidden" name="id_contratista" id="id_contratista" value="<?php echo $id_contratista ?>">
                            </form>
                        </div>

                    </div>
                    <br>
                    <?php
                    if ($otrosi_contrato == 0) {
                    ?>
                        <!-- Deja este espacio para validar cuando el contrato tiene otrosi -->
                    <?php
                    } else {
                    ?>
                        <!-- muestra los pagos del otrosi -->
                        <?php
                        $sentencia_pagos = "select * from pagos_otrosi where fk_id_contrato=$id_contrato order by id_pago asc";
                        $resultado_pagos = mysqli_query($conexion, $sentencia_pagos);

                        if (mysqli_num_rows($resultado_pagos) > 0) {
                        ?>
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Pagos del Otrosi</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <td>
                                                <center><b>ID Pago</b></center>
                                            </td>
                                            <td>
                                                <center><b>Fecha de Pago</b></center>
                                            </td>
                                            <td>
                                                <center><b>Valor Bruto</b></center>
                                            </td>
                                            <td>
                                                <center><b>Descuentos</b></center>
                                            </td>
                                            <td>
                                                <center><b>Valor Neto Pagado</b></center>
                                            </td>
                                            <td>
                                                <center><b>Saldo</b></center>
                                            </td>
                                        </thead>
                                        <?php

                                        while ($fila_pagos = mysqli_fetch_assoc($resultado_pagos)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $fila_pagos["id_pago"]; ?></td>
                                                <td><?php echo $fila_pagos["fecha_pago"]; ?></td>
                                                <td><?php echo "$" . number_format($fila_pagos["valor_bruto"]); ?></td>
                                                <td><?php echo "$" . number_format($fila_pagos["descuentos"]); ?></td>
                                                <td><?php echo "$" . number_format($fila_pagos["valor_neto"]); ?></td>
                                                <td><?php echo "$" . number_format($fila_pagos["saldo"]); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>

                            </div>
                </div>
            <?php

                        } else {
            ?>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Pagos del Otrosi</h5>
                    </div>
                    <div class="card-body">
                        <p>No se han registrado pagos</p>
                    </div>
                </div>
            <?php
                        }
            ?>
            </div>
        <?php
                    }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-12 card">
                    <div class="card-body">
                        <h5 class="card-title">HISTORICO DE ACTIVIDADES DEL CONTRATO</h5>
                        <table border="1" id="example" style="width:100%">
                        <thead>
                            <tr>
                                <th>Actividad</th>
                                <th>Fecha</th>
                                <th>Hecho</th>
                                <th>Calificación</th>
                                <th>Evidencias</th>
                            </tr>
                        </thead>
                        <tbody>
                            <br>
                            <?php
                            $sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato";
                            $resultado = mysqli_query($conexion, $sentencia);

                            while ($fila = mysqli_fetch_object($resultado)) {
                                //print_r($fila);

                                $id_actividad = $fila->id_actividad;
                                //$fecha1 = date("Y-m-01");
                                $sentencia2 = "SELECT * from log WHERE fk_id_actividad=$id_actividad and fecha between '$fecha_inicio' and '$fecha_fin' order by fecha desc";
                                //echo $sentencia2;
                                $resultado2 = mysqli_query($conexion, $sentencia2);
                                $id_log = "";
                                while ($fila2 = mysqli_fetch_object($resultado2)) {
                                    //print_r($fila2);
                                    echo "<td><p><strong>" . $fila->descripcion . "</strong></td>";
                                    $id_log = $fila2->id_log;
                                    $sentencia3 = "select * from soportes where fk_id_log=$id_log";
                                    $resultado3 = mysqli_query($conexion, $sentencia3);
                                    $ruta = '<td><p class="text-danger">No se encontraron evidencias</p></td>';
                                    if ($fila3 = mysqli_fetch_object($resultado3)) {
                                        $ruta = '<td><a href="contratistas/' . $fila3->ruta . '" class="btn btn-success" target="blank">Ver Evidencias</a></td>';
                                    }
                            ?>
                                    <?php
                                    // echo $fila2->fecha 
                                    $fecha1 = new DateTime($fila2->fecha);
                                    $fecha1->modify('-5 hours');
                                    echo "<td>" . $fecha1->format('Y-m-j h:i:s') . "</td>";

                                    ?>


                                    <p><?php echo "<td>" . $fila2->hecho . "</td>" ?></p>
                                    <p>
                                        <?php
                                        $estrellas_amarillas = $fila2->calificacion;
                                        echo '<td>';
                                        for ($i = 0; $i < $estrellas_amarillas; $i++) {
                                            echo '<span class="float-left"><i class="text-warning fa fa-star"></i></span>';
                                        }
                                        $estrellas_blancas = 5 - $estrellas_amarillas;
                                        for ($i = 0; $i < $estrellas_blancas; $i++) {
                                            echo '<span class="float-left"><i class="text-light fa fa-star"></i></span>';
                                        }
                                        echo '</td>';


                                        ?>

                                        <?php
                                        if ($fila2->calificacion == 0) {
                                            // echo '<td><span class="text-danger">Sin calificar aún...</span></td>';
                                        } else {
                                            // echo "<td>".$fila2->calificacion."</td>";
                                        }

                                        ?>
                                    </p><?php //echo "<td>" . $fila->descripcion . "</td>"; 
                                        ?>
                                    <?php echo $ruta . "</tr>"; ?>




                            <?php
                                }
                            }
                            echo '</tr></tbody></table>';
                            ?>


                    </div>
                </div>
            </div>
        </div>

    <?php


        } else {
    ?>
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">CONTRATO NO ENCONTRATO EN LA BASE DE DATOS</h5>
                        <br>
                        <a href="visor_detallado_contrato.php" class="btn btn-success">REGRESAR</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "scrollX": true
            });
        });
    </script>
    <?php include("pie.php"); ?>
</div>

</div>