var menu_tipo_busqueda = new Object();
menu_tipo_busqueda['unidad'] = 'Unidad';
menu_tipo_busqueda['matricula'] = 'Matrícula';
menu_tipo_busqueda['nombre'] = 'Nombre empleado';


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

function funcion_menu_tipo_busqueda(name) {
    var text = menu_tipo_busqueda[name];
    $("#menu_select").val(name);//value

    $("#btn_buscar_por").text(text);//Cambia el texto del botón
    $("#btn_buscar_por").append('<span class="caret"> </span>');//Agregar span al botón
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

function funcion_seleccionar_validador(element) {
    var obj = $(element);
//    var cve_inv = obj.data('departamento_cve');
//    var idrow = obj.data('idrow');
//    var comprobantecve = obj.data('comprobantecve');
//    datos_form_serializados += '&cve_inv='+cve_inv+'&carga_datos=0'+'&idrow='+idrow+'&comprovantecve='+comprovantecve;
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