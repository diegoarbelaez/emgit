<?php
include("conexion.php");
$id_contratista = base64_decode($_GET["id_contratista"]);
$sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
$id_contrato = $fila->id_contrato;
$fk_id_dependencia = $fila->fk_id_dependencia;
setcookie('cedulaC', $fila->cedula);
?>
<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>

<script type="text/javascript" src="js/cargar_municipios_departamentos.js"></script>
<link href="estilos_timeline.css" rel="stylesheet">
<script src="gestionHijos.js"></script>
<script src="cropie/jquery.min.js"></script>
<script src="cropie/bootstrap.min.js"></script>
<script src="cropie/croppie.js"></script>
<link rel="stylesheet" href="cropie/croppie.css" />
<style>
    .modal-backdrop {
        opacity: 0.5 !important;
    }
</style>

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

<?php
if ($fila->tipo == 1) {
    //Editar contratista tipo Persona Natural
?>

    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-id icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Editar Informaci??n del Contratista
                            <div class="page-title-subheading">Informaci??n perteneciente a un contratista
                            </div>
                        </div>
                        <div>
                            <img width="80" class="rounded-circle" style="margin-left: 15px;" src="<?php echo $fila->foto; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fila que contiene la informaci??n de la p??gina -->
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-12 card">
                        <div class="card-body">
                            <h5 class="card-title">INFORMACI??N SOBRE EL CONTRATISTA -> <?php echo $id_contratista ?></h5>
                            <br>
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a data-toggle="tab" href="#info_basica" class="nav-link show active">Informaci??n B??sica</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#datos_familiares" class="nav-link show">Datos Familiares</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#informacion_hijos" class="nav-link show">Informaci??n Hijos</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#informacion_academica" class="nav-link show">Informaci??n Acad??mica</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#salud_ocupacional" class="nav-link show">Salud Ocupacional</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#etnias_grupos" class="nav-link show">Etnias y Grupos</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#contrato_asociado" class="nav-link show">Contrato Asociado</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#credenciales_foto" class="nav-link show">Credenciales y Foto</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="info_basica" role="tabpanel">
                                    <form id="registration_form_2" action="actualizar_contratista_inteligente.php" method="POST">
                                        <h5 class="card-title">DATOS PERSONALES</h5>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label><input name="nombres" id="nombres" placeholder="Nombres" type="text" class="form-control" required="true" value="<?php echo $fila->nombres ?>"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label><input name="apellidos" id="apellidos" placeholder="Apellidos" type="text" class="form-control" value="<?php echo $fila->apellidos ?>" required="true"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Cedula</label><span style="color:red" id="info_cedula"></span><input name="cedula" id="cedula" min="1" pattern="^[0-9]+" placeholder="C??dula" type="number" class="form-control" value="<?php echo $fila->cedula ?>" required="true"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Fecha Expedici??n</label><input name="fecha_expedicion" id="cedula" min="1" pattern="^[0-9]+" placeholder="C??dula" type="date" class="form-control" value="<?php echo $fila->fecha_expedicion ?>" required="true"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label><input name="fecha_nacimiento" id="" min="1" type="date" class="form-control" value="<?php echo $fila->fecha_nacimiento ?>" required="true"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Sexo</label>
                                                    <select name="sexo" id="" class="form-control" required="true">
                                                        <option><?php echo $fila->sexo ?> </option>
                                                        <option>Femenino</option>
                                                        <option>Masculino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Grupo Sangu??neo</label>
                                                    <select name="grupo_sanguineo" id="" class="form-control" required="true">
                                                        <option><?php echo $fila->grupo_sanguineo ?> </option>
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
                                                <div class="position-relative form-group"><label for="Nombres" class="">Direcci??n de Residencia</label><input name="direccion_residencia" id="nombres" placeholder="" type="text" class="form-control" value="<?php echo $fila->direccion_residencia ?>" required="true"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Tenencia de Vivienda</label>
                                                    <select name="tipo_vivienda" id="" class="form-control" required="true">
                                                        <option><?php echo $fila->tipo_vivienda ?> </option>
                                                        <option>Propia</option>
                                                        <option>Alquilada</option>
                                                        <option>Familiar</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Descripci??n de Ubicaci??n</label>
                                                    <select name="descripcion_ubicacion" id="" class="form-control" required="true">
                                                        <option><?php echo $fila->descripcion_ubicacion ?> </option>
                                                        <option>Cabecera</option>
                                                        <option>Corregimiento</option>
                                                        <option>Vereda</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Nombre del Corregimiento o Vereda</label>
                                                    <input name="nombre_corregimiento" id="nombres" placeholder="" type="text" class="form-control" value="<?php echo $fila->nombre_corregimiento ?>" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Barrio</label>
                                                    <input name="barrio" id="nombres" placeholder="" type="text" class="form-control" value="<?php echo $fila->barrio ?>" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Estrato</label>
                                                    <select name="estrato" id="" class="form-control" required="true">
                                                        <option><?php echo $fila->estrato ?> </option>
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
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Municipio</label>
                                                    <select name="municipio" id="municipios" placeholder="" type="text" class="form-control" required="true"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Tel??fono</label>
                                                    <input name="telefono" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" value="<?php echo $fila->telefono ?>" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Tel??fono Emergencias</label>
                                                    <input name="telefono_emergencias" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" value="<?php echo $fila->telefono_emergencias ?>" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Estado Civil</label>
                                                    <select name="estado_civil" id="nivel_educativo" class="form-control" required="true">
                                                        <option><?php echo $fila->estado_civil ?> </option>
                                                        <option>Soltero</option>
                                                        <option>Casado</option>
                                                        <option>Uni??n Libre</option>
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
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" id="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button id="enviar" class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>
                                <div class="tab-pane show" id="datos_familiares" role="tabpanel">
                                    <form id="registration_form_2" action="actualizar_contratista_inteligente.php" method="POST">

                                        <h5 class="card-title">DATOS FAMILIARES (C??NYUGE, PADRES E HIJOS): ID Contratista -><?php echo $id_contratista ?></h5>
                                        <label for="Nombres" class="">S?? eres casado o casada por favor complete el formulario de datos del
                                            c??nyuge. Si no tienes c??nyuge continuar con el diligenciamiento de los
                                            datos como Padres.
                                            <?php
                                            $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                            $resultado = $conexion->query($sentencia);
                                            $fila = $resultado->fetch_object();
                                            $id_contrato = $fila->id_contrato;
                                            ?>
                                        </label>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>CONYUGUE</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                                    <input name="nombres_conyugue" id="nombres" placeholder="Nombres" type="text" class="form-control" value="<?php echo $fila->nombres_conyugue ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                                    <input name="apellidos_conyugue" id="apellidos" placeholder="Apellidos" type="text" class="form-control" value="<?php echo $fila->apellidos_conyugue ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">C??dula</label>
                                                    <input name="cedula_conyugue" id="cedula_conyugue" min="1" pattern="^[0-9]+" placeholder="C??dula" type="number" class="form-control" value="<?php echo $fila->cedula_conyugue ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                                    <input name="fecha_nacimiento_conyugue" id="cedula" min="1" pattern="^[0-9]+" placeholder="C??dula" type="date" class="form-control" value="<?php echo $fila->fecha_nacimiento_conyugue ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>PADRE</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                                    <input name="nombres_padre" id="nombres" placeholder="Nombres" type="text" class="form-control" value="<?php echo $fila->nombres_padre ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                                    <input name="apellidos_padre" id="apellidos" placeholder="Apellidos" type="text" class="form-control" value="<?php echo $fila->apellidos_padre ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">C??dula</label>
                                                    <input name="cedula_padre" id="cedula_padre" min="1" pattern="^[0-9]+" placeholder="C??dula" type="number" class="form-control" value="<?php echo $fila->cedula_padre ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                                    <input name="fecha_nacimiento_padre" id="cedula" min="1" pattern="^[0-9]+" placeholder="C??dula" type="date" class="form-control" value="<?php echo $fila->fecha_nacimiento_padre ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>MADRE</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                                    <input name="nombres_madre" id="nombres" placeholder="Nombres" type="text" class="form-control" value="<?php echo $fila->nombres_madre ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                                    <input name="apellidos_madre" id="apellidos" placeholder="Apellidos" type="text" class="form-control" value="<?php echo $fila->apellidos_madre ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">C??dula</label>
                                                    <input name="cedula_madre" id="cedula_madre" min="1" pattern="^[0-9]+" placeholder="C??dula" type="number" class="form-control" value="<?php echo $fila->cedula_madre ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                                    <input name="fecha_nacimiento_madre" id="cedula" min="1" pattern="^[0-9]+" placeholder="C??dula" type="date" class="form-control" value="<?php echo $fila->fecha_nacimiento_madre ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>
                                <div class="tab-pane show" id="informacion_hijos" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>
                                    <h5 class="card-title">DATOS FAMILIARES (HIJOS):</h5>
                                    <label for="Nombres" class="">Ingresa aqu?? la informaci??n de los hijos del contratista
                                    </label>
                                    <br>
                                    <br>
                                    <hr>
                                    <label for="Nombres" class=""><b>HIJOS</b>
                                    </label>
                                    <form action="" id="pagos-form">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                                    <input name="nombres_hijo" id="nombres_hijo" placeholder="Nombres" type="text" class="form-control" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                                    <input name="apellidos_hijo" id="apellidos_hijo" placeholder="Apellidos" type="text" class="form-control" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Sexo</label>
                                                    <select name="sexo" id="sexo" class="form-control" required="true">
                                                        <option>HOMBRE</option>
                                                        <option>MUJER</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="position-relative form-group">
                                                <div class="position-relative form-group"><label for="NivelEducativo" class="">Tipo Documento</label>
                                                    <select name="tipo_documento_hijo" id="tipo_documento_hijo" class="form-control" required="true">
                                                        <option>CC</option>
                                                        <option>TI</option>
                                                        <option>RC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Numero Documento</label>
                                                    <input name="numero_documento_hijo" id="numero_documento_hijo" min="1" pattern="^[0-9]+" placeholder="C??dula" type="number" class="form-control" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                                    <input name="fecha_nacimiento_hijo" id="fecha_nacimiento_hijo" min="1" type="date" class="form-control" required="true">
                                                </div>
                                            </div>
                                            <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        </div>
                                        <input name="enviar" id="enviar" class="btn btn-primary btn-lg btn-block text-seder" type="submit" value="GUARDAR HIJO">
                                    </form>
                                    <br>
                                    <br>
                                    <label for="Cedula" class="">Hijos Registrados</label>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <center>ID Hijo</center>
                                                </td>
                                                <td>
                                                    <center>Nombres</center>
                                                </td>
                                                <td>
                                                    <center>Apellidos</center>
                                                </td>
                                                <td>
                                                    <center>Sexo</center>
                                                </td>
                                                <td>
                                                    <center>Fecha de Nacimiento</center>
                                                </td>
                                                <td>
                                                    <center>Tipo Documento</center>
                                                </td>
                                                <td>
                                                    <center>N??mero de Documento</center>
                                                </td>
                                                <td>
                                                    <center>Acciones</center>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="hijo">
                                        </tbody>
                                    </table>
                                    <hr>
                                    <br>
                                    <br>
                                    <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                </div>
                                <div class="tab-pane show" id="informacion_academica" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>
                                    <h5 class="card-title">INFORMACI??N ACAD??MICA DEL CONTRATISTA ID Contratista -><?php echo $id_contratista ?></h5>
                                    <label for="Nombres" class="">Por favor llenar la informaci??n seg??n corresponda
                                    </label>
                                    <br>
                                    <br>
                                    <hr>
                                    </label>
                                    <form action="actualizar_contratista_inteligente.php" method="POST">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <div class="position-relative form-group"><label for="NivelEducativo" class="">Nivel Educativo</label>
                                                        <select name="nivel_educativo" id="nivel_educativo" class="form-control" required>
                                                            <option><?php echo $fila->nivel_educativo ?></option>
                                                            <option>Primaria</option>
                                                            <option>Bachiller</option>
                                                            <option>Tecn??logo</option>
                                                            <option>T??cnico</option>
                                                            <option>Profesional</option>
                                                            <option>Maestr??a</option>
                                                            <option>Especializaci??n</option>
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
                                                    <input name="nombre_pregrado" id="apellidos" placeholder="" type="text" value="<?php echo $fila->nombre_pregrado ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="position-relative form-group">
                                                <div class="position-relative form-group"><label for="NivelEducativo" class="">Proceso Formaci??n Pregrado</label>
                                                    <select name="proceso_pregrado" id="nivel_educativo" class="form-control">
                                                        <option><?php echo $fila->proceso_pregrado ?></option>
                                                        <option>Graduado</option>
                                                        <option>Proceso de Formaci??n</option>
                                                        <option>No terminado</option>
                                                        <option value="">No Aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">Estudio Posgrado</label>
                                                    <input name="nombre_posgrado" id="apellidos" placeholder="" type="text" value="<?php echo $fila->nombre_posgrado ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="position-relative form-group">
                                                <div class="position-relative form-group"><label for="NivelEducativo" class="">Proceso Formaci??n Posgrado</label>
                                                    <select name="proceso_posgrado" id="nivel_educativo" class="form-control">
                                                        <option><?php echo $fila->proceso_posgrado ?></option>
                                                        <option>Graduado</option>
                                                        <option>Proceso de Formaci??n</option>
                                                        <option>No terminado</option>
                                                        <option value="">No Aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>
                                <div class="tab-pane show" id="salud_ocupacional" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>

                                    <form action="actualizar_contratista_inteligente.php" method="POST">
                                        <h5 class="card-title">INFORMACI??N DE SALUD OCUPACIONAL</h5>
                                        <label for="Nombres" class="">Ingresa aqu?? la informaci??n sobre salud ocupacional
                                        </label>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>SALUD Y PENSIONES</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">EPS</label>
                                                    <select name="eps" id="sexo" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["eps"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from eps_vigentes order by nombre_eps asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_eps"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">ARL</label>
                                                    <select name="arl" id="fk_id_dependencia" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["arl"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from arl_vigentes order by nombre_arl asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_arl"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">CAJA DE COMPENSACI??N</label>
                                                    <select name="caja" id="sexo" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["caja"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from cajas_vigentes order by nombre_caja asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_caja"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">FONDO DE PENSIONES</label>
                                                    <select name="pensiones" id="sexo" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["pensiones"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from pensiones_vigentes order by nombre_pensiones asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_pensiones"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">En Caso de emergencia llamar a:</label>
                                                    <input name="nombre_emergencia" id="numero_documento_hijo" placeholder="Nombre del contacto" type="text" class="form-control" value="<?php echo $fila->nombre_emergencia ?>" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Numero de Tel??fono</label>
                                                    <input name="numero_emergencia" id="numero_documento_hijo" placeholder="Tel??fono del Contacto" type="number" class="form-control" value="<?php echo $fila->numero_emergencia ?>" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Si padece alguna enfermedad, describala a continuaci??n</label>
                                                    <textarea name="enfermedad" class="form-control" rows="4"><?php echo $fila->enfermedad ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Si recibe alg??n tipo de tratamiento o toma medicamentos, describalo a continuaci??n</label>
                                                    <textarea name="tratamiento" class="form-control" rows="4"><?php echo $fila->tratamiento ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Si es al??rgico a alg??n medicamento o alimento, describalo a continuaci??n</label>
                                                    <textarea name="alergias" class="form-control" rows="4"><?php echo $fila->alergias ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><label for="Cedula" class="">??Qu?? actividad te gusta o te gustar??a recibir??? Art??sticos y culturales,
                                                        Deportivos, Prevenci??n de la Salud (anti estr??s), Capacitaci??n informal en
                                                        artes y artesan??as, Ninguna, Otro:</label>
                                                    <textarea name="actividades" class="form-control" rows="4"><?php echo $fila->actividades ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Variables Culturales y H??bitos: ??Practica deportes? ??Lee? ??Descansa?
                                                        ??Consume bebidas alcoh??licas? ??Fuma? ??Otro?</label>
                                                    <textarea name="variables_culturales" class="form-control" rows="4"><?php echo $fila->variables_culturales ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>
                                <div class="tab-pane show" id="etnias_grupos" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>
                                    <form action="actualizar_contratista_inteligente.php" method="POST">
                                        <h5 class="card-title">INFORMACI??N ??TNICA</h5>
                                        <label for="Nombres" class="">Ingresa aqu?? la informaci??n sobre salud ocupacional
                                        </label>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>INFORMACI??N ??TNIAS Y GRUPOS</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="position-relative form-group"><label for="Cedula" class="">??De acuerdo a su cultura, pueblo o rasgos f??sicos, es o se reconoce c??mo?</label>
                                                    <select name="rasgos" id="sexo" class="form-control" required="true">
                                                        <option><?php echo $fila->rasgos ?></option>
                                                        <option>Negro</option>
                                                        <option>Mulato</option>
                                                        <option>Blanco</option>
                                                        <option>Palenquero</option>
                                                        <option>Indigena</option>
                                                        <option>Raizal</option>
                                                        <option>Mestizo</option>
                                                        <option>ROM</option>
                                                        <option>Gitano</option>
                                                        <option>No Aplica</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="position-relative form-group"><label for="Cedula" class="">??Pertenece usted actualmente a alguno de estos grupos poblacionales, comunitarios o sociales.</label>
                                                    <select name="grupos" id="sexo" class="form-control" required="true">
                                                        <option><?php echo $fila->grupos ?></option>
                                                        <option>Adulto mayor</option>
                                                        <option>V??ctima del conflicto armado</option>
                                                        <option>Junta de acci??n local</option>
                                                        <option>Grupo organizado de j??venes</option>
                                                        <option>Afrodescendiente</option>
                                                        <option>Desplazado,</option>
                                                        <option>Grupo organizado de mujeres</option>
                                                        <option>LGTBI</option>
                                                        <option>Ind??genas</option>
                                                        <option>Junta de acci??n comunal</option>
                                                        <option>Ninguna</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="position-relative form-group"><label for="Cedula" class="">??Posee alguna condici??n de discapacidad?</label>
                                                    <select name="discapacidad" id="sexo" class="form-control" required="true">
                                                        <option><?php echo $fila->discapacidad ?></option>
                                                        <option>F??sica,</option>
                                                        <option>Cognitiva</option>
                                                        <option>Intelectual</option>
                                                        <option>Visual</option>
                                                        <option>Sensoria</option>
                                                        <option>Multiple</option>
                                                        <option>Ninguna Discapacidad</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>
                                <div class="tab-pane show" id="contrato_asociado" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>
                                    <form action="actualizar_contratista_inteligente.php" method="POST">

                                        <h5 class="card-title">INFORMACI??N DEL CONTRATO Y EL CONTRATISTA</h5>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Contrato asignado actualmente</h5>
                                                <br>
                                                <h6 class="card-subtitle mb-2 text-muted">Contrato N??mero: <b><?php echo $fila->numero ?> - ID Contrato -><?php echo $fila->fk_id_contrato ?></b></h6>
                                                <br>
                                                <p class="card-text"><b>OBJETO:</b><br></p>
                                                <p class="card-text"><?php echo $fila->objeto ?></p>
                                                <hr>
                                                <p class="card-text">Contratista:<br><b><?php echo $fila->nombres . " " . $fila->apellidos ?></b></p>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>ASOCIACI??N DE UN NUEVO CONTRATO AL CONTRATISTA</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Por favor seleccione el contrato a asignar al contratista</label>
                                                    <select name="fk_id_contrato" id="sexo" class="form-control" required="true">
                                                        <option disabled selected value> -- seleccionar -- </option>
                                                        <?php

                                                         //Carga la dependencia del contratista directamente haciendo la consulta desde la tabla Contratista
                                                         $sentencia_dependencia_contratista = "SELECT * FROM contratista where id_contratista = $id_contratista";
                                                         $resultado_dependencia_contratista = mysqli_query($conexion, $sentencia_dependencia_contratista);
                                                         $fila_dependencia_contratista = mysqli_fetch_assoc($resultado_dependencia_contratista);
                                                         $fk_id_dependencia = $fila_dependencia_contratista["fk_id_dependencia"];



                                                        $sentencia_contrato = "SELECT * FROM `contrato` where contrato.id_contrato not in ( SELECT fk_id_contrato from contratista ) and contrato.activo = 1 and fk_id_dependencia =$fk_id_dependencia order by contrato.id_contrato desc";
                                                        $resultado_contrato = mysqli_query($conexion, $sentencia_contrato);
                                                        while ($fila_contrato = mysqli_fetch_assoc($resultado_contrato)) {
                                                        ?>
                                                            <option value=<?php echo $fila_contrato["id_contrato"] ?>><?php echo $fila_contrato["numero"] . " - " . $fila_contrato["objeto"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <div class="mb-3 card text-white card-body bg-danger">
                                                        <h5 class="text-white card-title">Atenci??n</h5>Por favor asegurese que selecciona el contrato adecuado, lea bien el n??mero del contrato y el objeto a asignar antes de guardar.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>

                                <div class="tab-pane show" id="credenciales_foto" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>
                                    <h5 class="card-title">CAMBIAR FOTO DEL CONTRATISTA Y CAMBIAR CREDENCIALES</h5>
                                    <hr>
                                    <br>
                                    <br>
                                    Seleccione una foto del contratista
                                    </label>
                                    <div class="container">
                                        <input type="file" name="upload_image" id="upload_image" required />
                                        <br>
                                        <br>
                                        <div id="uploaded_image"><img src="<?php echo $fila->foto ?>"> (Foto Actual del Contratista)</div>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <form action="actualizar_contratista_inteligente.php" method="POST">
                                        <div class="position-relative form-group"><label for="coreo" class="">Usuario (correo)</label><input name="usuario" id="correo" placeholder="correo electr??nico" type="text" class="form-control" value="<?php echo $fila->usuario ?>" required="true"></div>
                                        <div class="position-relative form-group"><label for="password" class="">Contrase??a</label><input name="password" id="password" placeholder="contrase??a" type="text" class="form-control" value="<?php echo $fila->password ?>" required="true"></div>
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php include("pie.php"); ?>
            </div>
        </div>
    </div>

<?php
} else
//Editar Contratista tipo Persona Jur??dica
{
?>

    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-id icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>Editar Informaci??n del Contratista
                            <div class="page-title-subheading">Informaci??n perteneciente a un contratista
                            </div>
                        </div>
                        <div>
                            <img width="80" class="rounded-circle" style="margin-left: 15px;" src="<?php echo $fila->foto; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fila que contiene la informaci??n de la p??gina -->
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">INFORMACI??N SOBRE EL CONTRATISTA -> <?php echo $id_contratista ?></h5>
                            <br>
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a data-toggle="tab" href="#info_basica" class="nav-link show active">Informaci??n B??sica</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#salud_ocupacional" class="nav-link show">Salud Ocupacional</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#contrato_asociado" class="nav-link show">Contrato Asociado</a></li>
                                <li class="nav-item"><a data-toggle="tab" href="#credenciales_foto" class="nav-link show">Credenciales y Foto</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="info_basica" role="tabpanel">
                                    <form id="registration_form_2" action="actualizar_contratista_inteligente.php" method="POST">
                                        <h5 class="card-title">DATOS PERSONALES</h5>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Nombre de la Empresa</label><input name="nombres" id="nombres" placeholder="Nombres" type="text" class="form-control" required="true" value="<?php echo $fila->nombres ?>"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Apellidos" class="">NIT</label><input name="nit" id="apellidos" placeholder="Apellidos" type="text" class="form-control" value="<?php echo $fila->NIT ?>" required="true"></div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Representante Legal</label><input name="representante_legal" id="nombres" placeholder="" type="text" class="form-control" value="<?php echo $fila->representante_legal ?>" required="true"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Direcci??n</label><input name="direccion_residencia" id="nombres" placeholder="" type="text" class="form-control" value="<?php echo $fila->direccion_residencia ?>" required="true"></div>
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Departamento</label>
                                                    <select name="departamento" id="lista_departamento" placeholder="" type="text" class="form-control" required="true"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Municipio</label>
                                                    <select name="municipio" id="municipios" placeholder="" type="text" class="form-control" required="true"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Tel??fono</label>
                                                    <input name="telefono" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" value="<?php echo $fila->telefono ?>" required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group"><label for="Nombres" class="">Tel??fono Emergencias</label>
                                                    <input name="telefono_emergencias" id="telefono" placeholder="Telefono de contacto" type="text" class="form-control" value="<?php echo $fila->telefono_emergencias ?>" required="true">
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
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" id="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>

                                <div class="tab-pane show" id="salud_ocupacional" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>

                                    <form action="actualizar_contratista_inteligente.php" method="POST">
                                        <h5 class="card-title">INFORMACI??N DE SALUD OCUPACIONAL</h5>
                                        <label for="Nombres" class="">Ingresa aqu?? la informaci??n sobre salud ocupacional
                                        </label>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>SALUD Y PENSIONES</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">EPS</label>
                                                    <select name="eps" id="sexo" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["eps"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from eps_vigentes order by nombre_eps asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_eps"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">ARL</label>
                                                    <select name="arl" id="fk_id_dependencia" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["arl"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from arl_vigentes order by nombre_arl asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_arl"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">CAJA DE COMPENSACI??N</label>
                                                    <select name="caja" id="sexo" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["caja"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from cajas_vigentes order by nombre_caja asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_caja"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="position-relative form-group"><label for="Cedula" class="">FONDO DE PENSIONES</label>
                                                    <select name="pensiones" id="sexo" class="form-control" required="true">
                                                        <option>
                                                            <?php
                                                            $sql = "select * from contratista where id_contratista =" . $id_contratista;
                                                            $res = mysqli_query($conexion, $sql);
                                                            $datos = mysqli_fetch_assoc($res);
                                                            echo $datos["pensiones"];
                                                            ?>
                                                        </option>
                                                        <?php
                                                        $sentencia_eps = "select * from pensiones_vigentes order by nombre_pensiones asc";
                                                        $resultado_eps = mysqli_query($conexion, $sentencia_eps);
                                                        while ($fila_eps = mysqli_fetch_assoc($resultado_eps)) {
                                                        ?>
                                                            <option><?php echo $fila_eps["nombre_pensiones"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>

                                <div class="tab-pane show" id="contrato_asociado" role="tabpanel">
                                    <?php

                                     //Carga la dependencia del contratista directamente haciendo la consulta desde la tabla Contratista
                                     $sentencia_dependencia_contratista = "SELECT * FROM contratista where id_contratista = $id_contratista";
                                     $resultado_dependencia_contratista = mysqli_query($conexion, $sentencia_dependencia_contratista);
                                     $fila_dependencia_contratista = mysqli_fetch_assoc($resultado_dependencia_contratista);
                                     $fk_id_dependencia = $fila_dependencia_contratista["fk_id_dependencia"];


                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>
                                    <form action="actualizar_contratista_inteligente.php" method="POST">

                                        <h5 class="card-title">INFORMACI??N DEL CONTRATO Y EL CONTRATISTA</h5>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Contrato asignado actualmente</h5>
                                                <br>
                                                <h6 class="card-subtitle mb-2 text-muted">Contrato N??mero: <b><?php echo $fila->numero ?> - ID Contrato -><?php echo $fila->fk_id_contrato ?></b></h6>
                                                <br>
                                                <p class="card-text"><b>OBJETO:</b><br></p>
                                                <p class="card-text"><?php echo $fila->objeto ?></p>
                                                <hr>
                                                <p class="card-text">Contratista:<br><b><?php echo $fila->nombres . " " . $fila->apellidos ?></b></p>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <hr>
                                        <label for="Nombres" class=""><b>ASOCIACI??N DE UN NUEVO CONTRATO AL CONTRATISTA</b>
                                        </label>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <div class="position-relative form-group"><label for="Cedula" class="">Por favor seleccione el contrato a asignar al contratista</label>
                                                    <select name="fk_id_contrato" id="sexo" class="form-control" required="true">
                                                        <option disabled selected value> -- seleccionar -- </option>
                                                        <?php
                                                        $sentencia_contrato = "SELECT * FROM `contrato` where contrato.id_contrato not in ( SELECT fk_id_contrato from contratista ) and contrato.activo = 1 and fk_id_dependencia =$fk_id_dependencia order by contrato.id_contrato desc";
                                                        $resultado_contrato = mysqli_query($conexion, $sentencia_contrato);
                                                        while ($fila_contrato = mysqli_fetch_assoc($resultado_contrato)) {
                                                        ?>
                                                            <option value=<?php echo $fila_contrato["id_contrato"] ?>><?php echo $fila_contrato["numero"] . " - " . $fila_contrato["objeto"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <div class="mb-3 card text-white card-body bg-danger">
                                                        <h5 class="text-white card-title">Atenci??n</h5>Por favor asegurese que selecciona el contrato adecuado, lea bien el n??mero del contrato y el objeto a asignar antes de guardar.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>
                                </div>

                                <div class="tab-pane show" id="credenciales_foto" role="tabpanel">
                                    <?php
                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                    $resultado = $conexion->query($sentencia);
                                    $fila = $resultado->fetch_object();
                                    $id_contrato = $fila->id_contrato;
                                    ?>
                                    <h5 class="card-title">CAMBIAR FOTO DEL CONTRATISTA Y CAMBIAR CREDENCIALES</h5>
                                    <hr>
                                    <br>
                                    <br>
                                    Seleccione una foto del contratista
                                    </label>
                                    <div class="container">
                                        <input type="file" name="upload_image" id="upload_image" required />
                                        <br>
                                        <br>
                                        <div id="uploaded_image"><img src="<?php echo $fila->foto ?>"> (Foto Actual del Contratista)</div>
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <form action="actualizar_contratista_inteligente.php" method="POST">
                                        <div class="position-relative form-group"><label for="coreo" class="">Usuario (correo)</label><input name="usuario" id="correo" placeholder="correo electr??nico" type="text" class="form-control" value="<?php echo $fila->usuario ?>" required="true"></div>
                                        <div class="position-relative form-group"><label for="password" class="">Contrase??a</label><input name="password" id="password" placeholder="contrase??a" type="text" class="form-control" value="<?php echo $fila->password ?>" required="true"></div>
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
                                        <button class="btn btn-success">GUARDAR INFORMACI??N DEL CONTRATISTA</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php include("pie.php"); ?>
            </div>
        </div>
    </div>

<?php
}
?>

<div id="uploadimageModal" class="modal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Imagen del Contratista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary crop_image">Guardar Imagen</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        //Crop
        console.log("carg?? cropie desde paso9");

        //Cropie
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload_image').on('change', function() {
            console.log("ejecutando...");
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                $.ajax({
                    url: "cargar_foto_contratista.php",
                    type: "POST",
                    data: {
                        "image": response,
                        "id_contratista": <?php echo $id_contratista ?>
                    },
                    success: function(data) {
                        $('#uploadimageModal').modal('hide');
                        $('#uploaded_image').html(data);
                    }
                });
            })
        });

    });
</script>