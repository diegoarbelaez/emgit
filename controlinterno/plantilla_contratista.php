<?php

//$salida = getPlantilla("2021-03-01 00:00:00","2021-03-31 23:59:59",102);
//echo $salida;

use Mpdf\Tag\PageBreak;

function getPlantilla($fecha_inicial, $fecha_final, $id_contratista)
{
    include("conexion.php");
    //Guarda las fechas en la tabla fechas_informe, para facilitar la generación de los informes en la plataforma SIA Observa
    $sentencia_fechas = "insert into fecha_informes_contratista (fk_id_contratista,fecha_inicio,fecha_fin) values ($id_contratista,'$fecha_inicial','$fecha_final')";
    $resultado_fechas = mysqli_query($conexion, $sentencia_fechas);




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
    $cedula = $fila3->cedula;
    $supervisor1 = $fila3->supervisor1;


    //Consulta de detalles del OtroSi, para mostrar en el informe de supervisión
    $sentencia_valor_otrosi = "SELECT * FROM otrosi where fk_id_contrato = $id_contrato";
    $resultado_valor_otrosi = mysqli_query($conexion, $sentencia_valor_otrosi);
    $fila_resultado_otrosi = mysqli_fetch_assoc($resultado_valor_otrosi);



    $plantilla = '
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_reporte.css">
</head>

<body>
    <table>
        <tr>
            <td><img src="logo_alcaldia_candelaria.png"></td>
            <td width="50%" style="text-align: center"><B>MUNICIPIO DE CANDELARIA</B> <BR> INFORME DE CONTRATISTA</td>
            <td>
                <table width="80px">
                    <tr>
                        <td style="text-align: left;">Código: 54-PGC-FT-100</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Fecha: 01-Junio-2021</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Versión: 7</td>
                    </tr>
                    <tr>
                         <td style="text-align: left;">Página {PAGENO} de {nbpg}</td>
                    </tr> 
                    
                </table>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td width="30%"><b>CONTRATO NUMERO: </b></td>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .=  $fila3->numero;
    $plantilla .= '</td>
        </tr>
        <tr>
            <td width="20%"><b>CONTRATISTA: </b></td>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .= $fila->nombres . ' ' . $fila->apellidos;
    $plantilla .= '</td>
        </tr>
        <tr>
            <td width="20%"><b>OBJETO CONTRACTUAL: </b></td>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .= $fila3->objeto;
    $plantilla .= '</td>
        </tr>
        <tr>
            <td width="20%"><b>CEDULA DE CIUDADANIA O NIT DEL CONTRATISTA:</b></td>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .= $fila->cedula;
    $plantilla .= '</td>
        </tr>
        <tr>
            <td width="20%"><b>VALOR DEL CONTRATO: </b>
                <td style="text-align: left; vertical-align: middle;">';
                $plantilla .= "$" . number_format($fila3->valor) . " + $" . number_format($fila_resultado_otrosi["monto_otrosi"]) . " = $" . number_format($fila_resultado_otrosi["monto_otrosi"] + $fila3->valor);
                $plantilla .= ' 
            </td>
        </tr>
        <tr>
            <td width="20%"><b>FECHA DEL INFORME: </b>
                <td style="text-align: left; vertical-align: middle;">';
    $plantilla .= "DE: " . $fecha_inicial . " A " . $fecha_final;
    $plantilla .= ' 
            </td>
        </tr>

        <tr>
            <td width="20%"><b>SUPERVISION:1 </b></td>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .=  $fila3->supervisor1;
    $plantilla .= '<br>' . $fila3->nombre;
    $plantilla .= '</td>
        </tr>';

    if (!empty($fila3->supervisor2)) {
        $plantilla .= '
            <tr>
                <td width="20%"><b>SUPERVISION:2</b></td>
                <td style="text-align: left; vertical-align: middle;">' . $fila3->supervisor2 . ' '  . $fila3->nombre . '</td>
            </tr>';
    }
    $plantilla .= '
    </table>
    <table>
        <tr>
            <td style="text-align: center"> <h2>AQUI SE DETALLAN LOS HECHOS DEL CONTRATISTA</h2> </td>
        </tr>
    </table>
    <div class="marco">
    
    
    
   ';


    //Como la BD tiene 5 horas de diferencia, y estamos haciendo una consulta es basado en fechas del servidor, entonces debemos agregar 5 horas a la fecha
    $fecha_inicial_reporte_tmp = strtotime ('+5 hour',strtotime($fecha_inicial));
    $fecha_inicial_reporte = date ('Y-m-d H:i:s',$fecha_inicial_reporte_tmp);   
        
    $fecha_final_reporte_tmp = strtotime ('+5 hour',strtotime($fecha_final));
    $fecha_final_reporte = date ('Y-m-d H:i:s',$fecha_final_reporte_tmp); 

    $soportes = array();
    $soportes_imagenes = array();
    $sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato";
    $resultado = mysqli_query($conexion, $sentencia);
    $primera_pagina = true;
    $div_primera_pagina = "<div>";
    $div_otras_paginas = '<div class="pagebreak">';
    while ($fila = mysqli_fetch_object($resultado)) {
        //Esta validación la hago para saber si estamos en la primer página no haga el salto sino que comience usando la hoja
        //ya para las proximas páginas, si hago el salto de página por cada actividad nueva que se incluye en el contrato
        if ($primera_pagina) {
            $plantilla .= $div_primera_pagina;
            $primera_pagina = false;
        } else {
            $plantilla .= $div_otras_paginas;
        }
        $plantilla .= '<br><br><p class="actividad"><b>Actividad:</b> ' . $fila->descripcion . '</p>';
        $id_actividad = $fila->id_actividad;
        $sentencia2 = "SELECT * from log WHERE fk_id_actividad=$id_actividad and fecha BETWEEN '$fecha_inicial_reporte' AND '$fecha_final_reporte' order by fecha desc";
        $resultado2 = mysqli_query($conexion, $sentencia2);
        $plantilla .= '<p class="hecho">Hechos realizados: </p>';
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
                    $ruta = '<b>Documentos y evidencias: </b><br><img src="../contratistas/' . rawurlencode($fila3->ruta) . '" width="30%"><br>';
                    //$ruta = '<p><b>Documentos y evidencias: </b></p><br><!-- <img src="https://images.unsplash.com/photo-1578496480157-697fc14d2e55?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8c2FtcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" width="720px" height="300px" > -->';
                    array_push($soportes, $ruta);
                } else {
                    //Es un anexo, el contratista debe imprimirlo manualmente y adjuntarlo
                    $ruta = '<p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: -><a href="http://mipgenlinea.com/candelaria/contratistas/' . htmlentities($fila3->ruta) . '" target="new">Descargar </a>"' . $tipo_archivo['filename'] . '.' . $tipo_archivo['extension'] . ' </p>';
                    array_push($soportes_imagenes, $ruta);
                }
            }
            $plantilla .= '<div><p class="texto_hecho">' . $fila2->hecho . '</p></div>';
            //echo '<br>'. $fila2->fecha;
        }
        //var_dump($soportes);
        $plantilla .= '<table><tr>';
        foreach ($soportes as $texto) {
            $plantilla .= "<td><div> " . $texto . "</div></td>";
        }
        $plantilla .= '</tr></table>';
        $plantilla .= '<table>';
        foreach ($soportes_imagenes as $texto) {
            $plantilla .= "<tr><td><div> " . $texto . "</div></td></tr>";
        }
        $plantilla .= '</table>';
        $soportes = array();
        $soportes_imagenes = array();
        $plantilla .= '</div>';
    }






    $plantilla .= '
        </div>
        ';

    $plantilla .= '
        <p>
        <table width="100%">
            <tr>
                <td width="50%">
                    <center>NOMBRE Y FIRMA DEL CONTRATISTA<br><br><br><br><br><br><br>' . $nombres . ' ' . $apellidos . '<br>' . $cedula . '</center>
                </td>
            </tr>
        </table>
        </p>';

    $plantilla .= '
        <htmlpagefooter name="myFooter1" style="display:none border:0px ">
        <table width="100%">
            <tr>
                <td width="10%" align="center" style="font-weight: bold; font-size:9; font-style: italic;">
                    Página {PAGENO} de {nbpg}
                </td>
                <td width="90%" style="text-align: center; font-size:9;">
                    UNA VEZ IMPRESO ESTE DOCUMENTO SE CONSIDERA COPIA NO CONTROLADA Y NO NOS HACEMOS RESPONSABLES POR SU ACTUALIZACION
                </td>
            </tr>
        </table>
        </htmlpagefooter>
        <htmlpagefooter name="myFooter2" style="display:none">
            <table width="100%">
                <tr>
                    <td width="33%">My document</td>
                    <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                    <td width="33%" style="text-align: right;">{DATE j-m-Y}</td>
                </tr>
            </table>
        </htmlpagefooter>
        </body>
        </html>';



    return $plantilla;
}
