<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene métodos para registro de participantes en talleres
 * @version 	: 1.0.0
 * @author      : Pablo José
 * */
class Registro extends MY_Controller {

    private $estado_taller;

    /*     * *********Costructor
     * Función inicial que atrae los atributos de libreria captcha_becas, form_validation y form_complete
     */

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->model('Registro_model', 'mod_registro');
        $this->load->config('general');
        $this->config->load('general');
        $this->load->model('Login_model', 'lm');
        //$this->lang->load('interface');
    }

    /*     * *********Registro de participantes
     * Función que determina el tipo de usuario y lo dirige a su página de bienvenida
     * @method: void index()
     * @author: Pablo José J.
     */

    public function index() {

        $datos_registro = array();

        if ($this->input->post()) { //Validar que la información se haya enviado por método POST para almacenado
            
            
        }
        /* Carga delegaciones */
        $this->load->model('Catalogos_generales', 'cg');
        $data['delegaciones'] = $this->cg->getDelegaciones(); //Obtiene delegaciones del modelo
        $datos_registro['delegaciones'] = dropdown_options($data['delegaciones'], 'DELEGACION_CVE', 'DEL_NOMBRE'); //Manipulamos la información a mostrar de delegación
        $lista_roles = $this->session->userdata('lista_roles');
        $main_contet = $this->load->view('login/Selection_role_tpl', $datos_registro, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    public function imprime_texto_lang() {
        $this->lang->load('interface', 'spanish');
        pr($this->lang->line('interface'));
        echo "Hola";
    }

    /**
     * ********Confirmación de registro
     * Función que cancela el registro al taller
     * @method: void enviar_confirmacion()
     * @author: Pablo José J.
     */
    public function enviar_confirmacion($datos) {
        //$this->load->config('email');
        $this->load->library('My_phpmailer');

        $mail = $this->my_phpmailer->phpmailerclass(); //Se cargan datos por default definidos en config/email

        $resultado = array('result' => false, 'error' => null);

        // $mail->IsSMTP(); // establecemos que utilizaremos SMTP
        // $mail->Host = "172.16.23.18";

        $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
        /* $mail->IsSMTP(); // telling the class to use SMTP
          $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
          // 1 = errors and messages
          // 2 = messages only
          $mail->SMTPAuth   = true;                  // enable SMTP authentication
          $mail->Host       = "smtp.gmail.com"; // sets the SMTP server
          $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
          $mail->Username   = "sied.ad.imss@gmail.com"; // SMTP account username
          $mail->Password   = "s13d.4d.1mss"; */

        $mail->addAddress($datos['usuario']->usr_correo, utf8_decode($datos['usuario']->usr_nombre . ' ' . $datos['usuario']->usr_paterno . ' ' . $datos['usuario']->usr_materno));
        $mail->Subject = utf8_decode('Confirmación de registro :: Talleres IMSS');
        $mail->msgHTML(utf8_decode($datos['plantilla']));
        //$mail->AltBody = 'This is a plain-text message body';
        // $resultado['result'] = true;
        if (!$mail->send()) { //send the message, check for errors
            $resultado['result'] = false;
            $resultado['error'] = $mail->ErrorInfo;
        }
        return $resultado;
    }

    public function confirmacion() {
        $this->template->setTitle("Registro a los talleres de actualización de recursos electrónicos");
        $this->template->setMainContent('<div class="container"><div class="text-right" style="margin-right:50px;"><a href="' . site_url('/registro') . '" class="btn btn-primary">< Ir al registro</a></div><br></div>');
        $this->template->getTemplate();
    }

    private function usuarioFactory($siapData = array(), $formData = array()) {
        $usuario = new UsuarioEntity();
        $usuario->usr_matricula = (isset($siapData['matricula']) && !empty($siapData['matricula'])) ? $siapData['matricula'] : null;
        $usuario->usr_nombre = (isset($siapData['nombre']) && !empty($siapData['nombre'])) ? $siapData['nombre'] : null;
        $usuario->usr_paterno = (isset($siapData['paterno']) && !empty($siapData['paterno'])) ? $siapData['paterno'] : null;
        $usuario->usr_materno = (isset($siapData['materno']) && !empty($siapData['materno'])) ? $siapData['materno'] : null;
        $usuario->usr_correo = (isset($formData['reg_email']) && !empty($formData['reg_email'])) ? $formData['reg_email'] : null;

        return $usuario;
    }

}

class UsuarioEntity {

    public $usr_matricula;
    public $usr_nombre;
    public $usr_paterno;
    public $usr_materno;
    public $usr_correo;
    //
    public $cve_depto_adscripcion;
    public $cve_categoria;
    public $cve_delegacion;

}
