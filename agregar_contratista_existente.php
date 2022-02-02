<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
?>
<style type="text/css">
    #registration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
        $('#cedula').keyup(function() {
            if ($(this).val().length > 0) {
                data = 'cedula=' + $(this).val();

                $.post('val_cont.php', data, function(respuesta) {
                    if (respuesta == '0') {
                        $('#info_cedula').hide();
                        $('#enviar').prop('disabled', false);
                    } else {
                        $('#info_cedula').hide().html(' ya existe!').fadeIn(100);
                        $('#enviar').prop('disabled', true);
                    }
                });
            }
        });
    });
</script>



<?php
$cedula = base64_decode($_GET["cedula"]);
$sentencia_busqueda = "select * from contratista_2021 where cedula = $cedula and activado=1";


$resultado = mysqli_query($conexion, $sentencia_busqueda);
$fila_contratista = mysqli_fetch_assoc($resultado);
$id_contratista  = $fila_contratista["id_contratista"];

//var_dump($fila_contratista);

//echo $fila_contratista["cedula"];

?>
<script type="text/javascript" src="js/cargar_municipios_departamentos.js"></script>


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Agregar Contratista
                        <div class="page-title-subheading">Se han encontrato datos de este contratista
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" style="width: 25%" aria-valuenow="25" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <form class="" id="registration_form" action="copiar_contratista_2021a2022.php" method="POST">
            <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <fieldset>
                                <h5 class="card-title" style="color:red">PARA ESTE CONTRATISTA SE ENCONTRARON DATOS, A CONTINUACIÓN APARECEN LOS DATOS ALMACENADOS PREVIAMENTE</h5>
                                <br>
                                <h5 class="card-title">POR FAVOR CONFIRMA QUE ESTE ES EL CONTRATISTA QUE INTENTAS CREAR</h5>

                                <p>
                                    <br>
                                    <img width="80" class="rounded-circle" style="margin-left: 15px;" src="<?php echo $fila_contratista["foto"] ?>" alt="">
                                    <br>(Foto del Contratista)
                                    <br>
                                    <br>
                                    <b>Nombre: </b><?php echo $fila_contratista["nombres"] ?><br>
                                    <b>Apellidos: </b><?php echo $fila_contratista["apellidos"] ?><br>
                                    <b>No. Cédula: </b><?php echo $fila_contratista["cedula"] ?><br>
                                    <b>Teléfono: </b><?php echo $fila_contratista["telefono"] ?><br>
                                    <b>Barrio: </b><?php echo $fila_contratista["barrio"] ?><br>
                                    <br>
                                </p>

                                <div class="position-relative form-group"><label for="NivelEducativo" class="">Dependencia a la que se va a asignar</label>
                                    <select name="fk_id_dependencia" id="fk_id_dependencia" class="form-control" required="true">
                                        <?php
                                        $sentencia = "SELECT * FROM dependencia where id_dependencia = $id_dependencia order by id_dependencia desc";
                                        $resultado = $conexion->query($sentencia);
                                        if ($resultado) {
                                            while ($fila = $resultado->fetch_object()) {
                                                echo '<option value=' . $fila->id_dependencia . '>' . $fila->nombre . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <p style="color:red">Si requiere cambio de dependencia del contratista, debe comunicarse con el Adminsitrador del Sistema</p>
                                </div>
                                


                            </fieldset>
                            <br>
                            <input id="enviar" type="submit" class="next btn btn-info" value="CREAR CONTRATISTA CON INFORMACIÓN ALMACENADA PREVIAMENTE" />
                            <a href="agregar_contratista_buscar.php" class="btn btn-danger">REGRESAR </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("pie.php"); ?>
</div>