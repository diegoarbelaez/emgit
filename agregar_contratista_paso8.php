<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$fk_id_contrato = $_POST["fk_id_contrato"];
$id_contratista = $_POST["id_contratista"];

$sentencia_contrato = "select * from contrato where id_contrato = $fk_id_contrato";
$resultado_contrato = mysqli_query($conexion, $sentencia_contrato);
$fila_contrato = mysqli_fetch_assoc($resultado_contrato);

$sentencia_contratista = "select * from contratista where id_contratista = $id_contratista";
$resultado_contratista = mysqli_query($conexion, $sentencia_contratista);
$fila_contratista = mysqli_fetch_assoc($resultado_contratista);



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
                        <h5 class="card-title">CONFIRMACIÓN FINAL DE LA ASOCIACIÓN</h5>
                        <label for="Nombres" class="">Por favor confirmar la asociación del contrato al contratista
                        </label>
                        <br>
                        <br>
                        <hr>
                        <label for="Nombres" class=""><b>ASINACIÓN A PUNTO DE CONFIRMARSE, POR FAVOR VALIDAR LOS DATOS</b>
                        </label>
                        <form action="agregar_contratista_paso9.php" method="POST">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Por favor seleccione el contrato a asignar al contratista</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Contrato a asignarse</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">Contrato Número: <b><?php echo $fila_contrato["numero"] ?></b></h6>
                                                <br>
                                                <p class="card-text"><b>OBJETO:</b><br></p>
                                                <p class="card-text"><?php echo $fila_contrato["objeto"] ?></p>
                                                <hr>
                                                <p class="card-text">Contratista:<br><b><?php echo $fila_contratista["nombres"] . " " . $fila_contratista["apellidos"] ?></b></p>
                                                <input type="submit" name="next" class="next btn btn-success" value="CONFIRMAR" />
                                                <a href="agregar_contratista_paso7.php" class="btn btn-danger">REGRESAR</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                            <input type="hidden" id="fk_id_contrato" name="fk_id_contrato" value="<?php echo $fk_id_contrato ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>