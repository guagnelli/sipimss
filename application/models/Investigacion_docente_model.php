<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Investigacion_docente_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_lista_datos_investigacion_docente($empleado_cve = null) {
        if (isset($empleado_cve) AND is_null($empleado_cve)) {
            return -1;
        }
        $select = array('eaid.EAID_CVE "cve_investigacion"', 'eaid.EIAE_NOMBRE_INV "nombre_investigacion"'
            , 'eaid.EAIE_FOLIO_ACEPTACION "folio_investigacion"', 'eaid.EMPLEADO_CVE', 'eaid.EAIE_PUB_CITA "cita_publicada"'
            , 'eaid.COMPROBANTE_CVE "comprobante_cve"'
            , 'eaid.TIP_ACT_DOC_CVE "tpad_cve"', 'ctad.TIP_ACT_DOC_NOMBRE "tpad_nombre"');

        $this->db->select($select);
        $this->db->from('emp_act_inv_edu as eaid');
        $this->db->join('ctipo_actividad_docente as ctad', 'ctad.TIP_ACT_DOC_CVE = eaid.TIP_ACT_DOC_CVE');
        $this->db->where('eaid.EMPLEADO_CVE', $empleado_cve);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_datos_investigacion_docente($EAID_cve = null) {
        if (isset($EAID_cve) AND is_null($EAID_cve)) {
            return -1;
        }
        $select = array('eaid.EAID_CVE "cve_investigacion"', 'eaid.EIAE_NOMBRE_INV "nombre_investigacion"'
            , 'eaid.EAIE_FOLIO_ACEPTACION "folio_investigacion"'
            , 'eaid.EMPLEADO_CVE "empleado_cve"'
            , 'eaid.EAIE_PUB_CITA "cita_publicada"'
            , 'eaid.COMPROBANTE_CVE "comprobante_cve"'
            , 'eaid.MED_DIVULGACION_CVE "med_divulgacion_cve"'
            , 'eaid.TIP_PARTICIPACION_CVE "tip_participacion_cve"'
            , 'eaid.TIP_ESTUDIO_CVE "tip_estudio_cve"'
            , 'eaid.TIP_ACT_DOC_CVE "tpad_cve"', 'ctad.TIP_ACT_DOC_NOMBRE "tpad_nombre"');

        $this->db->select($select);
        $this->db->from('emp_act_inv_edu as eaid');
        $this->db->join('ctipo_actividad_docente as ctad', 'ctad.TIP_ACT_DOC_CVE = eaid.TIP_ACT_DOC_CVE');
        $this->db->where('eaid.EAID_CVE', $EAID_cve);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_investigacion_docente($id_reg_inves = null) {
        $result_inves_docente['result'] = -1;
        $result_inves_docente['entidad'] = '';
        if (is_null($id_reg_inves)) {
            return $result_inves_docente;
        }
        $this->db->where('EAID_CVE', $id_reg_inves);
        $this->db->delete('emp_act_inv_edu');
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $result_inves_docente['result'] = $id_reg_inves;
            $result_inves_docente['entidad'] = array('EAID_CVE' => $id_reg_inves);
        }
        return $result_inves_docente;
    }

    public function insert_investigacion_docente($datos_investigacion_docente) {
        if (is_null($datos_investigacion_docente)) {
            return null;
        }
        $this->db->insert('emp_act_inv_edu', $datos_investigacion_docente); //Almacena usuario
        $obtiene_id_usuario = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            return $obtiene_id_usuario;
        }
    }

}
