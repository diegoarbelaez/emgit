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
$id_contratista = base64_decode($_GET["id_contratista"]);
//var_dump($_SESSION);
/*$sentencia = "SELECT * from contrato where fk_id_contratista = $id_contratista";
echo $sentencia;
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object(); */
?>

<script>
    $(document).ready(function() {
        validar();

        function validar() {
            data = 'id_contratista=' + <?php echo $id_contratista ?>;

            $.post('../val_cont.php', data, function(respuesta) {
                if (respuesta.length > 0) {
                    $('#info_validar').hide().html('<div class="main-card mb-3 card"><div class="card-body"><p><b>ATENCIÓN:</b><br> Hay datos que no has actualizado, <b>si no los completas tu cuenta será desactivada.</b> <br> A continuación se listan los datos que debes actualizar:</p>' + respuesta + '<br><p><a class="btn btn-warning" href="mi_cuenta.php?id_contratista=<?php echo $id_contratista ?>"> Ir a mi perfil para actualizar mis datos </a></p></div></div>').fadeIn(100);
                    //Si quitas estas condiciones, se vuelve obligatorio actualizar los datos
                    $('#fecha_inicio').prop('disabled', false);
                    $('#fecha_fin').prop('disabled', false);
                    $('#generar').prop('disabled', false);
                } else {
                    $('#fecha_inicio').prop('disabled', false);
                    $('#fecha_fin').prop('disabled', false);
                    $('#generar').prop('disabled', false);
                }
            });
        }
    });
</script>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Seleccione las Fechas para generar el informe
                        <div class="page-title-subheading">Generar Informe
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div id="tracking">
                <span style="color:red" id="info_validar"></span>
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Generación de Informes para contratistas</h5>
                        <div>
                            <!-- ESTE ES LA LINEA DE CODIGO A CAMBIAR PARA GENERAR REPORTE EN PDF O EN HTML -->
                            <!-- <form action="plantilla_reporte_candelaria.php" target="blank" method="POST"> -->
                            <form action="generador_reporte.php" target="blank" method="POST">
                                <table>
                                    <tr>
                                        <td style="padding-right: 22px">
                                            <div>
                                                <label>Fecha de Inicio</label>
                                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" disabled required placeholder="" value="">
                                                <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>" </div>
                                        </td>
                                        <td>
                                            <div>
                                                <label>Fecha de Finalizacion</label>
                                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" disabled required placeholder="" value="">
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <label></label><br>
                                                <button id="generar" class="btn btn-success" style="margin-left: 12px; margin-top: 7px;" disabled>Generar Informe de Contratista</button>
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
    <?php include("pie.php"); ?>
</div>