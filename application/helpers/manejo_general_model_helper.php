<?php

/**
 * Método que valida una variable; que exista, no sea nula o vacía
 * @autor 		: luis Eduardo Aguilera Soto.
 * @modified 	: 
 * @param 		: mixed $valor Parámetro a validar
 * @return 		: bool. TRUE en caso de que exista, no sea vacía o nula de lo contrario devolverá FALSE
 */
if (!function_exists('carga_catalogos')) {

    function carga_catalogos_censo($array_catalogos = array(), $data = array()) {
        if (isset($array_catalogos) AND is_null($array_catalogos)) {
            $array_catalogos = array();
        }
        if (isset($data) AND is_null($data)) {
            $data = array();
        }
        $CI = & get_instance();
        $CI->load->model('Catalogos_generales', 'cg');
        $tmp_result = null;

        foreach ($array_catalogos as $index) {
            switch ($index) {
                case 1://cmodalidad
                    $tmp_result = $CI->cg->get_cmodalidad();
                    $data['cmodalidad'] = dropdown_options($tmp_result, 'MODALIDAD_CVE', 'MOD_NOMBRE');
                    break;
                case 2://licenciatura
                    $tmp_result = $CI->cg->get_licenciatura();
                    $data['licenciatura'] = dropdown_options($tmp_result, 'LICENCIATURA_CVE', 'LIC_NOMBRE');
                    break;
                case 3://cmodulo
                    $tmp_result = $CI->cg->get_cmodulo();
                    $data['cmodulo'] = dropdown_options($tmp_result, 'MODULO_CVE', 'MODULO_NOMBRE');
                    break;
                case 4://carea
                    $tmp_result = $CI->cg->get_carea();
                    $data['carea'] = dropdown_options($tmp_result, 'AREA_CVE', 'AREA_NOMBRE');
                    break;
                case 5://cmateria
                    $tmp_result = $CI->cg->get_cmateria();
                    $data['cmateria'] = dropdown_options($tmp_result, 'MATERIA_CVE', 'MATERIA_NOMBRE');
                    break;
                case 6://ccurso
                    $tmp_result = $CI->cg->get_ccurso();
                    $data['ccurso'] = dropdown_options($tmp_result, 'CURSO_CVE', 'CUR_NOMBRE');
                    break;
                case 7://cinstitucion_avala
                    $tmp_result = $CI->cg->get_cinstitucion_avala();
                    $data['cinstitucion_avala'] = dropdown_options($tmp_result, 'INS_AVALA_CVE', 'IA_NOMBRE');
                    break;
                case 8://ctipo_actividad_docente
                    $tmp_result = $CI->cg->get_ctipo_actividad_docente();
                    $data['ctipo_actividad_docente'] = dropdown_options($tmp_result, 'TIP_ACT_DOC_CVE', 'TIP_ACT_DOC_NOMBRE');
                    break;
                case 9://crol_desempenia
                    $tmp_result = $CI->cg->get_crol_desempenia();
                    $data['crol_desempenia'] = dropdown_options($tmp_result, 'ROL_DESEMPENIA_CVE', 'ROL_DESEMPENIA');
                    break;
                case 10://ctipo_comprobante
                    $tmp_result = $CI->cg->get_ctipo_comprobante();
                    $data['ctipo_comprobante'] = dropdown_options($tmp_result, 'TIPO_COMPROBANTE_CVE', 'TIP_COM_NOMBRE');
                    break;
                case 11://ctipo_licenciatura
                    $tmp_result = $CI->cg->get_ctipo_licenciatura();
                    $data['ctipo_licenciatura'] = dropdown_options($tmp_result, 'TIP_LICENCIATURA_CVE', 'TIP_LIC_NOMBRE');
                    break;
                case 12://ctipo_curso
                    $tmp_result = $CI->cg->get_ctipo_curso();
                    $data['ctipurso'] = dropdown_options($tmp_result, 'TIP_CURSO_CVE', 'TIP_CUR_NOMBRE');
                    break;
                case 13://ctipo_especialidad
                    $tmp_result = $CI->cg->get_ctipo_especialidad();
                    $data['ctipo_especialidad'] = dropdown_options($tmp_result, 'TIP_ESP_MEDICA_CVE', 'TIP_ESP_MED_NOMBRE');
                    break;
                case 14://ctipo_formacion_profesional
                    $tmp_result = $CI->cg->get_ctipo_formacion_profesional();
                    $data['ctipo_formacion_profesional'] = dropdown_options($tmp_result, 'TIP_FOR_PROF_CVE', 'TIP_FOR_PRO_NOMBRE');
                    break;
            }
        }
        return $data;
    }

}