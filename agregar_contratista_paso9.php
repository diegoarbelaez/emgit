<?php include("conexion.php");
include("encabezado.php");
include("nav.php");
//crea el contratista con la información que llega
$fk_id_contrato = $_POST["fk_id_contrato"];
$id_contratista = $_POST["id_contratista"];

//$fk_id_contrato = 130;
//$id_contratista = 831;


$sentencia = "update contratista set 
    fk_id_contrato = $fk_id_contrato
    WHERE id_contratista=$id_contratista";

if ($conexion->query($sentencia) === TRUE) {
    //header("Location:registro_guardado.php");
} else {
    echo "Error: " . $sentencia . "<br>" . $conexion->error;
}

$sentencia_contratista = "select * from contratista where id_contratista = $id_contratista";
$resultado_contratista = mysqli_query($conexion, $sentencia_contratista);
$fila_contratista = mysqli_fetch_assoc($resultado_contratista);



?>
<script src="gestionHijos.js"></script>
<script src="cropie/jquery.min.js"></script>
<script src="cropie/bootstrap.min.js"></script>
<script src="cropie/croppie.js"></script>
<link rel="stylesheet" href="cropie/croppie.css" />
<style>
    .modal-backdrop {
        opacity: 0.5 !important;
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
                    <div>Agregar Contratista - ID <?php echo "id->" . $id_contratista ?>
                        <div class="page-title-subheading">Cargar la información de un contratista nuevo
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" style="width: 98%" aria-valuenow="98" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>
        <br>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">AGREGAR FOTO DEL CONTRATISTA Y ASIGNAR CREDENCIALES</h5>
                        <label for="Nombres" class="">Por favor subir una foto del contratista y asignar usuario y contraseña
                        </label>
                        <br>
                        <br>
                        <hr>
                        <label for="Nombres" class=""><b>POR FAVOR LLENE ESTA ÚLTIMA INFORMACIÓN</b>
                        <br>
                        <br>
                        Seleccione una foto del contratista
                        </label>
                        <div class="container">
                            <input type="file" name="upload_image" id="upload_image" required />
                            <br>
                            <br>
                            <div id="uploaded_image"></div>
                            <br>
                            <br>
                            <br>
                        </div>
                        <form action="guardar_informacion_final_contratista.php" method="POST">
                            <div class="position-relative form-group"><label for="coreo" class="">Usuario (correo)</label><input name="correo" id="correo" placeholder="correo electrónico" type="text" class="form-control" required="true"></div>
                            <div class="position-relative form-group"><label for="password" class="">Contraseña</label><input name="password" id="password" placeholder="contraseña" type="text" class="form-control" required="true"></div>
                            <input type="hidden" id="id_contratista" name="id_contratista" value="<?php echo $id_contratista ?>">
                            <input type="submit" name="next" class="next btn btn-success" value="TERMINAR CON LA CREACIÓN DEL CONTRATISTA" />
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
<div id="uploadimageModal" class="modal" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Imagen del Contratista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary crop_image">Guardar Imagen</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        //Crop
        console.log("cargó cropie desde paso9");

        //Cropie
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square' //circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload_image').on('change', function() {
            console.log("ejecutando...");
            var reader = new FileReader();
            reader.onload = function(event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });

        $('.crop_image').click(function(event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(response) {
                $.ajax({
                    url: "cargar_foto_contratista.php",
                    type: "POST",
                    data: {
                        "image": response,
                        "id_contratista": <?php echo $id_contratista ?>
                    },
                    success: function(data) {
                        $('#uploadimageModal').modal('hide');
                        $('#uploaded_image').html(data);
                    }
                });
            })
        }); 

    });
</script>
