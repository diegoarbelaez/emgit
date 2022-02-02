<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>


<?php include("conexion.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MegaInforme - Alcaldía de Candelaria</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="./main.css" rel="stylesheet">



    <!--
    	BOOTSTRAP
    -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://nightly.datatables.net/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>


    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.js"></script>

    <script src="js/bootbox.min.js"></script>
    <script src="js/bootbox.locales.min.js"></script>
    <script type="text/javascript" src="js/deleteRecords.js"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>



    <meta charset=utf-8 />
    <title>Exportación de Bases de Datos</title>
</head>

<body>
    <style>
        body {
            font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #fff;
        }
    </style>

    <div class="row">
        <div class="col-sm-4">
            <table id="exportarContratistas" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                        <th>Extn.</th>
                        <th>E-mail</th>
                        <th>Test 1</th>
                        <th>Test 2</th>
                        <th>Test 4</th>
                        <th>Test 4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Gestiono solo los contratos de la dependencia
                    $sentencia = "SELECT 
                                             contratista.id_contratista as id_contratista,
                                            contratista.cedula as cedula, 
                                            contratista.nombres as nombres, 
                                            contratista.apellidos as apellidos, 
                                            contratista.telefono as telefono, 
                                            contratista.nivel_educativo as nivel_educativo,
                                            contratista.nombre_pregrado as nombre_pregrado,
                                            contratista.proceso_pregrado as proceso_pregrado,
                                            contratista.nombre_posgrado as nombre_posgrado,
                                            contratista.proceso_posgrado as proceso_posgrado,
                                            contratista.fecha_nacimiento as fecha_nacimiento,
                                            contratista.sexo as sexo,
                                            contratista.grupo_sanguineo as grupo_sanguineo,
                                            contratista.direccion_residencia as direccion_residencia,
                                            contratista.tipo_vivienda as tipo_vivienda,
                                            contratista.descripcion_ubicacion as descripcion_ubicacion,
                                            contratista.barrio as barrio,
                                            contratista.estrato as estrato,
                                            contratista.estado_civil as estado_civil,
                                            contratista.enfermedad as enfermedad,
                                            contratista.tratamiento as tratamiento,
                                            contratista.alergias as alergias,
                                            contratista.nombres_conyugue as nombres_conyugue,
                                            contratista.apellidos_conyugue as apellidos_conyugue,
                                            contratista.cedula_conyugue as cedula_conyugue,
                                            contratista.nombres_padre as nombres_padre,
                                            contratista.apellidos_padre as apellidos_padre,
                                            contratista.cedula_padre as cedula_padre,
                                            contratista.nombres_madre as nombres_madre,
                                            contratista.apellidos_madre as apellidos_madre,
                                            contratista.cedula_madre as cedula_madre,
                                            contratista.eps as eps,
                                            contratista.arl as arl,
                                            contratista.caja as caja,
                                            contratista.pensiones as pensiones,
                                            contratista.actividades as actividades,
                                            contratista.variables_culturales as variables_culturales,
                                            contratista.discapacidad as discapacidad,
                                            contrato.numero as numero_contrato,
                                            contrato.fecha_inicio as fecha_inicio,
                                            contrato.fecha_fin as fecha_fin,
                                            dependencia.nombre as nombre_dependencia
                                            FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on dependencia.id_dependencia = contratista.fk_id_dependencia where contratista.activado = 1 order by id_contratista desc limit 30";
                    $resultado = $conexion->query($sentencia);
                    if ($resultado) {
                        while ($fila = $resultado->fetch_object()) { ?>
                            <tr>
                                <td><?php echo $fila->id_contratista ?></td>
                                <td><?php echo $fila->cedula ?></td>
                                <td><?php echo $fila->nombres ?></td>
                                <td><?php echo $fila->apellidos ?></td>
                                <td><?php echo $fila->telefono ?></td>
                                <td><?php echo $fila->nivel_educativo ?> </td>
                                <td><?php echo $fila->nombre_pregrado ?> </td>
                                <td><?php echo $fila->proceso_pregrado ?> </td>
                                <td><?php echo $fila->nombre_posgrado ?> </td>
                                <td><?php echo $fila->proceso_posgrado ?> </td>
                                <td><?php echo $fila->fecha_nacimiento ?> </td>
                                <td><?php echo $fila->sexo ?></td>
                                <td><?php echo $fila->grupo_sanguineo ?> </td>
                                <td><?php echo $fila->direccion_residencia ?> </td>
                                <td><?php echo $fila->tipo_vivienda ?> </td>
                                <td><?php echo $fila->descripcion_ubicacion ?> </td>
                                <td><?php echo $fila->barrio ?></td>
                                <td><?php echo $fila->estrato ?></td>
                                <td><?php echo $fila->estado_civil ?> </td>
                                <td><?php echo $fila->enfermedad ?></td>
                                <td><?php echo $fila->tratamiento ?></td>
                                <td><?php echo $fila->alergias ?></td>
                                <td><?php echo $fila->nombres_conyugue ?> </td>
                                <td><?php echo $fila->apellidos_conyugue ?> </td>
                                <td><?php echo $fila->cedula_conyugue ?> </td>
                                <td><?php echo $fila->nombres_padre ?> </td>
                                <td><?php echo $fila->apellidos_padre ?> </td>
                                <td><?php echo $fila->cedula_padre ?> </td>
                                <td><?php echo $fila->nombres_madre ?> </td>
                                <td><?php echo $fila->apellidos_madre ?> </td>
                                <td><?php echo $fila->cedula_madre ?> </td>
                                <td><?php echo $fila->eps ?></td>
                                <td><?php echo $fila->arl ?></td>
                                <td><?php echo $fila->caja ?></td>
                                <td><?php echo $fila->pensiones ?></td>
                                <td><?php echo $fila->actividades ?></td>
                                <td><?php echo $fila->variables_culturales ?> </td>
                                <td><?php echo $fila->discapacidad ?></td>
                                <td><?php echo $fila->numero_contrato ?> </td>
                                <td><?php echo $fila->fecha_inicio ?> </td>
                                <td><?php echo $fila->fecha_fin ?> </td>
                                <td><?php echo $fila->nombre_dependencia ?> </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#exportarContratistas').DataTable({
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    });
</script>

</html>