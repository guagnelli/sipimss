$(function() {
    $('#btnEditarNombre').on('click', function() {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
    });
    
    $('#btn_guardar_actividad').on('click', function() {//Llama agetget_"data_ajax_actividad" para guardar información
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        var a =hrutes['get_data_ajax_actividad'];
        var cad_split = a.split(":");
        data_ajax(site_url + '/'+cad_split[0]+'/'+cad_split[1], cad_split[2], cad_split[3]);
    });
    
    $('#btn_agregar_actividad_modal').on('click', function() {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
    });

    $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
        var scrollposition = $(document).scrollTop();
        var id = jQuery(e.target).attr("href").substr(1);//Obtiene el texto del href
        window.location.hash = id;
//        alert(window.location.href);
        if (id.indexOf('ajax') > -1 && array_menu_perfil.indexOf(id) < 0 ) {
            array_menu_perfil.push(id);
            //Separar en 4, 0controlador; 1nombre del método ajax; 2nombre del formulario; 3nombre del div
            var cad =hrutes[id];
            var cad_split = cad.split(":");
//            data_ajax(site_url + '/perfil/get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
            data_ajax(site_url + '/'+cad_split[0]+'/'+cad_split[1], cad_split[2], cad_split[3]);
        }
        $(document).scrollTop(scrollposition);
    });

    var hash = window.location.hash;
    $('.nav.nav-pills a[href="' + hash + '"]').tab('show', function() {
        $(document).scrollTop();
    });


});