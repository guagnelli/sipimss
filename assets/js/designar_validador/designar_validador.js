var menu_tipo_busqueda = new Object();
menu_tipo_busqueda['unidad'] = 'Unidad';
menu_tipo_busqueda['matricula'] = 'Matrícula';
menu_tipo_busqueda['nombre'] = 'Nombre empleado';
menu_tipo_busqueda['claveadscripcion'] = 'Clave de adscripción';


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
function funcion_menu_tipo_busqueda(name) {
    var text = menu_tipo_busqueda[name];//Busca en el hashmap el nombre indicado
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
    $.ajax({
        url: site_url + '/designar_validador/get_data_cargar_elemento',
        data: {id_validaor: id_validaor, tipo_evento: tipo_evento,
            delegacion_cve: delegacion_cve, departamento_desc: departamento_desc},
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
    var datos_form_serializados = $('#form_carga_validadores').serialize();
    datos_form_serializados += '&tipo_evento=' + tipo_evento + '&id_validaor=' + id_validaor + '&delegacion_cve=' + delegacion_cve + '&departamento_desc=' + departamento_desc;
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
    var datos_form_serializados = $('#form_buscador_validador').serialize();
    datos_form_serializados += '&tipo_evento=' + tipo_evento + '&id_validaor=' + id_validaor + '&delegacion_cve=' + delegacion_cve + '&departamento_desc=' + departamento_desc;
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

//    var candidato_a_validador = document.getElementById('#candidato_a_validador').val;
    var e = document.getElementById("candidato_a_validador");
    var candidato_a_validador = e.options[e.selectedIndex].value;

    var datos_form_serializados = $('#form_seleccionar_validador').serialize();
    datos_form_serializados += '&candidato_a_validador=' + candidato_a_validador + '&tipo_evento=' + tipo_evento + '&id_validaor=' + id_validaor + '&delegacion_cve=' + delegacion_cve + '&departamento_desc=' + departamento_desc;
//    alert(datos_form_serializados);
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
//                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
//                if (is_html > -1) {
//                }
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