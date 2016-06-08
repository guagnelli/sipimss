<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['salt'] = "B0no5"; ///SALT

$config['modulos_no_sesion'] = array(
                           'login' => array('index','cerrar_session', 'cerrar_session_ajax'), 
                           'registro' => array('*'), 
                           'pagina_no_encontrada' => array('index'),
                           'recuperar_contrasenia' => '*'
                           );
$config['modulos_sesion_generales'] = array(
                           'rol' => '*' 
                           );

/////Ruta de solicitudes
$config['ruta_documentacion'] = $_SERVER["DOCUMENT_ROOT"] . "/sipimss_bonos/assets/files/archivos_bono/";
$config['ruta_documentacion_web'] = asset_url() . 'files/archivos_bono/'; //base_url()."assets/files/solicitudes/";

$config['tiempo_fuerza_bruta'] = 60 * 60; //3600 = 1 hora => Tiempo válido para chequeo de fuerza bruta

$config['intentos_fuerza_bruta'] = 10; ///Número de intentos válidos durante tiempo 'tiempo_fuerza_bruta'

$config['tiempo_recuperar_contrasenia'] = 60 * 60 * 24; //3600 * 24 = 86400 = 1 día => Límite de tiempo que estará activo el link

$config['meses'] = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

$config['rol_admin'] = array('COORDINADOR' => array('id' => 1, 'text' => 'Coordinador'), 'VALIDADOR' => array('id' => 2, 'text' => 'Validador'), 'TITULAR' => array('id' => 3, 'text' => 'Titular del programa'));

$config['bon_pro_eva_min'] = (float) 80.00;

$config['bon_sum_act_min'] = 26;

$config['categoria_participante'] = array('36112580', '35312180');
//, 'attributes' => array('class' => 'btn btn-info btn-sm espacio'
$config['listado_tareas'] = array(
    1 => array('id' => 'btn_solicitud_tarjeton', 'value' => 'Solicitar tarjetón', 'type' => 'button', 'attributes' => array('class' => 'btn btn-sm btn-success btn-block espacio')),
    2 => array('id' => 'btn_registro_tarjeton', 'value' => 'Capturar tarjetón', 'type' => 'button', 'attributes' => array('class' => 'btn btn-sm btn-info  btn-block  espacio')),
    3 => array('id' => 'btn_modificar_tarjeton', 'value' => 'Corregir tarjetón', 'type' => 'button', 'attributes' => array('class' => 'btn btn-sm btn-info  btn-block espacio')),
    4 => array('id' => 'btn_env_seleccion', 'value' => 'Validar candidato seleccionados', 'type' => 'button', 'attributes' => array('class' => 'btn btn-default btn-sm espacio pull-right')), /*   actualmente esta opcion no esta en el alcance las validaciones se tendran que hacer individuales   */
    5 => array('id' => 'btn_term_seleccion', 'value' => 'Terminar seleccion de candidatos', 'type' => 'button', 'attributes' => array('class' => 'btn btn-success btn-sm espacio pull-right', 'data-toggle' => "modal", 'data-target' => "#reporteBeneficiadosBono")),
    6 => array('id' => 'btn_export_exel', 'value' => 'Exportar a excel', 'type' => 'submit', 'attributes' => array('class' => 'btn btn-info btn-sm espacio pull-right')),
    7 => array('id' => 'btn_val_titular', 'type' => 'button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'value' => '<i class=/"fa fa-check/"></i>', 'title' => 'Validar candidato por titular', 'class' => 'btn btn-success btn-sm pull-right'),
    8 => array('id' => 'btn_val_ja', 'value' => 'Validar candidato por jefe area', 'type' => 'button', 'attributes' => array('class' => 'btn btn-info btn-sm espacio', 'data-toggle' => 'tooltip', 'title' => 'Validar candidato por jefe area')),
    9 => array('id' => 'btn_env_correccion', 'value' => 'Enviar a corrección', 'type' => 'button', 'title' => 'Enviar a corrección', 'attributes' => array('class' => 'btn btn-info btn-sm espacio', 'data-toggle' => 'tooltip', 'onclick' => "data_ajax(site_url+\'/bonos_titular/get_data_ajax_correccion\', \'null\', \'#modal_content\')")),
    //    8 => array('id' => 'btn_val_ja', 'value' => 'Validar candidato por jefe area', 'type' => 'button', 'attributes' => array('class' => 'btn btn-info btn-sm espacio', 'data-toggle' => 'tooltip', 'title' => 'Validar candidato por jefe area')),
    //    9 => array('id' => 'btn_env_correccion', 'value' => 'Enviar a corrección', 'type' => 'button', 'title' => 'Enviar a corrección', 'attributes' => array('class' => 'btn btn-info btn-sm espacio', 'data-toggle' => 'tooltip',  'onclick' => "data_ajax(site_url+\'/bonos_titular/get_data_ajax_correccion\', \'null\', \'#modal_content\')")),
    10 => array('type' => 'button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Enviar a revisión del validador', 'class' => 'btn btn-success btn-sm pull-right'),
    11 => array('title' => 'Agregar evaluación', 'value' => 'Agregar evaluación'),
    12 => array('title' => 'Coorregir evaluación'),
    13 => array('type' => 'label', 'value' => 'Cumplio con todos los filtros de validación', 'class' => 'btn btn-success btn-sm pull-right'),
    14 => array('value' => ' Existe(n) [field] empleado(s) validados por el jefe de área', 'cantidad' => 0),
    15 => array('value' => ' Existe(n) [field] empleado(s) validados por el titular, Puede terminar el proceso de selección de candidatos', 'cantidad' => 0)
);



$config['estados_bono'] = array(
    1 => array('value' => 'NINGUNO', 'sub_value' => 'No aprobado por Faltas', 'text' => 'No entra en categoría',
        'tareas' => array(), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()),
    2 => array('value' => 'CATEGORIA', 'sub_value' => 'No aprobado por Actividad', 'text' => 'Categorías de docentes participantes',
        'tareas' => array(), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()),
    3 => array('value' => 'ACTIVIDAD', 'sub_value' => 'Filtro de actuación', 'text' => 'Suma de actividad docente mayor a 25 puntos',
        'tareas' => array(11, 12), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()), // botones que se activan: registro de actuacion(evaluacion), modifica actuacion(corrige), y si existe almenos una actuacion y es mayor a 80.0 activa el boton solicitud de tarjeton
    4 => array('value' => 'ACTUACION', 'sub_value' => 'Filtro de tarjetón', 'text' => 'Promedio de actuación mayor a 80.00',
        'tareas' => array(1, 2, 3, 11, 12), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()), // botones si la actuacion si se cumplio... -> solicitud de tarjeton si no era la quincena correcta, registro de tarjeton, y modifica tarjeton(corrige)
    5 => array('value' => 'INCIDENCIA', 'sub_value' => 'Sin faltas/Por validar/Revisión por Coordinador', 'text' => 'Docentes que no presentaron incidencias',
        'tareas' => array(3, 10), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()), // si el candidato cumplio el requisito de incidencia se activa el boton de validar por jefe de area, y el boton de enviar a correccion si es el caso
    6 => array('value' => 'VALIDADO_JA', 'sub_value' => 'Validado por Jefe de área', 'text' => 'Validación de Jefe de Area',
        'tareas' => array(7, 9), 'no_acceso_tipo_usuarios' => array('VALIDADOR'), 'validacion_estado_anterior' => array(),
        'validacion_estado_anterior' => array()),
    7 => array('value' => 'CORRECCION_TARJETON', 'sub_value' => 'Corrección de tarjetón', 'text' => 'Corrección de tarjetón',
        'tareas' => array(1, 2, 3, 10), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()),
    8 => array('value' => 'CORRECCION_ENCUESTA', 'sub_value' => 'Corrección de encuesta', 'text' => 'Corrección de Actuación',
        'tareas' => array(11, 12, 10), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()),
    9 => array('value' => 'VALIDADO_TITULAR', 'sub_value' => 'Validado por Titular', 'text' => 'Validación del titular',
        'tareas' => array(13), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()),
    10 => array('value' => 'REVISION', 'sub_value' => 'Revisión por Jefe de área', 'text' => 'Validación del titular',
        'tareas' => array(8, 9), 'no_acceso_tipo_usuarios' => array(), 'validacion_estado_anterior' => array()),
);



$config['usuarios_bono'] = array(
    'COORDINADOR' => array('id' => 1, 'permisos' => array(6, 1, 2, 3, 11, 12, 10, 13)),
    'VALIDADOR' => array('id' => 2, 'permisos' => array(6, 8, 9, 13)),
    'TITULAR' => array('id' => 3, 'permisos' => array(6, 5, 9, 7, 4, 13, 14, 15)));

$config['buscador_listado'] = array(6, 5, 4, 14, 15);
//$config['buscador_listado'] = array(                     'vista'=>array(array('vista'=>1,10,13,14,15,16,17,18,19)));

$config['alert_msg'] = array(
                'SUCCESS' => array('id_msg' => 1 , 'class' => 'success') ,
                'DANGER' => array('id_msg' => 2 , 'class' => 'danger'),
                'WARNING' => array('id_msg' => 3 , 'class' => 'warning'),
                'INFO' => array('id_msg' => 4 , 'class' => 'info')
              );

$config['parametros_bitacora'] = array('USUARIO_CVE' => 'NULL', 'BIT_VALORES' => 'NULL',
    'BIT_IP' => 'NULL', 'BIT_RUTA' => 'NULL', 'MODULO_CVE' => 'NULL');
$config['parametros_log'] = array('USUARIO_CVE' => 'NULL', 'LOG_INI_SES_IP' => 'NULL', 
    'INICIO_SATISFACTORIO'=>'NULL');
