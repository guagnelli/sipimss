<?php   defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase 
 * @version 	: 1.0.0
 * @autor 		: Jesús Z. Díaz P.
 */
class Administracion extends CI_Controller {
    var $string_values;
    /**
     * Carga de clases para el acceso a base de datos y obtencion de las variables de session
     * @access 		: public
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('seguridad');
        $this->load->config('general');
        $this->lang->load('interface');
        $this->string_values = $this->lang->line('interface'); //Cargar textos utilizados en vista
        $this->load->model('Administracion_model','admin');
    }

    /**
     * Método que 
     * @autor 		: 
     * @modified 	:
     * @access 		: public
     */
    public function index() {
        redirect(site_url()); //Redirigir al inicio del sistema, no se tiene método por default
    }


    /**
     * Método que visualiza un archivo pdf
     * @autor       : Jesús Z. Díaz P.
     * @modified    :
     * @access      : public
     */
    public function ver_archivo($identificador){
        
    }

    /**
     * Método que carga un archivo mediante ajax
     * @autor 		: Jesús Z. Díaz P.
     * @modified 	:
     * @access 		: public
     */
    public function cargar_archivo(){
        if ($this->input->is_ajax_request()) { //Sólo se accede al método a través de una petición ajax
            if($_FILES && $this->input->post()){ //Validar si se recibió archivo e información
                $resultado = array('result'=>false, 'msg'=>'');
                $data = $this->input->post(null, true); //Se obtienen datos
                
                //pr($_POST); pr($_FILES); //pr($_SESSION);
                $config = $this->colocar_configuracion($data); ///Obtener configuración para carga de archivo

                if($this->verificar_carpeta($config['upload_path'])){ //Verificar si existe carpeta donde se almacenaran los archivos, de lo contrario se crea
                    $this->load->library('upload', $config); ///Librería que carga y valida(peso, extensión) los archivos
                    if(!$this->upload->do_upload(key($_FILES))) {
                        $resultado['msg'] = $this->upload->display_errors();
                    } else {
                        //$resultado['result'] = true;
                        //$resultado['data']['raw'] = $this->upload->data('raw_name');
                        $resultado['data']['filename'] = $this->upload->data('file_name');
                        
                        $archivo = $this->comprobante_vo(array('nombre'=>$resultado['data']['filename'], 'tipo_comprobante'=>$data['tipo_comprobante'])); //Crear objeto para almacenar en BD
                        if(empty($data['identificador'])){ //Insertar
                            $resultado_almacenado = $this->admin->insert_comprobante($archivo);
                            $resultado['idb'] = $this->seguridad->encrypt_base64($resultado_almacenado['data']['identificador']);
                            $resultado['id'] = $this->seguridad->encrypt_sha512($resultado_almacenado['data']['identificador']);
                        } else { ///Actualización
                            $id = $this->seguridad->decrypt_base64($data['idc']);
                            $data_comprobante = $this->admin->get_comprobante(array('conditions'=>array('COMPROBANTE_CVE'=>$id)))[0]; ///Obtener datos de comprobante a modificar
                            $resultado['idb'] = $data['idc'];
                            $resultado['id'] = $data['identificador'];
                            $resultado_almacenado = $this->admin->update_comprobante($id, $archivo);
                            unlink($config['upload_path'].$data_comprobante['COM_NOMBRE']); //Eliminar archivo anterior
                        }
                        if($resultado_almacenado['result']==TRUE){
                            $resultado['result'] = TRUE; //Notificar el almacenado exitoso
                            $resultado['msg'] = $this->string_values['general']['carga_correcta'];
                        } else {
                            unlink($config['upload_path'].$nombre_archivo); //En caso de error eliminar archivo cargado
                        }
                    }
                } else {
                    $resultado['msg'] = $this->string_values['error']['crear_carpeta'];
                }
                echo json_encode($resultado);
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /**
     * Método que verifica la existencia de la carpeta donde se almacenarán los archivos
     * @autor       : Jesús Z. Díaz P.
     * @modified    :
     * @access      : private
     */
    private function verificar_carpeta($ruta_archivos){
        if(!file_exists($ruta_archivos) && !is_dir($ruta_archivos)){ //Si no existe la carpeta se crea
            try{
                mkdir($ruta_archivos);
            } catch(Exception $e){
                return false;
            }
        }
        return true;
    }

    private function colocar_configuracion($data){
        $configuracion = (isset($data['conf']) && !empty($data['conf'])) ? $data['conf'] : 'comprobantes'; ///Obtener path para carga de archivos
        $configuracion_carga = $this->config->item('upload_config')[$configuracion]; //Obtener parámetros definidos en archivo general de configuración

        $ruta = (isset($data['ruta']) && !empty($data['ruta'])) ? $data['ruta'] : $configuracion_carga['upload_path']; ///Obtener path para carga de archivos
        $ruta_archivos = $ruta.$this->seguridad->encrypt_carpeta_nombre($this->session->userdata('matricula'))."/"; ///Definir ruta de almacenamiento, se utiliza la matricula

        $nombre_archivo = (isset($data['nombre']) && !empty($data['nombre'])) ? $data['nombre'] : $this->session->userdata('matricula').'_'.time();

        $config['upload_path']          = $ruta_archivos;
        $config['allowed_types']        = $configuracion_carga['allowed_types'];
        $config['max_size']             = $configuracion_carga['max_size']; // Definir tamaño máximo de archivo
        $config['detect_mime']          = $configuracion_carga['detect_mime']; // Validar mime type
        $config['file_name']            = $nombre_archivo; ///Renombrar archivo

        return $config;
    }

    private function comprobante_vo($comprobante){
        $comp = new Comprobante_dao;
        $comp->COM_NOMBRE = $comprobante['nombre'];
        $comp->TIPO_COMPROBANTE_CVE = $comprobante['tipo_comprobante'];
        
        return $comp;
    }
}

class Comprobante_dao{
    //public $COMPROBANTE_CVE;
    public $COM_NOMBRE;
    public $TIPO_COMPROBANTE_CVE;
}
