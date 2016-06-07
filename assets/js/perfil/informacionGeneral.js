$(function(){
    $('#btnEditarNombre').on('click', function(){
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        $('#perfil_apellido_paterno').focus();
    });
});