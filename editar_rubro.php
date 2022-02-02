<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

?>
<!-- Logica de inserción en la base de datos usando AJAX -->
<script src="actividades.js"></script>

<script>
    $(document).ready(function() {
        $('#codigo_rubro').keyup(function() {
            if ($(this).val().length > 0 && $('#codigo_rubro_confirmar').val().length > 0 && $('#descripcion_rubro').val().length > 0) {
                $('#enviar_rubro').prop('disabled', false);
            } else {
                $('#enviar_rubro').prop('disabled', true);
            }
        });

        $('#codigo_rubro_confirmar').keyup(function() {
            if ($(this).val().length > 0 && $('#codigo_rubro').val().length > 0 && $('#descripcion_rubro').val().length > 0) {
                $('#enviar_rubro').prop('disabled', false);
            } else {
                $('#enviar_rubro').prop('disabled', true);
            }
        });

        $('#descripcion_rubro').keyup(function() {
            if ($(this).val().length > 0 && $('#codigo_rubro').val().length > 0 && $('#codigo_rubro_confirmar').val().length > 0) {
                $('#enviar_rubro').prop('disabled', false);
            } else {
                $('#enviar_rubro').prop('disabled', true);
            }
        });

        $('#form_agregar_rubros').submit(function(e) {
            e.preventDefault();
            $('#info_rubro_confirmar').css('display', 'block');
        });

        $('#rubro_si').click(function() {
            data = 'codigo_rubro=' + $('#codigo_rubro').val() + '&codigo_rubro_confirmar=' + $('#codigo_rubro_confirmar').val() + '&descripcion_rubro=' + $('#descripcion_rubro').val();

            $.post('val_cont.php', data, function(respuesta) {
                if (respuesta === 'OK') {
                    location.reload();
                } else {
                    $('#info_rubro_confirmar').hide().html('<span class="texto_alerta">' + respuesta + '</span>').fadeIn('normal');
                    $('#enviar_rubro').prop('disabled', true);
                }
            });
        });

        $('#rubro_no').click(function() {
            $('#info_rubro_confirmar').css('display', 'none');
        });
    });
</script>

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
                    <div>Editar Rubros
                        <div class="page-title-subheading">Modificar la los rubros de un contrato
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
                            <h5 class="card-title">Agregar Nuevo Rubro</h5>
                            <div>
                                <form action="" method="POST" id="form_agregar_rubros">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="padding-right: 22px">
                                                    <div>
                                                        <label>Digite el Código del Rubro</label>
                                                        <input type="number" name="codigo_rubro" id="codigo_rubro" class="form-control" placeholder="Código" required="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label>Confirme el Código del Rubro</label>
                                                        <input type="number" name="codigo_rubro_confirmar" id="codigo_rubro_confirmar" class="form-control" placeholder="Confirmar código" required="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label>Descripción</label>
                                                        <input type="text" name="descripcion_rubro" id="descripcion_rubro" class="form-control" placeholder="Describir Rubro" required="">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label></label><br>
                                                        <button id="enviar_rubro" class="btn btn-success" style="margin-left: 12px; margin-top: 7px;" disabled>Agregar Rubro</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <div id="info_rubro_confirmar" style="display: none">Esta seguro? <button id="rubro_si" class="btn btn-success">SI</button> <button id="rubro_no" class="btn btn-danger">NO</button></div>
                            </div>
                        </div>
                    </div>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Listado de Rubros</h5>
                            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th width="10%">Gestionar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //Gestiono solo los contratos de la dependencia
                                    $id_dependencia = $_SESSION["id_dependencia"];


                                    $sentencia = "SELECT * FROM codigos order by id_codigo";
                                    $resultado = $conexion->query($sentencia);
                                    if ($resultado) {
                                        while ($fila = $resultado->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $fila->id_codigo ?></td>
                                                <td><?php echo $fila->codigo ?></td>
                                                <td><?php echo $fila->descripcion ?></td>
                                                <td>
                                                    <a href="pre_eliminar_rubro.php?id_rubro=<?php echo base64_encode($fila->id_codigo) ?>" class="btn btn-danger"><i class="metismenu-icon pe-7s-trash"></i></a>
                                                    <a href="pre_editar_rubro.php?id_rubro=<?php echo base64_encode($fila->id_codigo) ?>" class="btn btn-primary"><i class="metismenu-icon pe-7s-pen"></i></a>
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
    <?php include("pie.php"); ?>
</div>