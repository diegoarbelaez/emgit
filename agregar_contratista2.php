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
        <form class="" id="registration_form" action="agregar_contratista_paso2.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <fieldset>
                                <h5 class="card-title">DATOS PERSONALES</h5>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label><input name="nombres" id="nombres" placeholder="Nombres" type="text" class="form-control" required="true"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label><input name="apellidos" id="apellidos" placeholder="Apellidos" type="text" class="form-control" required="true"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Cedula o NIT sin digito de verificación</label><span style="color:red" id="info_cedula"></span><input name="cedula" id="cedula" min="1" pattern="^[0-9]+" placeholder="Cédula" type="number" class="form-control" required="true"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Fecha Expedición (Persona Jurídica, dejar en Blanco)</label><input name="fecha_expedicion" id="cedula" min="1" pattern="^[0-9]+" placeholder="Cédula" type="date" class="form-control" required="true"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label><input name="fecha_nacimiento" id="" min="1" type="date" class="form-control" required="true"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Sexo</label>
                                            <select name="sexo" id="" class="form-control" required="true">
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>Masculino</option>
                                                <option>Femenino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Grupo Sanguíneo</label>
                                            <select name="grupo_sanguineo" id="" class="form-control" required="true">
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>O-</option>
                                                <option>O+</option>
                                                <option>A-</option>
                                                <option>A+</option>
                                                <option>B-</option>
                                                <option>B+</option>
                                                <option>AB-</option>
                                                <option>AB+</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Dirección de Residencia</label><input name="direccion_residencia" id="nombres" placeholder="" type="text" class="form-control" required="true"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Tenencia de Vivienda</label>
                                            <select name="tipo_vivienda" id="" class="form-control" required="true">
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>Propia</option>
                                                <option>Alquilada</option>
                                                <option>Familiar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Zona de Ubicación</label>
                                            <select name="zona_ubicacion" id="" class="form-control" required="true">
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>Urbana</option>
                                                <option>Rural</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Descripción de Ubicación</label>
                                            <select name="descripcion_ubicacion" id="" class="form-control" required="true">
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>Cabecera</option>
                                                <option>Corregimiento</option>
                                                <option>Vereda</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Nombre del Corregimiento o Vereda</label>
                                            <input name="nombre_corregimiento" id="nombres" placeholder="" type="text" class="form-control" required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Barrio</label>
                                            <input name="barrio" id="nombres" placeholder="" type="text" class="form-control" required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Estrato</label>
                                            <select name="estrato" id="" class="form-control" required="true">
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                            </select>
                                        </div>
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
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Estado Civil</label>
                                            <select name="estado_civil" id="nivel_educativo" class="form-control" required="true">
                                                <option disabled selected value> -- seleccionar -- </option>
                                                <option>Soltero</option>
                                                <option>Casado</option>
                                                <option>Unión Libre</option>
                                                <option>Separado</option>
                                                <option>Viudo(a)</option>
                                            </select>
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
                            <input id="enviar" type="submit" class="next btn btn-info" value="CREAR CONTRATISTA Y AGREGAR INFORMACIÓN PERSONAL" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("pie.php"); ?>
</div>