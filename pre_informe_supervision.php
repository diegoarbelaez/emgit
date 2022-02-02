<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>
<?php


$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$id_contratista = $_POST["id_contratista"];

//Como asocio los pagos es al contrato y aquí solo se el id del contratista, entonces busco
//el contrato para poderle asignar el pago
$sentencia_contrato = "select fk_id_contrato from contratista where id_contratista=$id_contratista";
$resultado_contrato = mysqli_query($conexion, $sentencia_contrato);
$fila_contrato = mysqli_fetch_assoc($resultado_contrato);
$id_contrato = $fila_contrato["fk_id_contrato"];
// Trae toda la información del contrato para poder calcular el cierre financiero
$sentencia2 = "select * from contrato where id_contrato=$id_contrato";
$resultado2 = mysqli_query($conexion, $sentencia2);
$fila2 = mysqli_fetch_assoc($resultado2);
$valor_bruto = $fila2["valor"] / $fila2["numero_cuotas"];






?>
<!-- Logica de inserción en la base de datos usando AJAX de los Pagos-->
<script src="gestionPagosOtrosi.js"></script>
<script src="gestionPagos.js"></script>


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
        <?php
        //Debemos validar y si el contrato NO tiene saldos pendientes, entonces el pago va para el OtroSi
        //Por el contrario, si tiene saldos pendientes, entonces liquida normalmente

        $sentencia_saldos = "select * from pagos where fk_id_contrato=$id_contrato order by id_pago desc limit 1"; //busca la última cuota pagada para ver si tiene saldo $0
        $restultado_saldos = mysqli_query($conexion, $sentencia_saldos);
        $fila_saldos = mysqli_fetch_assoc($restultado_saldos);
        $ultimo_saldo = $fila_saldos["saldo"];

        $sentencia_cuotas = "select count(*) as total from pagos where fk_id_contrato=$id_contrato"; //Valida que el contrato haya tenido pagos
        $restultado_cuotas = mysqli_query($conexion, $sentencia_cuotas);
        $fila_cuotas = mysqli_fetch_assoc($restultado_cuotas);
        $cuotas_pagadas = $fila_cuotas["total"];


        
        //Aquí está validando que tenga cuotas pagadas y que la última cuota sea por valor de $0
        //Entonces ahí si despliega el form de pago al otrosí y calcula los pagos sobre el Otrosi
        if ($ultimo_saldo == 0 && $cuotas_pagadas > 0 ) {
            //Trae datos del Otrosi, para poder calcular valor bruto de cuota
            $sentencia_otrosi = "select * from otrosi where fk_id_contrato=$id_contrato";
            $restultado_otrosi = mysqli_query($conexion, $sentencia_otrosi);
            $fila_otrosi = mysqli_fetch_assoc($restultado_otrosi);
            $valor_bruto_otrosi = $fila_otrosi["monto_otrosi"] / $fila_otrosi["cuotas_otrosi"];
        ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">PAGOS GENERADOS DEL CONTRATO ANTES DEL OTROSI</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <td>
                                            <center>ID Pago</center>
                                        </td>
                                        <td>
                                            <center>Fecha de Pago</center>
                                        </td>
                                        <td>
                                            <center>Valor Bruto</center>
                                        </td>
                                        <td>
                                            <center>Descuentos</center>
                                        </td>
                                        <td>
                                            <center>Valor Neto Pagado</center>
                                        </td>
                                        <td>
                                            <center>Saldo</center>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sentencia_pagos = "select * from pagos where fk_id_contrato = $id_contrato order by id_pago asc";
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
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">GENERAR INFORME FINANCIERO</h5>
                            <form action="" id="pagos-form-otrosi">
                                <div class="position-relative form-group"><label for="exampleText" class="">Agregar pago</label>
                                    <table>
                                        <tr>
                                            <td>
                                                <label for="" class="">Fecha de Pago</label>
                                                <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required>
                                            </td>
                                            <td>
                                                <label for="" class="">Valor Bruto $</label>
                                                <input type="number" name="valor_bruto" id="valor_bruto" value="<?php echo round($valor_bruto_otrosi) ?>" class="form-control" required>
                                            </td>
                                            <td>
                                                <label for="" class="">Descuentos $</label>
                                                <input type="number" id="descuentos" class="form-control" required>
                                            </td>
                                            <!-- <td>
                                            <label for="" class="">Neto Pagado $</label>
                                            <input type="number" id="valor_neto" class="form-control" required>
                                        </td>
                                        <td>
                                            <label for="" class="">Saldo $</label>
                                            <input type="number" id="saldo" class="form-control" required>
                                        </td> -->

                                        </tr>
                                    </table>
                                </div>
                                <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">

                                <!--  <button class="mt-1 btn btn-primary">AGREGAR ESTA ACTIVIDAD</button> -->

                                <input name="enviar" id="enviar" class="btn btn-primary btn-lg btn-block text-seder" type="submit" value="Guardar Pago">
                            </form>

                        </div>
                        <div class="card-body">
                            <h5 class="card-title">PAGOS YA GUARDADOS DEL OTROSI</h5>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <td>
                                            <center>ID Pago</center>
                                        </td>
                                        <td>
                                            <center>Fecha de Pago</center>
                                        </td>
                                        <td>
                                            <center>Valor Bruto</center>
                                        </td>
                                        <td>
                                            <center>Descuentos</center>
                                        </td>
                                        <td>
                                            <center>Valor Neto Pagado</center>
                                        </td>
                                        <td>
                                            <center>Saldo</center>
                                        </td>
                                        <td width="10">
                                            <center>Acciones</center>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody id="pagos_otrosi">
                                </tbody>

                            </table>
                            <form action="pre2_informe_supervision.php" method="POST">
                                <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha_inicio ?>">
                                <input type="hidden" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin ?>">
                                <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">
                                <input type="hidden" name="id_contratista" id="id_contratista" value="<?php echo $id_contratista ?>">
                                <input type="submit" name="enviar" id="enviar" class="btn btn-success btn-lg btn-block text-seder" value="CONTINUAR - INFORMACIÓN FINAL">
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        <?php
        } // Fin del IF
        else { 
            // Si entra aquí es porque el contrato no tiene Otrosi, entonces liquida normalmente
            ?>
            <div class="row">
            <div class="col-md-8">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">GENERAR INFORME FINANCIERO</h5>
                        <form action="" id="pagos-form">
                            <div class="position-relative form-group"><label for="exampleText" class="">Agregar pago</label>
                                <table>
                                    <tr>
                                        <td>
                                            <label for="" class="">Fecha de Pago</label>
                                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required>
                                        </td>
                                        <td>
                                            <label for="" class="">Valor Bruto $</label>
                                            <input type="number" name="valor_bruto" id="valor_bruto" value="<?php echo round($valor_bruto) ?>" class="form-control" required>
                                        </td>
                                        <td>
                                            <label for="" class="">Descuentos $</label>
                                            <input type="number" id="descuentos" class="form-control" required>
                                        </td>
                                        <!-- <td>
                                            <label for="" class="">Neto Pagado $</label>
                                            <input type="number" id="valor_neto" class="form-control" required>
                                        </td>
                                        <td>
                                            <label for="" class="">Saldo $</label>
                                            <input type="number" id="saldo" class="form-control" required>
                                        </td> -->

                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">

                            <!--  <button class="mt-1 btn btn-primary">AGREGAR ESTA ACTIVIDAD</button> -->

                            <input name="enviar" id="enviar" class="btn btn-primary btn-lg btn-block text-seder" type="submit" value="Guardar Pago">
                        </form>

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PAGOS YA GUARDADOS</h5>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <td>
                                        <center>ID Pago</center>
                                    </td>
                                    <td>
                                        <center>Fecha de Pago</center>
                                    </td>
                                    <td>
                                        <center>Valor Bruto</center>
                                    </td>
                                    <td>
                                        <center>Descuentos</center>
                                    </td>
                                    <td>
                                        <center>Valor Neto Pagado</center>
                                    </td>
                                    <td>
                                        <center>Saldo</center>
                                    </td>
                                    <td width="10">
                                        <center>Acciones</center>
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="pagos">
                            </tbody>

                        </table>
                        <form action="pre2_informe_supervision.php" method="POST">
                            <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha_inicio ?>">
                            <input type="hidden" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin ?>">
                            <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">
                            <input type="hidden" name="id_contratista" id="id_contratista" value="<?php echo $id_contratista ?>">
                            <input type="submit" name="enviar" id="enviar" class="btn btn-success btn-lg btn-block text-seder" value="CONTINUAR - INFORMACIÓN FINAL">
                        </form>
                    </div>

                </div>
            </div>
        </div>




            <?php
        }
        ?>
        <!-- Fila que contiene la información de la página -->



    </div>
    <?php include("pie.php"); ?>
</div>