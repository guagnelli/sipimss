<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config = array(
    'form_registro_docente' => array(
        array(
            'field' => 'reg_matricula',
            'label' => 'Matrícula',
            'rules' => 'required|max_length[18]|alpha_dash'
        ),
        array(
            'field' => 'reg_delegacion',
            'label' => 'delegación',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'reg_correo',
            'label' => 'Correo electrónico',
            'rules' => 'trim|required|valida_correo_electronico' //|callback_valid_pass
        ),
        array(
            'field' => 'reg_contrasenia',
            'label' => 'Contraseña',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'reg_captcha',
            'label' => 'C&oacute;digo de seguridad',
            'rules' => 'required|check_captcha'
        ),
    ),
    'inicio_sesion' => array(
        array(
            'field' => 'matricula',
            'label' => 'Matrícula',
            'rules' => 'required|max_length[18]|alpha_dash'
        ),
        array(
            'field' => 'passwd',
            'label' => 'Contraseña',
            'rules' => 'required' //|callback_valid_pass
        ),
        /* array(
          'field'=>'curp',
          'label'=>'CURP',
          'rules'=>'required|exact_length[18]'
          ), */
        array(
            'field' => 'userCaptcha',
            'label' => 'C&oacute;digo de seguridad',
            'rules' => 'required|check_captcha'
        ),
    ),
    'form_evaluacion_decimal' => array(
        array(
            'field' => 'empleado',
            'label' => 'empleado',
            'rules' => 'required'
        ),
        array(
            'field' => 'curso_reciver',
            'label' => 'curso_reciver',
            'rules' => 'required'
        ),
        array(
            'field' => 'tipo_evaluacion',
            'label' => 'Tipo evaluación',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'promedio',
            'label' => 'Promedio evaluación',
            'rules' => 'required|decimal|greater_than[1.00]|less_than_equal_to[100.00]'
        )
    ),
    'form_evaluacion_intero' => array(
        array(
            'field' => 'empleado',
            'label' => 'empleado',
            'rules' => 'required'
        ),
        array(
            'field' => 'curso_reciver',
            'label' => 'curso_reciver',
            'rules' => 'required'
        ),
        array(
            'field' => 'tipo_evaluacion',
            'label' => 'Tipo evaluación',
            'rules' => 'required|numeric'
        ),
        array(
            'field' => 'promedio',
            'label' => 'Promedio evaluación',
            'rules' => 'required|integer|greater_than[1]|less_than_equal_to[100]'
        )
    ),
    'form_modifica_curso_decimal' => array(
//        array(
//            'field' => 'cve_actuacion',
//            'label' => 'problemas al obtener clave',
//            'rules' => 'required'
//        ),
        array(
            'field' => 'promediocurso',
            'label' => 'promedio evaluación',
            'rules' => 'required|decimal|greater_than[1.00]|less_than_equal_to[100.00]'
        )
    ),
    'form_modifica_curso_entero' => array(
//        array(
//            'field' => 'cve_actuacion',
//            'label' => 'problemas al obtener clave',
//            'rules' => 'required'
//        ),
        array(
            'field' => 'promediocurso',
            'label' => 'promedio evaluación',
            'rules' => 'required|less_than_equal_to[100]|integer|greater_than[1]'
        )
    ),
    'form_cancelacion' => array(
        array(
            'field' => 'reg_matricula',
            'label' => 'Matricula',
            'rules' => 'required|max_length[10]|min_length[6]|numeric'
        ),
        array(
            'field' => 'reg_delegacion',
            'label' => 'Delegaci&oacute;n',
            'rules' => 'required|min_length[1]|max_length[2]|numeric'
        ),
        array(
            'field' => 'reg_folio',
            'label' => 'Folio de registro',
            'rules' => 'required|exact_length[6]|alpha_numeric'
        ),
        array(
            'field' => 'txt_captcha',
            'label' => 'C&oacute;digo de seguridad',
            'rules' => 'required|exact_length[6]|check_captcha'
        )
    ),
    'form_reagendar' => array(
        array(
            'field' => 'reg_matricula',
            'label' => 'Matricula',
            'rules' => 'required|max_length[10]|min_length[6]|numeric'
        ),
        array(
            'field' => 'reg_delegacion',
            'label' => 'Delegaci&oacute;n',
            'rules' => 'required|min_length[1]|max_length[2]|numeric'
        ),
        array(
            'field' => 'reg_folio',
            'label' => 'Folio de registro',
            'rules' => 'required|exact_length[6]|alpha_numeric'
        ),
        array(
            'field' => 'reg_sesion',
            'label' => 'Sesiones programadas',
            'rules' => 'required|min_length[1]|max_length[2]|numeric'
        ),
        array(
            'field' => 'txt_captcha',
            'label' => 'C&oacute;digo de seguridad',
            'rules' => 'required|exact_length[6]|check_captcha'
        )
    ),
    'tarjeton' => array(
//        array(
//            'field' => 'regbono',
//            'label' => 'registro bono',
//            'rules' => 'required|max_length[11]|is_numeric'
//        ),
//        array(
//            'field' => 'quincena_',
//            'label' => 'tarjeta quincena',
//            'rules' => 'required|max_length[20]|alpha_numeric_accent_space_dot'
//        ),
        array(
            'field' => 'validos',
            'label' => 'tarjet&oacute;n debe seleccionarse',
            'rules' => 'required|radio_buttom_validation'
//            'rules' => 'radio_buttom_validation'
        ),
        array(
            'field' => 'folio',
            'label' => 'folio',
            'rules' => 'required|max_length[6]|alpha_numeric'
        ),
        array(
            'field' => 'insidencia',
            'label' => 'incidencia',
            'rules' => 'required|max_length[2]|integer|greater_than[-1]'
        ),
    ),
    'tarjeton_quincena' => array(
//        array(
//            'field' => 'regbono',
//            'label' => 'registro bono',
//            'rules' => 'required|max_length[11]|is_numeric'
//        ),
//        array(
//            'field' => 'quincena_',
//            'label' => 'tarjeta quincena',
//            'rules' => 'required|max_length[20]|alpha_numeric_accent_space_dot'
//        ),
        array(
            'field' => 'validos',
            'label' => 'tarjet&oacute;n debe seleccionarse',
            'rules' => 'required|radio_buttom_validation'
//            'rules' => 'radio_buttom_validation'
        )
    ),
    'form_correo_e' => array(
        array(
            'field' => 'mail_',
            'label' => 'correo',
//            'rules' => 'required|valid_email'
            'rules' => 'trim|required|valid_email'
        ),
    ),
    'form_correccion' => array(
        array(
            'field' => 'radio_correccion',
            'label' => 'Motivo envia a corrección',
            'rules' => 'required|in_list[7,8]'
        ),
        array(
            'field' => 'msg_correccion',
            'label' => 'Mensaje envia corrección',
            'rules' => 'required|alpha_numeric_accent_space_dot' //|callback_valid_pass
        ),
        /* array(
          'field'=>'curp',
          'label'=>'CURP',
          'rules'=>'required|exact_length[18]'
          ), */
        array(
            'field' => 'candidato',
            'label' => 'Clave candidato',
            'rules' => 'required'
        ),
    ),
    //***Inicio  de Validaciones de formularios de actividad docente************
    'form_actividad_docente_general' => array(
        array(
            'field' => 'actividad_anios_dedicados_docencia',
            'label' => 'años dedicados',
            'rules' => 'required|greater_than[1]|numeric'
        ),
        array(
            'field' => 'ejercicio_predominante',
            'label' => 'ejercicio predominante',
            'rules' => 'required' //
        ),
    ),
    'form_ccl' => array(
        'duracion' => array(//radio button *************************************
            'field' => 'duracion',
            'label' => 'duración de curso',
            'rules' => 'required'//
        ),
        'pago_extra' => array(
            'field' => 'pago_extra',
            'label' => 'Indicar pago extra',
            'rules' => 'required' //
        ),
        'ccurso' => array(//*****Catálogos**************************************
            'field' => 'ccurso',
            'label' => 'Nombre del curso',
            'rules' => 'required' //
        ),
        'crol_desempenia' => array(
            'field' => 'crol_desempenia',
            'label' => 'rol que desempeña',
            'rules' => 'required' //
        ),
        'cinstitucion_avala' => array(
            'field' => 'cinstitucion_avala',
            'label' => 'Institución que avala',
            'rules' => 'required' //
        ),
        'licenciatura' => array(
            'field' => 'licenciatura',
            'label' => 'Licenciatura',
            'rules' => 'required' //
        ),
        'cmodalidad' => array(
            'field' => 'cmodalidad',
            'label' => 'modalidad',
            'rules' => 'required' //
        ),
        'ctipo_comprobante' => array(
            'field' => 'ctipo_comprobante',
            'label' => 'tipo de comprobante',
            'rules' => 'required' //
        ),
        'cmodulo' => array(
            'field' => 'cmodulo',
            'label' => 'módulo',
            'rules' => 'required' //
        ),
        'carea' => array(
            'field' => 'carea',
            'label' => 'área',
            'rules' => 'required' //
        ),
        'ctipo_formacion_profesional' => array(
            'field' => 'ctipo_formacion_profesional',
            'label' => 'formación profesional',
            'rules' => 'required' //
        ),
        'ctipo_participacion' => array(
            'field' => 'ctipo_participacion',
            'label' => 'tipo de participacón',
            'rules' => 'required' //
        ),
        'ctipo_material' => array(
            'field' => 'ctipo_material',
            'label' => 'tipo de material',
            'rules' => 'required' //
        ),
        'ctipo_especialidad' => array(
            'field' => 'ctipo_especialidad',
            'label' => 'tipo de especialidad',
            'rules' => 'required' //
        ),
        'ctipo_curso' => array(
            'field' => 'ctipo_curso',
            'label' => 'tipo de curso',
            'rules' => 'required' //
        ),
        'material_elaborado' => array(//  Textos********************************
            'field' => 'material_elaborado',
            'label' => 'nombre del material elaborado',
            'rules' => 'trim|required|max_length[100]' //
        ),
        'text_comprobante' => array(
            'field' => 'text_comprobante',
            'label' => 'Nombre de comprobante',
            'rules' => 'trim|required'                                                                                                                                                                                                                                                                      //
        ),
        'nombre_curso' => array(
            'field' => 'nombre_curso',
            'label' => 'nombre del curso',
            'rules' => 'trim|required|max_length[100]' //
        ),
        'nombre_materia_impartio' => array(
            'field' => 'nombre_materia_impartio',
            'label' => 'nombre de la materia que impartió',
            'rules' => 'trim|required|max_length[100]' //
        ),
        'folio_constancia' => array(
            'field' => 'folio_constancia',
            'label' => 'folio',
            'rules' => 'trim|required|max_length[35]' //alfanumerico y guión
        ),
        'actividad_anios_dedicados_docencia' => array(
            'field' => 'actividad_anios_dedicados_docencia',
            'label' => 'de años',
            'rules' => 'trim|required|numeric' //
        ),
        'fecha_inicio_pick' => array(
            'field' => 'fecha_inicio_pick',
            'label' => 'fecha de inicio',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy' //
        ),
        'fecha_fin_pick' => array(
            'field' => 'fecha_fin_pick',
            'label' => 'fecha de fin',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy' //
        ),
        'periodo_fecha_inicio_pick' => array(
            'field' => 'periodo_fecha_inicio_pick',
            'label' => 'fecha de inicio',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy' //
        ),
        'periodo_fecha_fin_pick' => array(
            'field' => 'periodo_fecha_fin_pick',
            'label' => 'fecha de fin',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy' //
        ),
        'hora_dedicadas' => array(
            'field' => 'hora_dedicadas',
            'label' => 'horas dedicadas',
            'rules' => 'trim|required|numeric' //
        ),
    ),
    'form_convocatoria_evaluacion' => array(
        'FCH_FIN_REG_DOCENTE' => array(
            'field' => 'FCH_FIN_REG_DOCENTE',
            'label' => 'fecha fin de registro docente',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy'//
        ),
        'FCH_FIN_VALIDACION_1' => array(
            'field' => 'FCH_FIN_VALIDACION_1',
            'label' => 'fecha fin de validación 1',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy'//
        ),
        'FCH_FIN_VALIDACION_2' => array(
            'field' => 'FCH_FIN_VALIDACION_2',
            'label' => 'fecha fin de validación 2',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy'//
        ),
    ),
    'form_dictamen_evaluacion' => array(
        'FCH_INICIO_EVALUACION' => array(
            'field' => 'FCH_INICIO_EVALUACION',
            'label' => 'fecha inicio de evaluación',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy'//
        ),
        'FCH_FIN_EVALUACION' => array(
            'field' => 'FCH_FIN_EVALUACION',
            'label' => 'fecha final de evaluación',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy'//
        ),
        'FCH_FIN_INCONFORMIDAD' => array(
            'field' => 'FCH_FIN_INCONFORMIDAD',
            'label' => 'fecha final de inconformidad',
            'rules' => 'trim|required|validate_date_dd_mm_yyyy'//
        ),
    ),
    'form_investigacion_docente' => array(
        'ctipo_actividad_docente' => array(
            'field' => 'ctipo_actividad_docente',
            'label' => 'fecha fin de registro docente',
            'rules' => 'required'//
        ),
        'nombre_investigacion' => array(
            'field' => 'nombre_investigacion',
            'label' => 'nombre del trabajo de investigacion',
            'rules' => 'trim|required'//
        ),
        'folio_investigacion' => array(
            'field' => 'folio_investigacion',
            'label' => 'folio de aceptacion',
            'rules' => 'trim|required'//
        ),
        'ctipo_estudio' => array(
            'field' => 'ctipo_estudio',
            'label' => 'Tipo de estudio',
            'rules' => 'required'//
        ),
        'ctipo_participacion' => array(
            'field' => 'ctipo_participacion',
            'label' => 'tipo de participacion',
            'rules' => 'required'//
        ),
        'cmedio_divulgacion' => array(
            'field' => 'cmedio_divulgacion',
            'label' => 'divulgación',
            'rules' => 'required'//
        ),
        
        'ctipo_comprobante' => array(
            'field' => 'ctipo_comprobante',
            'label' => 'tipo de comprobante',
            'rules' => 'required' //
        ),
        'text_comprobante' => array(
            'field' => 'text_comprobante',
            'label' => 'Nombre de comprobante',
            'rules' => 'trim|required'                                                                                                                                                                                                                                                                      //
        ),
        'bibliografia_revista' => array(
            'field' => 'bibliografia_revista',
            'label' => 'bibliografia de la revista',
            'rules' => 'required'//
        ),
        'bibliografia_libro' => array(
            'field' => 'bibliografia_libro',
            'label' => 'bibliografia del libro',
            'rules' => 'required'//
        ),    
        'carga_file' => array(
            'field' => 'carga_file',
            'label' => 'archivo',
            'rules' => 'required'//
        ),    
    ),
    'form_usuario_alta' => array(
        array(
            'field' => 'matricula',
            'label' => 'Matrícula',
            'rules' => 'required|max_length[12]|alpha_dash|is_unique[usuario.USU_MATRICULA]'
        ),
        array(
            'field' => 'delegacion',
            'label' => 'Delegación',
            'rules' => 'required'
        ),
        array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'required|alpha_accent_space_dot_quot|max_length[20]'
        ),
        array(
            'field' => 'apaterno',
            'label' => 'Apellido paterno',
            'rules' => 'required|alpha_accent_space_dot_quot|max_length[20]'
        ),
        array(
            'field' => 'amaterno',
            'label' => 'Apellido materno',
            'rules' => 'required|alpha_accent_space_dot_quot|max_length[20]'
        ),
        array(
            'field' => 'contrasenia',
            'label' => 'Contraseña',
            'rules' => 'required|callback_valid_pass|max_length[30]|min_length[8]'
        ),
        array(
            'field' => 'confirma_contrasenia',
            'label' => 'Confirmar contraseña',
            'rules' => 'required|matches[contrasenia]'
        ),
        array(
            'field' => 'correo',
            'label' => 'Correo electrónico',
            'rules' => 'trim|required|valida_correo_electronico'
        ),
        array(
            'field' => 'correo_alt',
            'label' => 'Correo electrónico alternativo',
            'rules' => 'trim|valida_correo_electronico'
        ),
        array(
            'field' => 'tel_laboral',
            'label' => 'Teléfono laboral',
            'rules' => 'min_length[10]|max_length[20]|alpha_numeric_accent_space_dot_parent'
        ),
        array(
            'field' => 'tel_particular',
            'label' => 'Teléfono particular',
            'rules' => 'min_length[10]|max_length[20]|alpha_numeric_accent_space_dot_parent'
        ),
        array(
            'field' => 'estado_usuario',
            'label' => 'Estado del usuario',
            'rules' => 'required'
        ),
        array(
            'field' => 'roles[]',
            'label' => 'Rol',
            'rules' => 'required'
        )
    ),
    'form_usuario_edicion' => array(
        array(
            'field' => 'delegacion',
            'label' => 'Delegación',
            'rules' => 'required'
        ),
        array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'required|alpha_accent_space_dot_quot|max_length[20]'
        ),
        array(
            'field' => 'apaterno',
            'label' => 'Apellido paterno',
            'rules' => 'required|alpha_accent_space_dot_quot|max_length[20]'
        ),
        array(
            'field' => 'amaterno',
            'label' => 'Apellido materno',
            'rules' => 'required|alpha_accent_space_dot_quot|max_length[20]'
        ),
        /*array(
            'field' => 'contrasenia',
            'label' => 'Contraseña',
            'rules' => 'max_length[30]|min_length[8]'
        ),*/
        array(
            'field' => 'confirma_contrasenia',
            'label' => 'Confirmar contraseña',
            'rules' => 'matches[contrasenia]'
        ),
        array(
            'field' => 'correo',
            'label' => 'Correo electrónico',
            'rules' => 'trim|required|valida_correo_electronico'
        ),
        array(
            'field' => 'correo_alt',
            'label' => 'Correo electrónico alternativo',
            'rules' => 'trim|valida_correo_electronico'
        ),
        array(
            'field' => 'tel_laboral',
            'label' => 'Teléfono laboral',
            'rules' => 'min_length[10]|max_length[20]|alpha_numeric_accent_space_dot_parent'
        ),
        array(
            'field' => 'tel_particular',
            'label' => 'Teléfono particular',
            'rules' => 'min_length[10]|max_length[20]|alpha_numeric_accent_space_dot_parent'
        ),
        array(
            'field' => 'estado_usuario',
            'label' => 'Estado del usuario',
            'rules' => 'required'
        ),
        array(
            'field' => 'roles[]',
            'label' => 'Rol',
            'rules' => 'required'
        )
    ),
    'form_direccion_tesis' => array(
        array(
            'field' => 'dt_anio',
            'label' => 'Año en que fue dirigida',
            'rules' => 'trim|required|exact_length[4]|integer'
        ),
        array(
            'field' => 'nivel_academico',
            'label' => 'Nivel académico',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'comision_area',
            'label' => 'Área',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'tipo_comprobante',
            'label' => 'Tipo de comprobante',
            'rules' => 'required'
        )
    ),
      'form_beca' => array(
         array(
            'field' => 'periodo_fecha_inicio_pick',
            'label' => 'fecha inicio comisión',
            'rules' => 'required|validate_date_dd_mm_yyyy'
        ),
        array(
            'field' => 'periodo_fecha_fin_pick',
            'label' => 'fecha fin comisión',
            'rules' => 'required|validate_date_dd_mm_yyyy' //|callback_valid_pass
        ),
        array(
            'field' => 'ctipo_comprobante',
            'label' => 'tipo de comprobante',
            'rules' => 'required' 
        ),
        array(
            'field' => 'text_comprobante',
            'label' => 'comprobante',
            'rules' => 'required' 
        ),
        array(
            'field' => 'carga_file',
            'label' => 'carga de comprobante',
            'rules' => 'required' 
        ),
        array(
            'field' => 'cclase_beca',
            'label' => 'clase de beca',
            'rules' => 'required'
        ),
        array(
            'field' => 'cmotivo_becado',
            'label' => 'motivo de la beca',
            'rules' => 'required' 
        ),
        array(
            'field' => 'cbeca_interrumpida',
            'label' => 'beca interrumpida',
            'rules' => 'required' 
        ),
    ),
    'form_comision' => array(
        array(
            'field' => 'periodo_fecha_inicio_pick',
            'label' => 'fecha inicio comisión',
            'rules' => 'required|validate_date_dd_mm_yyyy'
        ),
        array(
            'field' => 'periodo_fecha_fin_pick',
            'label' => 'fecha fin comisión',
            'rules' => 'required|validate_date_dd_mm_yyyy' //|callback_valid_pass
        ),
        array(
            'field' => 'tipo_comision_cve',
            'label' => 'tipo de comisión',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'tipo_comision_cve',
            'label' => 'tipo de comisión',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'ctipo_comprobante',
            'label' => 'tipo de comprobante',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'text_comprobante',
            'label' => 'comprobante',
            'rules' => 'required' //|callback_valid_pass
        ),
        array(
            'field' => 'carga_file',
            'label' => 'carga comprobante',
            'rules' => 'required' //|callback_valid_pass
        ),
    ),
    'form_material_educativo' => array(
        'ctipo_material' => array(
            'field' => 'ctipo_material',
            'label' => 'tipo de material educativo',
            'rules' => 'required'
        ),
        'nombre_material' => array(
            'field' => 'nombre_material',
            'label' => 'nombre del material educativo',
            'rules' => 'trim|required|max_length[100]|alpha_numeric_spaces' 
        ),
        'material_educativo_anio' => array(
            'field' => 'material_educativo_anio',
            'label' => 'año que alaboro material',
            'rules' => 'trim|required|max_length[4]|integer' 
        ),
        'cantidad_hojas' => array(
            'field' => 'cantidad_hojas',
            'label' => 'cantidad de hojas',
            'rules' => 'required' 
        ),
        'numero_horas' => array(
            'field' => 'numero_horas',
            'label' => 'número de horas',
            'rules' => 'required' 
        ),
        'nombre_unidad' => array(
            'field' => 'nombre_unidad',
            'label' => 'nombre de la unidad',
            'rules' => 'trim|required|max_length[100]|alpha_numeric_spaces' 
        ),
        'nombre_objeto_aprendizaje' => array(
            'field' => 'nombre_objeto_aprendizaje',
            'label' => 'nombre del objeto de aprendizaje',
            'rules' => 'trim|required|max_length[100]|alpha_numeric_spaces' 
        ),
    ),

    /*matricula
    delegacion
    nombre
    apaterno
    amaterno
    contrasenia
    correo
    correo_alt
    tel_laboral
    tel_particular
    estado_usuario

    public $USU_MATRICULA;
    public $DELEGACION_CVE;
    public $USU_NOMBRE;
    public $USU_PATERNO;
    public $USU_MATERNO;
    public $USU_CONTRASENIA;
    public $USU_CORREO;
    public $USU_CORREO_ALTERNATIVO;
    public $USU_TEL_LABORAL;
    public $USU_TEL_PARTICULAR;
    public $ESTADO_USUARIO_CVE;*/
        //**Fin de validación de actividad docenete********************************
);





// VALIDACIONES
/*
             * isset
             * valid_email
             * valid_url
             * min_length
             * max_length
             * exact_length
             * alpha
             * alpha_numeric
             * alpha_numeric_spaces
             * alpha_dash
             * numeric
             * is_numeric
             * integer
             * regex_match
             * matches
             * differs
             * is_unique
             * is_natural
             * is_natural_no_zero
             * decimal
             * less_than
             * less_than_equal_to
             * greater_than
             * greater_than_equal_to
             * in_list
             *
             */


//custom validation

/*

alpha_accent_space_dot_quot
 *
alpha_numeric_accent_slash
 *
alpha_numeric_accent_space_dot_parent
 *
alpha_numeric_accent_space_dot_double_quot

*/

/*
*password_strong
*
*
*
*
*/
