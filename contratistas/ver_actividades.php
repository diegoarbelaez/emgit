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
$id_contrato = base64_decode($_GET["id_contrato"]);
$sentencia = "SELECT * from contrato where id_contrato=$id_contrato";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
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
                    <div>Ver Acciones o Eventos sobre el contrato
                        <div class="page-title-subheading">Ver acciones realizadas
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="ver_actividades_log.php" method="POST">
            <div class="row mb-3 ">
                <div class="mb-3 card">
                    <div class="main-card mb-3 ">
                        <div class="card-body">
                            <h5 class="card-title">Ultimos reportes sobre este contrato</h5>
                            <br>
                            <p><b>Número del contrato: </b><br><?php echo $fila->numero ?></p>
                            <p><b>Objeto del contrato: </b><br><?php echo $fila->objeto ?></p>
                            <div class="position-relative form-group"><label for="actividad" class=""><b>Actividad del Contrato</b></label>
                                <select class="form-control" name="actividad">
                                    <?php
                                    $sentencia2 = "SELECT * FROM actividades WHERE fk_id_contrato=$id_contrato";
                                    $resultado2 = $conexion->query($sentencia2);
                                    if ($resultado2) {
                                        while ($fila2 = $resultado2->fetch_object()) {
                                            echo '<option value="' . $fila2->id_actividad . '">' . $fila2->descripcion . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="id_contrato" value="<?php echo $id_contrato; ?>">

                            </div>
                            <div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td style="padding-right: 22px">
                                                <div>
                                                    <label>Fecha de Inicio</label>
                                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="" value="" required="">
                                                    <input type="hidden" name="id_contratista" value="487" <="" div="">
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <label>Fecha de Finalizacion</label>
                                                    <input type="date" name="fecha_fin" id="fecha" class="form-control" placeholder="" value="" required="">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <button class="submit btn btn-success">Ver Hechos sobre esta actividad</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <?php include("pie.php"); ?>
    </div>
</div>