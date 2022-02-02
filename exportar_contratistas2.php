<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

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
</head>

<body>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!--bootstrap -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Datatables -->
    <!-- TABLAS DE BOOTSTRAP -->
    <!-- Estas son las librerias para que funcione -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->
    <script src="jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous" defer></script>
    <!-- Libreria Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src">
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-link-icon fa fa-home"> </i>
                                Dashboard
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="contenedor_gestionar_contratos.php" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Contratos
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="contenedor_gestionar_contratistas.php" class="nav-link">
                                <i class="nav-link-icon fa fa-user"></i>
                                Contratistas
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <a href="logout.php" class="dropdown-item">Cerrar Sesion</a>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui-theme-settings">
            <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button>
        </div>
        <div class="app-main">
            <?php
            include("nav.php");
            ?>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                                    </i>
                                </div>
                                <div>Gestionar Contratistas
                                    <div class="page-title-subheading">Editar o Eliminar Contratistas
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fila que contiene la información de la página -->
                    <div class="col-md-3">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Listado de Contratos</h5>
                                <table class="display nowrap" id="exportarContratistas" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cédula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Nivel Educativo</th>
                                            <th>Nombre Pregrado</th>
                                            <th>Proceso Pregrado</th>
                                            <th>Nombre Posgrado</th>
                                            <th>Proceso Posgrado</th>
                                            <th>Fecha Nacimiento</th>
                                            <th>Sexo</th>
                                            <th>Grupo Sanguineo</th>
                                            <th>Departamento</th>
                                            <th>Municipio</th>
                                            <th>Dirección Residencia</th>
                                            <th>Tipo de Vivienda</th>
                                            <th>Ubicación Vivienda</th>
                                            <th>Barrio</th>
                                            <th>Estrato</th>
                                            <th>Estado Civil</th>
                                            <th>Enfermedad</th>
                                            <th>Tratamiento</th>
                                            <th>Alergias</th>
                                            <th>Nombres Conyugue</th>
                                            <th>Apellidos Conyugue</th>
                                            <th>Cedula Conyugue</th>
                                            <th>Nombres Padre</th>
                                            <th>Apellidos Padre</th>
                                            <th>Cedula Padre</th>
                                            <th>Nombres Madre</th>
                                            <th>Apellidos Madre</th>
                                            <th>Cedula Madre</th>
                                            <th>EPS</th>
                                            <th>ARL</th>
                                            <th>CAJA</th>
                                            <th>Pensiones</th>
                                            <th>Actividades</th>
                                            <th>Variables Culturales</th>
                                            <th>Discapacidad</th>
                                            <th>Numero del Contrato</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Monto</th>
                                            <th>Objeto</th>
                                            <th>Rubro 1</th>
                                            <th>Rubro 2</th>
                                            <th>Rubro 3</th>
                                            <th>Nombre de Dependencia</th>
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
                                       contratista.usuario as usuario, 
                                       contratista.nivel_educativo as nivel_educativo,
                                       contratista.nombre_pregrado as nombre_pregrado,
                                       contratista.proceso_pregrado as proceso_pregrado,
                                       contratista.nombre_posgrado as nombre_posgrado,
                                       contratista.proceso_posgrado as proceso_posgrado,
                                       contratista.fecha_nacimiento as fecha_nacimiento,
                                       contratista.sexo as sexo,
                                       contratista.grupo_sanguineo as grupo_sanguineo,
                                       contratista.departamento as departamento,
                                       departamentos.departamento as nombre_departamento,
                                       municipios.municipio as nombre_municipio,
                                       contratista.municipio as municipio,
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
                                       contrato.valor as valor,
                                       contrato.objeto as objeto,
                                       contrato.indicador as indicador,
                                       contrato.indicador2 as indicador2,
                                       contrato.indicador3 as indicador3,
                                       dependencia.nombre as nombre_dependencia
                                       FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on dependencia.id_dependencia = contratista.fk_id_dependencia inner join departamentos on departamentos.id_departamento = contratista.departamento inner join municipios on municipios.id_municipio=contratista.municipio where contratista.activado = 1 order by id_contratista desc";
                                        $resultado = $conexion->query($sentencia);
                                        if ($resultado) {
                                            while ($fila = $resultado->fetch_object()) { ?>
                                                <tr>
                                                    <td><?php echo $fila->id_contratista ?></td>
                                                    <td><?php echo $fila->cedula ?></td>
                                                    <td><?php echo $fila->nombres ?></td>
                                                    <td><?php echo $fila->apellidos ?></td>
                                                    <td><?php echo $fila->telefono ?></td>
                                                    <td><?php echo $fila->usuario ?></td>
                                                    <td><?php echo $fila->nivel_educativo ?> </td>
                                                    <td><?php echo $fila->nombre_pregrado ?> </td>
                                                    <td><?php echo $fila->proceso_pregrado ?> </td>
                                                    <td><?php echo $fila->nombre_posgrado ?> </td>
                                                    <td><?php echo $fila->proceso_posgrado ?> </td>
                                                    <td><?php echo $fila->fecha_nacimiento ?> </td>
                                                    <td><?php echo $fila->sexo ?></td>
                                                    <td><?php echo $fila->grupo_sanguineo ?> </td>
                                                    <td><?php echo $fila->nombre_departamento ?> </td>
                                                    <td><?php echo $fila->nombre_municipio ?> </td>
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
                                                    <td><?php echo "$".number_format($fila->valor) ?> </td>
                                                    <td><?php echo $fila->objeto ?></td>
                                                    <td><?php echo $fila->indicador ?></td>
                                                    <td><?php echo $fila->indicador2 ?></td>
                                                    <td><?php echo $fila->indicador3 ?></td>
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
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Sistema de Gestión Documental Contratación
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            última actualización <?php echo date('Y-m-d'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="app-footer-right">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            Alcaldía Municipal de Candelaria Valle
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <div class="badge badge-success mr-1 ml-0">
                                                <small>NEW</small>
                                            </div>
                                            Con Experiencia Avanzamos
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="./assets/scripts/main.js"></script>
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
</body>

</html>
</div>