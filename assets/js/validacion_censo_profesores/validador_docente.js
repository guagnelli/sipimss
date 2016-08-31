function envio_validacion(element) {
    var a = hrutes['seccion_validar'];
    var cad_split = a.split(":");
    var obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)

    $.ajax({
        url: site_url + '/' + cad_split[0] + '/validar_estado_docente',
        method: 'POST',
        beforeSend: function (xhr) {
            $('#modal_content').html(create_loader());
        }
    })
            .done(function (response) {
                $('#seccion_validar').html(response);
            })
            .fail(function (jqXHR, response) {
//                $('#div_error').show();
                $('#seccion_validar').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
//                $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
            })
            .always(function () {
                remove_loader();
            });

}
function envio_correccion(element) {
    var a = hrutes['seccion_validar'];
    var cad_split = a.split(":");
    var obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)

    $.ajax({
        url: site_url + '/' + cad_split[0] + '/enviar_correccion_validacion',
         data: $('#form_validar_docente').serialize(),
        method: 'POST',
        beforeSend: function (xhr) {
            $('#seccion_validar').html(create_loader());
        }
    })
            .done(function (response) {
                $('#seccion_validar').html(response);
            })
            .fail(function (jqXHR, response) {
//                $('#div_error').show();
                $('#seccion_validar').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
//                $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
            })
            .always(function () {
                remove_loader();
            });
}

