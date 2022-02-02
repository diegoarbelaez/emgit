<?php
ini_set("session.auto_start", 0);
require_once("../vendor/autoload.php");
require_once("plantilla_reporteador/plantilla_reporte.php");
$mpdf = new \Mpdf\Mpdf([]);//CSS de la plantilla
$css = file_get_contents("plantilla_reporteador/style.css");
// Plantilla HTML para el PDF

 $html = getPlantilla();
 //$html = "<p>Hola Diego</p>";
 $mpdf ->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf ->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_PARSE_NO_WRITE);
ob_end_clean();
$mpdf->Output();
?>