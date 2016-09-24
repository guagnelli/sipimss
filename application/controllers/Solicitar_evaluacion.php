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
        $this->lang->load('interface', 'spanish');
        
        //modelos
        $this->load->model("Empleado_model","emp");
        $this->load->model("Comision_academica_model","ca");
        $this->load->model("Formacion_model","fs");
        $this->load->model("Investigacion_docente_model","id");

        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");
        // $this->load->model("Empleado_model","emp");

        /*
        'lbl_fs_titulo'=>'Formaci&oacute;n en salud',
        'lbl_is_titulo'=>'Investigaci&oacute;n en salud',
        'lbl_ie_titulo'=>'Investigaci&oacute;n educativa',
        'lbl_b_titulo'=>'Becas y Comisiones',
        'lbl_fp_titulo'=>'Formaci&oacute;n profesional',
        'lbl_me_titulo'=>'Material educativo',
        'lbl_ed_titulo'=>'Educaci&oacute; a distancia',
        'lbl_em_titulo'=>'Especialidad m&ecuate;dica',
        'lbl_ad_titulo'=>'Actividad docente'
    )*/
        
        //Etiquetas
        $data["string_value"] = $this->lang->line('interface_secd')+$this->lang->line('interface')["secciones"];
        $data["cfg_actividad"] = $this->config->item("secciones");

        //información del profesor
        $params = array("conditions"=>array("empleado_cve"=>$this->session->idempleado));
        // $data["empleado"] = $this->emp->get($params);
        $data["empleado"] = $this->emp->getEmpECD($params);

        //Comisión académica
        $params = array("conditions"=>array("emp_comision.empleado_cve"=>$this->session->idempleado));
        $ca = $this->ca->get_comision_academica($params);
        if(!empty($ca)){
            $data["actividades"]["ca"] = $ca;
            $data["labels"]["ca"] = "lbl_ca_titulo";
        }

        //formacion
        $params = array("conditions"=>array("emp_for_personal_continua_salud.empleado_cve"=>$this->session->idempleado,
                                            "emp_for_personal_continua_salud.IS_VALIDO_PROFESIONALIZACION"=>1));
        $fs = $this->fs->get_formacion_salud($params);
        if(!empty($fs)){    
            $data["actividades"]["fs"] = $fs;
            $data["labels"]["fs"] = "lbl_fs_titulo";
        }
        // $data["actividades"][""]= $this->formacion->get_formacion_docente($params);
        
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
    
}