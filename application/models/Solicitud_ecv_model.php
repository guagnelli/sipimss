<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag
 * fecha: 08/09/2016
 */
class Solicitud_ecv_model extends CI_Model {

    var $genero = array('F' => 'Femenino', 'M' => 'Masculino');

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->lang->load('interface', 'spanish');
        $this->string_values = $this->lang->line('interface_secd');
    }
    
    function getValidatedCourses($emp_cve = null){
        if(is_null($emp_cve)){
            return false;
        }
        $secciones = $this->config->item('TABLAS');
        $actividades = array();
        //pr($secciones);
        foreach($secciones as $id_sec=>$seccion){
            //pr($seccion);
            $this->db->where("is_valido_profesionalizacion","1");
            $this->db->where("empleado_cve",$emp_cve);
            $actividades = $this->db->get($seccion["tabla_censo"]);
            if($actividades->num_rows()){
              $secciones[$id_sec]["actividades"]=$actividades->result_array();  
            }
            //
            unset($secciones[$id_sec]["tabla_censo"]);
            unset($secciones[$id_sec]["tabla_validacion"]);
        }
        return $actividades;
    }
}