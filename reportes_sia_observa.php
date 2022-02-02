<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>
<?php


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
                    <div>Generación Reportes Entes de Control
                        <div class="page-title-subheading">Genera el Informe de Contratistas y de Supervisor
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
                        <form action="consulta_sia_observa.php" target="new" method="POST">

                            <h5 class="card-title">Listado de Contratistas</h5>
                            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th>Avatar</th>
                                        <th>Nombre</th>
                                        <th>Número de Contrato</th>
                                        <th width="30%">
                                            <center>Generación de Informes</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //Gestiono solo los contratos de la dependencia
                                    $id_dependencia = $_SESSION["id_dependencia"];


                                    $sentencia = "SELECT * FROM contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato where contratista.activado = 1 and contratista.fk_id_dependencia = $id_dependencia order by id_contratista desc";
                                    $resultado = $conexion->query($sentencia);
                                    if ($resultado) {
                                        while ($fila = $resultado->fetch_object()) { ?>
                                            <tr>
                                                <td><?php echo $fila->id_contratista ?></td>
                                                <td><img width="30" class="rounded-circle" src="<?php echo $fila->foto; ?>" alt=""></td>
                                                <td><?php echo $fila->nombres . " " . $fila->apellidos ?></td>
                                                <td><?php echo $fila->numero ?></td>
                                               
                                                <td>
                                                    <!-- 
                                                    <center>
                                                        <a href="pre_eliminar_contratista.php?id_contratista=<?php echo base64_encode($fila->id_contratista) ?>" class="btn btn-danger">SUPERVISOR</a>
                                                        <a href="editar_contratista.php?id_contratista=<?php echo base64_encode($fila->id_contratista) ?>" class="btn btn-primary">CONTRATISTA</a>
                                                    </center>
                                                    -->
                                                    <center>
                                                    <a href="consulta_sia_observa.php?id_contratista=<?php echo base64_encode($fila->id_contratista) ?>" class="btn btn-danger">GENERAR INFORMES ENTES DE CONTROL</a>
                                                    </center>
                                                </td>

                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>