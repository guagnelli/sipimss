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
//        pr($this->db->last_query());
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
            , 'eaid.TIP_ACT_DOC_CVE "tpad_cve"', 'ctad.TIP_ACT_DOC_NOMBRE "tpad_nombre"',
//            , 'c.COM_NOMBRE "text_comprobante"', 
            'c.TIPO_COMPROBANTE_CVE "tipo_comprobante"'
        );

        $this->db->select($select);
        $this->db->from('emp_act_inv_edu as eaid');
        $this->db->join('ctipo_actividad_docente as ctad', 'ctad.TIP_ACT_DOC_CVE = eaid.TIP_ACT_DOC_CVE');
        $this->db->join('comprobante as c', 'c.COMPROBANTE_CVE = eaid.COMPROBANTE_CVE', 'left');
        $this->db->where('eaid.EAID_CVE', $EAID_cve);
        $query = $this->db->get();
        $result = array();
        if (!empty($query->result_array())) {
            $result = $query->result_array()[0];
        }
        return $result;
    }

    /**
     * 
     * @param type $id_investigacion_docente identificador del tipo de material educativo
     * @return type $arrar con los valores el registro tipo de material educativo eliminado
     */
    public function delete_investigacion_docente($id_investigacion_docente = null) {
        if (is_null($id_investigacion_docente)) {
            return array();
        }
        $res = $this->get_investigacion_docente($id_investigacion_docente);
        if (!empty($res)) {
            $res = $res[0];
            $this->db->where('EAID_CVE', $id_investigacion_docente);
            $this->db->delete('emp_act_inv_edu');
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return array();
            } else {
                return $res; //Retorna array de tipo de actividad docente
            }
        }
    }

    /**
     * 
     * @param autor LEAS
     * @param type $tipo_investigacion_docente
     * @return type
     */
    public function get_investigacion_docente($tipo_investigacion_docente = null) {
        if (!is_null($tipo_investigacion_docente)) {
            $this->db->where('EAID_CVE', $tipo_investigacion_docente);
        }
        $query = $this->db->get('emp_act_inv_edu');
        $array_validador = $query->result_array();
        $query->free_result();
        return $array_validador;
    }

    public function insert_investigacion_docente($datos_investigacion_docente) {
        if (is_null($datos_investigacion_docente)) {
            return -1;
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
        if (is_null($investigacion_docente)) {
            return array();
        }
        if (is_null($datos_investigacion_docente)) {
            return array();
        }

        $this->db->where('EAID_CVE', $investigacion_docente);
        $this->db->update('emp_act_inv_edu', $datos_investigacion_docente);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $datos_investigacion_docente['EAID_CVE'] = $investigacion_docente;
            return $datos_investigacion_docente;
        }
    }

    public function get_ultimo_registro_investigacion($id_empleado) {
        $select = array('MAX(eaid.EAID_CVE) "ultimo_id"');
        $this->db->select($select);
        $this->db->from('emp_act_inv_edu as eaid');
        $this->db->where('eaid.EMPLEADO_CVE', $id_empleado);
        $query = $this->db->get();
        $query = $query->result_array();
//        pr($this->db->last_query());
        if (empty($query)) {
            $query = 0;
        } else {
            $query = $query[0]['ultimo_id'];
        }
        return $query;
    }

}
