<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$cedula = $_POST["cedula"];
$fk_id_contrato = 9999; // Contrato por defecto que se agrega a un contratista, que se modifica en la creación del contratista, como es una FK no puedo crear el contratista sin ese campo
$fk_id_dependencia = $_POST["fk_id_dependencia"];
$fecha_expedicion = $_POST["fecha_expedicion"];
$fecha_nacimiento = $_POST["fecha_nacimiento"];
$sexo = $_POST["sexo"];
$grupo_sanguineo = $_POST["grupo_sanguineo"];
$direccion_residencia = $_POST["direccion_residencia"];
$tipo_vivienda = $_POST["tipo_vivienda"];
$zona_ubicacion = $_POST["zona_ubicacion"];
$descripcion_ubicacion = $_POST["descripcion_ubicacion"];
$nombre_corregimiento = $_POST["nombre_corregimiento"];
$barrio = $_POST["barrio"];
$estrato = $_POST["estrato"];
$departamento = $_POST["departamento"];
$municipio = $_POST["municipio"];
$telefono = $_POST["telefono"];
$telefono_emergencias = $_POST["telefono_emergencias"];
$estado_civil = $_POST["estado_civil"];
$sentencia = "insert into contratista (
    cedula,
    nombres,
    apellidos,
    telefono,
    fk_id_dependencia,
    fk_id_contrato,
    fecha_expedicion,
    fecha_nacimiento,
    sexo,
    grupo_sanguineo,
    direccion_residencia,
    tipo_vivienda,
    barrio,
    estrato,
    telefono_emergencias,
    estado_civil,
    departamento,
    municipio,
    nombre_corregimiento,
    descripcion_ubicacion,
    tipo
    ) values (
        $cedula,
        '$nombres',
        '$apellidos',
        '$telefono',
        $fk_id_dependencia,
        $fk_id_contrato,
        '$fecha_expedicion',
        '$fecha_nacimiento',
        '$sexo',
        '$grupo_sanguineo',
        '$direccion_residencia',
        '$tipo_vivienda',
        '$barrio',
         $estrato,
        '$telefono_emergencias',
        '$estado_civil',
        '$departamento',
        '$municipio',
        '$nombre_corregimiento',
        '$descripcion_ubicacion',
        1
        )";
//echo $sentencia;
if ($conexion->query($sentencia) === TRUE) {
    //echo "Agregado correctamente a la BD";
    //header("Location:registro_guardado.php");
    $id_contratista = $conexion->insert_id;
} else {
    echo "Error: " . $sentencia . "<br>" . $conexion->error;
}
$conexion->close();
?>
<style type="text/css">
    #registration_form fieldset:not(:first-of-type) {
        display: none;
    }
</style>
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Agregar Contratista
                        <div class="page-title-subheading">Cargar la información de un contratista nuevo
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" style="width: 40%" aria-valuenow="40" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <form class="" id="registration_form" novalidate action="agregar_contratista_paso3.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <fieldset>
                                <h5 class="card-title">DATOS FAMILIARES (CÓNYUGE, PADRES E HIJOS): ID Contratista -><?php echo $id_contratista ?></h5>
                                <label for="Nombres" class="">Sí eres casado o casada por favor complete el formulario de datos del
                                    cónyuge. Si no tienes cónyuge continuar con el diligenciamiento de los
                                    datos como Padres.
                                </label>
                                <br>
                                <br>
                                <hr>
                                <label for="Nombres" class=""><b>CONYUGUE</b>
                                </label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                            <input name="nombres_conyugue" id="nombres" placeholder="Nombres" type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                            <input name="apellidos_conyugue" id="apellidos" placeholder="Apellidos" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Cédula</label>
                                            <input name="cedula_conyugue" id="cedula_conyugue" min="1" pattern="^[0-9]+" placeholder="Cédula" type="number" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                            <input name="fecha_nacimiento_conyugue" id="cedula" min="1" pattern="^[0-9]+" placeholder="Cédula" type="date" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <hr>
                                <label for="Nombres" class=""><b>PADRE</b>
                                </label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                            <input name="nombres_padre" id="nombres" placeholder="Nombres" type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                            <input name="apellidos_padre" id="apellidos" placeholder="Apellidos" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Cédula</label>
                                            <input name="cedula_padre" id="cedula_padre" min="1" pattern="^[0-9]+" placeholder="Cédula" type="number" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                            <input name="fecha_nacimiento_padre" id="cedula" min="1" pattern="^[0-9]+" placeholder="Cédula" type="date" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <hr>
                                <label for="Nombres" class=""><b>MADRE</b>
                                </label>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Nombres" class="">Nombre</label>
                                            <input name="nombres_madre" id="nombres" placeholder="Nombres" type="text" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Apellidos" class="">Apellidos</label>
                                            <input name="apellidos_madre" id="apellidos" placeholder="Apellidos" type="text" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Cédula</label>
                                            <input name="cedula_madre" id="cedula_madre" min="1" pattern="^[0-9]+" placeholder="Cédula" type="number" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="Cedula" class="">Fecha de Nacimiento</label>
                                            <input name="fecha_nacimiento_madre" id="cedula" min="1" pattern="^[0-9]+" placeholder="Cédula" type="date" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="id_contratista" value="<?php echo $id_contratista ?>">

                                <hr>
                                <input type="submit" name="next" class="next btn btn-info" value="SIGUIENTE - INFORMACIÓN DE HIJOS" />
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php include("pie.php"); ?>
</div>