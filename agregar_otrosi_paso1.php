<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>

<?php
$id_contrato = base64_decode($_GET["id_contrato"]);
$sentencia = "SELECT * FROM contrato where id_contrato=$id_contrato";
//echo $sentencia;
$resultado = mysqli_query($conexion,$sentencia);
$fila = mysqli_fetch_assoc($resultado);

?>
<link href="estilos_timeline.css" rel="stylesheet">
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Agregar Otrosí al contrato
                        <div class="page-title-subheading">Proceso de extensión en tiempo y dinero de un contrato
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        //Se hace la validación para que el contrato esté en saldo $0 antes de agrear un OtroSi y que no existan otrosi para este contrato
        $sentencia_saldos = "select * from pagos where fk_id_contrato=$id_contrato order by id_pago desc limit 1"; //busca la última cuota pagada para ver si tiene saldo $0
        $restultado_saldos = mysqli_query($conexion, $sentencia_saldos);
        $fila_saldos = mysqli_fetch_assoc($restultado_saldos);
        $ultimo_saldo = $fila_saldos["saldo"];
        //if ($ultimo_saldo == 0 && $fila["otrosi"] == 0) { //Esto lo hacía para validar que el último saldo fuera $0, pero como ahora se puede crear un otrosi con cuotas pendientes, entonces no valido el saldo
        if ($fila["otrosi"] == 0) {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="tracking">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Por favor complete la información para agregara el Otrosí al contrato</h5>
                                <div>
                                    <form action="agregar_otrosi_paso2.php" method="POST">
                                        <table>
                                            <tr>
                                            <td style="padding-right: 22px">
                                                    <div>
                                                        <label>Numero del Otrosí</label>
                                                        <input type="text" name="numero" id="fecha_inicio" class="form-control" placeholder="" value="" required="true">
                                                </td>
                                                <td style="padding-right: 22px">
                                                    <div>
                                                        <label>Fecha de Inicio</label>
                                                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" placeholder="" value="" required="true">
                                                </td>
                                                <td>
                                                    <div>
                                                        <label>Fecha de Finalizacion</label>
                                                        <input type="date" name="fecha_fin" id="fecha" class="form-control" placeholder="" value="" required="true">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label>Cantidad de Cuotas</label>
                                                        <input type="number" name="cuotas_otrosi" id="fecha" class="form-control" placeholder="" value="" required="true">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label>Valor del Otrosí</label>
                                                        <input type="number" name="monto_otrosi" id="fecha" class="form-control" placeholder="" value="" required="true">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <label></label><br>
                                                        <input type="hidden" name="id_contrato" value="<?php echo $id_contrato ?>">
                                                        <button class="btn btn-success" style="margin-left: 12px; margin-top: 7px;">Crear Otrosí</button>
                                                    </div>
                                                </td>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } // Fin if
        else {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div id="tracking">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Este Otrosí no puede ser generado</h5>
                                <div>
                                    <div class="alert alert-danger fade show" role="alert">A este contrato no puede generársele un Otrosí, dado que ya tiene un Otrosí Generado
                                    </div>
                                    <a href="visualizar_contrato.php?id_contrato=<?php echo base64_encode($id_contrato) ?>" class="mb-2 mr-2 btn btn-danger"">REGRESAR</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- Fila que contiene la información de la página -->
        <?php include("pie.php"); ?>
    </div>