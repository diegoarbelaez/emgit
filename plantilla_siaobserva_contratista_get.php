<?php include("conexion.php") ?>
<?php
$fecha_inicial_reporte = base64_decode($_GET["fecha_inicio"]);
$fecha_final_reporte = base64_decode($_GET["fecha_fin"]);
$id_contratista =base64_decode( $_GET["id_contratista"]);


//Traigo la información del usuario
/* $usuario = $_GET["usuario"];
$mes = $_GET["mes"];
$ano = $_GET["ano"]; */
$sentencia = "select * from contratista where id_contratista='$id_contratista' and activado=1";
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
                        <td>Fecha: 01-Julio-2017</td>
                    </tr>
                    <tr>
                        <td>Versión: 5</td>
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
            <td width="20%"><b>VALOR DEL CONTRATO: </b>
                <td style="text-align: left; vertical-align: middle;"><?php echo "$". number_format($fila3->valor); ?> 
            </td>
        </tr>
        <tr>
            <td width="20%"><b>FECHA DEL INFORME: </b>
                <td style="text-align: left; vertical-align: middle;"><?php echo "DE: ".$fecha_inicial_reporte. " A ".$fecha_final_reporte ?> 
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
    </table>
    <table class="contenido">
        <thead>
            <tr>
                <th>ACTIVIDADES CONTRATADAS</th>
                <th>DESCRIPCION DEL AVANCE</th>
                <th>PRODUCTOS QUE CORROBORAN <BR>LA INFORMACION</th>
                <th>OBSERVACIONES O DIFICULTADES <BR>PRESENTADAS EN LA EJECUCIÓN</th>
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
            $fecha1 = date("Y-m-01");
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
                        $ruta = '<p><b>Documentos y evidencias: </b><br><img src="contratistas/' . $fila3->ruta . '" width="50%"></p>';
                        array_push($soportes, $ruta);
                    } else {
                        //Es un anexo, el contratista debe imprimirlo manualmente y adjuntarlo
                        $ruta = '<p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: ->' . $tipo_archivo['filename'] . '.' . $tipo_archivo['extension'] . ' </p>';
                        array_push($soportes, $ruta);
                    }
                }
                echo $fila2->hecho;
                //echo '<br>'. $fila2->fecha;
            }            ?>
        </td>
        <td>
            <?php
            foreach ($soportes as $texto) {
                echo " ".$texto."<br>";
            }    
            $soportes = array();       
             ?>
        </td>
        <td>
            NINGUNA
        </td>

    <?php
}
    ?>
    </div>
    <p>
        <table width="100%">
            <tr>
                <td width="50%">
                    <center><br><?php echo $nombres . ' ' . $apellidos ?><br><br><br><br><br><br> NOMBRE Y FIRMA DEL CONTRATISTA</center>
                </td>
            </tr>
        </table>
    </p>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
