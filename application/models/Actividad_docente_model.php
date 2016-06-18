<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_docente_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getGeneros() {
        
    }

    /**
     * 
     * @return Array
     */
    public function getEstadoCivil() {
        $query = $this->db->get('cestado_civil');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

    /**
     * 
     * @param int $usuario_id
     */
    public function get_actividad_docente_general($usuario_id) {
        $this->db->select(array('adg.ACT_DOC_GRAL_CVE', 'adg.ANIOS_DEDICADOS', 'adg.EJER_PREDOMI_CVE', 'adg.EMPLEADO_CVE "EMPLEADO_CVE"', 'adg.CURSO_PRINC_IMPARTE'));
        $this->db->from('actividad_docente_gral as adg');
        $this->db->join('empleado as em', 'em.EMPLEADO_CVE = adg.EMPLEADO_CVE');
        $this->db->where('em.USUARIO_CVE', $usuario_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_actividad_docente_general($datos_actividad_docente) {
        if (is_null($datos_actividad_docente)) {
            return -1;
        }
        $this->db->insert('actividad_docente_gral', $datos_actividad_docente); //Almacena usuario
        $obtiene_id_usuario = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            return $obtiene_id_usuario;
        }
    }

    public function update_actividad_docente_general($datos_actividad_docente) {
        if (is_null($datos_actividad_docente)) {
            return -1;
        }
        //Actualiza
        $error = $this->db->where("EMPLEADO_CVE", $datos_actividad_docente['EMPLEADO_CVE']);
        $this->db->update('actividad_docente_gral', $datos_actividad_docente);
//        pr($error);
        return 1;
    }

}
