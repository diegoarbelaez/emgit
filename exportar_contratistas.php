
<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");



?>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


  <!-- Estas son las librerias para que funcione -->
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/13c34f0681.js" crossorigin="anonymous"></script>


<style>
    .texto_alerta {
        color: red;
        font-weight: bold;
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
                    <div>Exportar Contratistas
                        <div class="page-title-subheading">Exportar a PDF, Excel, o CSV toda la base de contratistas
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
                            <h5 class="card-title">Aquí el listado total de contratistas</h5>
                            <div>
                                Esta opción te permite exportar toda la base de datos de contratistas a archivos.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <h5 class="card-title">Listado de Contratos</h5>
                                    <table class="table table-bordered table-hover" id="example1" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Número de Contrato</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Objeto</th>
                                                <th>Valor</th>
                                                <th width="10%">Gestionar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //Gestiono solo los contratos de la dependencia
                                            $id_dependencia = $_SESSION["id_dependencia"];


                                            $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato where contratista.activado = 1 and contratista.fk_id_dependencia = $id_dependencia order by id_contratista desc";
                                            $resultado = $conexion->query($sentencia);
                                            if ($resultado) {
                                                while ($fila = $resultado->fetch_object()) { ?>
                                                    <tr>
                                                        <td><?php echo $fila->id_contratista ?></td>
                                                        <td><a href="informacion_contratista2.php?id_contratista=<?php echo base64_encode($fila->id_contratista) ?>"><?php echo $fila->nombres . " " . $fila->apellidos ?></a></td>
                                                        <td><?php echo $fila->numero ?></td>
                                                        <td><?php echo $fila->fecha_inicio ?></td>
                                                        <td><?php echo $fila->fecha_fin ?></td>
                                                        <td><?php echo $fila->objeto ?></td>
                                                        <td><?php echo "$" . number_format($fila->valor) ?></td>
                                                        <td>
                                                            <a href="pre_eliminar_contratista.php?id_contratista=<?php echo base64_encode($fila->id_contratista) ?>" class="btn btn-danger"><i class="metismenu-icon pe-7s-trash"></i></a>
                                                            <a href="editar_contratista.php?id_contratista=<?php echo base64_encode($fila->id_contratista) ?>" class="btn btn-primary"><i class="metismenu-icon pe-7s-pen"></i></a>
                                                        </td>
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
                </div>
            </div>
        <?php
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
            $('#example1').DataTable({
                "pageLength": 50,
                dom: 'Bfrtip',
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>

    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>




    <?php //include("pie.php"); ?>
</div>