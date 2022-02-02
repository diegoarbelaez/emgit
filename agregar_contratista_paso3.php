<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$id_contratista = $_POST["id_contratista"];
$nombres_conyugue = $_POST["nombres_conyugue"];
$apellidos_conyugue = $_POST["apellidos_conyugue"];
$cedula_conyugue = $_POST["cedula_conyugue"];
$fecha_nacimiento_conyugue = $_POST["fecha_nacimiento_conyugue"];
$nombres_padre = $_POST["nombres_padre"];
$apellidos_padre = $_POST["apellidos_padre"];
$cedula_padre = $_POST["cedula_padre"];
$fecha_nacimiento_padre = $_POST["fecha_nacimiento_padre"];
$nombres_madre = $_POST["nombres_madre"];
$apellidos_madre = $_POST["apellidos_madre"];
$cedula_madre = $_POST["cedula_madre"];
$fecha_nacimiento_madre = $_POST["fecha_nacimiento_madre"];
$sentencia = "update contratista set 
nombres_conyugue='$nombres_conyugue',
apellidos_conyugue='$apellidos_conyugue', 
cedula_conyugue='$cedula_conyugue', 
fecha_nacimiento_conyugue='$fecha_nacimiento_conyugue',
nombres_padre='$nombres_padre',
apellidos_padre='$apellidos_padre',
cedula_padre='$cedula_padre',
fecha_nacimiento_padre='$fecha_nacimiento_padre',
nombres_madre='$nombres_madre',
apellidos_madre='$apellidos_madre',
cedula_madre='$cedula_madre',
fecha_nacimiento_madre='$fecha_nacimiento_madre' 
WHERE id_contratista=$id_contratista";
if ($conexion->query($sentencia) === TRUE) {
    //echo "Agregado correctamente a la BD";
    //header("Location:registro_guardado.php");
    //$id_contratista = $conexion->insert_id;
} else {
    echo "Error: " . $sentencia . "<br>" . $conexion->error;
}
$conexion->close();
?>
<script src="gestionHijos.js"></script>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Agregar Contratista - ID <?php echo "id->".$id_contratista ?>
                        <div class="page-title-subheading">Cargar la información de un contratista nuevo
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" style="width: 65%" aria-valuenow="65" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">DATOS FAMILIARES (HIJOS):</h5>
                        <label for="Nombres" class="">Ingresa aquí la información de los hijos del contratista
                        </label>
                        <br>
                        <br>
                        <hr>
                        <label for="Nombres" class=""><b>HIJOS</b>
                        </label>
                        <form action="" id="pagos-form">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                        <input name="nombres_hijo" id="nombres_hijo" placeholder="Nombres" type="text" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                        <input name="apellidos_hijo" id="apellidos_hijo" placeholder="Apellidos" type="text" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Sexo</label>
                                        <select name="sexo" id="sexo" class="form-control" required="true">
                                            <option>HOMBRE</option>
                                            <option>MUJER</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group"><label for="NivelEducativo" class="">Tipo Documento</label>
                                        <select name="tipo_documento_hijo" id="tipo_documento_hijo" class="form-control" required="true">
                                            <option>CC</option>
                                            <option>TI</option>
                                            <option>RC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Numero Documento</label>
                                        <input name="numero_documento_hijo" id="numero_documento_hijo" min="1" pattern="^[0-9]+" placeholder="Cédula" type="number" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                        <input name="fecha_nacimiento_hijo" id="fecha_nacimiento_hijo" min="1" type="date" class="form-control" required="true">
                                    </div>
                                </div>
                                <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                            </div>
                            <input name="enviar" id="enviar" class="btn btn-primary btn-lg btn-block text-seder" type="submit" value="GUARDAR HIJO">
                        </form>
                        <br>
                        <br>
                        <label for="Cedula" class="">Hijos Registrados</label>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <td>
                                        <center>ID Hijo</center>
                                    </td>
                                    <td>
                                        <center>Nombres</center>
                                    </td>
                                    <td>
                                        <center>Apellidos</center>
                                    </td>
                                    <td>
                                        <center>Sexo</center>
                                    </td>
                                    <td>
                                        <center>Fecha de Nacimiento</center>
                                    </td>
                                    <td>
                                        <center>Tipo Documento</center>
                                    </td>
                                    <td>
                                        <center>Número de Documento</center>
                                    </td>
                                    <td>
                                        <center>Acciones</center>
                                    </td>
                                </tr>
                            </thead>
                            <tbody id="hijo">
                            </tbody>
                        </table>
                        <hr>
                        <form action="agregar_contratista_paso4.php" method="POST">
                            <input type="hidden" name="id_contratista" id="id_contratista" value="<?php echo $id_contratista ?>">
                            <input type="submit" name="enviar" id="enviar" class="btn btn-success btn-lg btn-block text-seder" value="SIGUIENTE - INFORMACIÓN ACADÉMICA">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>