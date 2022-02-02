<?php include("conexion.php") ?>
<?php
//Traigo la información del usuario
$usuario = "diegoarbelaez.co@gmail.com";
$mes = "";
$ano = "2020";
$sentencia = "select * from contratista where usuario='$usuario'";
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
$supervisor = $fila3->supervisor;

//construye la fecha
$mes_numero = "";
switch ($mes) {
    case "Enero":
        $mes_numero = '01';
        break;
    case "Febrero":
        $mes_numero = '02';
        break;
    case "Marzo":
        $mes_numero = '03';
        break;
    case "Abril":
        $mes_numero = '04';
        break;
    case "Mayo":
        $mes_numero = '05';
        break;
    case "Junio":
        $mes_numero = '06';
        break;
    case "Julio":
        $mes_numero = '07';
        break;
    case "Agosto":
        $mes_numero = '08';
        break;
    case "Septiembre":
        $mes_numero = '09';
        break;
    case "Octubre":
        $mes_numero = '10';
        break;
    case "Noviembre":
        $mes_numero = '11';
        break;
    case "Diciembre":
        $mes_numero = '12';
        break;
}
$fecha_inicial_reporte = $ano . "-" . $mes_numero . "-01 00:00:00";
$fecha_final_reporte = $ano . "-" . $mes_numero . "-31 23:59:59";

$fecha_inicial_reporte = "2020-09-01 00:00:00";
$fecha_final_reporte = "2020-10-01 23:00:00";




?>
<link href="../estilos_timeline.css" rel="stylesheet">
<link href="./main.css" rel="stylesheet">
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
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <center>

                            <h5><br><br><br><br><br><br><b>INFORME DE GESTIÓN PARA EL CONTRATO DE PRESTACIÓN DE SERVICIOS NO. <br></b><?php echo $fila3->numero ?></h5>
                        </center>
                        <div class="page-title-subheading">INFORME PRESENTADO PARA EL PERIODO COMPRENDIDO ENTRE 1 AL 30 DE SEPTIEMBRE DE 2020
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <center>
                            <h5><br><br><b>CONTRATANTE</b><br>Municipio de Sevilla Valle<br>NIT: NIT: 800.100.527-0</h5>
                        </center>
                        <div class="page-title-subheading">INFORME PRESENTADO PARA EL PERIODO COMPRENDIDO ENTRE 1 AL 30 DE SEPTIEMBRE DE 2020
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <center>
                            <h5><br><br><b>CONTRATISTA</b><br><?php echo $fila->nombres . ' ' . $fila->apellidos; ?><br>CC: <?php echo $fila->cedula ?> </h5>
                        </center>
                        <div class="page-title-subheading">DEPENDENCIA:<br> <?php echo $fila3->nombre ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <center>
                            <h5><br><br><b>OBJETO CONTRACTUAL</b></h5>
                        </center>
                        <div class="page-title-subheading"><br> <?php echo $fila3->objeto; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <center>
                            <h5><br><br><b>INDICADOR AL QUE APUNTA ESTE CONTRATO</b></h5>
                        </center>
                        <div class="page-title-subheading"><br> <?php echo $fila3->indicador; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="saltoDePagina"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Presento la información de los hechos sobre este contrato
                        </h5>
                        <div class="tracking-list">
                            <?php
                            $sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato";
                            $resultado = mysqli_query($conexion, $sentencia);
                            while ($fila = mysqli_fetch_object($resultado)) {
                                //print_r($fila);
                                //echo "<p><strong>" . $fila->descripcion . "</strong>";
                            ?>
                                <p>
                                    <h5><?php echo "<br><br><strong style='margin-left: 50px;'>Actividad:</strong><p style='margin-left: 50px;'><br> " . $fila->descripcion . ""; ?>
                                </p>
                                </h5>
                                </p>
                                <div class="tracking-item">
                                    <?php
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
                                                $ruta = '<p><b>Documentos y evidencias: </b><br><img src="' . $fila3->ruta . '" width="80%"></p>';
                                            } else {
                                                //Es un anexo, el contratista debe imprimirlo manualmente y adjuntarlo
                                                $ruta = '<p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: ->' . $tipo_archivo['filename'] . '.' . $tipo_archivo['extension'] . ' </p>';
                                            }
                                        }
                                    ?>
                                        <div class="tracking-icon status-intransit">
                                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                            </svg>
                                        </div>
                                        <div class="tracking-date"><?php
                                                                    // echo $fila2->fecha 
                                                                    /*
                                                                    $fecha1 = new DateTime($fila2->fecha);
                                                                    $fecha1->modify('-5 hours');
                                                                    echo $fecha1->format('Y-m-j h:i:s');
                                                                    */
                                                                    ?>Hecho</div>
                                        <div class="tracking-content">
                                            <p><strong>Descripción del hecho sobre esta actividad:</strong></p>
                                            <p><?php echo $fila2->hecho ?></p>
                                            <br><?php echo $ruta; ?><br><br><br>
                                        </div> <?php
                                            }
                                            echo '</div>';
                                        }
                                                ?>
                                </div>
                                <br>
                                <br>
                                <p class="page-title-subheading">
                                    Este informe corresponde a las generalidades de la prestación del servicio establecidas en el contrato y que pueden ser medidas, evaluadas y corroboradas con los anexos que presentamos a continuación.
                                </p>
                                <br>
                                <br>
                                <br>
                                <p>
                                    <table width="100%">
                                        <tr>
                                            <td width="50%">
                                                <center><?php echo $nombres . '' . $apellidos ?><br> CONTRATISTA</center>
                                            </td>
                                            <td width="50%">
                                                <center><?php echo $supervisor ?> <br> SUPERVISOR DEL CONTRATO</center>
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
</div>


</div>
</div>
</div>