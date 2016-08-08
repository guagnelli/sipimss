var menu_busqueda_validar_censo = new Object();
menu_busqueda_validar_censo['matricula'] = 'Matrícula';
menu_busqueda_validar_censo['nombre'] = 'Nombre empleado';
menu_busqueda_validar_censo['claveadscripcion'] = 'Clave de adscripción';
menu_busqueda_validar_censo['unidad'] = 'Unidad';



function funcion_buscar_elementos() {
    var path = site_url + '/designar_validador/get_data_buscar_unidades';
    var val_post = $('#form_busqueda_unidades').serialize();

    $.ajax({
        url: path,
        data: val_post,
        method: 'POST',
        beforeSend: function (xhr) {
            $('#div_result_unidades_medicas').html(create_loader());
        }
    })
            .done(function (response) {
                $('#div_result_unidades_medicas').html(response);
            })
            .fail(function (jqXHR, textStatus) {
                $('#div_result_unidades_medicas').html("Ocurrió un error durante el proceso, inténtelo más tarde.");
            })
            .always(function () {
                remove_loader();
            });
}

/**
 * 
 * @param {type} name Menu de opciónes de filtro
 * @returns {undefined}
 */
function funcion_menu_tipo_busqueda_validar_censo(name) {
    var text = menu_busqueda_validar_censo[name];//Busca en el hashmap el nombre indicado
    $("#menu_select").val(name);//Modifica el valor del menu
    $("#btn_buscar_por").text(text);//Cambia el texto del botón
    $("#btn_buscar_por").append('<span class="caret"> </span>');//Agregar span al botón para mostrar icono flechita
    $("#buscar_unidad_medica").attr('data-original-title', 'Buscar por ' + text);//Cambia el texto del la caja de texto 
    $("#btn_buscar_b").attr('data-original-title', 'Buscar por ' + text);//Cambia el texto del botón
}

function runScript(e) {
    if (e.keyCode == 13) {
//        var tb = document.getElementById("scriptBox");
//        eval(tb.value);
        funcion_buscar_elementos();
        return false;
    }
}
function runScriptBuscador_sied(e) {
    if (e.keyCode == 13) {
        $("#btn_buscar_validador_siep").trigger("click");//Dispara el onclic del botón buscar validador en el sied
        return false;
    }
}

//****************************Seleccion de validador****************************
/**
 * LEAS
 * 
 * @param {type} element this del botón de la tabla de unidades
 * Carga los validadores prospecto o candidatos a ser validadores de unidad de adscripción
 * @returns {undefined}
 */
function funcion_carga_elemento(element) {
    var obj = $(element);
    var id_validaor = obj.data('idvalidador');
    var tipo_evento = obj.data('tipoevento');
    var delegacion_cve = obj.data('delcve');
    var departamento_desc = obj.data('depcve');
    var idrow = obj.data('idrow');
    $.ajax({
        url: site_url + '/designar_validador/get_data_cargar_elemento',
        data: {id_validaor: id_validaor, tipo_evento: tipo_evento,
            delegacion_cve: delegacion_cve, departamento_desc: departamento_desc,
            idrow: idrow
        },
        method: 'POST',
        beforeSend: function (xhr) {
            $('#modal_content').html(create_loader());
        }
    })
            .done(function (response) {
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
/**
 * 
 * @param {type} element combobox o select con los validadores prospectos
 * @returns {undefined}
 */
function funcion_carga_validador(element) {
    var obj = $(element);
    var id_validaor = obj.data('idvalidador');
    var tipo_evento = obj.data('tipoevento');
    var delegacion_cve = obj.data('delcve');
    var departamento_desc = obj.data('depcve');
    var idrow = obj.data('idrow');
    var datos_form_serializados = $('#form_carga_validadores').serialize();
    datos_form_serializados += '&idrow=' + idrow + '&tipo_evento=' + tipo_evento + '&id_validaor=' + id_validaor + '&delegacion_cve=' + delegacion_cve + '&departamento_desc=' + departamento_desc;
    //Si es cero, se carga el buscador, de lo contrario se cargan los datos del validador seleccionado, y esto en diferentes divs
    var e = document.getElementById("candidato_a_validador");
    var candidato_a_validador = parseInt(e.options[e.selectedIndex].value);
    var div_resultado = 'div_buscador_sied'; //div resultados
    document.getElementById("div_resultados_validadores").innerHTML = "";
    document.getElementById("div_buscador_sied").innerHTML = "";
    if (candidato_a_validador > 0) {
        div_resultado = 'div_resultados_validadores';
    }
    $.ajax({
        url: site_url + '/designar_validador/get_data_cargar_datos_opcion_validador',
//        data: {cve_inv: cve_inv, carga_datos: 1, idrow: idrow, comprobantecve: comprobantecve},
        data: datos_form_serializados,
        method: 'POST',
        beforeSend: function (xhr) {
            $('#' + div_resultado).html(create_loader());
        }
    })
            .done(function (response) {
                $('#' + div_resultado).html(response);
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

function funcion_buscar_validador(element) {
    var obj = $(element);
    var id_validaor = obj.data('idvalidador');
    var tipo_evento = obj.data('tipoevento');
    var delegacion_cve = obj.data('delcve');
    var departamento_desc = obj.data('depcve');
    var idrow = obj.data('idrow');
    var datos_form_serializados = $('#form_buscador_validador').serialize();
    datos_form_serializados += '&idrow=' + idrow + '&tipo_evento=' + tipo_evento + '&id_validaor=' + id_validaor + '&delegacion_cve=' + delegacion_cve + '&departamento_desc=' + departamento_desc;
    $.ajax({
        url: site_url + '/designar_validador/get_data_buscar_sied_validador',
//        data: {cve_inv: cve_inv, carga_datos: 1, idrow: idrow, comprobantecve: comprobantecve},
        data: datos_form_serializados,
        method: 'POST',
        beforeSend: function (xhr) {
            $('#div_resultados_validadores').html(create_loader());
        }
    })
            .done(function (response) {
                $('#div_resultados_validadores').html(response);
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


function funcion_seleccionar_validador(element) {
    var obj = $(element);
    var id_validaor = obj.data('idvalidador');
    var tipo_evento = obj.data('tipoevento');
    var delegacion_cve = obj.data('delcve');
    var departamento_desc = obj.data('depcve');
    var idrow = obj.data('idrow');
//    var candidato_a_validador = document.getElementById('#candidato_a_validador').val;
    var e = document.getElementById("candidato_a_validador");
    var candidato_a_validador = e.options[e.selectedIndex].value;

    var datos_form_serializados = $('#form_seleccionar_validador').serialize();
    datos_form_serializados += '&idrow=' + idrow + '&candidato_a_validador=' + candidato_a_validador + '&tipo_evento=' + tipo_evento + '&id_validaor=' + id_validaor + '&delegacion_cve=' + delegacion_cve + '&departamento_desc=' + departamento_desc;

    document.getElementById("div_resultados_validadores").innerHTML = "";
    document.getElementById("div_buscador_sied").innerHTML = "";
    if (candidato_a_validador > 0) {
        div_resultado = 'div_resultados_validadores';
    }

    $.ajax({
        url: site_url + '/designar_validador/get_data_seleccionar_validador',
//        data: {cve_inv: cve_inv, carga_datos: 1, idrow: idrow, comprobantecve: comprobantecve},
        data: datos_form_serializados,
        method: 'POST',
        beforeSend: function (xhr) {
            $('#div_resultados_validadores').html(create_loader());
        }
    })
            .done(function (response) {
                var is_html = response.indexOf('<label for=\"lbl_no_existe_usuario\"');//si existe la cadena, entonces es un html
//                alert(is_html + ' ' + response);
                if (is_html > -1) {
                    $('#div_resultados_validadores').html(response);
                } else {
                    if (response) {

                        var response_json = $.parseJSON(response);//
                        var validador_cve = response_json.result_datos[0].id_validador;
                        var delegacion_cve = response_json.result_datos[0].delegacion_cve;
                        var matricula = response_json.result_datos[0].matricula;
                        var nombre = response_json.result_datos[0].nombre;
                        var categoria_cve = response_json.result_datos[0].categoria_cve;
                        var categoria_nombre = response_json.result_datos[0].categoria_nombre;
                        var adscripcion_clave = response_json.result_datos[0].adscripcion_clave;
                        var adscripcion_nombre = response_json.result_datos[0].adscripcion_nombre;
                        var idrow = response_json.result_datos[0].idrow;//Obtiene index de el row de la tabla de actividades

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
function funcion_designar_validador(element) {
    var a = hrutes['ajax_investigacion'];
    var cad_split = a.split(":");
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var id_validador = button_obj.data('invcve');
    var comprobante_cve = button_obj.data('comprobantecve');

    apprise('Confirme que realmente quitar la designación de validador a la unidad', {verify: true}, function (btnClick) {
        if (btnClick) {
            var button_obj = $(element);
            $.ajax({
                url: site_url + '/' + cad_split[0] + '/get_data_ajax_eliminar_investigacion',
                data: {
                    id_validador: id_validador,
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
                        $('#id_row_' + button_obj.data('idrow')).remove();
                        $('#div_error_inv_doc').show();
                        setTimeout("$('#div_error_inv_doc').hide()", 5000);

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
