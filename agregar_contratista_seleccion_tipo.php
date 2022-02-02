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
                        <div class="page-title-subheading">Cargar la información de un contratista nuevo
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
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <fieldset>
                                <h5 class="card-title">POR FAVOR SELECCIONE EL TIPO DE CONTRATISTA</h5>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <div class="position-relative form-group"><a href="agregar_contratista_buscar.php" class="btn btn-success">PERSONA NATURAL</a></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group"><a href="agregar_contratista_persona_juridica.php" class="btn btn-danger">PERSONA JURIDICA</a></div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("pie.php"); ?>
</div>