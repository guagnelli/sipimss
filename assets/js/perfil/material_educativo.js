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
                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
                if (is_html > -1) {
                    $('#cuerpo_modal').html(response);
                } else {
                    if (response) {

                        var response_json = $.parseJSON(response);//
                        var investigacion_cve = response_json.result_datos[0].cve_investigacion;
                        var nombre_investigacion = response_json.result_datos[0].nombre_investigacion;
                        var nombre_tipo_actividad_docente = response_json.result_datos[0].tpad_nombre;
                        var cita_publica = response_json.result_datos[0].cita_publicada;
                        var comprobante_cve = response_json.result_datos[0].comprobante_cve;
                        var folio = response_json.result_datos[0].folio_investigacion;
                        var tiene_publicacion = response_json.result_datos[0].tiene_publicacion;
                        var idrow = funcion_obtener_max_id_row_table_tabla_investigacion_docente() + 1;//Obtiene el maximo index de el row de la tabla de actividades

                        var htmlRowTemplate = $('#template_row_nueva_investigacion').html();
                        var htmlNewRow = htmlRowTemplate.replace(/\$\$key_ai\$\$/g, idrow)
                                .replace(/\$\$tpad_nombre\$\$/g, nombre_tipo_actividad_docente)
                                .replace(/\$\$nombre_investigacion\$\$/g, nombre_investigacion)
                                .replace(/\$\$folio_investigacion\$\$/g, folio)
                                .replace(/\$\$tiene_cita\$\$/g, tiene_publicacion)
                                .replace(/\$\$key\$\$/g, investigacion_cve)
                                .replace(/\$\$comprobante\$\$/g, comprobante_cve);
                        $('#tabla_investigacion_docente').append($(htmlNewRow));
                        $('#mensaje_error_inv_doc').html(response_json.error);
                        $('#mensaje_error_inv_doc_div').removeClass('alert-danger').addClass('alert-success');
                        $('#div_error_inv_doc').show();
//                        $('#close_modal_censo').trigger('onclick');
                        $('#modal_censo').modal('toggle');
                        setTimeout("$('#div_error_inv_doc').hide()", 5000);
                    }
                }
            })
            .fail(function (jqXHR, response) {
//                $('#div_error').show();
//                $('#mensaje_error').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
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