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
    
    public function getEstadoCivil()
    {
        $query = $this->db->get('cestado_civil');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }
}