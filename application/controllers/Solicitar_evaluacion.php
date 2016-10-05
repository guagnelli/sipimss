<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag
 * fecha: 29/08/2016
 */
class Solicitar_evaluacion extends MY_Controller {
    private $cfg_actividad;

    function __construct(){
        parent::__construct();
        $this->lang->load('interface_administracion');
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Usuario_model','usuario');
        $this->load->config("general");
    }
    
    function index(){
        $this->load->model("Expediente_model","exp");
        $data = $this->exp->getECV($this->session->idempleado);
        pr($data);

        $main_content = $this->load->view('solicitar_evaluacion/index.tpl.php',$data, true);
        //$this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->multiligual = TRUE;
        $this->template->setTitle("SECD");
        $this->template->setMainTitle($data["string_value"]["lbl_secd_titulo"]);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate(FALSE,'template/sipimss/index.tpl.php');
    }


    
    function secd(){
        pr($this->input->post());
    }

    /*
Mejora de menus... LEAS
    private function obtener_secciones_evaluacion($string_text = array(), $name_controlador = 'controlador_validacion') {
       $secciones = $this->config->item('secciones');
       $result_array = array();
       foreach ($secciones as $value) {
           $prop = $this->config->item('secciones_cont_val_solicitud_eval')[$value['acronimo']];
           if ($prop['isActivo']) {
               $controlador['ruta'] = $prop['seccion'];
               $controlador['ruta_padre'] = $prop[$name_controlador];
//                pr('lbl_'.$value['acronimo'].'_titulo');
               $controlador['nombre_modulo'] = $string_text['lbl_'.$value['acronimo'].'_titulo'];
               $result_array[] = $controlador;
           }
       }
//        pr($result_array);
       return $result_array;
   }*/
    
}