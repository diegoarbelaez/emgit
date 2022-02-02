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
            <div class="progress-bar progress-bar-striped active" style="width: 25%" aria-valuenow="25" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <form class="" id="registration_form" action="paso2_persona_juridica.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <fieldset>
                                <h5 class="card-title">DATOS DE LA EMPRESA</h5>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Razon Social</label><input name="nombres" id="nombres" placeholder="Nombres" type="text" class="form-control" required="true"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">NIT</label><input name="nit" id="apellidos" placeholder="Apellidos" type="text" class="form-control" required="true"></div>
                                    </div>
                                </div>
                               
                              
                                <div class="form-row">
                                <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Representante Legal</label><input name="representante_legal" id="nombres" placeholder="" type="text" class="form-control" required="true"></div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Dirección de la empresa</label><input name="direccion_residencia" id="nombres" placeholder="" type="text" class="form-control" required="true"></div>
                                    </div>
                                   
                                    
                                    
                                   
                                </div>
                              
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Departamento</label>
                                            <select name="departamento" id="lista_departamento" placeholder="" type="text" class="form-control" required="true"></select>
                                            <option selected="selected" value="76"></option>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Municipio</label>
                                            <select name="municipio" id="municipios" placeholder="" type="text" class="form-control" required="true"></select>
                                            <option selected="selected" value="157"></option>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Teléfono</label>
                                            <input name="telefono" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Teléfono Emergencias</label>
                                            <input name="telefono_emergencias" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" required="true">
                                        </div>
                                    </div>
                                </div>

                                <div class="position-relative form-group"><label for="NivelEducativo" class="">Dependencia</label>
                                    <select name="fk_id_dependencia" id="fk_id_dependencia" class="form-control" required="true">
                                        <?php
                                        $sentencia = "SELECT * FROM dependencia where id_dependencia = $id_dependencia order by id_dependencia desc";
                                        $resultado = $conexion->query($sentencia);
                                        if ($resultado) {
                                            while ($fila = $resultado->fetch_object()) {
                                                echo '<option value=' . $fila->id_dependencia . '>' . $fila->nombre . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                            </fieldset>
                            <br>
                            <input type="submit" class="next btn btn-info" value="CREAR CONTRATISTA Y AGREGAR INFORMACIÓN PERSONAL" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("pie.php"); ?>
</div>