<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");


$numero_serie1 = $_POST["numero_serie1"];
$numero_serie2 = $_POST["numero_serie2"];
$numero_serie3 = $_POST["numero_serie3"];
$numero_serie4 = $_POST["numero_serie4"];
$numero = $numero_serie1 . "-" . $numero_serie2 . "-" . $numero_serie3 . "-" . $numero_serie4;
$nombre = $_POST["nombre"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$objeto = $_POST["objeto"];
$supervisor1 = $_POST["supervisor1"];
$supervisor2 = $_POST["supervisor2"];
$supervisor3 = $_POST["supervisor3"];
$correo_supervisor_1 = $_POST["correo_supervisor_1"];
$correo_supervisor_2 = $_POST["correo_supervisor_2"];
$correo_supervisor_3 = $_POST["correo_supervisor_3"];
$valor = $_POST["valor"];
$numero_cuotas = $_POST["numero_cuotas"];
$dependencia = $_POST["dependencia"];
$indicador = $_POST["codigo"];
$indicador2 = $_POST["codigo2"];
$indicador3 = $_POST["codigo3"];


$sentencia = "INSERT INTO `contrato`(`numero`, `nombre`, `fecha_inicio`, `fecha_fin`, `objeto`, `supervisor1`,`correo_supervisor1`, `supervisor2`,`correo_supervisor2`, `supervisor3`,`correo_supervisor3`, `valor`,`numero_cuotas`, `fk_id_dependencia`,`indicador`,`indicador2`,`indicador3` ) VALUES ('$numero','$nombre','$fecha_inicio','$fecha_fin','$objeto','$supervisor1','$correo_supervisor_1','$supervisor2','$correo_supervisor_2','$supervisor3','$correo_supervisor_3',$valor,$numero_cuotas,$dependencia,'$indicador','$indicador2','$indicador3')";
if ($conexion->query($sentencia) === TRUE) {
  //echo "Agregado correctamente a la BD";
  $fk_id_contrato = $conexion->insert_id;
} else {
  echo "Error: " . $sentencia . "<br>" . $conexion->error;
}

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
          <div>Agregar Contrato
            <div class="page-title-subheading">Cargar la información de un contrato nuevo
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-card mb-3 card">
      <div class="card-body">
        <h5 class="card-title">Proceso de Creación de Contrato</h5>

        <div class="mb-3 progress">
          <div class="progress-bar progress-bar-animated bg-info progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
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
                  <th scope="row"><b>Valor</b></th>
                  <td><?php echo "$" . number_format($valor); ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Numero de Cuotas</b></th>
                  <td><?php echo $numero_cuotas; ?></td>
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
                  <th scope="row"><b>Indicador</b></th>
                  <td><?php echo $indicador; ?></td>
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
              <input type="hidden" name="fk_id_contrato" id="fk_id_contrato" value="<?php echo $fk_id_contrato ?>">
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
            <a href="contenedor_gestionar_contratos.php" name="enviar" id="enviar" class="btn btn-success btn-lg btn-block text-seder">TERMINAR CREACIÓN</a>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php include("pie.php"); ?>
</div>