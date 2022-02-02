<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

?>
<!-- Logica de inserción en la base de datos usando AJAX -->
<script src="actividades.js"></script>


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Visor Detallado de un Contrato
                        <div class="page-title-subheading">Hechos, Pagos, Detalles de un contrato
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Buscar Detalles de un Contrato</h5>
                            <form method="POST" action="visor_detallado_contrato2.php">
                                <div class="position-relative form-group">
                                    <label for="Nombres" class="">Digite el número del contrato</label>
                                    <input name="numero_contrato" type="text" class="form-control">
                                </div>
                                <button class="mt-1 btn btn-primary">Consultar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php include("pie.php"); ?>
</div>