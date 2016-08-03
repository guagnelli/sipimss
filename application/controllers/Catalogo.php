<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene la gestión de usuarios
 * @version 	: 1.0.0
 * @author      : Jesús Z. Díaz P.
 * */
class Catalogo extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->lang->load('interface_administracion');
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Catalogos_generales');
    }

    /** 
     * Búsqueda y listado de usuarios
     * @method: void index()
     * @author: Jesús Z. Díaz P.
     */
    public function index() {
        /*$main_content = null;
        $datos = array();
        $datos['string_values'] = $this->lang->line('interface_administracion')['usuario']; //Cargar textos utilizados en vista

        //$entidades_ = array(enum_ecg::cdelegacion, enum_ecg::cdepartamento, enum_ecg::ccategoria);
        $entidades_ = array(enum_ecg::cdelegacion, enum_ecg::crol, enum_ecg::cestado_usuario);
        $datos['catalogos'] = carga_catalogos_generales($entidades_, null, null);
    
        $datos['order_columns'] = array('USU_MATRICULA'=>$datos['string_values']['buscador']['tab_head_matricula'], 'USU_PATERNO'=>$datos['string_values']['buscador']['tab_head_nombre'], 'nom_delegacion'=>$datos['string_values']['buscador']['tab_head_delegacion'], 'dep_nombre'=>$datos['string_values']['buscador']['tab_head_adscripcion'], 'EDO_USUARIO_DESC'=>$datos['string_values']['buscador']['tab_head_estado']);
        $main_content = $this->load->view('administracion/usuario/buscador_listado', $datos, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();*/
    }

    public function rol(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('crol')
            ->set_subject('Roles')
            ->columns('ROL_CVE', 'ROL_NOMBRE')
            ->display_as('ROL_CVE','Identificador del rol')
            ->display_as('ROL_NOMBRE','Rol');
        
        $crud->fields('ROL_NOMBRE');
        $crud->required_fields('ROL_NOMBRE');

        $crud->unset_delete(); //Remover la acción borrar
        $crud->set_js('assets/js/jquery-migrate-1.0.0.js');
        
        $main_content = $crud->render();
        //pr($main_content);
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }

    public function modulo(){
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('modulo')
            ->set_subject('Modulos')
            ->columns('MODULO_CVE', 'MOD_NOMBRE', 'MOD_RUTA')
            ->display_as('MODULO_CVE', 'Identificador del modulo')
            ->display_as('MOD_NOMBRE', 'Módulo')
            ->display_as('MOD_RUTA', 'Ruta')
            ->display_as('MOD_EST_CVE', 'Estado')
            ->display_as('IS_CONTROLADOR', 'Es controlador')
            ->display_as('MODULO_CVE_PADRE', 'Módulo padre')
            ->display_as('ORDEN_MODULO', 'Orden');

        $crud->set_relation('MOD_EST_CVE', 'cmodulo_estado', 'MOD_EST_NOMBRE');
        $crud->set_relation('MODULO_CVE_PADRE', 'modulo', 'MOD_NOMBRE');

        $crud->field_type('IS_CONTROLADOR', 'true_false', array('0'=>'No', '1'=>'Sí'), '0');
        $crud->field_type('ORDEN_MODULO', 'integer');

        $crud->set_rules('ORDEN_MODULO','Orden','numeric');
        
        //$crud->fields('MOD_NOMBRE');
        //$crud->required_fields('ROL_NOMBRE');

        $crud->unset_delete(); //Remover la acción borrar
        $crud->set_js('assets/js/jquery-migrate-1.0.0.js');
        
        $main_content = $crud->render();
         
        $this->template->setMainContent($this->load->view('administracion/catalogos/plantilla.php', $main_content, TRUE));
        $this->template->getTemplate();
    }
}