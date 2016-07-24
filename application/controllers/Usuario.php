<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene la gestión de usuarios
 * @version 	: 1.0.0
 * @author      : Jesús Z. Díaz P.
 * */
class Usuario extends MY_Controller {
    function __construct() {
        parent::__construct();
        /*
        $this->load->config('general');
        $this->config->load('general');*/
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Usuario_model','usuario');
        $this->lang->load('interface_administracion');
    }

    /** 
     * Búsqueda y listado de usuarios
     * @method: void index()
     * @author: Jesús Z. Díaz P.
     */
    public function index() {
        $main_content = null;
        $datos = array();
        $datos['string_values'] = $this->lang->line('interface_administracion')['usuario']; //Cargar textos utilizados en vista

        //$entidades_ = array(enum_ecg::cdelegacion, enum_ecg::cdepartamento, enum_ecg::ccategoria);
        $entidades_ = array(enum_ecg::cdelegacion, enum_ecg::crol, enum_ecg::cestado_usuario);
        $datos['catalogos'] = carga_catalogos_generales($entidades_, null, null);

        ////Obtener listado de evaluaciones de acuerdo al año seleccionado
        //$datos['usuario'] = $this->usuario->get_usuario();
        /*foreach ($datos['usuario'] as $key_usu => $usu) {
            $datos['usuario'][$key_usu]['rol'] = $this->usuario->get_usuario_rol(array('conditions'=>"USUARIO_CVE=".$usu['USUARIO_CVE']));
        }*/
        
        //pr($datos);
        $datos['order_columns'] = array('USU_PATERNO'=>'Nombre', 'USU_MATRICULA'=>'Matricula', 'dep_nombre'=>'Adscripción', 'nom_delegacion'=>'Delegación', 'EDO_USUARIO_DESC'=>'Estado solicitud');
        $main_content = $this->load->view('administracion/usuario/buscador_listado', $datos, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    /**
     * Método que a través de una petición ajax muestra el listado de usuarios, estos pueden ser filtrados de acuerdo a parámetros seleccionados
     * @autor       : Jesús Díaz P.
     * @modified    : 
     * @access      : public
     * @param       : integer - $current_row - Registro actual, donde iniciará la visualización de registros
     */
    public function get_data_ajax($current_row=null){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            if(!is_null($this->input->post())){ //Se verifica que se haya recibido información por método post
                
                $datos_busqueda = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta

                $datos_busqueda['current_row'] = (isset($current_row) && !empty($current_row)) ? $current_row : 0; //Registro actual, donde inicia la visualización de registros
                
                $datos['usuario'] = $this->usuario->get_usuario($datos_busqueda); ////Obtener listado de evaluaciones de acuerdo al año seleccionado
                $datos['usuario']['string_values'] = $this->lang->line('interface_administracion')['usuario']; //Cargar textos utilizados en vista

                $datos['usuario']['current_row'] = $datos_busqueda['current_row'];
                $datos['usuario']['per_page'] = $this->input->post('per_page'); //Número de registros a mostrar por página
                
                if($datos['usuario']['total']>0){
                    foreach ($datos['usuario']['data'] as $key_usu => $usu) {
                        $datos['usuario']['data'][$key_usu]['rol'] = $this->usuario->get_usuario_rol(array('conditions'=>"USUARIO_CVE=".$usu['USUARIO_CVE']));
                    }
                    //pr($datos);
                    $this->resultado_listado($datos['usuario'], array('form_recurso'=>'#form_search', 'elemento_resultado'=>'#resultado_busqueda')); //Generar listado en caso de obtener datos
                } else {
                    echo data_not_exist(); //Mostrar mensaje de datos no existentes
                                        //echo "<script type='text/javascript'>$('.reportes_excel').hide();</script>";
                }
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /**
     * Método que imprime el listado, se agrega paginación.
     * @autor       : Jesús Díaz P.
     * @modified    : 
     * @access      : private
     * @param       : mixed[] $data Arreglo de publicaciones y de información necesaria para generar los links para la paginación
     * @param       : mixed[] $form Arreglo asociativo con 2 elementos. 
     *                  form_recurso -> identificador del formulario que contiene los elementos de filtración
     *                  elemento_resultado -> identificador del elemento donde se mostrará el listado
     */
    private function resultado_listado($data, $form){
        //$this->load->library('seguridad');
        $pagination = $this->template->pagination_data($data); //Crear mensaje y links de paginación
        $links = "<div class='col-sm-5 dataTables_info'>".$pagination['total']."</div>
                <div class='col-sm-7'>".$pagination['links']."</div>";
        echo $links.$this->load->view('administracion/usuario/resultado_busqueda', $data, TRUE).$links.'
            <script>
            $("ul.pagination li a").click(function(event){
                data_ajax(this, "'.$form['form_recurso'].'", "'.$form['elemento_resultado'].'");
                event.preventDefault();
            });
            </script>';
    }

    /**
     * Función que permite agregar y actualizar convocatorias
     * @method: void gestionar_convocatoria()
     * @author: Jesús Z. Díaz P.
     */
    /*public function gestionar_convocatoria($identificador = null){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            $datos['identificador'] = $identificador;
            $datos['msg'] = null;
            $convocatoria_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la convocatoria
            $datos['string_values'] = array_merge($this->lang->line('interface_evaluacion')['convocatoria_evaluacion']['agregar'], $this->lang->line('interface_evaluacion')['convocatoria_evaluacion']['general']); //Cargar textos utilizados en vista

            if(!is_null($this->input->post()) && !empty($this->input->post())){ //Se verifica que se haya recibido información por método post
                $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
                //pr($datos_formulario);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                
                $validations = $this->config->item('form_convocatoria_evaluacion'); //Obtener validaciones de archivo
                $this->form_validation->set_rules($validations);

                if(!empty($datos_formulario['FCH_FIN_REG_DOCENTE']) && !empty($datos_formulario['FCH_FIN_VALIDACION_1']) && !empty($datos_formulario['FCH_FIN_VALIDACION_2'])){ ///Agregar validación de comparación de fechas
                    $this->form_validation->set_rules(array(
                        array('field' => 'FCH_FIN_VALIDACION_1', 'label' => $datos['string_values']['tab_head_fecha_fin_validacion1'], 'rules' => 'required|callback_compare_date['.$datos_formulario['FCH_FIN_REG_DOCENTE'].']'),
                        array('field' => 'FCH_FIN_VALIDACION_2', 'label' => $datos['string_values']['tab_head_fecha_fin_validacion2'], 'rules' => 'required|callback_compare_date['.$datos_formulario['FCH_FIN_VALIDACION_1'].']')
                    ));
                    $this->form_validation->set_message('compare_date', $datos['string_values']['compare_date']);
                }

                if($this->form_validation->run() == TRUE){ //Validar datos
                    ///Se forma el objeto para ser insertado
                    $ce_vo = $this->convocatoria_evaluacion_vo(array('FCH_FIN_REG_DOCENTE'=>(!empty($datos_formulario['FCH_FIN_REG_DOCENTE']) ? date("Y-m-d", strtotime($datos_formulario['FCH_FIN_REG_DOCENTE'])) : null ),
                        'FCH_FIN_VALIDACION_1'=>(!empty($datos_formulario['FCH_FIN_VALIDACION_1']) ? date("Y-m-d", strtotime($datos_formulario['FCH_FIN_VALIDACION_1'])) : null ),
                        'FCH_FIN_VALIDACION_2'=>(!empty($datos_formulario['FCH_FIN_VALIDACION_2']) ? date("Y-m-d", strtotime($datos_formulario['FCH_FIN_VALIDACION_2'])) : null )));

                    if(!is_null($convocatoria_id) && !empty($convocatoria_id)){ //Se almacena en la base de datos
                        $resultado = $this->conv_eval_model->update_convocatoria_evaluacion($convocatoria_id, $ce_vo); //Actualización
                    } else {
                        $resultado = $this->conv_eval_model->insert_convocatoria_evaluacion($ce_vo); //Inserción
                        $datos['identificador'] = $this->seguridad->encrypt_base64($resultado['data']['identificador']); //Obtenemos identificador de registro aceptado y se encripta
                    }
                    $datos['msg'] = imprimir_resultado($resultado); ///Muestra mensaje
                }
            }
            if(!is_null($identificador)){ ///En caso de que se haya elegido alguna convocatoria                
                $datos['dato_convocatoria'] = $this->conv_eval_model->get_convocatoria_evaluacion(array('conditions'=>array('ADMIN_VALIDADOR_CVE'=>$convocatoria_id))); //Obtener datos
            }            
            echo $this->load->view('evaluacion/convocatoria/convocatoria_formulario', $datos, true);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    /**
     * Función que permite listar dictamenes
     * @method: void eliminar_convocatoria()
     * @param: $Identificador   string en base64    Identificador de la convocatoria codificado en base64
     * @author: Jesús Z. Díaz P.
     */
    /*public function eliminar_convocatoria($identificador){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            $datos['identificador'] = $identificador; //Identificador de convocatoria
            $datos['msg'] = null;
            $convocatoria_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la convocatoria

            $datos['string_values'] = array_merge($this->lang->line('interface_evaluacion')['convocatoria_evaluacion']['buscador'], $this->lang->line('interface_evaluacion')['convocatoria_evaluacion']['general']); //Cargar textos utilizados en vista

            $datos['dictamen_evaluacion'] = $this->conv_eval_model->get_convocatoria_dictamen_evaluacion(array('conditions'=>array('ADMIN_VALIDADOR_CVE'=>$convocatoria_id))); //Obtener datos
            if(empty($datos['dictamen_evaluacion'])){ //En caso de que este vacío se elimina
                $resultado = $this->conv_eval_model->delete_convocatoria_evaluacion(array('conditions'=>array('ADMIN_VALIDADOR_CVE'=>$convocatoria_id))); //Eliminar datos
            } else {
                $resultado = array('result'=>FALSE, 'msg'=>$datos['string_values']['eliminacion_imposible']);
            }            
            
            //echo json_encode(imprimir_resultado($resultado)); ///Muestra mensaje
            echo json_encode($resultado); ///Muestra mensaje
            
            //echo $this->load->view('evaluacion/convocatoria/dictamen_listado', $datos, true);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }
    private function convocatoria_evaluacion_vo($convocatoria){
        $ce = new Convocatoria_evaluacion_dao;
        $ce->FCH_FIN_REG_DOCENTE = (isset($convocatoria['FCH_FIN_REG_DOCENTE']) && isset($convocatoria['FCH_FIN_REG_DOCENTE'])) ? $convocatoria['FCH_FIN_REG_DOCENTE'] : NULL;
        $ce->FCH_FIN_VALIDACION_1 = (isset($convocatoria['FCH_FIN_VALIDACION_1']) && isset($convocatoria['FCH_FIN_VALIDACION_1'])) ? $convocatoria['FCH_FIN_VALIDACION_1'] : NULL;
        $ce->FCH_FIN_VALIDACION_2 = (isset($convocatoria['FCH_FIN_VALIDACION_2']) && isset($convocatoria['FCH_FIN_VALIDACION_2'])) ? $convocatoria['FCH_FIN_VALIDACION_2'] : NULL;
        return $ce;
    }
    private function convocatoria_evaluacion_dictamen_vo($dictamen){
        $ced = new Convocatoria_evaluacion_dictamen_dao;
        $ced->FCH_INICIO_EVALUACION = (isset($dictamen['FCH_INICIO_EVALUACION']) && isset($dictamen['FCH_INICIO_EVALUACION'])) ? $dictamen['FCH_INICIO_EVALUACION'] : NULL;
        $ced->FCH_FIN_EVALUACION = (isset($dictamen['FCH_FIN_EVALUACION']) && isset($dictamen['FCH_FIN_EVALUACION'])) ? $dictamen['FCH_FIN_EVALUACION'] : NULL;
        $ced->FCH_FIN_INCONFORMIDAD = (isset($dictamen['FCH_FIN_INCONFORMIDAD']) && isset($dictamen['FCH_FIN_INCONFORMIDAD'])) ? $dictamen['FCH_FIN_INCONFORMIDAD'] : NULL;
        $ced->ADMIN_VALIDADOR_CVE = (isset($dictamen['ADMIN_VALIDADOR_CVE']) && isset($dictamen['ADMIN_VALIDADOR_CVE'])) ? $dictamen['ADMIN_VALIDADOR_CVE'] : NULL;
        return $ced;
    }*/
}
/*
class Convocatoria_evaluacion_dao {
    //public $ADMIN_VALIDADOR_CVE;
    public $FCH_FIN_REG_DOCENTE;
    public $FCH_FIN_VALIDACION_1;
    public $FCH_FIN_VALIDACION_2;
}

class Convocatoria_evaluacion_dictamen_dao {
    //public $ADMIN_VALIDADOR_CVE;
    public $FCH_INICIO_EVALUACION;
    public $FCH_FIN_EVALUACION;
    public $FCH_FIN_INCONFORMIDAD;
    public $ADMIN_VALIDADOR_CVE;
}*/