<?php include("conexion.php");
include("encabezado.php");
include("nav.php");


//Esta validación se hace para comprobar si llega a este paso porque va en el flujo normal de la creación o le hizo click en regresar cuando confirmaba la 
//asociación del contrato en el paso 5 de la creación de la persona jurídica

if (isset($_POST["eps"]) && isset($_POST["arl"]) && isset($_POST["caja"]) && isset($_POST["pensiones"])) {
    //crea el contratista con la información que llega
    //Si entra a esta validación es porque viene del paso 3 de Agregar persona jurídica
    $eps = $_POST["eps"];
    $arl = $_POST["arl"];
    $caja = $_POST["caja"];
    $pensiones = $_POST["pensiones"];
    $id_contratista = $_POST["id_contratista"];

    $sentencia = "update contratista set 
    eps = '$eps',
    arl = '$arl',
    caja ='$caja',
    pensiones ='$pensiones'
    WHERE id_contratista=$id_contratista";

    if ($conexion->query($sentencia) === TRUE) {
        //header("Location:registro_guardado.php");
    } else {
        echo "Error: " . $sentencia . "<br>" . $conexion->error;
    }
}
$id_contratista = $_SESSION["id_contratista_creado"];
//Trae la dependencia, porque no la tenemos en este query
$sentencia_dependencia = "select fk_id_dependencia from contratista where id_contratista=$id_contratista";
$respultado_dependencia = mysqli_query($conexion, $sentencia_dependencia);
$fila_dependencia = mysqli_fetch_assoc($respultado_dependencia);
$fk_id_dependencia = $fila_dependencia["fk_id_dependencia"];
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
                        <h5 class="card-title">INFORMACIÓN DEL CONTRATO Y EL CONTRATISTA</h5>
                        <label for="Nombres" class="">Es muy importante que asocies el contrato adecuado
                        </label>
                        <br>
                        <br>
                        <hr>
                        <label for="Nombres" class=""><b>ASOCIACIÓN DEL CONTRATO AL CONTRATISTA</b>
                        </label>
                        <form action="paso4_persona_juridica.php" method="POST">
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
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                            <input type="submit" name="next" class="next btn btn-success" value="CONFIRMAR LA ASIGNACIÓN DEL CONTRATO" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>