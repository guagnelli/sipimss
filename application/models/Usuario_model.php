<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    var $string_values;

	public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
        $this->lang->load('interface_administracion');
        $this->string_values = $this->lang->line('interface_administracion')['usuario']['model']; //Cargar textos utilizados en vista
    }

    /*public function delete_convocatoria_evaluacion($params=null){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción

        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        
        $this->db->delete('admin_validador');
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error'];
        } else {
            $this->db->trans_commit();
            $resultado['result'] = TRUE;
            $resultado['msg'] = $this->string_values['eliminacion'];
        }
        
        return $resultado;
    }*/

    public function get_usuario($params=null){
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

        $this->db->join('cdepartamento', 'usuario.ADSCRIPCION_CVE=cdepartamento.departamento_cve', 'left');
        $this->db->join('cestado_usuario', 'usuario.ESTADO_USUARIO_CVE=cestado_usuario.ESTADO_USUARIO_CVE', 'left');
        $this->db->join('ccategoria', 'usuario.CATEGORIA_CVE=ccategoria.des_clave', 'left');

        $query = $this->db->get('usuario'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_usuario_listado($params=array()){
        $resultado = array();

        $query_usuario_rol = "";
        if(exist_and_not_null($params['srch_rol'])){
            $this->db->select('USUARIO_CVE');
            $this->db->where('ROL_CVE', $params['srch_rol']);
            $this->db->where('usuario_rol.USUARIO_CVE=usuario.USUARIO_CVE');
            $query_usuario_rol = $this->db->get_compiled_select('usuario_rol', TRUE);
        }
        
        ///////////////////// Iniciar almacenado de parámetros en cache /////////////////////////
        $this->db->start_cache();

        if(exist_and_not_null($params['srch_rol'])){
            $this->db->where_in('usuario.USUARIO_CVE', $query_usuario_rol, false);
        }

        if(exist_and_not_null($params['srch_delegacion'])){
            $this->db->where('cdepartamento.cve_delegacion', $params['srch_delegacion']);
        }

        if(exist_and_not_null($params['srch_est_usu'])){
            $this->db->where('usuario.ESTADO_USUARIO_CVE', $params['srch_est_usu']);
        }
        
        if(exist_and_not_null($params['srch_nombre'])){ 
            $this->db->group_start();
            $this->db->or_like('usuario.USU_NOMBRE',$params['srch_nombre']);
            $this->db->or_like('usuario.USU_PATERNO',$params['srch_nombre']);
            $this->db->or_like('usuario.USU_MATERNO',$params['srch_nombre']);
            $this->db->or_like('usuario.USU_MATRICULA', $params['srch_nombre']);
            $this->db->group_end();
        }

        $this->db->join('cdepartamento', 'usuario.ADSCRIPCION_CVE=cdepartamento.departamento_cve', 'left');
        $this->db->join('cestado_usuario', 'usuario.ESTADO_USUARIO_CVE=cestado_usuario.ESTADO_USUARIO_CVE', 'left');

        $this->db->stop_cache();
        /////////////////////// Fin almacenado de parámetros en cache ///////////////////////////
        $this->db->select('usuario.*');
        
        ///////////////////////////// Obtener número de registros ///////////////////////////////
        $nr = $this->db->get_compiled_select('usuario'); //Obtener el total de registros
        $num_rows = $this->db->query("SELECT count(*) AS total FROM (".$nr.") AS temp")->result();
        //pr($this->db->last_query());
        /////////////////////////////// FIN número de registros /////////////////////////////////

        $this->db->select(array("USU_MATRICULA, CONCAT(USU_PATERNO,' ',USU_MATERNO,' ',USU_NOMBRE) as nombre, nom_delegacion, dep_nombre, cestado_usuario.EDO_USUARIO_DESC, USUARIO_CVE"));

        if(isset($params['order']) && !empty($params['order'])){
            $tipo_orden = (isset($params['order_type']) && !empty($params['order_type'])) ? $params['order_type'] : "ASC";
            $this->db->order_by($params['order'], $tipo_orden);
        }
        
        if(isset($params['per_page']) && isset($params['current_row'])){ //Establecer límite definido para paginación
            $this->db->limit($params['per_page'], $params['current_row']);
        }

        $query = $this->db->get('usuario'); //Obtener conjunto de registros
        //pr($this->db->last_query());

        $resultado['total']=$num_rows[0]->total;
        $resultado['columns']=$query->list_fields();
        $resultado['data']=$query->result_array();
        //pr($resultado['data']);
        $this->db->flush_cache();
        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_usuario_rol($params=array()){
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

        $this->db->join('crol', 'usuario_rol.ROL_CVE=crol.ROL_CVE');

        $query = $this->db->get('usuario_rol'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_rol_modulo($params=array()){
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

        //$this->db->join('crol', 'usuario_rol.ROL_CVE=crol.ROL_CVE');

        $query = $this->db->get('rol_modulo'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function insert_usuario($datos, $datos_rol=array()){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        
        $this->db->insert('usuario', $datos); //Inserción de registro
        
        $data_id = $this->db->insert_id(); //Obtener identificador insertado

        if(!empty($datos_rol)){ //Se verifica que exista información de roles para ser almacenada
            foreach ($datos_rol as $rol) { //Insertar nuevos roles relacionados
                $this->db->insert('usuario_rol', array('USUARIO_CVE'=>$data_id , 'ROL_CVE'=>$rol)); //Inserción de registro
            }
        }
        
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
        
        return $resultado;
    }

    public function update_usuario($identificador, $datos, $datos_rol=array()){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        $this->db->where('USUARIO_CVE', $identificador);
        $this->db->update('usuario', $datos); //Inserción de registro
        if(!empty($datos_rol)){ //Se verifica que exista información de roles para ser almacenada
            $this->db->where('USUARIO_CVE', $identificador); //Eliminar roles relacionados a usuario
            $this->db->delete('usuario_rol');
            foreach ($datos_rol as $rol) { //Insertar nuevos roles relacionados
                $this->db->insert('usuario_rol', $rol); //Inserción de registro
            }
        }

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

        return $resultado;
    }

    public function update_usuario_estado($identificador, $datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        
        $this->db->where('USUARIO_CVE', $identificador);
        $this->db->update('usuario', $datos); //Inserción de registro
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error'];
        } else {
            $this->db->trans_commit();
            //$resultado['data']['identificador'] = $identificador;
            $resultado['msg'] = $this->string_values['actualizacion'];
            $resultado['result'] = TRUE;
        }

        return $resultado;
    }

    public function update_rol_modulo($datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        
        $this->db->truncate('rol_modulo'); //Borrar todos los datos

        foreach ($datos as $rm) {
            $this->db->insert('rol_modulo', $rm); //Inserción de registros
        }
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error'];
        } else {
            $this->db->trans_commit();
            //$resultado['data']['identificador'] = $identificador;
            $resultado['msg'] = $this->string_values['actualizacion'];
            $resultado['result'] = TRUE;
        }

        return $resultado;
    }
}
