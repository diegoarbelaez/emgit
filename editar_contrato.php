<?php

include("conexion.php");


$id_contrato = base64_decode($_GET["id_contrato"]);
$sentencia = "SELECT * from contrato where id_contrato=$id_contrato";

$resultado = $conexion->query($sentencia);
$fila = $resultado->fetch_object();
$numero = $fila->numero;
setcookie('numCookie', $numero); // Ajuste para comparar y permitir el mismo contrato durante el proceso de  edición
$fecha_inicio = $fila->fecha_inicio;
$fecha_fin = $fila->fecha_fin;
$valor = $fila->valor;
$numero_cuotas = $fila->numero_cuotas;
$objeto = $fila->objeto;
$dependencia = $fila->fk_id_dependencia;
$indicador = $fila->indicador;
$indicador2 = $fila->indicador2;
$indicador3 = $fila->indicador3;
$supervisor1 = $fila->supervisor1;
$supervisor2 = $fila->supervisor2;
$supervisor3 = $fila->supervisor3;
$correo_supervisor_1 = $fila->correo_supervisor1;
$correo_supervisor_2 = $fila->correo_supervisor2;
$correo_supervisor_3 = $fila->correo_supervisor3;


$sentencia = "SELECT nombre from dependencia where id_dependencia = $dependencia";
$restulado = $conexion->query($sentencia);
$fila = $restulado->fetch_object();
$nombre_dependencia = $fila->nombre;

// Estos includes se bajaron para permitir la creación de la cookie numCookie
include("encabezado.php");
include("nav.php");
?>
<!-- Logica de inserción en la base de datos usando AJAX -->
<script src="actividades.js"></script>

<style>
    .suggestions {
        box-shadow: 2px 2px 8px 0 rgba(0, 0, 0, .2);
        height: auto;
        position: relative;
        top: 5px;
        z-index: 9999;
        width: 206px;
    }

    .suggestions .suggest-element {
        background-color: #EEEEEE;
        border-top: 1px solid #d6d4d4;
        cursor: pointer;
        padding: 8px;
        width: 100%;
        float: left;
    }
</style>

<script>
    $(document).ready(function() {
        $('#numero').keyup(function() {
            data = 'num=' + $(this).val();

            $.post('val_cont.php', data, function(respuesta) {
                if (respuesta >= 1) {
                    $('#info_num').hide().html('Ya existe!').fadeIn(100);
                    $('#enviar').prop('disabled', true);
                } else {
                    $('#info_num').hide();
                    $('#enviar').prop('disabled', false);
                }
            });
        });

        $('#codigo').mousemove(function() {
            if ($(this).val().length > 0) {
                data = 'codigo=' + $(this).val();

                $.post('val_cont.php', data, function(respuesta) {
                    if (respuesta == '0') {
                        $('#indicador').hide().html('Error cód.!').fadeIn(100);
                        $('#enviar').prop('disabled', true);
                    } else {
                        $('#indicador').hide();
                        $('#suggestions').hide();
                        $('#enviar').prop('disabled', false);
                    }
                });
            }
        });

        $('#codigo2').mousemove(function() {
            if ($(this).val().length > 0) {
                data = 'codigo=' + $(this).val();

                $.post('val_cont.php', data, function(respuesta) {
                    if (respuesta == '0') {
                        $('#indicador2').hide().html('Error cód.!').fadeIn(100);
                        $('#enviar').prop('disabled', true);
                    } else {
                        $('#indicador2').hide();
                        $('#suggestions2').hide();
                        $('#enviar').prop('disabled', false);
                    }
                });
            }
        });

        $('#codigo3').mousemove(function() {
            if ($(this).val().length > 0) {
                data = 'codigo=' + $(this).val();

                $.post('val_cont.php', data, function(respuesta) {
                    if (respuesta == '0') {
                        $('#indicador3').hide().html('Error cód.!').fadeIn(100);
                        $('#enviar').prop('disabled', true);
                    } else {
                        $('#indicador3').hide();
                        $('#suggestions3').hide();
                        $('#enviar').prop('disabled', false);
                    }
                });
            }
        });
    });
</script>

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
                        <h5 class="card-title">Contrato</h5>
                        <form action="actualizar_edicion_contrato.php" method="POST">
                            <table class="mb-0 table table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row"><b>Número</b> <span style="color:red" id="info_num"></span></th>
                                        <input type="hidden" name="id_contrato" value="<?php echo $id_contrato ?>">
                                        <td><input type="text" class="form-control" id="numero" name="numero" value="<?php echo $numero; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Fecha de Inicio</b></th>
                                        <td><input type="date" class="form-control" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Supervisor 1 Contrato</b></th>
                                        <td><input type="text" class="form-control" name="supervisor_1" value="<?php echo $supervisor1; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Correo Supervisor 1</b></th>
                                        <td><input type="email" class="form-control" name="correo_supervisor_1" value="<?php echo $correo_supervisor_1; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Supervisor 2 Contrato</b></th>
                                        <td><input type="text" class="form-control" name="supervisor_2" value="<?php echo $supervisor2; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Correo Supervisor 2</b></th>
                                        <td><input type="email" class="form-control" name="correo_supervisor_2" value="<?php echo $correo_supervisor_2; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Supervisor 3 Contrato</b></th>
                                        <td><input type="text" class="form-control" name="supervisor_3" value="<?php echo $supervisor3; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Correo Supervisor 3</b></th>
                                        <td><input type="email" class="form-control" name="correo_supervisor_3" value="<?php echo $correo_supervisor_3; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Fecha de Finalización</b></th>
                                        <td><input type="date" class="form-control" name="fecha_fin" value="<?php echo $fecha_fin; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Valor</b></th>
                                        <td><input type="text" class="form-control" name="valor" value="<?php echo $valor; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Número de Cuotas</b></th>
                                        <td><input type="number" class="form-control" name="numero_cuotas" value="<?php echo $numero_cuotas; ?>"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Objeto</b></th>
                                        <td><textarea type="text" class="form-control" name="objeto" rows="10"><?php echo $objeto; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Indicador</b> <span style="color:red" id="indicador"></span></th>
                                        <td>
                                            <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple</label>
                                                <input type="text" class="form-control" name="codigo" id="codigo" value="<?php echo $indicador; ?>" placeholder="Digite el código...." required>
                                                <div class="suggestions" id="suggestions"></div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Indicador 2</b> <span style="color:red" id="indicador2"></span></th>
                                        <td>
                                            <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple</label>
                                                <input type="text" class="form-control" name="codigo2" id="codigo2" value="<?php echo $indicador2; ?>" placeholder="Digite el código....">
                                                <div class="suggestions" id="suggestions2"></div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><b>Indicador 3</b> <span style="color:red" id="indicador3"></span></th>
                                        <td>
                                            <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple</label>
                                                <input type="text" class="form-control" name="codigo3" id="codigo3" value="<?php echo $indicador3; ?>" placeholder="Digite el código....">
                                                <div class="suggestions" id="suggestions3"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <input name="enviar" id="enviar" class="btn btn-primary btn-lg btn-block text-seder" type="submit" value="ACTUALIZAR CONTRATO">
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
<script>
    $(document).ready(function() {
        $('#codigo').on('keyup', function() {
            var key = $(this).val();
            var dataString = 'codigo=' + key;
            $.ajax({
                type: "POST",
                url: "busqueda_codigo.php",
                data: dataString,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestions').fadeIn(1000).html(data);
                    console.log(data);
                    //Al hacer click en alguna de las sugerencias
                    $('.suggest-element').on('click', function() {
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#codigo').val($('#' + id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions').fadeOut(1000);
                        alert('Has seleccionado el Codigo ' + $('#' + id).attr('data'));
                        return false;
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#codigo2').on('keyup', function() {
            var key = $(this).val();
            var dataString = 'codigo=' + key;
            $.ajax({
                type: "POST",
                url: "busqueda_codigo.php",
                data: dataString,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestions2').fadeIn(1000).html(data);
                    console.log(data);
                    //Al hacer click en alguna de las sugerencias
                    $('.suggest-element').on('click', function() {
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#codigo2').val($('#' + id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions2').fadeOut(1000);
                        alert('Has seleccionado el Codigo ' + $('#' + id).attr('data'));
                        return false;
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#codigo3').on('keyup', function() {
            var key = $(this).val();
            var dataString = 'codigo=' + key;
            $.ajax({
                type: "POST",
                url: "busqueda_codigo.php",
                data: dataString,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#suggestions3').fadeIn(1000).html(data);
                    console.log(data);
                    //Al hacer click en alguna de las sugerencias
                    $('.suggest-element').on('click', function() {
                        //Obtenemos la id unica de la sugerencia pulsada
                        var id = $(this).attr('id');
                        //Editamos el valor del input con data de la sugerencia pulsada
                        $('#codigo3').val($('#' + id).attr('data'));
                        //Hacemos desaparecer el resto de sugerencias
                        $('#suggestions3').fadeOut(1000);
                        alert('Has seleccionado el Codigo ' + $('#' + id).attr('data'));
                        return false;
                    });
                }
            });
        });
    });
</script>