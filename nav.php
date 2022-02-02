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

    <div class="scrollbar-sidebar" style="background-color: #6c757d8c;">
        <div class="app-sidebar__inner">
            <div>
                <img src="images/logo_encabezado.png" width="100%" style="padding-top: 20px; padding-bottom: 20px; ">
            </div>
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">MENÚ PRINCIPAL</li>
                <!-- <li>
                    <a href="contenedor_gestionar_contratistas.php">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Contratistas
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <?php
                        $id_dependencia = $_SESSION["id_dependencia"];
                        // Ver contratistas de la dependencia del administrador
                        /* Codigo para mostrar las fotos de los contratistas en el menu
                        


                        $sentencia = "SELECT * FROM contratista where activado = 1 and fk_id_dependencia = $id_dependencia order by id_contratista desc";
                        $resultado = $conexion->query($sentencia);
                        if ($resultado) {
                            while ($fila = $resultado->fetch_object()) { ?>
                                <li>
                                    <a href="informacion_contratista.php?id_contratista=<?php echo $fila->id_contratista ?>">
                                        <img width="30" class="rounded-circle" src="<?php echo $fila->foto; ?>" alt="">
                                        <?php echo $fila->nombres ?>
                                    </a>
                                </li>
                        <?php
                            }
                        }*/
                        ?>
                    </ul>
                </li> -->
                <li>
                    <a href="contenedor_gestionar_contratistas.php">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Contratistas
                    </a>
                </li>
                <li>
                    <a href="contenedor_gestionar_contratos.php">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Contratos
                    </a>
                </li>
                <li class="app-sidebar__heading">ADMINISTRAR</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        CONTRATACIÓN
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="agregar_contratista_seleccion_tipo.php">
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
                        <li>
                            <a href="contenedor_gestionar_contratistas.php">
                                <i class="metismenu-icon">
                                </i>Gestionar Contratistas
                            </a>
                        </li>
                        <li>
                            <a href="visor_detallado_contrato.php">
                                <i class="metismenu-icon">
                                </i>Visor detallado de Contrato
                            </a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        REPORTES SIA OBSERVA
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="listar_informes_siaobserva_contratista.php">
                                <i class="metismenu-icon"></i>
                                Reportes Contratistas
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <a href="listar_informes_siaobserva_supervisor.php">
                                <i class="metismenu-icon"></i>
                                Reportes Supervisores
                            </a>
                        </li>
                    </ul>
                </li>
                <?php
                if ($_SESSION['user'] == 'jariasduran@hotmail.com' || $_SESSION['user'] == 'informatica@candelaria-valle.gov.co') {
                ?>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-note2"></i>
                            ADMIN POWERS
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="editar_hecho.php">
                                    <i class="metismenu-icon"></i>
                                    Editar hechos
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="editar_rubro.php">
                                    <i class="metismenu-icon"></i>
                                    Editar Rubros
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="exportar_contratistas2.php">
                                    <i class="metismenu-icon"></i>
                                    Exportar Contratistas
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="eliminar_pago_porid.php">
                                    <i class="metismenu-icon"></i>
                                    Eliminar Pago por ID
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="eliminar_otrosi.php">
                                    <i class="metismenu-icon"></i>
                                    Eliminar Otrosí
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="reporte_hijos_contratistas.php">
                                    <i class="metismenu-icon"></i>
                                    Reporte Hijos Contratistas
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="reporte_powerbi.html">
                                    <i class="metismenu-icon"></i>
                                    Conexión Power BI
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a href="reporte_contratistas_activos.php">
                                    <i class="metismenu-icon"></i>
                                    Contratistas Activos
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>
                <?php
                if ($_SESSION['user'] == 'planeacion@candelaria-valle.gov.co' || $_SESSION['user'] == 'informatica@candelaria-valle.gov.co') {
                ?>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-note2"></i>
                            AVANCE PLAN DESARROLLO
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="avance_contratacion.php">
                                    <i class="metismenu-icon"></i>
                                    Ver Reporte
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>