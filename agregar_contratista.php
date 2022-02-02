<?php include("conexion.php"); ?>
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
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Información sobre el contratista</h5>
                        <form class="" action="guardar_contratista.php" method="POST" enctype="multipart/form-data">
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
                                    <div class="position-relative form-group"><label for="Cedula" class="">Cedula o NIT (Sin digito de verificación)</label><input name="cedula" id="cedula" min="1" pattern="^[0-9]+" type="number" class="form-control" required="true"></div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        CEDULA
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        NIT
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Fecha Expedición</label><input name="fecha_expedicion" id="cedula" min="1" pattern="^[0-9]+" placeholder="Cédula" type="date" class="form-control" required="true"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label><input name="fecha_nacimiento" id="" min="1" type="date" class="form-control" required="true"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Sexo</label>
                                        <select name="sexo" id="nivel_educativo" class="form-control" required="true">
                                            <option>Masculino</option>
                                            <option>Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Grupo Sanguíneo</label>
                                        <select name="grupo_sanguineo" id="" class="form-control" required="true">
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
                                    <div class="position-relative form-group"><label for="Apellidos" class="">Tipo de Vivienda</label>
                                        <select name="tipo_vivienda" id="" class="form-control" required="true">
                                            <option>Propia</option>
                                            <option>Alquilada</option>
                                            <option>Familiar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Nombres" class="">Barrio</label><input name="barrio" id="nombres" placeholder="" type="text" class="form-control" required="true"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Apellidos" class="">Estrato</label>
                                        <select name="estrato" id="" class="form-control" required="true">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>Rural</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Nombres" class="">Teléfono</label><input name="telefono" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" required="true"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Nombres" class="">Teléfono Emergencias</label><input name="telefono_emergencias" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" required="true"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Apellidos" class="">Estado Civil</label>
                                        <select name="estado_civil" id="nivel_educativo" class="form-control" required="true">
                                            <option>Soltero</option>
                                            <option>Casado</option>
                                            <option>Unión Libre</option>
                                            <option>Separado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Nombres" class="">Numero de Hijos</label><input name="numero_hijos" id="nombres" placeholder="" type="text" class="form-control" required="true"></div>
                                </div>

                            </div>
                            <div class="position-relative form-group">
                                <div class="position-relative form-group"><label for="NivelEducativo" class="">Nivel Educativo</label>
                                    <select name="nivel_educativo" id="nivel_educativo" class="form-control" required="true">
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

                            <div class="position-relative form-group">
                                <div class="position-relative form-group"><label for="NivelEducativo" class="">Padece Enfermedades</label>
                                    <input name="enfermedad" id="telefono" placeholder="Describa aquí" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <div class="position-relative form-group"><label for="NivelEducativo" class="">¿Recibe algún tipo de tratamiento?</label>
                                    <input name="tratamiento" id="telefono" placeholder="Describa aquí" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="position-relative form-group">
                                <div class="position-relative form-group"><label for="NivelEducativo" class="">¿Es alérgico a algo?</label>
                                    <input name="alergias" id="telefono" placeholder="Describa aquí" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="position-relative form-group"><label for="exampleFile" class="">Foto</label>
                                <input name="foto" id="foto" type="file" class="form-control-file" required="true">
                                <small class="form-text text-muted">La foto debe ser inferior a 2MB</small>
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
                            <div class="position-relative form-group"><label for="NivelEducativo" class="">Contrato Asignado</label>
                                <select name="fk_id_contrato" id="fk_id_contrato" class="form-control" required="true">
                                    <?php
                                    // Todos los contratos que agregue serán para la dependencia obtenida en $_SESSION
                                    $id_dependencia = $_SESSION["id_dependencia"];

                                    $sentencia = "SELECT * FROM contrato where fk_id_dependencia=$id_dependencia and activo=1 order by id_contrato desc";
                                    $resultado = $conexion->query($sentencia);
                                    if ($resultado) {
                                        while ($fila = $resultado->fetch_object()) {
                                            echo '<option value=' . $fila->id_contrato . '>' . $fila->numero . ' - ' . $fila->objeto . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="position-relative form-group"><label for="coreo" class="">Usuario (correo)</label><input name="correo" id="correo" placeholder="correo electrónico" type="text" class="form-control" required="true"></div>
                            <div class="position-relative form-group"><label for="password" class="">Contraseña</label><input name="password" id="password" placeholder="contraseña" type="text" class="form-control" required="true"></div>
                            <button class="mt-1 btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>