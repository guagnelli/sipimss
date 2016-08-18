$(function () {
    if($('.btn_agregar_formacion_salud_modal').length){
        $('.btn_agregar_formacion_salud_modal').on('click', function() {
            data_ajax(site_url+'/perfil/formacion_salud_formulario/', null, '#modal_content');
        });
    }
    if($('.btn_editar_fi').length){
        $('.btn_editar_fi').on('click', function() {
            data_ajax(site_url+'/perfil/formacion_salud_formulario/'+$(this).attr('data-value'), null, '#modal_content');
        });
    }
    if($('.btn_eliminar_fi').length){
        $('.btn_eliminar_fi').on('click', function() {
            var data_value = $(this).attr('data-value');
            apprise(confirmar_eliminacion, {verify: true}, function(btnClick) {
                if (btnClick) {
                    $.ajax({
                        url: site_url + '/perfil/eliminar_formacion_salud/'+data_value,
                        method: 'POST',
                        dataType: "json",
                        beforeSend: function(xhr) {
                            $('#mensaje1').html(create_loader());
                        }
                    })
                    .done(function(response) {
                        $('#mensaje1').html(imprimir_resultado(response));
                        if(response.result==true){
                            $('#tr_'+data_value).slideUp( "slow", function() { //Ocultar fila del registro
                                $('#tr_'+data_value).remove(); //Eliminar fila
                            });
                        }
                    })
                    .fail(function(jqXHR, response) {
                        $('#mensaje1').html(imprimir_resultado(response));
                    })
                    .always(function() {
                        remove_loader();
                        recargar_fecha_ultima_actualizacion();
                    });
                } else {
                    return false;
                }
            });
        });
    }
});