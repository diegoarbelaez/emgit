<?php
include("conexion.php");

$fecha_inicio = $_POST["fecha_inicio"] . " 00:00:00";
$fecha_fin = $_POST["fecha_fin"] . " 23:59:59";
$id_contratista = $_POST["id_contratista"];

$numero_cuotas = $_POST["numero_cuotas"];
$valor_mensual =  $_POST["valor_mensual"];
$cuota_pagada =  $_POST["numero_cuota_pagar"];
$eps =  $_POST["eps"];
$pension =  $_POST["pension"];
$arl =  $_POST["arl"];
$fecha_impresion =  $_POST["fecha_firma"];
$id_contrato = $_POST["fk_id_contrato"];

//Guarda el ultimo pago del informe, para que sirva para crear las plantillas de SIA Observa
$sentencia_pago = "select * from pagos where fk_id_contrato=$id_contrato order by id_pago desc limit 1";
$resultado_pago = mysqli_query($conexion,$sentencia_pago);
$fila_pago = mysqli_fetch_assoc($resultado_pago);
$fk_id_ultimo_pago = $fila_pago["id_pago"];
///

//recojo el ID

//Guarda esta información en la tabla de Informes de Supervisión, para que pueda presentar a la platafoma SIA Observa
$sentencia_fechas = "INSERT INTO `fecha_informes_supervision` 
(
`fecha_inicio`, 
`fecha_fin`, 
`fk_id_contratista`, 
`numero_cuotas`, 
`valor_mensual`, 
`cuota_pagada`, 
`fk_id_ultimo_pago`, 
`eps`, 
`pension`, 
`arl`,
`fecha_impresion`) 
VALUES (
    '$fecha_inicio', 
    '$fecha_fin', 
    $id_contratista, 
    $numero_cuotas,
    $valor_mensual,
    $cuota_pagada, 
    $fk_id_ultimo_pago,
    '$eps', 
    '$pension', 
    '$arl', 
    '$fecha_impresion'
    )";

$resultado = mysqli_query($conexion,$sentencia_fechas);
//

//Para guardar compatibilidad con el archivo de plantillas de contratistas... solo cambia el nombre de las variables, para que abajo no haya que modificar los scripts
$fecha_inicial_reporte = $fecha_inicio;
$fecha_final_reporte = $fecha_fin;


//var_dump($_POST);
$sentencia = "select * from contratista where id_contratista='$id_contratista'";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_object($resultado);
$id_contratista = $fila->id_contratista;
//Traigo la información del contrato
$sentencia3 = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
$resultado3 = $conexion->query($sentencia3);
$fila3 = $resultado3->fetch_object();
$id_contrato = $fila3->id_contrato;
$nombres = $fila3->nombres;
$apellidos = $fila3->apellidos;
$supervisor1 = $fila3->supervisor1;
$supervisor2 = $fila3->supervisor2;
$supervisor3 = $fila3->supervisor3;
$valor_contrato = "$" . number_format($fila3->valor);

//







?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Informe Contratista - Generado por MegaInforme</title>
    <link rel="stylesheet" href="estilos_plantilla.css" media="all" />
</head>
<style>
    /* cuando vayamos a imprimir ... */
    @media print {

        /* indicamos el salto de pagina */
        .saltoDePagina {
            display: block;
            page-break-before: always;
        }
    }
</style>
<header class="clearfix">
    <table>
        <tr>
            <td><img src="logo_alcaldia_candelaria.png"></td>
            <td><B>MUNICIPIO DE CANDELARIA</B> <BR> INFORME DE SUPERVISOR</td>
            <td>
                <table class="sinborde">
                    <tr>
                        <td>Código: 54-PGC-FT-99</td>
                    </tr>
                    <tr>
                        <td>Fecha: 01-Junio-2016</td>
                    </tr>
                    <tr>
                        <td>Versión: 06</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</header>
<main>
    <table>
        <tr>
            <td width="30%"><b>CONTRATO NUMERO: </b></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->numero; ?></td>

        </tr>
        <tr>
            <td width="20%"><b>CONTRATANTE: </b></td>
            <td style="text-align: left; vertical-align: middle;">MUNICIPIO DE CANDELARIA</td>
        </tr>

        <tr>
            <td width="20%"><b>CONTRATISTA: </b></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila->nombres . ' ' . $fila->apellidos; ?></td>
        </tr>
        <tr>
            <td width="20%"><b>OBJETO CONTRACTUAL: </b></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->objeto; ?></td>
        </tr>
        <tr>
            <td width="20%"><b>CEDULA DE CIUDADANIA O NIT DEL CONTRATISTA:</b></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila->cedula ?></td>
        </tr>
        <tr>
            <td width="20%"><b>FECHA DE INICIO: </b>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->fecha_inicio ?>
            </td>
        </tr>
        <tr>
            <td width="20%"><b>FECHA DE FINALIZACIÓN: </b>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->fecha_fin ?>
            </td>
        </tr>
        <tr>
            <td width="20%"><b>VALOR DEL CONTRATO: </b>
            <td style="text-align: left; vertical-align: middle;"><?php echo "$" . number_format($fila3->valor); ?>
            </td>
        </tr>
        <tr>
            <td width="20%"><b>SUPERVISION:1 </b></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->supervisor1 ?><br><?php echo $fila3->nombre ?></td>
        </tr>

        <?php
        if (!empty($fila3->supervisor2)) {
        ?>
            <tr>
                <td width="20%"><b>SUPERVISION:2</b></td>
                <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->supervisor2 ?><br><?php echo $fila3->nombre ?></td>
            </tr>
        <?php
        }
        ?>

        <?php
        if (!empty($fila3->supervisor3)) {
        ?>
            <tr>
                <td width="20%"><b>SUPERVISION:3</b></td>
                <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->supervisor3 ?><br><?php echo $fila3->nombre ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <div>
        <p>
            Una vez revisado el informe de actividades del contratista, correspondiente al periodo de
            <?php
            $fecha_1 = new DateTime($fecha_inicio);
            $fecha_2 = new DateTime($fecha_fin);
            echo $fecha_1->format('Y-m-d') . " a " . $fecha_2->format('Y-m-d');

            ?> se corrobora que en las actividades contratadas se evidencia el siguiente avance.
        </p>
    </div>
    <table class="contenido">
        <thead>
            <tr>
                <th>DESCRIPCIÓN DE LAS <br>ACTIVIDADES CONTRACTUALES</th>
                <th>AVANCE EN LAS ACTIVIDADES <br>CONTRACTUALES</th>
                <th>EVIDENCIAS O PRODUCTOS</th>
            </tr>
        </thead>
</main>

<?php
$soportes = array();
$sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato";
$resultado = mysqli_query($conexion, $sentencia);
while ($fila = mysqli_fetch_object($resultado)) {
?>
    <tr>
        <td>
            <?php echo "" . $fila->descripcion . ""; ?>
        </td>
        <td><?php
            $id_actividad = $fila->id_actividad;
            $sentencia2 = "SELECT * from log WHERE fk_id_actividad=$id_actividad and fecha BETWEEN '$fecha_inicial_reporte' AND '$fecha_final_reporte' order by fecha desc";
            $resultado2 = mysqli_query($conexion, $sentencia2);
            while ($fila2 = mysqli_fetch_object($resultado2)) {
                //print_r($fila2);
                $id_log = $fila2->id_log;
                $sentencia3 = "select * from soportes where fk_id_log=$id_log";
                $resultado3 = mysqli_query($conexion, $sentencia3);
                $ruta = '<p class="text-danger">No se encontraron evidencias</p>';
                if ($fila3 = mysqli_fetch_object($resultado3)) {
                    $tipo_archivo = pathinfo($fila3->ruta);
                    //var_dump($tipo_archivo);
                    if ($tipo_archivo['extension'] == 'jpg' || $tipo_archivo['extension'] == 'jpeg' || $tipo_archivo['extension'] == 'png' || $tipo_archivo['extension'] == 'gif') {
                        $ruta = '<p><b>Documentos y evidencias: </b><br><img src="contratistas/' . $fila3->ruta . '" width="50%"></p>';
                        array_push($soportes, $ruta);
                    } else {
                        //Es un anexo, el contratista debe imprimirlo manualmente y adjuntarlo
                        $ruta = '<p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: ->' . $tipo_archivo['filename'] . '.' . $tipo_archivo['extension'] . ' </p>';
                        array_push($soportes, $ruta);
                    }
                }
                echo $fila2->hecho;
            }            ?>
        </td>
        <td>
            <?php
            foreach ($soportes as $texto) {
                echo " " . $texto . "<br>";
            }
            $soportes = array();
            ?>
        </td>


    <?php
}
    ?>
    </div>
    </tr>
    </table>
    <div>
        <p>
            <b>INFORME FINANCIERO</b>

            La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
            de conformidad con el presente contrato, la cantidad de <?php echo $valor_contrato ?>. Pagados en <?php echo $numero_cuotas ?> cuotas de igual valor, por valor de $<?php echo number_format($valor_mensual) ?>.
            <br>


            <!-- Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->
            <?php

            $sentencia_validar = "SELECT * FROM pagos WHERE fk_id_contrato=$id_contrato";
            $restultado_validar = mysqli_query($conexion, $sentencia_validar);
            if (mysqli_num_rows($restultado_validar) >= 1) {

            ?>
        </p>
        <p style="page-break-inside:avoid ">
        <table>
            <tr>
                <th>Fecha de Pago</th>
                <th>Valor Bruto</th>
                <th>Descuentos</th>
                <th>Valor Neto Pagado</th>
                <th>Saldo</th>
            </tr>
            <?php
                $sentencia = "SELECT * FROM pagos WHERE fk_id_contrato=$id_contrato";
                $resultado = mysqli_query($conexion, $sentencia);
                while ($fila_pagos =  mysqli_fetch_assoc($resultado)) {
            ?> <tr>
                    <td><?php echo $fila_pagos["fecha_pago"] ?></td>
                    <td><?php echo "$" . number_format($fila_pagos["valor_bruto"]) ?></td>
                    <td><?php echo "$" . number_format($fila_pagos["descuentos"]) ?></td>
                    <td><?php echo "$" . number_format($fila_pagos["valor_neto"]) ?></td>
                    <td><?php echo "$" . number_format($fila_pagos["saldo"]) ?></td>
            <?php
                }
            }
            ?>
                </tr>
        </table>
        </p>
        <p style="page-break-inside:avoid">

            En consecuencia, se aprueba el cumplimiento de las actividades encomendadas en el objeto contractual de la referencia y se declara
            el recibo del bien o servicio a satisfacción puesto que cumple a cabalidad con lo contratado, y se autoriza el pago de la cuota
            <?php echo "N.º " . $cuota_pagada ?>, correspondiente al periodo:<?php echo $fecha_1->format("Y-m-d") . " a " . $fecha_2->format("Y-m-d"); ?>.

            Así mismo el suscrito supervisor, certifica que el contratista ha cumplido con sus obligaciones respecto de la afiliación de seguridad social.

        <table>
            <tr>
                <th><b>PERSONA NATURAL</b></td>
                <th width="10%"><b>C</b></td>
                <th width="10%"><b>NC</b></td>
            </tr>
            <tr>
                <td>Para el caso del CONTRATISTA, que ostenta la calidad de COTIZANTE ACTIVO e INDEPENDIENTE en su misma calidad, ante la Empresa Promotora de Salud “EPS” <?php echo $eps ?> Administradora de Pensiones <?php echo $pension ?> y entidad Administradora de Riesgos Laborales () <?php echo $arl ?> </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Que en cumplimiento y apego al decreto No. 107 de 2012 de la Alcaldía de Candelaria, se realizó la verificación del pago de los aportes a la seguridad social integral a las entidades arriba mencionadas, el cual corresponde al ingreso base de cotización exigido legalmente para su liquidación y para los periodos contractuales respectivos, conforme a las exigencias pactadas desde el inicio del contrato suscrito</td>
                <td></td>
                <td></td>
            </tr>
        </table>
        </p>
        <p style="page-break-inside:avoid ">
            <br>
        <table>
            <tr>
                <th><b>PERSONA JURIDICA</b></td>
                <th width="10%"><b>C</b></td>
                <th width="10%"><b>NC</b></td>
            </tr>
            <tr>
                <td>Tiene a sus empleados afiliados a las entidades correspondientes, tales como Empresas Promotoras de Salud “EPS”, Entidades Administradoras de Pensiones, conforme a la certificación de su representante legal y/o revisor fiscal, encontrándose al día en sus aportes y desde el inicio del contrato suscrito.</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Cumple con todas sus obligaciones fiscales y parafiscales, conforme a la certificación de su representante legal y/o revisor fiscal que las acreditó a las que estaba obligado, demostrando el respectivo cumplimiento desde el inicio del contrato suscrito.</td>
                <td></td>
                <td></td>
            </tr>

        </table>
        </p>

        <br>
        En constancia se firma por los que intervienen en la fecha <?php echo $fecha_impresion ?>

        </p>
    </div>
    <p style="page-break-inside:avoid ">
    <table>
        <tr>
            <td width=" 33%">
                <center><br><?php echo $supervisor1 ?><br><br><br><br><br><br> SUPERVISOR 1</center>
            </td>
            <?php
            if (!empty($supervisor2)) {
            ?>
                <td width=" 33%">
                    <center><br><?php echo $supervisor2 ?><br><br><br><br><br><br> SUPERVISOR 2</center>
                </td>
            <?php
            }
            ?>
            <?php
            if (!empty($supervisor3)) {
            ?>
                <td width=" 33%">
                    <center><br><?php echo $supervisor3 ?><br><br><br><br><br><br> SUPERVISOR 3</center>
                </td>
            <?php
            }
            ?>
        </tr>
    </table>
    <table>
        <tr>
            UNA VEZ IMPRESO ESTE DOCUMENTO SE CONSIDERA COPIA NO CONTROLADA Y NO NOS HACEMOS RESPONSABLES POR SU ACTUALIZACION
        </tr>
    </table>
    </p>