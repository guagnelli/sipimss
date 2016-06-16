<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Ricardo Sanchez S
 */
class Perfil extends MY_Controller {

    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->model('Perfil_model', 'modPerfil');
        $this->load->model('Catalogos_generales', 'cg');
        $this->load->config('general');
        //$this->lang->load('interface');
    }

    /**
     * 
     * @author Ricardo Sanchez S
     */
    public function index() {
        $rol_seleccionado = $this->session->userdata('rol_seleccionado'); //Rol seleccionado de la pantalla de roles

        $array_menu = get_busca_hijos($rol_seleccionado, $this->uri->segment(1));
        $datosPerfil = $this->loadInfo($this->session->userdata('identificador'));

        $datosPerfil['generos'] = array('F' => 'Femenino', 'M' => 'Masculino');
        $datosPerfil['estadosCiviles'] = dropdown_options($this->modPerfil->getEstadoCivil(), 'CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE');
        $datosPerfil['formacionProfesionalOptions'] = array();
        $datosPerfil['tipoComprobanteOptions'] = array();
        $datosPerfil['array_menu'] = $array_menu;


        $main_content = $this->load->view('perfil/index', $datosPerfil, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    /**
     * 
     * @param mixed $parameters
     */
    private function loadInfo($identificador) {
        $empleadoData = $this->modPerfil->getEmpleadoData($identificador);
        $datosPerfil = array();
        if (count($empleadoData)) {
            foreach ($empleadoData['0'] as $key => $value) {
                $datosPerfil[$key] = $value;
            }
        }
        return $datosPerfil;
    }

    public function get_data_ajax_actividad() {
        $data['matricula'] = $this->session->userdata('matricula');
        $data['lista_roles'] = $this->session->userdata('lista_roles');
        
        if ($this->input->post()) { //Validar que la información se haya enviado por método POST para almacenado
            pr('soy post');
        }
        
        
        $curso = $this->cg->get_cursos(); //Obtiene delegaciones del modelo
        $data['cursos'] = dropdown_options($curso, 'CURSO_CVE', 'CUR_NOMBRE'); //Manipulamos la información a mostrar de delegación
        $ejp = $this->cg->get_ejercicios_profesionales(); //Obtiene delegaciones del modelo
        $data['ejercicios_profesionales'] = dropdown_options($ejp, 'EJE_PRO_CVE', 'EJE_PRO_NOMBRE'); //Manipulamos la información a mostrar de delegación
        
        
          $main_contet  = $this->load->view('perfil/actividad_tpl', $data, FALSE);
//        $this->template->setMainContent($main_contet);
//        $this->template->getTemplate();
//        $this->CI->load->view('perfil/actividad_tpl', $data, true);
    }

}
