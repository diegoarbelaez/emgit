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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    

</head>

<body>
    <?php
    include("conexion.php");
    ?>
    <?php
    $usuario = $_SESSION['user'];
    $id_contratista = $_SESSION['id_contratista'];
    //var_dump($_SESSION);
    $sentencia2 = "select contrato.numero,contrato.id_contrato from contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato where id_contratista =$id_contratista";
    $resultado2 = $conexion->query($sentencia2);
    $fila2 = $resultado2->fetch_object();
    $id_contrato_encabezado = $fila2->id_contrato;
    ?>

    <!-- jquery -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="jquery-3.5.1.min.js"></script>
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!--bootstrap -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Libreria Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

        <!-- TABLAS DE BOOTSTRAP -->
    <!-- Estas son las librerias para que funcione -->
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> -->
    <script src="jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous" defer></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous" defer></script>









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
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow bg-danger header-text-light">
            <div class="app-header__logo">
                <div class="logo-src">
                </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <!-- UTILIDADES DE BUSQUEDA, PERFIL, ESTADISTICAS, QUE LUEGO SE USARÁN -->
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <!-- <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div> -->
                        <button class="close"></button>
                    </div>
                    <ul class="header-menu nav">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-link-icon fa fa-home"> </i>
                                Dashboard
                            </a>
                        </li>
                        <li class="btn-group nav-item">
                            <a href="reporteador.php?id_contrato=<?php echo base64_encode($id_contrato_encabezado) ?>" class="nav-link">
                                <i class="nav-link-icon fa fa-edit"></i>
                                Agregar Hecho
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <?php
                                            $id_contratista = $_SESSION["id_contratista"];
                                            $sentencia = "SELECT * FROM contratista inner join dependencia on contratista.fk_id_dependencia=dependencia.id_dependencia where id_contratista=$id_contratista";
                                            $resultado = $conexion->query($sentencia);
                                            $fila = $resultado->fetch_object();
                                            $foto = $fila->foto;
                                            $nombres = $fila->nombres;
                                            $dependencia = $fila->nombre;
                                            //$foto = "foto pala.png"
                                            ?>
                                            <img width="42" class="rounded-circle" src="../<?php echo $foto ?>" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <a href="mi_cuenta.php?id_contratista=<?php echo $id_contratista ?>" class="dropdown-item">Mi Cuenta</a>
                                            <a href="logout.php" class="dropdown-item">Cerrar Sesion</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php echo $nombres ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?php echo $dependencia ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">