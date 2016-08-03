<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Designar_validador_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_buscar_unidades($params) {
        $arra_buscar_por = array('unidad' => 'dp.nom_dependencia',
            'matricula' => 'e.EMP_MATRICULA',
            'claveadscripcion' => 'dp.departamento_cve',
            'nombre' => array('e.EMP_NOMBRE', 'e.EMP_APE_PATERNO', 'e.EMP_APE_MATERNO')
        );
        $busqueda_text = $arra_buscar_por[$params['menu_busqueda']];

        $select = array('dp.cve_delegacion "delegacion_cve"', 'dp.nom_delegacion "nom_delegacion"',
            'dp.nom_dependencia "nom_departamento"', 'dp.departamento_cve "departamento_cve"',
            'v.VALIDADOR_CVE "validador_cve"', 'v.ROL_CVE "rol_cve"', 'cr.ROL_NOMBRE "nom_rol"',
            'v.EMPLEADO_CVE "empleado_cve"',
            'CONCAT(e.EMP_NOMBRE, e.EMP_APE_PATERNO', 'e.EMP_APE_MATERNO) "nom_empleado"',
            'e.EMP_MATRICULA "matricula_empleado"', 'e.CATEGORIA_CVE "categoria_id"',
            'cat.des_clave "categoria_cve"', 'cat.nom_categoria "nom_categoria"');

        $this->db->start_cache();
//        $this->db->from('cdepartamento as dp');
        $this->db->join('validador v', 'v.DEPARTAMENTO_CVE = dp.departamento_cve', 'left');
        $this->db->join('empleado e', 'e.EMPLEADO_CVE = v.EMPLEADO_CVE', 'left');
        $this->db->join('crol cr', 'cr.ROL_CVE = v.ROL_CVE', 'left');
        $this->db->join('ccategoria cat', 'cat.id_cat = e.CATEGORIA_CVE', 'left');

        if (!empty($params['delegacion_cve'])) {
            $this->db->where('dp.cve_delegacion', $params['delegacion_cve']);
        }

        if (is_array($busqueda_text)) {
            foreach ($busqueda_text as $value) {
                $this->db->or_like($value, $params['buscar_unidad_medica']);
            }
        } else {
            $this->db->like($busqueda_text, $params['buscar_unidad_medica']);
        }
        $this->db->stop_cache();

        //Cuenta la cantidad de registros
        $num_rows = $this->db->query($this->db->select('count(*) as total')->get_compiled_select('cdepartamento as dp'))->result();
        $this->db->reset_query(); //Reset de query 
        $this->db->select($select); //Crea query de consulta
        if (isset($params['per_page']) && isset($params['current_row'])) { //Establecer límite definido para paginación 
            $this->db->limit($params['per_page'], $params['current_row']);
        }

        $order_type = (isset($params['order_type'])) ? $params['order_type'] : 'asc';

        if (isset($params['order'])) { //Establecer límite definido para paginación 
            $orden = $params['order'];
//            pr($orden);
            if ($orden === 'fullname') {
                $orden = 'e.EMP_NOMBRE, e.EMP_APE_PATERNO, e.EMP_APE_MATERNO';
            }
            $this->db->order_by($orden, $order_type);
        }

        $ejecuta = $this->db->get('cdepartamento as dp'); //Prepara la consulta ( aún no la ejecuta)
        $query = $ejecuta->result_array();
//        pr($this->db->last_query());
//        $query->free_result();
        $this->db->flush_cache(); //Limpia la cache
        $result['result'] = $query;
        $result['total'] = $num_rows[0]->total;
        return $result;
    }

    public function get_obtener_empleado($id_empleado = null) {
        if (is_null($id_empleado)) {
            return array();
        }
        $select = array('e.EMP_MATRICULA "matricula"', 'e.EMPLEADO_CVE "empleado_cve"', 'e.EDO_LABORAL_CVE "status"'
            , 'concat(e.EMP_MATRICULA, "  " ,e.EMP_NOMBRE, e.EMP_APE_PATERNO, e.EMP_APE_MATERNO) as "nom_empleado"'
            , 'e.EMP_NOMBRE "nombre"', 'e.EMP_APE_PATERNO "paterno"', 'e.EMP_APE_MATERNO "materno"'
            , 'id_cat "categoria_id"', 'c.des_clave "desc_categoria_cve"', 'nom_categoria "nom_categoria"'
            , 'e.DELEGACION_CVE "delegacion_cve"', 'dl.DEL_NOMBRE "nom_delegacion"'
            , 'dp.departamento_cve "adscripcion_cve"', 'dp.nom_dependencia "nom_dependencia_adscripcion"'
        );

        $this->db->join('empleado e', 'e.CATEGORIA_CVE = c.id_cat');
        $this->db->join('cdepartamento dp', 'dp.departamento_cve = e.ADSCRIPCION_CVE');
        $this->db->join('cdelegacion dl', 'dl.DELEGACION_CVE = dp.cve_delegacion');

        $this->db->where('e.EMPLEADO_CVE', $id_empleado);
        $this->db->select($select);

        $ejecuta = $this->db->get('ccategoria as c'); //
        $query = $ejecuta->result_array();
        return $query;
    }

    public function get_buscar_candidatos_validador_por_unidad_delegacion_categoria($params) {
        if (!empty($params['departamento_cve']) AND ! empty($params['delegacion_cve'] AND ! empty($params['categorias']))) {

            $select = array('e.EMP_MATRICULA "matricula"', 'e.EMPLEADO_CVE "empleado_cve"'
                , 'concat(e.EMP_MATRICULA, "  " ,e.EMP_NOMBRE, e.EMP_APE_PATERNO, e.EMP_APE_MATERNO) as "nom_empleado"'
                , 'id_cat "categoria_id"', 'c.des_clave "desc_categoria_cve"', 'nom_categoria "nom_categoria"'
                , 'e.DELEGACION_CVE "delegacion_cve"', 'dl.DEL_NOMBRE "nom_delegacion"'
                , 'dp.departamento_cve "adscripcion_cve"', 'dp.nom_dependencia "nom_dependencia_adscripcion"'
            );

            $this->db->join('empleado e', 'e.CATEGORIA_CVE = c.id_cat');
            $this->db->join('cdepartamento dp', 'dp.departamento_cve = e.ADSCRIPCION_CVE');
            $this->db->join('cdelegacion dl', 'dl.DELEGACION_CVE = dp.cve_delegacion');

            $this->db->where('e.EDO_LABORAL_CVE=', 1);
            $this->db->where('dp.departamento_cve', $params['departamento_cve']);
            $this->db->where('dl.DELEGACION_CVE', $params['delegacion_cve']);
        }

        $this->db->where_in('c.des_clave', $params['categorias']);

        $this->db->select($select);
        $orden = 'e.EMP_NOMBRE, e.EMP_APE_PATERNO, e.EMP_APE_MATERNO';
        $this->db->order_by($orden, 'asc');

        $ejecuta = $this->db->get('ccategoria as c'); //
        $query = $ejecuta->result_array();
        return $query;
    }

    public function get_buscar_usuarios_categoria_sied($params = null) {
        $result = array();
        if (is_null($params)) {
            return $result;
        }

        $result = array('resp_info' => null, 'resultado' => 'false');
        $params = array("Delegacion" => "{$data_siap['reg_delegacion']}", "Matricula" => "{$data_siap['asp_matricula']}", "RFC" => '');

        $client = new SoapClient("http://172.26.18.156/ServiciosWeb/wsSIED.asmx?WSDL");
        $resultado_siap = $client->__soapCall("ConsultaSIED", array($params));
        $resultado = simplexml_load_string($resultado_siap->ConsultaSIEDResult->any); //obtenemos la consulta xml
        $res_json = json_encode($resultado); // la codificamos en json
        $array_result = json_decode($res_json); // y la decodificamos en un arreglo compatible php

        $result['resp_info'] = $array_result;
        if (isset($resultado->EMPLEADOS)) {
            $result['resultado'] = true;
            $return_info = $this->regresa_datos($result, $data_siap['reg_delegacion']);
        }
        return $return_info;
    }

}
