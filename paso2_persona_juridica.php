<?php 
include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$nombres = $_POST["nombres"];
$nit = $_POST["nit"];
$representante_legal = $_POST["representante_legal"];
$fk_id_contrato = 9999; // Contrato por defecto que se agrega a un contratista, que se modifica en la creación del contratista, como es una FK no puedo crear el contratista sin ese campo
$fk_id_dependencia = $_POST["fk_id_dependencia"];
$direccion_residencia = $_POST["direccion_residencia"];
$departamento = $_POST["departamento"];
$municipio = $_POST["municipio"];
$telefono = $_POST["telefono"];
$telefono_emergencias = $_POST["telefono_emergencias"];
$sentencia = "insert into contratista (
    nombres,
    nit,
    representante_legal,
    telefono,
    fk_id_dependencia,
    fk_id_contrato,
    direccion_residencia,
    telefono_emergencias,
    departamento,
    municipio,
    tipo
    ) values (
        '$nombres',
        '$nit',
        '$representante_legal',
        '$telefono',
        $fk_id_dependencia,
        $fk_id_contrato,
        '$direccion_residencia',
        '$telefono_emergencias',
        '$departamento',
        '$municipio',
        2
        )";
//echo $sentencia;
if ($conexion->query($sentencia) === TRUE) {
    //echo "Agregado correctamente a la BD";
    //header("Location:registro_guardado.php");
    $id_contratista = $conexion->insert_id;
    //Guardo en la Variable $_SESSION el id del contratista recién creado, por si lo necesito más adelante
    $_SESSION["id_contratista_creado"] = $id_contratista;
} else {
    echo "Error: " . $sentencia . "<br>" . $conexion->error;
}
//$conexion->close();
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
            <div class="progress-bar progress-bar-striped active" style="width: 40%" aria-valuenow="40" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <form action="paso3_persona_juridica.php" method="POST">
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
                            <input type="hidden" name="id_contratista" value="<?php echo $id_contratista; ?>">
                            <input type="submit" name="next" class="next btn btn-info" value="PASO SIGUIENTE - SELECCIÓN DEL CONTRATO" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>