<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$id_contratista = $_POST["id_contratista"];
$nivel_educativo = $_POST["nivel_educativo"];


if(!isset($_POST["nombre_pregrado"])){
    $nombre_pregrado = '';
}
else {$nombre_pregrado = $_POST["nombre_pregrado"];}
if(!isset($_POST["proceso_pregrado"])){
    $proceso_pregrado = '';
} else {$proceso_pregrado = $_POST["proceso_pregrado"];}
if(!isset($_POST["nombre_posgrado"])){
    $nombre_posgrado = '';
}else {$nombre_posgrado = $_POST["nombre_posgrado"];}
if(!isset($_POST["proceso_posgrado"])){
    $proceso_posgrado = '';
}else {$proceso_posgrado = $_POST["proceso_posgrado"];}


$sentencia = "update contratista set 
nivel_educativo = '$nivel_educativo',
nombre_pregrado = '$nombre_pregrado',
proceso_pregrado = '$proceso_pregrado',
nombre_posgrado = '$nombre_posgrado',
proceso_posgrado = '$proceso_posgrado'
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
            <div class="progress-bar progress-bar-striped active" style="width: 95%" aria-valuenow="95" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">INFORMACIÓN DE SALUD OCUPACIONAL</h5>
                        <label for="Nombres" class="">Ingresa aquí la información sobre salud ocupacional
                        </label>
                        <br>
                        <br>
                        <hr>
                        <label for="Nombres" class=""><b>SALUD Y PENSIONES</b>
                        </label>
                        <form action="agregar_contratista_paso6.php" method="POST">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="position-relative form-group"><label for="Cedula" class="">EPS</label>
                                        <select name="eps" id="sexo" class="form-control" required="true">
                                            <option disabled selected value> -- seleccionar -- </option>
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
                                            <option disabled selected value> -- seleccionar -- </option>
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
                                    <div class="position-relative form-group"><label for="Cedula" class="">CAJA DE COMPENSACIÓN</label>
                                        <select name="caja" id="sexo" class="form-control" required="true">
                                            <option disabled selected value> -- seleccionar -- </option>
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
                                            <option disabled selected value> -- seleccionar -- </option>
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
                                        <input name="nombre_emergencia" id="numero_documento_hijo" placeholder="Nombre del contacto" type="text" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Numero de Teléfono</label>
                                        <input name="numero_emergencia" id="numero_documento_hijo" placeholder="Teléfono del Contacto" type="number" class="form-control" required="true">
                                    </div>
                                </div>
                                <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Si padece alguna enfermedad, describala a continuación</label>
                                        <textarea name="enfermedades" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Si recibe algún tipo de tratamiento o toma medicamentos, describalo a continuación</label>
                                        <textarea name="tratamientos" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Si es alérgico a algún medicamento o alimento, describalo a continuación</label>
                                        <textarea name="alergias" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group"><label for="Cedula" class="">¿Qué actividad te gusta o te gustaría recibir?  Artísticos y culturales,
                                            Deportivos, Prevención de la Salud (anti estrés), Capacitación informal en
                                            artes y artesanías, Ninguna, Otro:</label>
                                        <textarea name="actividades" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Variables Culturales y Hábitos: ¿Practica deportes? ¿Lee? ¿Descansa?
                                            ¿Consume bebidas alcohólicas? ¿Fuma? ¿Otro?</label>
                                        <textarea name="variables_culturales" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="next" class="next btn btn-info" value="PASO FINAL - INFORMACIÓN ADICIONAL" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>