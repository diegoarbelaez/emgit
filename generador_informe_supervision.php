<?php
include("conexion.php");

use Mpdf\Mpdf;

require_once('contratistas/vendor/autoload.php');
require_once('plantilla_supervisor.php');
//trae el css
//$css = file_get_contents('style_reporte.css'); 

//base de datos
//require_once('productos.php');


//$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);

$mpdf = new \Mpdf\Mpdf([
    "format" => "Legal",
    "img_dpi" => 96
]);

$mpdf->SetCompression(true);
$mpdf->SetFooter('{PAGENO} / {nb}');




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
$resultado_pago = mysqli_query($conexion, $sentencia_pago);
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

$resultado = mysqli_query($conexion, $sentencia_fechas);
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




$plantilla = getPlantilla(
    $fecha_inicio,
    $fecha_fin,
    $id_contratista,
    $numero_cuotas,
    $valor_mensual,
    $cuota_pagada,
    $eps,
    $pension,
    $arl,
    $fecha_impresion,
    $id_contrato,
    $nombres,
    $apellidos,
    $supervisor1,
    $supervisor2,
    $supervisor3,
    $valor_contrato
);
//$mpdf -> WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf->WriteHTML($plantilla);

/*

$mpdf->AddPage('L');
$mpdf->WriteHTML('<p>Esta es una nueva página</p>',\Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->AddPage('P','','','','',0,0,0,0); // Margenes
$mpdf->WriteHTML('<p>Esta es una nueva página Horizontal</p>',\Mpdf\HTMLParserMode::HTML_BODY); */

//Para guardar el PDF con el nombre del contratista y cédula, lo busco en BD
$sentencia_contratista = "select * from contratista where id_contratista=$id_contratista";
$resultado_contratista = mysqli_query($conexion,$sentencia_contratista);
$fila_contratista = mysqli_fetch_assoc($resultado_contratista);
$cedula_contratista = $fila->cedula;
$nombre_contratista = $fila->nombres;

$fecha_generacion = date("Y-m-d H:m:s");

//Se restan 5 horas por el tema de hora del servidor
$nueva_fecha = strtotime ('-5 hour',strtotime($fecha_generacion));
$fecha_final = date ('Y-m-d H:i:s',$nueva_fecha);




$mpdf->Output("Informe Supervisor.pdf", "I"); 
//$mpdf->Output("contratistas/SIAOBSERVA/SUPERVISORES/".$fecha_final ." ". $nombre_contratista ." ".$cedula_contratista. " informeSupervision.pdf", "F");