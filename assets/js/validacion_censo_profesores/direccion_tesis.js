$(function () {
    if($('#btn_agregar_direccion_tesis_modal').length){
        $('#btn_agregar_direccion_tesis_modal').on('click', function() {
            data_ajax(site_url+'/validacion_censo_profesores/direccion_tesis_formulario/'+$(this).attr('data-value'), null, '#modal_content');
        });
    }
    if($('.btn_editar_dt').length){
        $('.btn_editar_dt').on('click', function() {
            data_ajax(site_url+'/validacion_censo_profesores/direccion_tesis_formulario/'+$(this).attr('data-value'), null, '#modal_content');
        });
    }
    if($('.btn_eliminar_dt').length){
        /*$('.btn_eliminar_dt').on('click', function() {
            data_ajax(site_url+'/validacion_censo_profesores/eliminar_direccion_tesis/'+$(this).attr('data-value'), null, '#modal_content');
        });*/
        $('.btn_eliminar_dt').on('click', function() {
            var data_value = $(this).attr('data-value');
            apprise(confirmar_eliminacion, {verify: true}, function(btnClick) {
                if (btnClick) {
                    $.ajax({
                        url: site_url + '/validacion_censo_profesores/eliminar_direccion_tesis/'+data_value,
                        method: 'POST',
                        dataType: "json",
                        beforeSend: function(xhr) {
                            $('#mensaje').html(create_loader());
                        }
                    })
                    .done(function(response) {
                        $('#mensaje').html(imprimir_resultado(response));
                        if(response.result==true){
                            $('#tr_'+data_value).slideUp( "slow", function() { //Ocultar fila del registro
                                $('#tr_'+data_value).remove(); //Eliminar fila
                            });
                        }
                    })
                    .fail(function(jqXHR, response) {
                        $('#mensaje').html(imprimir_resultado(response));
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