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
        $busqueda_text = $arra_buscar_por[$params['menu_busqueda']]; //busqueda en texto por
        $select = array('em.EMPLEADO_CVE "empleado_cve"', 'em.EMP_MATRICULA "matricula"',
            'concat(em.EMP_NOMBRE, " ", em.EMP_APE_PATERNO, " ",em.EMP_APE_MATERNO) as "nom_docente"',
            'hv.VAL_ESTADO_CVE "estado_validacion"', 'cve.VAL_EST_NOMBRE "nombre_estado_validacion"',
            'if(hv.VAL_COMENTARIO is null or hv.VAL_COMENTARIO = "",0,1) "is_comentario"', 'hv.VAL_FCH "fecha_estado_validacion"',
            'hv.VALIDADOR_CVE  "validador_cve"', 'em.ADSCRIPCION_CVE "emp_adscripcion_cve"',
            'em.DELEGACION_CVE "emp_delegacion_cve"', 'em.CATEGORIA_CVE "emp_categoria"',
            'hv.VALIDACION_CVE "hist_validacion_cve"', 'vg.VALIDACION_GRAL_CVE "validaor_grl_cve"',
            'em.USUARIO_CVE "usuario_cve"', 'vg.VAL_CONV_CVE "convocatoria_cve"', 'cc.nom_categoria "nom_categoria"'
        );

        $this->db->start_cache();/**         * *************Inicio cache  *************** */
//        $this->db->from('cdepartamento as dp');
        $this->db->join('empleado em', 'em.EMPLEADO_CVE = vg.EMPLEADO_CVE');
        $this->db->join('ccategoria cc', 'cc.id_cat = em.CATEGORIA_CVE', 'left');
        $this->db->join('hist_validacion hv', 'hv.VALIDACION_GRAL_CVE = vg.VALIDACION_GRAL_CVE');
        $this->db->join('cvalidacion_estado cve', 'cve.VAL_ESTADO_CVE = hv.VAL_ESTADO_CVE');
        //where que son obligatorios
        $this->db->where('em.EDO_LABORAL_CVE', 1);
        $this->db->where('hv.IS_ACTUAL', 1);

        switch ($params['rol_seleccionado']) {
            case Enum_rols::Profesionalizacion:
                if ($params['DELEGACION_CVE'] > 0) {
                    $this->db->where('em.DELEGACION_CVE', $params['DELEGACION_CVE']);
                }
                if ($params['VAL_CON_CVE'] > 0) {
                    $this->db->where('vg.VAL_CONV_CVE', $params['VAL_CON_CVE']);
                }
//                pr($params['departamento_cve']);
                if (!empty($params['departamento_cve'])) {
                    $this->db->where('em.ADSCRIPCION_CVE', $params['departamento_cve']);
                }
                break;
            case Enum_rols::Validador_N2:
                if ($params['departamento_cve'] > 0) {
                    $this->db->where('em.ADSCRIPCION_CVE', $params['departamento_cve']);
                }
                if (isset($params['DELEGACION_CVE'])) {
                    $this->db->where('em.DELEGACION_CVE', $params['DELEGACION_CVE']);
                } else {//Condision de seguridad, si el validador no existe en la entidad validación
                    $this->db->where('em.DELEGACION_CVE', 0);
                }
                if (isset($params['VAL_CON_CVE'])) {
                    $this->db->where('vg.VAL_CONV_CVE', $params['VAL_CON_CVE']);
                } else {//Condision de seguridad, si el validador no existe en la entidad validación
                    $this->db->where('vg.VAL_CONV_CVE', 0);
                }
                break;
            case Enum_rols::Validador_N1:
                if (isset($params['DELEGACION_CVE'])) {
                    $this->db->where('em.DELEGACION_CVE', $params['DELEGACION_CVE']);
                } else {//Condision de seguridad, si el validador no existe en la entidad validación
                    $this->db->where('em.DELEGACION_CVE', 0);
                }
                $this->db->where('em.ADSCRIPCION_CVE', $params['DEPARTAMENTO_CVE']);
                if (isset($params['VAL_CON_CVE'])) {
                    $this->db->where('vg.VAL_CONV_CVE', $params['VAL_CON_CVE']);
                } else {//Condision de seguridad, si el validador no existe en la entidad validación
                    $this->db->where('vg.VAL_CONV_CVE', 0);
                }
                break;
        }


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

        $this->db->stop_cache(); //************************************Fin cache
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

    public function get_validacion_historico($params = null) {
        $resultado = array();

        if (array_key_exists('fields', $params)) {
            if (is_array($params['fields'])) {
                $this->db->select($params['fields'][0], $params['fields'][1]);
            } else {
                $this->db->select($params['fields']);
            }
        }
        if (array_key_exists('conditions', $params)) {
            $this->db->where($params['conditions']);
        }
        if (array_key_exists('order', $params)) {
            $this->db->order_by($params['order']);
        }
        $this->db->join('validacion_gral', "validacion_gral.VALIDACION_GRAL_CVE=hist_validacion.VALIDACION_GRAL_CVE");
        //pr($params);
        $query = $this->db->get('hist_validacion'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_validacion_registro($params = null) {
        $resultado = array();

        if (array_key_exists('fields', $params)) {
            if (is_array($params['fields'])) {
                $this->db->select($params['fields'][0], $params['fields'][1]);
            } else {
                $this->db->select($params['fields']);
            }
        }
        if (array_key_exists('conditions', $params)) {
            $this->db->where($params['conditions']);
        }
        if (array_key_exists('order', $params)) {
            $this->db->order_by($params['order']);
        }
        $this->db->join('cvalidacion_curso_estado', "{$params['table']}.VAL_CUR_EST_CVE=cvalidacion_curso_estado.VAL_CUR_EST_CVE", 'left');
        $this->db->join('hist_validacion', "{$params['table']}.VALIDACION_CVE=hist_validacion.VALIDACION_CVE", 'left');
        $this->db->join('validador', "hist_validacion.VALIDADOR_CVE=validador.VALIDADOR_CVE", 'left');
        $this->db->join('crol', "validador.ROL_CVE=crol.ROL_CVE", 'left');
        //pr($params);
        $query = $this->db->get($params['table']); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function insert_validacion_registro($tabla, $datos) {
        $resultado = array('result' => null, 'msg' => '', 'data' => null);

        $this->db->trans_begin(); //Definir inicio de transacción

        $this->db->insert($tabla, $datos); //Inserción de registro

        $data_id = $this->db->insert_id(); //Obtener identificador insertado

        if ($this->db->trans_status() === FALSE) {
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

    public function update_validacion_registro($identificador, $tabla, $datos) {
        $resultado = array('result' => null, 'msg' => '', 'data' => null);

        $this->db->trans_begin(); //Definir inicio de transacción
        $this->db->where($identificador);
        $this->db->update($tabla, $datos); //Inserción de registro

        if ($this->db->trans_status() === FALSE) {
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

    /**
     * @author LEAS 
     * @fecha 29/08/2016
     * @param $empleado_cve empleado del validador
     * @param $rol_cve rol que del usuario que inicio sesion
     * @return datos del validador
     */
    function get_validador_empleado_rol($empleado_cve = null, $rol_cve = null) {

        $this->db->where('EMPLEADO_CVE=', intval($empleado_cve));
        $this->db->where('ROL_CVE=', intval($rol_cve));
        $this->db->where('IS_ACTUAL=', 1);

        $query = $this->db->get('validador'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado = $query->result_array();
        if (!empty($resultado)) {
            $resultado = $resultado[0];
        }

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    /**
     * @author LEAS 
     * @fecha 30/08/2016
     * @param $empleado_cve 
     * @param $convocatoria 
     * @return datos del validador
     */
    function get_hist_estado_validacion_docente_actual($empleado_cve = null, $convocatoria = null) {
        if (is_null($convocatoria) || is_null($empleado_cve) || empty($convocatoria) || empty($empleado_cve)) {
//            pr('ashdlasldakl  es vacia');
            return array();
        }
//        pr($convocatoria);
//        pr($empleado_cve);
        $select = array('vg.VALIDACION_GRAL_CVE "val_grl_cve"', 'hv.VALIDACION_CVE "validacion_cve"',
            'hv.VALIDADOR_CVE "validador_cve"', 'hv.VAL_ESTADO_CVE "est_val"', 'vg.VAL_CONV_CVE',
            'hv.VAL_COMENTARIO "comentario_estado"');
        $this->db->where('hv.IS_ACTUAL', 1); //Para obtener el último registro de la actualización
        $this->db->where('vg.VAL_CONV_CVE', $convocatoria);
        $this->db->where('vg.EMPLEADO_CVE', $empleado_cve);
        $this->db->select($select);

        $this->db->join('hist_validacion hv', 'hv.VALIDACION_GRAL_CVE = vg.VALIDACION_GRAL_CVE');

        $query = $this->db->get('validacion_gral vg'); //Obtener conjunto de registros
//        pr($query);
//        if (!is_null($query->row()) AND is_object($query->row())) {
        $row_query = $query->result_array();
//        pr($row_query);
//        }
//        
//        pr($row_query);
        if (!empty($row_query)) {
            $row_query = $row_query[0];
        }
//        pr($this->db->last_query());
        return $row_query;
    }

    /**
     * @author LEAS 
     * @fecha 30/08/2016
     * @param $empleado_cve 
     * @param $convocatoria 
     * @return Historias de los estados de validación del docente, incluye todos 
     * los mensajes y comentarios de los validadores en el proceso de validación
     */
    function get_hist_estados_validacion_docente($empleado_cve, $convocatoria) {
        $select = array('vg.VALIDACION_GRAL_CVE "validaor_grl_cve"', 'hv.VALIDACION_CVE "validacion_cve"',
            'hv.VALIDADOR_CVE "validador_cve"', 'hv.VAL_ESTADO_CVE "estado_validacion"',
            'cve.VAL_EST_NOMBRE "nom_estado_validacion"', 'hv.VAL_COMENTARIO "comentario_estado"',
            'if(hv.VAL_COMENTARIO is null or hv.VAL_COMENTARIO = "",0,1) "is_comentario"',
            'hv.VAL_FCH "fecha_validacion"',
            'concat(em.EMP_NOMBRE, " ", em.EMP_APE_PATERNO, " ",em.EMP_APE_MATERNO) as "nom_validador"'
        );

        $this->db->select($select);
        $this->db->where('vg.VAL_CONV_CVE', $convocatoria);
        $this->db->where('vg.EMPLEADO_CVE', $empleado_cve);
        $this->db->join('hist_validacion hv', 'hv.VALIDACION_GRAL_CVE = vg.VALIDACION_GRAL_CVE');
        $this->db->join('cvalidacion_estado cve', 'cve.VAL_ESTADO_CVE = hv.VAL_ESTADO_CVE');
        $this->db->join('validador v', 'v.VALIDADOR_CVE = hv.VALIDADOR_CVE', 'left');
        $this->db->join('empleado em', 'em.EMPLEADO_CVE = v.EMPLEADO_CVE', 'left');
        $this->db->order_by('hv.VALIDACION_CVE', "desc");
        $this->db->order_by('vg.VAL_CONV_CVE', "desc");
        $query = $this->db->get('validacion_gral vg'); //Obtener conjunto de registros
//        pr($this->db->last_query());
        $result = $query->result_array();
        return $result;
    }

    /**
     * 
     * @autor LEAS
     * @fecha 01/09/2016
     * @param type $validadacion_cve
     * @return Obtiene la historia completa indicada por la clave
     */
    public function get_comentario_hist_validaso($validadacion_cve) {
        $select = array('concat(em.EMP_NOMBRE, " ", em.EMP_APE_PATERNO, " ",em.EMP_APE_MATERNO) as "nom_validador"',
            'hv.VAL_COMENTARIO "comentartio_estado"', 'hv.VAL_ESTADO_CVE "hist_estado"');
        $this->db->where('hv.VALIDACION_CVE', $validadacion_cve);
        $this->db->join('validador v', 'v.VALIDADOR_CVE = hv.VALIDADOR_CVE');
        $this->db->join('empleado em', 'em.EMPLEADO_CVE = v.EMPLEADO_CVE');
        $this->db->select($select);
        $query = $this->db->get('hist_validacion hv');
        $row_hist = $query->row();
        return $row_hist;
    }

    public function update_insert_estado_val_docente($parametros_insert_nuevo_hist, $parametros_update_hist_actual, $condicion_hist_actual, $empleado = null, $update = null) {

        $this->db->trans_begin(); //Definir inicio de transacción

        $this->db->where($condicion_hist_actual);
        $this->db->update('hist_validacion', $parametros_update_hist_actual); //Inserción de registro


        $this->db->insert('hist_validacion', $parametros_insert_nuevo_hist); //Inserción de registro
        $data_hist_id = $this->db->insert_id(); //Obtener identificador insertado

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array();
        } else {
            if (!is_null($update)) {
                $secciones_propiedades = $this->config->item('secciones');
                $actualizacion_correcta = 1;
                foreach ($update as $key => $val) {
                    $prop = $secciones_propiedades[$key];
                    $array_validacion = array('IS_VALIDO_PROFESIONALIZACION' => 1, 'EMPLEADO_CVE' => $empleado);
                    $this->db->where_in($prop['pk'], $val);
                    $this->db->update($prop['entidad'], $array_validacion);
                    
                    if ($this->db->trans_status() === FALSE) {
                        $actualizacion_correcta = 0;
                        break;
                    }
                }
//                pr($actualizacion_correcta);
                if ($actualizacion_correcta == 1) {//Se actualizo correctamente
                    $this->db->trans_commit();
                    $parametros_insert_nuevo_hist['VALIDACION_CVE'] = $data_hist_id;
                } else {
                    $this->db->trans_rollback();
                    return array();
                }
            } else {//No es validación por profesionalización, 
                $this->db->trans_commit();
                $parametros_insert_nuevo_hist['VALIDACION_CVE'] = $data_hist_id;
            }
            return $parametros_insert_nuevo_hist;
        }
        //pr($this->db->last_query());
    }

    /**
     * @author LEAS
     * @param type $empleado
     * @return Querys de actualización para indicar curso validado por profesionalización   
     */
    public function get_querys_updates_estado_validados_profesionalizacion($empleado) {
        $select = 'select B1 "id_registros_estado_valido", clave "seccion_informacion"
        from (
        select  hgn.EMP_COMISION_CVE "B1" , 1 "clave"
            from hist_comision_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10, 11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Formacion en salud*/
            select  hgn.FPCS_CVE "B1", 2 "clave"
            from hist_fpcs_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Investigacion en salud*/            
            select  hgn.EDIS_CVE "B1", 3 "clave"
            from hist_edis_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Investigación educativa*/
            select  hgn.EAID_CVE "B1", 4 "clave"
            from hist_eaid_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Beca*/            
            select  hgn.EMP_BECA_CVE "B1", 5 "clave"
            from hist_beca_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*formación profesional*/            
            select  EMP_FORMACION_PROFESIONAL_CVE "B1", 6 "clave"
            from hist_efp_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Material educativo*/            
            select  hgn.MATERIA_EDUCATIVO_CVE "B1", 7 "clave"
            from hist_me_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Educación a distancia*/
            select  hgn.EMP_EDU_DISTANCIA_CVE "B1", 8 "clave"
            from hist_edd_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Especialidad medica*/
            select  hgn.EMP_ESP_MEDICA_CVE "B1", 9 "clave"
            from hist_eem_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
        union /*Actividad docente*/
            select  hgn.EMP_ACT_DOCENTE_CVE "B1", 10 "clave" 
            from hist_efpd_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  hgn.VAL_CUR_EST_CVE = 1 and hv.VAL_ESTADO_CVE in(10,11) and  vg.EMPLEADO_CVE = ' . $empleado . '
    ) as res order by clave;';

        $query = $this->db->query($select)->result();
        $this->db->reset_query();
//        pr($this->db->last_query());
        $updates = array();
        if (!empty($query)) {//Construye los querys update
            /* [0] => stdClass Object(
              [id_registros_estado_valido] => 160
              [seccion_informacion] => 1) */
//            $updates = $this->genera_querys_update_is_profesionalizacion($query, $empleado);
            $updates = $this->genera_array_querys_update_is_profesionalizacion($query);
        }
        return $updates;
    }

    /**
     * 
     * @author LEAS
     * @param type $array_ids
     * @param type $empleado
     * Crear los querys de actual
     */
    private function genera_array_querys_update_is_profesionalizacion($array_ids) {
        $array_res = array();
        for ($i = 0; $i < count($array_ids); $i++) {
            $value = $array_ids[$i];
            if (!isset($array_res[$value->seccion_informacion])) {//si no existe el array, se crea el espacio
                $array_res[$value->seccion_informacion] = array();
                $array_res[$value->seccion_informacion][] = $value->id_registros_estado_valido;
            } else {
                $array_res[$value->seccion_informacion][] = $value->id_registros_estado_valido;
            }
        }
        return $array_res;
    }

    /**
     * 
     * @author LEAS
     * @param type $array_ids
     * @param type $empleado
     * Crear los querys de actual
     */
    private function genera_querys_update_is_profesionalizacion($array_ids, $empleado) {
        $secciones_propiedades = $this->config->item('secciones');
        $prop = '';
        $puntero = '';
        $array_res = array();
        $string = '';
        for ($i = 0; $i < count($array_ids); $i++) {
            $value = $array_ids[$i];
            $prop = $secciones_propiedades[$value->seccion_informacion];
            if (!isset($array_res[$value->seccion_informacion])) {//si no existe el array, se crea el espacio
                if (!empty($puntero)) {
                    $tmp = $array_res[$puntero];
                    $tmp .= $string . " where EMPLEADO_CVE = " . $empleado . " AND IS_VALIDO_PROFESIONALIZACION = 0 ";
                    $array_res[$puntero] = $tmp;
                }
                $array_res[$value->seccion_informacion] = "update " . $prop['entidad'] . " set ";
                $string = $prop['pk'] . " = " . $value->id_registros_estado_valido;
                $puntero = $value->seccion_informacion;
            } else {
                $string .= ", " . $prop['pk'] . " = " . $value->id_registros_estado_valido;
            }

            if (!isset($array_ids[$i + 1])) {//Si no existe el siguiente indice, lo termina
                if (!empty($puntero)) {
                    $tmp = $array_res[$puntero];
                    $tmp .= $string . " where EMPLEADO_CVE = " . $empleado . " AND IS_VALIDO_PROFESIONALIZACION = 0 ";
                    $array_res[$puntero] = $tmp;
                }
            }
        }

//        pr($array_res);
    }

    public function insert_inicio_estado_correccion($parametros_hist, $parametros_val_gen) {

        $this->db->trans_begin(); //Definir inicio de transacción

        $this->db->insert('validacion_gral', $parametros_val_gen); //Inserción de registro
        $data_gen_id = $this->db->insert_id(); //Obtener identificador insertado

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return array();
        } else {
            $parametros_hist['VALIDACION_GRAL_CVE'] = $data_gen_id;
            $this->db->insert('hist_validacion', $parametros_hist); //Inserción de registro
            $data_hist_id = $this->db->insert_id(); //Obtener identificador insertado
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return array();
            } else {
                $this->db->trans_commit();
                $parametros_val_gen['VALIDACION_GRAL_CVE'] = $data_gen_id;
                $parametros_hist['VALIDACION_CVE'] = $data_hist_id;
                $result['validacion_gral'] = $parametros_val_gen;
                $result['hist_validacion'] = $parametros_hist;
                return $result;
            }
        }
        //pr($this->db->last_query());
    }

    public function get_is_envio_validacion($empleado, $hist_estados_evaluar) {
        $result_estados = '';
        $or = '';
        foreach ($hist_estados_evaluar as $value) {
            $result_estados .= $or . ' hv.VAL_ESTADO_CVE = ' . $value;
            $or = ' or ';
        }
        $where_estados = ' hgn.VAL_CUR_EST_CVE in(1,2) ';

        $select = 'select sum(A1) "num_registros_cargados", sum(B1) "num_registros_est_valido"  
            from (
            /*Comisiones academicas*/
            select count(*) "A1", 0 "B1"  from emp_comision where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union/*Formacion en salud*/
            select count(*) "A1", 0 "B1" from emp_for_personal_continua_salud where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union /*Investigacion en salud*/
            select count(*) "A1", 0 "B1" from emp_desa_inv_salud where EMPLEADO_CVE = ' . $empleado . '
            union /*Investigación educativa*/
            select count(*) "A1", 0 "B1" from emp_act_inv_edu where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union /*Beca*/
            select count(*) "A1", 0 "B1" from emp_beca where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union /*formación profesional*/
            select count(*) "A1", 0 "B1" from emp_formacion_profesional where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union /*Material educativo*/
            select count(*) "A1", 0 "B1" from emp_materia_educativo where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union /*Educación a distancia*/
            select count(*) "A1", 0 "B1" from emp_educacion_distancia where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union /*Especialidad medica*/
            select count(*) "A1", 0 "B1" from emp_esp_medica where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union /*Actividad docente*/
            select count(*) "A1", 0 "B1" from emp_actividad_docente where EMPLEADO_CVE = ' . $empleado . ' and IS_VALIDO_PROFESIONALIZACION = 0
            union 
            /*Comisiones academicas*/
            select 0 "A1", count(*) "B1"
            from hist_comision_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Formacion en salud*/
            select 0 "A1", count(*) "B1"
            from hist_fpcs_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Investigacion en salud*/
            select 0 "A1", count(*) "B1"
            from hist_edis_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Investigación educativa*/
            select 0 "A1", count(*) "B1"
            from hist_eaid_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Beca*/
            select 0 "A1", count(*) "B1"
            from hist_beca_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*formación profesional*/
            select 0 "A1", count(*) "B1"
            from hist_efp_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Material educativo*/
            select 0 "A1", count(*) "B1"
            from hist_me_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Educación a distancia*/
            select 0 "A1", count(*) "B1"
            from hist_edd_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and ( ' . $result_estados . ' ) and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Especialidad medica*/
            select 0 "A1", count(*) "B1"
            from hist_eem_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            union /*Actividad docente*/
            select 0 "A1", count(*) "B1"
            from hist_efpd_validacion_curso hgn 
            join hist_validacion hv on hv.VALIDACION_CVE = hgn.VALIDACION_CVE
            join validacion_gral vg on vg.VALIDACION_GRAL_CVE = hv.VALIDACION_GRAL_CVE
            where  ' . $where_estados . ' and (' . $result_estados . ') and  vg.EMPLEADO_CVE = ' . $empleado . '
            ) as res';

        $query = $this->db->query($select)->result();
        $this->db->reset_query();
        $is_validados = 1;
//        pr($query);
        if (!empty($query)) {
            $num_reg_cargados = intval($query[0]->num_registros_cargados);
            $numero_registros_validos = intval($query[0]->num_registros_est_valido);
            $is_validados = ($num_reg_cargados == $numero_registros_validos) ? 1 : 0; //Si el valor es igual, entonces todo se encuentra validado
        }
//        pr($this->db->last_query());
        return $is_validados;
    }

}
