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
        $select = array('eme.MATERIA_EDUCATIVO_CVE "emp_material_educativo_cve"' ,
                        'eme.NOMBRE_MATERIAL_EDUCATIVO "nombre_material"',
                        'eme.MAT_EDU_ANIO "material_educativo_anio"', 'eme.COMPROBANTE_CVE "comprobante"',
                        'c.COM_NOMBRE "nom_comprobante"', 'c.TIPO_COMPROBANTE_CVE "ctc_comprobante_cve"', 
                        'ctc.TIP_COM_NOMBRE "nom_ctp_comprobante"', 'ctm.TIP_MATERIAL_CVE "tipo_material_cve"', 
                        'ctm.TIP_MAT_TIPO "padre_tp_material"', 'ctm.TIP_MAT_NOMBRE "nom_tipo_material"', 
                        'ctm.TIP_MAT_OPCION "opt_tipo_material"');

        $this->db->select($select);
        $this->db->from('emp_materia_educativo eme');
        $this->db->join('ctipo_material ctm', 'ctm.TIP_MATERIAL_CVE = eme.TIP_MATERIAL_CVE');
        $this->db->join('comprobante c', 'c.COMPROBANTE_CVE = eme.COMPROBANTE_CVE', 'left');
        $this->db->join('ctipo_comprobante ctc', 'ctc.TIPO_COMPROBANTE_CVE = c.TIPO_COMPROBANTE_CVE', 'left');
        $this->db->where('eb.EMPLEADO_CVE', $empleado_cve);
        $query = $this->db->get();
        return $query->result_array();
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
                return $result;
            }
        }
    }

}
