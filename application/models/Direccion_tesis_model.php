<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Direccion_tesis_model extends CI_Model {
    var $string_values;

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->lang->load('interface');
        $this->string_values = $this->lang->line('interface')['model']; //Cargar textos utilizados en vista
    }

    public function get_lista_datos_direccion_tesis($params=null){
        $resultado = array();

        /////////////////////////////////Inicio verificación existencia de validación actual
        if(array_key_exists('validation', $params)){
            if(array_key_exists('fields', $params['validation'])){
                if(is_array($params['validation']['fields'])){
                    $this->db->select($params['validation']['fields'][0], $params['validation']['fields'][1]);
                } else {
                    $this->db->select($params['validation']['fields']);
                }
            }
            if(array_key_exists('conditions', $params['validation'])){
                $this->db->where($params['validation']['conditions']);
            }
            $subquery = $this->db->get_compiled_select($params['validation']['table']); //Obtener conjunto de registros

            $this->db->select('('.$subquery.') AS validation');
        } 
        ////////////////////////////////Fin verificación existencia de validación actual

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

        $this->db->join('cnivel_academico', 'cnivel_academico.niv_academico_cve=emp_comision.niv_academico_cve', 'left');
        $this->db->join('comision_area', 'comision_area.com_area_cve=emp_comision.com_area_cve', 'left');
        $this->db->join('comprobante', 'comprobante.comprobante_cve=emp_comision.comprobante_cve', 'left');
        $this->db->join('ctipo_comprobante', 'comprobante.TIPO_COMPROBANTE_CVE=ctipo_comprobante.TIPO_COMPROBANTE_CVE', 'left');
        $this->db->join('ctipo_curso', 'ctipo_curso.TIP_CURSO_CVE=emp_comision.TIP_CURSO_CVE', 'left');

        $query = $this->db->get('emp_comision'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function insert_comision($datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        
        $this->db->insert('emp_comision', $datos); //Inserción de registro
        
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

    public function update_comision($identificador, $datos){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);
        
        $this->db->trans_begin(); //Definir inicio de transacción
        $this->db->where('EMP_COMISION_CVE', $identificador);
        $this->db->update('emp_comision', $datos); //Inserción de registro
        
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

    public function delete_comision($params=null){
        $resultado = array('result'=>null, 'msg'=>'', 'data'=>null);

        $this->db->trans_begin(); //Definir inicio de transacción

        $this->db->start_cache();
        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        $this->db->stop_cache();

        $bandera_validar = $this->db->get('hist_comision_validacion_curso', true); //Se verifica que no tenga validaciones asociadas, de lo contrario no se borra
        $bv = $bandera_validar->result_array();
        if(empty($bv)){
            $this->db->join('comprobante', 'emp_comision.COMPROBANTE_CVE=comprobante.COMPROBANTE_CVE', 'left');
            $subSql = $this->db->get('emp_comision', true); //Obtener ID de comprobante para eliminar
            $comp = $subSql->result_array();

            $this->db->delete('emp_comision'); //Eliminamos registro de comisión
            
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
        } else {
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error_validaciones_asociadas'];
        }
        
        return $resultado;
    }
}
