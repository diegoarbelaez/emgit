$(document).ready(function () {
    console.log("Jquery Funcionando");
    //$('#resultado-busqueda').hide();
    //listar_tareas();
    let editar = false;
    let nombres_hijo = $('#nombres_hijo').val();
    let apellidos_hijo = $('#apellidos_hijo').val();
    let tipo_documento_hijo = $('#tipo_documento_hijo').val();
    let numero_documento_hijo = $('#numero_documento_hijo').val();
    let sexo = $('#sexo').val();
    let fecha_nacimiento_hijo = $('#fecha_nacimiento_hijo').val();
    let id_contratista = $('#id_contratista').val();

    console.log(nombres_hijo + " - " + apellidos_hijo + " - " + tipo_documento_hijo + " - " + numero_documento_hijo + " - " + fecha_nacimiento_hijo + " - " + id_contratista);
    listar_tareas(id_contratista);


    $('#pagos-form').submit(function (e) { //valido la función submit del formulario para capturar el evento y poder manejar las conexiones
        const datosPost = { //Construye un array para enviar los datos por POST            
            nombres_hijo:$('#nombres_hijo').val(),
            apellidos_hijo:$('#apellidos_hijo').val(),
            tipo_documento_hijo:$('#tipo_documento_hijo').val(),
            numero_documento_hijo:$('#numero_documento_hijo').val(),
            sexo:$('#sexo').val(),
            fecha_nacimiento_hijo:$('#fecha_nacimiento_hijo').val(),
            id_contratista: $('#id_contratista').val()
        };

        console.log(datosPost);
        //let url = editar === false ? 'task-add.php': 'task-edit.php';
        let url = '../hijos-add.php';

        $.post(url, datosPost, function (respuesta) { // Sirve para enviar al servidor la petición, el objeto respuesta es la respuesta recibida por el servidor
            listar_tareas(id_contratista);
            console.log(respuesta);
            $('#pagos-form').trigger('reset');

        })
        // console.log(datosPost);
        e.preventDefault();
    });


    function listar_tareas(id_contrato) {
        const datosPost = { //Construye un array para enviar los datos por POST            
            id_contratista: id_contrato
        };
        let url = '../lista_hijos.php';
        $.post(url, datosPost, function (respuesta) { // Sirve para enviar al servidor la petición, el objeto respuesta es la respuesta recibida por el servidor
            let tareas = JSON.parse(respuesta);
            console.log(respuesta);
            let template = '';
            tareas.forEach(tarea2 => {
                template += `<tr id_hijo="${tarea2.id_hijo}">
                            <td><center>${tarea2.id_hijo}</center></td>
                            <td>${tarea2.nombres}</td>
                            <td>${tarea2.apellidos}</td>
                            <td>${tarea2.sexo}</td>
                            <td>${tarea2.fecha_nacimiento}</td>
                            <td>${tarea2.tipo_documento}</td>
                            <td>${tarea2.numero_documento}</td>
                            <td><button class="eliminar-tarea btn btn-danger">Eliminar</button></td>
                        </tr>`
                        console.log(template);
            });
            $('#hijo').html(template);
        })
    }



    $(document).on('click', '.eliminar-tarea', function () { //leer los eventos de click del documento (toda la pagina) filtrando los que se hagan sobre el elemento boton eliminar-tarea
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('id_hijo');
        console.log("Elemento html ->" + elemento);
        console.log("id tarea capturado ->" + id);
        if (confirm("Está seguro que desea eliminar el Hijo")) { //Ventana de alerta en Javascript para confirmación
            eliminar_tarea(id);
        }
    })


    $(document).on('click', '.task-item', function () {
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('id_tarea');
        //console.log(id);
        $.post('../task-single.php', { id }, function (respuesta) {
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
            url: '../eliminar_hijo.php',
            type: 'POST',
            data: { id_tarea_eliminar },
            success: function (response) {
                console.log(response);
                listar_tareas(id_contratista);
            }
        })


    }

});



