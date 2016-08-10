$(function () {

    $('#btn_gregar_comision_modal').on('click', function () {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        var a = hrutes['seccion_becas_comisiones'];
        var cad_split = a.split(":");
        data_ajax(site_url + '/' + cad_split[0] + '/get_form_comisiones', null, '#modal_content');
    });
    $('#btn_gregar_beca_modal').on('click', function () {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        var a = hrutes['seccion_becas_comisiones'];
        var cad_split = a.split(":");
        data_ajax(site_url + '/' + cad_split[0] + '/get_form_becas', null, '#modal_content');
    });
});

function funcion_eliminar_reg_becas(element) {
    var a = hrutes['ajax_investigacion'];
    var cad_split = a.split(":");
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var index_inv = button_obj.data('invcve');
    var comprobante_cve = button_obj.data('comprobantecve');

    apprise('Confirme que realmente desea eliminar el registro de investigación', {verify: true}, function (btnClick) {
        if (btnClick) {
            var button_obj = $(element);
            $.ajax({
                url: site_url + '/' + cad_split[0] + '/get_data_ajax_eliminar_investigacion',
                data: {
                    index_inv: index_inv,
                    comprobante_cve: comprobante_cve,
                },
                method: 'POST',
                beforeSend: function (xhr) {

                }
            })
                    .done(function (response) {
                        var response = $.parseJSON(response);
                        $('#mensaje_error_inv_doc').html(response.error);
                        $('#mensaje_error_inv_doc_div').removeClass('alert-danger').removeClass('alert-success');
                        $('#mensaje_error_inv_doc_div').removeClass('alert-danger').addClass('alert-' + response.tipo_msg);
                        $('#id_row_' + button_obj.data('keyrow')).remove();
                        $('#div_error_inv_doc').show();
                        setTimeout("$('#div_error_inv_doc').hide()", 5000);
                        recargar_fecha_ultima_actualizacion();

                    })
                    .fail(function (jqXHR, response) {
                        $('#mensaje_error_inv_doc').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                        $('#mensaje_error_inv_doc_div').removeClass('alert-success').addClass('alert-danger');
                        $('#div_error_inv_doc').show();
                        setTimeout("$('#div_error_inv_doc').hide()", 6000);
                    })
                    .always(function () {
                        remove_loader();
                    });
        } else {
            return false;
        }
    });
}

function funcion_guardar_beca() {
//    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0', '#form_actividad_docente_especifico', '#info_actividad_docente');
    var a = hrutes['seccion_becas_comisiones'];
    var cad_split = a.split(":");
//    alert('si llgas');
//    data_ajax(site_url + '/' + cad_split[0] + '/ajax_add_investigacion', '#form_investigacion_docente', '#modal_content');
//    var formData = new FormData($('#form_investigacion_docente')[0]);
    var formData = new FormData($('#form_becas_laborales')[0]);
    $.ajax({
        url: site_url + '/' + cad_split[0] + '/get_add_beca',
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
//                alert(is_html + ' ' + response);
//                    alert('html');
                if (is_html > -1) {
                    $('#cuerpo_modal').html(response);
//                    $('#modal_censo').modal(toggle);
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


function funcion_editar_reg_beca(element) {
    var a = hrutes['seccion_becas_comisiones'];
    var cad_split = a.split(":");
    var obj = $(element);
    var cve_inv = obj.data('invcve');
    var idrow = obj.data('idrow');
    var comprobantecve = obj.data('comprobantecve');
//    datos_form_serializados += '&cve_inv='+cve_inv+'&carga_datos=0'+'&idrow='+idrow+'&comprovantecve='+comprovantecve;

    $.ajax({
        url: site_url + '/' + cad_split[0] + '/ajax_carga_datos_investigacion',
        data: {cve_inv: cve_inv, carga_datos: 1, idrow: idrow, comprobantecve: comprobantecve},
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

function funcion_actualizar_beca(element) {
    var a = hrutes['seccion_becas_comisiones'];
    var cad_split = a.split(":");
    var obj = $(element);
    var cve_inv = obj.data('invcve');
    var idrow = obj.data('idrow');
    var comprobantecve = obj.data('comprobantecve');
    var formData = new FormData($('#form_investigacion_docente')[0]);
    formData.append("comprobantecve", comprobantecve);
    formData.append("invcve", cve_inv);
//    cve_inv : cve_inv, carga_datos : 0
//    alert('sasasdasd asda,sdmlamk da sdkjaskdm ,aksmd lksa dmk F');
    $.ajax({
        url: site_url + '/' + cad_split[0] + '/ajax_update_investigacion',
        data: formData,
        type: 'POST',
        mimeType: "multipart/form-data", //Para subir archivos 
        contentType: false, //Limpía el formulario
        cache: false,
        processData: false,
//  
        beforeSend: function (xhr) {
            $('#cuerpo_modal').html(create_loader());
        }
    })
            .done(function (response) {
                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
//                alert(is_html + ' ' + response);
                if (is_html > -1) {
                    $('#cuerpo_modal').html(response);
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
///*****************************Comisiones *******************************************************************************


function funcion_eliminar_reg_comisiones(element) {
    var a = hrutes['ajax_investigacion'];
    var cad_split = a.split(":");
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var index_inv = button_obj.data('invcve');
    var comprobante_cve = button_obj.data('comprobantecve');

    apprise('Confirme que realmente desea eliminar el registro de investigación', {verify: true}, function (btnClick) {
        if (btnClick) {
            var button_obj = $(element);
            $.ajax({
                url: site_url + '/' + cad_split[0] + '/get_data_ajax_eliminar_investigacion',
                data: {
                    index_inv: index_inv,
                    comprobante_cve: comprobante_cve,
                },
                method: 'POST',
                beforeSend: function (xhr) {

                }
            })
                    .done(function (response) {
                        var response = $.parseJSON(response);
                        $('#mensaje_error_inv_doc').html(response.error);
                        $('#mensaje_error_inv_doc_div').removeClass('alert-danger').removeClass('alert-success');
                        $('#mensaje_error_inv_doc_div').removeClass('alert-danger').addClass('alert-' + response.tipo_msg);
                        $('#id_row_' + button_obj.data('keyrow')).remove();
                        $('#div_error_inv_doc').show();
                        setTimeout("$('#div_error_inv_doc').hide()", 5000);
                        recargar_fecha_ultima_actualizacion();

                    })
                    .fail(function (jqXHR, response) {
                        $('#mensaje_error_inv_doc').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                        $('#mensaje_error_inv_doc_div').removeClass('alert-success').addClass('alert-danger');
                        $('#div_error_inv_doc').show();
                        setTimeout("$('#div_error_inv_doc').hide()", 6000);
                    })
                    .always(function () {
                        remove_loader();
                    });
        } else {
            return false;
        }
    });
}

function funcion_guardar_comision() {
//    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0', '#form_actividad_docente_especifico', '#info_actividad_docente');
    var a = hrutes['seccion_becas_comisiones'];
    var cad_split = a.split(":");
//    alert('si llgas');
//    data_ajax(site_url + '/' + cad_split[0] + '/ajax_add_investigacion', '#form_investigacion_docente', '#modal_content');
//    var formData = new FormData($('#form_investigacion_docente')[0]);
    var formData = new FormData($('#form_comisiones_laborales')[0]);
    $.ajax({
        url: site_url + '/' + cad_split[0] + '/get_add_comision',
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
//                alert(is_html + ' ' + response);
//                    alert('html');
                if (is_html > -1) {
                    $('#cuerpo_modal').html(response);
//                    $('#modal_censo').modal(toggle);
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


function funcion_editar_reg_comision(element) {
    var a = hrutes['seccion_becas_comisiones'];
    var cad_split = a.split(":");
    var obj = $(element);
    var cve_inv = obj.data('invcve');
    var idrow = obj.data('idrow');
    var comprobantecve = obj.data('comprobantecve');
//    datos_form_serializados += '&cve_inv='+cve_inv+'&carga_datos=0'+'&idrow='+idrow+'&comprovantecve='+comprovantecve;

    $.ajax({
        url: site_url + '/' + cad_split[0] + '/ajax_carga_datos_investigacion',
        data: {cve_inv: cve_inv, carga_datos: 1, idrow: idrow, comprobantecve: comprobantecve},
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

function funcion_actualizar_comision(element) {
    var a = hrutes['seccion_becas_comisiones'];
    var cad_split = a.split(":");
    var obj = $(element);
    var cve_inv = obj.data('invcve');
    var idrow = obj.data('idrow');
    var comprobantecve = obj.data('comprobantecve');
    var formData = new FormData($('#form_investigacion_docente')[0]);
    formData.append("comprobantecve", comprobantecve);
    formData.append("invcve", cve_inv);
//    cve_inv : cve_inv, carga_datos : 0
//    alert('sasasdasd asda,sdmlamk da sdkjaskdm ,aksmd lksa dmk F');
    $.ajax({
        url: site_url + '/' + cad_split[0] + '/ajax_update_investigacion',
        data: formData,
        type: 'POST',
        mimeType: "multipart/form-data", //Para subir archivos 
        contentType: false, //Limpía el formulario
        cache: false,
        processData: false,
//  
        beforeSend: function (xhr) {
            $('#cuerpo_modal').html(create_loader());
        }
    })
            .done(function (response) {
                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
//                alert(is_html + ' ' + response);
                if (is_html > -1) {
                    $('#cuerpo_modal').html(response);
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
