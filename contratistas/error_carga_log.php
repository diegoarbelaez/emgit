<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php 
include("encabezado.php");
include("nav.php");
$id_contrato=base64_decode($_GET["id_contrato"]);
$error = $_GET["error"];
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Evidencia no almacenada
                        <div class="page-title-subheading">No se guardó la Información
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-8">
                <div class="main-card mb-6 card">
                    <div class="card-body">
                        <h5 class="card-title">Registro no almacenado</h5>
                        <div class="alert alert-danger fade show" role="alert">
                            <h4 class="alert-heading">Algo falló!</h4>
                            <p>La evidencia sobre esta actividad <b>No pudo ser cargada</b></p>
                            <hr>
                            <br><p class="mb-0"><?php echo $error; ?>
                        </div>
                        <a href="reporteador.php?id_contrato=<?php echo base64_encode($id_contrato) ?>" class="btn btn-primary">REGISTRAR MAS ACTIVIDADES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
</div>