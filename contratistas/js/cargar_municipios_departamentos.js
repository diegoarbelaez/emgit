$(document).ready(function(){
  var id_contratista_recuperar = $('#id_contratista').val();
  console.log("ID Contratista cargar_departamentos -> "+id_contratista_recuperar);
  //Carga el departamento al cargar la página
  $.ajax({
    type: 'POST',
    url: '../utilidades/cargar_departamento.php',
    data: {'id_contratista': id_contratista_recuperar}
  })
  .done(function(lista_dep){
    $('#lista_departamento').html(lista_dep)
  })
  .fail(function(){
    alert('Error al Cargar los Departamentos')
  })
  // Carga el municipio
  $.ajax({
    type: 'POST',
    url: '../utilidades/cargar_municipio_primeravez.php',
    data: {'id_contratista': id_contratista_recuperar}
  })
  .done(function(lista_dep){
    console.log('Carga municipios inicial');
    $('#municipios').html(lista_dep)
  })
  .fail(function(){
    alert('Error al Cargar los Municipios')
  })




  $('#lista_departamento').on('change', function(){
    var id = $('#lista_departamento').val()

    $.ajax({
      type: 'POST',
      url: '../utilidades/cargar_municipio.php',
      data: {
        'id': id,
        'id_contratista':id_contratista_recuperar
    }
    })
    .done(function(lista_dep){
      $('#municipios').html(lista_dep);
      console.log('Municipios'+lista_dep);
    })
    .fail(function(){
      alert('Error al Cargar los Municipios')
    })
  })

  $('#enviar').on('click', function(){
    var resultado = 'Departamento: ' + $('#lista_departamento option:selected').text() +
    ' Municipio Seleccionado: ' + $('#municipios option:selected').text()

    $('#resultado1').html(resultado)
  })

})