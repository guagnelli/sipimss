<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Becas_comisiones_laborales_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_lista_becas($empleado_cve) {
        if ($empleado_cve < 1) {
            return -1;
        }
        $select = array('eb.EMP_BECA_CVE "emp_beca_cve"', 'eb.EMPLEADO_CVE "empleado_cve"',
            'eb.EB_FCH_INICIO "fecha_inicio"', 'eb.EB_FCH_FIN "fecha_fin"',
            'eb.CLA_BECA_CVE "clase_beca_cve"', 'cb.CLA_BEC_NOMBRE "nom_beca"',
            'eb.COMPROBANTE_CVE "comprobante_cve"', 'c.COM_NOMBRE "nom_comprobante"',
            'c.TIPO_COMPROBANTE_CVE "tip_comprobante_cve"', 'tc.TIP_COM_NOMBRE "nom_comprobante"',
            'eb.BECA_INTERRIMPIDA_CVE "beca_interrumpida_cve"', 'bi.MSG_BEC_INTE "msj_beca_interrumpida"',
            'eb.MOTIVO_BECADO_CVE "motivo_beca_cve"', 'mb.MOT_BEC_NOMBRE "nom_motivo_beca"');

        $this->db->select($select);
        $this->db->from('emp_beca as eb');
        $this->db->join('cclase_beca cb', 'cb.CLA_BECA_CVE = eb.CLA_BECA_CVE');
        $this->db->join('cmotivo_becado mb', 'mb.MOTIVO_BECADO_CVE = eb.MOTIVO_BECADO_CVE');
        $this->db->join('cbeca_interrumpida bi', 'bi.BECA_INTERRIMPIDA_CVE = eb.BECA_INTERRIMPIDA_CVE');
        $this->db->join('comprobante c', 'c.COMPROBANTE_CVE = eb.COMPROBANTE_CVE');
        $this->db->join('ctipo_comprobante tc', 'tc.TIPO_COMPROBANTE_CVE = c.TIPO_COMPROBANTE_CVE');
        $this->db->where('eb.EMPLEADO_CVE', $empleado_cve);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_lista_comisiones($empleado_cve) {
        if ($empleado_cve < 1) {
            return -1;
        }
        $select = array('ecm.EMP_COMISION_CVE "emp_comision_cve"', 'ecm.EMPLEADO_CVE "empleado_cve"',
            'ecm.EC_FCH_INICIO "fecha_inicio"', 'ecm.EC_FCH_FIN "fecha_fin"',
            'ecm.COMPROBANTE_CVE "comprobante_cve"', 'c.COM_NOMBRE "nom_comprobante"',
            'ecm.TIP_COMISION_CVE "tipo_comision_cve"', 'tcm.TIP_COM_NOMBRE "nom_tipo_comision"');

        $this->db->select($select);
        $this->db->from('emp_comision ecm');
        $this->db->join('ctipo_comision as tcm', 'tcm.TIP_COMISION_CVE = ecm.TIP_COMISION_CVE');
        $this->db->join('comprobante c', 'c.COMPROBANTE_CVE = ecm.COMPROBANTE_CVE');
        $this->db->join('ctipo_comprobante tc', 'tc.TIPO_COMPROBANTE_CVE = c.TIPO_COMPROBANTE_CVE');
        $this->db->where('tcm.IS_COMISION_ACADEMICA', 0);
        $this->db->where('ecm.EMPLEADO_CVE', $empleado_cve);
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
        if (empty($query)) {
            $query = 0;
        } else {
            $query = $query[0]['ultimo_id'];
        }
        return $query;
    }

}
