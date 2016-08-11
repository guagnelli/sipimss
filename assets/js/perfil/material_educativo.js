$(function () {

    $('#btn_gregar_material_educativo').on('click', function () {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        var a = hrutes['seccion_material_educativo'];
        var cad_split = a.split(":");
        data_ajax(site_url + '/' + cad_split[0] + '/get_form_general_material_educativo', null, '#modal_content');
    });

});


function funcion_cargar_campos_tipo_material_educativo() {
    var a = hrutes['seccion_material_educativo'];
    var cad_split = a.split(":");
    data_ajax(site_url + '/' + cad_split[0] + '/get_cargar_tipo_material', '#form_material_educativo', '#cuerpo_modal');
}


function funcion_guardar_material_educativo() {
    var a = hrutes['seccion_material_educativo'];
    var cad_split = a.split(":");
    var formData = new FormData($('#form_material_educativo')[0]);
    $.ajax({
        url: site_url + '/' + cad_split[0] + '/add_tipo_material_educativo',
        data: formData,
        type: 'POST',
        mimeType: "multipart/form-data", //Para subir archivos 
        contentType: false, //Limpía el formulario
        cache: false,
        processData: false,
        beforeSend: function (xhr) {
            $('#cuerpo_modal').html(create_loader());
        }
    })
            .done(function (response) {
                recargar_opcion_menu_mostrar_mensaje('seccion_material_educativo', true, 'Guardado satisfactorio');
            })
            .fail(function (jqXHR, response) {
//                $('#div_error_index').show();
//                $('#mensaje_error_div_index').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
//                $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
            })
            .always(function () {
                remove_loader();
            });
}

function funcion_editar_material_educativo() {

}

function funcion_actualizar_material_educativo() {

}