<?php
$id_rubro = base64_decode(filter_input(INPUT_GET, 'id_rubro'));

include("conexion.php");

$sentencia = "SELECT * FROM codigos WHERE id_codigo = $id_rubro";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();

setcookie('codrub', $fila->codigo); // Cookie para permitir la edición del mismo Rubro

include("encabezado.php");
include("nav.php");


?>

<script src="js/bootbox.min.js"></script>
<script src="js/bootbox.locales.min.js"></script>
<script type="text/javascript" src="js/deleteRecords.js"></script>

<style>
    .texto_alerta {
        color: red;
        font-weight: bold;
    }
</style>

<script>
    $(document).ready(function() {
        $('#form_editar_rubros').submit(function(e) {
            e.preventDefault();
            data = $(this).serialize();

            $.post('val_cont.php', data, function(respuesta) {
                if (respuesta === 'OK') {
                    location.href = 'editar_rubro.php';
                } else {
                    $('#info_rubro_editar').hide().html('<span class="texto_alerta">' + respuesta + '</span>').fadeIn('normal');
                    $('#enviar_rubro').prop('disabled', true);
                }
            });
        });

        $('#regresar').click(function() {
            location.href = 'editar_rubro.php';
        });
    });
</script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Gestionar Rubros
                        <div class="page-title-subheading">Editar o Eliminar Rubros</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Editar Información del Rubro</h5>
                        <div class="card-border mb-3 card card-body border-danger">
                            <form action="" method="POST" id="form_editar_rubros">
                                <table>
                                    <tr>
                                        <td><b>Código:</b> <input type="number" name="codigo_rubro_editar" id="codigo_rubro" class="form-control" placeholder="Código" value="<?php echo $fila->codigo ?>" required=""></td>
                                    </tr>
                                    <tr>
                                        <td><b>Descripcion:</b> <input type="text" name="descripcion_rubro_editar" id="descripcion_rubro" class="form-control" placeholder="Describir Rubro" value="<?php echo $fila->descripcion ?>" required=""></td>
                                    </tr>
                                    <td>
                                        <br>
                                        <input type="hidden" name="id_codigo_editar" value="<?php echo base64_encode($fila->id_codigo) ?>">
                                        <button id="enviar_rubro" type="submit" class="btn btn-success" style="margin-left: 12px; margin-top: 7px;"><i class="metismenu-icon pe-7s-pen"></i> MODIFICAR</button>
                                        <button id="regresar" type="button" class="btn btn-primary" style="margin-left: 12px; margin-top: 7px;"><i class="metismenu-icon pe-7s-refresh"></i> REGRESAR</button>
                                    </td>
                                    </tr>
                                </table>
                            </form>
                            <div id="info_rubro_editar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>