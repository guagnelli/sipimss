<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Designar_validador_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_buscar_unidades($params) {
        $select = array('dp.cve_delegacion "delegacion_cve"', 'dp.nom_delegacion "nom_delegacion"',
            'dp.nom_dependencia "nom_departamento"', 'dp.departamento_cve "departamento_cve"',
            'v.VALIDADOR_CVE "validador_cve"', 'v.ROL_CVE "rol_cve"', 'cr.ROL_NOMBRE "nom_rol"',
            'v.EMPLEADO_CVE "empleado_cve"',
            'CONCAT(e.EMP_NOMBRE, e.EMP_APE_PATERNO', 'e.EMP_APE_MATERNO) "nom_empleado"',
            'e.EMP_MATRICULA "matricula_empleado"', 'e.CATEGORIA_CVE "categoria_id"',
            'cat.des_clave "categoria_cve"', 'cat.nom_categoria "nom_categoria"');
        $this->db->select($select);
//        $this->db->from('cdepartamento as dp');
        $this->db->join('validador v','v.DEPARTAMENTO_CVE = dp.departamento_cve','left');
        $this->db->join('empleado e','e.EMPLEADO_CVE = v.EMPLEADO_CVE','left');
        $this->db->join('crol cr','cr.ROL_CVE = v.ROL_CVE','left');
        $this->db->join('ccategoria cat','cat.id_cat = e.CATEGORIA_CVE','left');
        
        if (!empty($params['delegacion_cve'])) {
            $this->db->where('dp.cve_delegacion', $params['delegacion_cve']);
        }
        $this->db->like('dp.nom_dependencia', $params['buscar_unidad_medica']);
//        $compiled_busqueda = $this->db->get_compiled_select('cdepartamento as dp');//Prepara la consulta ( aún no la ejecuta)
        $query = $this->db->get('cdepartamento as dp');//Prepara la consulta ( aún no la ejecuta)
//        pr($this->db->last_query());
        $query = $query->result_array();
//        $query->free_result();
        $result['result']=$query;
        $result['total']=98;
        return $result;
    }

}
