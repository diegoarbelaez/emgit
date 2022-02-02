<?php
include("conexion.php");
/*
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$id_contratista = $_POST["id_contratista"];*/

$fecha_inicio = '2020-09-01';
$fecha_fin = '2020-09-31';
$id_contratista = 15;

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
$valor_contrato = "$".number_format($fila3->valor);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Informe Contratista</title>
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
            <td><B>MUNICIPIO DE CANDELARIA</B> <BR> INFORME DE CONTRATISTA</td>
            <td>
                <table class="sinborde">
                    <tr>
                        <td>Código: 54-PGC-FT-100</td>
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
        <tr>
            <td width="20%"><b>SUPERVISION:2</b></td>
            <td style="text-align: left; vertical-align: middle;"><?php echo $fila3->supervisor2 ?><br><?php echo $fila3->nombre ?></td>
        </tr>
        <tr>
            <td width="20%"><b>TRAZABILIDAD:</b></td>
            <td style="text-align: left; vertical-align: middle;">SECTOR: 123 <BR> PROYECTO: 10102020 <BR> SUBPROYECTO: 20202 </td>
        </tr>
    </table>
    <div>
        <p>
            Una vez revisado el informe de actividades del contratista, correspondiente al periodo de <?php echo $fecha_inicio . " a " . $fecha_fin ?> se corrobora que en las actividades contratadas se evidencia el siguiente avance.
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
            //echo $sentencia2;
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
                        $ruta = '<p><b>Documentos y evidencias: </b><br><img src="' . $fila3->ruta . '" width="50%"></p>';
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
            de conformidad con el presente contrato, la cantidad de <?php echo $valor_contrato ?>. Pagados en cuotas mensuales iguales.
            FECHA DE PAGO VALOR BRUTO DESCUENTOS S/G VALOR NETO PAGADO S/G SALDO

            En consecuencia, se aprueba el cumplimiento de las actividades encomendadas en el objeto contractual de la referencia y se declara
            el recibo del bien o servicio a satisfacción puesto que cumple a cabalidad con lo contratado, y se autoriza el pago de la cuota N.º 1,
            correspondiente al periodo: 18 NOVIEMBRE al 3 de DICIEMBRE de 2020

            Así mismo el suscrito supervisor, certifica que el contratista ha cumplido con sus obligaciones respecto de la afiliación de seguridad social.
            obligaciones respecto de la afiliación de seguridad social

            En constancia se firma por los que intervienen el día 3 del mes de DICIEMBRE de (2020).

        </p>
    </div>
    <p>
        <table width="100%" style="page-break-before: always;"">
            <tr>
                <td width=" 50%">
            <center><br><?php echo $supervisor1 ?><br><br><br><br><br><br> SUPERVISOR 1</center>
            </td>
            <td>
                <center><br><?php echo $supervisor2 ?><br><br><br><br><br><br> SUPERVISOR 2</center>
            </td>
            </tr>
        </table>
    </p>
