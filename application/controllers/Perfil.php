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
        $this->load->model('Perfil_model','mod_perfil');
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
        
        $datosPerfil['generos'] =  array('F' => 'Femenino', 'M' => 'Masculino');
        $datosPerfil['estadosCiviles'] =  dropdown_options($this->mod_perfil->getEstadoCivil(), 'CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE'); 
        $datosPerfil['apellidoPaterno'] = 'A';
        $datosPerfil['apellidoMaterno'] = 'A';
        $datosPerfil['nombre'] = 'A';
        $datosPerfil['edad'] = 'A';       
        $datosPerfil['generoSelected'] = 'M';       
        $datosPerfil['estadoCivilSelected'] = '1';       
        $datosPerfil['correoElectronico'] = 'A';
        $datosPerfil['telParticular'] = 'A';
        $datosPerfil['telLaboral'] = 'A';
        $datosPerfil['empleosFueraImss'] = 'A';
        $datosPerfil['matricula'] = 'A';
        $datosPerfil['delegacion'] = 'A';
        $datosPerfil['nombreCategoria'] = 'A';
        $datosPerfil['claveCategoria'] = 'A';
        $datosPerfil['nombreAreaAdscripcion'] = 'A';
        $datosPerfil['nombreUnidadAdscripcion'] = 'A';
        $datosPerfil['claveAdscripcion'] = 'A';
        $datosPerfil['antiguedadAnios'] = 'A';
        $datosPerfil['antiguedadQuincenas'] = 'A';
        $datosPerfil['antiguedadDias'] = 'A';
        $datosPerfil['tipoContratacion'] = 'A';
        $datosPerfil['estatusEmpleado'] = 'A';
        $datosPerfil['clavePresupuestal'] = 'A';
        $datosPerfil['curp'] = 'A';

        
        
        $main_content = $this->load->view('perfil/index',$datosPerfil,true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }
}
