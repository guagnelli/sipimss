var menu_busqueda_validar_censo = new Object();
menu_busqueda_validar_censo['matricula'] = 'Matrícula';
menu_busqueda_validar_censo['nombre'] = 'Nombre del empleado';
menu_busqueda_validar_censo['clavecategoria'] = 'Categoría';


function funcion_buscar_docentes_validar() {
    var path = site_url + '/evaluacion_curricular_validar/data_buscar_docentes_validar_evaluacion_curr/0';
//    var val_post = $('#form_busqueda_docentes_validar').serialize();
    data_ajax(path, '#form_busqueda_evaluacion_curricular_validar', '#div_result_docentes_validacion_evaluacion');
}

/**
 * 
 * @param {type} name Menu de opciónes de filtro
 * @returns {undefined}
 */
function funcion_menu_tipo_busqueda_validar_censo(name) {
    var text = menu_busqueda_validar_censo[name];//Busca en el hashmap el nombre indicado
    $("#menu_select").val(name);//Modifica el valor del menu
    $("#btn_buscar_por").text(text);//Cambia el texto del botón
    $("#btn_buscar_por").append('<span class="caret"> </span>');//Agregar span al botón para mostrar icono flechita
    $("#buscador_docente").attr('data-original-title', 'Buscar por ' + text);//Cambia el texto del la caja de texto 
    $("#btn_buscar_b").attr('data-original-title', 'Buscar por ' + text);//Cambia el texto del botón
}

function runScript_busqueda_val(e) {
    if (e.keyCode == 13) {
//      var tb = document.getElementById("scriptBox");
//      eval(tb.value);
        $("#btn_buscar_docentes_validacion").trigger("click");//Dispara el onclic del botón buscar validador en el sied
        return false;
    }
}

/**
 * Carga el valor de 
 * @param {type} element
 * @returns {undefined}
 */
function funcion_ver_validacion_empleado(element) {
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var empcve = button_obj.data('empcve');
    var matricula = button_obj.data('matricula');
    var estval = button_obj.data('estval');
    var histvalcve = button_obj.data('histvalcve');
    var solicitud_cve = button_obj.data('solicitudcve');
    var convocatoria_cve = button_obj.data('convocatoriacve');
    var usuario_cve = button_obj.data('usuariocve');
    var idrow = button_obj.data('usuariocve');
    //Remover contenido de un div 
    $('#select_perfil_validar').empty();
    var obj_post = {empcve: empcve, matricula: matricula, estval: estval, usuario_cve: usuario_cve,
        histvalcve: histvalcve, solicitud_cve: solicitud_cve, convocatoria_cve: convocatoria_cve};
    data_ajax_post(site_url + '/evaluacion_curricular_validar/seccion_index', null, '#select_perfil_validar_evaluacion', obj_post);
}

function funcion_cerrar_validacion_empleado(element) {
//    alert('jsahjhdadas');
    $('#select_perfil_validar').empty();
    data_ajax_post(site_url + '/validacion_censo_profesores/seccion_delete_datos_validado', null, null);
}

function ver_comentario_estado_doc(element) {
    var obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var hist_val_cve = obj.data('histvalcve');
    var formData = {hist_val_cve: hist_val_cve};
    data_ajax_post(site_url + '/evaluacion_curricular_validar/ver_comentario_estado', null, '#modal_content', formData);
}

function seleccionar_deseleccionar_profesionalizacion(element) {
    seleccionar_todos_checkbox_tabla('tabla_resultados_validacion_evaluacion', '#check_seleccionar_todo');
}

function seleccionar_deseleccionar_tablas(element) {
    var obj = $(element);
    var tabla = obj.data('tabla');
    var check = obj.data('check');
//    alert(tabla + check);
    seleccionar_todos_checkbox_tabla(tabla.toString(), '#' + check.toString());
}


function funcion_cerrar_validacion_empleado(element) {
//    alert('jsahjhdadas');
    $('#select_perfil_validar_evaluacion').empty();
    data_ajax_post(site_url + '/evaluacion_curricular_validar/seccion_delete_datos_validado', null, null);
}

function ver_curso(elemento) {
    var curso = $(elemento).attr('data-value');
    var seccion = $(elemento).attr('data-seccion');

    data_ajax(site_url + '/perfil_registro/' + seccion + '/' + curso, null, '#modal_content');
}