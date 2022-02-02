<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
?>
<style type="text/css">
    #registration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<script type="text/javascript" src="js/cargar_municipios_departamentos.js"></script>

<script>
    $(document).ready(function() {
        $('#cedula').keyup(function() {
            if ($(this).val().length > 0) {
                data = 'cedula=' + $(this).val();

                $.post('val_cont.php', data, function(respuesta) {
                    if (respuesta == '0') {
                        $('#info_cedula').hide();
                        $('#enviar').prop('disabled', false);
                    } else {
                        $('#info_cedula').hide().html(' ya existe!').fadeIn(100);
                        $('#enviar').prop('disabled', true);
                    }
                });
            }
        });
    });
</script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Agregar Contratista
                        <div class="page-title-subheading">Cargar la información de un contratista nuevo o busca un contratista existente
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" style="width: 15%" aria-valuenow="15" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <form class="" id="registration_form" action="agregar_contratista_buscar2.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <fieldset>
                                <h5 class="card-title">POR FAVOR INGRESE EL NÚMERO DE CÉDULA DEL CONTRATISTA</h5>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><input name="cedula" id="nombres" placeholder="No. de Cédula" type="text" class="form-control" required="true"></div>
                                    </div>
                                    <br>
                            </fieldset>
                            <input id="enviar" type="submit" class="next btn btn-info" value="CONTINUAR" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("pie.php"); ?>
</div>