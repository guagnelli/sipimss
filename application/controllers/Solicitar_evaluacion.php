<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag
 * fecha: 29/08/2016
 */
class Solicitar_evaluacion extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->lang->load('interface_administracion');
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Usuario_model','usuario');
    }
    
    function index(){
        $this->lang->load('interface', 'spanish');
        /*
        'secciones'=>array(
        'lbl_ca_titulo'=>'Comisión académica',
        'lbl_fs_titulo'=>'Formaci&oacute;n en salud',
        'lbl_is_titulo'=>'Investigaci&oacute;n en salud',
        'lbl_ie_titulo'=>'Investigaci&oacute;n educativa',
        'lbl_b_titulo'=>'Becas y Comisiones',
        'lbl_fp_titulo'=>'Formaci&oacute;n profesional',
        'lbl_me_titulo'=>'Material educativo',
        'lbl_ed_titulo'=>'Educaci&oacute; a distancia',
        'lbl_em_titulo'=>'Especialidad m&ecuate;dica',
        'lbl_ad_titulo'=>'Actividad docente'
    ),*/
        //modelos
        $this->load->model("Empleado_model","emp");
        $this->load->model("Formacion_model","formacion");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        
        //Etiquetas
        $data["string_value"] = $this->lang->line('interface_secd')+$this->lang->line('interface')["secciones"];

        //información del profesor
        $params = array("fields"=>array("empleado_cve","emp_matricula"),
                        "conditions"=>array("empleado_cve"=>$this->session->idempleado));
        $data["empleado"] = $this->emp->get($params);

        $params = array("conditions"=>array("emp_formacion_profesional.empleado_cve"=>$this->session->idempleado,
                                            "emp_formacion_profesional.IS_VALIDO_PROFESIONALIZACION"=>1));
        $data["actividades"]= $this->formacion->get_formacion_docente();
        
        $main_content = $this->load->view('solicitar_evaluacion/index.tpl.php',$data, true);
        //$this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->multiligual = TRUE;
        $this->template->setTitle("SECD");
        $this->template->setMainTitle($data["string_value"]["lbl_secd_titulo"]);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate(FALSE,'template/sipimss/index.tpl.php');
    }
    
    function secd(){
        
    }
    
}