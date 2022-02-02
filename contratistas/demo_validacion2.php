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
<style>
    form .error {
        color: #ff0000;
    }
</style>
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
                        <form action="dashboard.php" id="formulario" method="POST">
                            <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Digite el código....">
                                <div class="suggestions" id="suggestions2"></div>
                            </div>
                            <input type="submit" class="btn btn-success" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("#formulario").validate({
                // Specify validation rules
                rules: {
                    codigo: {
                        required: true,
                        remote: {
                            url: "validar_usuario.php",
                            type: "post",
                            data: {
                                username: function() {
                                    return $("#codigo").val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    // Specify validation error messages
                    codigo: "Codigo Inválido o Vacío, por favor verificar"
                    // Make sure the form is submitted to the destination defined
                    // in the "action" attribute of the form when valid
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    });
</script>