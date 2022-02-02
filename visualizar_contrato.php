<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

$id_contrato = base64_decode($_GET["id_contrato"]);
$sentencia = "SELECT * from contrato where id_contrato=$id_contrato";

$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
$numero = $fila->numero;
$fecha_inicio = $fila->fecha_inicio;
$fecha_fin = $fila->fecha_fin;
$valor = $fila->valor;
$objeto = $fila->objeto;
$dependencia = $fila->fk_id_dependencia;
$indicador = $fila->indicador;
$indicador2 = $fila->indicador2;
$indicador3 = $fila->indicador3;
$numero_cuotas = $fila->numero_cuotas;
$supervisor1 = $fila->supervisor1;
$supervisor2 = $fila->supervisor2;
$supervisor3 = $fila->supervisor3;
$correo_supervisor_1 = $fila->correo_supervisor1;
$correo_supervisor_2 = $fila->correo_supervisor2;
$correo_supervisor_3 = $fila->correo_supervisor3;
$otrosi_contrato = $fila->otrosi;


$sentencia = "SELECT nombre from dependencia where id_dependencia = $dependencia";
$restulado = $conexion->query($sentencia);
$fila = $restulado->fetch_object();
$nombre_dependencia = $fila->nombre;


?>
<!-- Logica de inserción en la base de datos usando AJAX -->
<script src="actividades.js"></script>


<div class="app-main__outer">
  <div class="app-main__inner">
    <div class="app-page-title">
      <div class="page-title-wrapper">
        <div class="page-title-heading">
          <div class="page-title-icon">
            <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
            </i>
          </div>
          <div>Editar Contrato
            <div class="page-title-subheading">Modificar la información de un contrato
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fila que contiene la información de la página -->
    <div class="row">
      <div class="col-md-6">
        <div class="main-card mb-3 card">
          <div class="card-body">
            <h5 class="card-title">Contrato --- <a href="editar_contrato.php?id_contrato=<?php echo base64_encode($id_contrato) ?>"><i class="fas fa-edit">EDITAR</i></a></h5>
            <table class="mb-0 table table-bordered">
              <tbody>
                <tr>
                  <th scope="row"><b>Número</b></th>
                  <td><?php echo $numero; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Fecha de Inicio</b></th>
                  <td><?php echo $fecha_inicio; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Fecha de Finalización</b></th>
                  <td><?php echo $fecha_fin; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Valor</b></th>
                  <td><?php echo "$" . number_format($valor); ?></td>
                </tr>
                <tr>
                <tr>
                  <th scope="row"><b>Numero de Cuotas</b></th>
                  <td><?php echo $numero_cuotas ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Supervisor 1</b></th>
                  <td><?php echo $supervisor1; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Correo Supervisor 1</b></th>
                  <td><?php echo $correo_supervisor_1; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Supervisor 2</b></th>
                  <td><?php echo $supervisor2; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Correo Supervisor 2</b></th>
                  <td><?php echo $correo_supervisor_2; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Supervisor 3</b></th>
                  <td><?php echo $supervisor3; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Correo Supervisor 3</b></th>
                  <td><?php echo $correo_supervisor_3; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Objeto</b></th>
                  <td><?php echo $objeto; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Dependencia</b></th>
                  <td><?php echo $nombre_dependencia; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Indicador 1</b></th>
                  <td><?php echo "Indicador ->" . $indicador . "<br>";
                      $sentencia_bpin = "select * from codigos_bpin where rubro like '%$indicador%'";
                      $resultado_bpin = mysqli_query($conexion, $sentencia_bpin);
                      $fila_bpin = mysqli_fetch_assoc($resultado_bpin);
                      //echo $sentencia_bpin;
                      echo $fila_bpin["codigo_bpin"] . "<br>";
                      echo $fila_bpin["nombre"];

                      ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Indicador 2</b></th>
                  <td><?php echo $indicador2; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Indicador 3</b></th>
                  <td><?php echo $indicador3; ?></td>
                </tr>
              </tbody>
            </table>
            <br>
            <?php
            if ($otrosi_contrato == 0) {
            ?>
              <div class="mb-2 mr-2 badge badge-danger">NUEVO</div>
              <br>
              Si el contrato requiere una prorroga, que extiende el plazo de ejecución y el monto, puedes agregar un OtroSí haciendo click en el siguiente Botón<br><br>
              <a href="agregar_otrosi_paso1.php?id_contrato=<?php echo base64_encode($id_contrato) ?>" name="enviar" id="enviar" class="btn btn-secondary btn-lg btn-block text-seder">GENERAR OTROSI AL CONTRATO</a>
            <?php
            } else {
            ?>
              <div>
                <p><b>ESTE CONTRATO TIENE UN OTROSI GENERADO CON LOS SIGUIENTES DATOS:</b>
                  <?php

                  $sentencia_consulta_otrosi = "select * from otrosi where fk_id_contrato=$id_contrato";
                  $resultado_consulta_otrosi = mysqli_query($conexion, $sentencia_consulta_otrosi);
                  $fila_otrosi = mysqli_fetch_assoc($resultado_consulta_otrosi);

                  ?>
                <table class="table-bordered" width="70%">
                  <tr>
                    <td width="40%"><b>Fecha Inicio: </b></td>
                    <td><?php echo $fila_otrosi["fecha_inicio"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Fecha Finalización: </b></td>
                    <td><?php echo $fila_otrosi["fecha_fin"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Número de Cuotas </b></td>
                    <td><?php echo $fila_otrosi["cuotas_otrosi"]; ?></td>
                  </tr>
                  <tr>
                    <td><b>Valor del Otrosí:</b></td>
                    <td><?php echo "$" . number_format($fila_otrosi["monto_otrosi"]); ?></td>
                  </tr>
                </table>
                <br>
              </div>

            <?php
            }
            ?>
          </div>

        </div>
      </div>
      <div class="col-md-6">
        <div class="main-card mb-3 card">
          <div class="card-body">
            <h5 class="card-title">Actividades del contrato</h5>
            <form action="" id="task-form">
              <div class="position-relative form-group"><label for="exampleText" class="">Describa la Actividad</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
              </div>
              <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">
              <!--  <button class="mt-1 btn btn-primary">AGREGAR ESTA ACTIVIDAD</button> -->
              <input name="enviar" id="enviar" class="btn btn-primary btn-lg btn-block text-seder" type="submit" value="Guardar Actividad">
            </form>
          </div>
          <div class="card-body">
            <h5 class="card-title">ACTIVIDADES GUARDADAS</h5>
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <td width="10%">
                    <center>ID Act.</center>
                  </td>
                  <td>
                    <center>Descripcion</center>
                  </td>
                  <td width="10%">
                    <center>Acción</center>
                  </td>
                </tr>
              </thead>
              <tbody id="actividades">
              </tbody>
            </table>
            <a href="contenedor_gestionar_contratos.php" name="enviar" id="enviar" class="btn btn-success btn-lg btn-block text-seder">TERMINAR EDICIÓN</a>
          </div>

        </div>
      </div>
      <div class="col-md-6">
        <div class="main-card mb-3 card">
          <div class="card-body">
            <h5 class="card-title">Pagos del contrato</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-sm">
              <thead>
                <td>
                  <center><b>ID Pago</b></center>
                </td>
                <td>
                  <center><b>Fecha de Pago</b></center>
                </td>
                <td>
                  <center><b>Valor Bruto</b></center>
                </td>
                <td>
                  <center><b>Descuentos</b></center>
                </td>
                <td>
                  <center><b>Valor Neto Pagado</b></center>
                </td>
                <td>
                  <center><b>Saldo</b></center>
                </td>
              </thead>
              <?php
              $sentencia_pagos = "select * from pagos where fk_id_contrato=$id_contrato order by id_pago asc";
              $resultado_pagos = mysqli_query($conexion, $sentencia_pagos);
              while ($fila_pagos = mysqli_fetch_assoc($resultado_pagos)) {
              ?>
                <tr>
                  <td><?php echo $fila_pagos["id_pago"]; ?></td>
                  <td><?php echo $fila_pagos["fecha_pago"]; ?></td>
                  <td><?php echo "$" . number_format($fila_pagos["valor_bruto"]); ?></td>
                  <td><?php echo "$" . number_format($fila_pagos["descuentos"]); ?></td>
                  <td><?php echo "$" . number_format($fila_pagos["valor_neto"]); ?></td>
                  <td><?php echo "$" . number_format($fila_pagos["saldo"]); ?></td>
                </tr>
              <?php
              }
              ?>
            </table>
            <form action="pre2_informe_supervision.php" method="POST">
              <input type="hidden" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha_inicio ?>">
              <input type="hidden" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha_fin ?>">
              <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">
              <input type="hidden" name="id_contratista" id="id_contratista" value="<?php echo $id_contratista ?>">
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php include("pie.php"); ?>
</div>