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
$id_contrato = $_POST["id_contrato"];
$actividad = $_POST["actividad"];
$id_contratista = $_POST["id_contratista"];
$fecha_inicio = $_POST["fecha_inicio"] . "00:00:00";
$fecha_fin = $_POST["fecha_fin"]. "23:59:59";
//Le adiciono 5 horas porque la BD está con 5Horas de más
$fecha_inicial_reporte_tmp = strtotime ('+5 hour',strtotime($fecha_inicio));
$fecha_inicio = date ('Y-m-d H:i:s',$fecha_inicial_reporte_tmp);   
    
$fecha_final_reporte_tmp = strtotime ('+5 hour',strtotime($fecha_fin));
$fecha_fin = date ('Y-m-d H:i:s',$fecha_final_reporte_tmp);



$texto_actividad = "";
$sentencia = "SELECT * from contrato where id_contrato=$id_contrato";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();

//Saca el nombre de la actividad desde la consulta
$sentencia4 = "select * from actividades where id_actividad=$actividad";
//echo $sentencia4;
$resultado4 = $conexion->query($sentencia4);
$fila4 = $resultado4->fetch_object();
$texto_actividad = $fila4->descripcion;


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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="row mb-3 ">
                <div class="mb-3 card">
                    <div class="main-card mb-3 ">
                        <div class="card-body">
                            <h5 class="card-title">Hechos reportados sobre esta actividad</h5>
                            <div class="col-lg-12">
                                <br>
                                <div class="card-border mb-3 card card-body border-danger">
                                    <h5 class="card-title">Actividad del contrato <?php echo $fila->numero ?> </h5><?php echo $texto_actividad ?>
                                </div>
                                <table class="mb-0 table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="70%">Hechos</th>
                                            <!-- <th width="10%">Fecha</th> -->
                                            <th width="20%">Evidencias</th>
                                            <th width="10%">ID del Hecho</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //$sentencia = "select * from contratista INNER JOIN log on contratista.id_contratista=log.fk_id_contratista inner JOIN actividades on log.fk_id_actividad=actividades.id_actividad inner JOIN soportes on soportes.fk_id_log=log.id_log where contratista.fk_id_contrato = $id_contrato and actividades.id_actividad=$actividad ORDER BY log.fecha desc";
                                        $sentencia = "select * from contratista INNER JOIN log on contratista.id_contratista=log.fk_id_contratista inner JOIN actividades on log.fk_id_actividad=actividades.id_actividad where contratista.fk_id_contrato = $id_contrato and actividades.id_actividad=$actividad and log.fecha between '$fecha_inicio' AND '$fecha_fin' ORDER BY log.fecha desc";
                                        //echo $sentencia;
                                        $resultado = $conexion->query($sentencia);
                                        $numero_actividades = $resultado->num_rows;
                                        while ($fila = $resultado->fetch_object()) {
                                            echo '<tr>';
                                            echo '<td>' . $fila->hecho . '<br><b>Calificacion:</b> ';

                                            $estrellas_amarillas = $fila->calificacion;
                                            for ($i = 0; $i < $estrellas_amarillas; $i++) {
                                                echo '<span class="float-left"><i class="text-warning fa fa-star"></i></span>';
                                            }
                                            $estrellas_blancas = 5 - $estrellas_amarillas;
                                            for ($i = 0; $i < $estrellas_blancas; $i++) {
                                                echo '<span class="float-left"><i class="text-light fa fa-star"></i></span>';
                                            }

                                            echo $estrellas_amarillas;
                                            echo '</td>';

                                            // echo '<td>' . date_format(date_create($fila->fecha), 'Y-m-d') . '</td>';
                                            $sentencia_alt = "select * from soportes WHERE fk_id_log=$fila->id_log";
                                            $resultado_alt = $conexion->query($sentencia_alt);
                                            if (mysqli_num_rows($resultado_alt) > 0) {
                                                $fila_alt = $resultado_alt->fetch_object();
                                                echo '<td><a href="' . $fila_alt->ruta . '" target="blank" class="btn btn-success" style="margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px;"><i class="metismenu-icon pe-7s-note2"></i></a><a href="eliminar_log.php?id_log=' . base64_encode($fila->id_log) . '&id_contrato=' . base64_encode($id_contrato) . '" class="btn btn-danger" style="margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px;"><i class="metismenu-icon pe-7s-trash"></i></a><a href="editar_log_formulario.php?id_log=' . base64_encode($fila->id_log) . '&id_contrato=' . base64_encode($id_contrato) . '" class="btn btn-warning" style="margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px;"><i class="metismenu-icon pe-7s-pen"></i></a></td>';
                                            } else {
                                                echo '<td><a href="eliminar_log.php?id_log=' . base64_encode($fila->id_log) . '&id_contrato=' . base64_encode($id_contrato) . '" class="btn btn-danger" style="margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px;"><i class="metismenu-icon pe-7s-trash"></i></a><a href="editar_log_formulario.php?id_log=' . base64_encode($fila->id_log) . '&id_contrato=' . base64_encode($id_contrato) . '" class="btn btn-warning" style="margin-top: 5px; margin-bottom: 5px; margin-right: 5px; margin-left: 5px;"><i class="metismenu-icon pe-7s-pen"></i></a></td>';
                                            }
                                            echo '<td>' . $fila->id_log . '<td></tr>';
                                        }

                                        ?>
                                        <input type="hidden" name="texto_actividad" value="<?php echo $texto_actividad ?>">
                                    </tbody>
                                </table><br>
                                
                                <?php
                                if ($numero_actividades == 0) {
                                    echo '<p class="text-danger">No hay hechos para esta actividad</p>';
                                } else {
                                    echo '<p class="text-success">Estos son los hechos realizados sobre esta actividad</p>';
                                    
                                }
                                ?>
                                <div>
                                    <a href="ver_actividades.php?id_contrato=<?php echo base64_encode($id_contrato) ?>" class="btn btn-success">REGRESAR</a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>

</div>
</div>
<?php include("pie.php"); ?>