<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$eps = $_POST["eps"];
$arl = $_POST["arl"];
$caja = $_POST["caja"];
$pensiones = $_POST["pensiones"];
$nombre_emergencia = $_POST["nombre_emergencia"];
$numero_emergencia = $_POST["numero_emergencia"];
$enfermedades = $_POST["enfermedades"];
$tratamientos = $_POST["tratamientos"];
$alergias = $_POST["alergias"];
$actividades = $_POST["actividades"];
$variables_culturales = $_POST["variables_culturales"];
$id_contratista = $_POST["id_contratista"];

$sentencia = "update contratista set 
eps = '$eps',
arl = '$arl',
caja ='$caja',
pensiones ='$pensiones',
nombre_emergencia ='$nombre_emergencia',
numero_emergencia ='$numero_emergencia',
enfermedad ='$enfermedades',
tratamiento ='$tratamientos',
alergias ='$alergias',
actividades ='$actividades',
variables_culturales ='$variables_culturales'
WHERE id_contratista=$id_contratista";

if ($conexion->query($sentencia) === TRUE) {
    //echo "Agregado correctamente a la BD";
    //header("Location:registro_guardado.php");
    //$id_contratista = $conexion->insert_id;
} else {
    echo "Error: " . $sentencia . "<br>" . $conexion->error;
}
?>
<script src="gestionHijos.js"></script>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Agregar Contratista - ID <?php echo "id->" . $id_contratista ?>
                        <div class="page-title-subheading">Cargar la información de un contratista nuevo
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" style="width: 98%" aria-valuenow="98" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">INFORMACIÓN ÉTNICA</h5>
                        <label for="Nombres" class="">Ingresa aquí la información sobre salud ocupacional
                        </label>
                        <br>
                        <br>
                        <hr>
                        <label for="Nombres" class=""><b>INFORMACIÓN ÉTNIAS Y GRUPOS</b>
                        </label>
                        <form action="agregar_contratista_paso7.php" method="POST">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="position-relative form-group"><label for="Cedula" class="">¿De acuerdo a su cultura, pueblo o rasgos físicos, es o se reconoce cómo?</label>
                                        <select name="rasgos" id="sexo" class="form-control" required="true">
                                            <option disabled selected value> -- seleccionar -- </option>
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
                                    <div class="position-relative form-group"><label for="Cedula" class="">¿Pertenece usted actualmente a alguno de estos grupos poblacionales, comunitarios o sociales.</label>
                                        <select name="grupos" id="sexo" class="form-control" required="true">
                                            <option disabled selected value> -- seleccionar -- </option>
                                            <option>Adulto mayor</option>
                                            <option>Víctima del conflicto armado</option>
                                            <option>Junta de acción local</option>
                                            <option>Grupo organizado de jóvenes</option>
                                            <option>Afrodescendiente</option>
                                            <option>Desplazado,</option>
                                            <option>Grupo organizado de mujeres</option>
                                            <option>LGTBI</option>
                                            <option>Indígenas</option>
                                            <option>Junta de acción comunal</option>
                                            <option>Ninguna</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="position-relative form-group"><label for="Cedula" class="">¿Posee alguna condición de discapacidad?</label>
                                        <select name="discapacidad" id="sexo" class="form-control" required="true">
                                            <option disabled selected value> -- seleccionar -- </option>
                                            <option>Física,</option>
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
                            <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                            <input type="submit" name="next" class="next btn btn-success" value="TERMINAR CON LA CREACIÓN DEL CONTRATISTA" />
                            <?php
                            $_SESSION["id_contratista"] = $id_contratista;
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>