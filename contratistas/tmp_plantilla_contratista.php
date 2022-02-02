<?php

    $salida = getPlantilla("2021-06-01 00:00:00","2021-06-10 23:59:59",203);
    echo $salida;

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
            <td width="50%"><B>MUNICIPIO DE CANDELARIA</B> <BR> INFORME DE CONTRATISTA</td>
            <td>
                <table width="80px">
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
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br>
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
        $plantilla .= "$" . number_format($fila3->valor);
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
            <td> <h1>AQUI SE DETALLAN LOS HECHOS DEL CONTRATISTA</h1> </td>
        </tr>
    </table>
    <table width="100%">
    
    
   ';

        $fecha_inicial_reporte = $fecha_inicial;
        $fecha_final_reporte = $fecha_final;


        $soportes = array();
        $sentencia = "SELECT * from actividades where fk_id_contrato = $id_contrato";
        $resultado = mysqli_query($conexion, $sentencia);
        while ($fila = mysqli_fetch_object($resultado)) {
            $plantilla .= '<tr><td style="text-align:left;">';
            $plantilla .= '<br><p class="actividad">Actividad: ' . $fila->descripcion . '<br><br></p>';
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
                        $ruta = '<p><b>Documentos y evidencias: </b><br><img src="' . $fila3->ruta . '" width="50%"></p>';
                        array_push($soportes, $ruta);
                    } else {
                        //Es un anexo, el contratista debe imprimirlo manualmente y adjuntarlo
                        $ruta = '<p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: -><a href="' . $tipo_archivo['filename'] . '.' . $tipo_archivo['extension'] . '" target="new">Descargar </a>"' . $tipo_archivo['filename'] . '.' . $tipo_archivo['extension'] . ' </p>';
                        array_push($soportes, $ruta);
                    }
                }
                $plantilla .= '<p class="texto_hecho">' . $fila2->hecho . '</p><br>';
                //echo '<br>'. $fila2->fecha;
            }
            foreach ($soportes as $texto) {
                $plantilla .= " " . $texto . "<br>";
            }
            $soportes = array();

            $plantilla .= '</tr></td>';
        }






        $plantilla .= '
        </td>
        </tr>
        </table>';

        $plantilla .= '
        <p>
        <table width="100%">
            <tr>
                <td width="50%">
                    <center>NOMBRE Y FIRMA DEL CONTRATISTA<br><br><br><br><br><br><br>'.$nombres . ' ' . $apellidos .'<br>'.$cedula.'</center>
                </td>
            </tr>
        </table>
        </p>';

        $plantilla .= '
        <htmlpagefooter name="myFooter1" style="display:none border:0px ">
        <table width="100%">
            <tr>
                <td width="33%" align="center" style="font-weight: bold; font-size:9; font-style: italic;">
                    Página {PAGENO} de {nbpg}
                </td>
                <td width="33%" style="text-align: center; font-size:9;">
                    Generado por MegaInforme
                </td>
                <td width="33%" style="text-align: right; font-size:9;">Fecha de Impresión: {DATE j-m-Y}</td>
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
