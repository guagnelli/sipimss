$(function () {
    $('#btnEditarNombre').on('click', function () {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
    });

    $("ul.nav-pills > li > a").on("shown.bs.tab", function (e) {
//      alert(window.location.href);
        var scrollposition = $(document).scrollTop();
        var id = jQuery(e.target).attr("href").substr(1);//Obtiene el texto del href
        window.location.hash = id;
        if ((id.indexOf('ajax') > -1 || id.indexOf('seccion') > -1) && array_menu_perfil.indexOf(id) < 0) {
            //alert();
            array_menu_perfil.push(id);
            //Separar en 4, 0controlador; 1nombre del método ajax; 2nombre del formulario; 3nombre del div
//            var cad = hrutes[id];
//            var cad_split = cad.split(":");
////            data_ajax(site_url + '/perfil/get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
//            data_ajax(site_url + '/' + cad_split[0] + '/' + cad_split[1], cad_split[2], cad_split[3]);
            cargar_datos_menu_perfil(id);
        }
//        $(document).scrollTop(scrollposition);
    });

    var hash = window.location.hash;
    $('.nav.nav-pills a[href="' + hash + '"]').tab('show', function () {
        $(document).scrollTop();
    });


});

/**
 * 
 * @param {type} el identificador se compone de tres elementos o argumentos, que 
 * se encuentran separados por el caracter ":" 1er_arg=metódo, 2do_arg=formulario
 * y 3er_arg=div, ejemplo a continuación:
 * "get_data_ajax_actividad:#form_actividad_docente:#get_data_ajax_actividad"
 * @returns {undefined}
 */
function cargar_datos_menu_perfil(id) {
    var cad = hrutes[id];
    var cad_split = cad.split(":");
//    alert('si me llamo' + cad_split[0] + '/' + cad_split[1] + cad_split[2] + cad_split[3]);
//            data_ajax(site_url + '/perfil/get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
    data_ajax(site_url + '/' + cad_split[0] + '/' + cad_split[1], cad_split[2], cad_split[3]);
}

function recargar_fecha_ultima_actualizacion() {
    var a = hrutes['ajax_investigacion'];
    var cad_split = a.split(":");
    $.ajax({
        url: site_url + '/' + cad_split[0] + '/get_fecha_ultima_actualizacion',
        method: 'POST',
        beforeSend: function (xhr) {
//            $('#modal_content').html(create_loader());
        }
    })
            .done(function (response) {
                var response_json = $.parseJSON(response);//
                $('#fecha_ultima_actualizacion').text(response_json.fecha_ult_act);
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