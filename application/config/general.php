<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['salt'] = "B0no5"; ///SALT

$config['superadmin'] = 5;

$config['upload_config'] = array(
        'comprobantes'=>array(
            'upload_path'=>'./assets/files/comprobantes/',
            'allowed_types'=>'pdf',
            'remove_spaces'=>TRUE,
            'max_size'=>1024 * 15,
            'detect_mime'=>true,
            'file_name'=>'tmp_comprobante',
        ),
    );

$config['extension_comprobante'] = array('pdf');

$config['modulos_no_sesion'] = array(
    'login' => array('index', 'cerrar_session', 'cerrar_session_ajax'),
    'registro' => array('*'),
    'account' => array('*'),
    'pagina_no_encontrada' => array('index'),
    'recuperar_contrasenia' => '*',
    'captcha' => '*'
);
$config['modulos_sesion_generales'] = array(
    'login' => array('cerrar_session', 'cerrar_session_ajax'),
    'rol' => '*',
    'pagina_no_encontrada' => array('index'),
    'pruebas' => '*'
);

$config['institucion'] = array('avala'=>'A', 'imparte'=>'I');

$config['categorias_designar_validador'] = array('36112580','35312180');

/////Ruta de solicitudes
$config['ruta_documentacion'] = $_SERVER["DOCUMENT_ROOT"] . "/sipimss_bonos/assets/files/archivos_bono/";
$config['ruta_documentacion_web'] = asset_url() . 'files/archivos_bono/'; //base_url()."assets/files/solicitudes/";

$config['tiempo_eliminar_archivo'] = 60 * 10; //3600 = 1 hora => Tiempo que no será considerado para eliminación de archivo. Referencia administración/eliminar_archivos

$config['numero_registros_eliminar'] = 100;

$config['tiempo_fuerza_bruta'] = 60 * 60; //3600 = 1 hora => Tiempo válido para chequeo de fuerza bruta

$config['intentos_fuerza_bruta'] = 10; ///Número de intentos válidos durante tiempo 'tiempo_fuerza_bruta'

$config['tiempo_recuperar_contrasenia'] = 60 * 60 * 24; //3600 * 24 = 86400 = 1 día => Límite de tiempo que estará activo el link

$config['meses'] = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

$config['rol_admin'] = array('COORDINADOR' => array('id' => 1, 'text' => 'Coordinador'), 'VALIDADOR' => array('id' => 2, 'text' => 'Validador'), 'TITULAR' => array('id' => 3, 'text' => 'Titular del programa'));

$config['bon_pro_eva_min'] = (float) 80.00;

$config['bon_sum_act_min'] = 26;

$config['cestado_usuario'] = array('ACTIVO'=>array('id'=>1), 'INACTIVO'=>array('id'=>2), 'RESTABLECERCONTRASENIA'=>array('id'=>3), 'RESTABLECERCMA'=>array('id'=>4));

$config['USU_GENERO'] = array('M'=>'Masculino', 'F'=>'Femenino', 'H'=>'Masculino');

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
    'SUCCESS' => array('id_msg' => 1, 'class' => 'success'),
    'DANGER' => array('id_msg' => 2, 'class' => 'danger'),
    'WARNING' => array('id_msg' => 3, 'class' => 'warning'),
    'INFO' => array('id_msg' => 4, 'class' => 'info')
);

$config['tipo_comision'] = array(
    'DIRECCION_TESIS' => array('id'=>1),
    'COMITE_EDUCACION' => array('id'=>3),
    'SINODAL_EXAMEN' => array('id'=>4),
    'COORDINADOR_TUTORES' => array('id'=>5),
    'COORDINADOR_CURSO' => array('id'=>6)
);

$config['tipo_curso'] = array(
    'FORMACION_INICIAL' => array('id'=>1),
    'FORMACION_CONTINUA' => array('id'=>2),
    'EDUCACION_CONTINUA' => array('id'=>3),
    'CURSO_INTERACTIVO' => array('id'=>4)
);

$config['parametros_bitacora'] = array(
        'USUARIO_CVE' => 'NULL', 
        'BIT_OPERACION' => 'NULL',
        'BIT_IP' => 'NULL', 
        'BIT_RUTA' => 'NULL', 
        'MODULO_CVE' => 'NULL',
        'ENTIDAD' => 'NULL', 
        'REGISTRO_ENTIDAD_CVE' => 'NULL',
        'PARAMETROS_JSON' => 'NULL');
$config['parametros_log'] = array('USUARIO_CVE' => 'NULL', 'LOG_INI_SES_IP' => 'NULL',
    'INICIO_SATISFACTORIO' => 'NULL');

$config['catalogos_indexados'] = array(//Catógos generales que existen actualmente y su identificación
    1 => 'cmodalidad',
    2 => 'licenciatura',
    3 => 'cmodulo',
    4 => 'carea',
    5 => 'cmateria',
    6 => 'ccurso',
    7 => 'cinstitucion_avala',
    8 => 'ctipo_actividad_docente',
    9 => 'crol_desempenia',
    10 => 'ctipo_comprobante',
    11 => 'ctipo_licenciatura',
    12 => 'ctipo_curso',
    13 => 'ctipo_especialidad',
    14 => 'ctipo_formacion_profesional',
    15 => 'ctipo_participacion',
    16 => 'ctipo_material',
    17 => 'cestado_civil',
    18 => 'cejercicio_predominante',
    19 => 'cejercicio_profesional',
);
//ejemplo para enviar un where $condiciones = array(enum_ecg::cejercicio_predominante=>array('EJER_PREDOMI_CVE '=>'2'));                  
$config['catalogos_definidos'] = array(//Catógos generales que existen actualmente y su identificación
    'cmodalidad' => array('id' => 'MODALIDAD_CVE', 'nombre' => 'MOD_NOMBRE' , 'where' => null),
    'licenciatura' => array('id' => 'LICENCIATURA_CVE', 'nombre' => 'LIC_NOMBRE' , 'where' => null),
    'cmodulo' => array('id' => 'MODULO_CVE', 'nombre' => 'MODULO_NOMBRE' , 'where' => null),
    'carea' => array('id' => 'AREA_CVE', 'nombre' => 'AREA_NOMBRE' , 'where' => null),
    'cmateria' => array('id' => 'MATERIA_CVE', 'nombre' => 'MATERIA_NOMBRE' , 'where' => null),
    'ccurso' => array('id' => 'CURSO_CVE', 'nombre' => 'CUR_NOMBRE' , 'where' => null),
    'cinstitucion_avala' => array('id' => 'INS_AVALA_CVE', 'nombre' => 'IA_NOMBRE' , 'where' => null),
    'ctipo_actividad_docente' => array('id' => 'TIP_ACT_DOC_CVE', 'nombre' => 'TIP_ACT_DOC_NOMBRE' , 'where' => null),
    'crol_desempenia' => array('id' => 'ROL_DESEMPENIA_CVE', 'nombre' => 'ROL_DESEMPENIA' , 'where' => null),
    'ctipo_comprobante' => array('id' => 'TIPO_COMPROBANTE_CVE', 'nombre' => 'TIP_COM_NOMBRE' , 'where' => null),
    'ctipo_licenciatura' => array('id' => 'TIP_LICENCIATURA_CVE', 'nombre' => 'TIP_LIC_NOMBRE' , 'where' => null),
    'ctipo_curso' => array('id' => 'TIP_CURSO_CVE', 'nombre' => 'TIP_CUR_NOMBRE' , 'where' => null),
    'ctipo_especialidad' => array('id' => 'TIP_ESP_MEDICA_CVE', 'nombre' => 'TIP_ESP_MED_NOMBRE' , 'where' => null),
    'ctipo_formacion_profesional' => array('id' => 'TIP_FOR_PROF_CVE', 'nombre' => 'TIP_FOR_PRO_NOMBRE' , 'where' => null),
    'ctipo_participacion' => array('id' => 'TIP_PARTICIPACION_CVE', 'nombre' => 'TIP_PAR_NOMBRE' , 'where' => null),
    'ctipo_material' => array('id' => 'TIP_MATERIAL_CVE', 'nombre' => 'TIP_MAT_NOMBRE' , 'where' => null),
    'cestado_civil' => array('id' => 'CESTADO_CIVIL_CVE', 'nombre' => 'EDO_CIV_NOMBRE' , 'where' => null),
    'cejercicio_predominante' => array('id' => 'EJER_PREDOMI_CVE', 'nombre' => 'EJE_PRE_NOMBRE' , 'where' => null),
    'cejercicio_profesional' => array('id' => 'EJE_PRO_CVE', 'nombre' => 'EJE_PRO_NOMBRE' , 'where' => null),
    'cmedio_divulgacion' => array('id' => 'MED_DIVULGACION_CVE', 'nombre' => 'MED_DIV_NOMBRE' , 'where' => null),
    'ctipo_estudio' => array('id' => 'TIP_ESTUDIO_CVE', 'nombre' => 'TIP_EST_NOMBRE' , 'where' => null),
    'cdelegacion' => array('id' => 'DELEGACION_CVE', 'nombre' => 'DEL_NOMBRE' , 'where' => null),
    'ccategoria' => array('id' => 'des_clave', 'nombre' => 'nom_categoria' , 'where' => null),
    'cdepartamento' => array('id' => 'departamento_cve', 'nombre' => 'dep_nombre' , 'where' => null),
    'crol' => array('id' => 'ROL_CVE', 'nombre' => 'ROL_NOMBRE' , 'where' => null),
    'modulo' => array('id' => 'MODULO_CVE', 'nombre' => 'MOD_NOMBRE' , 'where' => null),
    'cestado_usuario' => array('id' => 'ESTADO_USUARIO_CVE', 'nombre' => 'EDO_USUARIO_DESC' , 'where' => null),
    'cunidad' => array('id' => 'UNIDAD_CVE', 'nombre' => 'UNI_DESC' , 'where' => null),
    'cestado_validacion' => array('id' => 'EST_VALIDACION_CVE', 'nombre' => 'EST_VALIDA_DESC' , 'where' => null),
    'comision_area' => array('id' => 'COM_AREA_CVE', 'nombre' => 'COM_ARE_NOMBRE' , 'where' => null),
    'cnivel_academico' => array('id' => 'NIV_ACADEMICO_CVE', 'nombre' => 'NIV_ACA_NOMBRE' , 'where' => null),
    'ctipo_comision' => array('id' => 'TIP_COMISION_CVE', 'nombre' => 'TIP_COM_NOMBRE', 'where' => 'IS_COMISION_ACADEMICA'),
    'cmotivo_becado' => array('id' => 'MOTIVO_BECADO_CVE', 'nombre' => 'MOT_BEC_NOMBRE', 'where' => null),
    'cbeca_interrumpida' => array('id' => 'BECA_INTERRIMPIDA_CVE', 'nombre' => 'MSG_BEC_INTE', 'where' => null),
    'cclase_beca' => array('id' => 'CLA_BECA_CVE', 'nombre' => 'CLA_BEC_NOMBRE', 'where' => null),
    'csubtipo_formacion_profesional' => array('id'=>'SUB_FOR_PRO_CVE', 'nombre'=>'SUB_FOR_PRO_NOMBRE', 'where'=>null),
    'ctipo_formacion_salud' => array('id'=>'TIP_FORM_SALUD_CVE', 'nombre'=>'TIP_FORM_SALUD_NOMBRE', 'where'=>null),
    'csubtipo_formacion_salud' => array('id'=>'CSUBTIP_FORM_SALUD_CVE', 'nombre'=>'SUBTIP_NOMBRE', 'where'=>null),
    'ctematica' => array('id'=>'TEMATICA_CVE', 'nombre'=>'TEM_NOMBRE', 'where'=>null),
     'cvalidacion_estado' => array('id' => 'VAL_ESTADO_CVE', 'nombre' => 'VAL_EST_NOMBRE' , 'where' => null),
     'cvalidacion_curso_estado' => array('id'=>'VAL_CUR_EST_CVE', 'nombre'=>'VAl_CUR_EST_NOMBRE', 'where'=>null),
    '' => array('id' => '', 'nombre' => '' , 'where' => null),
);

$config['actividad_docente_componentes'] = array(//Arreglo que se utilizará para leer las configuraciones de cada formularío de actividad docente
    0 => array('texto' => '', 'tabla_guardado' => '', 'llave_primaria' => '', 'vista' => '', 'validaciones' => '', 'catalogos_indexados' => array(), 'validaciones_extra' => array()),
    1 => array('texto' => 'Ciclos Clínicos', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_ciclos_clinicos', 'validaciones' => 'form_ccl', 'catalogos_indexados' => array(Enum_ecg::cmodalidad, Enum_ecg::licenciatura, Enum_ecg::ccurso, Enum_ecg::cinstitucion_avala, Enum_ecg::crol_desempenia), 'validaciones_extra' => array('duracion', 'pago_extra')),
    2 => array('texto' => 'Internado Médico', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_internado_medico', 'validaciones' => 'form_ime', 'catalogos_indexados' => array(Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodulo, Enum_ecg::cmodalidad), 'validaciones_extra' => array('pago_extra')),
    3 => array('texto' => 'Servicio Social', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_servicio_social', 'validaciones' => 'form_sso', 'catalogos_indexados' => array(Enum_ecg::cmodalidad, Enum_ecg::licenciatura, Enum_ecg::cinstitucion_avala, Enum_ecg::crol_desempenia), 'validaciones_extra' => array('pago_extra')),
    4 => array('texto' => 'Licenciatura', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_licenciatura', 'validaciones' => 'form_lic', 'catalogos_indexados' => array(Enum_ecg::cmodalidad, Enum_ecg::licenciatura, Enum_ecg::ccurso, Enum_ecg::cinstitucion_avala, Enum_ecg::crol_desempenia), 'validaciones_extra' => array('duracion', 'pago_extra')),
    5 => array('texto' => 'Especialidad Médica', 'tabla_guardado' => 'emp_esp_medica', 'llave_primaria' => 'EMP_ESP_MEDICA_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_especialidad_medica', 'validaciones' => 'form_eme', 'catalogos_indexados' => array(Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodulo, Enum_ecg::cmodalidad, Enum_ecg::ctipo_especialidad), 'validaciones_extra' => array('pago_extra')),
    6 => array('texto' => 'Maestría', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_maestria', 'validaciones' => 'form_mas', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ccurso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad), 'validaciones_extra' => array('duracion', 'pago_extra')),
    7 => array('texto' => 'Doctorado', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_doctorado', 'validaciones' => 'form_doc', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ccurso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad), 'validaciones_extra' => array('duracion', 'pago_extra')),
    8 => array('texto' => 'Técnico', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_tecnico', 'validaciones' => 'form_tec', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ccurso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad), 'validaciones_extra' => array('duracion', 'pago_extra')),
    9 => array('texto' => 'Postécnico', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_postecnico', 'validaciones' => 'form_pos', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ctipo_curso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad), 'where'=>array(Enum_ecg::ctipo_curso=>array('TIP_CURSO_CVE'=>array(5,6,7,8))), 'where_grup'=>array(Enum_ecg::ctipo_curso=>'OR'), 'validaciones_extra' => array('duracion', 'pago_extra')),
    10 => array('texto' => 'Educación continua', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_educacion_continua', 'validaciones' => 'form_eco', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ccurso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad), 'validaciones_extra' => array('duracion', 'pago_extra')),
    11 => array('texto' => 'Directivos para la salud', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_directivos_para_la_salud', 'validaciones' => 'form_dplsa', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ccurso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad), 'validaciones_extra' => array('duracion', 'pago_extra')),
    12 => array('texto' => 'Educación / Formación de Profesores', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_educacion_formacion_de_profesores', 'validaciones' => 'form_efdp', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ctipo_curso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad, Enum_ecg::ctipo_formacion_profesional), 'where'=>array(Enum_ecg::ctipo_curso=>array('TIP_CURSO_CVE'=>array(1,3))), 'where_grup'=>array(Enum_ecg::ctipo_curso=>'OR'), 'validaciones_extra' => array('duracion', 'pago_extra')),
    13 => array('texto' => 'Formacionde Profesoresen Investigación', 'tabla_guardado' => 'emp_actividad_docente', 'llave_primaria' => 'EMP_ACT_DOCENTE_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_formacion_de_profesores_en_investigacion', 'validaciones' => 'form_fdpei', 'catalogos_indexados' => array(Enum_ecg::carea, Enum_ecg::ccurso, Enum_ecg::crol_desempenia, Enum_ecg::cinstitucion_avala, Enum_ecg::cmodalidad), 'validaciones_extra' => array('duracion', 'pago_extra')),
    14 => array('texto' => 'Educacióna Distancia', 'tabla_guardado' => 'emp_educacion_distancia', 'llave_primaria' => 'EMP_EDU_DISTANCIA_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_educacion_a_distancia', 'validaciones' => 'form_ead', 'catalogos_indexados' => array(Enum_ecg::crol_desempenia, Enum_ecg::ctipo_curso), 'where'=>array(Enum_ecg::ctipo_curso=>array('TIP_CURSO_CVE'=>array(9,10,11))), 'where_grup'=>array(Enum_ecg::ctipo_curso=>'OR'),'validaciones_extra' => array('duracion', 'ctipo_curso')),
    15 => array('texto' => '', 'tabla_guardado' => 'emp_educacion_distancia', 'llave_primaria' => 'EMP_EDU_DISTANCIA_CVE', 'vista' => 'perfil/actividad_docente/actividad_d_actividades_de_investigacion_educativa', 'validaciones' => 'form_adie', 'catalogos_indexados' => array(), 'validaciones_extra' => array('duracion'))
);

$config['emp_actividad_docente'] = array(
//    'ctipo_actividad_docente' => array('select' => 'TIP_ACT_DOC_CVE', 'insert' => 'TIP_ACT_DOC_CVE'),
    'hora_dedicadas' => array('select' => 'EAD_DURACION', 'insert' => 'EAD_DURACION'),
    'fecha_inicio_pick' => array('select' => 'EAD_FCH_INICIO', 'insert' => 'EAD_FCH_INICIO'),
    'fecha_fin_pick' => array('select' => 'EAD_FCH_FIN', 'insert' => 'EAD_FCH_FIN'),
    'periodo_fecha_inicio_pick' => array('select' => 'EAD_FCH_INICIO', 'insert' => 'EAD_FCH_INICIO'),
    'periodo_fecha_fin_pick' => array('select' => 'EAD_FCH_FIN', 'insert' => 'EAD_FCH_FIN'),
    'cmodalidad' => array('select' => 'MODALIDAD_CVE', 'insert' => 'MODALIDAD_CVE'),
    'licenciatura' => array('select' => 'LICENCIATURA_CVE', 'insert' => 'LICENCIATURA_CVE'),
    'crol_desempenia' => array('select' => 'ROL_DESEMPENIA_CVE', 'insert' => 'ROL_DESEMPENIA_CVE'),
    'cinstitucion_avala' => array('select' => 'INS_AVALA_CVE', 'insert' => 'INS_AVALA_CVE'),
    'ctipo_curso' => array('select' => '', 'insert' => ''),
    'ccurso' => array('select' => 'CURSO_CVE', 'insert' => 'CURSO_CVE'),
    'cmateria' => array('select' => 'TIP_MATERIAL_CVE', 'insert' => 'TIP_MATERIAL_CVE'),
    'carea' => array('select' => 'AREA_CVE', 'insert' => 'AREA_CVE'),
    'cmodulo' => array('select' => 'MODULO_CVE', 'insert' => 'MODULO_CVE'),
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'),
    'pago_extra' => array('select' => 'EAD_EXTRA_INS_AVALA', 'insert' => 'EAD_EXTRA_INS_AVALA'),
//    'actividad_docente_general' => array('select' => 'ACT_DOC_GRAL_CVE', 'insert' => 'ACT_DOC_GRAL_CVE'),
//    'actividad_docente_gral' => array('select' => 'ACT_DOC_GRAL_CVE', 'insert' => 'ACT_DOC_GRAL_CVE'),
    'actividad_anios_dedicados_docencia' => array('select' => 'EAD_ANIO_CURSO', 'insert' => 'EAD_ANIO_CURSO'),
    'nombre_curso' => array('select' => 'EAD_NOMBRE_CURSO', 'insert' => 'EAD_NOMBRE_CURSO'),
    'curso_principal' => array('select' => 'EAD_CURSO_PRIN_IMPARTE', 'insert' => 'EAD_CURSO_PRIN_IMPARTE'),
    'nombre_materia_impartio' => array('select' => 'EAD_NOMBRE_MATERIA_IMPARTIO', 'insert' => 'EAD_NOMBRE_MATERIA_IMPARTIO'),
    'ctipo_formacion_profesional' => array('select' => 'TIP_FOR_PROF_CVE', 'insert' => 'TIP_FOR_PROF_CVE'),
);


$config['emp_educacion_distancia'] = array(
    'hora_dedicadas' => array('select' => 'EED_DURACION', 'insert' => 'EED_DURACION'),
//    'empleado_cve' => array('select' => 'EMPLEADO_CVE', 'insert' => 'EMPLEADO_CVE'),
    'crol_desempenia' => array('select' => 'ROL_DESEMPENIA_CVE', 'insert' => 'ROL_DESEMPENIA_CVE'),
    'fecha_fin_pick' => array('select' => 'EED_FCH_FIN', 'insert' => 'EED_FCH_FIN'),
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'),
    'is_curso_tutorizado' => array('select' => 'CLAVE_CURSO', 'insert' => 'CLAVE_CURSO'),
    'fecha_inicio_pick' => array('select' => 'EDD_FCH_INICIO', 'insert' => 'EDD_FCH_INICIO'),
    'actividad_anios_dedicados_docencia' => array('select' => 'EDD_CUR_ANIO', 'insert' => 'EDD_CUR_ANIO'),
    'is_curso_tutorizado' => array('select' => 'IS_CURSO_TUTURIZADO', 'insert' => 'IS_CURSO_TUTURIZADO'),
    '' => array('select' => 'EDD_CUR_PUN_ROL', 'insert' => 'EDD_CUR_PUN_ROL'),
    '' => array('select' => 'EDD_CUR_PUN_ALCANCE', 'insert' => 'EDD_CUR_PUN_ALCANCE'),
    '' => array('select' => 'EDD_CUR_PUN_DURACION', 'insert' => 'EDD_CUR_PUN_DURACION'),
    '' => array('select' => 'EDD_CUR_SUM_TOT_ACT', 'insert' => 'EDD_CUR_SUM_TOT_ACT'),
    '' => array('select' => 'EDD_CUR_PROM_EVALUACIONES', 'insert' => 'EDD_CUR_PROM_EVALUACIONES'),
//    'ctipo_actividad_docente' => array('select' => 'TIP_ACT_DOC_CVE', 'insert' => 'TIP_ACT_DOC_CVE'),
    'folio_constancia' => array('select' => 'FOLIO_CONSTANCIA', 'insert' => 'FOLIO_CONSTANCIA'),
    'ctipo_curso' => array('select' => 'TIPO_CURSO_CVE', 'insert' => 'TIPO_CURSO_CVE'),
    'nombre_curso' => array('select' => 'EED_NOMBRE_CURSO', 'insert' => 'EED_NOMBRE_CURSO'),
//    'actividad_docente_general' => array('select' => 'ACT_DOC_GRAL_CVE', 'insert' => 'ACT_DOC_GRAL_CVE'),
);

$config['emp_esp_medica'] = array(
    'ctipo_especialidad' => array('select' => 'TIP_ESP_MEDICA_CVE', 'insert' => 'TIP_ESP_MEDICA_CVE'),
    'crol_desempenia' => array('select' => 'ROL_DESEMPENIA_CVE', 'insert' => 'ROL_DESEMPENIA_CVE'),
    'cinstitucion_avala' => array('select' => 'INS_AVALA_CVE', 'insert' => 'INS_AVALA_CVE'),
    'cmodalidad' => array('select' => 'MODALIDAD_CVE', 'insert' => 'MODALIDAD_CVE'),
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'),
    'periodo_fecha_inicio_pick' => array('select' => 'EEM_FCH_INICIO', 'insert' => 'EEM_FCH_INICIO'),
    'periodo_fecha_fin_pick' => array('select' => 'EEM_FCH_FIN', 'insert' => 'EEM_FCH_FIN'),
    'pago_extra' => array('select' => 'EEM_PAGO_EXTRA', 'insert' => 'EEM_PAGO_EXTRA'),
    'actividad_anios_dedicados_docencia' => array('select' => 'EEM_ANIO_FUNGIO', 'insert' => 'EEM_ANIO_FUNGIO'),
//    'empleado_cve' => array('select' => 'EMPLEADO_CVE', 'insert' => 'EMPLEADO_CVE'),
    'hora_dedicadas' => array('select' => 'EEM_DURACION', 'insert' => 'EEM_DURACION'),
//    'actividad_docente_general' => array('select' => 'ACT_DOC_GRAL_CVE', 'insert' => 'ACT_DOC_GRAL_CVE'),
);

$config['emp_formacion_profesional'] = array(
    'hora_dedicadas' => array('select' => 'EFP_DURACION', 'insert' => 'EFP_DURACION'),
    'ctematica' => array('select' => 'TEMATICA_CVE', 'insert' => 'TEMATICA_CVE'),
    'cmodalidad' => array('select' => 'MODALIDAD_CVE', 'insert' => 'MODALIDAD_CVE'),
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'),
    'cinstitucion_avala' => array('select' => 'INS_AVALA_CVE', 'insert' => 'INS_AVALA_CVE'),
    'fecha_inicio_pick' => array('select' => 'EFP_FCH_INICIO', 'insert' => 'EFP_FCH_INICIO'),
    'fecha_fin_pick' => array('select' => 'EFP_FCH_FIN', 'insert' => 'EFP_FCH_FIN'),
    'pago_extra' => array('select' => 'EFP_EXTRA_INS_AVALA', 'insert' => 'EFP_EXTRA_INS_AVALA'),
    'empleado_cve' => array('select' => 'EMPLEADO_CVE', 'insert' => 'EMPLEADO_CVE'),
    'nd_a' => array('select' => 'EFP_TIENE_FORMA_EDU', 'insert' => 'EFP_TIENE_FORMA_EDU'),
    'ctipo_curso' => array('select' => 'CURSO_CVE', 'insert' => 'CURSO_CVE'),
    'cejercicio_profesional' => array('select' => 'EJE_PRO_CVE', 'insert' => 'EJE_PRO_CVE'),
    'nd_b' => array('select' => 'EMP_FORMACION_PROFESIONAL_CVE', 'insert' => 'EMP_FORMACION_PROFESIONAL_CVE'),
    'licenciatura' => array('select' => 'LICENCIATURA_CVE', 'insert' => 'LICENCIATURA_CVE'),
    'actividad_docente_gral' => array('select' => 'ACT_DOC_GRAL_CVE', 'insert' => 'ACT_DOC_GRAL_CVE'),
    'ctipo_formacion_profesional' => array('select' => 'TIP_FOR_PROF_CVE', 'insert' => 'TIP_FOR_PROF_CVE'),
    'actividad_anios_dedicados_docencia' => array('select' => 'EFO_ANIO_CURSO', 'insert' => 'EFO_ANIO_CURSO'),
    'nombre_curso' => array('select' => 'EFP_NOMBRE_CURSO', 'insert' => 'EFP_NOMBRE_CURSO'),
    'actividad_docente_general' => array('select' => 'ACT_DOC_GRAL_CVE', 'insert' => 'ACT_DOC_GRAL_CVE'),
    'crol_desempenia' => array('select' => 'ROL_DESEMPENIA_CVE', 'insert' => 'ROL_DESEMPENIA_CVE'),
);




$config['comprobante'] = array(
    'comprobante_cve' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'), //comprobante
    'ctipo_comprobante' => array('select' => 'TIPO_COMPROBANTE_CVE', 'insert' => 'TIPO_COMPROBANTE_CVE'), //comprobante
    'text_comprobante' => array('select' => 'COM_NOMBRE', 'insert' => 'COM_NOMBRE'), //comprobante
);
$config['comprobante_dos'] = array(
//    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'), //comprobante
    'ctipo_comprobante' => array('select' => 'TIPO_COMPROBANTE_CVE', 'insert' => 'TIPO_COMPROBANTE_CVE'), //comprobante
    'text_comprobante' => array('select' => 'COM_NOMBRE', 'insert' => 'COM_NOMBRE'), //comprobante
);

$config['emp_act_inv_edu'] = array(
    'nombre_investigacion' => array('select' => 'EIAE_NOMBRE_INV', 'insert' => 'EIAE_NOMBRE_INV'), 
    'folio_investigacion' => array('select' => 'EAIE_FOLIO_ACEPTACION', 'insert' => 'EAIE_FOLIO_ACEPTACION'), 
    'ctipo_estudio' => array('select' => '', 'insert' => 'TIP_ESTUDIO_CVE'), 
    'ctipo_participacion' => array('select' => 'TIP_PARTICIPACION_CVE', 'insert' => 'TIP_PARTICIPACION_CVE'), 
    'cmedio_divulgacion' => array('select' => 'MED_DIVULGACION_CVE', 'insert' => 'MED_DIVULGACION_CVE'), 
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'), 
    'bibliografia_revista' => array('select' => 'EAIE_PUB_CITA', 'insert' => 'EAIE_PUB_CITA'), 
    'bibliografia_libro' => array('select' => 'EAIE_PUB_CITA', 'insert' => 'EAIE_PUB_CITA'),
    'ctipo_actividad_docente' => array('select' => 'TIP_ACT_DOC_CVE', 'insert' => 'TIP_ACT_DOC_CVE'),    
);

$config['emp_beca'] = array(
    'fecha_inicio' => array('select' => 'EB_FCH_INICIO', 'insert' => 'EB_FCH_INICIO'),
    'fecha_fin' => array('select' => 'EB_FCH_FIN', 'insert' => 'EB_FCH_FIN'),
    'cclase_beca' => array('select' => 'CLA_BECA_CVE', 'insert' => 'CLA_BECA_CVE'),
    'cmotivo_becado' => array('select' => 'MOTIVO_BECADO_CVE', 'insert' => 'MOTIVO_BECADO_CVE'),
    'cbeca_interrumpida' => array('select' => 'BECA_INTERRIMPIDA_CVE', 'insert' => 'BECA_INTERRIMPIDA_CVE'),
    'empleado_cve' => array('select' => 'EMPLEADO_CVE', 'insert' => 'EMPLEADO_CVE'),
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'),
    'clase_beca_cve' => '',
    'motivo_beca_cve' => '',
    'beca_interrumpida_cve' => '',
    
);
$config['emp_comision'] = array(
    'fecha_inicio' => array('select' => 'EC_FCH_INICIO', 'insert' => 'EC_FCH_INICIO'),
    'fecha_fin' => array('select' => 'EC_FCH_FIN', 'insert' => 'EC_FCH_FIN'),
    'empleado_cve' => array('select' => 'EMPLEADO_CVE', 'insert' => 'EMPLEADO_CVE'),
    'ctipo_comision' => array('select' => 'TIP_COMISION_CVE', 'insert' => 'TIP_COMISION_CVE'),
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'),
    'tipo_comision_cve' => '',
    'nom_tipo_comision' => '',
);
$config['emp_materia_educativo'] = array(
    'empleado_cve' => array('select' => 'EMPLEADO_CVE', 'insert' => 'EMPLEADO_CVE'),
    'emp_material_educativo_cve' => array('select' => 'MATERIA_EDUCATIVO_CVE', 'insert' => 'MATERIA_EDUCATIVO_CVE'),
    'tipo_material_regreso' => array('select' => 'TIP_MATERIAL_CVE', 'insert' => 'TIP_MATERIAL_CVE'),
    'comprobante' => array('select' => 'COMPROBANTE_CVE', 'insert' => 'COMPROBANTE_CVE'),
    'material_educativo_anio' => array('select' => 'MAT_EDU_ANIO', 'insert' => 'MAT_EDU_ANIO'),
    'nombre_material' => array('select' => 'NOMBRE_MATERIAL_EDUCATIVO', 'insert' => 'NOMBRE_MATERIAL_EDUCATIVO'),
);
$config['ctipo_material'] = array(
    'tipo_material_cve' => array('select' => 'TIP_MATERIAL_CVE', 'insert' => 'TIP_MATERIAL_CVE'),
    'ctipo_material' => array('select' => 'TIP_MAT_TIPO', 'insert' => 'TIP_MAT_TIPO'),

    'nombre_unidad' => array('select' => 'TIP_MAT_NOMBRE', 'insert' => 'TIP_MAT_NOMBRE'),

    'nombre_objeto_aprendizaje' => array('select' => 'TIP_MAT_NOMBRE', 'insert' => 'TIP_MAT_NOMBRE'),
    'numero_horas' => array('select' => 'TIP_MAT_OPCION', 'insert' => 'TIP_MAT_OPCION'),
    'cantidad_hojas' => array('select' => 'TIP_MAT_OPCION', 'insert' => 'TIP_MAT_OPCION'),
);
$config['opciones_tipo_material'] = array(
    'cantidad_hojas' => array(1 => 'Menos de 100 hojas', 2 => '100 ó más hojas'),
    'numero_horas' => array(1 => 'Menor o igual que cuatro horas', 2 => 'Mayor que cuatro horas'),
    1=>array('opt_tipo_material'=>'cantidad_hojas'),
    3=>array('nom_tipo_material'=>'nombre_unidad', 'opt_tipo_material'=>'numero_horas'),
    4=>array('nom_tipo_material'=>'nombre_objeto_aprendizaje', 'opt_tipo_material'=>'numero_horas'),
);

$config['ccatalogo_modulo'] = array(
    'GENERAL'=>array('id'=>1),
    'FOR_SAL'=>array('id'=>2),
    'FOR_CON_SAL'=>array('id'=>3),
    'EJE_PRO'=>array('id'=>4),
    'DES_INV'=>array('id'=>5),
    'FOR_DOC'=>array('id'=>6),
    'FOR_EDU_DIS'=>array('id'=>7),
    'FOR_DES_CON'=>array('id'=>8),
    'FOR_DIS_INS'=>array('id'=>9),
    'FOR_INV_EDU'=>array('id'=>10),
    'OTROS'=>array('id'=>11),
    'BEC_Y_COM'=>array('id'=>12),
    'ACT_DOC'=>array('id'=>13),
    'CIC_CLI'=>array('id'=>14),
    'INT_MED'=>array('id'=>15),
    'SER_SOC'=>array('id'=>16),
    'LICENCIATURA'=>array('id'=>17),
    'ESP_MED'=>array('id'=>18),
    'MAESTRIA'=>array('id'=>19),
    'DOCTORADO'=>array('id'=>20),
    'TECNICO'=>array('id'=>21),
    'POSTECNICO'=>array('id'=>22),
    'EDU_CON'=>array('id'=>23),
    'DIR_SAL'=>array('id'=>24),
    'EDU_FOR_PRO'=>array('id'=>25),
    'FOR_PRO_INV'=>array('id'=>26),
    'EDU_DIS'=>array('id'=>27),
    'ACT_INV_EDU'=>array('id'=>28),
    'COM_EDU'=>array('id'=>29),
    'SIN_EXA'=>array('id'=>30),
    'COO_TUT_EDU_DIS'=>array('id'=>31),
    'COO_CUR_EDU_DIS'=>array('id'=>32),
    'DIR_TES'=>array('id'=>33),
    'ELA_MAT_EDU'=>array('id'=>34)
);

$config['formacion_tipo_subtipo'] = array(
    'INICIAL' => array('id' => 1),
    'CONTINUA' => array('id' => 2, 
        'subtipo'=>array('EDU_DIS'=>array('id'=>1),
            'DES_CON'=>array('id'=>2),
            'DIS_INS'=>array('id'=>3),
            'INV_EDU'=>array('id'=>4))),
    'OTRO' => array('id' => 3),
);

$config['formacion_tipo_subtipo__ccatalogo_modulo'] = array(
    $config['formacion_tipo_subtipo']['INICIAL']['id']=>array(0=>$config['ccatalogo_modulo']['FOR_DOC']['id']),
    $config['formacion_tipo_subtipo']['CONTINUA']['id']=>array(
        $config['formacion_tipo_subtipo']['CONTINUA']['subtipo']['EDU_DIS']['id']=>$config['ccatalogo_modulo']['FOR_EDU_DIS']['id'],
        $config['formacion_tipo_subtipo']['CONTINUA']['subtipo']['DES_CON']['id']=>$config['ccatalogo_modulo']['FOR_DES_CON']['id'],
        $config['formacion_tipo_subtipo']['CONTINUA']['subtipo']['DIS_INS']['id']=>$config['ccatalogo_modulo']['FOR_DIS_INS']['id'],
        $config['formacion_tipo_subtipo']['CONTINUA']['subtipo']['INV_EDU']['id']=>$config['ccatalogo_modulo']['FOR_INV_EDU']['id']
    ),
    $config['formacion_tipo_subtipo']['OTRO']['id']=>array(0=>$config['ccatalogo_modulo']['OTROS']['id']),
);

$config['ccurso'] = array(
    'OTRO' => array('id'=>57)
);

$config['ACCION_GENERAL'] = array(
    'VALIDAR' => array('id'=>'validar', 'valor'=>'validar')
);

////////////////////////////////////////Inicio parámetros de validación
$config['cvalidacion_curso_estado'] = array(
    'VALIDO' => array('id' => 1),
    'NO_VALIDO' => array('id' => 2),
    'CORRECCION' => array('id' => 3)
);

$config['TABLAS'] = array(
    'COMISION_ACADEMICA' => array('tabla_censo'=>'emp_comision', 'tabla_validacion'=>'hist_comision_validacion_curso', 'campo'=>'EMP_COMISION_CVE'),
    'FORMACION_SALUD' => array('tabla_censo'=>'emp_for_personal_continua_salud', 'tabla_validacion'=>'hist_fpcs_validacion_curso', 'campo'=>'FPCS_CVE'),
    'INVESTIGACION_SALUD' => array('tabla_censo'=>'emp_desa_inv_salud', 'tabla_validacion'=>'hist_edis_validacion_curso', 'campo'=>'EDIS_CVE'),
    'INVESTIGACION_EDUCATIVA' => array('tabla_censo'=>'emp_act_inv_edu', 'tabla_validacion'=>'hist_eaid_validacion_curso', 'campo'=>'EAID_CVE'),
    'BECA' => array('tabla_censo'=>'emp_beca', 'tabla_validacion'=>'hist_beca_validacion_curso', 'campo'=>'EMP_BECA_CVE'),
    'ACTIVIDAD_DOCENTE' => array('tabla_censo'=>'emp_actividad_docente', 'tabla_validacion'=>'hist_efpd_validacion_curso', 'campo'=>'EMP_ACT_DOCENTE_CVE'),
    'FORMACION_PROFESIONAL' => array('tabla_censo'=>'emp_formacion_profesional', 'tabla_validacion'=>'hist_efp_validacion_curso', 'campo'=>'EMP_FORMACION_PROFESIONAL_CVE'),
    'EDUCACION_DISTANCIA' => array('tabla_censo'=>'emp_educacion_distancia', 'tabla_validacion'=>'hist_edd_validacion_curso', 'campo'=>'EMP_EDU_DISTANCIA_CVE'),
    'ESPECIALIDAD_MEDICA' => array('tabla_censo'=>'emp_esp_medica', 'tabla_validacion'=>'hist_eem_validacion_curso', 'campo'=>'EMP_ESP_MEDICA_CVE'),
    'MATERIAL_EDUCATIVO' => array('tabla_censo'=>'emp_materia_educativo', 'tabla_validacion'=>'hist_me_validacion_curso', 'campo'=>'MATERIA_EDUCATIVO_CVE'),
);


////////////////////////////////////////Fin parámetros de validación

//    EAD_DURACION
//    EAD_FCH_INICIO
//    EAD_FCH_FIN
//    MODALIDAD_CVE *
//    LICENCIATURA_CVE *
//    COMPROBANTE_CVE
//    EAD_EXTRA_INS_AVALA
//    EAD_CURSO_PRIN_IMPARTE
//    ROL_DESEMPENIA_CVE
//    TIP_ACT_DOC_CVE *
//    INS_AVALA_CVE
//    CURSO_CVE
//    EMP_ACT_DOCENTE_CVE
//    TIP_MATERIAL_CVE *
//    AREA_CVE *
//    ACT_DOC_GRAL_CVE
//    MODULO_CVE *
//    EAD_ANIO_CURSO *
    
//tabla comprobante
//COMPROBANTE_CVE * 
//COM_NOMBRE *
//TIPO_COMPROBANTE_CVE *