<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona la evaluación docente por parte del grupo.
 * @version 	: 1.0.0
 * @author      : Jesús Z. Díaz P.
 * */
class Evaluacion_docente extends MY_Controller {
    /*     * *********Costructor
     * Función inicial que carga los elementos utilizados en todos los métodos de la clase
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_complete');
        /*$this->load->library('form_validation');*/
        $this->load->library('seguridad');
        $this->load->model('evaluacion_docente_model','eval_doce_model');
        $this->lang->load('interface_evaluacion');
        $this->load->helper('date');
        $this->lang->load('interface');
        //pr($_SESSION);
        //$this->session->set_userdata('rol_seleccionado_cve', '8');
    }

    /** 
     * Búsqueda y listado de convocatorias de evaluación
     * @method: void index()
     * @author: Jesús Z. Díaz P.
     */
    /*public function index() {
        $main_content = null;
        $datos = array();
        $anio_actual = $this->anio_actual(); //Obtener año seleccionado para mostrar convocatorias
        $datos['string_values'] = array_merge($this->lang->line('interface_evaluacion')['evaluacion'], $this->lang->line('interface_evaluacion')['general']); //Cargar textos utilizados en vista
        //pr($_SESSION);
        $empleado_cve = $this->session->userdata('idempleado'); //Identificador de usuario logueado
        
        ////Obtener listado de evaluaciones de acuerdo al año seleccionado
        $datos['dictamen'] = $this->eval_doce_model->get_evaluacion_docente(array('conditions'=>"EMPLEADO_CVE='".$empleado_cve."'"));
        
        $main_content = $this->load->view('evaluacion/evaluacion_docente/listado', $datos, true);
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
        //pr($datos);
        //exit();
    }*/

    public function index(){
        $main_content = null;
        $datos = array();

        if($this->validar_evaluador()){
            $dictamen = $this->eval_doce_model->get_dictamen(array('conditions'=>"DATE_FORMAT(now(),'%y-%m-%d') between FCH_INICIO_EVALUACION and FCH_FIN_EVALUACION")); ////Obtener listado de solicitudes a evaluar de acuerdo a convocatoria activa
            if(!empty($dictamen)){ //Agregar dictamen a sesión
                $datos['dictamen'] = $dictamen;
            } else {
                $dictamen[0]['ADMIN_DICTAMEN_EVA_CVE'] = 0;
            }
            $this->session->set_userdata(array('dictamen'=>$dictamen[0]));

            $datos['string_values'] = array_merge($this->lang->line('interface_evaluacion')['evaluacion']['dictamen'], $this->lang->line('interface_evaluacion')['evaluacion']['docente'], $this->lang->line('interface_evaluacion')['general']); //Cargar textos utilizados en vista
            $datos['order_columns'] = array('empleado.EMP_MATRICULA' => $datos['string_values']['matricula_docente'], 'empleado.EMP_NOMBRE' => $datos['string_values']['nombre_docente']);
            //pr($datos);
            $main_content = $this->load->view('evaluacion/evaluacion_docente/evaluacion_formulario', $datos, true);
            /*$this->template->setMainContent($main_content);
            $this->template->getTemplate();*/
            $this->template->setTitle($datos['string_values']["titulo"]);
            $this->template->setMainTitle($datos['string_values']["titulo"]);
            $this->template->setMainContent($main_content);
            $this->template->getTemplate(FALSE,'template/sipimss/index.tpl.php');
        }
    }

    public function seccion_index(){
        if ($this->input->is_ajax_request()) {
            if (!is_null($this->input->post())) {
                $filtros = $this->input->post(null, true); //Obtenemos el post o los valores
                //$rol_seleccionado = $this->session->userdata('rol_seleccionado'); //Rol seleccionado de la pantalla de roles
                //$array_menu = get_busca_hijos($rol_seleccionado, $this->uri->segment(1)); //Busca todos los hijos de validador para que generé el menú y cargue los datos de perfil
                //$datosPerfil['array_menu'] = $array_menu;
                $datos_validacion = array();
                //$datos_validacion['estado_correccion'] = null;

                if (!empty($filtros['empcve'])) {
                    $datos_validacion['empleado_cve'] = $this->seguridad->decrypt_base64($filtros['empcve']); //Identificador de la comisión
                }
                if (!empty($filtros['matricula'])) {
                    $datos_validacion['matricula'] = $this->seguridad->decrypt_base64($filtros['matricula']); //Identificador de la comisión
                }
                if (!empty($filtros['estval'])) {
                    $datos_validacion['est_val'] = $this->seguridad->decrypt_base64($filtros['estval']); //Identificador de la comisión
                }
                /*if (!empty($filtros['usuariocve'])) {
                    $datos_validacion['validador_cve'] = $this->seguridad->decrypt_base64($filtros['usuariocve']); //Identificador de la comisión
                }
                if (!empty($filtros['histvalcve'])) {
                    $datos_validacion['validacion_cve'] = $this->seguridad->decrypt_base64($filtros['histvalcve']); //Identificador de la comisión
                }*/
                if (!empty($filtros['solicitud_cve'])) {
                    $datos_validacion['validacion_cve'] = $this->seguridad->decrypt_base64($filtros['solicitud_cve']); //Identificador de la comisión
                }
                /*if (!empty($filtros['valgrlcve'])) {
                    $datos_validacion['val_grl_cve'] = $this->seguridad->decrypt_base64($filtros['valgrlcve']); //Identificador de la comisión
                    /////Inicio estado corrección. Obtener si el empleado ya cuenta con validación en estado corrección
                    $datos_validacion['estado'] = $this->obtener_validacion_correccion($datos_validacion['val_grl_cve'], $datos_validacion['est_val']);
                    ////Fin obtener estado corrección
                }*/
                if (!empty($filtros['usuario_cve'])) {
                    $datos_validacion['usuario_cve_validado'] = $this->seguridad->decrypt_base64($filtros['usuario_cve']); //Identificador de la comisión
                }
                //Manda el identificador de la delegación del usuario
                $this->session->set_userdata('evaluacion', $datos_validacion); //Asigna la información del usuario al que se va a validar

                $this->load->model("Catalogos_generales","gral");
                $conditions = array(Enum_sec::comision=>array('emp_comision.TIP_COMISION_CVE !=' => $this->config->item('tipo_comision')['DIRECCION_TESIS']['id'], 'IS_COMISION_ACADEMICA' => '1'),
                    Enum_sec::direccion_tesis=>array('emp_comision.TIP_COMISION_CVE' => $this->config->item('tipo_comision')['DIRECCION_TESIS']['id']));
                $datosPerfil = $this->gral->getAll($this->obtener_id_empleado(), null, $conditions);
                //pr($datosPerfil);
                $entidades_ = array(enum_ecg::cseccion);
                //$condiciones_ = array(enum_ecg::ccurso => array('TIP_CURSO_CVE' => $tipo_curso));
                $datosPerfil['catalogos'] = carga_catalogos_generales($entidades_, null, null);
                //pr($this->lang->line('interface_evaluacion')['evaluacion']['dictamen']);
                $datosPerfil['string_value'] = array_merge($datosPerfil['string_value'], $this->lang->line('interface_evaluacion')['evaluacion']['dictamen'], $this->lang->line('interface_evaluacion')['evaluacion']['docente'], $this->lang->line('interface_evaluacion')['general']);
                //pr($datosPerfil);
                //echo $main_content = $this->load->view('solicitar_evaluacion/index.tpl.php',$data, true);

                echo $this->load->view('evaluacion/evaluacion_docente/listado_cursos', $datosPerfil, true);
            }
        } else {
            redirect(site_url());
        }
    }

    public function seccion_delete_datos_validado() {
        if ($this->input->is_ajax_request()) {
            $this->delete_datos_validado(); //Elimina los datos de empleado validado, si se encuentran los datos almacenados en la variable de sesión
        } else {
            redirect(site_url());
        }
    }

    /*
     * Permite evaluar
    */
    private function validar_evaluador(){
        $evaluador = $this->eval_doce_model->get_evaluador(array('conditions'=>array('IS_ACTUAL'=>1, 'EMPLEADO_CVE'=>$this->obtener_id_empleado())));
        if(count($evaluador)==0){
            $main_content = "<div>".$this->lang->line('interface_evaluacion')['evaluacion']['docente']['permiso_acceso']."</div>";
            $this->template->setMainContent($main_content);
            $this->template->getTemplate(FALSE,'template/sipimss/index.tpl.php');
            return FALSE;
        }
        return TRUE;
    }
    
    public function buscar_docentes_evaluacion($identificador = null){
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            if (!is_null($this->input->post())) {
                $datos_busqueda = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
                $condition_extra = array();
                if(isset($datos_busqueda['menu_busqueda']) && !empty($datos_busqueda['menu_busqueda'])) {
                    switch ($datos_busqueda['menu_busqueda']) {
                        case 'matricula':
                            $condition_extra = "AND emp_matricula like '%".$datos_busqueda['buscador_docente']."%'";
                            break;                        
                        case 'nombre':
                            $condition_extra = "AND (EMP_NOMBRE like '%".$datos_busqueda['buscador_docente']."%' OR EMP_APE_PATERNO like '%".$datos_busqueda['buscador_docente']."%' OR EMP_APE_MATERNO like '%".$datos_busqueda['buscador_docente']."%')";
                            break;
                    }                   
                }

                $datos_busqueda['current_row'] = (isset($current_row) && !empty($current_row)) ? $current_row : 0; //Registro actual, donde inicia la visualización de registros
                $datos_busqueda['conditions'] = 'evaluacion_solicitud.CESE_CVE >='.Enum_es::Envio_evaluacion.' AND ADMIN_DICTAMEN_EVA_CVE='.$this->obtener_id_dictamen().' '.$condition_extra;
                $datos_busqueda['fields'] = "if(evaluacion_solicitud.CESE_CVE=".Enum_es::Envio_evaluacion.", (select EST_EVALUACION_CVE from hist_evaluacion_dic where hist_evaluacion_dic.SOLICITUD_VAL_CVE=evaluacion_solicitud.VALIDACION_CVE), 0) AS estado, evaluacion_solicitud.*, cestado_solicitud_evauacion.CESE_NOMBRE, empleado.*, DEL_NOMBRE, nom_categoria";
                
                $datos['evaluacion'] = $this->eval_doce_model->get_evaluacion_docente($datos_busqueda); ////Obtener listado de evaluaciones de acuerdo al año seleccionado
                $datos['evaluacion']['string_values'] = array_merge($this->lang->line('interface_evaluacion')['evaluacion']['dictamen'], $this->lang->line('interface_evaluacion')['evaluacion']['docente'], $this->lang->line('interface_evaluacion')['general']); //Cargar textos utilizados en vista

                $datos['evaluacion']['current_row'] = $datos_busqueda['current_row'];
                $datos['evaluacion']['per_page'] = $this->input->post('per_page'); //Número de registros a mostrar por página
                
                $this->resultado_listado($datos['evaluacion'], array('form_recurso'=>'#form_search', 'elemento_resultado'=>'#resultado_busqueda')); //Generar listado en caso de obtener datos
            }
        } else {
            redirect(site_url());
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
        $data['controller'] = 'evaluacion_docente';
        $data['action'] = 'buscar_docentes_evaluacion';
        $pagination = $this->template->pagination_data($data); //Crear mensaje y links de paginación
        $links = "<div class='col-sm-5 dataTables_info'>".$pagination['total']."</div>
                <div class='col-sm-7'>".$pagination['links']."</div><input type='hidden' id='cr', name='cr' value='".$data['current_row']."'>";
        echo $links.$this->load->view('evaluacion/evaluacion_docente/resultado_busqueda', $data, TRUE).$links.'
            <script>
            $("ul.pagination li a").click(function(event){
                data_ajax(this, "'.$form['form_recurso'].'", "'.$form['elemento_resultado'].'");
                event.preventDefault();
            });
            </script>';
    }

    /**
     * Elimina los datos o información del usuario u empleado a validar
     */
    private function delete_datos_validado() {
        if (!is_null($this->session->userdata('evaluacion'))) {
            $this->session->unset_userdata('evaluacion');
        }
    }

    private function obtener_id_dictamen() {
        if (!is_null($this->session->userdata('dictamen'))) {
            return $this->session->userdata('dictamen')['ADMIN_DICTAMEN_EVA_CVE'];
        }
        return NULL;
    }

    private function obtener_id_empleado() {
        if (!is_null($this->session->userdata('idempleado'))) {
            return $this->session->userdata('idempleado');
        }
        return NULL;
    }
}

class evaluacion_curso {
    //public $EVA_CURSO_CVE;
    public $EVA_CUR_VALIDO;
    public $EVA_CUR_PUNTOS_CURSO;
    public $ROL_EVALUADOR_CVE;
    public $EVA_CUR_CATEGORIA;
    public $EVA_CUR_MSG_RE_EVALUACION;
    public $EVA_CUR_PUNTOS_CURSO_ORIGINAL;
    public $FCH_EVALUACION_CURSO_GAECUD;
}
class evaluacion_curso_esp_medica extends evaluacion_curso {
    public $TABU_ACT_DOCENTE_CVE;
    public $EMP_ESP_MEDICA_CVE;
}
class evaluacion_curso_act_docente extends evaluacion_curso  {
    public $TABU_ACT_DOCENTE_CVE;
    public $EMP_ACT_DOCENTE_CVE;
}
class evaluacion_curso_for_profesional extends evaluacion_curso {
    public $EMP_FORMACION_PROFESIONAL_CVE;
}
class evaluacion_curso_act_inv_edu extends evaluacion_curso {
    public $TABU_ACT_INV_EDU_CVE;
    public $EAID_CVE;
}
class evaluacion_curso_mat_edu extends evaluacion_curso {
    public $MATERIA_EDUCATIVO_CVE;
    public $TEM_ELA_MATERIAL_CVE;
}
class evaluacion_curso_comision extends evaluacion_curso {
    public $TABU_DIR_TESIS_CVE;
    public $TAB_COM_ACADEMICA_CVE;
    public $TABULADOR_COOR_CVE;
    public $EMP_COMISION_CVE;
}
class evaluacion_curso_fpcs extends evaluacion_curso {
    public $TABU_EDU_CONTINUA_CVE;
    public $FPCS_CVE;
}
class evaluacion_curso_edu_dis extends evaluacion_curso {
    public $TABU_EDU_DISTANCIA_CVE;
    public $EMP_EDU_DISTANCIA_CVE;
}