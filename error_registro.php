<?php include("conexion.php"); ?>
<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Registro No almacenado
                        <div class="page-title-subheading">Error al guardar la información
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
                        <h5 class="card-title">Registro con Errores</h5>
                        <div class="alert alert-danger fade show" role="alert">
                            <h4 class="alert-heading">Algo no funcionó bien</h4>
                            <p>Los datos que ingresaste están equivocados</p>
                            <hr>

                            <p class="mb-0">Intentaste cargar una foto con formato diferente a JPG, GIF o PNG o hubo un error con la carga del archivo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
