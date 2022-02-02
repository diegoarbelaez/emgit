<?php

use Mpdf\Tag\PageBreak;

function getPlantilla(
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
) {
    include("conexion.php");
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
    $otrosi = $fila3->otrosi;
    $numero_contrato = $fila3->numero;

    //Consulta de detalles del OtroSi, para mostrar en el informe de supervisión
    $sentencia_valor_otrosi = "SELECT * FROM otrosi where fk_id_contrato = $id_contrato";
    $resultado_valor_otrosi = mysqli_query($conexion, $sentencia_valor_otrosi);
    $fila_resultado_otrosi = mysqli_fetch_assoc($resultado_valor_otrosi);


    $plantilla = '
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="contratistas/style_reporte.css">
</head>
<header class="clearfix">
<body>
    <table>
        <tr>
            <td><img src="logo_alcaldia_candelaria.png"></td>
            <td style="text-align: center;"><B>MUNICIPIO DE CANDELARIA</B> <BR> INFORME DE SUPERVISOR</td>
            <td>
                <table class="sinborde">
                    <tr>
                        <td>Código: 54-PGC-FT-99</td>
                    </tr>
                    <tr>
                        <td>Fecha: 01-Junio-2021</td>
                    </tr>
                    <tr>
                        <td>Versión: 06</td>
                    </tr>
                    <tr>
                    <td style="text-align: left;">Página {PAGENO} de {nbpg}</td>
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
            <td style="text-align: left; vertical-align: middle;">' . $fila3->numero . '</td>
        </tr>
        <tr>
            <td width="20%"><b>CONTRATANTE: </b></td>
            <td style="text-align: left; vertical-align: middle;">MUNICIPIO DE CANDELARIA</td>
        </tr>
        <tr>
            <td width="20%"><b>CONTRATISTA: </b></td>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .= $fila3->nombres . ' ' . $fila3->apellidos;
    $plantilla .= '</td>;
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
            <td width="20%"><b>FECHA DE INICIO: </b>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .=  $fila3->fecha_inicio;
    $plantilla .= '</td>
        </tr>
        <tr>
            <td width="20%"><b>FECHA DE FINALIZACIÓN: </b>
            <td style="text-align: left; vertical-align: middle;">';

    $fecha_final_mostrar = $fila3->fecha_fin;
    if ($otrosi > 0) {
        $fecha_final_mostrar = $fila_resultado_otrosi["fecha_fin"];
    }

    $plantilla .= $fecha_final_mostrar;



    $plantilla .= '</td>
        </tr>
        <tr>
            <td width="20%"><b>VALOR DEL CONTRATO: </b>
            <td style="text-align: left; vertical-align: middle;">';

    //Regla que se creó solo para el contrato con el hospital 203-13-10-002
    if($numero_contrato == '203-13-10-002'){
        $plantilla .= "$519,923,386 + $180.000.000 = $699.923.386";
    }
    else if($numero_contrato == '203-13-10-006'){
        $plantilla .= "$519,923,386 + $24.500.000 = $724.467.315";
    }
    else {
    $plantilla .= "$" . number_format($fila3->valor) . " + $" . number_format($fila_resultado_otrosi["monto_otrosi"]) . " = $" . number_format($fila_resultado_otrosi["monto_otrosi"] + $fila3->valor);
    }

    $plantilla .= '</td>
        </tr>
        <tr>
            <td width="20%"><b>SUPERVISION:1 </b></td>
            <td style="text-align: left; vertical-align: middle;">';
    $plantilla .= $fila3->supervisor1;
    $plantilla .= '<br>';
    $plantilla .= $fila3->nombre;
    $plantilla .= '</td>
        </tr>';


    if (!empty($fila3->supervisor2)) {
        $plantilla .= '
            <tr>
                <td width="20%"><b>SUPERVISION:2</b></td>
                <td style="text-align: left; vertical-align: middle;">';
        $plantilla .= $fila3->supervisor2;
        $plantilla .= '<br>';
        $plantilla .= $fila3->nombre;
        $plantilla .= '</td>
            </tr>';
    }
    if (!empty($fila3->supervisor3)) {
        $plantilla .= '
            <tr>
                <td width="20%"><b>SUPERVISION:3</b></td>
                <td style="text-align: left; vertical-align: middle;">';
        $plantilla .= $fila3->supervisor3;
        $plantilla .= '<br>';
        $plantilla .= $fila3->nombre;
        $plantilla .= '</td>
            </tr>';
    }
    $plantilla .= '
    </table>
    <div>
        <p>
            Una vez revisado el informe de actividades del contratista, correspondiente al periodo de';

    $fecha_1 = new DateTime($fecha_inicio);
    $fecha_2 = new DateTime($fecha_fin);
    $plantilla .=  $fecha_1->format('Y-m-d') . " a " . $fecha_2->format('Y-m-d');

    $plantilla .= ' se corrobora que en las actividades contratadas se evidencia el siguiente avance.
        </p>
    </div>
    <table>
        <tr>
            <td style="text-align: center"> <h2>AQUI SE DETALLAN LOS HECHOS VALIDADOS POR EL SUPERVISOR DEL CONTRATO</h2> </td>
        </tr>
    </table>

    <!-- Contenido del Informe -->
    <div class="marco">

';

    //Como la BD tiene 5 horas de diferencia, y estamos haciendo una consulta es basado en fechas del servidor, entonces debemos agregar 5 horas a la fecha
    $fecha_inicial_reporte_tmp = strtotime('+5 hour', strtotime($fecha_inicio));
    $fecha_inicio = date('Y-m-d H:i:s', $fecha_inicial_reporte_tmp);

    $fecha_final_reporte_tmp = strtotime('+5 hour', strtotime($fecha_fin));
    $fecha_fin = date('Y-m-d H:i:s', $fecha_final_reporte_tmp);



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
        $sentencia2 = "SELECT * from log WHERE fk_id_actividad=$id_actividad and fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' order by fecha desc";
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
                    $ruta = '<b>Documentos y evidencias: </b><br><img src="contratistas/' . rawurlencode($fila3->ruta) . '" width="30%"><br>';
                    array_push($soportes, $ruta);
                } else {
                    //Es un anexo, el contratista debe imprimirlo manualmente y adjuntarlo
                    $ruta = '<p><b>Documentos y evidencias: </b>Se anexa a este hecho el siguiente archivo: -><a href="http://mipgenlinea.com/candelaria/contratistas/' . htmlentities($fila3->ruta) . '" target="new"> Descargar </a>' . $tipo_archivo['filename'] . '.' . $tipo_archivo['extension'] . ' </p>';
                    array_push($soportes_imagenes, $ruta);
                }
            }
            $plantilla .= '<div>' . $fila2->hecho . '</div>';
        }
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

    //PARRAFO PARA REGLAS DE PAGOS, SEGÚN EL CONTRATISTA

    switch ($numero_contrato) {
        case '203-13-02-310':
            //ESTA REGLA SE HIZO PARA EL CONTRATISTA Leidy Melissa Muñoz Ortiz
            //QUE TIENE UN PLAN DE PAGOS DIFERENTE Y NO SON CUOTAS MENSUALES
            $plantilla .= '
            </div>
            <p><b><h2>INFORME FINANCIERO</h2></b></p>
            <p>
            El <b>MUNICIPIO</b> pagará al <b>CONTRATISTA</b> el valor por concepto de honorarios, de la siguiente manera: UN MILLON CUATROCIENTOS CINCUENTA 
            MIL PESOS M/CTE ($1.450.000) al 30 de septiembre y tres actas por valor de DOS MILLONES NOVENCIENTOS MIL PESOS ($2.900.000), previa presentación 
            y aprobación del informe de actividades por el Supervisor del contrato.';

            $plantilla .= '<br><br></p>';
            // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
            break;

        case '203-13-02-287':
            //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
            //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
            $plantilla .= '
                </div>
                <p><b><h2>INFORME FINANCIERO</h2></b></p>
                <p>
                La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                de conformidad con el presente contrato, la cantidad de ';
            $plantilla .=  $valor_contrato;
            $plantilla .= ' Pagados en 1 cuota por valor de $2.917.000 y 5 cuotas por valor de $5.416.600. ';
            $plantilla .= '<br></p>';
            // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
            break;
        case '203-13-03-657';
            //ESTA REGLA SE HIZO PARA EL CONTRATISTA JOAN ANDRES CAICEDO MOSQUERA
            //QUE TIENE UN PLAN DE PAGOS DIFERENTE Y NO SON CUOTAS MENSUALES
            $plantilla .= '
            </div>
            <p><b><h2>INFORME FINANCIERO</h2></b></p>
            <p>
            El <b>MUNICIPIO</b> pagará al <b>CONTRATISTA</b> el valor por concepto de honorarios, de la siguiente manera: Un acta parcial por valor de 
            ocicientos mil pesos ($800.000) al 31 de agosto y cuatro actas por valor de <b>UN MILLÓN SEISCIENTOS MIL PESOS M/CTE ($1.600.000)</b> 
            previa presentación y aprobación del informe de actividades por el Supervisor del contrato, de igual manera el contratista deberá 
            portar copia del pago de los aportes de la Seguridad Social. Salvo la última cuota correspondiente al mes de diciembre de 2021, 
            la cual será tramitada por la supervisión dentro de los primeros diez (10) días del mes de diciembre y su pago se realizará en 
            la fecha que programe la Secretaría de Hacienda';

            $plantilla .= '<br><br></p>';
            // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
            break;

        default:

            $plantilla .= '
        </div>
                <p><b><h2>INFORME FINANCIERO</h2></b></p>
                <p>
                La <b>ALCALDIA MUNICIPAL DE CANDELARIA </b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue, de conformidad con el presente contrato, la cantidad de ';
            $plantilla .=  $valor_contrato;
            $plantilla .= ' Pagados en cuotas mensuales por valor de $';
            //$plantilla .= $numero_cuotas;
            //$plantilla .= ' cuotas de igual valor, por valor de $';
            $plantilla .= number_format($valor_mensual) . ".";
            $plantilla .= ' , que corresponde a una periodicidad mensual y/o al porcentaje de las actividades realizadas en el periodo de tiempo determinado. ';
            $plantilla .= '<br><br></p>';
            // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}


            break;
    }


    $sentencia_validar = "SELECT * FROM pagos WHERE fk_id_contrato=$id_contrato";
    $restultado_validar = mysqli_query($conexion, $sentencia_validar);
    if (mysqli_num_rows($restultado_validar) >= 1) {
        $plantilla .= '
                    <p>
                    <table style="page-break-inside: avoid">
                        <tr>
                            <th>Fecha de Pago</th>
                            <th>Valor Bruto</th>
                            <th>Descuentos</th>
                            <th>Valor Neto Pagado</th>
                            <th>Saldo</th>
                        </tr>';
        $sentencia = "SELECT * FROM pagos WHERE fk_id_contrato=$id_contrato";
        $resultado = mysqli_query($conexion, $sentencia);
        while ($fila_pagos =  mysqli_fetch_assoc($resultado)) {
            $plantilla .= '<tr>';
            $plantilla .= '<td>' . $fila_pagos["fecha_pago"] . '</td>';
            $plantilla .= '<td> $' . number_format($fila_pagos["valor_bruto"]) . '</td>';
            $plantilla .= '<td> $' . number_format($fila_pagos["descuentos"]) . '</td>';
            $plantilla .= '<td> $' . number_format($fila_pagos["valor_neto"]) . '</td>';
            $plantilla .= '<td> $' . number_format($fila_pagos["saldo"]) . '</td>';
        }
        $plantilla .= '</tr></table></p>';
    }

    if ($otrosi == 1) { //Aquí entra cuando el contrato tiene un Otrosi, entonces imprime los pagos y el texto correspondiente
        $sentencia_validar = "SELECT * FROM pagos_otrosi WHERE fk_id_contrato=$id_contrato";
        $restultado_validar = mysqli_query($conexion, $sentencia_validar);
        if (mysqli_num_rows($restultado_validar) >= 1) {

            //SWITCH QUE DETERMINA EL TEXTO A PONER SEGÚN LA MODALIDAD DE PAGOS QUE SE HAYA PACTADO EN EL OTROSI
            //ENTONCES SEGÚN EL NUMERO DE CONTRATO, HACE EL RESPECTIVO TEXTO
            $sentencia_valor_otrosi = "SELECT * from otrosi where fk_id_contrato=$id_contrato";
            $resultado_valor_otrosi = mysqli_query($conexion, $sentencia_valor_otrosi);
            $fila_valor_otrosi = mysqli_fetch_assoc($resultado_valor_otrosi);
            $valor_otrosi = "$" . number_format($fila_valor_otrosi["monto_otrosi"]);
            $valor_mensual_otrosi = $fila_valor_otrosi["monto_otrosi"] / $fila_valor_otrosi["cuotas_otrosi"];

            switch ($numero_contrato) {
                case '203-13-03-085':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                        </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 3 cuotas de $1.485.714  y una cuota adicional de $ 712.857. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;
                case '203-13-03-072':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                        </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 3 cuotas de $ 1.600.000  y una cuota adicional de $ 800.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;
                case '203-13-02-015':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                        </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 3 cuotas de $ 2.727.885 y una cuota adicional de $ 1.363.945. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;
                case '203-13-02-039':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                        </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 3 cuotas de $2.727.885 y una cuota adicional de $ 1.363.945. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;
                case '203-13-02-027':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                        </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 3 cuotas de $ 6.108.571 y una cuota adicional de $ 3.054.285. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;
                case '203-13-02-010':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                        </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 3 cuotas de $ 5.714.000 y una cuota adicional de $2.858.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;
                case '203-13-02-287':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                        </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 1 cuota por valor de $2.917.000 y 5 cuotas por valor de $5.416.600. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;


                case '203-13-03-307':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                            </div>
                            <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                            <p>
                            La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                            de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $ 1.400.000 y una cuota adicional de $700.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;

                case '203-13-03-219':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                                </div>
                                <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                <p>
                                La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $ 2.200.000 y una cuota adicional de $1.100.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;

                case '203-13-03-270':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                                    </div>
                                    <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                    <p>
                                    La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                    de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $ 1.400.000 y una cuota adicional de $700.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;

                case '203-13-03-348':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                                        </div>
                                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                        <p>
                                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $ 1.550.000 y una cuota adicional de $ 775.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;


                case '203-13-03-164':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                                            </div>
                                            <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                            <p>
                                            La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                            de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $ 2.014.000 y una cuota adicional de $ 1.007.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;

                case '203-13-03-292':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                                                </div>
                                                <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                                <p>
                                                La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                                de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $1.500.000  y una cuota adicional de $ 750.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;


                case '203-13-03-246':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                                                    </div>
                                                    <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                                    <p>
                                                    La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                                    de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $ 2.000.000 y una cuota adicional de $1.000.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;

                case '203-13-03-192':
                    //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                    //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                    $plantilla .= '
                                                        </div>
                                                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                                        <p>
                                                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                                        de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en 2 cuotas de $ 1.450.000 y una cuota adicional de $725.000. ';
                    $plantilla .= '<br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                    break;

                    case '203-13-03-496':
                        //ESTA REGLA SE HIZO PARA VALIDAR QUE EL CONTRATISTA LINA MARIA SANCHEZ LOPEZ
                        //LE HICIERON UN CONTRATO ATIPICO CON PAGOS ATIPICOS
                        $plantilla .= '
                                                            </div>
                                                            <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                                                            <p>
                                                            La <b>ALCALDIA MUNICIPAL DE CANDELARIA</b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue,
                                                            de conformidad con el presente otrosi, la cantidad de ';
                        $plantilla .=  $valor_otrosi;
                        $plantilla .= ' Pagados en 2 cuotas de $ 1.400.000 y una cuota adicional de $700.000. ';
                        $plantilla .= '<br></p>';
                        // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}
                        break;
    

                default:
                    $plantilla .= '
                </div>
                        <p><b><h2>PLAN DE PAGOS DEL OTROSI</h2></b></p>
                        <p>
                        La <b>ALCALDIA MUNICIPAL DE CANDELARIA </b> se obliga a pagar al contratista por los servicios que preste o suministros que entregue, de conformidad con el presente otrosi, la cantidad de ';
                    $plantilla .=  $valor_otrosi;
                    $plantilla .= ' Pagados en cuotas mensuales por valor de $';
                    //$plantilla .= $numero_cuotas;
                    //$plantilla .= ' cuotas de igual valor, por valor de $';
                    $plantilla .= number_format($valor_mensual_otrosi) . ".";
                    $plantilla .= ' , que corresponde a una periodicidad mensual y/o al porcentaje de las actividades realizadas en el periodo de tiempo determinado. ';
                    $plantilla .= '<br><br></p>';
                    // Valido primero si hay filas para mostrar, si no hay, no muestro el cuadro de pagos -->}


                    break;
            }

            $plantilla .= '<p>
            <br>
            <b>INFORME DE PAGOS DEL OTROSI</b>
            <br>
            <br>
            </p>';
            $plantilla .= '
                            <p>
                            <table style="page-break-inside: avoid">
                                <tr>
                                    <th>Fecha de Pago</th>
                                    <th>Valor Bruto</th>
                                    <th>Descuentos</th>
                                    <th>Valor Neto Pagado</th>
                                    <th>Saldo</th>
                                </tr>';
            $sentencia = "SELECT * FROM pagos_otrosi WHERE fk_id_contrato=$id_contrato";
            $resultado = mysqli_query($conexion, $sentencia);
            while ($fila_pagos =  mysqli_fetch_assoc($resultado)) {
                $plantilla .= '<tr>';
                $plantilla .= '<td>' . $fila_pagos["fecha_pago"] . '</td>';
                $plantilla .= '<td> $' . number_format($fila_pagos["valor_bruto"]) . '</td>';
                $plantilla .= '<td> $' . number_format($fila_pagos["descuentos"]) . '</td>';
                $plantilla .= '<td> $' . number_format($fila_pagos["valor_neto"]) . '</td>';
                $plantilla .= '<td> $' . number_format($fila_pagos["saldo"]) . '</td>';
            }
            $plantilla .= '</tr></table></p>';
        }

        $plantilla .= '<p>
        <br>
        En consecuencia, se aprueba el cumplimiento de las actividades encomendadas en el objeto contractual de la referencia y se declara
        el recibo del bien o servicio a satisfacción puesto que cumple a cabalidad con lo contratado, y se autoriza el pago de la cuota del Otrosí, correspondiente al periodo: ' . $fecha_1->format("Y-m-d") . ' a ' . $fecha_2->format("Y-m-d") . '.
        Así mismo el suscrito supervisor, certifica que el contratista ha cumplido con sus obligaciones respecto de la afiliación de seguridad social.
        <br>
        <br>
        </p>';
    } elseif ($numero_contrato == '203-13-10-002') {
        //ESTA VALIDACION SE HACE PORQUE EN LA FECHA 20/08/2021 AL CONTRATO DEL HOSPITAL LE HICIERON UN OTROSI Y LA REGLA FUE
        //1. HACER EL OTROSI, 2. PAGAR LO DEL OTROSI, 3. TIENEN CUOTAS PENDIENTES Y SE DEBEN SEGUIR PAGANDO, Y NO SE CUMPLE LA NORMA DE AGREGAR UN OTROSI, SOLO CUANDO LOS SALDOS ESTÉN EN $0
        //SE IMPRIME ESTE TEXTO, SOLO PARA ESE CONTRATO
        //EN ESTE CASO, NO HAY OTROSI, PERO SI HAY QUE MOSTRAR TEXTO DE OTROSI, CON VALORES ESTABLECIDOS

        $plantilla .= '<p>
            <br>
            <b>INFORME DE PAGOS DEL OTROSI</b>
            </p>';

        $plantilla .= '<p>
        <br>
        En consecuencia, se aprueba el cumplimiento de las actividades encomendadas en el objeto contractual de la referencia y se declara
        el recibo del bien o servicio a satisfacción puesto que cumple a cabalidad con lo contratado, y se autoriza el pago de la cuota del Otrosí, correspondiente al periodo: ' . $fecha_1->format("Y-m-d") . ' a ' . $fecha_2->format("Y-m-d") . '.
        Así mismo el suscrito supervisor, certifica que el contratista ha cumplido con sus obligaciones respecto de la afiliación de seguridad social.
        <br>
        <br>
        </p>';


        $plantilla .= '
        <p>
        <table style="page-break-inside: avoid">
            <tr>
                <th>Fecha de Pago</th>
                <th>Valor Bruto</th>
                <th>Descuentos</th>
                <th>Valor Neto Pagado</th>
                <th>Saldo</th>
            </tr>';
        $plantilla .= '<tr>';
        $plantilla .= '<td>2021-08-20</td>';
        $plantilla .= '<td> $180.000.000</td>';
        $plantilla .= '<td> $0</td>';
        $plantilla .= '<td> $180.000.000</td>';
        $plantilla .= '<td> $0</td>';
        $plantilla .= '</tr></table></p>';
        $plantilla .= '<br>';
        $plantilla .= '<br>';
    } 
    
    elseif ($numero_contrato == '203-13-10-006') {
        //ESTA VALIDACION SE HACE PORQUE EN LA FECHA 20/08/2021 AL CONTRATO DEL HOSPITAL LE HICIERON UN OTROSI Y LA REGLA FUE
        //1. HACER EL OTROSI, 2. PAGAR LO DEL OTROSI, 3. TIENEN CUOTAS PENDIENTES Y SE DEBEN SEGUIR PAGANDO, Y NO SE CUMPLE LA NORMA DE AGREGAR UN OTROSI, SOLO CUANDO LOS SALDOS ESTÉN EN $0
        //SE IMPRIME ESTE TEXTO, SOLO PARA ESE CONTRATO
        //EN ESTE CASO, NO HAY OTROSI, PERO SI HAY QUE MOSTRAR TEXTO DE OTROSI, CON VALORES ESTABLECIDOS

        $plantilla .= '<p>
            <br>
            <b>INFORME DE PAGOS DEL OTROSI</b>
            </p>';

        $plantilla .= '<p>
        <br>
        En consecuencia, se aprueba el cumplimiento de las actividades encomendadas en el objeto contractual de la referencia y se declara
        el recibo del bien o servicio a satisfacción puesto que cumple a cabalidad con lo contratado, y se autoriza el pago de la cuota del Otrosí, correspondiente al periodo: ' . $fecha_1->format("Y-m-d") . ' a ' . $fecha_2->format("Y-m-d") . '.
        Así mismo el suscrito supervisor, certifica que el contratista ha cumplido con sus obligaciones respecto de la afiliación de seguridad social.
        <br>
        <br>
        </p>';


        $plantilla .= '
        <p>
        <table style="page-break-inside: avoid">
            <tr>
                <th>Fecha de Pago</th>
                <th>Valor Bruto</th>
                <th>Descuentos</th>
                <th>Valor Neto Pagado</th>
                <th>Saldo</th>
            </tr>';
        $plantilla .= '<tr>';
        $plantilla .= '<td>2021-12-23</td>';
        $plantilla .= '<td> $24.500.000</td>';
        $plantilla .= '<td> $0</td>';
        $plantilla .= '<td> $24.500.000</td>';
        $plantilla .= '<td> $0</td>';
        $plantilla .= '</tr></table></p>';
        $plantilla .= '<br>';
        $plantilla .= '<br>';
    }
    
    else {

        $plantilla .= '<p>
        <br>
        En consecuencia, se aprueba el cumplimiento de las actividades encomendadas en el objeto contractual de la referencia y se declara
        el recibo del bien o servicio a satisfacción puesto que cumple a cabalidad con lo contratado, y se autoriza el pago de la cuota N.º ' . $cuota_pagada . ', correspondiente al periodo: ' . $fecha_1->format("Y-m-d") . ' a ' . $fecha_2->format("Y-m-d") . '.
        Así mismo el suscrito supervisor, certifica que el contratista ha cumplido con sus obligaciones respecto de la afiliación de seguridad social.
        <br>
        <br>
        </p>';
    }


    $plantilla .= '
            <table>
            <tr>
                <th><b>PERSONA NATURAL</b></td>
                <th style="text-align: center;" width="10%"><b>C</b></td>
                <th style="text-align: center;" width="10%"><b>NC</b></td>
            </tr>
            <tr>
                <td>Para el caso del CONTRATISTA, que ostenta la calidad de COTIZANTE ACTIVO e INDEPENDIENTE en su misma calidad, ante la Empresa Promotora de Salud “EPS” ' . $eps . ' Administradora de Pensiones ' . $pension . ' y entidad Administradora de Riesgos Laborales ' . $arl . '</td>
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
        <p>
            <br>
        <table class="tabla_invisible_incortable">
        <tr class="tabla_invisible_incortable">
        <td class="tabla_invisible_incortable">
        <table>
            <tr>
                <th><b>PERSONA JURIDICA</b></td>
                <th style="text-align: center;" width="10%"><b>C</b></td>
                <th style="text-align: center;" width="10%"><b>NC</b></td>
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
        ';

    $plantilla .= '
        <br>
        En constancia se firma por los que intervienen en la fecha ' . $fecha_impresion . '
        
    </div>
    <p>
    <!-- <table style="page-break-inside:avoid"> -->
    <table>
        <tr>
            <td width=" 33%" style="text-align: center;">
                <br>' . $supervisor1 . '<br><br><br><br><br><br> SUPERVISOR 1
            </td>';
    if (!empty($supervisor2)) {
        $plantilla .= '
                <td width=" 33%"style="text-align: center;">
                    <br>' . $supervisor2 . ' <br><br><br><br><br><br> SUPERVISOR 2
                </td>';
    }
    if (!empty($supervisor3)) {
        $plantilla .= '
                <td width=" 33%">
                    <br>' . $supervisor3 . ' ?><br><br><br><br><br><br> SUPERVISOR 3
                </td>';
    }
    $plantilla .= '</tr>
    </table>
    </p>
    </td>
    </tr>
    </table>
    ';

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
