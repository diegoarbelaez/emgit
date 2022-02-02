<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>
<?php


$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$id_contratista = $_POST["id_contratista"];

//Trae la información del contrato para detalles de la liquidación
$sentencia = "select contratista.id_contratista, contrato.numero_cuotas as numero_cuotas, contrato.valor as valor, contrato.id_contrato as id_contrato, contrato.otrosi as otrosi, contratista.eps as eps, contratista.pensiones as pensiones, contratista.arl as arl from contratista inner join contrato on contratista.fk_id_contrato = contrato.id_contrato where contratista.id_contratista=$id_contratista";
$resultado = mysqli_query($conexion,$sentencia);
$filas = mysqli_fetch_assoc($resultado);
$numero_cuotas = $filas["numero_cuotas"];
$cuota_igual_valor = $filas["valor"] / $filas["numero_cuotas"];
$id_contrato = $filas["id_contrato"];
//calcula el valor de la cuota a pagar... que se hace contando el numero de pagos encontrados en la tabla pagos
$sentencia_cuenta = "select count(*) as cuotas_pagadas from pagos where fk_id_contrato=$id_contrato";
$resultado_cuenta = mysqli_query($conexion,$sentencia_cuenta);
$filas_cuenta=mysqli_fetch_assoc($resultado_cuenta);
$numero_cuota_pagar = $filas_cuenta["cuotas_pagadas"];
$eps = $filas["eps"];
$pensiones = $filas["pensiones"];
$arl = $filas["arl"];
$texto_otrosi = "Contrato";

//Hago esta validación para saber si el contrato tiene otrosi, y que tenga saldo $0, entonces los valores de
// $numero_cuotas, $cuota_igual_valor, $numero_cuota_pagar se calculen sobre el Otrosi
$sentencia_saldos = "select * from pagos where fk_id_contrato=$id_contrato order by id_pago desc limit 1"; //busca la última cuota pagada para ver si tiene saldo $0
$restultado_saldos = mysqli_query($conexion, $sentencia_saldos);
$fila_saldos = mysqli_fetch_assoc($restultado_saldos);
$ultimo_saldo = $fila_saldos["saldo"];


if($filas["otrosi"] > 0 &&$ultimo_saldo == 0 ){
    $sentencia_otrosi = "SELECT * FROM otrosi where fk_id_contrato=".$id_contrato;
    $resultado_otrosi = mysqli_query($conexion,$sentencia_otrosi);
    $filas_otrosi = mysqli_fetch_assoc($resultado_otrosi);
    $numero_cuotas = $filas_otrosi["cuotas_otrosi"];
    $cuota_igual_valor = $filas_otrosi["monto_otrosi"] / $filas_otrosi["cuotas_otrosi"];
    //calcula el valor de la cuota a pagar... que se hace contando el numero de pagos encontrados en la tabla pagos_otrosi
    $sentencia_cuenta = "select count(*) as cuotas_pagadas from pagos_otrosi where fk_id_contrato=$id_contrato";
    $resultado_cuenta = mysqli_query($conexion,$sentencia_cuenta);
    $filas_cuenta=mysqli_fetch_assoc($resultado_cuenta);
    $numero_cuota_pagar = $filas_cuenta["cuotas_pagadas"];
    $texto_otrosi = "Otrosi";
}


?>
<!-- Logica de inserción en la base de datos usando AJAX de los Pagos-->
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
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-4">
                <div id="tracking">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Por favor diligencia estos campos para finalizar el informe de Supervisión</h5>
                            <div>
                                <!-- CAMBIAR ESTAS LINEAS DE CODIGO PARA INFORME EN PDF O INFORME EN HTML -->
                                
                                <!-- <form action="plantilla_informe_supervision.php" method="POST"> -->
                                <form action="generador_informe_supervision.php" target="new" method="POST">
                                    <label>Número de Cuotas del <?php echo $texto_otrosi ?></label>
                                    <input type="number" name="numero_cuotas_fake" class="form-control" placeholder="" value="<?php echo $numero_cuotas ?>" required disabled>
                                    <label>Cuota de Igual Valor</label>
                                    <input type="text" name="valor_mensual_fake" class="form-control" placeholder="" value="<?php echo round($cuota_igual_valor) ?>" required disabled>
                                    <label>Numero de Cuota a pagar en este periodo</label>
                                    <input type="text" name="numero_cuota_pagar" class="form-control" placeholder="" value="<?php echo $numero_cuota_pagar ?>" required>
                                    <label>EPS</label>
                                    <input type="text" name="eps" class="form-control" placeholder="" value="<?php echo $eps ?>" required>
                                    <label>Fondo de Pensiones</label>
                                    <input type="text" name="pension" class="form-control" placeholder="" value="<?php echo $pensiones ?>" required>
                                    <label>ARL</label>
                                    <input type="text" name="arl" class="form-control" placeholder="" value="<?php echo $arl ?>" required>
                                    <label>Fecha de Firma del Informe de Supervisión</label>
                                    <input type="date" name="fecha_firma" class="form-control" placeholder="" value="" required>
                                    <input type="hidden" name="fecha_inicio" value="<?php echo $fecha_inicio ?>">
                                    <input type="hidden" name="fecha_fin" value="<?php echo $fecha_fin ?>">
                                    <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                    <input type="hidden" name="numero_cuotas" value="<?php echo $numero_cuotas ?>">
                                    <input type="hidden" name="valor_mensual" value="<?php echo $cuota_igual_valor ?>">       
                                    <input type="hidden" name="fk_id_contrato" value="<?php echo $id_contrato ?>">       


                                    <br><br>
                                    <input type="submit" name="enviar" id="enviar" class="btn btn-success btn-lg btn-block text-seder" value="GENERAR INFORME SUPERVISIÓN">
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