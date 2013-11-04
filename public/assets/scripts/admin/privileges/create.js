$(function(){
  $('#btnActions').find('button').on('click', function(event) {
    var btn = $(this),
        isActive = btn.hasClass('active'),
        idCheck = btn.attr('data-check');

    if( ! isActive) {
      $('#' + idCheck).prop('checked', 'checked');
    } else {
      $('#' + idCheck).prop('checked', '');
    }

    buildCode();
  });
});


var buildCode = function () {
  var code = [];

  $('#btnActions').find('input[type=checkbox]').each(function(e) {
    var cb = $(this);

    if (cb.is(":checked")) {
      switch(cb.val()) {
        case 'create' : code.push(getCode('Create')); break;
        case 'store' : code.push(getCode('Store')); break;
        case 'show' : code.push(getCode('Show')); break;
        case 'edit' : code.push(getCode('Edit')); break;
        case 'update' : code.push(getCode('Update')); break;
        case 'destroy' : code.push(getCode('Delete')); break;
        case 'softdelete' : code.push(getCode('Softdelete')); break;
        case 'restore' : code.push(getCode('Restore')); break;
      }
    }
  });

  $('#code').val(code.join('\n\n'));

};


var getCode = function (method) {

  var comment,
      verb,
      controller = $('#purl_accion').val(),
      attrs,
      param;

  switch(method) {
    case 'Create' :
      comment ='Muestra el formulario para crear un recurso...';
      verb    = 'get';
      attrs   = '';
      param   = '';
      break;
    case 'Store' :
      comment ='Guarda un nuevo recurso en la bdd...';
      verb    = 'post';
      attrs   = '';
      param   = '';
      break;;
    case 'Show' :
      comment ='Muestra los datos de un recurso especifico...';
      verb    = 'get';
      attrs   = '$id';
      param   = '@param int $id';
      break;
    case 'Edit' :
      comment ='Muestra el formulario para editar un recurso especifico...';
      verb    = 'get';
      attrs   = '$id';
      param   = '@param int $id';
      break;
    case 'Update' :
      comment ='Actualiza un recurso en la bdd...';
      verb    = 'put';
      attrs   = '$id';
      param   = '@param int $id';
      break;;
    case 'Delete' :
      comment ='Elimina un recurso de la bdd...';
      verb    = 'get';
      attrs   = '$id';
      param   = '@param int $id';
      break;
    case 'Softdelete' :
      comment ='Desactiva un recurso de la bdd...';
      verb    = 'get';
      attrs   = '$id';
      param   = '@param int $id';
      break;
    case 'Restore' :
      comment ='Activa un recurso de la bdd...';
      verb    = 'get';
      attrs   = '$id';
      param   = '@param int $id';
      break;
  }

  return "/**\n" +
   "* "+comment+"\n" +
   "*\n* " + param + "\n" +
   "* @return Resource\n" +
   "*/\n" +
  "public function "+verb+""+method+"("+attrs+") \n" +
  "{\n"+
  " // Codigo Aqui :)\n" +
  "}";

};