$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip(); //Llamada a tooltip
});

/**
 *	Método que muestra una imagen (gif animado) que indica que algo esta cargando
 *	@return	string	Contenedor e imagen del cargador.
 */
function create_loader(optionalPadding = '200px') {
    optionalPadding = (typeof optionalPadding === 'undefined') ? '200px' : optionalPadding;
    return '<div id="ajax_loader" align="center" style="padding-top:'+optionalPadding+'; padding-bottom:'+optionalPadding+';"><img src="' + img_url_loader + '" alt="Cargando..." title="Cargando..." /></div>';
}

/**
 *	Método que remueve el contenedor e imagen de cargando
 */
function remove_loader() {
    $("#ajax_loader").remove();
}

/**	Método que muestra un mensaje con formato de alertas de boostrap
 * @param	string	message 	Mensaje que será mostrado
 * @param 	string 	tipo 		Posibles valores('success','info','warning','danger')
 */
function html_message(message, tipo) {
    tipo = (typeof (tipo) === "undefined") ? 'danger' : tipo;
    return "<div class='alert alert-" + tipo + "' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + message + "</div>";
}

function imprimir_resultado(resultado){
	var tipo_mensaje = (resultado.result==true) ? 'success' : 'danger';
    return "<div class='row'><div class='col-lg-12 alert alert-"+tipo_mensaje+"'>"+resultado.msg+"</div></div>";
}


function data_ajax(path, form_recurso, elemento_resultado) {
    $.ajax({
        url: path,
        data: $(form_recurso).serialize(),
        method: 'POST',
        beforeSend: function(xhr) {
            $(elemento_resultado).html(create_loader());
//			$(elemento_resultado).html();
        }
    })
            .done(function(response) {
                $(elemento_resultado).html(response);
            })
            .fail(function(jqXHR, textStatus) {
                $(elemento_resultado).html("Ocurrió un error durante el proceso, inténtelo más tarde.");
            })
            .always(function() {
                remove_loader();
    });

}


/**
 *	Método que válida con javascript la extensión del archivo que se desea subir
 *	@param 	string	fileName 	Nombre del archivo
 *	@param	array	extension 	Arreglo de extensiones permitidas
 *	@return	boolean				true en caso de que la extensión del archivo se encuentre dentro de las permitidas
 */
function validate_extension(fileName, extension) {
    var file_extension = fileName.split('.').pop(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.

    for (var i = 0; i <= extension.length; i++) {
        if (extension[i] == file_extension) {
            return true; // valid file extension
        }
    }

    return false;
}

/**
 *	Método que crea un modal que muestra un mensaje
 *	@attribute 	title 			Título que se le colocará al modal
 *	@attribute 	mensaje			Mensaje que mostrará
 *	@return	false
 */
function mensaje_modal(mensaje, title) {
    if ($('#dataMessageModal').length > 0) {
        $('#dataMessageModal').remove();
    }
    var html = "<div class='modal fade' id='dataMessageModal' role='dialog' aria-labelledby='dataConfirmLabel'>" +
            "<div class='modal-dialog'>" +
            "<div class='modal-content'>" +
            "<div class='modal-header'>" +
            "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>" +
            "<h4 class='modal-title'>" + title + "</h4>" +
            "</div>" +
            "<div class='modal-body'>" +
            "<p>" + mensaje + "</p>" +
            "</div>" +
            "<div class='modal-footer'>" +
            "<button type='button' class='btn btn-default' aria-hidden='true' data-dismiss='modal'>Aceptar</button>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</div>";
    $('body').append(html);
    $('#dataMessageModal').modal({show: true});

    return false;
}

function dropdown(id, tag, act) {
    var val = $(id).val();
    // alert(val);
    $.ajax({
        url: site_url + act,
        data: {'campo': val},
        method: 'POST',
        dataType: 'JSON',
        beforeSend: function(xhr) {
            $(tag).html(create_loader());
        }

    })
            .done(function(response) {
                // alert(response.resultado);
                if (response.resultado == true) {
                    $(tag).html(response.data);
                    $('[data-toggle="tooltip"]').tooltip();
                } else {
                    $(tag).html(html_message(response.error, 'danger'));
                }
            })
            .fail(function(jqXHR, textStatus) {
                // alert(textStatus)
                $(tag).html(html_message("Ocurri&oacute; un error durante el proceso, inténtelo m&aacute;s tarde.", 'danger'));//+textStatus
            })
            .always(function() {
                remove_loader();
            });
}

function modal_static(is_static_modal) {
    var modal = $(document).getElementById('modal_censo');
    if (is_static_modal) {
        
    } else {

    }

}

function cargar_archivo(req, form){
    var archivo = $('#userfile_'+req).val();
    var carga = '#capa_carga_archivo_'+req;
    var error = "#error_carga_archivo_"+req;
    var tipo_comprobante = "";
    var ed = $('#extension_'+req).val();
    var extension_documentacion = ed.split(',');
    if ( $("#tipo_comprobante"+req).length ) {
        tipo_comprobante = $("#tipo_comprobante"+req).val();
    }
    //console.log(tipo_comprobante);
    if(archivo!=""){ //Validar que contenga archivo
        //console.log(archivo);
        //console.log(extension_documentacion);
        if(validate_extension(archivo, extension_documentacion)){ //Validar la extensión, definida en archivo de configuración
            var formData = new FormData($(form)[0]);
            formData.append('archivo', req);
            formData.append('tipo_comprobante', tipo_comprobante);
            console.log(formData);
            $.ajax({
                url: site_url+'/administracion/cargar_archivo',
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                beforeSend: function( xhr ) {
                    $(carga).hide();
                    $(error).html(create_loader());
                }
            })
            .done(function(response) {
                if(response.resultado==true){
                    $(carga).show();
                    //cargar_archivo_listado(val_id);
                    $(error).html(html_message("El archivo se ha cargado exitosamente.", 'success'));
                    $('#requisito_'+req).val("");
                    //link = "<button class='btn-xs btn-block btn-exito btn_requisito btn' value='Descargar' id='btn_d_3' type='button' name='btn_d_3'>Descargar</button>";
                    //link = "<a href='"+site_url+"/archivo/descarga/"+response.data.filename+"' class='btn-xs btn-block btn-exito btn_requisito btn'><span class='glyphicon glyphicon-download-alt text-right' placeholder='Descargar' title='Descargar' data-toggle='tooltip' data-placement='top'> </span></a>";
                    link = "<a href='"+site_url+"/archivo/descarga/"+response.data.filename+"' class='btn-xs turqueza'><span class='glyphicon glyphicon-download-alt text-right' placeholder='Descargar' title='Descargar' data-toggle='tooltip' data-placement='top' style='font-size:20px;'> </span></a>";
                    
                    
                    //link = "<a href='"+site_url+"/archivo/descarga/"+response.data.filename+"' class='btn-xs btn-block btn-exito btn_requisito btn'>Descargar</a>";
                    icon = "<span id='icon_"+req+"' class='input-group-addon glyphicon glyphicon-zoom-in azul' title='Por validar por el administrador' data-toggle='tooltip' data-placement='top'> </span>";
                    $("#link_descarga_"+req).html(link);
                    $("#icon_"+req).remove();
                    $(icon).insertBefore("#requisito_"+req);
                } else {
                    $(error).html(html_message(response.error, 'danger'));
                }
            })
            .fail(function( jqXHR, textStatus ) {
                $(error).html(html_message("Ocurrió un error durante el proceso, inténtelo más tarde.", 'danger'));
            })
            .always(function() {
                remove_loader();
                $(carga).show();
                $('#evidencia_archivo').val('');
                $('[data-toggle="tooltip"]').tooltip();
            });
        } else {
            $(error).html(html_message("El archivo seleccionado no esta permitido. Por favor elija un archivo con alguna de las siguientes extensiones: "+extension_documentacion, 'danger'));
        }
    } else {
        $(error).html(create_loader());
        $(error).html(html_message("Debe seleccionar un archivo para ser almacenado. Por favor elija uno.", 'danger'));
    }
}
