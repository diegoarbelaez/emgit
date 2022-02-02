<?php
 
use Mpdf\Mpdf;

require_once('vendor/autoload.php');
//require_once('plantilla_contratista.php');
//trae el css
$css = file_get_contents('style_reporte.css'); 

//base de datos
//require_once('productos.php');


//$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);

$mpdf = new \Mpdf\Mpdf([
    "format" => "Legal",
    "img_dpi" => 96,
    "debug" => true
]);

$mpdf->SetCompression(true);
$mpdf->SetFooter('{PAGENO} / {nb}');






$plantilla = getPlantilla();
//$mpdf -> WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);

$mpdf -> WriteHTML($plantilla);

/*

$mpdf->AddPage('L');
$mpdf->WriteHTML('<p>Esta es una nueva página</p>',\Mpdf\HTMLParserMode::HTML_BODY);

$mpdf->AddPage('P','','','','',0,0,0,0); // Margenes
$mpdf->WriteHTML('<p>Esta es una nueva página Horizontal</p>',\Mpdf\HTMLParserMode::HTML_BODY); */


$mpdf->Output("Informe Contratista.pdf","I");


function getPlantilla(){

$plantilla2 = '
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_reporte.css">
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td><img src="logo_alcaldia_candelaria.png"></td>
                <td width="50%"><b>MUNICIPIO DE CANDELARIA</b> <br> INFORME DE CONTRATISTA</td>
                <td>
                    <table width="80px">
                        <tbody>
                            <tr>
                                <td style="text-align: left;">Código: 54-PGC-FT-100</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Fecha: 01-Julio-2017</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Versión: 5</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Página {PAGENO} de {nbpg}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <tbody>
            <tr>
                <td width="30%"><b>CONTRATO NUMERO: </b></td>
                <td style="text-align: left; vertical-align: middle;">203-13-02-058</td>
            </tr>
            <tr>
                <td width="20%"><b>CONTRATISTA: </b></td>
                <td style="text-align: left; vertical-align: middle;">YAMILETH SANTANA OVIEDO</td>
            </tr>
            <tr>
                <td width="20%"><b>OBJETO CONTRACTUAL: </b></td>
                <td style="text-align: left; vertical-align: middle;">PRESTACIÓN DE SERVICIOS PROFESIONALES DE APOYO
                    COMO PUBLICISTA AL FORTALECIMIENTO DE LA COMUNICACIÓN INTERNA Y EXTERNA PARA EL FORTALECIMIENTO
                    INSTITUCIONAL DE LA ADMINISTRACIÓN MUNICIPAL DE LA ALCALDÍA DE CANDELARIA.</td>
            </tr>
            <tr>
                <td width="20%"><b>CEDULA DE CIUDADANIA O NIT DEL CONTRATISTA:</b></td>
                <td style="text-align: left; vertical-align: middle;">1113619516</td>
            </tr>
            <tr>
                <td width="20%"><b>VALOR DEL CONTRATO: </b>
                </td>
                <td style="text-align: left; vertical-align: middle;">$28,800,000
                </td>
            </tr>
            <tr>
                <td width="20%"><b>FECHA DEL INFORME: </b>
                </td>
                <td style="text-align: left; vertical-align: middle;">DE: 2021-06-01 00:00:00 A 2021-06-10 23:59:59
                </td>
            </tr>

            <tr>
                <td width="20%"><b>SUPERVISION:1 </b></td>
                <td style="text-align: left; vertical-align: middle;">MARTHA ROCIO BANGUERA ALBORNOZ<br>Secretaria
                    Desarrollo Administrativo</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td>
                    <h1>AQUI SE DETALLAN LOS HECHOS DEL CONTRATISTA</h1>
                </td>
            </tr>
        </tbody>
    </table>
    <table width="100%">
            <tr>
                <td><br>
                    <p class="actividad">Actividad: Diseñar diferentes elementos publicitarios que requiere la entidad
                        como material impreso folletos, vallas publicitarias y demás artículos.<br><br>
                    </p>
                    <p class="hecho">Hechos realizados: </p>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseño diferentes elementos publicitarios para la estrategia comunicativa
                        participando juntos, Avanzamos, diseño de camiseta para uso en las actividades descentralizadas.
                    </p>
                    <p></p><br>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseño diferentes elementos publicitarios para la estrategia comunicativa
                        participando juntos, Avanzamos, diseños de pasacalle de 500x75cms para uso en los espacios
                        descentralizados.</p>
                    <p></p><br>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseñó pasacalle para el enlace de primera infancia que hace parte de las piezas
                        informativas y publicitarias para El programa de primera infancia, infancia y Adolescencia y
                        fortalecimiento familiar (piiaff) de la Secretaría de desarrollo social y programas Especiales
                        en el municipio de candelaria.</p>
                    <p></p><br>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseñó el Dado que hace parte del Kit Villajuego, que hace parte de las piezas
                        informativas y publicitarias para El programa de primera infancia, infancia y Adolescencia y
                        fortalecimiento familiar (piiaff) de la Secretaría de desarrollo social y programas Especiales
                        en el municipio de candelaria.</p>
                    <p>&nbsp;</p>
                    <p></p><br>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseñó el ajuste de tarjetas de juego concéntrese que hace parte del Kit
                        Villajuego, que hace parte de las piezas informativas y publicitarias para El programa de
                        primera infancia, infancia y Adolescencia y fortalecimiento familiar (piiaff) de la Secretaría
                        de desarrollo social y programas Especiales en el municipio de candelaria.</p>
                    <p></p><br>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseñó el ajuste de tarjetas de juego caos, alertas y prácticas positivas que hace
                        parte del Kit Villajuego, que hace parte de las piezas informativas y publicitarias para El
                        programa de primera infancia, infancia y Adolescencia y fortalecimiento familiar (piiaff) de la
                        Secretaría de desarrollo social y programas Especiales en el municipio de candelaria.</p>
                    <p></p><br>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseñó el bolsillo del canguro que hace parte del canguro kit del OJN objeto de
                        juego no identificado, que hace parte de las piezas informativas y publicitarias para El
                        programa de primera infancia, infancia y Adolescencia y fortalecimiento familiar (piiaff) de la
                        Secretaría de desarrollo social y programas Especiales en el municipio de candelaria.</p>
                    <p></p><br>
                    <p class="texto_hecho"></p>
                    <p>El contratista diseño Portada y contraportada de block que hace parte del canguro kit del OJN
                        objeto de juego no identificado, que hace parte de las piezas informativas y publicitarias para
                        El programa de primera infancia, infancia y Adolescencia y fortalecimiento familiar (piiaff) de
                        la Secretaría de desarrollo social y programas Especiales en el municipio de candelaria</p>
                    <p></p><br>
                    <p><b>Documentos y evidencias: </b><br><img
                            src="evidencias/YAMILETH/Camiseta partipando juntos avanzamos.png" width="50%"></p><br>
                    <p><b>Documentos y evidencias: </b><br><img
                            src="evidencias/YAMILETH/Pasacalle 1_ particpando avanzamos.png" width="50%"></p><br>
                    <p><b>Documentos y evidencias: </b><br><img
                            src="evidencias/YAMILETH/pasacalle 2_ enlace primera infancia _.png" width="50%"></p><br>
                    <p><b>Documentos y evidencias: </b><br><img
                            src="evidencias/YAMILETH/Diseño dado kit villa juego.png" width="50%"></p><br>
                    <p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: -&gt;<a
                            href="tarjetas consentre .pdf" target="new">Descargar </a>"tarjetas consentre .pdf </p><br>
                    <p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: -&gt;<a
                            href="Tarjetas-VillaJuego-de-mensajes.pdf" target="new">Descargar
                        </a>"Tarjetas-VillaJuego-de-mensajes.pdf </p><br>
                    <p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: -&gt;<a
                            href="troquel bolsillo canguro.pdf" target="new">Descargar </a>"troquel bolsillo canguro.pdf
                    </p><br>
                    <p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: -&gt;<a
                            href="portada y contra portada block.pdf" target="new">Descargar </a>"portada y contra
                        portada block.pdf </p><br>
                </td>
            </tr>
           


       
    </table>
    <p>
    <table width="100%">
        <tbody>
            <tr>
                <td width="50%">
                    <center>NOMBRE Y FIRMA DEL CONTRATISTA<br><br><br><br><br><br><br>YAMILETH SANTANA
                        OVIEDO<br>1113619516</center>
                </td>
            </tr>
        </tbody>
    </table>
    </p>
    <htmlpagefooter name="myFooter1" style="display:none border:0px ">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="33%" align="center" style="font-weight: bold; font-size:9; font-style: italic;">
                        Página {PAGENO} de {nbpg}
                    </td>
                    <td width="33%" style="text-align: center; font-size:9;">
                        Generado por MegaInforme
                    </td>
                    <td width="33%" style="text-align: right; font-size:9;">Fecha de Impresión: {DATE j-m-Y}</td>
                </tr>
            </tbody>
        </table>
    </htmlpagefooter>
    <htmlpagefooter name="myFooter2" style="display:none">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="33%">My document</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="text-align: right;">{DATE j-m-Y}</td>
                </tr>
            </tbody>
        </table>
    </htmlpagefooter>

</body>
</html>
';
return $plantilla2;
}