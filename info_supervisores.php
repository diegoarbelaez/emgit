<?php include("conexion.php") ?>
<?php
//Traigo la información del usuario
$usuario = $_SESSION["user"];
//$usuario = 'jsebas';
$sentencia = "select * from administradores INNER JOIN dependencia on dependencia.id_dependencia=administradores.fk_id_dependencia where administradores.usuario='$usuario'";
$resultado = mysqli_query($conexion, $sentencia);
$fila = mysqli_fetch_object($resultado);
$dependencia = $fila->nombre;
$fk_id_dependencia = $_SESSION["id_dependencia"];
?>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-monitor icon-gradient bg-mean-fruit"> </i>
                    </div>
                    <div>Atención! debes actualizar los contratos
                        <div class="page-title-subheading">Algunos contratos de <?php echo $dependencia ?> no tienen la información actualizada
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-12">
                <div class="card mb-3 widget-content bg-love-kiss">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Contratos que no tienen toda la información actualizada</div>
                            <div class="widget-subheading">Los rubros presupuestales no están bien ingresados, pronto no podrás generar informes de supervisión si no actualizas los contratos  <br>Debes editarlos, agregar los rubros presupuestales adecuados <br> <b>A PARTIR DEL 15 DE AGOSTO NO SE PODRÁN GENERAR INFORMES DE SUPERVISIÓN SOBRE CONTRATOS NO ACTUALIZADOS</b> </div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white">
                                <span>
                                     <?php
                                     $sentencia2 = "SELECT count(*) as total FROM `contrato` inner join contratista on contratista.fk_id_contrato = contrato.id_contrato where contrato.activo=1 and indicador not in (select codigo from codigos) and contrato.fk_id_dependencia = $fk_id_dependencia";
                                     $resultado2 = mysqli_query($conexion, $sentencia2);
                                     $fila2 = mysqli_fetch_object($resultado2);
                                     echo $fila2->total;
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Listado de Contratos sin rubros presupuestales
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="active btn btn-focus">DEBES ACTUALIZAR ESTOS CONTRATOS</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Número de Contrato</th>
                                    <th class="text-center">Contratista</th>
                                    <th class="text-center">Objeto</th>
                                    <th class="text-center">Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sentencia2 = "SELECT * FROM `contrato` inner join contratista on contratista.fk_id_contrato = contrato.id_contrato where contrato.activo=1 and indicador not in (select codigo from codigos) and contrato.fk_id_dependencia = $fk_id_dependencia";
                                $resultado2 = mysqli_query($conexion, $sentencia2);
                                $i = 1;
                                while ($fila2 = mysqli_fetch_object($resultado2)) {
                                ?>
                                    <tr>
                                        <td class="text-center text-muted"><?php echo $i ?></td>
                                        <td>
                                            <a href="editar_contrato.php?id_contrato=<?php echo base64_encode($fila2->id_contrato) ?>"><?php echo $fila2->numero ?></a>
                                        </div>
                                        </td>
                    <td class="text-center"><?php echo $fila2->nombres . " ". $fila2->apellidos; ?></td>
                    <td class="text-center">
                        <?php echo $fila2->objeto ?>
                    </td>
                    <td class="text-center">
                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">
                        <?php echo "$".number_format($fila2->valor) ?>
                        </button>
                    </td>
                    </tr>
                <?php
                                    $i++;
                                }
                ?>

                </tbody>
                </table>
                </div>

            </div>
            <a href="index_dashboard.php" class="btn btn-success">CONTINUAR AL DASHBOARD</a>
        </div>
    </div>
   </div>
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>

<?php include("pie.php"); ?>
</div>