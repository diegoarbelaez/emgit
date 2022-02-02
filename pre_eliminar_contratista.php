<?php include("conexion.php"); ?>
<?php
include("encabezado.php");
include("nav.php");

$id_contratista = base64_decode($_GET["id_contratista"]);
$sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato where contratista.activado = 1 and contratista.id_contratista=$id_contratista and contratista.fk_id_dependencia = $id_dependencia order by id_contratista desc";
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
                    <div>Gestionar Contratistas
                        <div class="page-title-subheading">Editar o Eliminar Contratistas
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
                        <h5 class="card-title">Confirmar Eliminación del Contratista</h5>
                        <div class="card-border mb-3 card card-body border-danger">
                            <h5 class="card-title">Se eliminará el contratista de forma definitiva</h5>Ten cuidado, esta acción no tiene retroceso<br>
                            <table>
                                <tr>
                                    <td><img width="100" class="rounded-circle" src="<?php echo $fila->foto; ?>" alt=""></td>
                                </tr>
                                <tr>
                                    <td><b>Nombre:</b> <?php echo $fila->nombres . " " . $fila->apellidos ?></td>
                                </tr>
                                <tr>
                                    <td><b>Objeto del Contrato:</b> <?php echo $fila->objeto ?></td>
                                </tr>
                                <tr>
                                    <td><b>Número del Contrato:</b> <?php echo $fila->numero ?></td>
                                </tr>
                                <tr>
                                    <td><b>Fecha Inicio:</b> <?php echo $fila->fecha_inicio ?></td>
                                </tr>
                                <tr>
                                    <td><b>Fecha Fin:</b> <?php echo $fila->fecha_fin ?></td>
                                </tr>
                                <td>
                                    <br>
                                    <a href="eliminar_contratista.php?id_contratista=<?php echo base64_encode($fila->id_contratista) ?>" class="btn btn-danger"><i class="metismenu-icon pe-7s-trash"></i> CONFIRMAR ELIMINACIÓN</a>
                                    <a href="contenedor_gestionar_contratistas.php" class="btn btn-primary"><i class="metismenu-icon pe-7s-refresh"></i> REGRESAR</a>
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