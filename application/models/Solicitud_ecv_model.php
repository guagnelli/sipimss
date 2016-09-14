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
    
    function getAllCourses($emp_cve = null,$validated=1){
        if(is_null($emp_cve)){
            return false;
        }
        $secciones = $this->config->item('TABLAS');
        $actividades = array();
        //pr($secciones);
        foreach($secciones as $id_sec=>$seccion){
            $this->db->where("sec_info_cve",$seccion['id']);
            $nombre = $this->db->get("cseccion_informacion");
            $secciones[$id_sec]["nombre"] = $nombre = $nombre->result_array()[0];
            
            $this->db->flush_cache();
            //pr($seccion);
            echo "{$nombre['csi_entidad']}.{$nombre['nom_camp_pk']}={}";
            //$this->db->join($nombre['csi_entidad'], "{$nombre['csi_entidad'].$nombre['nom_camp_pk']}={})";
            $this->db->where("is_valido_profesionalizacion",$validated);
            $this->db->where("empleado_cve",$emp_cve);
            $actividades = $this->db->get($seccion["tabla_censo"]);
            if($actividades->num_rows() > 0){
              $secciones[$id_sec]["actividades"]=$actividades->result_array();
              unset($secciones[$id_sec]["tabla_censo"]);
              unset($secciones[$id_sec]["tabla_validacion"]);
            }else{
              unset($secciones[$id_sec]);
            }
        }
        return $secciones;
    }
}