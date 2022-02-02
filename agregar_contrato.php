<?php include("conexion.php"); ?>

<script>
    $(document).ready(function() {
        $('#numero4').keyup(function() {
            data = 'numadd=' + $('#numero1').val() + '-' + $('#numero2').val() + '-' + $('#numero3').val() + '-' + $('#numero4').val();

            $.post('val_cont.php', data, function(respuesta) {
                if (respuesta >= 1) {
                    $('#info_num').hide().html('Contrato existente!').fadeIn(100);
                } else {
                    $('#info_num').hide();
                }
            });
        });

        $('#codigo').mousemove(function() {
            if ($(this).val().length > 0) {
                data = 'codigo=' + $(this).val();

                $.post('val_cont.php', data, function(respuesta) {
                    if (respuesta == '0') {
                        $('#indicador').hide().html('Error en código!').fadeIn(100);
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
                        $('#indicador2').hide().html('Error en código!').fadeIn(100);
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
                        $('#indicador3').hide().html('Error en código!').fadeIn(100);
                        $('#enviar').prop('disabled', true);
                    } else {
                        $('#indicador3').hide();
                        $('#suggestions3').hide();
                        $('#enviar').prop('disabled', false);
                    }
                });
            }
        });

        $('#enviar').click(function() {
            data = 'numadd=' + $('#numero1').val() + '-' + $('#numero2').val() + '-' + $('#numero3').val() + '-' + $('#numero4').val();

            $.post('val_cont.php', data, function(respuesta) {
                if (respuesta == '1') {
                    $('#info_num').hide().html('Contrato existente!').fadeIn(100);
                    $('#enviar').prop('disabled', true);
                } else {
                    $('#info_num').hide();
                    $('#enviar').prop('disabled', false);
                }
            });
        });
    });
</script>

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

    <style>form .error {
        color: #ff0000;
    }

    .texto_alerta {
        color: red;
        font-weight: bold;
    }
</style>
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
                    <div class="progress-bar progress-bar-animated bg-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
                </div>

            </div>
        </div>
        <!-- Fila que contiene la información de la página -->
        <div class="row">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Información sobre el contrato</h5>
                        <form id="formulario" class="" action="paso3_guardar_actividad.php" method="POST">
                            <fieldset>
                                <label for="Numero" class="">Número del contrato <span class="texto_alerta" id="info_num"></span></label>
                                <div class="form-row">
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <input name="numero_serie1" id="numero1" type="text" class="form-control" value="203" max="999" readonly>
                                        </div>
                                    </div>
                                    <p style="text-emphasis: 35px; margin-top: 9px; margin-bottom:0px;"> - </p>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <input name="numero_serie2" id="numero2" value="13" type="text" class="form-control" max="99" readonly>
                                        </div>
                                    </div>
                                    <p style="text-emphasis: 35px; margin-top: 9px; margin-bottom:0px;"> - </p>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <input name="numero_serie3" id="numero3" type="number" min="1" max="99" class="form-control" required>
                                        </div>
                                    </div>
                                    <p style="text-emphasis: 35px; margin-top: 9px; margin-bottom:0px;"> - </p>
                                    <div class="col-md-2">
                                        <div class="position-relative form-group">
                                            <input name="numero_serie4" id="numero4" type="number" min="1" max="999" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative form-group"><label for="Nombre" class="">Nombre</label><input name="nombre" id="nombre" placeholder="Nombre del Contrato" type="text" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="FechaInicio" class="">Fecha Inicio</label><input name="fecha_inicio" id="fecha_inicio" type="date" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="FechaFin" class="">Fecha Fin</label><input name="fecha_fin" id="fecha_fin" type="date" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="Objeto" class="">Objeto del Contrato</label><input name="objeto" id="objeto" placeholder="Objeto del Contrato" type="text" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="Objeto" class="">Supervisor 1 del Contrato</label><input name="supervisor1" id="supervisor" placeholder="Supervisor 1del Contrato" type="text" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="Objeto" class="">Correo Supervisor 1</label><input name="correo_supervisor_1" id="supervisor" placeholder="@" type="text" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="Objeto" class="">Supervisor 2 del Contrato</label><input name="supervisor2" id="supervisor" placeholder="Supervisor del Contrato" type="text" class="form-control"></div>
                                <div class="position-relative form-group"><label for="Objeto" class="">Correo Supervisor 2</label><input name="correo_supervisor_2" id="supervisor" placeholder="@" type="text" class="form-control"></div>
                                <div class="position-relative form-group"><label for="Objeto" class="">Supervisor 3 del Contrato</label><input name="supervisor3" id="supervisor" placeholder="Supervisor del Contrato" type="text" class="form-control"></div>
                                <div class="position-relative form-group"><label for="Objeto" class="">Correo Supervisor 3</label><input name="correo_supervisor_3" id="supervisor" placeholder="@" type="text" class="form-control"></div>
                                <div class="position-relative form-group"><label for="Valor" class="">Valor</label><input name="valor" id="valor" placeholder="valor" type="number" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="NumeroCuotas" class="">Valor</label><input name="numero_cuotas" id="numero_cuotas" placeholder="Numero de Cuotas" type="number" class="form-control" required></div>
                                <div class="position-relative form-group"><label for="Dependencia" class="">Dependencia</label>
                                    <select name="dependencia" id="dependencia" class="form-control" required>
                                        <?php
                                        //Solo puedo agregar contratos para mi dependencia
                                        $id_dependencia = $_SESSION["id_dependencia"];


                                        $sentencia = "SELECT * FROM dependencia where id_dependencia=$id_dependencia order by id_dependencia desc";
                                        // echo $sentencia;
                                        $resultado = $conexion->query($sentencia);
                                        if ($resultado) {
                                            while ($fila = $resultado->fetch_object()) {
                                                echo '<option value=' . $fila->id_dependencia . '>' . $fila->nombre . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple <span id="indicador" class="texto_alerta"></span></label>
                                    <p id="alerta1" style="display: none;">(OJO) No se cumple</p>
                                    <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Digite el código...." required>
                                    <div class="suggestions" id="suggestions"></div>


                                </div>
                                <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple <span id="indicador2" class="texto_alerta"></span></label>
                                    <input type="text" class="form-control" name="codigo2" id="codigo2" placeholder="Digite el código....">
                                    <div class="suggestions" id="suggestions2"></div>


                                </div>
                                <div class="position-relative form-group"><label for="indicador" class="">Indicador que se Cumple <span id="indicador3" class="texto_alerta"></span></label>
                                    <input type="text" class="form-control" name="codigo3" id="codigo3" placeholder="Digite el código....">
                                    <div class="suggestions" id="suggestions3"></div>


                                </div>
                                <button type="submit" id="enviar" class="mt-1 btn btn-primary" disabled="true">SIGUIENTE -> AGREGAR ACTIVIDADES</button>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("pie.php"); ?>
</div>
<script>
    /* $(document).ready(function() {
        $(function() {
            // Initialize form validation on the registration form.
            // It has the name attribute "registration"
            $("#formulario").validate({
                // Specify validation rules
                rules: {
                    codigo: {
                        required: true,
                        remote: {
                            url: "validar_codigo.php",
                            type: "post",
                            data: {
                                username: function() {
                                    return $("#codigo").val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    // Specify validation error messages
                    codigo: "Codigo Inválido o Vacío, por favor verificar"
                    // Make sure the form is submitted to the destination defined
                    // in the "action" attribute of the form when valid
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    });*/
</script>
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

        $('#codigo').on('keyup', function() {
            //e.preventDefault();
            var codigo_validar = $("#codigo").val();
            $.ajax({
                type: "POST",
                url: "validar_codigo.php",
                data: "codigo=" + codigo_validar,
                success: function(data) {
                    //$("#enviar").prop('disabled',true);
                    console.log("recibido -> " + data)
                    if (data) {
                        $("#enviar").prop('disabled', false);
                    } else {
                        $("#enviar").prop('disabled', true);
                    }

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