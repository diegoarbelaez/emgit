<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
?>
<style type="text/css">
    #registration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>


<script type="text/javascript" src="js/cargar_municipios_departamentos.js"></script>

<?php
$id_contratista = base64_decode($_GET["id_contratista"]);

//var_dump($fila_contratista);

//echo $fila_contratista["cedula"];

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
                    <div>Agregar Contratista
                        <div class="page-title-subheading">Se han copiado los datos del contratista
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" style="width: 25%" aria-valuenow="25" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <fieldset>
                            <h5 class="card-title" style="color:red">SE HA CREADO EL CONTRATISTA CON LOS DATOS SE SE ENCONTRARON PREVIAMENTE</h5>
                            <br>
                            <h5 class="card-title">En este momento el contratista ya se encuentra activo. Si deseas cambiar algún dato puedes encontrarlo en la sección Editar Contrasita</h5>
                        </fieldset>
                        <br>
                        <a href="editar_contratista.php?id_contratista=<?php echo base64_encode($id_contratista) ?>" class="btn btn-primary">QUIERO EDITAR AL CONTRATISTA</a>
                        <a href="contenedor_gestionar_contratistas.php" class="btn btn-secondary">REGRESAR AL DASHBOARD</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>