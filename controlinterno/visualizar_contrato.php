<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

$id_contrato = $_GET["id_contrato"];
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
$correo_supervisor_1 = $fila->correo_supervisor1;
$correo_supervisor_2 = $fila->correo_supervisor2;

$sentencia = "SELECT nombre from dependencia where id_dependencia = $dependencia";
$restulado = $conexion->query($sentencia);
$fila = $restulado->fetch_object();
$nombre_dependencia = $fila->nombre;

$sentencia_contratista = "select * from contratista where fk_id_contrato=$id_contrato";
$resultado_contratista = mysqli_query($conexion,$sentencia_contratista);
$fila_contratista = mysqli_fetch_object($resultado_contratista);


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
          <div>Visualizar Contrato
            <div class="page-title-subheading">Ver información sobre un contrato
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
            <h5 class="card-title">Contrato</h5>
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
                  <th scope="row"><b>Contratista</b></th>
                  <td><a href="informacion_contratista.php?id_contratista=<?php echo $fila_contratista->id_contratista ?>"><?php echo $fila_contratista->nombres. " ".$fila_contratista->apellidos ?></a></td>
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
                  <th scope="row"><b>Objeto</b></th>
                  <td><?php echo $objeto; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Dependencia</b></th>
                  <td><?php echo $nombre_dependencia; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Indicador 1</b></th>
                  <td><?php
                      $sentencia_codigo = "select * from codigos where codigo = '$indicador'";
                      $resultado_codigo = mysqli_query($conexion, $sentencia_codigo);
                      $fila_codigo = mysqli_fetch_assoc($resultado_codigo);
                      $descripcion_codigo = $fila_codigo["descripcion"];
                      echo "<b>" . $indicador . "</b><br><br>" . $descripcion_codigo;
                      ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Indicador 2</b></th>
                  <td><?php
                      $sentencia_codigo = "select * from codigos where codigo = '$indicador2'";
                      $resultado_codigo = mysqli_query($conexion, $sentencia_codigo);
                      $fila_codigo = mysqli_fetch_assoc($resultado_codigo);
                      $descripcion_codigo = $fila_codigo["descripcion"];
                      echo "<b>" . $indicador2 . "</b><br><br>" . $descripcion_codigo;
                      ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Indicador 3</b></th>
                  <td><?php
                      $sentencia_codigo = "select * from codigos where codigo = '$indicador3'";
                      $resultado_codigo = mysqli_query($conexion, $sentencia_codigo);
                      $fila_codigo = mysqli_fetch_assoc($resultado_codigo);
                      $descripcion_codigo = $fila_codigo["descripcion"];
                      echo "<b>" . $indicador3 . "</b><br><br>" . $descripcion_codigo;
                      ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="main-card mb-3 card">
          <div class="card-body">
            <h5 class="card-title">Actividades del contrato</h5>
            <form action="" id="task-form">
              <div class="position-relative form-group">
                <!-- <textarea name="descripcion" id="descripcion" class="form-control" required></textarea> -->
              </div>
              <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $id_contrato ?>">
              <!-- <button class="mt-1 btn btn-primary">AGREGAR ESTA ACTIVIDAD</button> -->
              <!-- <input name="enviar" id="enviar" class="btn btn-primary btn-lg btn-block text-seder" type="submit" value="Guardar Actividad"> -->
            </form>
          </div>
          <div class="card-body">
            <!-- <h5 class="card-title">ACTIVIDADES GUARDADAS</h5> -->
            <table class="table table-bordered table-sm">
              <thead>
                <tr>
                  <td width="10%">
                    <center>ID Act.</center>
                  </td>
                  <td>
                    <center>Descripcion</center>
                  </td>
                  <!-- <td width="10%">
                    <center>Acción</center>
                  </td> -->
                </tr>
              </thead>
              <tbody id="actividades">
              </tbody>
            </table>
            <!-- <a href="contenedor_gestionar_contratos.php" name="enviar" id="enviar" class="btn btn-success btn-lg btn-block text-seder">TERMINAR EDICIÓN</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("pie.php"); ?>
</div>