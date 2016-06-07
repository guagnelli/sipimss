<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Ricardo Sanchez S
 */
class Perfil extends CI_Controller {
    
    /**
     * Class Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->model('Registro_model','mod_registro');
        $this->load->config('general');
        //$this->lang->load('interface');
    }
    
    /**
     * 
     * @author Ricardo Sanchez S
     * @method void index
     */
    public function index()
    {
        $datosPerfil['generos'] =  array();
        $datosPerfil['estadosCiviles'] =  array();
        $main_content = $this->load->view('perfil/index',$datosPerfil,true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }
}
