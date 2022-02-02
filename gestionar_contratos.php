<?php include("conexion.php"); ?>
<?php
error_reporting(E_ALL);

?>
<!-- MODAL QUE CONFIRMA LA ELIMINACION
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                ...
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
-->


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Gestionar Contratos
                        <div class="page-title-subheading">Editar o Eliminar Contratos
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
                        <h5 class="card-title">Listado de Contratos</h5>
                        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Número</th>
                                    <th>Nombre</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Objeto</th>
                                    <th>Valor</th>
                                    <th>Dependencia</th>
                                    <th width="10%">Gestionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Gestiono solo los contratos de la dependencia
                                $id_dependencia = $_SESSION["id_dependencia"];
                                $sentencia = "SELECT contrato.id_contrato,contrato.numero,contrato.nombre,contrato.fecha_inicio,contrato.fecha_fin,contrato.objeto,contrato.valor,contrato.otrosi,dependencia.nombre as nombre_dependencia FROM contrato inner join dependencia on contrato.fk_id_dependencia=dependencia.id_dependencia where contrato.activo=1 and contrato.fk_id_dependencia=$id_dependencia and contrato.activo = 1 order by contrato.id_contrato desc";
                                //echo $sentencia;
                                $resultado = $conexion->query($sentencia);
                                if ($resultado) {
                                    while ($fila = $resultado->fetch_object()) { ?>
                                        <tr>
                                            <td><?php echo $fila->id_contrato ?></td>
                                            <td><?php echo $fila->numero ?></td>
                                            <td><a href="visualizar_contrato.php?id_contrato=<?php echo base64_encode($fila->id_contrato) ?>"><?php echo $fila->nombre ?></a></td>
                                            <td><?php echo $fila->fecha_inicio ?></td>
                                            <td><?php
                                                //Valida si hay Otrosi, para mostrar la fecha de final del otrosi, no del contrato
                                                $fecha_fin_mostrar = $fila->fecha_fin;
                                                if ($fila->otrosi > 0) {
                                                    $sentencia_fecha_final_otrosi = "SELECT * FROM otrosi where fk_id_contrato = $fila->id_contrato";
                                                    $resultado_fecha_otrosi = mysqli_query($conexion, $sentencia_fecha_final_otrosi);
                                                    $fila_otrosi = mysqli_fetch_assoc($resultado_fecha_otrosi);
                                                    $fecha_fin_mostrar = $fila_otrosi["fecha_fin"];
                                                }
                                                echo $fecha_fin_mostrar;
                                                ?></td>
                                            <td><?php echo $fila->objeto ?></td>
                                            <td><?php echo "$" . number_format($fila->valor) ?></td>
                                            <td><?php echo $fila->nombre_dependencia ?></td>
                                            <td>
                                                <a href="pre_eliminar_contrato.php?id_contrato=<?php echo base64_encode($fila->id_contrato) ?>" class="btn btn-danger"><i class="metismenu-icon pe-7s-trash"></i></a>
                                                <a href="visualizar_contrato.php?id_contrato=<?php echo base64_encode($fila->id_contrato) ?>" class="btn btn-primary"><i class="metismenu-icon pe-7s-pen"></i></a>
                                            </td>
                                        </tr>
                                <?php
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
?>