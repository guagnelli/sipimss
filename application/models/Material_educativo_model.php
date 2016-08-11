<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Material_educativo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_lista_material_educativo($empleado_cve) {
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
//        $query = $this->db->get();
//        return $query->result_array();
        return array();
    }

    public function insert_emp_materia_educativo($datos_material_educativo) {
        $this->db->insert('emp_materia_educativo', $datos_material_educativo); //Almacena usuario
        $obtiene_id_emp_material_edu = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
//            $this->db->trans_rollback();
            return -1;
        } else {
            return intval($obtiene_id_emp_material_edu);
        }
    }

    public function insert_ctipo_material($datos_ctipo_material_educativo) {
        if (is_null($datos_ctipo_material_educativo)) {
            return null;
        }
        $this->db->insert('ctipo_material', $datos_ctipo_material_educativo); //Almacena usuario
        $obtiene_id_tipo_material_edu = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
//            $this->db->trans_rollback();
            return -1;
        } else {
            return intval($obtiene_id_tipo_material_edu);
        }
    }

    public function insert_material_and_tipo_mat($datos_material_educativo, $datos_tipo_material_educativo) {
        $this->db->trans_begin();
        $id_tp_material = $this->insert_ctipo_material($datos_tipo_material_educativo);
        if ($id_tp_material === -1) {
            $this->db->trans_rollback();
            return array();
        } else {
            $datos_material_educativo['TIP_MATERIAL_CVE'] = $id_tp_material;
            $datos_tipo_material_educativo['TIP_MATERIAL_CVE'] = $id_tp_material;
            $id_emp_material_educ = $this->insert_emp_materia_educativo($datos_material_educativo);
            if ($id_emp_material_educ === -1) {
                $this->db->trans_rollback();
                return array();
            } else {
                $datos_material_educativo['MATERIA_EDUCATIVO_CVE'] = $id_emp_material_educ;
                $this->db->trans_commit();
                $result['emp_materia_educativo'] = $datos_material_educativo; 
                $result['ctipo_material'] = $datos_tipo_material_educativo; 
            }
        }
    }

}
