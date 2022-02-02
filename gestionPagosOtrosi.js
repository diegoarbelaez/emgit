$(document).ready(function () {
    console.log("Jquery Funcionando");
    //$('#resultado-busqueda').hide();
    //listar_tareas();
    let editar = false;
    let fk_id_contrato = $('#fk_id_contrato').val();
    let fecha_pago = $('#fecha_pago').val();
    let valor_bruto = $('#valor_bruto').val();
    let descuentos = $('#descuentos').val();
    let valor_neto = $('#valor_neto').val();
    let saldo = $('#saldo').val();

    console.log(fk_id_contrato + " - " + fecha_pago + " - " + valor_bruto + " - " + descuentos + " - " + valor_neto + " - " + saldo);
    listar_tareas(fk_id_contrato);


    $('#pagos-form-otrosi').submit(function (e) { //valido la función submit del formulario para capturar el evento y poder manejar las conexiones
        const datosPost = { //Construye un array para enviar los datos por POST            
            fecha_pago:$('#fecha_pago').val(),
            valor_bruto:$('#valor_bruto').val(),
            descuentos:$('#descuentos').val(),
            valor_neto:$('#valor_neto').val(),
            saldo:$('#saldo').val(),
            fk_id_contrato
        };

        console.log(datosPost);
        //let url = editar === false ? 'task-add.php': 'task-edit.php';
        let url = 'pagos-otrosi-add.php';

        $.post(url, datosPost, function (respuesta) { // Sirve para enviar al servidor la petición, el objeto respuesta es la respuesta recibida por el servidor
            listar_tareas(fk_id_contrato);
            console.log(respuesta);
            $('#pagos-form-otrosi').trigger('reset');

        })
        // console.log(datosPost);
        e.preventDefault();
    });


    function listar_tareas(id_contrato) {
        const datosPost = { //Construye un array para enviar los datos por POST            
            id_contrato: id_contrato
        };
        let url = 'lista_pagos_otrosi.php';
        $.post(url, datosPost, function (respuesta) { // Sirve para enviar al servidor la petición, el objeto respuesta es la respuesta recibida por el servidor
            let tareas = JSON.parse(respuesta);
            console.log(respuesta);
            let template = '';
            tareas.forEach(tarea2 => {
                template += `<tr id_pago="${tarea2.id_pago}">
                            <td><center>${tarea2.id_pago}</center></td>
                            <td>${tarea2.fecha_pago}</td>
                            <td>${'$'+new Intl.NumberFormat("en-US").format(tarea2.valor_bruto)}</td>
                            <td>${'$'+new Intl.NumberFormat("en-US").format(tarea2.descuentos)}</td>
                            <td>${'$'+new Intl.NumberFormat("en-US").format(tarea2.valor_neto)}</td>
                            <td>${'$'+new Intl.NumberFormat("es-CO").format(tarea2.saldo)}</td>
                            <td><button class="eliminar-tarea btn btn-danger">Eliminar</button></td>
                        </tr>`
                        console.log("Valor agregado ->");
                        console.log(new Intl.NumberFormat("en-US").format(tarea2.valor_bruto));
            });
            $('#pagos_otrosi').html(template);
        })
    }



    $(document).on('click', '.eliminar-tarea', function () { //leer los eventos de click del documento (toda la pagina) filtrando los que se hagan sobre el elemento boton eliminar-tarea
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('id_pago');
        console.log("Elemento html ->" + elemento);
        console.log("id tarea capturado ->" + id);
        if (confirm("Está seguro que desea eliminar la tarea")) { //Ventana de alerta en Javascript para confirmación
            eliminar_tarea(id);
        }
    })


    $(document).on('click', '.task-item', function () {
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('id_tarea');
        //console.log(id);
        $.post('task-single.php', { id }, function (respuesta) {
            //console.log(respuesta);
            const task = JSON.parse(respuesta);
            //console.log(task);
            $('#tarea').val(task.nombre);
            $('#descripcion').val(task.descripcion);
            $('#id_tarea').val(task.id);
            editar = true;
            console.log(respuesta);
        })

    })

    function eliminar_tarea(id_tarea_eliminar) {
        console.log("Listo para eliminar la tarea -> " + id_tarea_eliminar)
        $.ajax({ // Objeto de Ajax que sirve para enviar y recibir datos de un servidor
            url: 'eliminar_pago_otrosi.php',
            type: 'POST',
            data: { id_tarea_eliminar },
            success: function (response) {
                console.log(response);
                listar_tareas(fk_id_contrato);
            }
        })


    }

});



