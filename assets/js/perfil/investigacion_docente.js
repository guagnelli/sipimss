var htipos = new Object();
hrutes['autor'] =
        $(function () {

            $('#btn_agregar_investigacion_modal').on('click', function () {
                var isReadOnly = $('.nameFields').prop('readonly');
                $('.nameFields').prop('readonly', !isReadOnly);
                var a = hrutes['ajax_investigacion'];
                var cad_split = a.split(":");
//        data_ajax(site_url + '/perfil    /get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
                data_ajax(site_url + '/' + cad_split[0] + '/ajax_add_investigacion   ', '#form_actividad_docente_general', '#modal_content');
//        data_ajax(site_url + '/' + cad_split[0] + '/get_data_ajax_actividad_modal', '#form_actividad_docente_general', '#modal_content');
//        alert('continua.....');
            });

            $('#btn_guardar_actividad').on('click', function () {//Llama agetget_"data_ajax_actividad" para guardar información
//        data_ajax(site_url + '/perfil/get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
                apprise('Confirme que realmente desea actualizar los datos', {verify: true}, function (btnClick) {
                    if (btnClick) {
                        $.ajax({
                            url: site_url + '/perfil/get_data_ajax_actividad',
                            data: $('#form_actividad_docente').serialize(),
                            method: 'POST',
                            beforeSend: function (xhr) {
                                $('#get_data_ajax_actividad').html(create_loader());
                            }
                        })
                                .done(function (response) {
//                            alert(response);
                                    $('#get_data_ajax_actividad').html(response);
                                    $('#mensaje_error').html('Los datos se almacenaron correctamente');
                                    $('#mensaje_error_div').removeClass('alert-danger').addClass('alert-success');
                                    $('#div_error').show();
                                    setTimeout("$('#div_error').hide()", 5000);//desaparece div
                                })
                                .fail(function (jqXHR, response) {
                                    $('#get_data_ajax_actividad').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                                })
                                .always(function () {
                                    remove_loader();
                                });
                    } else {
                        return false;
                    }
                });
            });

        });

function funcion_eliminar_actividad_docentedddd(element) {
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var a = hrutes['get_data_ajax_actividad'];
    var cad_split = a.split(":");
    var index_tp_actividad = button_obj.data('cvead');
    var index_entidad = button_obj.data('tacve');
    var is_curso_principal = button_obj.data('cp');
    if (is_curso_principal === 1) {
        apprise('Es un curso principal, no es posible eliminar');
    } else {

        apprise('Confirme que realmente desea eliminar la actividad', {verify: true}, function (btnClick) {
            if (btnClick) {
                var button_obj = $(element);
                $.ajax({
                    url: site_url + '/' + cad_split[0] + '/get_data_ajax_eliminar_actividad_modal',
                    data: {
                        index_tp_actividad: index_tp_actividad,
                        index_entidad: index_entidad,
                        is_curso_principal: is_curso_principal,
                    },
                    method: 'POST',
                    beforeSend: function (xhr) {

                    }
                })
                        .done(function (response) {
                            var response = $.parseJSON(response);
                            $('#mensaje_error').html(response.error);
                            $('#mensaje_error_div').removeClass('alert-danger').addClass('alert-success');
                            $('#id_row_' + button_obj.data('idrow')).remove();
                            $('#div_error').show();
                            setTimeout("$('#div_error').hide()", 5000);

                        })
                        .fail(function (jqXHR, response) {
                            $('#mensaje_error').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                            $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
                            $('#div_error').show();
                            setTimeout("$('#div_error').hide()", 6000);
                        })
                        .always(function () {
                            remove_loader();
                        });
            } else {
                return false;
            }
        });
    }


}
function funcion_asignar_curso_principalddd(element) {
    var radio_curso_principal = $(element);
    var a = hrutes['get_data_ajax_actividad'];
    var cad_split = a.split(":");
    var entidad_tp_a_cve = radio_curso_principal.data('entidadtpacve');
    var act_general_cve = radio_curso_principal.data('actividadgeneralcve');
    var act_docente_cve = radio_curso_principal.data('actividaddocentecve');
    var cp = radio_curso_principal.data('cp');
    var key_row_select = radio_curso_principal.data('keyrowselect');
//    alert(act_general_cve + ' ' + entidad_tp_a_cve + ' ' + act_docente_cve + ' ' + cp);
    //Busca el row de la tabla que contiene el curso principal



    $.ajax({
        url: site_url + '/perfil/get_data_ajax_actualiza_curso_principal',
        data: {
            actividad_general_cve: act_general_cve,
            index_tp_actividad: entidad_tp_a_cve,
            actividad_docente_cve: act_docente_cve,
        },
        method: 'POST',
        beforeSend: function (xhr) {
//            $('#tabla_actividades_docente').html(create_loader());
        }
    })
            .done(function (response) {
                var response = $.parseJSON(response);//
                $('#mensaje_error_div').removeClass('alert-danger').removeClass('alert-success');
                if (response.result === 1) {
                    //Actializa vista de curso principal
                    $('#mensaje_error').html(response.error);
                    var cur_principal = curso_principal_actividad_docente();
                    $('#id_row_' + cur_principal).removeClass('success').addClass('');
                    $('#id_row_' + cur_principal).data("cp", 0);
                    $('#id_row_' + cur_principal).find('td').find('button[id=btn_eliminar_actividad_modal]').data("cp", 0);
                    $('#id_row_' + key_row_select).removeClass('').addClass('success');
                    $('#id_row_' + key_row_select).data("cp", 1);
                    $('#id_row_' + key_row_select).find('td').find('button[id=btn_eliminar_actividad_modal]').data("cp", 1);


                }
                $('#mensaje_error_div').addClass('alert-' + response.tipo_msg);
                $('#mensaje_error').html(response.error);
                $('#div_error').show();
                setTimeout("$('#div_error').hide()", 5000);
            })
            .fail(function (jqXHR, response) {
                $('#mensaje_error_div').removeClass('alert-danger').removeClass('alert-success');
                $('#mensaje_error_div').addClass('alert-danger');
                $('#mensaje_error').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                $('#div_error').show();
                setTimeout("$('#div_error').hide()", 5000);
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
 * @returns {}Obtiene el row de a la tabla de actividad docente que contiene 
 * el curso principal 
 */
function curso_principal_actividad_docenteddd() {
    var cur_prin_actual = -1;
    var obj_row;
    for (var i = 0; i < document.getElementById('tabla_actividades').rows.length; i++) {
        obj_row = $(document.getElementById('tabla_actividades').rows[i]);
        if (obj_row.data('cp') === '1' || obj_row.data('cp') === 1) {
            cur_prin_actual = obj_row.data('keyrow');
            break;
        }
    }
    return cur_prin_actual;
}

function funcion_agregar_nueva_actividadddd() {
    //////////////
    var valor_radio_curso = '123';
    var titulo_tipo_actividad = 'titulo prueba';
    var anio = '2005';
    var duracion = '78';
    var fecha_inicio = '78';
    var fecha_fin = '546';
    var tacve = '100';
    var cvead = '30';
    var cp = '0';
    var idrow = funcion_obtener_max_id_row_table_actividad() + 1;//Obtiene el maximo index de el row de la tabla de actividades
    ////////////

    var htmlRowTemplate = $('#template_row_nueva_act').html();
    var htmlNewRow = htmlRowTemplate.replace(/\$\$valor_radio_curso\$\$/g, valor_radio_curso)
            .replace(/\$\$titulo_tipo_actividad\$\$/g, titulo_tipo_actividad)
            .replace(/\$\$anio\$\$/g, anio)
            .replace(/\$\$duracion\$\$/g, duracion)
            .replace(/\$\$fecha_inicio\$\$/g, fecha_inicio)
            .replace(/\$\$fecha_fin\$\$/g, fecha_fin)
            .replace(/\$\$tacve\$\$/g, tacve)
            .replace(/\$\$cvead\$\$/g, cvead)
            .replace(/\$\$cp\$\$/g, cp)
            .replace(/\$\$idrow\$\$/g, idrow)
            .replace(/\$\$key\$\$/g, idrow);//identificador unitario de el row
    $('#tabla_actividades').append($(htmlNewRow));
}

/**
 * 
 * @returns {Number} Recorre los row(s) de la tabla actividad docente, para 
 * obtener el index máximo del row
 */
function funcion_obtener_max_id_row_table_actividadddd() {
    var index_macx = -1;
    var obj_row;

    for (var i = 0; i < document.getElementById('tabla_actividades').rows.length; i++) {
        obj_row = $(document.getElementById('tabla_actividades').rows[i]);
        if (index_macx < obj_row.data('keyrow')) {
            index_macx = cur_prin_actual = obj_row.data('keyrow');
        }
    }
    return index_macx;
}


//function funcion_guargar(index) {
//    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0', '#form_actividad_docente_especifico', '#info_actividad_docente');
//}
function funcion_guargarddd(index) {
//    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0', '#form_actividad_docente_especifico', '#info_actividad_docente');
    $.ajax({
        url: site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0',
        data: $('#form_actividad_docente_especifico').serialize(),
        method: 'POST',
        beforeSend: function (xhr) {
            $('#info_actividad_docente').html(create_loader());
        }
    })
            .done(function (response) {
                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
//                alert(is_html + ' ' + response);
                if (is_html > -1) {
                    $('#info_actividad_docente').html(response);
//                    $('#modal_censo').modal(toggle);
                } else {
                    if (response) {

                        var response_json = $.parseJSON(response);//
                        var titulo_tipo_actividad = response_json.insertar[0].nombre_tp_actividad;
                        var anio = response_json.insertar[0].anio;
                        var duracion = response_json.insertar[0].duracion;
                        var fecha_inicio = response_json.insertar[0].fecha_inicio;
                        var fecha_fin = response_json.insertar[0].fecha_fin;
                        var tacve = response_json.insertar[0].ta_cve;
                        var cvead = response_json.insertar[0].cve_actividad_docente;
                        var cve_actividad_general = response_json.insertar[0].actividad_general_cve;
                        var cp = 0;
                        var idrow = funcion_obtener_max_id_row_table_actividad() + 1;//Obtiene el maximo index de el row de la tabla de actividades
                        ////////////
                        duracion = (duracion === null) ? '' : duracion;
                        fecha_inicio = (fecha_inicio === null) ? '' : fecha_inicio;
                        fecha_fin = (fecha_fin === null) ? '' : fecha_fin;

                        var htmlRowTemplate = $('#template_row_nueva_act').html();
                        var htmlNewRow = htmlRowTemplate.replace(/\$\$titulo_tipo_actividad\$\$/g, titulo_tipo_actividad)
                                .replace(/\$\$anio\$\$/g, anio)
                                .replace(/\$\$duracion\$\$/g, duracion)
                                .replace(/\$\$fecha_inicio\$\$/g, fecha_inicio)
                                .replace(/\$\$fecha_fin\$\$/g, fecha_fin)
                                .replace(/\$\$tacve\$\$/g, tacve)
                                .replace(/\$\$cvead\$\$/g, cvead)
                                .replace(/\$\$cp\$\$/g, cp)
                                .replace(/\$\$idrow\$\$/g, idrow)
                                .replace(/\$\$key\$\$/g, idrow)//identificador unitario de el row
                                .replace(/\$\$actividadgeneralcve\$\$/g, cve_actividad_general);//identificador unitario de el row
                        $('#tabla_actividades').append($(htmlNewRow))
                        $('#mensaje_error').html(response_json.error);
                        $('#mensaje_error_div').removeClass('alert-danger').addClass('alert-success');
                        $('#div_error').show();
                        setTimeout("$('#div_error').hide()", 5000);
                    }
                }
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
 * @author LEAS
 * @fecha creación : 20/07/2016
 * @param {type} elementos
 * @returns {undefined}
 */
function funcion_mostrar_tipo_publicacion(elementos) {
    $(document.getElementById('div_libro')).hide();
    $(document.getElementById('div_revista')).hide();
    $(document.getElementById('div_comprobante')).hide();
    switch (elementos.value) {
        case '3'://Caso revista
            $(document.getElementById('div_revista')).show();
            break;
        case '4'://Caso libro 
            $(document.getElementById('div_libro')).show();
            break;
        default ://Caso comprobante, foro
            $(document.getElementById('div_comprobante')).show();

    }
}

/**
 * @author LEAS
 * @fecha creación : 20/07/2016
 * @param {type} elementos
 * @returns {undefined}
 */
function funcion_agregar_elemento(element) {
    nextinput++;
    var obj = $(element);
//    alert(obj.data('keyname'));
    var key = obj.data('keyname');
    //Control de cantidad de elementos
    if (!control_generados.hasOwnProperty(key)) {
        control_generados[key] = '0';
    }
    var propiedades = htipos_bibliografia[key];
    var array_prop = propiedades.split('|');
    var cdadPermitida = parseInt(array_prop[0]);
    var ctr_cdad_permitida = parseInt(control_generados[key]);
//    alert(cdadPermitida + ' ' + ctr_cdad_permitida);

    var is_valido = (cdadPermitida === -1) ? true : false;//Verifica si se debe agregar infinitamente elementos
    is_valido = (is_valido) ? true : (ctr_cdad_permitida > -1 && ctr_cdad_permitida < cdadPermitida); //Si n o se agregan infinitamente, verifica que la cantidad permitida sea menor o igual que los componentes agregados

    if (is_valido) {//Valida que se tenga permitido agreagar más elementos 
        var name_data_btn_control = array_prop[1];
        var id_div = array_prop[2];
        var id_btn_agregar = array_prop[3];

        var array_name_inputs = array_prop[4].split('$');
        var array_place_holder = array_prop[5].split('$');
        var titulo = array_prop[6];
//    console.log('cont -> ' + name_data_btn_control);
//    campo = '<ul id="' + name_data_btn_control + nextinput + '"><li name="autores' + nextinput + '" ><p>Autor(' + nextinput + '):</p>\n\
//                <input type="text"  size="50" id="autor_nom' + nextinput + '" name="autor_nom' + nextinput + '" placeholder = "Nombre(s)" />\n\
//                <input type="text"  size="50" id="autor_ap' + nextinput + '" name="autor_ap' + nextinput + '"  placeholder = "Apellido paterno"/>\n\
//                <input type="text"  size="50" id="autor_am' + nextinput + '" name="autor_am' + nextinput + '" placeholder = "Apellido materno" />\n\
//                <button type="button" class="btn btn-link btn-sm" name = "els" id="btn_eliminar_actividad_modal" data-keyname ="' + name_data_btn_control + '" data-rowli="' + name_data_btn_control + nextinput + '" onclick="funcion_eliminar_li(this)" >Eliminar</button>\n\n\
//             </li></ul>';
        //Genera los inputs
        var inputs = '';
        for (var i = 0; i < array_name_inputs.length - 1; i++) {
            inputs += '<input type="text"  class="form-control" size="500" id="' + array_name_inputs[i] + nextinput + '" name="' + array_name_inputs[i] + nextinput + '" placeholder = "' + array_place_holder[i] + '" />\n'
        }

        campo = '<ul id="' + name_data_btn_control + nextinput + '"><li name="autores' + nextinput + '" ><p>' + titulo + '(' + nextinput + '):</p>\n\
                ' + inputs + '\
                <button type="button" class="btn btn-link btn-sm" name = "els" id="btn_eliminar_actividad_modal" data-keyname ="' + name_data_btn_control + '" data-rowli="' + name_data_btn_control + nextinput + '" onclick="funcion_eliminar_li(this)" >Eliminar</button>\n\n\
             </li></ul>';
        add_autor = '<button type="button" class="btn btn-link btn-sm" id="' + id_btn_agregar + '"; data-keyname="' + name_data_btn_control + '"; onclick="funcion_agregar_elemento(this);" >' + titulo + '</button>';
        //Genera el boton agregar
        $("#" + id_div).append(campo);
        $("#" + id_btn_agregar).remove();
        valores_label(id_div);
        control_generados[key] = ctr_cdad_permitida + 1;
        if (cdadPermitida === -1 || (cdadPermitida > (ctr_cdad_permitida + 1))) {//Si ya rebasa el máximo de elementos, no se agrega
            $("#" + id_div).append(add_autor);
        }

    }
}

function funcion_eliminar_li(element) {
    var obj = $(element);
    var key = obj.data('keyname');
    var propiedades = htipos_bibliografia[key];
    var array_prop = propiedades.split('|');
    var cdadPermitida = parseInt(array_prop[0]);
    var elementos_existentes = parseInt(control_generados[key]);//Cantidad de elementos existentes
    var id_uili = obj.data('rowli'); //Nombre del <li> a eliminar 
    var id_div = array_prop[2];//Nombre del div

    $('#' + id_uili).remove();
    valores_label(id_div);

    control_generados[key] = elementos_existentes - 1;

    if (!(elementos_existentes > -1 && elementos_existentes < cdadPermitida)) {//Si ya rebasa el máximo de elementos, no se agrega
        var name_data_btn_control = array_prop[1];
        var id_btn_agregar = array_prop[3];
        var titulo = array_prop[6];
        add_autor = '<button type="button" class="btn btn-link btn-sm" id="' + id_btn_agregar + '"; data-keyname="' + name_data_btn_control + '"; onclick="funcion_agregar_elemento(this);" >' + titulo + '</button>';
        $("#" + id_div).append(add_autor);
    }




}

/**
 * 
 * @returns {}Obtiene el row de a la tabla de actividad docente que contiene 
 * el curso principal 
 */
function valores_label(id_div) {
    var inc = 1;
    $("#" + id_div + " p").each(function (i)
    {
        var pos_1 = $(this).text().indexOf('(');
        var pos_2 = $(this).text().indexOf(')');
        var text = $(this).text().substr(0, pos_1);
        var text = text + '(' + inc + $(this).text().substr(pos_2);
        $(this).text(text)
        inc++;
//        console.log('cont -> ' + text);
//        console.log($(this).text());
    })
}




