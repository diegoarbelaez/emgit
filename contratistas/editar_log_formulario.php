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

$id_log = base64_decode($_GET["id_log"]);
$id_contrato = base64_decode($_GET["id_contrato"]);

$sentencia = "select * from log where id_log=$id_log";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
$log = $fila->hecho;
$id_log = $fila->id_log;

?>
<style>
    .ck-editor__editable_inline {
        min-height: 400px;
    }
</style>

<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/translations/es.js"></script>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Editar Acciones o Eventos
                        <div class="page-title-subheading">Editar un hecho - Permite editar algo que ya subiste
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 

        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-bicycle icon-gradient bg-love-kiss"> </i>
                    Tips para reportar acciones <br>sobre las actividades de un contrato
                </div>
                <ul class="nav">
                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg5-0" class="nav-link show">Tip 1</a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg5-1" class="nav-link show">Tip 2</a></li>
                    <li class="nav-item"><a data-toggle="tab" href="#tab-eg5-2" class="nav-link show active">Tip 3</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show" id="tab-eg5-0" role="tabpanel">
                        <p>Los contratos que realizas con entidades del estado son financiados con recursos públicos, es por esta razón que los entes de control como la Contraloria, Procuraduría y Fiscalía revisan la ejecución de los contratos y es necesario tener las evidencias que demuestren la gestión pública bien lograda. Por esta razón debes siempre generar las evidencias de los procesos que realizas</p>
                    </div>
                    <div class="tab-pane show" id="tab-eg5-1" role="tabpanel">
                        <p>No dejes para fin de mes el reporte de los hechos sobre las actividades del contrato, si día a día alimentas la plataforma MegaReporte, al final del mes todo estará consolidado y no tendrás que gastar tiempo y esfuerzo extra realizando informes que son aburridores y dejan escapar muchas evidencias de eventos que realizaste. </p>
                    </div>
                    <div class="tab-pane show active" id="tab-eg5-2" role="tabpanel">
                        <p>Los reportes son calificados por el <b>SUPERVISOR DEL CONTRATO</b> con estrellas de 1 a 5. Un reporte bien sustentado tiene 5 estrellas <i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i>, un reporte regular o deficiente en sus evidencias, tendrá tan solo una estrella <i class="text-warning fa fa-star"></i>. Es necesario soportar las evidencias de las actividades que tienes a cargo, sube fotos, archivos, comenta lo que día a día haces para que al final de mes todo esté consolidado en la plataforma. Así logramos que la gestión pública esté bien soportada en hechos que sean verificables y los supervisores de tu contrato no tengan que exigirte trabajo adicional. </p>
                    </div>
                </div>
            </div>

        </div>

        -->


        <!-- Fila que contiene la información de la página -->
        <div class="row mb-3 card">
            <div class="mb-3 ">
                <div class="main-card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Editar un hecho que ya subiste</h5>
                        <br>
                        Recuerda argumentar bien los hechos para que tengan 5 estrellas <i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i>
                        <p></p>
                        <form class="" id="postForm" action="escribir_edicion_log.php" method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
                            <fieldset>

                                <div class="position-relative form-group"><label for="exampleText" class="">Describa la acción realizada sobre esta actividad</label>
                                    <textarea id="editor" name="log" rows="15"><?php echo $log ?></textarea>
                                    <input type="hidden" name="id_log" value="<?php echo $id_log ?>">
                                </div>
                                <br>
                                <?php
                                $sentencia_ruta = "select * from soportes where fk_id_log=$id_log";
                                $resultado_ruta = mysqli_query($conexion, $sentencia_ruta);
                                $fila_alt = mysqli_fetch_assoc($resultado_ruta);
                                $ruta_soporte = $fila_alt["ruta"];
                                /*$resultado_ruta = $conexion->query($sentencia_ruta);
                                $fila_alt=$resultado->fetch_object();                               var_dump($fila_alt);*/
                                if (!empty($ruta_soporte)) {
                                    echo '<b>Archivo Cargado: </b>' . $fila_alt["ruta"];
                                    echo '<br>';
                                } else {
                                    echo 'Archivo Cargado: Ninguno';
                                }

                                ?>

                                <?php echo '<a href="' . $ruta_soporte . '" target="blank" class="btn btn-success" style="margin-top: 5px; margin-bottom: 5px; margin-right: 5px;">Ver Evidencias Cargadas</a>' ?>

                                <br>
                                <br>
                                <input name="foto" id="foto" type="file" class="form-control-file">
                                <small class="form-text text-muted">Haz click aquí si quieres reemplazar o adicionar un archivo</small>
                                <br>
                                <br>
                                <button class="mt-1 btn btn-primary">GUARDAR INFORMACIÓN</button>
                                <br>
                                <br>
                                <div>
                                    <a href="ver_actividades.php?id_contrato=<?php echo base64_encode($id_contrato) ?>" class="btn btn-danger">REGRESAR Y NO GUARDAR</a>
                                </div>
                    </div>

                    </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>

</div>
<script>
    ClassicEditor.defaultConfig = {
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'insertTable',
                '|',
                'undo',
                'redo'
            ]
        },
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        },
        language: 'es'
    };
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>

</html>
</div>
</div>