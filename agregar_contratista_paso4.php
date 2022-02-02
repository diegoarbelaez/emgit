<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$id_contratista = $_POST["id_contratista"];
//$id_contratista = 814;
?>
<style type="text/css">
    #registration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
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
            <div class="progress-bar progress-bar-striped active" style="width: 85%" aria-valuenow="85" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <form class="" id="registration_form" action="agregar_contratista_paso5.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <fieldset>
                                <h5 class="card-title">INFORMACIÓN ACADÉMICA DEL CONTRATISTA ID Contratista -><?php echo $id_contratista ?></h5>
                                <label for="Nombres" class="">Por favor llenar la información según corresponda
                                </label>
                                <br>
                                <br>
                                <hr>
                                </label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <div class="position-relative form-group"><label for="NivelEducativo" class="">Nivel Educativo</label>
                                                <select name="nivel_educativo" id="nivel_educativo" class="form-control" required>
                                                    <option disabled selected value=''> -- seleccionar -- </option>
                                                    <option>Primaria</option>
                                                    <option>Bachiller</option>
                                                    <option>Tecnólogo</option>
                                                    <option>Técnico</option>
                                                    <option>Profesional</option>
                                                    <option>Maestría</option>
                                                    <option>Especialización</option>
                                                    <option>Doctorado</option>
                                                    <option>Post. Doctorado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Estudio Pregrado</label>
                                            <input name="nombre_pregrado" id="apellidos" placeholder="" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="position-relative form-group">
                                        <div class="position-relative form-group"><label for="NivelEducativo" class="">Proceso Formación Pregrado</label>
                                            <select name="proceso_pregrado" id="nivel_educativo" class="form-control" >
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>Graduado</option>
                                                <option>Proceso de Formación</option>
                                                <option>No terminado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Estudio Posgrado</label>
                                            <input name="nombre_posgrado" id="apellidos" placeholder="" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="position-relative form-group">
                                        <div class="position-relative form-group"><label for="NivelEducativo" class="">Proceso Formación Posgrado</label>
                                            <select name="proceso_posgrado" id="nivel_educativo" class="form-control" >
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>Graduado</option>
                                                <option>Proceso de Formación</option>
                                                <option>No terminado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">

                                <hr>
                                <input type="submit" name="next" class="next btn btn-info" value="SIGUIENTE - SALUD OCUPACIONAL" />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("pie.php"); ?>
</div>