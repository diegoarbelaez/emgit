$(document).ready(function () {
    console.log("Jquery Funcionando");
    //$('#resultado-busqueda').hide();
    //listar_tareas();
    let editar = false;
    let fk_id_contrato = $('#fk_id_contrato').val();
    listar_tareas(fk_id_contrato);


    $('#task-form').submit(function (e) { //valido la función submit del formulario para capturar el evento y poder manejar las conexiones
        const datosPost = { //Construye un array para enviar los datos por POST            
            descripcion: $('#descripcion').val(),
            fk_id_contrato
        };

        //let url = editar === false ? 'task-add.php': 'task-edit.php';
        let url = 'task-add.php';
        
        console.log(url);

        $.post(url, datosPost, function (respuesta) { // Sirve para enviar al servidor la petición, el objeto respuesta es la respuesta recibida por el servidor
            listar_tareas(fk_id_contrato);
            console.log(respuesta);
            $('#task-form').trigger('reset');

        })
       // console.log(datosPost);
        e.preventDefault();
    });


    function listar_tareas() {
       /* $.ajax({ //llamo a el backend PHP para listar las tareas
            url: 'task-list.php',
            type: 'POST',
            success: function (respuesta) { //Rutina que prepara los datos de una tabla para pintarla como JSON
                let tareas = JSON.parse(respuesta);
                console.log(respuesta);
                let template = '';
                tareas.forEach(tarea2 => {
                    template += `<tr>
                                <td>${tarea2.descripcion}</td>
                                <td><button class="eliminar-tarea btn btn-danger">Eliminar</button></td>
                            </tr>`
                });
                $('#actividades').html(template);
            }
        }) */
    }

    function listar_tareas(id_contrato) {
        const datosPost = { //Construye un array para enviar los datos por POST            
            id_contrato: id_contrato
        };
        let url = 'lista_actividades.php';
        $.post(url, datosPost, function (respuesta) { // Sirve para enviar al servidor la petición, el objeto respuesta es la respuesta recibida por el servidor
            let tareas = JSON.parse(respuesta);
            console.log(respuesta);
            let template = '';
            tareas.forEach(tarea2 => {
                template += `<tr id_actividad="${tarea2.id_actividad}">
                            <td>${tarea2.id_actividad}</td>
                            <td>${tarea2.descripcion}</td>
                            <!-- <td><button class="eliminar-tarea btn btn-danger">Eliminar</button></td> -->
                        </tr>`
            });
            $('#actividades').html(template);
        })        
    }



    $(document).on('click', '.eliminar-tarea', function () { //leer los eventos de click del documento (toda la pagina) filtrando los que se hagan sobre el elemento boton eliminar-tarea
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('id_actividad');
        console.log("Elemento html ->"+elemento);
        console.log("id tarea capturado ->"+id);
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
        console.log("Listo para eliminar la tarea -> "+ id_tarea_eliminar)
        $.ajax({ // Objeto de Ajax que sirve para enviar y recibir datos de un servidor
            url: 'eliminar_actividad.php',
            type: 'POST',
            data: { id_tarea_eliminar },
            success: function (response) {
                console.log(response);
                listar_tareas(fk_id_contrato);
            }
        })


    }

});



