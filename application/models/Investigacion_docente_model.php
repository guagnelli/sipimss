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
            , 'eaid.TIP_ACT_DOC_CVE "tpad_cve"', 'ctad.TIP_ACT_DOC_NOMBRE "tpad_nombre"'
            , 'c.COM_NOMBRE "text_comprobante"', 'c.TIPO_COMPROBANTE_CVE "tip_comprobante_cve"'
        );

        $this->db->select($select);
        $this->db->from('emp_act_inv_edu as eaid');
        $this->db->join('ctipo_actividad_docente as ctad', 'ctad.TIP_ACT_DOC_CVE = eaid.TIP_ACT_DOC_CVE');
        $this->db->join('comprobante as c', 'c.COMPROBANTE_CVE = eaid.COMPROBANTE_CVE', 'left');
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

    public function update_investigacion_docente($investigacion_docente = null, $datos_investigacion_docente = null) {
        $result_investigacion['result'] = -1;
        $result_investigacion['entidad'] = '';
        if (is_null($investigacion_docente)) {
            return $result_investigacion;
        }
        if (is_null($datos_investigacion_docente)) {
            return $result_investigacion;
        }

        $this->db->where('EAID_CVE', $investigacion_docente);
        $this->db->update('emp_act_inv_edu', $datos_investigacion_docente);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $result_investigacion['result'] = $investigacion_docente;
            $datos_investigacion_docente['EAID_CVE'] = $investigacion_docente;
            $result_investigacion['entidad'] = $datos_investigacion_docente;
        }
        return $result_investigacion;
    }
    
      public function get_ultimo_registro_investigacion($id_empleado) {
        $select = array('MAX(eaid.EAID_CVE) "ultimo_id"');
        $this->db->select($select);
        $this->db->from('emp_act_inv_edu as eaid');
        $this->db->where('eaid.EMPLEADO_CVE', $id_empleado);
        $query = $this->db->get();
        $query = $query->result_array();
//        pr($this->db->last_query());
        if(empty($query)){
            $query = 0;
        }else{
            $query = $query[0]['ultimo_id'];
        }
        return $query;
    }

}
