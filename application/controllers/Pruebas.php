<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona EL DASHBOARD
 * @version 	: 1.0.0
 * @autor 		: Pablo José D.
 */
class Pruebas extends CI_Controller {

    /**
     * Carga de clases para el acceso a base de datos y obtencion de las variables de session
     * @access 		: public
     */
    public function __construct() {
        parent::__construct();
//        $this->load->model('Bitacora_model', 'bitacora');
        $this->load->model('Login_model', 'lm');
        $this->load->library('enum_privilegios_conf');
        $this->load->library('enum_estados_empleado');
        $this->config->load('general');
//        $this->input->server();
    }

    public function index() {
        /*
        $parametros = $this->config->item('parametros_bitacora');
        $parametros['USUARIO_CVE'] = 56;
        //$parametros['BIT_VALORES'] = 'valor|nada|nulo';
//        $parametros['BIT_IP'] = $this->input->ip_address();
        $parametros['BIT_IP'] = $this->get_real_ip();
//                $_SERVER['HTTP_CLIENT_IP'];
        $parametros['BIT_RUTA'] = 'https://facebook.com/carlitadddd';
//        $parametros['MODULO_CVE'] = null;

//        pr($this->input->ip_address());
//        pr($_SERVER['REMOTE_ADDR']);
//        pr($_SERVER['HTTP_FORWARDED']);
        $result = $this->bitacora->set_bitacora($parametros);
        if ($result) {
            pr("Hola y bienvenidos!! ");
        } else {
            pr("No se pudo insertar la bitacora!! ");
        }
        
        $parametros_log = $this->config->item('parametros_log');
        $parametros_log['USUARIO_CVE'] = 56;
        $parametros_log['LOG_INI_SES_IP'] = '11.26.25.94';
        
        $resultado = $this->bitacora->set_log_ususario($parametros_log);
        if ($resultado) {
            pr("log satisfactorio!! ");
        } else {
            pr("No se pudo insertar el log!! ");
        }
        */
//        hash('sha512', "password123"."987654321" )
        $var = '10010629';
        $pass = 123;
//        $pass_encrypt = hash('SHA512', $pass);
////        pr($pass_encrypt);
////        $var = '1001062';
//        $resultado = $this->bitacora->set_login($var, $pass);
//        if(!is_null($resultado[0]) && $resultado[0]['cantidad_reg']){
//            
//        }else{
//            
//        }
//        pr($resultado);
        $resultado = $this->lm->get_usuario_rol_modulo_sesion(1);
        pr($resultado);
        
    }

    function get_real_ip() {

        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }

}
