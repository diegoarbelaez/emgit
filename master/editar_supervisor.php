<?php include("encabezado.php"); ?>
<?php include("nav.php"); ?>
<?php include("conexion.php"); ?>

<?php
$id = $_GET["id"];
$sentencia = "SELECT id,usuario,password,dependencia.nombre as dep FROM administradores inner join dependencia on administradores.fk_id_dependencia=dependencia.id_dependencia where id=$id";
$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
$id = $fila->id;
?>
<link href="estilos_timeline.css" rel="stylesheet">

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Editar Información del Supervisor
                        <div class="page-title-subheading">Información perteneciente a un Supervisor
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <form action="escribir_actualizacion_supervisor.php" method="POST">
                        <div class="card-body">
                            <h5 class="card-title">Información sobre el Supervisor</h5>
                            <div class="position-relative form-group"><label for="Nombres" class="">Nombre de Usuario (Correo)</label><input name="usuario" id="nombres" placeholder="Nombres" type="text" class="form-control" value="<?php echo $fila->usuario; ?>"></div>
                            <div class="position-relative form-group"><label for="Apellidos" class="">Contraseña</label><input name="password" id="password" placeholder="Apellidos" type="text" class="form-control" value="<?php echo $fila->password; ?>"></div>
                            <div class="position-relative form-group"><label for="NivelEducativo" class="">Dependencia</label>
                                <select name="fk_id_dependencia" id="nivel_educativo" class="form-control" required="true">
                                    <?php
                                    $sentencia_dep= "select * from dependencia";
                                    $resultado_dep = mysqli_query($conexion,$sentencia_dep);
                                    var_dump($resultado_dep);
                                    if($resultado_dep){
                                        while($fila_dep = mysqli_fetch_assoc($resultado_dep)){
                                            echo '<option value="'.$fila_dep["id_dependencia"].'">'.$fila_dep["nombre"].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button type="submit" class="mt-1 btn btn-primary">ACTUALIZAR SUPERVISOR</button>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>