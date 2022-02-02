<?php

include("conexion.php");
include("encabezado.php");
include("nav.php");

$numero = $_POST["numero"];
$nombre = $_POST["nombre"];
$fecha_inicio = $_POST["fecha_inicio"];
$fecha_fin = $_POST["fecha_fin"];
$objeto = $_POST["objeto"];
$valor = $_POST["valor"];
$dependencia = $_POST["dependencia"];


$sentencia = "INSERT INTO `contrato`(`numero`, `nombre`, `fecha_inicio`, `fecha_fin`, `objeto`, `valor`, `fk_id_dependencia`) VALUES ('$numero','$nombre','$fecha_inicio','$fecha_fin','$objeto',$valor,$dependencia)";
if ($conexion->query($sentencia) === TRUE) {
  //echo "Agregado correctamente a la BD";
  $fk_id_contrato = $conexion->insert_id;
} else {
  echo "Error: " . $sentencia . "<br>" . $conexion->error;
}


?>

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
                  <td><?php echo $valor; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Objeto</b></th>
                  <td><?php echo $objeto; ?></td>
                </tr>
                <tr>
                  <th scope="row"><b>Dependencia</b></th>
                  <td><?php echo $dependencia; ?></td>
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
            <form class="" action="paso3_guardar_actividad.php" method="POST">
              <div class="position-relative form-group"><label for="exampleText" class="">Describa la Actividad</label><textarea name="actividad" id="actividad" class="form-control"></textarea></div>
              <input type="hidden" name="fk_id_contrato" value="<?php echo $fk_id_contrato ?>">
              <button class="mt-1 btn btn-primary">AGREGAR ESTA ACTIVIDAD</button>
            </form>
          </div>
          <div class="card-body">
            <h5 class="card-title">ACTIVIDADES GUARDADAS</h5>
            <table class="mb-0 table table-bordered">
              <tbody>
                <tr>
                  <?php
                  $sentencia = "SELECT * FROM actividades where fk_id_contrato = $fk_id_contrato order by fk_id_contrato desc";
                  //echo $sentencia;
                  $resultado = $conexion->query($sentencia);
                  if ($resultado) {
                    while ($fila = $resultado->fetch_object()) { ?>
                      <td><?php echo $descripcion; ?></td>
                  <?php
                    }
                  }
                  $conexion->close();
                  ?>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
  <?php include("pie.php"); ?>
</div>