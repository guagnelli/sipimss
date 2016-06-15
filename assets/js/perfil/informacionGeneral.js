$(function() {
    $('#btnEditarNombre').on('click', function() {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        $('#perfil_apellido_paterno').focus();
    });

    $("ul.nav-pills > li > a").on("shown.bs.tab", function(e) {
        var scrollposition = $(document).scrollTop();
        var id = jQuery(e.target).attr("href").substr(1);//Obtiene el texto del href
        window.location.hash = id;
//        alert(window.location.href);
        if (id.indexOf('ajax') > -1 && array_menu_perfil.indexOf(id) < 0) {
            //Separar en 4, 0controlador; 1nombre del método ajax; 2nombre del formulario; 3nombre del div
            var cad =hrutes[id];
            var cad_split = cad.split(":");
            array_menu_perfil.push(id);
//            data_ajax(site_url + '/perfil/get_data_ajax_actividad', '#form_actividad_docente', '#get_data_ajax_actividad');
            data_ajax(site_url + '/'+cad_split[0]+'/'+cad_split[1], cad_split[2], cad_split[3]);
        }
        $(document).scrollTop(scrollposition);
    });

    var hash = window.location.hash;
    $('.nav.nav-pills a[href="' + hash + '"]').tab('show', function() {
        $(document).scrollTop();
    });


});