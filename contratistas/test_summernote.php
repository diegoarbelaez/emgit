<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistema de Gestión de Actividades - Contratistas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="./main.css" rel="stylesheet">




    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>

<body>


    <!-- jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!--bootstrap -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->







    <!-- MODALES QUE SE UTILIZAN EN LA PAGINA Y SE DEBEN PONER EN EL HEADER PARA QUE SE MUESTREN ADECUADAMENTE -->
    <!-- MODAL DE CONFIRMACIÓN DE ELIMINACION DE CONTRATO, USADO EN gestionar_contratos.php -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                    <p id="registro"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DEL MODAL DE ELIMINACION DE CONTRATOS -->



    <div class="app-main">



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


                <!-- Fila que contiene la información de la página -->
                <div class="row mb-3 card">
                    <div class="mb-3 ">
                        <div class="main-card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Información sobre la actividad</h5>
                                <br>
                                Recuerda argumentar bien los hechos para que tengan 5 estrellas <i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i><i class="text-warning fa fa-star"></i>
                                <p></p>

                                <form class="" id="postForm" action="registrar_reporte_actividad.php" method="POST" enctype="multipart/form-data" onsubmit="return postForm()">
                                    <fieldset>

                                        <div class="position-relative form-group"><label for="exampleText" class="">Describa la acción realizada sobre esta actividad</label>
                                            <textarea id="summernote" name="log"></textarea>
                                        </div>
                                        <br>
                                        <div class="position-relative form-group"><label for="exampleFile" class="">Evidencias</label>
                                            <input name="foto" id="foto" type="file" class="form-control-file" required="true">
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
                    $(document).ready(function() {
                        $('#summernote').summernote();
                    });
                </script>
                <?php include("pie.php"); ?>
            </div>
        </div>