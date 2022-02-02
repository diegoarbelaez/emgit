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
                    <div>Registro Guardado
                        <div class="page-title-subheading">Guardar la Información
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
                        <h5 class="card-title">Registro Almacenado</h5>
                        <div class="alert alert-success fade show" role="alert">
                            <h4 class="alert-heading">Muy Bien!</h4>
                            <p>Loa datos que ingresaste fueron creados en la base de datos</p>
                            <hr>
                            <p class="mb-0">Registros creados sin errores</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
