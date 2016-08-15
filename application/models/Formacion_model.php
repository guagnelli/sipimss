<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Formacion_model extends CI_Model {
    var $string_values;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->lang->load('interface');
        $this->string_values = $this->lang->line('interface')['model']; //Cargar textos utilizados en vista
    }

    public function get_formacion_salud($params=null){
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

        /*$this->db->join('cnivel_academico', 'cnivel_academico.niv_academico_cve=emp_comision.niv_academico_cve', 'left');*/

        $query = $this->db->get('emp_for_personal_continua_salud'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function insert_formacion_salud($datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        
        $this->db->insert('emp_for_personal_continua_salud', $datos); //Inserción de registro
        
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
        
        return $resultado;
    }

    public function update_formacion_salud($identificador, $datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        $this->db->where('FPCS_CVE', $identificador);
        $this->db->update('emp_for_personal_continua_salud', $datos); //Inserción de registro
        
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

    public function delete_formacion_salud($params=null){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);

        $this->db->trans_begin(); //Definir inicio de transacción

        $this->db->start_cache();
        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        $this->db->stop_cache();

        $this->db->join('comprobante', 'emp_for_personal_continua_salud.COMPROBANTE_CVE=comprobante.COMPROBANTE_CVE', 'left');
        $subSql = $this->db->get('emp_comision', true); //Obtener ID de comprobante para eliminar
        $comp = $subSql->result_array();

        $this->db->delete('emp_for_personal_continua_salud'); //Eliminamos registro de comisión
        
        $this->db->flush_cache(); //Eliminar datos de cache
        
        $this->db->where('COMPROBANTE_CVE', $comp[0]['COMPROBANTE_CVE']);
        $this->db->delete('comprobante'); //Eliminamos comprobante

        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error'];
        } else {
            $this->db->trans_commit();
            $resultado['result'] = TRUE;
            $resultado['msg'] = $this->string_values['eliminacion'];
            $resultado['data'] = $comp[0];
        }
        
        return $resultado;
    }
}
