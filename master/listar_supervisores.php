<?php include("conexion.php"); ?>
<?php


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
                    <div>Gestionar Supervisores
                        <div class="page-title-subheading">Editar o Eliminar Supervisores
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
                        <h5 class="card-title">Listado de Supervisores</h5>
                        <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Usuario</th>
                                    <th>Contraseña</th>
                                    <th>Dependencia</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Gestiono solo los contratos de la dependencia
                                $id_dependencia = $_SESSION["id_dependencia"];


                                $sentencia = "SELECT id,usuario,password,dependencia.nombre as dep FROM administradores inner join dependencia on administradores.fk_id_dependencia=dependencia.id_dependencia order by id desc";
                                $resultado = $conexion->query($sentencia);
                                if ($resultado) {
                                    while ($fila = $resultado->fetch_object()) { ?>
                                        <tr>
                                            <td><?php echo $fila->id ?></td>
                                            <td><a href="editar_supervisor.php?id=<?php echo $fila->id ?>"><?php echo $fila->usuario ?></a></td>
                                            <td><?php echo $fila->password ?></td>
                                            <td><?php echo $fila->dep ?></td>                                            
                                            <td>
                                                <a href="eliminar_supervisor.php?id=<?php echo $fila->id ?>" class="btn btn-danger"><i class="metismenu-icon pe-7s-trash"></i></a>
                                                <a href="editar_supervisor.php?id=<?php echo $fila->id ?>" class="btn btn-primary"><i class="metismenu-icon pe-7s-pen"></i></a>
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