<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Validacion_docente_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
        $this->string_values = $this->lang->line('interface')['model']; //Cargar textos utilizados en vista
    }

    public function get_buscar_docentes_validar($params) {
        $arra_buscar_por = array(
            'matricula' => 'em.EMP_MATRICULA',
            'clavecategoria' => 'em.CATEGORIA_CVE',
            'nombre' => array('em.EMP_NOMBRE', 'em.EMP_APE_PATERNO', 'em.EMP_APE_MATERNO')
        );
        $busqueda_text = $arra_buscar_por[$params['menu_busqueda']];//busqueda en texto por
        $adscripcion = $params['DEPARTAMENTO_CVE'];
        $delegacion = (strlen($params['DELEGACION_CVE']) > 1) ? $params['DELEGACION_CVE'] : '0' . $params['DELEGACION_CVE'];
        $convocatoria = $params['VAL_CON_CVE'];
        $select = array('em.EMPLEADO_CVE "empleado_cve"', 'em.EMP_MATRICULA "matricula"',
            'concat(em.EMP_NOMBRE, " ", em.EMP_APE_PATERNO, " ",em.EMP_APE_MATERNO) as "nom_docente"',
            'hv.VAL_ESTADO_CVE "estado_validacion"', 'cve.VAL_EST_NOMBRE "nombre_estado_validacion"', 
            'hv.VAL_COMENTARIO "comentario_estado"', 'hv.VAL_FCH "fecha_estado_validacion"',
            'hv.VALIDADOR_CVE  "validador_cve"', 'em.ADSCRIPCION_CVE "emp_adscripcion_cve"',
            'em.DELEGACION_CVE "emp_delegacion_cve"', 'em.CATEGORIA_CVE "emp_categoria"',
            'hv.VALIDACION_CVE "hist_validacion_cve"', 'vg.VALIDACION_GRAL_CVE "validaor_grl_cve"',
            'em.USUARIO_CVE "usuario_cve"'
            );

        $this->db->start_cache();
//        $this->db->from('cdepartamento as dp');
        $this->db->join('empleado em', 'em.EMPLEADO_CVE = vg.EMPLEADO_CVE');
        $this->db->join('hist_validacion hv', 'hv.VALIDACION_GRAL_CVE = vg.VALIDACION_GRAL_CVE');
        $this->db->join('cvalidacion_estado cve', 'cve.VAL_ESTADO_CVE = hv.VAL_ESTADO_CVE');
        //where que son obligatorios
        $this->db->where('em.EDO_LABORAL_CVE', 1);
        $this->db->where('hv.IS_ACTUAL', 1);
        $this->db->where('em.ADSCRIPCION_CVE', $adscripcion);
        $this->db->where('em.DELEGACION_CVE', $delegacion);
        $this->db->where('vg.VAL_CONV_CVE', $convocatoria);
        if (!empty($params['cvalidacion_estado'])) {//where estado de la validación, no es obligatorio
            $this->db->where('hv.VAL_ESTADO_CVE', $params['cvalidacion_estado']);
        }

        if (is_array($busqueda_text)) {//si es un array lo recorre, ejemplo es la concatenación de nombre, ap y am
            foreach ($busqueda_text as $value) {
                $this->db->or_like($value, $params['buscador_docente']);
            }
        } else {//pone un like para buscar por matricula, o categoria
            $this->db->like($busqueda_text, $params['buscador_docente']);
        }
        $this->db->stop_cache();

        //Cuenta la cantidad de registros
        $num_rows = $this->db->query($this->db->select('count(*) as total')->get_compiled_select('validacion_gral as vg'))->result();
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
                $orden = 'em.EMP_NOMBRE, em.EMP_APE_PATERNO, em.EMP_APE_MATERNO';
            }
            $this->db->order_by($orden, $order_type);
        }

        $ejecuta = $this->db->get('validacion_gral as vg'); //Prepara la consulta ( aún no la ejecuta)
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

    public function delete_vinculo_validador($id_validador = null) {
        $result_asignar_validador['result'] = -1;
        $result_asignar_validador['entidad'] = '';
        if (is_null($id_validador)) {
            return $result_asignar_validador;
        }
        $res = $this->get_validador($id_validador);
        if (!empty($res)) {
            $res = $res[0];
            $this->db->where('VALIDADOR_CVE', $id_validador);
            $this->db->delete('validador');
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $result_asignar_validador['result'] = $id_validador;
                $result_asignar_validador['entidad'] = $res;
            }
        }
        return $result_asignar_validador;
    }

    /**
     * 
     * @param autor LEAS
     * @param type $validador
     * @return type
     */
    public function get_validador($validador = null) {
        if (!is_null($validador)) {
            $this->db->where('VALIDADOR_CVE', $validador);
        }
        $query = $this->db->get('validador');
        $array_validador = $query->result_array();
        $query->free_result();
        return $array_validador;
    }

    public function insert_designar_validador($parametros) {
        if (empty($parametros)) {
            return -1;
        }
        $parametros['DELEGACION_CVE'] = (strlen($parametros['DELEGACION_CVE']) < 2) ? '0' . $parametros['DELEGACION_CVE'] : $parametros['DELEGACION_CVE'];
        $this->db->insert('validador', $parametros); //Almacena usuario
        $obtiene_id_validador_designado = $this->db->insert_id();
//        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            return $obtiene_id_validador_designado;
        }
    }

    public function get_buscar_empleado_delegacion($id_empleado = null, $id_delegacion = null) {
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

        $this->db->where('e.EMP_MATRICULA', $id_empleado);
        $this->db->where('e.DELEGACION_CVE', $id_delegacion);
        $this->db->select($select);
        $ejecuta = $this->db->get('ccategoria as c'); //
        $query = $ejecuta->result_array();
//        pr($this->db->last_query());
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
    
    public function get_validacion_registro($params=null){
        $resultado = array();

        if(array_key_exists('fields', $params)){
            if(is_array($params['fields'])){
                $this->db->select($params['fields'][0], $params['fields'][1]);
            } else {
                $this->db->select($params['fields']);
            }
        }
        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        if(array_key_exists('order', $params)){
            $this->db->order_by($params['order']);
        }
        $this->db->join('cvalidacion_curso_estado', "{$params['table']}.VAL_CUR_EST_CVE=cvalidacion_curso_estado.VAL_CUR_EST_CVE", 'left');
        $this->db->join('hist_validacion', "hist_comision_validacion_curso.VALIDACION_CVE=hist_validacion.VALIDACION_CVE", 'left');
        $this->db->join('validador', "hist_validacion.VALIDADOR_CVE=validador.VALIDADOR_CVE", 'left');
        $this->db->join('crol', "validador.ROL_CVE=crol.ROL_CVE", 'left');

        $query = $this->db->get($params['table']); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function insert_validacion_registro($tabla, $datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        
        $this->db->insert($tabla, $datos); //Inserción de registro
        
        $data_id = $this->db->insert_id(); //Obtener identificador insertado
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error'];
        } else {
            $this->db->trans_commit();
            $resultado['data']['identificador'] = $data_id;
            $resultado['msg'] = $this->string_values['insercion'];
            $resultado['result'] = TRUE;
        }
        //pr($this->db->last_query());
        return $resultado;
    }

    public function update_validacion_registro($identificador, $tabla, $datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        $this->db->where($identificador);
        $this->db->update($tabla, $datos); //Inserción de registro
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error'];
        } else {
            $this->db->trans_commit();
            $resultado['data']['identificador'] = $identificador;
            $resultado['msg'] = $this->string_values['actualizacion'];
            $resultado['result'] = TRUE;
        }
        //pr($this->db->last_query());
        return $resultado;
    }

}
