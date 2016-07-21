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
            , 'eaid.EMPLEADO_CVE'
            , 'eaid.EAIE_PUB_CITA "cita_publicada"'
            , 'eaid.MED_DIVULGACION_CVE "med_divulgacion_cve"'
            , 'eaid.TIP_PARTICIPACION_CVE "tip_participacion_cve"'
            , 'eaid.TIP_ESTUDIO_CVE "tip_estudio_cve"'
            ,'eaid.TIP_ACT_DOC_CVE "tpad_cve"');

        $this->db->select($select);
        $this->db->from('emp_act_inv_edu as eaid');
        $this->db->where('eaid.EAID_CVE', $EAID_cve);
        $query = $this->db->get();
        return $query->result_array();
    }

}
