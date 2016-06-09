<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getGeneros()
    {
        
    }
    
    /**
     * 
     * @return Array
     */
    public function getEstadoCivil()
    {
        $query = $this->db->get('cestado_civil');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }
    
    /**
     * 
     * @param int $identificador
     */
    public function getEmpleadoData($identificador)
    {
        $this->db->select('*')
                ->from('cempleado')
                ->join('cestado_civil', 'cempleado.cestado_civil_cve = cestado_civil.cestado_civil_cve', 'left' )
                ->join('ctipo_contratacion', 'cempleado.tip_contratacion_cve = ctipo_contratacion.tip_contratacion_cve', 'left' )
                
                ->join()
                ->where();
        
                    
    }
}