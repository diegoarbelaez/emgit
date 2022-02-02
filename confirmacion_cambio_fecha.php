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
                    <div>Fecha Cambiada
                        <div class="page-title-subheading">Edición Finalizada
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
                        <h5 class="card-title">Fecha Actualizada</h5>
                        <div class="alert alert-success fade show" role="alert">
                            <h4 class="alert-heading">Muy Bien!</h4>
                            <p>La fecha de esta actividad <b>fue actualizada con éxito</b></p>
                            <hr>
                            <p class="mb-0">Recuerda que los hechos deben realizarse en la fecha<br>MegaReporte hará todo por ti, si lo alimentas a diario</p>
                        </div>
                        <a href="index.php" class="btn btn-primary">REGRESAR AL INICIO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>

</div>