<?php

include("conexion.php");

?>
<!-- Logica de inserción en la base de datos usando AJAX -->
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;

    }
</style>


<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div><h1>Reporte de Contratistas Activos</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Información Detallada</h5>
                        <table class="tabla_reporte" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th width="10%">Nombres</th>
                                    <th width="10%">Teléfono</th>
                                    <th>Dependencia</th>
                                    <th>Edad</th>
                                    <th>Barrio</th>
                                    <th width="5%">Fecha Inicio Contrato</th>
                                    <th width="5%">Fecha Final Contrato</th>
                                    <th>Valor Contrato</th>
                                    <th width="20%">Observaciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sentencia = "SELECT contratista.nombres,contratista.apellidos, contratista.telefono, contratista.barrio, dependencia.nombre as nombre_dependencia, contratista.usuario, contratista.fecha_nacimiento, contratista.foto, contrato.fecha_inicio, contrato.fecha_fin, contrato.valor from contratista INNER JOIN dependencia on dependencia.id_dependencia=contratista.fk_id_dependencia INNER JOIN contrato on contratista.fk_id_contrato=contrato.id_contrato where contratista.activado=1 order by nombre_dependencia asc";
                                $resultado = mysqli_query($conexion, $sentencia);
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                ?>
                                    <tr>
                                        <td><?php echo "<img src='" . $fila['foto'] . "' width='400'> " ?></td>
                                        <td><?php echo $fila["nombres"] . " " . $fila["apellidos"] ?></td>
                                        <td><?php echo $fila["telefono"] ?></td>
                                        <td><?php echo $fila["nombre_dependencia"] ?></td>
                                        <td><?php

                                            $date = new DateTime($fila["fecha_nacimiento"]);
                                            $now = new DateTime();
                                            $interval = $now->diff($date);
                                            echo $interval->y . " años";

                                            //echo $fila["fecha_nacimiento"]

                                            ?></td>
                                        <td><?php echo $fila["barrio"] ?></td>
                                        <td><?php echo $fila["fecha_inicio"] ?></td>
                                        <td><?php echo $fila["fecha_fin"] ?></td>
                                        <td><?php echo "$" . number_format($fila["valor"]) ?></td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>