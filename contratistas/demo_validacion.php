<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
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
                        <form action="demo_validacion.php" id="formulario" method="POST">
                            <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Digite el código...." required>
                                <div class="suggestions" id="suggestions"></div>
                            </div>
                            <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple</label>
                                <input type="text" class="form-control" name="codigo2" id="codigo2" placeholder="Digite el código....">
                                <div class="suggestions" id="suggestions2"></div>
                            </div>
                            <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple</label>
                                <input type="text" class="form-control" name="codigo3" id="codigo3" placeholder="Digite el código....">
                                <div class="suggestions" id="suggestions3"></div>
                            </div>
                            <button type="submit" id="enviar" class="mt-1 btn btn-primary">SIGUIENTE -> AGREGAR ACTIVIDADES</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
</div>
<script>
    $(document).ready(function() {
        $("#formulario").validate({
            rules: {
                codigo: {
                    required: {
                        depends: function(elem) {
                            return $("#codigo").val() > 50
                        }
                    },
                    number: true,
                    min: 0
                }
            }
        });
    });
</script>