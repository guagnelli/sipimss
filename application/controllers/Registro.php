<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Clase que contiene métodos para registro de participantes en talleres
 * @version 	: 1.0.0
 * @author      : Pablo José
 **/
class Registro extends MY_Controller {
	private $estado_taller;
    /***********Costructor
     * Función inicial que atrae los atributos de libreria captcha_becas, form_validation y form_complete
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

	/***********Registro de participantes
	 * Función que determina el tipo de usuario y lo dirige a su página de bienvenida
	 * @method: void index()
	 * @author: Pablo José J.
	 */
	public function index()
	{

		$datos_registro = array();

		if($this->input->post()) //Validar que la información se haya enviado por método POST para almacenado
		{
				$this->config->load('form_validation'); //Cargar archivo con validaciones
				$validations = $this->config->item('form_registro_docente'); //Obtener validaciones de archivo
                $this->form_validation->set_rules($validations);

				if($this->form_validation->run()) //Se ejecuta la validación de datos
				{
					$datos_registro = $this->input->post(null, true);//cargamos el array post en una variable
                    $exists = $this->validarUsuarioCupo($datos_registro['reg_matricula'], $datos_registro['reg_sesion']); //Validar que el usuario no este registrado

					if(!$exists['result'])
					{
						// obtenemos los datos del sistema de personal (SIAP)
                        $datos_siap = $this->empleados_siap->buscar_usuario_siap( array("reg_delegacion"=>$datos_registro['reg_delegacion'], "asp_matricula"=>$datos_registro['reg_matricula']) );
                        //pr($datos_siap);
						if(is_array($datos_siap) && !empty($datos_siap))
						{
							if($datos_siap['status'] == 1) //si el status del empleado esta activo (1)
							{
								$usuario = $this->usuarioFactory($datos_siap, $datos_registro);
								$taller = $this->tallerFactory($datos_siap, $datos_registro);

								$guardar_taller = $this->mod_registro->guardarUsuarioTaller($usuario, $taller);
								if($guardar_taller['result'] === TRUE){ // si guardar aspirante fue verdadero
									$agendaData = $this->mod_registro->getSesion(array('conditions'=>array('agenda_id'=>$taller->agenda_id))); //Datos de la fecha programada
									$datos = array('usuario'=>$usuario, 'taller'=>$taller, 'agenda'=>$agendaData, 'agendas'=>$sesiones_programadas);
									$plantilla = $this->load->view('template/email/enviar_confirmacion.tpl.php', $datos, true);

									$sentMail = $this->enviar_confirmacion($datos+array('plantilla'=>$plantilla)); //Enviar correo

									$this->session->unset_userdata('token'); //Eliminar token
									$this->session->set_flashdata('success', $plantilla);
									if(!$sentMail["result"]){
										$this->session->set_flashdata('error',$sentMail['error']);
									}
									redirect('/registro/confirmacion', 'refresh');
									exit();
								} else {
									$error = $guardar_taller['msg'];
								}
							} else {
								$error = "La matrícula {$datos_registro['reg_matricula']} no se encuentra en estado activo IMSS.";
							}
						} else {
							$error = "La matrícula {$datos_registro['reg_matricula']} no se encuentra registrada en la base de datos de personal IMSS ó la Delegación seleccionada no corresponde con el número de Matrícula proporcionada. Por favor verifíquelo.";
						}
					} else {
						$error = $exists['msg'];
					}
				}

                }
                    
                $datos_registro['delegaciones'] =  $this->mod_registro->getDelegaciones();//carga delegaciones
                
		$main_contet = $this->load->view('registro/registro',$datos_registro,true);
		$this->template->setMainContent($main_contet);
		$this->template->getTemplate();
	}

	public function imprime_texto_lang()
	{
		$this->lang->load('interface','spanish');
		pr($this->lang->line('interface'));
		echo "Hola";
	}

	/**
     *********Confirmación de registro
	 * Función que cancela el registro al taller
	 * @method: void enviar_confirmacion()
	 * @author: Pablo José J.
	 */
	public function enviar_confirmacion($datos){
		//$this->load->config('email');
		$this->load->library('My_phpmailer');

        $mail = $this->my_phpmailer->phpmailerclass(); //Se cargan datos por default definidos en config/email

        $resultado = array('result'=>false, 'error'=>null);

       // $mail->IsSMTP(); // establecemos que utilizaremos SMTP
        // $mail->Host = "172.16.23.18";

		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        /*$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		                                           // 1 = errors and messages
		                                           // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
		$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
		$mail->Username   = "sied.ad.imss@gmail.com"; // SMTP account username
		$mail->Password   = "s13d.4d.1mss";*/

        $mail->addAddress($datos['usuario']->usr_correo, utf8_decode($datos['usuario']->usr_nombre.' '.$datos['usuario']->usr_paterno.' '.$datos['usuario']->usr_materno));
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

	public function confirmacion(){
		$this->template->setTitle("Registro a los talleres de actualización de recursos electrónicos");
		$this->template->setMainContent('<div class="container"><div class="text-right" style="margin-right:50px;"><a href="'.site_url('/registro').'" class="btn btn-primary">< Ir al registro</a></div><br></div>');
		$this->template->getTemplate();
	}


	private function usuarioFactory($siapData = array(), $formData = array()){
		$usuario = new UsuarioEntity();
		$usuario->usr_matricula = (isset($siapData['matricula']) && !empty($siapData['matricula'])) ? $siapData['matricula'] : null;
	    $usuario->usr_nombre = (isset($siapData['nombre']) && !empty($siapData['nombre'])) ? $siapData['nombre'] : null;
	    $usuario->usr_paterno = (isset($siapData['paterno']) && !empty($siapData['paterno'])) ? $siapData['paterno'] : null;
	    $usuario->usr_materno = (isset($siapData['materno']) && !empty($siapData['materno'])) ? $siapData['materno'] : null;
	    $usuario->usr_correo = (isset($formData['reg_email']) && !empty($formData['reg_email'])) ? $formData['reg_email'] : null;

		return $usuario;
	}

}

class UsuarioEntity
{
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
