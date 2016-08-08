<?php   defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase 
 * @version 	: 1.0.0
 * @autor 		: Jesús Z. Díaz P.
 */
class Administracion extends CI_Controller {

    /**
     * Carga de clases para el acceso a base de datos y obtencion de las variables de session
     * @access 		: public
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form','captcha','general'));
        $this->load->library('form_complete');
        $this->load->library('form_validation');
    }

    /**
     * Método que 
     * @autor 		: 
     * @modified 	:
     * @access 		: public
     */
    public function index() {
    }

    /**
     * Método que carga un archivo
     * @autor 		: Jesús Z. Díaz P.
     * @modified 	:
     * @access 		: public
     */
    public function cargar_archivo(){
        if ($this->input->is_ajax_request()) { //Sólo se accede al método a través de una petición ajax
            pr($_POST);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }
}
