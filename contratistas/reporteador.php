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


$id_contrato =  base64_decode($_GET["id_contrato"]);
$sentencia = "SELECT * from contrato where id_contrato=$id_contrato";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();


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
                    <div>Agregar Acciones o Eventos
                        <div class="page-title-subheading">Reportar una acción para la actividad de un contrato
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
                        <h5 class="card-title">Información sobre la actividad</h5>
                        <br>
                        Recuerda argumentar bien los hechos para que tengan 5 estrellas <i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i>
                        <p></p>
                        <p><b>Su número del contrato es: </b><br><?php echo $fila->numero ?></p>
                        <p><b>Objeto del contrato: </b><br><?php echo $fila->objeto ?></p>
                        <form class="" id="postForm" action="registrar_reporte_actividad2.php" method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
                            <fieldset>
                                <div class="position-relative form-group"><label for="Dependencia" class="">Seleccione la actividad del contrato sobre la cual va a reportar el hecho:</label>
                                    <select name="actividad" id="actividad" class="form-control">
                                        <?php
                                        $sentencia2 = "SELECT * FROM actividades WHERE fk_id_contrato=$id_contrato";
                                        $resultado2 = $conexion->query($sentencia2);
                                        if ($resultado2) {
                                            while ($fila2 = $resultado2->fetch_object()) {
                                                echo '<option value="' . $fila2->id_actividad . '">' . $fila2->descripcion . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="ck-editor__editable ck-editor__editable_inline"><label for="exampleText" class="">Describa la acción realizada sobre esta actividad</label>
                                    <textarea id="editor" name="log" rows="10"></textarea>
                                </div>
                                <br>
                                <!-- temporal, para activar la opción de que los contratistas reporten en diferente fecha -->
                                <div class="card-border mb-3 card card-body border-danger">
                                    <div>
                                        <label>Fecha de Realización del Hecho - TEMPORALMENTE ACTIVADO</label>
                                        <input type="date" name="fecha_reporte" class="form-control" placeholder="" value="" required>
                                    </div>
                                </div>
                                <!-- temporal -->
                                <div class="position-relative form-group"><label for="exampleFile" class="">Evidencias</label>
                                    <input name="foto" id="foto" type="file" class="form-control-file">
                                    <small class="form-text text-muted">El archivo debe ser inferior a 5MB</small>
                                </div>
                                <br>
                                <button class="mt-1 btn btn-primary">GUARDAR INFORMACIÓN</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
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
                .create(document.querySelector('#editor'), {
                    language: 'es'
                })
                .catch(error => {
                    console.error(error);
                });
            CKEDITOR.replace('editor', {
                width: '70%',
                height: 500
            });
        </script>
        
        <!-- <script>
            CKEDITOR.replace('editor', {
                width: '70%',
                height: 400
            });
        </script> -->
        <?php include("pie.php"); ?>
    </div>
</div>