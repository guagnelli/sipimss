$(function() {

    $('#btn_agregar_actividad_modal').on('click', function() {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        var a = hrutes['get_data_ajax_actividad'];
        var cad_split = a.split(":");
//        data_ajax(site_url + '/perfil    /get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
        data_ajax(site_url + '/' + cad_split[0] + '/get_data_ajax_actividad_modal', '#form_actividad_docente_general', '#modal_content');
//        data_ajax(site_url + '/' + cad_split[0] + '/get_data_ajax_actividad_modal', '#form_actividad_docente_general', '#modal_content');

    });

    $('#btn_guardar_actividad').on('click', function() {//Llama agetget_"data_ajax_actividad" para guardar información
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        var a = hrutes['get_data_ajax_actividad'];
        var cad_split = a.split(":");
//        data_ajax(site_url + '/perfil    /get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
        data_ajax(site_url + '/' + cad_split[0] + '/' + cad_split[1], cad_split[2], cad_split[3]);
    });
    $('#datetimepicker1').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    $('#datetimepicker1').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        }
    });
    
});

//document.getElementById("tipo_actividad_docente").onchange = function() {
//    tipo_actividad_docente();
//};

//function tipo_actividad_docente() {
//    var x = document.getElementById("tipo_actividad_docente");
//}

function myFunctionActividad() {
    var x = document.getElementById("tipo_actividad_docente");
    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + x.value, '#form_actividad_docente_especifico', '#info_actividad_docente');
}

function mostrar_horas_fechas(horas) {
    if (horas == 'none') {
        document.getElementById('div_horas_dedicadas').style.display = 'none';
        document.getElementById('fecha_inicio').style.display = 'block';
        document.getElementById('fecha_fin').style.display = 'block';
    } else {
        document.getElementById('div_horas_dedicadas').style.display = 'block';
        document.getElementById('fecha_inicio').style.display = 'none';
        document.getElementById('fecha_fin').style.display = 'none';
    }
}
