$(function(){
    $('#btnEditarNombre').on('click', function(){
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        $('#perfil_apellido_paterno').focus();
    });
    
    $("ul.nav-pills > li > a").on("shown.bs.tab", function (e) {
       var scrollposition = $(document).scrollTop();
       var id = jQuery(e.target).attr("href").substr(1);
       window.location.hash = id;
       $(document).scrollTop(scrollposition);
    });

    var hash = window.location.hash;
    $('.nav.nav-pills a[href="' + hash + '"]').tab('show', function(){
        $(document).scrollTop();
    });
});