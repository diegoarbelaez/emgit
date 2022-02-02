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
<?php include("conexion.php"); ?>
<?php


?>

<script src="js/bootbox.min.js"></script>
<script src="js/bootbox.locales.min.js"></script>
<script type="text/javascript" src="js/deleteRecords.js"></script>


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Informes de Contratistas Generados
                        <div class="page-title-subheading">Detalle de Archivos
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Listado de Informes</h5>
                        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre del Archivo</th>
                                    <th>Fecha de Elaboración</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $dir    = 'SIAOBSERVA/CONTRATISTAS/';
                                $files1 = scandir($dir);
                                //$files2 = scandir($dir, 1);

                                //print_r($files1);

                                foreach ($files1 as $archivo) {

                                    if (strlen($archivo) > 30) {
                                        echo "<tr>";
                                        echo "<td><a href='SIAOBSERVA/CONTRATISTAS/" . $archivo . "' target='new'>" . $archivo . "</a></td>";
                                        $fecha = explode(" ", $archivo);
                                        echo "<td>" . $fecha[0] . " " . $fecha[1] . "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>

<?php
/*
$dir    = 'SIAOBSERVA/CONTRATISTAS/';
$files1 = scandir($dir);
//$files2 = scandir($dir, 1);

//print_r($files1);

foreach($files1 as $archivo){
    echo $archivo;
    echo "<br>";
}

//print_r($files2);
*/
?>