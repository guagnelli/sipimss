
function funcion_buscar_elementos() {
    data_ajax(site_url + '/designar_validador/get_data_buscar_unidades',
            '#form_busqueda_unidades', '#div_result_unidades_medicas');
}
function funcion_seleccionar_validador(element) {
    var obj = $(element);
//    var cve_inv = obj.data('departamento_cve');
//    var idrow = obj.data('idrow');
//    var comprobantecve = obj.data('comprobantecve');
//    datos_form_serializados += '&cve_inv='+cve_inv+'&carga_datos=0'+'&idrow='+idrow+'&comprovantecve='+comprovantecve;
    alert('akjakdsjka');
    $.ajax({
        url: site_url + '/designar_validador/get_data_seleccionar_validador',
//        data: {cve_inv: cve_inv, carga_datos: 1, idrow: idrow, comprobantecve: comprobantecve},
        data: {},
        method: 'POST',
        beforeSend: function (xhr) {
            $('#modal_content').html(create_loader());
        }
    })
            .done(function (response) {
//                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
//                if (is_html > -1) {
//                }
                $('#modal_content').html(response);
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

function funcion_actualizar_investigacion(element) {
    var a = hrutes['ajax_investigacion'];
    var cad_split = a.split(":");
    var obj = $(element);
    var cve_inv = obj.data('invcve');
    var idrow = obj.data('idrow');
    var comprobantecve = obj.data('comprobantecve');
    var datos_form_serializados = $('#form_investigacion_docente').serialize();
    datos_form_serializados += '&cve_inv=' + cve_inv + '&carga_datos=0' + '&idrow=' + idrow + '&comprobantecve=' + comprobantecve;
    alert(datos_form_serializados);
//    cve_inv : cve_inv, carga_datos : 0
    alert('sasasdasd asda,sdmlamk da sdkjaskdm ,aksmd lksa dmk F');
    $.ajax({
        url: site_url + '/' + cad_split[0] + '/ajax_update_investigacion',
        data: datos_form_serializados,
        method: 'POST',
        mimeType: "multipart/form-data", //Para subir archivos 
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function (xhr) {
            $('#modal_content').html(create_loader());
        }
    })
            .done(function (response) {
                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
//                alert(is_html + ' ' + response);
                if (is_html > -1) {
                    $('#modal_content').html(response);
//                    $('#modal_censo').modal(toggle);
                } else {
                    if (response) {

                        var response_json = $.parseJSON(response);//
                        var idrow = response_json.idrow;//rom
                        var investigacion_cve = response_json.result_datos[0].cve_investigacion;
                        var nombre_investigacion = response_json.result_datos[0].nombre_investigacion;
                        var nombre_tipo_actividad_docente = response_json.result_datos[0].tpad_nombre;
                        var cita_publica = response_json.result_datos[0].cita_publicada;
                        var comprobante_cve = response_json.result_datos[0].comprobante_cve;
                        var folio = response_json.result_datos[0].folio_investigacion;
                        var tiene_publicacion = response_json.result_datos[0].tiene_publicacion;

                        $('#id_row_' + idrow).data();
                        var htmlRowTemplate = $('#template_row_nueva_investigacion').html();

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