<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

?>
<!-- Logica de inserción en la base de datos usando AJAX -->
<script src="actividades.js"></script>



<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js" crossorigin="anonymous" defer></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js" crossorigin="anonymous" defer></script>

<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">

<style>
    div.dataTables_wrapper {
        width: 1200px;

    }
</style>


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Reporte de Hijos de Contratistas
                        <div class="page-title-subheading">Aquí se listan los hijos de contratistas
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <?php
        if ($_SESSION['user'] == 'jariasduran@hotmail.com') {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Información Detallada</h5>
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Tipo Documento</th>
                                        <th>Número Documento</th>
                                        <th>Sexo</th>
                                        <th>Nombre del Contratista</th>
                                        <th>Documento del Contratista</th>
                                        <th>Teléfono</th>
                                        <th>Dependencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sentencia = "select hijos.nombres, hijos.apellidos, hijos.fecha_nacimiento, hijos.tipo_documento, hijos.numero_documento, hijos.sexo, contratista.nombres as nombre_contratista, contratista.apellidos as apellidos_contratista, contratista.cedula as documento_contratista, contratista.telefono, dependencia.nombre as nombre_dependencia from hijos inner join contratista on hijos.fk_id_contratista=contratista.id_contratista inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where contratista.activado=1";
                                    $resultado = mysqli_query($conexion, $sentencia);
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $fila["nombres"] ?></td>
                                            <td><?php echo $fila["apellidos"] ?></td>
                                            <td><?php echo $fila["fecha_nacimiento"] ?></td>
                                            <td><?php echo $fila["tipo_documento"] ?></td>
                                            <td><?php echo $fila["numero_documento"] ?></td>
                                            <td><?php echo $fila["sexo"] ?></td>
                                            <td><?php echo $fila["nombre_contratista"] . " " . $fila["apellidos_contratista"] ?></td>
                                            <td><?php echo $fila["documento_contratista"] ?></td>
                                            <td><?php echo $fila["telefono"] ?></td>
                                            <td><?php echo $fila["nombre_dependencia"] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?
        } else {
            //No tiene permisos
        ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">NO TIENE PERMISOS PARA HACER ESTA ACTIVIDAD</h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "scrollX": true
            });
        });
    </script>
    <?php include("pie.php"); ?>
</div>