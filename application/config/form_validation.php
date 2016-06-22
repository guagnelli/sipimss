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
            'rules' => 'required' //|callback_valid_pass
        ),

    ),
    'form_ccl' => array(
    ),
    'form_ime' => array(
    ),
    'form_sso' => array(
    ),
    'form_lic' => array(
    ),
    'form_eme' => array(
    ),
    'form_mas' => array(
    ),
    'form_doc' => array(
    ),
    'form_tec' => array(
    ),
    'form_pos' => array(
    ),
    'form_eco' => array(
    ),
    'form_dplsa' => array(
    ),
    'form_efdp' => array(
    ),
    'form_fdpei' => array(
    ),
    'form_ead' => array(
    ),
    'form_adie' => array(
    ),
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
