<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_generales extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "rist_delegacion"
     * 
     */
    public function getDelegaciones_rist() {
//        $this->db->select(array(''));
        $query = $this->db->get('rist_delegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cdelegacion" que es la 
     * tabla principal de delegaciones
     * 
     */
    public function getDelegaciones() {
//        $this->db->select(array(''));
        $query = $this->db->get('cdelegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

}
