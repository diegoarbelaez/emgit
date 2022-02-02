<?php
include("conexion.php");
include("encabezado.php");
include("nav.php");

$id_rubro = base64_decode(filter_input(INPUT_GET, 'id_rubro'));

$sentencia = "SELECT * FROM codigos WHERE id_codigo = $id_rubro";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
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
                    <div>Gestionar Rubros
                        <div class="page-title-subheading">Editar o Eliminar Rubros</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Confirmar Eliminación del Rubro</h5>
                        <div class="card-border mb-3 card card-body border-danger">
                            <h5 class="card-title">Se eliminará el Rubro de forma definitiva</h5>Ten cuidado, esta acción no tiene retroceso<br>
                            <table>
                                <tr>
                                    <td><b>Código:</b> <?php echo $fila->codigo ?></td>
                                </tr>
                                <tr>
                                    <td><b>Descripcion:</b> <?php echo $fila->descripcion ?></td>
                                </tr>
                                <td>
                                    <br>
                                    <a href="eliminar_rubro.php?id_rubro=<?php echo base64_encode($fila->id_codigo) ?>" class="btn btn-danger"><i class="metismenu-icon pe-7s-trash"></i> CONFIRMAR ELIMINACIÓN</a>
                                    <a href="editar_rubro.php" class="btn btn-primary"><i class="metismenu-icon pe-7s-refresh"></i> REGRESAR</a>
                                </td>
                                </tr>
                            </table>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
?>