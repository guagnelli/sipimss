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

    public function insert_emp_actividad_docente_gen($name_entidad = null, $array_campos) {
        if (is_null($name_entidad)) {
            return -1;
        }
        if (is_null($array_campos)) {
            return -1;
        }
        $this->db->insert($name_entidad, $array_campos); //Almacena tipo de actividad, según nombre de la entidad enviado
        $obtiene_id_entidad_actividad_docente = $this->db->insert_id();
        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            return $obtiene_id_entidad_actividad_docente;
        }
    }

}
