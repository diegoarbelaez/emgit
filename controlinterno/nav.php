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
    <div class="scrollbar-sidebar" style="background-color: #78C3FB">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">SUPER USUARIO</li>
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
                        Todos los Contratistas
                    </a>
                </li>
                <li>
                    <a href="contenedor_gestionar_contratos.php">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Todos los Contratos
                    </a>
                </li>
                <!-- <li class="app-sidebar__heading">ADMINISTRAR</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        CONTRATACIÓN
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
                        <li>
                            <a href="contenedor_gestionar_contratistas.php">
                                <i class="metismenu-icon">
                                </i>Gestionar Contratistas
                            </a>
                        </li>


                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>