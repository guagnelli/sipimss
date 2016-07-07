<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_generales extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    /**
     * 
     * @param type $id_usuario identificador del usuario
     * 
     */
    public function getDatos_empleado($id_usuario) {
        $query = $this->db->where('USUARIO_CVE', $id_usuario); //Condicion del usuario 
        $query = $this->db->get('empleado'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "rist_delegacion"
     * 
     */
    public function getDelegaciones_rist() {
//        $this->db->select(array(''));
        $query = $this->db->get('rist_delegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cdelegacion" que es la 
     * tabla principal de delegaciones
     * 
     */
    public function getDelegaciones() {
//        $this->db->select(array(''));
        $query = $this->db->get('cdelegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cejercicio_profesional" 
     * 
     * 
     */
    public function get_ejercicios_profesionales() {
//        $this->db->select(array(''));
        $query = $this->db->get('cejercicio_profesional'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    public function get_ejercicios_predominante() {
//        $this->db->select(array(''));
        $query = $this->db->get('cejercicio_predominante'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ccurso" 
     * 
     * 
     */
    public function get_ccurso() {
//        $this->db->select(array(''));
        $query = $this->db->get('ccurso'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_actividad_docente" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_tipo_actividad_docente() {
        $query = $this->db->get('ctipo_actividad_docente'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /////*******Checar campos
    /**
     * 
     * @return type array retorna los datos del catálogo "cmaterial" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmaterial() {
        $query = $this->db->get('cmaterial'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "licenciatura" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_licenciatura() {
        $query = $this->db->get('licenciatura'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cmodulo" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmodulo() {
        $query = $this->db->get('cmodulo'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "carea" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_carea() {
        $query = $this->db->get('carea'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cinstitucion_avala" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cinstitucion_avala() {
        $query = $this->db->get('cinstitucion_avala'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_crol_desempenia() {
        $query = $this->db->get('crol_desempenia'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmodalidad() {
        $query = $this->db->get('cmodalidad'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_ctipo_comprobante() {
        $query = $this->db->get('ctipo_comprobante'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_especialidad" 
     * "TIP_ESP_MEDICA_CVE"  y  "TIP_ESP_MED_NOMBRE"
     * 
     */
    public function get_ctipo_especialidad() {
        $query = $this->db->get('ctipo_especialidad'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_especialidad" 
     * "TIP_FOR_PROF_CVE"  ,  "TIP_FOR_PRO_NOMBRE"   y "SUB_FOR_PRO_CVE"
     * 
     */
    public function get_ctipo_formacion_profesional() {
        $query = $this->db->get('ctipo_formacion_profesional'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_participacion" 
     * "TIP_PARTICIPACION_CVE"  ,  "TIP_PAR_NOMBRE" 
     * 
     */
    public function get_ctipo_participacion() {
        $query = $this->db->get('ctipo_participacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_participacion" 
     * "TIP_MATERIAL_CVE"  ,  "TIP_MAT_NOMBRE"  y "TIP_MAT_TIPO"
     * 
     */
    public function get_ctipo_material() {
        $query = $this->db->get('ctipo_material'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_curso" 
     * "TIP_CURSO_CVE"  ,  "TIP_CUR_NOMBRE"
     * 
     */
    public function get_ctipo_curso() {
        $query = $this->db->get('ctipo_curso'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }
    
    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "CESTADO_CIVIL_CVE"  ,  "EDO_CIV_NOMBRE"
     * 
     */
    public function get_cestado_civil() {
        $query = $this->db->get('cestado_civil');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

}
