<?php include("conexion.php"); ?>
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
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
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading"><a href="index.php"><i class="metismenu-icon pe-7s-home"></i>INICIO</a></li>
                <li class="app-sidebar__heading">MIS CONTRATOS</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-share"></i>
                        <?php
                        $usuario = $_SESSION['user'];
                        $id_contratista = $_SESSION['id_contratista'];
                        //var_dump($_SESSION);
                        $sentencia = "select contrato.numero,contrato.id_contrato from contratista inner join contrato on contratista.fk_id_contrato=contrato.id_contrato where id_contratista =$id_contratista";
                        $resultado = $conexion->query($sentencia);
                        $fila = $resultado->fetch_object();
                        echo $fila->numero;
                        ?>
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="reporteador.php?id_contrato=<?php echo base64_encode($fila->id_contrato) ?>">
                                <i class="metismenu-icon"></i>
                                Agregar Hecho
                            </a>
                        </li>
                        <li>
                            <a href="ver_actividades.php?id_contrato=<?php echo base64_encode($fila->id_contrato) ?>">
                                <i class="metismenu-icon">
                                </i>Ver Actividades
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="app-sidebar__heading">MI PERFIL</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Contratistas
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="contenedor_agregar_contratista.php">
                                <i class="metismenu-icon"></i>
                                Agregar Contratistas
                            </a>
                        </li>
                        <li>
                            <a href="contenedor_agregar_contrato.php">
                                <i class="metismenu-icon">
                                </i>Agregar Contratos
                            </a>
                        </li>
                        <li>
                            <a href="contenedor_gestionar_contratos.php">
                                <i class="metismenu-icon">
                                </i>Gestionar Contratos
                            </a>
                        </li>

                    </ul>
                </li> -->
                
                    <li class="app-sidebar__heading">GENERAR INFORME</li>
                <a href="seleccionar_fechas_contratista.php?id_contratista=<?php echo base64_encode($id_contratista) ?>">
                    Seleccionar Fechas
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                </ul>
        </div>
    </div>
</div>