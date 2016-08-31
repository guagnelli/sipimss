<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: LEAS 
 * fecha: 29/07/2016
 */
class Validacion_censo_profesores extends MY_Controller {

    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('empleados_siap');
        $this->load->library('Ventana_modal');
        $this->load->config('general');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
//        $this->load->library('Ventana_modal');

        $this->load->model('Validacion_docente_model', 'vdm');
        //*****Datos perfil 
        $this->load->model('Catalogos_generales', 'cg');
        $this->load->model('Actividad_docente_model', 'adm');
        $this->load->model('Investigacion_docente_model', 'idm');
        $this->load->model('Becas_comisiones_laborales_model', 'bcl');
        $this->load->model('Material_educativo_model', 'mem');
        $this->load->model('Perfil_model', 'modPerfil');
        $this->load->helper('date');

        //$_SESSION['datosvalidadoactual']['validacion_cve'] = 2;
        //pr($_SESSION);
    }

    /**
     * 
     * @author Leas
     * Fecha creación28072016
     */
    public function index() {
//        pr($this->session->userdata('rol_seleccionado'));
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['validador_censo'];
        $data = array();
        $this->delete_datos_validado(); //Elimina los datos de empleado validado, si se encuentran los datos almacenados en la variable de sesión
        $data['string_values'] = $string_values;
        $data['order_columns'] = array('em.EMP_MATRICULA' => 'Matrícula', 'em.EMP_NOMBRE' => 'Nombre', 'em.CATEGORIA_CVE' => 'Categoría');
        //Manda el identificador de la delegación del usuario
        $this->load->model('Designar_validador_model', 'dvm');
        $empleado_cve = $this->session->userdata('idempleado');
        $datos_validador = $this->dvm->get_validador_n1($empleado_cve);
        $datos_validador['VAL_CON_CVE'] = 1; //*Implementar bien la consulta que obtiene la convocatoría***
        $this->session->set_userdata('datos_validador', $datos_validador);
//        pr($datos_validador);
        $data = carga_catalogos_generales(array(enum_ecg::cvalidacion_estado), $data, NULL, TRUE, NULL, array(enum_ecg::cvalidacion_estado => 'VAL_ESTADO_CVE')); //Carga el catálogo de ejercicio predominante
        $main_contet = $this->load->view('validador_censo/validador_censo_tpl', $data, true);
        $this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    public function data_buscar_docentes_validar($current_row = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            if (!is_null($this->input->post())) {
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['validador_censo'];
                $filtros = $this->input->post(null, true); //Obtenemos el post o los valores 
                $datos_validador = $this->session->userdata('datos_validador');
                $filtros += $datos_validador;
//                pr($filtros);
                $filtros['current_row'] = (isset($current_row) && !empty($current_row)) ? $current_row : 0;
                $filtros['delegacion_cve'] = $this->session->userdata('delegacion_cve');
//            $filtros['per_page'] = 10;
//            pr($filtros);
                $resutlado = $this->vdm->get_buscar_docentes_validar($filtros);
//                pr($resutlado['result']);
                $data['string_values'] = $string_values;
                $data['lista_docentes_validar'] = $resutlado['result'];
                $data['total'] = $resutlado['total'];
                $data['current_row'] = $filtros['current_row'];
                $data['per_page'] = $this->input->post('per_page');

                if (isset($data['lista_docentes_validar']) && !empty($data['lista_docentes_validar'])) {
                    $this->listado_resultado_unidades($data, array('form_recurso' => '#form_busqueda_docentes_validar',
                        'elemento_resultado' => '#div_result_docentes_validacion'
                    )); //Generar listado en caso de obtener datos
                } else {
                    echo $string_values ['resp_sin_resultados'];
                }
            }
        } else {
            redirect(site_url());
        }
    }

    private function listado_resultado_unidades($data, $form) {
        $data['controller'] = 'validacion_docente_model';
        $data['action'] = 'data_buscar_docentes_validar';
        $pagination = $this->template->pagination_data($data); //Crear mensaje y links de paginación
        //$pagination = $this->template->pagination_data_buscador_asignar_validador($data); //Crear mensaje y links de paginación
        $links = "<div class='col-sm-5 dataTables_info' style='line-height: 50px;'>" . $pagination['total'] . "</div>
                    <div class='col-sm-7 text-right'>" . $pagination['links'] . "</div>";
        $datos['lista_docentes_validar'] = $data['lista_docentes_validar'];
        $datos['string_values'] = $data['string_values'];
        echo $links . $this->load->view('validador_censo/tabla_resultados_validador', $datos, TRUE) . $links . '
                <script>
                $("ul.pagination li a").click(function(event){
                    data_ajax(this, "' . $form['form_recurso'] . '", "' . $form['elemento_resultado'] . '");
                    event.preventDefault();
                });
                </script>';
    }

    /*     * **********Fin de buscador de docentes ************************** */

    /*     * **********Inicio de carga perfil empleado validacion *********** */

    /**
     * Elimina los datos o información del usuario u empleado a validar
     */
    private function delete_datos_validado() {
        if (!is_null($this->session->userdata('datosvalidadoactual'))) {
            $this->session->unset_userdata('datosvalidadoactual');
        }
    }

    private function obtener_datos_validador($parametros = null) {
        if(is_null($parametros)) {
            if (!is_null($this->session->userdata('datos_validador'))) {
                return $this->session->userdata('datos_validador');
            }
        }
        return null;
    }

    public function seccion_delete_datos_validado() {
        if ($this->input->is_ajax_request()) {
//            if ($this->input->post()) {
//                $datos_post = $this->input->post(null, TRUE);
            $this->delete_datos_validado(); //Elimina los datos de empleado validado, si se encuentran los datos almacenados en la variable de sesión
//            }
        } else {
            redirect(site_url());
        }
    }

    /**
     * 
     */
    public function seccion_index() {
        //echo "SOY UN INDEX....";
        if ($this->input->is_ajax_request()) {
            if (!is_null($this->input->post())) {
                $this->lang->load('interface', 'spanish');
                $filtros = $this->input->post(null, true); //Obtenemos el post o los valores
                $rol_seleccionado = $this->session->userdata('rol_seleccionado'); //Rol seleccionado de la pantalla de roles
                $array_menu = get_busca_hijos($rol_seleccionado, $this->uri->segment(1)); //Busca todos los hijos de validador para que generé el menú y cargue los datos de perfil
                $datosPerfil['array_menu'] = $array_menu;
                $datos_validacion = array();
                if (!empty($filtros['empcve'])) {
                    $datos_validacion['empleado_cve'] = $this->seguridad->decrypt_base64($filtros['empcve']); //Identificador de la comisión
                }
                if (!empty($filtros['matricula'])) {
                    $datos_validacion['matricula'] = $this->seguridad->decrypt_base64($filtros['matricula']); //Identificador de la comisión
                }
                if (empty($filtros['estval'])) {
                    $datos_validacion['est_val'] = $this->seguridad->decrypt_base64($filtros['estval']); //Identificador de la comisión
                }
                if (!empty($filtros['validadorcve'])) {
                    $datos_validacion['validador_cve'] = $this->seguridad->decrypt_base64($filtros['validadorcve']); //Identificador de la comisión
                }
                if (!empty($filtros['histvalcve'])) {
                    $datos_validacion['validacion_cve'] = $this->seguridad->decrypt_base64($filtros['histvalcve']); //Identificador de la comisión
                }
                if (!empty($filtros['valgrlcve'])) {
                    $datos_validacion['val_grl_cve'] = $this->seguridad->decrypt_base64($filtros['valgrlcve']); //Identificador de la comisión
                }
                if (!empty($filtros['usuariocve'])) {
                    $datos_validacion['usuario_cve_validado'] = $this->seguridad->decrypt_base64($filtros['usuariocve']); //Identificador de la comisión
                }
                //Manda el identificador de la delegación del usuario
                $this->session->set_userdata('datosvalidadoactual', $datos_validacion); //Asigna la información del usuario al que se va a validar
                echo $this->load->view('validador_censo/index', $datosPerfil, true);
            }
        } else {
            redirect(site_url());
        }
    }

    private function obtener_id_usuario() {
        if (!is_null($this->session->userdata('datosvalidadoactual'))) {
            $array_validado = $this->session->userdata('datosvalidadoactual');
            return $array_validado['usuario_cve_validado'];
        }
//        return $this->session->userdata('identificador');
        return NULL;
    }

    private function obtener_id_empleado() {
        if (!is_null($this->session->userdata('datosvalidadoactual'))) {
            $array_validado = $this->session->userdata('datosvalidadoactual');
            return $array_validado['empleado_cve'];
        }
//        return $this->session->userdata('idempleado');
        return NULL;
    }

    private function obtener_id_validacion() {
        if (!is_null($this->session->userdata('datosvalidadoactual'))) {
            return $this->session->userdata('datosvalidadoactual')['validacion_cve'];
        }
//        return $this->session->userdata('idempleado');
        return NULL;
    }

    public function seccion_validar() {
        if ($this->input->is_ajax_request()) {
            $this->load->view('validador_censo/valida_docente/valida_docente_tpl', NULL, FALSE);
        } else {
            redirect(site_url());
        }
    }

    /**
     * @Author: Mr. Guag
     * @params: void
     * @return: void 
     * @description: This function shows & allows to the users/profesors manage their information
     */
    public function seccion_info_general() {
        $data = array();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['perfil'];
        $id_usuario = $this->obtener_id_usuario();

        /* Esto es de información general */
        if ($this->input->post()) {
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('informacion_general'); //Obtener validaciones de archivo general
            $this->form_validation->set_rules($validations); //Añadir validaciones
            if ($this->form_validation->run()) {
                //pr("Validating-data, Saving-data");
                //pr($this->input->post());
                $this->load->model("Registro_model", "reg");
                $empData = $this->input->post();
                foreach ($empData as $key => $field) {
                    if (empty($field)) {
                        unset($empData[$key]);
                    }
                }
                $id = $empData["EMPLEADO_CVE"];
                unset($empData["EMPLEADO_CVE"]);

                //pr($empData);
                //echo $this->reg->update_registro_empleado($empData,$id);
                if ($this->reg->update_registro_empleado($empData, $id) == 1) {
                    $response['message'] = $string_values['save_informacion_personal'];
                    $response['result'] = "true";
                } else {
                    $response['message'] = $string_values['error_informacion_personal'];
                    $response['result'] = false;
                }
                $response["content"] = $this->_load_general_info_form(TRUE);
                echo json_encode($response);
                return 0;
            }
        }
        $this->_load_general_info_form();
    }

    /**
     * @Author: Mr. Guag
     * @param void
     * @return array 
     * @description: This function create & return a form within the general information of the profesor
     */
    function _load_general_info_form($type = FALSE) {
        //$data = array();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['perfil'];
        $id_usuario = $this->obtener_id_usuario();
        //pr("Just showing a preview");
        $datosPerfil = $this->loadInfo($id_usuario);

        $this->load->library("curp");
        $this->curp->setCURP($datosPerfil["curp"]);
        //solo se manda el combo de sexo cuando es el usuario admin
        $datosPerfil['genero'] = $this->curp->getGenero();
        $datosPerfil['edad'] = $this->curp->getEdad();
        $datosPerfil['estadosCiviles'] = dropdown_options($this->modPerfil->getEstadoCivil(), 'CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE');
        $datosPerfil['formacionProfesionalOptions'] = array();
        $datosPerfil['tipoComprobanteOptions'] = array();
        $datosPerfil['antiguedad'] = explode('_', $datosPerfil['antiguedad']);
        if ($type) {
            return $this->load->view('validador_censo/informacionGeneral', $datosPerfil, $type);
        }

        $this->load->view('validador_censo/informacionGeneral', $datosPerfil, $type); //Valores que muestrán la lista  
    }

    /**
     * 
     * @param mixed $parameters
     */
    private function loadInfo($identificador) {
        $empleadoData = $this->modPerfil->getEmpleadoData($identificador);
        $datosPerfil = array();
        if (count($empleadoData)) {
            foreach ($empleadoData['0'] as $key => $value) {
                $datosPerfil[$key] = $value;
            }
        }
        return $datosPerfil;
    }

    ////////////////////////Inicio comisiones academicas
    public function seccion_comision_academica() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('Comision_academica_model', 'ca');
            $data = array();

            $this->lang->load('interface');
            $validacion_cve_session = $this->obtener_id_validacion();
            $data['string_values'] = array_merge($this->lang->line('interface')['comision_academica'], $this->lang->line('interface')['general']);

            $condiciones_ = array(enum_ecg::ctipo_comision => array('TIP_COMISION_CVE !=' => $this->config->item('tipo_comision')['DIRECCION_TESIS']['id'], 'IS_COMISION_ACADEMICA' => 1));
            $entidades_ = array(enum_ecg::ctipo_comision);
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, $condiciones_);
            $data['columns'] = array($this->config->item('tipo_comision')['COMITE_EDUCACION']['id'] => array('EC_ANIO' => $data['string_values']['t_h_anio'], 'TIP_CUR_NOMBRE' => $data['string_values']['t_h_tipo']),
                $this->config->item('tipo_comision')['SINODAL_EXAMEN']['id'] => array('EC_ANIO' => $data['string_values']['t_h_anio_'], 'NIV_ACA_NOMBRE' => $data['string_values']['t_h_nivel_academico']),
                $this->config->item('tipo_comision')['COORDINADOR_TUTORES']['id'] => array('EC_ANIO' => $data['string_values']['t_h_anio_'], 'TIP_CUR_NOMBRE' => $data['string_values']['t_h_tipo'], 'EC_FCH_INICIO' => $data['string_values']['t_h_fch_inicio'], 'EC_FCH_FIN' => $data['string_values']['t_h_fch_fin'], 'EC_DURACION' => $data['string_values']['t_h_duracion']),
                $this->config->item('tipo_comision')['COORDINADOR_CURSO']['id'] => array('EC_ANIO' => $data['string_values']['t_h_anio_'], 'TIP_CUR_NOMBRE' => $data['string_values']['t_h_tipo'], 'EC_FCH_INICIO' => $data['string_values']['t_h_fch_inicio'], 'EC_FCH_FIN' => $data['string_values']['t_h_fch_fin'], 'EC_DURACION' => $data['string_values']['t_h_duracion']));

            $data['comisiones'] = array();
            foreach ($data['catalogos']['ctipo_comision'] as $ctc => $tc) {
                $data['comisiones'][$ctc] = $this->ca->get_comision_academica(array('conditions' => array('EMPLEADO_CVE' => $this->obtener_id_empleado(), 'TIP_COMISION_CVE' => $ctc), 'order' => 'EC_ANIO desc', 'fields'=>'emp_comision.*, NIV_ACA_NOMBRE, COM_ARE_NOMBRE, TIP_CUR_NOMBRE', 'validation'=>array('table'=>'hist_comision_validacion_curso', 'fields'=>'COUNT(*) AS validation', 'conditions'=>'hist_comision_validacion_curso.EMP_COMISION_CVE=emp_comision.EMP_COMISION_CVE AND VALIDACION_CVE='.$validacion_cve_session)));
            }
            //pr($data);
            echo $this->load->view('validador_censo/comision_academica/comision_academica.php', $data, true); //Valores que muestrán la lista
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /*public function comision_academica_formulario($tipo_comision = null, $identificador = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Comision_academica_model', 'ca');
            $this->lang->load('interface');
            $data['tipo_comision'] = $tipo_comision;
            $data['identificador'] = $identificador;
            $tc_id = $this->seguridad->decrypt_base64($tipo_comision); //Identificador del tipo de comisión
            $ca_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['comision_academica'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);

            $config = $this->comision_academica_configuracion($tc_id);
            $data['catalogos'] = $config['catalogos'];
            $data['mostrar_hora_fecha_duracion'] = 0;

            if (!is_null($this->input->post()) && !empty($this->input->post())) { //Se verifica que se haya recibido información por método post
                $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
                $data['mostrar_hora_fecha_duracion'] = $this->get_valor_validacion($datos_formulario, 'duracion'); //Muestrá validaciones de hora y fecha de inicio y termino según la opción de duración
                //pr($datos_formulario);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item($config['validacion']); //Obtener validaciones de archivo general
                $this->form_validation->set_rules($validations); //Añadir validaciones
                if (isset($datos_formulario['duracion']) && $datos_formulario['duracion'] == "fecha_dedicadas") { //Agregar validaciones
                    $datos_formulario['hora_dedicadas'] = null;
                    $this->form_validation->set_rules('fecha_inicio_pick', 'Fecha inicio', 'trim|required|validate_date_dd_mm_yyyy');
                    $this->form_validation->set_rules('fecha_fin_pick', 'Fecha fin', 'trim|required|validate_date_dd_mm_yyyy');
                } else {
                    if (isset($datos_formulario['duracion'])) {
                        $datos_formulario['fecha_inicio_pick'] = null;
                        $datos_formulario['fecha_fin_pick'] = null;
                        $this->form_validation->set_rules('hora_dedicadas', 'Duración', 'trim|required|integer');
                    }
                }
                if (isset($datos_formulario['tipo_curso']) &&
                        ($tc_id == $this->config->item('tipo_comision')['COORDINADOR_TUTORES']['id'] || $tc_id == $this->config->item('tipo_comision')['COORDINADOR_CURSO']['id']) &&
                        ($datos_formulario['tipo_curso'] == $this->config->item('tipo_curso')['FORMACION_INICIAL']['id'] || $datos_formulario['tipo_curso'] == $this->config->item('tipo_curso')['EDUCACION_CONTINUA']['id'])) { //Agregar validaciones
                    $this->form_validation->set_rules('curso', 'Curso', 'trim|required|integer');
                }
                //pr($datos_formulario);
                //pr($validations);
                if ($this->form_validation->run() == TRUE) { //Validar datos
                    $datos_formulario['tipo_comision'] = $tc_id;
                    $datos_formulario['empleado'] = $this->obtener_id_empleado();
                    $data_com = $this->emp_comision_fac($datos_formulario); //Generar objeto para almacenar
                    //pr($data_com);  exit();
                    if (empty($data['identificador'])) { //Insertar
                        $resultado_almacenado = $this->ca->insert_comision($data_com);
                        $data['identificador'] = $this->seguridad->encrypt_base64($resultado_almacenado['data']['identificador']); //Obtenemos identificador de registro aceptado y se encripta
                    } else { //Actualización
                        $resultado_almacenado = $this->ca->update_comision($ca_id, $data_com);
                    }
                    //////Inicio actualizar comprobante
                    $this->load->model('Administracion_model', 'admin');
                    if (!empty($datos_formulario['idc'])) {
                        $resultado_almacenado = $this->admin->update_comprobante($this->seguridad->decrypt_base64($data['idc']), array('TIPO_COMPROBANTE_CVE' => $datos_formulario['tipo_comprobante']));
                    }
                    //////Fin actualizar comprobante
                    $data['msg'] = imprimir_resultado($resultado_almacenado); ///Muestra mensaje
                } else {
                    validation_errors();
                }
            }
            if (!is_null($identificador)) { ///En caso de que se haya elegido alguna convocatoria                
                $data['dir_tes'] = $this->ca->get_comision_academica(array('conditions' => array('EMP_COMISION_CVE' => $ca_id)))[0]; //Obtener datos
            } else {
                $data['dir_tes'] = (array) $this->emp_comision_fac(array('tipo_comision' => $tc_id)); //Generar objeto para ser enviado al formulario
            }
            //pr($data);
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
            $data['titulo_modal'] = $data['string_values']['title'];

            $data['cuerpo_modal'] = $this->load->view($config['plantilla'], $data, TRUE);

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function curso($tipo_curso, $CURSO_CVE = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Comision_academica_model', 'ca');
            $this->lang->load('interface');
            $data['string_values'] = array_merge($this->lang->line('interface')['comision_academica'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $data['dir_tes']['CURSO_CVE'] = $CURSO_CVE;

            $entidades_ = array(enum_ecg::ccurso);
            $condiciones_ = array(enum_ecg::ccurso => array('TIP_CURSO_CVE' => $tipo_curso));
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, $condiciones_);

            echo $this->load->view('validador_censo/comision_academica/comision_academica_curso', $data, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    public function curso_actividad_docente() {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            if ($this->input->post()) {
                $datos_post = $datos_formulario = $this->input->post(null, true);
//                pr($datos_post);
                if (!empty($datos_post['ctipo_curso_cve'])) {
                    $id_pos = intval($datos_post['ctipo_curso_cve']);
                    echo $this->vista_ccurso($id_pos);
                }
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    private function vista_ccurso($id_tipo_curso, $ccurso_cve = '') {
        $entidades_ = array(enum_ecg::ccurso);
        $condiciones_ = array(enum_ecg::ccurso => array('TIP_CURSO_CVE' => $id_tipo_curso));
        $data['catalogos'] = carga_catalogos_generales($entidades_, null, $condiciones_);
        $data['string_values'] = $this->lang->line('interface')['actividad_docente'];
        if (!empty($ccurso_cve)) {
            $data['ccurso_cve'] = intval($ccurso_cve);
        }
        return $this->load->view('validador_censo/actividad_docente/vista_curso', $data, TRUE);
    }

    private function comision_academica_configuracion($tipo_comision, $edicion=true) {
        $config = array('plantilla' => null, 'validacion' => null);
        switch ($tipo_comision) {
            case $this->config->item('tipo_comision')['COMITE_EDUCACION']['id']:
                $config['plantilla'] = ($edicion==true) ? 'validador_censo/comision_academica/comision_academica_comite_educacion_formulario' : 'validador_censo/comision_academica/comision_academica_comite_educacion_vista';
                $config['validacion'] = 'form_comision_academica_comite_educacion';
                $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ctipo_curso);
                break;
            case $this->config->item('tipo_comision')['SINODAL_EXAMEN']['id']:
                $config['plantilla'] = ($edicion==true) ? 'validador_censo/comision_academica/comision_academica_sinodal_examen_formulario' : 'validador_censo/comision_academica/comision_academica_sinodal_examen_vista';
                $config['validacion'] = 'form_comision_academica_sinodal_examen';
                $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cnivel_academico);
                break;
            case $this->config->item('tipo_comision')['COORDINADOR_TUTORES']['id']:
                $config['plantilla'] = ($edicion==true) ? 'validador_censo/comision_academica/comision_academica_coordinador_tutores_formulario' : 'validador_censo/comision_academica/comision_academica_coordinador_tutores_vista';
                $config['validacion'] = 'form_comision_academica_coordinador_tutores';
                $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ccurso, enum_ecg::ctipo_curso);
                break;
            case $this->config->item('tipo_comision')['COORDINADOR_CURSO']['id']:
                //$config['plantilla'] = 'perfil/comision_academica/comision_academica_coordinador_curso_formulario';
                //$config['validacion'] = 'form_comision_academica_coordinador_curso';
                $config['plantilla'] = ($edicion==true) ? 'validador_censo/comision_academica/comision_academica_coordinador_tutores_formulario' : 'validador_censo/comision_academica/comision_academica_coordinador_tutores_vista';
                $config['validacion'] = 'form_comision_academica_coordinador_tutores';
                $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ccurso, enum_ecg::ctipo_curso);
                break;
        }
        $config['catalogos'] = carga_catalogos_generales($entidades_, null, null);
        return $config;
    }

    /////////////////////////Fin comisiones academicas
    ////////////////////////Inicio Dirección de tesis ////////////////////////
    public function seccion_direccion_tesis() {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->lang->load('interface');
            $data['string_values'] = array_merge($this->lang->line('interface')['direccion_tesis'], $this->lang->line('interface')['general']);
            $validacion_cve_session = $this->obtener_id_validacion();
            
            $this->load->model('Direccion_tesis_model', 'dt');
            $data['lista_direccion'] = $this->dt->get_lista_datos_direccion_tesis(array('conditions' => array('EMPLEADO_CVE' => $this->obtener_id_empleado(), 'TIP_COMISION_CVE' => $this->config->item('tipo_comision')['DIRECCION_TESIS']['id']), 'fields'=>'emp_comision.*, NIV_ACA_NOMBRE, COM_ARE_NOMBRE', 'order' => 'EC_ANIO desc', 'validation'=>array('table'=>'hist_comision_validacion_curso', 'fields'=>'COUNT(*) AS validation', 'conditions'=>'hist_comision_validacion_curso.EMP_COMISION_CVE=emp_comision.EMP_COMISION_CVE AND VALIDACION_CVE='.$validacion_cve_session)));
            //pr($data);
            echo $this->load->view('validador_censo/direccionTesis', $data, true); //Valores que muestrán la lista
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /*public function direccion_tesis_formulario($identificador = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Direccion_tesis_model', 'dt');
            $this->lang->load('interface');
            $data['identificador'] = $identificador;
            $dt_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['direccion_tesis'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);

            $entidades_ = array(enum_ecg::comision_area, enum_ecg::ctipo_comprobante, enum_ecg::cnivel_academico);
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, null);
            if (!is_null($this->input->post()) && !empty($this->input->post())) { //Se verifica que se haya recibido información por método post
                $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta

                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_direccion_tesis'); //Obtener validaciones de archivo general
                $this->form_validation->set_rules($validations); //Añadir validaciones

                if ($this->form_validation->run() == TRUE) { //Validar datos
                    $datos_formulario['tipo_comision'] = $this->config->item('tipo_comision')['DIRECCION_TESIS']['id'];
                    $datos_formulario['empleado'] = $this->obtener_id_empleado();
                    $data_com = $this->emp_comision_fac($datos_formulario); //Generar objeto para almacenar
                    if (empty($data['identificador'])) { //Insertar
                        $resultado_almacenado = $this->dt->insert_comision($data_com);
                        $data['identificador'] = $this->seguridad->encrypt_base64($resultado_almacenado['data']['identificador']); //Obtenemos identificador de registro aceptado y se encripta
                    } else { //Actualización
                        $resultado_almacenado = $this->dt->update_comision($dt_id, $data_com);
                    }
                    //////Inicio actualizar comprobante
                    $this->load->model('Administracion_model', 'admin');
                    if (!empty($datos_formulario['idc'])) {
                        $resultado_almacenado = $this->admin->update_comprobante($this->seguridad->decrypt_base64($data['idc']), array('TIPO_COMPROBANTE_CVE' => $datos_formulario['tipo_comprobante']));
                    }
                    //////Fin actualizar comprobante
                    $data['msg'] = imprimir_resultado($resultado_almacenado); ///Muestra mensaje
                }
            }
            if (!is_null($identificador)) { ///En caso de que se haya elegido alguna convocatoria                
                $data['dir_tes'] = $this->dt->get_lista_datos_direccion_tesis(array('conditions' => array('EMP_COMISION_CVE' => $dt_id)))[0]; //Obtener datos
            } else {
                $data['dir_tes'] = (array) $this->emp_comision_fac(array('tipo_comision' => $this->config->item('tipo_comision')['DIRECCION_TESIS']['id'])); //Generar objeto para ser enviado al formulario
            }
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
            $data = array(
                'titulo_modal' => $data['string_values']['title'],
                'cuerpo_modal' => $this->load->view('validador_censo/direccionTesis/direccion_tesis_formulario', $data, TRUE)
            );

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    /**
     * Función que permite eliminar la dirección de tesis
     * @method: void eliminar_convocatoria()
     * @param: $Identificador   string en base64    Identificador de la dirección de tesis codificado en base64
     * @author: Jesús Z. Díaz P.
     */
    /*public function eliminar_direccion_tesis($identificador) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Direccion_tesis_model', 'dt');
            $datos['identificador'] = $identificador; //Identificador de dirección de tesis
            $datos['msg'] = null;
            $dt_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la dirección de tesis
            $idempleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
            //$datos['string_values'] = $this->lang->line('interface')['general']; //Cargar textos utilizados en vista

            $resultado = $this->dt->delete_comision(array('conditions' => array('EMP_COMISION_CVE' => $dt_id))); //Eliminar datos
            //pr($resultado);            
            $this->eliminar_archivo(array('archivo' => $resultado['data']['COM_NOMBRE'], 'matricula' => $this->session->userdata('matricula')));

            echo json_encode($resultado); ///Muestra mensaje
            exit();
            //echo $this->load->view('evaluacion/convocatoria/dictamen_listado', $datos, true);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    /**
     * Función que elimina un archivo
     * @method: void eliminar_archivo()
     * @param: $data['archivo']   string     Nombre del archivo
     * @param: $data['matricula']   string      Matrícula del empleado
     * @author: Jesús Z. Díaz P.
     */
    private function eliminar_archivo($data) {
        $resultado = false;
        //pr($data);
        if (isset($data['archivo']) && !empty($data['archivo'])) { //Eliminar archivo
            $ruta = $this->config->item('upload_config')['comprobantes']['upload_path']; //Path de archivos
            //pr($ruta);
            $ruta_archivo = $ruta . $data['archivo']; ///Definir ruta de almacenamiento, se utiliza la matricula
            //pr($ruta_archivo);
            if (file_exists($ruta_archivo)) {
                unlink($ruta_archivo);
                $resultado = true;
            }
        }
        return $resultado;
    }

    /////////////////////////Inicio formación //////////////////////////
    public function seccion_formacion() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('Formacion_model', 'fm');
            $this->load->helper('date');
            $data = array();
            $this->lang->load('interface');
            $data['string_values'] = array_merge($this->lang->line('interface')['perfil'], $this->lang->line('interface')['formacion_salud'], $this->lang->line('interface')['formacion_docente'], $this->lang->line('interface')['general']);
            $validacion_cve_session = $this->obtener_id_validacion();

            $entidades_ = array(enum_ecg::ctipo_formacion_profesional, enum_ecg::csubtipo_formacion_profesional);
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, null);

            ///Obtener dato de ejercicio profesional, para mostrar datos de formación en salud
            $data['ejercicio_profesional'] = $this->fm->get_ejercicio_profesional(array('conditions' => array('EMPLEADO_CVE' => $this->obtener_id_empleado()), 'fields' => 'emp_eje_pro_cve, EJE_PRO_NOMBRE'))[0];

            if (!empty($data['ejercicio_profesional']['emp_eje_pro_cve'])) { //En caso de que exista valor en ejercicio profesional
                $data['formacion_salud']['inicial'] = $this->fm->get_formacion_salud(array('conditions' => array('EMPLEADO_CVE' => $this->obtener_id_empleado(), 'EFPCS_FOR_INICIAL' => 1), 'order' => 'EFPCS_FCH_INICIO desc', 'fields' => 'emp_for_personal_continua_salud.*, ctipo_formacion_salud.TIP_FORM_SALUD_NOMBRE, csubtipo_formacion_salud.SUBTIP_NOMBRE', 'validation'=>array('table'=>'hist_fpcs_validacion_curso', 'fields'=>'COUNT(*) AS validation', 'conditions'=>'hist_fpcs_validacion_curso.FPCS_CVE=emp_for_personal_continua_salud.FPCS_CVE AND VALIDACION_CVE='.$validacion_cve_session)));
                $data['formacion_salud']['continua'] = $this->fm->get_formacion_salud(array('conditions' => array('EMPLEADO_CVE=' . $this->obtener_id_empleado(), 'EFPCS_FOR_INICIAL' => 2), 'order' => 'EFPCS_FCH_INICIO desc', 'fields' => 'emp_for_personal_continua_salud.*, ctipo_formacion_salud.TIP_FORM_SALUD_NOMBRE, csubtipo_formacion_salud.SUBTIP_NOMBRE', 'validation'=>array('table'=>'hist_fpcs_validacion_curso', 'fields'=>'COUNT(*) AS validation', 'conditions'=>'hist_fpcs_validacion_curso.FPCS_CVE=emp_for_personal_continua_salud.FPCS_CVE AND VALIDACION_CVE='.$validacion_cve_session)));
            } else {
                $data['formacion_salud']['inicial'] = array();
                $data['formacion_salud']['continua'] = array();
            }
            //pr($data);
            $formacion_docente = $this->fm->get_formacion_docente(array('conditions' => array('EMPLEADO_CVE' => $this->obtener_id_empleado()), 'order' => 'EFO_ANIO_CURSO', 'fields' => 'emp_formacion_profesional.*, cinstitucion_avala.IA_NOMBRE, ctipo_formacion_profesional.TIP_FOR_PRO_NOMBRE, csubtipo_formacion_profesional.SUB_FOR_PRO_NOMBRE, cmodalidad.MOD_NOMBRE, ccurso.CUR_NOMBRE', 'validation'=>array('table'=>'hist_efp_validacion_curso', 'fields'=>'COUNT(*) AS validation', 'conditions'=>'hist_efp_validacion_curso.EMP_FORMACION_PROFESIONAL_CVE=emp_formacion_profesional.EMP_FORMACION_PROFESIONAL_CVE AND VALIDACION_CVE='.$validacion_cve_session))); // ctipo_curso.TIP_CUR_NOMBRE, 
            foreach ($formacion_docente as $key_fd => $fd) { ///Ordenar de acuerdo a tipo
                $fd['SUB_FOR_PRO_CVE'] = (!isset($fd['SUB_FOR_PRO_CVE']) || is_null($fd['SUB_FOR_PRO_CVE'])) ? 0 : $fd['SUB_FOR_PRO_CVE'];
                $data['formacion_docente'][$fd['TIP_FOR_PROF_CVE']][$fd['SUB_FOR_PRO_CVE']][] = $fd;
            }
            
            echo $this->load->view('validador_censo/formacion/formacion.php', $data, true); //Valores que muestrán la lista
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /*public function formacion_ejercicio_profesional() {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $this->lang->load('interface');
            //$data['string_values'] = array_merge($this->lang->line('interface')['formacion_docente'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $data = array('msg' => '', 'result' => false);
            if (!is_null($this->input->post()) && !empty($this->input->post())) { //Se verifica que se haya recibido información por método post
                $data['identificador'] = $this->input->post('ejercicio_profesional', true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_ejercicio_profesional'); //Obtener validaciones de archivo general de validaciones
                $this->form_validation->set_rules($validations); //Añadir validaciones

                if ($this->form_validation->run() == TRUE) { //Validar datos
                    $resultado_almacenado = $this->fm->update_formacion_ejercicio_profesional($this->obtener_id_empleado(), array('emp_eje_pro_cve' => $data['identificador']));
                    $data['msg'] = imprimir_resultado($resultado_almacenado); ///Muestra mensaje
                    $data['result'] = true;
                } else {
                    $data['msg'] = form_error_format('ejercicio_profesional');
                }
            }
            echo json_encode($data);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    /*public function formacion_docente_formulario($identificador = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $this->lang->load('interface');
            $data['identificador'] = $identificador;
            $fs_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['formacion_docente'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $tmp = $resultado_almacenado = array();
            $tmp_tematica = '0';

            $condiciones_ = array(enum_ecg::cinstitucion_avala => array('IA_TIPO' => $this->config->item('institucion')['imparte'])); //Obtener catálogos para llenar listados desplegables
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cinstitucion_avala, enum_ecg::cmodalidad, enum_ecg::ctipo_formacion_profesional, enum_ecg::ctematica);
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, $condiciones_);

            $data['mostrar_hora_fecha_duracion'] = 0;

            if (!is_null($this->input->post()) && !empty($this->input->post())) { //Se verifica que se haya recibido información por método post
                $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
                $data['mostrar_hora_fecha_duracion'] = $this->get_valor_validacion($datos_formulario, 'duracion'); //Muestrá validaciones de hora y fecha de inicio y termino según la opción de duración
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_formacion_docente'); //Obtener validaciones de archivo general de validaciones
                $this->form_validation->set_rules($validations); //Añadir validaciones
                //pr($datos_formulario);
                $total_subtipo = $this->fm->get_subtipo_formacion_docente(array('conditions' => array('ctipo_formacion_profesional.TIP_FOR_PROF_CVE' => $datos_formulario['tipo_formacion']), 'fields' => 'count(*) AS total'))[0];
                if ($total_subtipo['total'] > 0) {
                    $this->form_validation->set_rules('subtipo', 'Subtipo de formación profesional', 'trim|required');
                }
                if (isset($datos_formulario['duracion']) && $datos_formulario['duracion'] == "fecha_dedicadas") { //Agregar validaciones
                    $datos_formulario['hora_dedicadas'] = null;
                    $this->form_validation->set_rules('fecha_inicio_pick', 'Fecha inicio', 'trim|required|validate_date_dd_mm_yyyy');
                    $this->form_validation->set_rules('fecha_fin_pick', 'Fecha fin', 'trim|required|validate_date_dd_mm_yyyy');
                } else {
                    if (isset($datos_formulario['duracion'])) {
                        $datos_formulario['fecha_inicio_pick'] = null;
                        $datos_formulario['fecha_fin_pick'] = null;
                        $this->form_validation->set_rules('hora_dedicadas', 'Duración', 'trim|required|integer');
                    }
                }
                if (isset($datos_formulario['tipo_curso']) && ($datos_formulario['tipo_curso'] == $this->config->item('ccurso')['OTRO']['id'])) { //Agregar validaciones
                    $this->form_validation->set_rules('nombre_curso', 'Nombre del otro curso', 'trim|required');
                }
                if ($this->form_validation->run() == TRUE) { //Validar datos
                    $datos_formulario['empleado'] = $this->obtener_id_empleado();
                    $data_fs = $this->formacion_docente_vo($datos_formulario); //Generar objeto para almacenar
                    $data_tfd = $this->formacion_docente_tematica_vo($datos_formulario['tematica'], $fs_id); //Generar objeto para almacenar
                    //pr($data_fs);
                    if (empty($data['identificador'])) { //Insertar
                        $resultado_almacenado = $this->fm->insert_formacion_docente($data_fs, $data_tfd);
                        $data['identificador'] = $this->seguridad->encrypt_base64($resultado_almacenado['data']['identificador']); //Obtenemos identificador de registro aceptado y se encripta
                        $fs_id = $resultado_almacenado['data']['identificador'];
                    } else { //Actualización
                        $resultado_almacenado = $this->fm->update_formacion_docente($fs_id, $data_fs, $data_tfd);
                    }
                    //pr($resultado_almacenado);
                    //////Inicio actualizar comprobante
                    $this->load->model('Administracion_model', 'admin');
                    if (!empty($datos_formulario['idc'])) {
                        $resultado_almacenado_archivo = $this->admin->update_comprobante($this->seguridad->decrypt_base64($data['idc']), array('TIPO_COMPROBANTE_CVE' => $datos_formulario['tipo_comprobante']));
                    }
                    //////Fin actualizar comprobante
                    $data['msg'] = imprimir_resultado($resultado_almacenado); ///Muestra mensaje
                } else {
                    $tmp = $datos_formulario; ///Necesario
                    if (isset($datos_formulario['tematica']) && !empty($datos_formulario['tematica'])) {
                        $tmp_tematica = implode(',', $datos_formulario['tematica']);
                    }
                    //pr(validation_errors());
                    //$data['dir_tes'] = (array)$this->formacion_docente_vo($tmp);
                    //pr($data['dir_tes']);
                }
            }
            if ((!is_null($identificador) && empty($tmp)) || (!empty($resultado_almacenado) && $resultado_almacenado['result'] == 1)) { ///En caso de que se haya elegido alguna convocatoria
                $data['dir_tes'] = $this->fm->get_formacion_docente(array('conditions' => array('EMPLEADO_CVE' => $this->obtener_id_empleado(), 'EMP_FORMACION_PROFESIONAL_CVE' => $fs_id), 'order' => 'EFO_ANIO_CURSO', 'fields' => 'emp_formacion_profesional.*, cinstitucion_avala.IA_NOMBRE, ctipo_formacion_profesional.TIP_FOR_PRO_NOMBRE, csubtipo_formacion_profesional.SUB_FOR_PRO_NOMBRE, cmodalidad.MOD_NOMBRE, comprobante.TIPO_COMPROBANTE_CVE'))[0]; //ccurso.CUR_NOMBRE, ctipo_curso.TIP_CUR_NOMBRE,
                $data['dir_tes']['tematica'] = $this->fm->get_formacion_docente_tematica(array('conditions' => array('EMP_FORMACION_PROFESIONAL_CVE' => $fs_id), 'order' => 'TEM_NOMBRE'));
            } else {
                $data['dir_tes'] = (array) $this->formacion_docente_vo($tmp); //Generar objeto para ser enviado al formulario
                $data['dir_tes']['tematica'] = $this->fm->get_tematica(array('conditions' => "TEMATICA_CVE IN (" . $tmp_tematica . ")", 'order' => 'TEM_NOMBRE'));
            }
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
            $data['titulo_modal'] = $data['string_values']['title'];
            //pr($data);
            $data['cuerpo_modal'] = $this->load->view('validador_censo/formacion/formacion_docente_formulario', $data, TRUE);

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function formacion_salud_formulario($identificador = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $this->lang->load('interface');
            $data['identificador'] = $identificador;
            $fs_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['formacion_salud'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $tmp = array();
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ctipo_formacion_salud);
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, null);

            if (!is_null($this->input->post()) && !empty($this->input->post())) { //Se verifica que se haya recibido información por método post
                $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_formacion_salud'); //Obtener validaciones de archivo general de validaciones
                $this->form_validation->set_rules($validations); //Añadir validaciones

                $total_subtipo = $this->fm->get_subtipo_formacion_salud(array('conditions' => array('ctipo_formacion_salud.TIP_FORM_SALUD_CVE' => $datos_formulario['tipo_formacion']), 'fields' => 'count(*) AS total'))[0];
                if ($total_subtipo['total'] > 0) {
                    $this->form_validation->set_rules('subtipo', 'Subtipo de formación profesional', 'trim|required');
                }
                if ($this->form_validation->run() == TRUE) { //Validar datos
                    $datos_formulario['empleado'] = $this->obtener_id_empleado();
                    $data_fs = $this->formacion_salud_vo($datos_formulario); //Generar objeto para almacenar
                    if (empty($data['identificador'])) { //Insertar
                        $resultado_almacenado = $this->fm->insert_formacion_salud($data_fs);
                        $data['identificador'] = $this->seguridad->encrypt_base64($resultado_almacenado['data']['identificador']); //Obtenemos identificador de registro aceptado y se encripta
                    } else { //Actualización
                        $resultado_almacenado = $this->fm->update_formacion_salud($fs_id, $data_fs);
                    }
                    //////Inicio actualizar comprobante
                    $this->load->model('Administracion_model', 'admin');
                    if (!empty($datos_formulario['idc'])) {
                        $resultado_almacenado = $this->admin->update_comprobante($this->seguridad->decrypt_base64($data['idc']), array('TIPO_COMPROBANTE_CVE' => $datos_formulario['tipo_comprobante']));
                    }
                    //////Fin actualizar comprobante
                    $data['msg'] = imprimir_resultado($resultado_almacenado); ///Muestra mensaje
                } else {
                    $tmp = $datos_formulario;
                }
            }
            if (!is_null($identificador)) { ///En caso de que se haya elegido alguna convocatoria                
                $data['dir_tes'] = $this->fm->get_formacion_salud(array('conditions' => array('FPCS_CVE' => $fs_id), 'fields' => 'emp_for_personal_continua_salud.*, ctipo_formacion_salud.TIP_FORM_SALUD_NOMBRE, csubtipo_formacion_salud.SUBTIP_NOMBRE, TIPO_COMPROBANTE_CVE'))[0]; //Obtener datos
            } else {
                $data['dir_tes'] = (array) $this->formacion_salud_vo($tmp); //Generar objeto para ser enviado al formulario
            }
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
            $data['titulo_modal'] = $data['string_values']['title'];
            //pr($data);
            $data['cuerpo_modal'] = $this->load->view('validador_censo/formacion/formacion_salud_formulario', $data, TRUE);

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    /*public function subtipo_formacion($identificador, $CSUBTIP_FORM_SALUD_CVE = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $this->lang->load('interface');
            $data['string_values'] = array_merge($this->lang->line('interface')['formacion_salud'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $data['dir_tes']['CSUBTIP_FORM_SALUD_CVE'] = $CSUBTIP_FORM_SALUD_CVE;

            $entidades_ = array(enum_ecg::csubtipo_formacion_salud);
            $condiciones_ = array(enum_ecg::csubtipo_formacion_salud => array('TIP_FORM_SALUD_CVE' => $identificador));
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, $condiciones_);

            echo $this->load->view('validador_censo/formacion/formacion_salud_tipo_formacion', $data, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function subtipo_formacion_docente($identificador, $SUB_FOR_PRO_CVE = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $this->lang->load('interface');
            $data['string_values'] = array_merge($this->lang->line('interface')['formacion_docente'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $data['dir_tes']['SUB_FOR_PRO_CVE'] = $SUB_FOR_PRO_CVE;
            $data['dir_tes']['CURSO_CVE'] = $this->input->get('curso', true);
            $data['dir_tes']['EFP_NOMBRE_CURSO'] = $this->input->get('nombre_curso', true);

            $entidades_ = array(enum_ecg::csubtipo_formacion_profesional);
            $condiciones_ = array(enum_ecg::csubtipo_formacion_profesional => array('TIP_FOR_PROF_CVE' => $identificador));
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, $condiciones_);

            ////////////////////Tipo de curso
            $formacion_tipo = $this->config->item('formacion_tipo_subtipo__ccatalogo_modulo')[$identificador];
            if (!is_null($SUB_FOR_PRO_CVE) || isset($formacion_tipo[0])) { //
                $subtipo = (isset($formacion_tipo[0]) && array_key_exists(0, $formacion_tipo)) ? $formacion_tipo[0] : $formacion_tipo[$SUB_FOR_PRO_CVE];
                ////Obtener listado de cursos de acuerdo a tipo
                //$campos_catalogos = $this->fm->get_campos_catalogos(array('conditions'=>'campos_catalogos.MODULO_CVE IN ('.$this->config->item('ccatalogo_modulo')['FOR_DOC']['id'].','.$this->config->item('ccatalogo_modulo')['FOR_EDU_DIS']['id'].','.$this->config->item('ccatalogo_modulo')['FOR_DES_CON']['id'].','.$this->config->item('ccatalogo_modulo')['FOR_DIS_INS']['id'].','.$this->config->item('ccatalogo_modulo')['OTROS']['id'].')'));
                $campos_catalogos = $this->fm->get_campos_catalogos(array('conditions' => array('campos_catalogos.MODULO_CVE' => $subtipo)));
                //pr($campos_catalogos);
                foreach ($campos_catalogos as $key_cc => $cc) {
                    $data['catalogos']['campos_catalogos'][$cc['CURSO_CVE']] = $cc['CUR_NOMBRE'];
                }
            }

            echo $this->load->view('validador_censo/formacion/formacion_docente_tipo_formacion', $data, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    /**
     * Función que permite eliminar la dirección de tesis
     * @method: void eliminar_convocatoria()
     * @param: $Identificador   string en base64    Identificador de la dirección de tesis codificado en base64
     * @author: Jesús Z. Díaz P.
     */
    /*public function eliminar_formacion_salud($identificador) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $datos['identificador'] = $identificador; //Identificador de dirección de tesis
            $datos['msg'] = null;
            $dt_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la dirección de tesis
            $idempleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable

            $resultado = $this->fm->delete_formacion_salud(array('conditions' => array('FPCS_CVE' => $dt_id))); //Eliminar datos
            //pr($resultado);
            $this->eliminar_archivo(array('archivo' => $resultado['data']['COM_NOMBRE'], 'matricula' => $this->session->userdata('matricula')));

            echo json_encode($resultado); ///Muestra mensaje
            exit();
            //echo $this->load->view('evaluacion/convocatoria/dictamen_listado', $datos, true);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function eliminar_formacion_docente($identificador) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $datos['identificador'] = $identificador; //Identificador de formación
            $datos['msg'] = null;
            $fd_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la formación
            $idempleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable

            $resultado = $this->fm->delete_formacion_docente(array('conditions' => array('EMP_FORMACION_PROFESIONAL_CVE' => $fd_id))); //Eliminar datos
            //pr($resultado);
            $this->eliminar_archivo(array('archivo' => $resultado['data']['COM_NOMBRE'], 'matricula' => $this->session->userdata('matricula')));

            echo json_encode($resultado); ///Muestra mensaje
            exit();
            //echo $this->load->view('evaluacion/convocatoria/dictamen_listado', $datos, true);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }*/

    /////////////////////////Fin formación //////////////////////////
    /////////////////////////Fin dirección de tesis //////////////////////////

    /*     * ******************Inicia actividad docente ********************* */

    /**
     * author LEAS
     * Guarda actividad docente general
     */
    public function seccion_actividad_docente() {
//        pr($_SERVER);
        $data = array();
        $tipo_msg = $this->config->item('alert_msg');
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['actividad_docente'];
        $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
        $actividad_docente = $this->adm->get_actividad_docente_general($result_id_user); //Verifica si existe el ususario ya contiene datos de actividad
//        pr($actividad_docente);
        if ($this->input->post()) { //Validar que la información se haya enviado por método POST para almacenado
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('form_actividad_docente_general'); //Obtener validaciones de archivo
//            pr($validations);
            $this->form_validation->set_rules($validations);
//            pr($this->input->post(null, true));
            if ($this->form_validation->run()) { //Se ejecuta la validación de datos
                $datos_registro = $this->input->post(null, true);
                if (empty($actividad_docente)) {//insertar nueva actividad
                    $empleado = $this->cg->getDatos_empleado($result_id_user);
                    //Obtener identificador de empleado
                    if (!empty($empleado)) {
                        $actividad_docente_up['ANIOS_DEDICADOS'] = $datos_registro['actividad_anios_dedicados_docencia'];
                        $actividad_docente_up['EJER_PREDOMI_CVE'] = $datos_registro['ejercicio_predominante'];
//                        $actividad_docente_up['CURSO_PRINC_IMPARTE'] = $datos_registro['curso_principal_imapare'];
                        $actividad_docente_up['EMPLEADO_CVE'] = $empleado[0]['EMPLEADO_CVE']; //Asigna cve del empleado
                        $resultado = $this->adm->insert_actividad_docente_general($actividad_docente_up); //Inserta datos del docente
                        if ($resultado['return'] === -1) {//hubo un error a la hora de insertar un registro
                            $data['error'] = $string_values['error_insertar']; //Mensaje de que no encontro empleado
                            $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        } else {//Los datos se insertaron correctamente
                            $data['error'] = $string_values['succesfull_insertar']; //Mensaje de que los datos se insertaron correctamente
                            $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de éxito
                            //Datos de bitacora el actividad general del docente del usuario
                            $json = json_encode($resultado['parametros']);
                            $result = registro_bitacora($result_id_user, null, 'actividad_docente_gral', 'ACT_DOC_GRAL_CVE-' . $resultado['ACT_DOC_GRAL_CVE'], $json, 'insert');
                        }
                    } else {//No existe el empleado, manda un mensaje
                        $data['error'] = $this->lang->line('interface')['general']['msg_no_existe_empleado']; //Mensaje de que no encontro empleado
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    }
                } else {//Actualizar
                    //Preguntar si, existira mas de una actividad general por ususario, y si no, como se distingue 
                    $actividad_docente_up['ANIOS_DEDICADOS'] = $datos_registro['actividad_anios_dedicados_docencia'];
                    $actividad_docente_up['EJER_PREDOMI_CVE'] = $datos_registro['ejercicio_predominante'];
//                    $actividad_docente_up['CURSO_PRINC_IMPARTE'] = $datos_registro['curso_principal_imapare'];
                    $actividad_docente_up['EMPLEADO_CVE'] = $actividad_docente[0]['EMPLEADO_CVE']; //Asigna cve del empleado
                    $resultado = $this->adm->update_actividad_docente_general($actividad_docente_up); //Verifica si existe el ususario ya contiene datos de actividad
                    if ($resultado['return'] == -1) {//hubo un error a la hora de insertar un registro
                        $data['error'] = $string_values['error_actualizar']; //Mensaje de existio un error al actualizar los datos de actividad docente
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    } else {//Los datos se insertaron correctamente
                        $data['error'] = $string_values['succesfull_actualizar']; //Mensaje de que los datos se actualizarón correctamente
                        $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de éxito
//                        //Datos de bitacora el actividad general del docente del usuario
                        $json = json_encode($resultado['actualizados']);
                        $result = registro_bitacora($result_id_user, null, 'actividad_docente_gral', 'EMPLEADO_CVE', $json, 'update');
                    }
                }
//                $parse = json_encode($data);
//                echo $parse;
//                exit();
            }
        }

        $data['string_values'] = $string_values; //Array de textos que muestra el formulario para actividad
//        $condiciones = array(enum_ecg::cejercicio_predominante=>array('EJER_PREDOMI_CVE '=>'3'));//A manera de ejemplo
        //Carga catálogos según array, visto en config->general->catalogos_indexados 
        $data = carga_catalogos_generales(array(enum_ecg::cejercicio_predominante), $data); //Carga el catálogo de ejercicio predominante

        $data['actividad_docente'] = $actividad_docente; //

        if (!empty($actividad_docente)) {
//            pr($actividad_docente);
            $data['curso_principal'] = $actividad_docente[0]['CURSO_PRINC_IMPARTE']; //Identificador del curso principal 
            $data['actividad_general_cve'] = $actividad_docente[0]['ACT_DOC_GRAL_CVE']; //Identificador del curso principal 
            $data['curso_principal_entidad_contiene'] = $actividad_docente[0]['TIP_ACT_DOC_PRINCIPAL_CVE']; //Entidad que contiene el curso principal
            $data['datos_tabla_actividades_docente'] = $this->adm->get_actividades_docente($actividad_docente[0]['ACT_DOC_GRAL_CVE']); //Datos de las tablas emp_actividad_docente, emp_educacion_distancia, emp_esp_medica
//            pr($data['datos_tabla_actividades_docente']);
        }

        $this->load->view('validador_censo/actividad_docente/actividad_tpl', $data, FALSE);
    }

    /**
     * author LEAS
     * Carga el modal con opciones de tipo de actividad, tambien carga la información de una actividad
     * @param type $insertar si "insertar" es igual con "0" muestra el combo que 
     * carga los tipos de actividad docente. Si "insertar" es mayor que "0"
     */
    public function get_data_ajax_actividad_modal($insertar = '0') {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $data_post = $this->input->post(null, true);
//                pr($data_post);
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar 
                $data_actividad['string_values'] = $string_values; //Crea la variable 

                $act_gral_cve = $this->input->post('act_gral_cve');
                $data_actividad['act_gral_cve'] = $act_gral_cve;
                $datos_pie = array();
                $datos_pie['act_gral_cve'] = $act_gral_cve;


                if ($insertar === '0') {//Muestra el combo para seleccionar tipo de actividad docente 
                    $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE < ' => 15));
                    $data_actividad = carga_catalogos_generales(array(enum_ecg::ctipo_actividad_docente), $data_actividad, $condiciones_);
                } else {
                    $id_tp_act_doc = intval($data_post['tp_actividad_cve']);
                    if ($id_tp_act_doc > 0) {
                        $propiedades = $this->config->item('actividad_docente_componentes')[$id_tp_act_doc]; //Carga el nombre de la vista del diccionario 
                        $data_formulario = $this->cargar_datos_actividad($id_tp_act_doc, $data_post['act_doc_cve'], $propiedades); //No mover posición puede romperse
//                        pr($data_formulario);
                        $carga_extra = $propiedades['validaciones_extra'];
                        $data_formulario = $this->cargar_extra($data_formulario, $carga_extra); //No mover posición puede romperse
//                        pr($data_formulario);
                        $condiciones_ = array(); //Carga, únicamente el tipo de actividad docente
                        if (isset($propiedades['where'])) {
                            $condiciones_ = $propiedades['where']; //Carga, únicamente el tipo de actividad docente
                        }

                        $tipo_were = array(); //Carga, únicamente el tipo de actividad docente
                        if (isset($propiedades['where_grup'])) {
                            $tipo_were = $propiedades['where_grup']; //Carga, únicamente el tipo de actividad docente
                        }
                        $catalogos_ = $propiedades['catalogos_indexados']; //Carga, únicamente el tipo de actividad docente
                        $data_formulario = carga_catalogos_generales($catalogos_, $data_formulario, $condiciones_, true, $tipo_were);
                        //Condiciones extra "pago_extra" y "duracion"
                        $this->lang->load('interface', 'spanish');
                        $string_values = $this->lang->line('interface')['actividad_docente'];
                        //************fin de la carga de catálogos ***************************************
                        //*****************Carga ccurso según tipo de curso**************************
                        $valua_entidad = $propiedades['tabla_guardado'] === 'emp_actividad_docente';
                        if ($valua_entidad AND isset($data_formulario['ctipo_curso_cve']) AND ! empty($data_formulario['ctipo_curso_cve']) AND isset($data_formulario['ccurso_cve']) AND ! empty($data_formulario['ccurso_cve'])) {//si existe el "ccurso" y "ctipo_curso", hay que pintarlo
                            $tipo_curso_cve = intval($data_formulario['ctipo_curso_cve']);
                            $data_formulario['ccurso_pinta'] = $this->vista_ccurso($tipo_curso_cve, $data_formulario['ccurso_cve']); //Punta el curso
                        }
                        //********************************************************************************
                        //Carga dsatos de píe 
                        $datos_pie['tp_actividad_cve'] = $id_tp_act_doc;
                        $datos_pie['act_doc_cve'] = $this->input->post('act_doc_cve');
                        //Todo lo de comprobante *********************************************************
                        $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
                        $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                        $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                        if (isset($data_formulario['comprobante']) AND ! empty($data_formulario['comprobante'])) {
                            $data_comprobante['idc'] = $this->seguridad->encrypt_base64($data_formulario['comprobante']);
                            $datos_pie['comprobantecve'] = $data_comprobante['idc'];
                            $data_comprobante['dir_tes'] = array('TIPO_COMPROBANTE_CVE' => $data_formulario['ctipo_comprobante_cve'],
                                'COMPROBANTE_CVE' => isset($data_formulario['comprobante_cve']) ? $data_formulario['comprobante_cve'] : '',
                                'COM_NOMBRE' => isset($data_formulario['text_comprobante']) ? $data_formulario['text_comprobante'] : '');
                        }
                        $vista_comprobante['vista_comprobante'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
                        $data_formulario['formulario_carga_comprobante'] = $this->load->view('validador_censo/actividad_docente/comprobante_actividad_docente', $vista_comprobante, TRUE);
                        //*********************************************fin carga comprobante**************
                        //Carga la vista del formulario
                        $data_formulario['string_values'] = $string_values;
                        $data_actividad['formulario'] = $this->load->view($propiedades['vista'], $data_formulario, TRUE);
                        $data_actividad['nada'] = '';
                    }
                }

                $data = array(
                    'titulo_modal' => 'Actividad docente',
                    'cuerpo_modal' => $this->load->view('validador_censo/actividad_docente/actividad_modal_tpl', $data_actividad, TRUE),
                    'pie_modal' => $this->load->view('validador_censo/actividad_docente/actividad_docente_pie', $datos_pie, true)
                );
                echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
            }
        } else {
            redirect(site_url());
        }
    }

    private function cargar_extra($array_datos, $array_extras) {
        foreach ($array_extras as $value) {
            switch ($value) {
                case 'pago_extra':
                    if (key_exists($value, $array_datos)) {
                        $array_datos['pago_extra'];
                    }
                    break;
                case 'duracion':
                    if (key_exists('hora_dedicadas', $array_datos) AND ! is_null($array_datos['hora_dedicadas'])) {
                        $array_datos['duracion'] = 'hora_dedicadas';
                        $array_datos['mostrar_hora_fecha_duracion'] = 'hora_dedicadas';
                    } else {
                        $array_datos['duracion'] = 'fecha_dedicadas';
                        $array_datos['mostrar_hora_fecha_duracion'] = 'fecha_dedicadas';
                    }

                    break;
            }
        }
        return $array_datos;
    }

    private function cargar_datos_actividad($id_tp_actividad, $id_act_doc, $propiedades_entidad) {
        $cve = $propiedades_entidad['llave_primaria'];
        $entidad = $propiedades_entidad['tabla_guardado'];
        $result_consulta = $this->adm->get_datos_actividad_docente($entidad, $id_act_doc);
        return $result_consulta;
    }

    public function get_vista_form_act_docente() {
        if ($this->input->is_ajax_request()) {//Si es un ajax
            if ($this->input->post()) {//Datos mandados por post
                $datos_post = $this->input->post(null, FALSE);
                $this->lang->load('interface', 'spanish');
                $tipo_msg = $this->config->item('alert_msg');
                $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar 
                if (!empty($datos_post['tp_actividad_cve']) AND $datos_post['tp_actividad_cve'] !== 'undefined') {//Carga el formulario correspondiente
                    //Carga los catálogos y vistas correspondientes *****************************
                    $index_tp_actividad = intval($datos_post['tp_actividad_cve']);
                    $configuracion_formularios_actividad_docente = $this->config->item('actividad_docente_componentes')[$index_tp_actividad]; //Carga la configuración  del formularío
                    $condiciones_ = null;
                    if (isset($configuracion_formularios_actividad_docente['where'])) {
                        $condiciones_ = $configuracion_formularios_actividad_docente['where'];
                    }
                    $group_where = null;
                    if (isset($configuracion_formularios_actividad_docente['where_grup'])) {
                        $group_where = $configuracion_formularios_actividad_docente['where_grup'];
                    }
                    $entidades_ = $configuracion_formularios_actividad_docente['catalogos_indexados']; //Nombre de los catátalogos a cargar
                    $data_actividad_doc = carga_catalogos_generales($entidades_, null, $condiciones_, true, $group_where);
                    //************fin de la carga de catálogos ***********************************
                    $data_actividad_doc['mostrar_hora_fecha_duracion'] = 0; //
                    $data_actividad_doc['string_values'] = $string_values;
                    //Todo lo de comprobante *******************************************
                    $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
                    $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                    $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                    $vista_comprobante['vista_comprobante'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
                    $data_actividad_doc['formulario_carga_comprobante'] = $this->load->view('validador_censo/actividad_docente/comprobante_actividad_docente', $vista_comprobante, TRUE);
                    //**** fi de comprobante *******************************************
                    echo $this->load->view($configuracion_formularios_actividad_docente['vista'], $data_actividad_doc, TRUE);
                    exit();
                } else {
                    //Manda mensaje que debe cargar o seleccionar una opción
                    $res_j['error'] = $string_values['msj_selecciona_actividad_docente']; //Mensaje
                    $res_j['tipo_msg'] = $tipo_msg['WARNING']['class']; //Tipo de mensaje de error
                    $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
                    echo json_encode($res_j);
                    exit();
                }
            }
        } else {
            redirect(site_url());
        }
    }

    /**
     * @author LEAS
     * @param type $index_tipo_actividad_docente 
     */
    public function get_add_actividad_docente() {
        if ($this->input->is_ajax_request()) {//Si es un ajax
            $datos_post = $this->input->post(null, true);
            if ($datos_post) {
                $index_tipo_actividad_docente = intval($datos_post['cve_tipo_actividad']);
                $configuracion_formularios_actividad_docente = $this->config->item('actividad_docente_componentes')[$index_tipo_actividad_docente]; //Carga la configuración  del formularío
                $tipo_msg = $this->config->item('alert_msg');
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar
                $data_actividad_doc['string_values'] = $string_values; //Almacena textos de actividad en el arreglo
                $data_actividad_doc['mostrar_hora_fecha_duracion'] = 0; //
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_ccl'); //Obtener validaciones de archivo
                $data_actividad_doc['mostrar_hora_fecha_duracion'] = $this->get_valor_validacion($datos_post, 'duracion'); //Muestrá validaciones de hora y fecha de inicio y termino según la opción de duración
                $array_validaciones_extra_actividad = $configuracion_formularios_actividad_docente['validaciones_extra']; //Carga las validaciones extrá de archivo config->general que no se pudieron automatizar con el post, es decir radio button etc
                $result_validacion = $this->analiza_validacion_actividades_docentes($validations, $datos_post, $array_validaciones_extra_actividad); //Genera las validaciones del formulario que realmente deben ser tomadas en cuenta
                $validations = $result_validacion['validacion'];
//                pr($result_validacion['insert_entidad']);
                $this->form_validation->set_rules($validations); //Carga las validaciones
                if ($this->form_validation->run()) {//Ejecuta validaciones
                    $result_id_user = $this->obtener_id_usuario(); //Asigna id del usuario
                    $result_id_empleado = $this->obtener_id_empleado(); //Asigna id del usuario
                    $act_doc_gral = isset($datos_post['act_gral_cve']) ? $datos_post['act_gral_cve'] : NULL;
                    $result_guardar_actividad = $this->guardar_actividad($result_validacion['insert_entidad'], $index_tipo_actividad_docente, intval($datos_post['act_doc_cve']), $act_doc_gral, $result_id_empleado, $result_id_user, $string_values);
                    $res = json_encode($result_guardar_actividad);
                    echo $res;
                    exit();
                }

                if ($index_tipo_actividad_docente > 0) {//Checa si debe aparecer el botòn de guardar 
                    //Carga los catálogos y vistas correspondientes *****************************
                    $configuracion_formularios_actividad_docente = $this->config->item('actividad_docente_componentes')[$index_tipo_actividad_docente]; //Carga la configuración  del formularío
                    $condiciones_ = array();
                    if (isset($configuracion_formularios_actividad_docente['where'])) {
                        $condiciones_ = $configuracion_formularios_actividad_docente['where'];
                    }
                    $group_where = array();

                    if (isset($configuracion_formularios_actividad_docente['where_grup'])) {
                        $group_where = $configuracion_formularios_actividad_docente['where_grup'];
                    }
                    $entidades_ = $configuracion_formularios_actividad_docente['catalogos_indexados']; //Nombre de los catátalogos a cargar
                    $data_actividad_doc = carga_catalogos_generales($entidades_, $data_actividad_doc, $condiciones_, true, $group_where);
                    //************fin de la carga de catálogos ***********************************
                    if (isset($datos_post['ctipo_curso']) AND ! empty(isset($datos_post['ctipo_curso'])) AND isset($datos_post['ccurso'])) {//si existe el "ccurso" y "ctipo_curso", hay que pintarlo
                        $tipo_curso_cve = intval($datos_post['ctipo_curso']);
                        $data_actividad_doc['ccurso_pinta'] = $this->vista_ccurso($tipo_curso_cve); //Punta el curso
                    }
                    //Todo lo de comprobante *******************************************
                    $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
                    $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                    $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                    if (isset($datos_post['idc']) AND ! empty($datos_post['idc'])) {
                        $data_comprobante['idc'] = $datos_post['idc'];
                        $data_comprobante['dir_tes'] = array('TIPO_COMPROBANTE_CVE' => $datos_post['tipo_comprobante'],
                            'COM_NOMBRE' => isset($datos_post['text_comprobante']) ? $datos_post['text_comprobante'] : '',
                            'COMPROBANTE_CVE' => isset($datos_post['comprobante_cve']) ? $datos_post['comprobante_cve'] : '');
                    }

                    $vista_comprobante['vista_comprobante'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
                    $data_actividad_doc['formulario_carga_comprobante'] = $this->load->view('validador_censo/actividad_docente/comprobante_actividad_docente', $vista_comprobante, TRUE);
                    //**** fi de comprobante *******************************************
                    echo $this->load->view($configuracion_formularios_actividad_docente['vista'], $data_actividad_doc, TRUE); //Carga la vista correspondiente al index
                }
            }
        }
    }

    /**
     * @author LEAS
     * @param type $validaciones
     * @param type $key
     * @return int
     */
    private function get_valor_validacion($validaciones, $key) {
        if (array_key_exists($key, $validaciones)) {
            return $validaciones[$key];
        }
        return 0;
    }

    /**
     * author LEAS
     * modificacion 17/08/2016
     * @param type $array_validacion
     * @param type $array_post
     * @param type $validacion_extra Las validaciones extra estan pensadas más 
     *             para "radio button" validaciones_extra, es un array de reglas 
     *             que se encuentrá en 
     * "config"->"general"->"actividad_docente_componentes"->"validaciones_extra"
     * y son de tipo textuales,
     * @return type
     */
    private function analiza_validacion_actividades_docentes($array_validacion, $array_post, $validacion_extra, $is_actualizacion = FALSE) {
//        pr($array_componentes);
//        pr($array_validacion);
        $entidad_name = $this->config->item('actividad_docente_componentes')[$array_post['cve_tipo_actividad']]['tabla_guardado']; //Carga los datos de la entidad para guardar
        $array_insert = $this->config->item($entidad_name);
        $array_result = array();
        foreach ($array_post as $key => $value) {
            switch ($key) {
                case 'idc'://Clave del comprobante 
                    $comprobante_cve = $this->seguridad->decrypt_base64($value); //Desencripta comprobante
                    //Array para insertar
                    $array_result['insert_entidad']['COMPROBANTE_CVE'] = $comprobante_cve; //Agrega id del comprobante
                    break;
                case 'enctype':
                    break;
                case 'tipo_comprobante':
                    break;
                case 'text_comprobante':
                    break;
                case 'extension':
                    break;
                case 'act_doc_cve':
                    break;
                case 'fecha_inicio_pick'://No carga si no hasta duraciòn 
//                    $array_fechas['fecha_inicio_pick'] = date("Y-m-d", strtotime($value));
                    break;
                case 'fecha_fin_pick'://No carga si no hasta duraciòn
//                    $array_fechas['fecha_fin_pick'] = date("Y-m-d", strtotime($value));
                    break;
                case 'hora_dedicadas'://No carga si no hasta duraciòn
                    break;
                case 'duracion':
                    if ($value === 'hora_dedicadas') {
                        $array_result['validacion'][] = $array_validacion['hora_dedicadas'];
                        //Array para insertar
                        if (key_exists('hora_dedicadas', $array_insert)) {
                            $array_result['insert_entidad'][$array_insert['hora_dedicadas']['insert']] = $array_post['hora_dedicadas']; //Agrega valor
                        }
                    } else {//fechas_dedicadas
                        $array_result['validacion'][] = $array_validacion['fecha_inicio_pick'];
                        $array_result['validacion'][] = $array_validacion['fecha_fin_pick'];
                        //Array para insertar
                        if (key_exists('fecha_inicio_pick', $array_insert)) {
                            $array_result['insert_entidad'][$array_insert['fecha_inicio_pick']['insert']] = $array_post['fecha_inicio_pick']; //Agrega valor
                            $array_result['insert_entidad'][$array_insert['fecha_fin_pick']['insert']] = $array_post['fecha_fin_pick']; //Agrega valor
                        }
                    }
                    break;
                default :
//                    pr($key);
                    if (key_exists($key, $array_validacion)) {
                        $array_result['validacion'][] = $array_validacion[$key];
                    }
                    //Array para insertar
                    if (key_exists($key, $array_insert)) {
                        $array_result['insert_entidad'][$array_insert[$key]['insert']] = $value; //Agrega valor
                    }
            }
        }
        //Elimina claves vacias tipo de curso está vacia en "emp_actividad_docente" solo sirve para hacer la validación pero no guarda, solo guarda ccurso
        unset($array_result['insert_entidad']['']);
        //Busca si existen validaciones extra, ejemple pago extra o duración, que son radio button, pero no trae valor si no se selecciona 
        foreach ($validacion_extra as $value_extra) {
            if (!array_key_exists($value_extra, $array_post)) {
                $array_result['validacion'][] = $array_validacion[$value_extra];
            }
        }
        return $array_result;
    }

    /**
     * author LEAS
     * @param type $array_propiedades_actividad
     * @param array $arrar_datos_post
     * @param type $array_elementos_no_post
     * @param type $actividad_docente_general
     * @return type
     */
    private function guardar_actividad($array_campos_valores, $tipo_act_doc_cve, $actividad_docente_cve, $act_gral_cve, $empleado_cve, $user_cve, $string_values) {
        if (is_null($array_campos_valores)) {//si es null returna -1 que indica que no se guardo 
            return array();
        }
        $array_propiedades_actividad = $this->config->item('actividad_docente_componentes')[$tipo_act_doc_cve];
        $entidad_guardado = $array_propiedades_actividad['tabla_guardado']; //Se obtiene el nombre de la entidad de guardado
        $entidad_guardado_pk = $array_propiedades_actividad['llave_primaria']; //Se obtiene la llave primaria de la entidad de guardado
        $tipo_msg = $this->config->item('alert_msg'); //Carga tipos de mensajes
        $res_j = array();
        if ($actividad_docente_cve > 0) {//Actualización de la actividad
            $campos_entidad_vacios = $this->config->item($entidad_guardado);
            foreach ($campos_entidad_vacios as $key => $value) {
                $campo = $value['insert'];
                if (!key_exists($campo, $array_campos_valores)) {
                    $array_campos_valores[$campo] = null; //Agrega el campo vacio
                }
            }
            unset($array_campos_valores['']); //Limpiar campos vacios
//            pr($array_campos_valores);
            $result = $this->adm->update_emp_actividad_docente_gen($actividad_docente_cve, $entidad_guardado_pk, $entidad_guardado, $array_campos_valores); //Guardar valores en entidad
            if (!empty($result)) {//Se guardo correctamente
                $array_campos_valores[$entidad_guardado_pk] = $result; //Asigna el id a los datos
                $array_datos_entidad[$entidad_guardado] = $array_campos_valores; //Pertenece a bitacora
                $array_operacion_id_entidades[$entidad_guardado] = array('update' => $array_campos_valores[$entidad_guardado_pk]); //Pertenece a bitacora 
                $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                //Datos de bitacora el registro del usuario
                registro_bitacora($user_cve, null, $json_datos_entidad, null, $json_registro_bitacora, null);

                $res_j['error'] = $string_values['succesfull_actualizar']; //Mensaje de que no encontro empleado
                $res_j['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
            } else {//Error al guardar o en la transacción 
                $res_j['error'] = $string_values['error_actualizar']; //Mensaje de que no encontro empleado
                $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
            }
        } else {//Insertar nuevo registro
            $array_campos_valores['TIP_ACT_DOC_CVE'] = intval($tipo_act_doc_cve);
            $array_campos_valores['EMPLEADO_CVE'] = $empleado_cve;
            $array_campos_valores['ACT_DOC_GRAL_CVE'] = intval($act_gral_cve);
            $result = $this->adm->insert_emp_actividad_docente_gen($entidad_guardado, $array_campos_valores); //Guardar valores en entidad
            if ($result > 0) {//Se guardo correctamente
                $array_campos_valores[$entidad_guardado_pk] = $result; //Asigna el id a los datos
                $array_datos_entidad[$entidad_guardado] = $array_campos_valores; //Pertenece a bitacora
                $array_operacion_id_entidades[$entidad_guardado] = array('insert' => $array_campos_valores[$entidad_guardado_pk]); //Pertenece a bitacora 
                $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                //Datos de bitacora el registro del usuario
                registro_bitacora($user_cve, null, $json_datos_entidad, null, $json_registro_bitacora, null);

                $res_j['error'] = $string_values['succesfull_insertar']; //Mensaje de que no encontro empleado
                $res_j['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
            } else {//Error al guardar o en la transacción 
                $res_j['error'] = $string_values['error_insertar']; //Mensaje de que no encontro empleado
                $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
            }
        }

        return $res_j;
    }

    public function get_data_ajax_eliminar_actividad_modal() {
//        pr('tipo de actividad ' . $index_tp_actividad);
//        pr('tipo de actividad ' . $index_entidad);
//        pr('tipo de actividad ' . $is_cur_principal);
        $datos_registro = $this->input->post(null, true);
        //pr($datos_registro);  
        //exit();
        $propiedades_formulario_actividad = $this->config->item('actividad_docente_componentes')[$datos_registro['index_entidad']]; //Propiedades de la tabla de referencia
//        pr('tipo de actividad name entidad: ' . $propiedades_formulario_actividad['tabla_guardado']);
        $data = array();
        $tipo_msg = $this->config->item('alert_msg');
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['actividad_docente'];
        $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
        $texto_tipo_actividad = $propiedades_formulario_actividad['texto'];
//        if ($post === '1') {//Indica que debe intentar eliminar el curso
        if ($this->input->post()) {//Indica que debe intentar eliminar el curso
//            if ($this->form_validation->run()) {}
            $entidad_eliminacion = $propiedades_formulario_actividad['tabla_guardado'];
            $campo_where = $propiedades_formulario_actividad['llave_primaria'];
            $resul_delete = $this->adm->delete_actividad_docente($entidad_eliminacion, $campo_where, $datos_registro['index_tp_actividad']); //Verifica si existe el ususario ya contiene datos de actividad
            if ($resul_delete === -1) {//Manda mensaje de que no se pudo borrar el registro
                $valor_msj = str_replace('[field]', $texto_tipo_actividad, $string_values['error_eliminar']); //Agrega nombre de la actividad de docente
                $data['error'] = $valor_msj; //Mensaje de que no encontro empleado
                $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                $this->output->set_status_header('400');
            } else {
                $valor_msj = str_replace('[field]', $texto_tipo_actividad, $string_values['succesfull_eliminar']); //Agrega nombre de la actividad de docente
                $data['error'] = $valor_msj; //Mensaje de que no encontro empleado
                $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                $data['borrado_correcto'] = 1; //Tipo de mensaje de error
            }
            echo json_encode($data);
        }
    }

    public function get_data_ajax_actualiza_curso_principal() {
        if ($this->input->post()) {//Datos mandados por post
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['actividad_docente'];
            $tipo_msg = $this->config->item('alert_msg');
            $value = $this->input->post(null, FALSE);
            $actividad_general_cve = str_replace("'", '', $value['actividad_general_cve']);
            $actividad_general_cve = str_replace("/", '', $actividad_general_cve);
            $index_tp_actividad = str_replace("'", '', $value['index_tp_actividad']);
            $index_tp_actividad = str_replace("/", '', $index_tp_actividad);
            $actividad_docente = str_replace("'", '', $value['actividad_docente_cve']);
            $actividad_docente = str_replace("/", '', $actividad_docente);

            $datos['ACT_DOC_GRAL_CVE'] = $actividad_general_cve;
            $datos['TIP_ACT_DOC_PRINCIPAL_CVE'] = $index_tp_actividad;
            $datos['CURSO_PRINC_IMPARTE'] = $actividad_docente;
//            pr($datos);
            $result = $this->adm->update_curso_principal_actividad_docente($datos);
//            pr($result);
            if ($result['return'] === 1) {
                $data['error'] = $string_values['save_curso_principal_modificado']; //
                $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                $data['result'] = 1; //Error resultado success
            } else if ($result['return'] < 0) {
                $data['error'] = $string_values['error_curso_principal_modificado']; //
                $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                $data['result'] = 0; //Error resultado mal
            } else {
                $this->output->set_status_header('400');
            }
//            pr(json_encode($data));
            echo json_encode($data);

            exit();
        }
    }

    private function verifica_curso_principal_actividad_docente($index_tp_actividad = '0', $index_entidad = '0', $id_user = '0') {
        if ($index_entidad === '0' || $index_tp_actividad = '0' || $id_user = '0') {
            return -1; //No es curso principal
        }
        $actividad_docente = $this->adm->get_actividad_docente_general($id_user); //Verifica si existe el ususario ya contiene datos de actividad
        if (!empty($actividad_docente)) {//Existe la actividad docente general
            $actividad_docente = $this->adm->get_verifica_curso_principal_actividad_general($index_tp_actividad, $index_entidad, $actividad_docente); //Verifica si es curso principal
        } else {
            return -1; //No es curso principal
        }
    }

    public function cargar_comprobante() {
//        pr('queueuee');
        if ($this->input->post()) {
//            pr($this->input->post());
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = '50000';
//        $config['file_name'] = $file_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload()) {
                $data['error'] = $this->upload->display_errors();
            } else {

                $file_data = $this->upload->data();
                $data['file_path'] = './uploads/' . $file_data['file_name'];
            }
//            pr($this->upload->data());
            return $data;
        }
    }

//********************Investigación educativa ******************************************************************************/
    public function seccion_investigacion() {
        $data = array();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['investigacion_docente'];
        $data['string_values'] = $string_values;
        $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
        $empleado = $this->cg->getDatos_empleado($result_id_user); //Obtenemos datos del empleado
        if (!empty($empleado)) {//Si existe un empleado, obtenemos datos
            $this->load->model('Investigacion_docente_model', 'id');
            $lista_investigacion = $this->id->get_lista_datos_investigacion_docente($empleado[0]['EMPLEADO_CVE']);
            $data['lista_investigaciones'] = $lista_investigacion;
            $this->load->view('validador_censo/investigacion/investigacion_tpl', $data, FALSE); //Valores que muestrán la lista
        } else {
            //Error, No existe el empleado
        }
        //Consulta datos de empleado en investigación
    }

    public function cargar_formulario_investigacion() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['investigacion_docente']; //Carga textos a utilizar 
            $data_investigacion['string_values'] = $string_values; //Crea la variable
            $data_investigacion['divulgacion'] = ''; //Crea la variable 
            $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE > ' => 14));
            $entidades_ = array(enum_ecg::ctipo_actividad_docente, enum_ecg::ctipo_comprobante, enum_ecg::ctipo_participacion, enum_ecg::ctipo_estudio, enum_ecg::cmedio_divulgacion);
            $data_investigacion = carga_catalogos_generales($entidades_, $data_investigacion, $condiciones_);
            $datos_pie = array();

            $data = array(
                'titulo_modal' => 'Investigación',
                'cuerpo_modal' => $this->load->view('validador_censo/investigacion/investigacion_formulario', $data_investigacion, TRUE),
                'pie_modal' => $this->load->view('validador_censo/investigacion/investigacion_pie', $datos_pie, true)
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url());
        }
    }

    public function cargar_opcion_divulgacion() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Después de cargar el formulario
                $datos_post = $this->input->post(null, true);
                $vista = $this->divulgacion_cargar($datos_post['cve_divulgacion']);
                echo $vista;
            }
        } else {
            redirect(site_url());
        }
    }

    public function ajax_add_investigacion() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $tipo_msg = $this->config->item('alert_msg');
            $string_values = $this->lang->line('interface')['investigacion_docente']; //Carga textos a utilizar 
            $data_investigacion['string_values'] = $string_values; //Crea la variable 
            $divulgacion = '';
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
            $datos_pie = array(); //Asignamos id usuario a variable

            if ($this->input->post()) {//Después de cargar el formulario
//                pr($this->input->post());
                $datos_post = $this->input->post(null, true);
//                pr($datos_post);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_investigacion_docente'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_investigacion_docente($validations, $datos_post, $_FILES);
                $array_to_json = array(); //name_entidad => array(campos con valores)
                $array_operacion_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
//                pr($datos_registro);
                $divulgacion = $datos_post['cmedio_divulgacion']; //Para mostrar los divs de bibliografia o comprobante
//                pr($validations['emp_act_inv_edu_inser']);
//                pr($validations['validacion']);
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    $array_insert_act_docente = $validations['emp_act_inv_edu_inser'];
                    $array_insert_act_docente['EMPLEADO_CVE'] = $result_id_empleado; //Asigna empleado
                    if (isset($datos_post['idc']) AND ! empty($datos_post['idc'])) {
                        $array_insert_act_docente['COMPROBANTE_CVE'] = $this->seguridad->decrypt_base64($datos_post['idc']); //Asigna empleado
                    }

                    $result_insert_investigacion = $this->idm->insert_investigacion_docente($array_insert_act_docente); //Inserta investigación 
                    if ($result_insert_investigacion > 0) {//se inserto correctamente, se debe registrar en bitacora
                        $array_insert_act_docente['EAID_CVE'] = $result_insert_investigacion; //Agrega identificador del registro de investigación insertado 
                        $array_datos_entidad['emp_act_inv_edu'] = $array_insert_act_docente; //Pertenece a bitacora
                        $array_operacion_id_entidades['emp_act_inv_edu'] = array('insert' => $result_insert_investigacion); //Pertenece a bitacora 
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['phl_registro_correcto']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
                    }
                    echo json_encode($res_j);
                    exit();
                }//*************************Termina bloque de insertar nueva investigación
            }

//          $data_investigacion['divulgacion'] = $divulgacion; //Crea la variable
            $data_investigacion['formulario_carga_opt_tipo_divulgacion'] = $this->divulgacion_cargar($divulgacion, $datos_post);
            $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE > ' => 14));
            $entidades_ = array(enum_ecg::ctipo_actividad_docente, enum_ecg::ctipo_comprobante, enum_ecg::ctipo_participacion, enum_ecg::ctipo_estudio, enum_ecg::cmedio_divulgacion);
            $data_investigacion = carga_catalogos_generales($entidades_, $data_investigacion, $condiciones_);


            echo $this->load->view('validador_censo/investigacion/investigacion_formulario', $data_investigacion, TRUE);
        } else {
            redirect(site_url());
        }
    }

    public function ajax_carga_datos_investigacion() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['investigacion_docente']; //Carga textos a utilizar 
            $data_investigacion['string_values'] = $string_values; //Crea la variable 
            $divulgacion = '';
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula');
            $datos_pie = array();
            if ($this->input->post()) {
                $datos_post = $this->input->post(null, true);
//                pr($datos_post);
                if (isset($datos_post['cve_inv'])) {
                    $datos_pie['cve_inv'] = $datos_post['cve_inv'];
                    $datos_pie['comprobantecve'] = $datos_post['comprobantecve'];
                    $id_inv = $this->seguridad->decrypt_base64($datos_post['cve_inv']);
                    $data_investigacion_load = $this->idm->get_datos_investigacion_docente(intval($id_inv)); //Variable que carga los datos del registro de investigación, será enviada a la vista para cargar los datos
                    if (!empty($data_investigacion_load)) {//Si es diferente de vacio 
                        $data_investigacion['select_inv'] = $data_investigacion_load;
                        $divulgacion = $data_investigacion_load['med_divulgacion_cve']; //Carga el index de la opción divulgación
                        if (!empty($datos_post['comprobantecve'])) {//Si existe comprobante, manda el identificador
                            $data_investigacion_load['idc'] = $datos_post['comprobantecve'];
                        }
                        //Selecciona divulgación
                        $data_investigacion['formulario_carga_opt_tipo_divulgacion'] = $this->divulgacion_cargar($divulgacion, $data_investigacion_load, TRUE);
                    }
                }
            }

            $data_investigacion['divulgacion'] = $divulgacion; //Crea la variable 
            $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE > ' => 14));
            $entidades_ = array(enum_ecg::ctipo_actividad_docente, enum_ecg::ctipo_comprobante, enum_ecg::ctipo_participacion, enum_ecg::ctipo_estudio, enum_ecg::cmedio_divulgacion);
            $data_investigacion = carga_catalogos_generales($entidades_, $data_investigacion, $condiciones_);
            $data = array(
                'titulo_modal' => 'Investigación',
                'cuerpo_modal' => $this->load->view('validador_censo/investigacion/investigacion_formulario', $data_investigacion, TRUE),
                'pie_modal' => $this->load->view('validador_censo/investigacion/investigacion_pie', $datos_pie, true)
            );

            echo $this->ventana_modal->carga_modal($data);
        } else {
            redirect(site_url());
        }
    }

    public function ajax_update_investigacion() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $tipo_msg = $this->config->item('alert_msg');
            $string_values = $this->lang->line('interface')['investigacion_docente']; //Carga textos a utilizar 
            $data_investigacion['string_values'] = $string_values; //Crea la variable 
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            if ($this->input->post()) {//Después de cargar el formulario
                $datos_post = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $val = $this->config->item('form_investigacion_docente'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_investigacion_docente($val, $datos_post, $_FILES, TRUE);
//                pr($datos_post);
//                pr($validations['validacion']);
                //Parametros iniciales que deben persistir en el botón de actualización
                $divulgacion = $datos_post['cmedio_divulgacion']; //Variable que carga los datos del registro de investigación, será enviada a la vista para cargar los datos
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) {//Si pasa todas las validaciones, actualizar
                    $array_actualizacion_inv_doc = $validations['emp_act_inv_edu_update'];
                    $cve_divulgacion = intval($array_actualizacion_inv_doc['MED_DIVULGACION_CVE']);
                    if ($cve_divulgacion < 3) {//Asigna id del comprobante
                        $array_actualizacion_inv_doc['COMPROBANTE_CVE'] = $id_comprobante = intval($this->seguridad->decrypt_base64($datos_post['idc']));
                    }

                    $id_investigacion = intval($this->seguridad->decrypt_base64($datos_post['cve_inv']));
                    //Actualiza datos de investigación
                    $result_actualizacion_investigacion_docente = $this->idm->update_investigacion_docente($id_investigacion, $array_actualizacion_inv_doc);
                    if (!empty($result_actualizacion_investigacion_docente)) {
                        $array_datos_entidad['emp_act_inv_edu'] = $result_actualizacion_investigacion_docente; //Pertenece a bitacora
                        $array_operacion_id_entidades['emp_act_inv_edu'] = array('update' => $result_actualizacion_investigacion_docente['EAID_CVE']); //Pertenece a bitacora 
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['phl_registro_correcto']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
                    }
                    echo json_encode($res_j);
                    exit();
                }

                $data_investigacion['formulario_carga_opt_tipo_divulgacion'] = $this->divulgacion_cargar($divulgacion, $datos_post, TRUE);

                $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE > ' => 14));
                $entidades_ = array(enum_ecg::ctipo_actividad_docente, enum_ecg::ctipo_comprobante, enum_ecg::ctipo_participacion, enum_ecg::ctipo_estudio, enum_ecg::cmedio_divulgacion);
                $data_investigacion = carga_catalogos_generales($entidades_, $data_investigacion, $condiciones_);

                echo $this->load->view('validador_censo/investigacion/investigacion_formulario', $data_investigacion, TRUE); //Carga los div de modal
            }
        }
    }

    private function divulgacion_cargar($divulgacion_cve, $array_comprobante = array(), $is_actualizacion = FALSE) {
        if (!empty($divulgacion_cve)) {
            $cve_divulgacion = intval($divulgacion_cve);
            $this->lang->load('interface', 'spanish');
//            pr($array_comprobante);
            switch ($cve_divulgacion) {
                case 3:
                    $data['string_values'] = $this->lang->line('interface')['investigacion_docente'];
                    if ($is_actualizacion AND key_exists('cita_publicada', $array_comprobante)) {
                        $data['bibliografia_libro'] = $array_comprobante['cita_publicada'];
                    }
                    return $this->load->view('validador_censo/investigacion/bibliografia_libro', $data, TRUE);
                    break;
                case 4:
                    $data['string_values'] = $this->lang->line('interface')['investigacion_docente'];
                    if ($is_actualizacion AND key_exists('cita_publicada', $array_comprobante)) {
                        $data['bibliografia_revista'] = $array_comprobante['cita_publicada'];
                    }
                    return $this->load->view('validador_censo/investigacion/bibliografia_revista', $data, TRUE);
                    break;
                default :
                    //Todo lo de comprobante *******************************************
                    $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
                    $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                    $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                    if ($is_actualizacion) {
                        if (!empty($array_comprobante) AND isset($array_comprobante['idc'])) {//si existe el id del comprobante
//                        $id_desencript = $this->seguridad->decrypt_base64($datos_post['idc']);
                            $data_comprobante['idc'] = $array_comprobante['idc'];
                            $data_comprobante['dir_tes'] = array('TIPO_COMPROBANTE_CVE' => $array_comprobante['tipo_comprobante'],
                                'COM_NOMBRE' => isset($array_comprobante['text_comprobante']) ? $array_comprobante['text_comprobante'] : '',
                                'COMPROBANTE_CVE' => isset($array_comprobante['comprobante_cve']) ? $array_comprobante['comprobante_cve'] : '');
                        }
                    } else {

                        if (!empty($array_comprobante) AND isset($array_comprobante['idc'])) {//si existe el id del comprobante
//                        $id_desencript = $this->seguridad->decrypt_base64($datos_post['idc']);
                            $data_comprobante['idc'] = $array_comprobante['idc'];
//                            pr($array_comprobante);
                            $data_comprobante['dir_tes'] = array('TIPO_COMPROBANTE_CVE' => $array_comprobante['tipo_comprobante'],
                                'COM_NOMBRE' => isset($array_comprobante['text_comprobante']) ? $array_comprobante['text_comprobante'] : '',
                                'COMPROBANTE_CVE' => isset($array_comprobante['comprobante_cve']) ? $array_comprobante['comprobante_cve'] : '');
                        }
                    }
                    //**** fi de comprobante *******************************************
                    $data['vista_comprobante'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
                    return $this->load->view('validador_censo/investigacion/comprobante_foro', $data, TRUE);
            }
            return '';
        }
    }

    /**
     * author LEAS
     * @param type $array_validaciones
     * @param type $array_elementos_post
     * @param type $validacion_extra Las validaciones extra estan pensadas más 
     *             para "radio button" validaciones_extra, es un array de reglas 
     *             que se encuentrá en 
     * "config"->"general"->"actividad_docente_componentes"->"validaciones_extra"
     * y son de tipo textuales,
     * @return type
     */
    private function analiza_validacion_investigacion_docente($array_validaciones, $array_elementos_post, $file = null, $is_actualizacion = FALSE) {
//        pr($array_validaciones);
//        pr($array_elementos_post);
        $array_result = array();
        $emp_act_inv_edu = $this->config->item('emp_act_inv_edu'); //Campos de la tabla
//        pr($array_elementos_post);
//        pr($$array_validaciones);
        foreach ($array_elementos_post as $key => $value) {
            if (array_key_exists($key, $array_validaciones)) {
                $array_result['validacion'][] = $array_validaciones[$key];
                if (array_key_exists($key, $emp_act_inv_edu)) {
                    $array_result['emp_act_inv_edu_inser'][$emp_act_inv_edu[$key]['insert']] = $value;
                    $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu[$key]['insert']] = $value;
                }
            }
        }

        if ($is_actualizacion) {//si es acyualización limpía los datos de la entidad que no se ocupen, como limpiar el comprobante o la cita bibliografica
            foreach ($emp_act_inv_edu as $value) {
                $key_prima = $value['insert'];
                if (!isset($array_result['emp_act_inv_edu_update'][$key_prima])) {//Si no existe el elemento lo agraga null
                    $array_result['emp_act_inv_edu_update'][$key_prima] = NULL;
                }
            }
        }

//      pr($array_result);
        return $array_result;
    }

    public function get_data_ajax_eliminar_investigacion() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $data = array();
                $tipo_msg = $this->config->item('alert_msg');
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['investigacion_docente'];

                $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
                $datos_post = $this->input->post(null, true);
//            pr($datos_post);
                $comprobante_cve_post = $datos_post['comprobante_cve'];
                $id_inv_docente = $this->seguridad->decrypt_base64($datos_post['index_inv']);
                $resul_delete_inv = $this->idm->delete_investigacion_docente($id_inv_docente); //Verifica si existe el ususario ya contiene datos de actividad
                if (!empty($resul_delete_inv)) {//Manda mensaje de que no se pudo borrar el registro
                    $array_datos_entidad['emp_act_inv_edu'] = $resul_delete_inv;
                    $array_operacion_id_entidades['emp_act_inv_edu'] = array('delete' => $id_inv_docente);

                    $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                    $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                    //Datos de bitacora el registro del usuario
                    registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);

                    $data['error'] = $string_values['succesfull_eliminar']; //mensaje Guardado correcto
                    $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                    $data['borrado_correcto'] = 1; //Tipo de mensaje de error
                } else {
                    $data['error'] = $string_values['error_no_elimino_reg_invest']; //Mensaje de que no pudo borrar registro
                    $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    $this->output->set_status_header('400');
                }
                echo json_encode($data);
            }
        } else {
            redirect(site_url());
        }
    }

    public function get_fecha_ultima_actualizacion() {
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['perfil'];
        $id_usuario = $this->obtener_id_usuario();

        /* setlocale(LC_ALL, 'es_ES');
          $upDate = $this->modPerfil->get_fecha_ultima_actualizacion($id_usuario)->fecha_bitacora;
          $datosPerfil['fecha_ult_act'] = $string_values['span_fecha_last_update'] . strftime("%d de %B de %G a las %H:%M:%S", strtotime($upDate));
         */

        $fecha_ultima_actualizacion['fecha_ult_act'] = $string_values['span_fecha_last_update'] . $this->modPerfil->get_fecha_ultima_actualizacion($id_usuario)->fecha_bitacora;
        $json = json_encode($fecha_ultima_actualizacion);

        echo $json;
        // pr($json);
    }

    /**
     * @author LEAS
     * @param type $name_comprobante //nombre del comprobante sin extención 
     * @return devuelve un mensaje de 
     */
    private function guardar_archivo($name_comprobante, $nom_propiedades = 'comprobantes') {
        $config_comprobante = $this->config->item('upload_config')[$nom_propiedades]; //Carga configuración para subir archivo comprobante
        $config_comprobante['file_name'] = $name_comprobante; //Asigna nombre del comprobante
        //$_FILE -> contiene contiene el archivo
        $this->load->library('upload', $config_comprobante); //Carga la configuración para subir el archivo
        if (!$this->upload->do_upload('file')) {//Nombre del componente file
            $data['error'] = $this->upload->display_errors();
//            pr('fin ------------>' . $data['error']);
        } else {
            $file_data = $this->upload->data();
            $data['file_path'] = './upload/' . $file_data['file_name'];
//            pr('fin ------------>' . $data['file_path']);
        }
        return $data;
    }

    ////////////////////////Inicio Factory de tipos de comisión
    private function emp_comision_fac($comision) {
        $com = new stdClass();
        switch ($comision['tipo_comision']) {
            case $this->config->item('tipo_comision')['DIRECCION_TESIS']['id']:
                $com = $this->direccion_tesis_vo($comision);
                break;
            case $this->config->item('tipo_comision')['COMITE_EDUCACION']['id']:
                $com = $this->comite_educacion_vo($comision);
                break;
            case $this->config->item('tipo_comision')['SINODAL_EXAMEN']['id']:
                $com = $this->sinodal_examen_vo($comision);
                break;
            case $this->config->item('tipo_comision')['COORDINADOR_TUTORES']['id']:
                $com = $this->coordinador_tutores_vo($comision);
                break;
            case $this->config->item('tipo_comision')['COORDINADOR_CURSO']['id']:
                $com = $this->coordinador_curso_vo($comision);
                break;
        }

        return $com;
    }

    private function direccion_tesis_vo($comision) {
        $com = new Direccion_tesis_dao;
        $com->EMPLEADO_CVE = (isset($comision['empleado']) && !empty($comision['empleado'])) ? $comision['empleado'] : NULL;
        $com->TIP_COMISION_CVE = (isset($comision['tipo_comision']) && !empty($comision['tipo_comision'])) ? $comision['tipo_comision'] : NULL;
        $com->COMPROBANTE_CVE = (isset($comision['idc']) && !empty($comision['idc'])) ? $this->seguridad->decrypt_base64($comision['idc']) : NULL;
        $com->EC_ANIO = (isset($comision['dt_anio']) && !empty($comision['dt_anio'])) ? $comision['dt_anio'] : NULL;
        $com->COM_AREA_CVE = (isset($comision['comision_area']) && !empty($comision['comision_area'])) ? $comision['comision_area'] : NULL;
        $com->NIV_ACADEMICO_CVE = (isset($comision['nivel_academico']) && !empty($comision['nivel_academico'])) ? $comision['nivel_academico'] : NULL;

        return $com;
    }

    private function comite_educacion_vo($comision) {
        $com = new Comite_educacion_dao;
        $com->EMPLEADO_CVE = (isset($comision['empleado']) && !empty($comision['empleado'])) ? $comision['empleado'] : NULL;
        $com->TIP_COMISION_CVE = (isset($comision['tipo_comision']) && !empty($comision['tipo_comision'])) ? $comision['tipo_comision'] : NULL;
        $com->COMPROBANTE_CVE = (isset($comision['idc']) && !empty($comision['idc'])) ? $this->seguridad->decrypt_base64($comision['idc']) : NULL;
        $com->EC_ANIO = (isset($comision['dt_anio']) && !empty($comision['dt_anio'])) ? $comision['dt_anio'] : NULL;
        $com->TIP_CURSO_CVE = (isset($comision['tipo_curso']) && !empty($comision['tipo_curso'])) ? $comision['tipo_curso'] : NULL;

        return $com;
    }

    private function sinodal_examen_vo($comision) {
        $com = new Sinodal_examen_dao;
        $com->EMPLEADO_CVE = (isset($comision['empleado']) && !empty($comision['empleado'])) ? $comision['empleado'] : NULL;
        $com->TIP_COMISION_CVE = (isset($comision['tipo_comision']) && !empty($comision['tipo_comision'])) ? $comision['tipo_comision'] : NULL;
        $com->COMPROBANTE_CVE = (isset($comision['idc']) && !empty($comision['idc'])) ? $this->seguridad->decrypt_base64($comision['idc']) : NULL;
        $com->EC_ANIO = (isset($comision['dt_anio']) && !empty($comision['dt_anio'])) ? $comision['dt_anio'] : NULL;
        $com->NIV_ACADEMICO_CVE = (isset($comision['nivel_academico']) && !empty($comision['nivel_academico'])) ? $comision['nivel_academico'] : NULL;

        return $com;
    }

    private function coordinador_tutores_vo($comision) {
        $com = new Coordinador_tutores_dao;
        $com->EMPLEADO_CVE = (isset($comision['empleado']) && !empty($comision['empleado'])) ? $comision['empleado'] : NULL;
        $com->TIP_COMISION_CVE = (isset($comision['tipo_comision']) && !empty($comision['tipo_comision'])) ? $comision['tipo_comision'] : NULL;
        $com->COMPROBANTE_CVE = (isset($comision['idc']) && !empty($comision['idc'])) ? $this->seguridad->decrypt_base64($comision['idc']) : NULL;
        $com->EC_ANIO = (isset($comision['dt_anio']) && !empty($comision['dt_anio'])) ? $comision['dt_anio'] : NULL;
        $com->EC_FCH_INICIO = (isset($comision['fecha_inicio_pick']) && !empty($comision['fecha_inicio_pick'])) ? date("Y-m-d", strtotime($comision['fecha_inicio_pick'])) : NULL;
        $com->EC_FCH_FIN = (isset($comision['fecha_fin_pick']) && !empty($comision['fecha_fin_pick'])) ? date("Y-m-d", strtotime($comision['fecha_fin_pick'])) : NULL;
        $com->EC_DURACION = (isset($comision['hora_dedicadas']) && !empty($comision['hora_dedicadas'])) ? $comision['hora_dedicadas'] : NULL;
        $com->TIP_CURSO_CVE = (isset($comision['tipo_curso']) && !empty($comision['tipo_curso'])) ? $comision['tipo_curso'] : NULL;
        $com->CURSO_CVE = (isset($comision['curso']) && !empty($comision['curso'])) ? $comision['curso'] : NULL;

        return $com;
    }

    private function coordinador_curso_vo($comision) {
        $com = new Coordinador_curso_dao;
        $com->EMPLEADO_CVE = (isset($comision['empleado']) && !empty($comision['empleado'])) ? $comision['empleado'] : NULL;
        $com->TIP_COMISION_CVE = (isset($comision['tipo_comision']) && !empty($comision['tipo_comision'])) ? $comision['tipo_comision'] : NULL;
        $com->COMPROBANTE_CVE = (isset($comision['idc']) && !empty($comision['idc'])) ? $this->seguridad->decrypt_base64($comision['idc']) : NULL;
        $com->EC_ANIO = (isset($comision['dt_anio']) && !empty($comision['dt_anio'])) ? $comision['dt_anio'] : NULL;
        $com->EC_FCH_INICIO = (isset($comision['fecha_inicio_pick']) && !empty($comision['fecha_inicio_pick'])) ? date("Y-m-d", strtotime($comision['fecha_inicio_pick'])) : NULL;
        $com->EC_FCH_FIN = (isset($comision['fecha_fin_pick']) && !empty($comision['fecha_fin_pick'])) ? date("Y-m-d", strtotime($comision['fecha_fin_pick'])) : NULL;
        $com->EC_DURACION = (isset($comision['hora_dedicadas']) && !empty($comision['hora_dedicadas'])) ? $comision['hora_dedicadas'] : NULL;
        $com->TIP_CURSO_CVE = (isset($comision['tipo_curso']) && !empty($comision['tipo_curso'])) ? $comision['tipo_curso'] : NULL;
        $com->CURSO_CVE = (isset($comision['curso']) && !empty($comision['curso'])) ? $comision['curso'] : NULL;

        return $com;
    }

    private function formacion_salud_vo($formacion) {
        $for = new Formacion_salud_dao;
        $for->EMPLEADO_CVE = (isset($formacion['empleado']) && !empty($formacion['empleado'])) ? $formacion['empleado'] : NULL;
        $for->COMPROBANTE_CVE = (isset($formacion['idc']) && !empty($formacion['idc'])) ? $this->seguridad->decrypt_base64($formacion['idc']) : NULL;
        $for->EFPCS_FCH_INICIO = (isset($formacion['fch_inicio']) && !empty($formacion['fch_inicio'])) ? date("Y-m-d", strtotime('1-' . $formacion['fch_inicio'])) : NULL;
        $for->EFPCS_FCH_FIN = (isset($formacion['fch_fin']) && !empty($formacion['fch_fin'])) ? date("Y-m-d", strtotime('1-' . $formacion['fch_fin'])) : NULL;
        $for->EFPCS_FOR_INICIAL = (isset($formacion['es_inicial']) && !empty($formacion['es_inicial'])) ? $formacion['es_inicial'] : NULL;
        $for->TIP_FORM_SALUD_CVE = (isset($formacion['tipo_formacion']) && !empty($formacion['tipo_formacion'])) ? $formacion['tipo_formacion'] : NULL;
        $for->CSUBTIP_FORM_SALUD_CVE = (isset($formacion['subtipo']) && !empty($formacion['subtipo'])) ? $formacion['subtipo'] : NULL;

        return $for;
    }

    ////////////////////////Fin Factory de tipos de comisión
    ////////////////////////Inicio formacion docente
    private function formacion_docente_vo($formacion) {
        $for = new Formacion_docente_dao;
        $for->EMPLEADO_CVE = (isset($formacion['empleado']) && !empty($formacion['empleado'])) ? $formacion['empleado'] : NULL;
        $for->COMPROBANTE_CVE = (isset($formacion['idc']) && !empty($formacion['idc'])) ? $this->seguridad->decrypt_base64($formacion['idc']) : NULL;
        $for->EFP_DURACION = (isset($formacion['hora_dedicadas']) && !empty($formacion['hora_dedicadas'])) ? $formacion['hora_dedicadas'] : NULL;
        $for->MODALIDAD_CVE = (isset($formacion['modalidad']) && !empty($formacion['modalidad'])) ? $formacion['modalidad'] : NULL;
        $for->INS_AVALA_CVE = (isset($formacion['institucion']) && !empty($formacion['institucion'])) ? $formacion['institucion'] : NULL;
        $for->EFP_FCH_INICIO = (isset($formacion['fecha_inicio_pick']) && !empty($formacion['fecha_inicio_pick'])) ? date("Y-m-d", strtotime($formacion['fecha_inicio_pick'])) : NULL;
        $for->EFP_FCH_FIN = (isset($formacion['fecha_fin_pick']) && !empty($formacion['fecha_fin_pick'])) ? date("Y-m-d", strtotime($formacion['fecha_fin_pick'])) : NULL;
        $for->CURSO_CVE = (isset($formacion['tipo_curso']) && !empty($formacion['tipo_curso'])) ? $formacion['tipo_curso'] : NULL;
        $for->TIP_FOR_PROF_CVE = (isset($formacion['tipo_formacion']) && !empty($formacion['tipo_formacion'])) ? $formacion['tipo_formacion'] : NULL;
        $for->SUB_FOR_PRO_CVE = (isset($formacion['subtipo']) && !empty($formacion['subtipo'])) ? $formacion['subtipo'] : NULL;
        $for->EFO_ANIO_CURSO = (isset($formacion['fd_anio']) && !empty($formacion['fd_anio'])) ? $formacion['fd_anio'] : NULL;
        $for->EFP_NOMBRE_CURSO = (isset($formacion['nombre_curso']) && !empty($formacion['nombre_curso'])) ? $formacion['nombre_curso'] : NULL;

        return $for;
    }

    private function formacion_docente_tematica_vo($tematicas, $identificador) {
        $formacion = array();
        foreach ($tematicas as $key_t => $tematica) {
            $tem = new Formacion_docente_tematica_dao;
            $tem->TEMATICA_CVE = $tematica;
            $tem->EMP_FORMACION_PROFESIONAL_CVE = $identificador;
            $formacion[] = $tem;
        }
        return $formacion;
    }

    ////////////////////////Fin formacion docente
    /*     * *********************************** Material educativo **************************** */

    public function seccion_material_educativo() {
        if ($this->input->is_ajax_request()) {
            $data = array();
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['material_educativo'];
            $data['string_values'] = $string_values;
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
            if (!empty($empleado)) {//Si existe un empleado, obtenemos datos
                $lista_material_educativo = $this->mem->get_lista_material_educativo($empleado);
                $data['lista_material_educativo'] = $lista_material_educativo;
                $this->load->view('validador_censo/material_educativo/elaboracion_material_edu_tpl', $data, FALSE); //Valores que muestrán la lista
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function get_form_general_material_educativo() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['material_educativo']; //Carga textos a utilizar 
            $datos_mat_edu['string_values'] = $string_values; //Crea la variable
            $condiciones_ = array(enum_ecg::ctipo_material => array('TIP_MAT_TIPO =' => NULL));
            $entidades_ = array(enum_ecg::ctipo_material);
            $datos_mat_edu = carga_catalogos_generales($entidades_, $datos_mat_edu, $condiciones_);
            //Todo lo de comprobante *******************************************
            $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            $datos_mat_edu['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
            //**** fi de comprobante *******************************************
            $datos_pie = array();
            $data = array(
                'titulo_modal' => $string_values['title_material_eduacativo'],
                'cuerpo_modal' => $this->load->view('validador_censo/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE),
                'pie_modal' => $this->load->view('validador_censo/material_educativo/material_edu_pie', $datos_pie, true)
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function get_cargar_tipo_material() {
        if ($this->input->is_ajax_request()) {
//            pr($this->input->post(null, TRUE));
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['material_educativo']; //Carga textos a utilizar 
            $datos_mat_edu['string_values'] = $string_values; //Crea la variable

            if ($this->input->post()) {//Después de cargar el formulario
                $datos_post = $this->input->post(null, true);
//                pr($datos_post);
                if (!empty($datos_post['ctipo_material'])) {
                    $index_tipo_mat = $datos_post['ctipo_material'];
                    $datos_tipo_material ['string_values'] = $string_values;
                    $datos_tipo_material ['cantidad_hojas'] = $this->config->item('opciones_tipo_material')['cantidad_hojas'];
                    $datos_tipo_material ['numero_horas'] = $this->config->item('opciones_tipo_material')['numero_horas'];
                    $datos_mat_edu['formulario_complemento'] = $this->load->view('validador_censo/material_educativo/formulario_mat_edu_' . $index_tipo_mat, $datos_tipo_material, TRUE);
                }
            }
            $condiciones_ = array(enum_ecg::ctipo_material => array('TIP_MAT_TIPO =' => NULL));
            $entidades_ = array(enum_ecg::ctipo_material);
            $datos_mat_edu = carga_catalogos_generales($entidades_, $datos_mat_edu, $condiciones_);
            //Todo lo de comprobante *******************************************
            $data['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            if (isset($datos_post['idc'])) {//si existe el id del comprobante
                $data['idc'] = $datos_post['idc'];
//                $id_desencript = $this->seguridad->decrypt_base64($datos_post['idc']);
//                pr($id_desencript);
            }
            $datos_mat_edu['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
            //**** fi de comprobante *******************************************
            echo $this->load->view('validador_censo/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    private function analiza_validacion_material_educativo($array_validacion, $array_post, $is_actualizacion = FALSE, $file = null) {
//        pr($array_post);
//        pr($array_validacion);
        $array_result = array();
        $insert_emp_materia_educativo = $this->config->item('emp_materia_educativo');
        $insert_ctipo_material = $this->config->item('ctipo_material');
        if ($is_actualizacion) {//Pone en nulo todos los campos de las entidades "ctipo_material" y "emp_materia_educativo" para actualizar
            foreach ($insert_ctipo_material as $value_t_m) {
//                pr($value_t_m['insert']);
                $array_result['insert_ctipo_material'][$value_t_m['insert']] = 'NULL'; //Limpia todos los registros`, ya que los campos que contenian información, previamente y en la actualización  ya no, estos no guarden información que no debería
            }
            foreach ($insert_ctipo_material as $value_t_m) {
//                pr($value_t_m['insert']);
                $array_result['insert_emp_materia_educativo'][$value_t_m['insert']] = 'NULL'; //Limpia todos los registros`, ya que los campos que contenian información, previamente y en la actualización  ya no, estos no guarden información que no debería
            }
        }
//        pr($insert_emp_materia_educativo);
//        pr($array_post);
        foreach ($array_post as $key => $value) {
            switch ($key) {
                case 'numero_horas'://Cambia el valor a texto del array
                    if (!empty($value)) {
                        $value = $this->config->item('opciones_tipo_material')['numero_horas'][$value];
                    }
                    break;
                case 'cantidad_hojas'://Cambia el valor a texto del array
                    if (!empty($value)) {
                        $value = $this->config->item('opciones_tipo_material')['cantidad_hojas'][$value];
                    }
                    break;
            }
            if (array_key_exists($key, $array_validacion)) {//Verifica existencia de la llave
                $array_result['validacion'][] = $array_validacion[$key];
            }
            if (array_key_exists($key, $insert_emp_materia_educativo)) {//Verifica existencia de la llave
                $array_result['insert_emp_mat_educativo'][$insert_emp_materia_educativo[$key]['insert']] = $value;
            }
            if (array_key_exists($key, $insert_ctipo_material)) {//Verifica existencia de la llave
                if ($is_actualizacion AND $key === 'ctipo_material') {
                    if (intval($value) === 2 OR intval($value) === 5) {//El campo "TIP_MAT_TIPO" que es el padré lo ponemos en null, ya que no debe ya que la opcion 2 ó 5 no contiene hijos
                        $array_result['insert_ctipo_material'][$insert_ctipo_material[$key]['insert']] = 'NULL';
                    } else {
                        $array_result['insert_ctipo_material'][$insert_ctipo_material[$key]['insert']] = $value;
                    }
                } else {
                    $array_result['insert_ctipo_material'][$insert_ctipo_material[$key]['insert']] = $value;
                }
            }
        }

        return $array_result;
    }

    public function add_tipo_material_educativo() {
        if ($this->input->is_ajax_request()) {
//            pr($this->input->post(null, true));
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['material_educativo']; //Carga textos a utilizar 
            $datos_mat_edu['string_values'] = $string_values; //Crea la variable
            $carga_vista_extra = FALSE;
            if ($this->input->post()) {//Después de cargar el formulario
                $datos_post = $this->input->post(null, true);
                if (!empty($datos_post['ctipo_material'])) {//Condición  para mostrar vista extra
                    $carga_vista_extra = TRUE;
                }
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_material_educativo'); //Carga array de validaciones 
                $result_id_empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
                $datos_post['empleado_cve'] = $result_id_empleado; //Asigna id del empleado al análisis
                $validations = $this->analiza_validacion_material_educativo($validations, $datos_post, $_FILES);
                $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
                //Parametros iniciales que deben persistir en el botón de actualización
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) {//Si pasa todas las validaciones, actualizar
                    $insert_ctipo_material = $validations['insert_ctipo_material'];
                    $insert_emp_materia_educativo = $validations['insert_emp_mat_educativo'];
                    $guardado_correcto = FALSE;
                    $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
                    $id_desencript_comprobante = $this->seguridad->decrypt_base64($datos_post['idc']); //Desencripta la clave del comprobante 
                    $insert_emp_materia_educativo['COMPROBANTE_CVE'] = $id_desencript_comprobante; //Asocia cve del comprobante
                    if (intval($insert_emp_materia_educativo['TIP_MATERIAL_CVE']) === 0) {//Guarda primero el tipo de ctipo_material
                        $result = $this->mem->insert_material_and_tipo_mat($insert_emp_materia_educativo, $insert_ctipo_material); //Inserta los datos de las dos tablas
                        if (!empty($result)) {
                            //LLena los arrays para la bitacora
                            $array_datos_entidad['emp_materia_educativo'] = $result['emp_materia_educativo']; //Asigna para bitacora las los datos insertados
                            $array_operacion_id_entidades['emp_materia_educativo'] = array('insert' => $result['emp_materia_educativo']['MATERIA_EDUCATIVO_CVE']); //Asigna operación ejecutada a la entidad
                            $array_datos_entidad['ctipo_material'] = $result['ctipo_material']; //Asigna para bitacora las los datos insertados
                            $array_operacion_id_entidades['ctipo_material'] = array('insert' => $result['ctipo_material']['TIP_MATERIAL_CVE']); //Asigna operación ejecutada a la entidad
                            $guardado_correcto = TRUE;
                        }
                    } else {//Guarda directamente en la entidad "emp_materia_educativo", y, no guarda nada en la entidad "ctipo_material"
                        $id_emp_material_edu = $this->mem->insert_emp_materia_educativo($insert_emp_materia_educativo); //Inserta los datos de las dos tablas
                        if ($id_emp_material_edu > 0) {
                            $insert_emp_materia_educativo['MATERIA_EDUCATIVO_CVE'] = $id_emp_material_edu;
                            $array_operacion_id_entidades['emp_materia_educativo'] = array('insert' => $id_emp_material_edu); //Asigna operación ejecutada a la entidad
                            $array_datos_entidad['emp_materia_educativo'] = $insert_emp_materia_educativo; //Asigna para bitacora las los datos insertados
                            $guardado_correcto = TRUE;
                        }
                    }
                    $tipo_msg = $this->config->item('alert_msg');
                    if ($guardado_correcto) {//Si el guardado fue satisfactorio, guarda bitacora
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['phl_registro_correcto']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
//                        pr('No se pudo guardar');
                    }
                    echo json_encode($res_j);
                    exit();
                }
            }
            if ($carga_vista_extra) {
                $index_tipo_mat = $datos_post['ctipo_material'];
                $datos_tipo_material ['string_values'] = $string_values;
                $datos_tipo_material ['cantidad_hojas'] = $this->config->item('opciones_tipo_material')['cantidad_hojas'];
                $datos_tipo_material ['numero_horas'] = $this->config->item('opciones_tipo_material')['numero_horas'];
                $datos_mat_edu['formulario_complemento'] = $this->load->view('validador_censo/material_educativo/formulario_mat_edu_' . $index_tipo_mat, $datos_tipo_material, TRUE);
            }
            $condiciones_ = array(enum_ecg::ctipo_material => array('TIP_MAT_TIPO =' => NULL));
            $entidades_ = array(enum_ecg::ctipo_material);
            $datos_mat_edu = carga_catalogos_generales($entidades_, $datos_mat_edu, $condiciones_);

            //Todo lo de comprobante *******************************************

            $data['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            if (isset($datos_post['idc'])) {//si existe el id del comprobante
                $data['idc'] = $datos_post['idc'];
            }
            $datos_mat_edu['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
            //**** fi de comprobante *******************************************

            echo $this->load->view('validador_censo/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /**
     * Función que permite eliminar la dirección de tesis
     * @method: void eliminar_convocatoria()
     * @param: $Identificador   string en base64    Identificador de la dirección de tesis codificado en base64
     * @author: Jesús Z. Díaz P.
     */
    public function eliminar_material_educativo() {
        if ($this->input->is_ajax_request()) {
//        [comprobante] => MjE4
//        [tipo_material_cve] => 23
//        [emp_material_educativo_cve] => 21
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $datos_post = $this->input->post(null, true);
                $tipo_msg = $this->config->item('alert_msg');
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['material_educativo'];
                $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable

                $delete_satisfactorio = FALSE;
                $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
                $emp_material_educativo_cve = $this->seguridad->decrypt_base64($datos_post['emp_material_educativo_cve']); //Identificador de la material educativo del empleado
                $registro_emp_mat_edu = $this->cg->get_catalogo_general('emp_materia_educativo', array('MATERIA_EDUCATIVO_CVE' => $emp_material_educativo_cve))[0];
                $tipo_material_cve = intval($this->seguridad->decrypt_base64($datos_post['tipo_material_cve'])); //Identificador de la $tipo_material
                $registro_tipo_meterial = $this->cg->get_catalogo_general('ctipo_material', array('TIP_MATERIAL_CVE' => $tipo_material_cve))[0];

                $delete_emp_mat_edu = $this->cg->delete_registro_general('emp_materia_educativo', array('MATERIA_EDUCATIVO_CVE' => $emp_material_educativo_cve));
                if ($delete_emp_mat_edu === 1) {//Guarda en bitacora
                    $array_datos_entidad['emp_materia_educativo'] = $registro_emp_mat_edu;
                    $array_operacion_id_entidades['emp_materia_educativo'] = array('delete' => $registro_emp_mat_edu['MATERIA_EDUCATIVO_CVE']); //Asigna operación ejecutada a la entidad
                    $delete_satisfactorio = TRUE;
                } else {
                    $delete_satisfactorio = FALSE;
                }

                if (!empty($datos_post['comprobante'])) {
                    $comprobante = $this->seguridad->decrypt_base64($datos_post['comprobante']); //Identificador de la comprobante 
                    $registro_comprobante = $this->cg->get_catalogo_general('comprobante', array('COMPROBANTE_CVE' => $comprobante))[0];
                    $delete_comprobante = $this->cg->delete_registro_general('comprobante', array('COMPROBANTE_CVE' => $comprobante));

                    if ($delete_comprobante === 1) {//Guarda en bitacora
                        $array_datos_entidad['comprobante'] = $registro_comprobante;
                        $array_operacion_id_entidades['comprobante'] = array('delete' => $registro_comprobante['COMPROBANTE_CVE']); //Asigna operación ejecutada a la entidad
                        //Eliminar archivo
                        $delete_satisfactorio = TRUE;
                    } else {
                        $delete_satisfactorio = FALSE;
                    }
                }

                if ($tipo_material_cve > 6) { //Los registros con id menor que 6, deben persistir, son de cajón por lo que no deben eliminarse
                    $delete_tipo_meterial = $this->cg->delete_registro_general('ctipo_material', array('TIP_MATERIAL_CVE' => $tipo_material_cve));
                    if ($delete_tipo_meterial === 1) {//Guarda en bitacora
                        $array_datos_entidad['ctipo_material'] = $registro_tipo_meterial;
                        $array_operacion_id_entidades['ctipo_material'] = array('delete' => $registro_tipo_meterial['TIP_MATERIAL_CVE']); //Asigna operación ejecutada a la entidad
                        $delete_satisfactorio = TRUE;
                    } else {
                        $delete_satisfactorio = FALSE;
                    }
                }


                $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                //Datos de bitacora el registro del usuario
                registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);

                if ($delete_satisfactorio) {//Manda mensaje de que no se pudo borrar el registro
                    $data['error'] = $string_values['succesfull_eliminar']; //Mensaje de que no encontro empleado
                    $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                    $data['borrado_correcto'] = 1; //Tipo de mensaje de error
                } else {
                    $data['error'] = $string_values['error_eliminar']; //Mensaje de que no encontro empleado
                    $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    $this->output->set_status_header('400');
                }
                echo json_encode($data);
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    private function filtrar_datos_material_educatiovo($array_datos) {
//        $insert_emp_materia_educativo = $this->config->item('emp_materia_educativo');
//        $insert_ctipo_material = $this->config->item('ctipo_material');
//        $value = $this->config->item('opciones_tipo_material')['numero_horas'][$value];
        $padre_tp_material_padre = $array_datos['padre_tp_material'];
        $array_datos_res = array();
        if (!empty($padre_tp_material_padre)) {
            $padre_tp_material_padre = intval($padre_tp_material_padre);
            $array_opciones = $this->config->item('opciones_tipo_material')[$padre_tp_material_padre];
            foreach ($array_opciones as $key => $val) {//Asigna los valores a los campos de texto según el formulario secundario
                if ($key === 'opt_tipo_material') {//Para seleccionar opción
                    $array_option = $this->config->item('opciones_tipo_material')[$val];
                    foreach ($array_option as $key_option => $value_option) {//Busca la llave del texto
                        if ($array_datos['opt_tipo_material'] === $value_option) {
                            $array_datos_res[$key] = $key_option;
                            break;
                        }
                    }
                } else {//Para asignar texto
                    $array_datos_res[$key] = $array_datos[$key];
                }
            }
            $array_datos_res['material_educativo_cve'] = $padre_tp_material_padre; //Agrega el id del padré
        } else {
            $array_datos_res['material_educativo_cve'] = $array_datos['tipo_material_cve']; //Agrega el id almacenado en "tipo_material_cve"
        }
        $array_tmp_campos_entidad = $this->config->item('ctipo_material'); //Obtiene los campos de la entidad "ctipo_material"
        foreach ($array_datos as $key => $value) {
            if (array_key_exists($key, $array_tmp_campos_entidad)) {//Verifica existencia de la llave en la entidad "emp_materia_educativo" para enviar los datos
                $array_datos_res[$key] = $array_datos[$key];
            }
        }
        $array_tmp_campos_entidad = $this->config->item('emp_materia_educativo'); //Obtiene los campos de la entidad "emp_materia_educativo"
        foreach ($array_datos as $key => $value) {
            if (array_key_exists($key, $array_tmp_campos_entidad)) {//Verifica existencia de la llave en la entidad "emp_materia_educativo" para enviar los datos
                $array_datos_res[$key] = $array_datos[$key];
            }
        }
        $array_tmp_campos_entidad = $this->config->item('comprobante'); //Obtiene los campos de la entidad "emp_materia_educativo"
        foreach ($array_datos as $key => $value) {
            if (array_key_exists($key, $array_tmp_campos_entidad)) {//Verifica existencia de la llave en la entidad "emp_materia_educativo" para enviar los datos
                $array_datos_res[$key] = $array_datos[$key];
            }
        }
        return $array_datos_res;
    }

    public function carga_datos_editar_material_educativo() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $datos_post = $this->input->post(null, true);
//                pr($datos_post);
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['material_educativo']; //Carga textos a utilizar 
                $datos_mat_edu['string_values'] = $string_values; //Crea la variable
                $condiciones_ = array(enum_ecg::ctipo_material => array('TIP_MAT_TIPO =' => NULL));
                $entidades_ = array(enum_ecg::ctipo_material);
                $datos_mat_edu = carga_catalogos_generales($entidades_, $datos_mat_edu, $condiciones_);
                $material_edu_cve = intval($this->seguridad->decrypt_base64($datos_post['material_edu_cve'])); //Identificador de materia_educativo
                $datos_reg_mat_edu = $this->mem->get_datos_material_educativo($material_edu_cve);

                $datos_reg_mat_edu_validados = $this->filtrar_datos_material_educatiovo($datos_reg_mat_edu); //Modifica los nombres e las llaves para ajustar a los formilarios secundarios
//                pr($datos_reg_mat_edu_validados);

                $datos_mat_edu['info_material_educativo'] = $datos_reg_mat_edu_validados;

//                pr($datos_mat_edu['info_material_educativo']);
                //Todo lo de comprobante *******************************************
                $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
                $data_comprobante['dir_tes'] = array('TIPO_COMPROBANTE_CVE' => $datos_reg_mat_edu_validados['ctipo_comprobante'], 'COM_NOMBRE' => $datos_reg_mat_edu_validados['text_comprobante'], 'COMPROBANTE_CVE' => $datos_reg_mat_edu_validados['comprobante_cve']);
                if (!empty($datos_reg_mat_edu_validados['comprobante'])) {//Si existe comprobante, manda el identificador
                    $data_comprobante['idc'] = $this->seguridad->encrypt_base64($datos_reg_mat_edu_validados['comprobante_cve']);
                }
                $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                $datos_mat_edu['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
                //**** fi de comprobante *******************************************
                //Carga el formulario secundario segun la opcion de tipo de material educativo
                $datos_form_secundario['datos'] = $datos_reg_mat_edu_validados;
                $datos_form_secundario['string_values'] = $string_values;
                $datos_form_secundario ['cantidad_hojas'] = $this->config->item('opciones_tipo_material')['cantidad_hojas'];
                $datos_form_secundario ['numero_horas'] = $this->config->item('opciones_tipo_material')['numero_horas'];
                $datos_mat_edu['formulario_complemento'] = $this->load->view('validador_censo/material_educativo/formulario_mat_edu_' . $datos_reg_mat_edu_validados['material_educativo_cve'], $datos_form_secundario, TRUE);
                //Carga datos de pie de página
                $datos_pie = array();
                $datos_pie['cve_mat_edu'] = $datos_post['material_edu_cve']; //Cve del material encriptado base64
                $datos_pie['cve_tp_mat_edu'] = $datos_post['ti_material_cve']; //Cve del material encriptado base64
                $datos_pie['comprobantecve'] = $datos_post['comprobantecve']; //Cve del material encriptado base64

                $data = array(
                    'titulo_modal' => $string_values['title_material_eduacativo'],
                    'cuerpo_modal' => $this->load->view('validador_censo/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE),
                    'pie_modal' => $this->load->view('validador_censo/material_educativo/material_edu_pie', $datos_pie, true)
                );
                echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
            } else {
                
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function actualizar_datos_editar_material_educativo() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $datos_post = $this->input->post(null, true);
//                pr($datos_post);
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['material_educativo']; //Carga textos a utilizar 
                $datos_mat_edu['string_values'] = $string_values; //Crea la variable
                $material_edu_cve = intval($this->seguridad->decrypt_base64($datos_post['material_edu_cve'])); //Identificador de materia_educativo
                $tipo_material_cve = intval($this->seguridad->decrypt_base64($datos_post['ti_material_cve'])); //Identificador de materia_educativo
                $datos_reg_mat_edu = $this->mem->get_datos_material_educativo($material_edu_cve);
                $carga_vista_extra = FALSE;
                if (!empty($datos_post['ctipo_material'])) {//Condición  para mostrar vista extra
                    $carga_vista_extra = TRUE;
                }

                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_material_educativo'); //Carga array de validaciones
                $result_id_empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
                $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variabl
                $datos_post['empleado_cve'] = $result_id_empleado; //Asigna id del empleado al análisis
                $validations = $this->analiza_validacion_material_educativo($validations, $datos_post, TRUE);
                $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
                //Parametros iniciales que deben persistir en el botón de actualización
//                pr($validations['insert_emp_mat_educativo']);
//                pr($validations['insert_ctipo_material']);
                $this->form_validation->set_rules($validations['validacion']); //Carga las validaciones 
                if ($this->form_validation->run()) {//Si pasa todas las validaciones, actualizar
                    $actualizado_correcto = FALSE;
                    $insert_ctipo_material = $validations['insert_ctipo_material'];
                    $insert_emp_materia_educativo = $validations['insert_emp_mat_educativo'];
                    //Preparando para actualizar los registros
                    $id_tip_m_cve = intval($insert_emp_materia_educativo['TIP_MATERIAL_CVE']);

                    $condicion_actual_tipo_mat_cve = ($id_tip_m_cve === 0); //Condición de cambio actual en formulario
                    $condicion_anterior_tipo_mat_cve = (($tipo_material_cve !== 2 AND $tipo_material_cve !== 5)); //Identificador que esta guardado en la base de datos actualmente, viene de post

                    if ($condicion_anterior_tipo_mat_cve AND $condicion_actual_tipo_mat_cve) {//Actualiza las dos tablas, es decir, "emp_mat_educativo" y "ctipo_material" 
                        //Actualiza la entidad de tipo de material educativo
                        unset($insert_ctipo_material['TIP_MATERIAL_CVE']);
                        $result_update_tme = $this->mem->update_tipo_material_educativo($tipo_material_cve, $insert_ctipo_material); //Inserta los datos de las dos tablas
                        if (!empty($result_update_tme)) {//La actualizacioón se efectuo correctamente 
                            //LLena los arrays para la bitacora
                            $array_datos_entidad['ctipo_material'] = $result_update_tme; //Asigna para bitacora las los datos insertados
                            $array_operacion_id_entidades['ctipo_material'] = array('update' => $tipo_material_cve); //Asigna operación ejecutada a la entidad
                            $insert_emp_materia_educativo['TIP_MATERIAL_CVE'] = $tipo_material_cve;
                            $result = $this->mem->update_material_educativo($material_edu_cve, $insert_emp_materia_educativo); //Inserta los datos de las dos tablas
                            if (!empty($result)) {//La actualizacioón se efectuo correctamente 
                                //LLena los arrays para la bitacora
                                $array_datos_entidad['emp_materia_educativo'] = $result; //Asigna para bitacora las los datos insertados
                                $array_operacion_id_entidades['emp_materia_educativo'] = array('update' => $material_edu_cve); //Asigna operación ejecutada a la entidad
                                $actualizado_correcto = TRUE;
                            }
                        }
                    } else if ($condicion_anterior_tipo_mat_cve AND ! $condicion_actual_tipo_mat_cve) {//Actualiza la entidad "emp_mat_educativo" y  elimina  la entidad "ctipo_material"
                        //Actualoizá la entidad "emp_mat_educativo" 
                        $result = $this->mem->update_material_educativo($material_edu_cve, $insert_emp_materia_educativo); //Inserta los datos de las dos tablas
                        if (!empty($result)) {//La actualizacioón se efectuo correctamente 
                            $delete_tipo_meterial = $this->mem->delete_tipo_material_educativo($tipo_material_cve);
                            if (!empty($delete_tipo_meterial)) {//Guarda en bitacora
                                $array_datos_entidad['ctipo_material'] = $delete_tipo_meterial;
                                $array_operacion_id_entidades['ctipo_material'] = array('delete' => $delete_tipo_meterial['TIP_MATERIAL_CVE']); //Asigna operación ejecutada a la entidad
                                //LLena los arrays para la bitacora de la entidad  "emp_materia_educativo"
                                $array_datos_entidad['emp_materia_educativo'] = $result; //Asigna para bitacora las los datos insertados
                                $array_operacion_id_entidades['emp_materia_educativo'] = array('update' => $material_edu_cve); //Asigna operación ejecutada a la entidad
                                $actualizado_correcto = TRUE;
                            }
                        }
                    } else if (!$condicion_anterior_tipo_mat_cve AND $condicion_actual_tipo_mat_cve) {//Crea un nuevo registro en la entidad "ctipo_material" actualiza la entidad  "emp_mat_educativo" 
                        $result_insert_ctipo_mat_edu = $this->mem->insert_ctipo_material($insert_ctipo_material); //Inserta los datos de las dos tablas
                        if ($result_insert_ctipo_mat_edu > 0) {//El registro de tipo material docente se actualizo correctamente
                            $insert_emp_materia_educativo['TIP_MATERIAL_CVE'] = $result_insert_ctipo_mat_edu; //asicia el index de la entidad "ctipo_material" 
                            $result = $this->mem->update_material_educativo($material_edu_cve, $insert_emp_materia_educativo); //Inserta los datos de las dos tablas
                            if (!empty($result)) {//La actualizacioón se efectuo correctamente 
                                //LLena los arrays para la bitacora de la entidad "emp_materia_educativo"
                                $array_datos_entidad['emp_materia_educativo'] = $result; //Asigna para bitacora las los datos insertados
                                $array_operacion_id_entidades['emp_materia_educativo'] = array('update' => $material_edu_cve); //Asigna operación ejecutada a la entidad
                                //LLena los arrays para la bitacora de tipo de la entidad "ctipo_material" 
                                $insert_ctipo_material['TIP_MATERIAL_CVE'] = $result_insert_ctipo_mat_edu;
                                $array_datos_entidad['ctipo_material'] = $insert_ctipo_material; //Asigna para bitacora las los datos insertados
                                $array_operacion_id_entidades['ctipo_material'] = array('insert' => $result_insert_ctipo_mat_edu); //Asigna operación ejecutada a la entidad
                            }
                            $actualizado_correcto = TRUE;
                        }
                    } else {//Las dos condiciones son falsas (los datos guardados en la base y los seleccionados actualmente, contienen un identificador sin hijos (2 ó 5))
                        //Actualoizá la entidad "emp_mat_educativo" unicamente
                        $result = $this->mem->update_material_educativo($material_edu_cve, $insert_emp_materia_educativo); //Inserta los datos de las dos tablas
                        if (!empty($result)) {//La actualizacioón se efectuo correctamente 
                            //LLena los arrays para la bitacora
                            $array_datos_entidad['emp_materia_educativo'] = $result; //Asigna para bitacora las los datos insertados
                            $array_operacion_id_entidades['emp_materia_educativo'] = array('update' => $material_edu_cve); //Asigna operación ejecutada a la entidad
                            $actualizado_correcto = TRUE;
                        }
                    }

                    $tipo_msg = $this->config->item('alert_msg');
                    if ($actualizado_correcto) {//Si el guardado fue satisfactorio, guarda bitacora
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['phl_registro_actualizado_correcto']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
                    }
                    echo json_encode($res_j);
                    exit();
                }


                //Carga el formulario secundario segun la opcion de tipo de material educativo
                if ($carga_vista_extra) {
                    $index_tipo_mat = $datos_post['ctipo_material'];
                    $datos_tipo_material ['string_values'] = $string_values;
                    $datos_tipo_material ['cantidad_hojas'] = $this->config->item('opciones_tipo_material')['cantidad_hojas'];
                    $datos_tipo_material ['numero_horas'] = $this->config->item('opciones_tipo_material')['numero_horas'];
                    $datos_mat_edu['formulario_complemento'] = $this->load->view('validador_censo/material_educativo/formulario_mat_edu_' . $index_tipo_mat, $datos_tipo_material, TRUE);
                }

                $condiciones_ = array(enum_ecg::ctipo_material => array('TIP_MAT_TIPO =' => NULL));
                $entidades_ = array(enum_ecg::ctipo_material);
                $datos_mat_edu = carga_catalogos_generales($entidades_, $datos_mat_edu, $condiciones_);

                //Todo lo de comprobante *******************************************
                $data['string_values'] = $this->lang->line('interface')['general'];
                $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                $data['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                if (isset($datos_post['idc'])) {//si existe el id del comprobante
                    $data['idc'] = $datos_post['idc'];
                }
                $datos_mat_edu['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
                //**** fi de comprobante *******************************************
                echo $this->load->view('validador_censo/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE);
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /*     * *********************************** Becas_ **************************** */

    public function seccion_becas_comisiones() {
        if ($this->input->is_ajax_request()) {
            $data = array();
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['becas_comisiones'];
            $data['string_values'] = $string_values;
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
            if (!empty($empleado)) {//Si existe un empleado, obtenemos datos
                $lista_becas = $this->bcl->get_lista_becas($empleado);
                $lista_comisiones = $this->bcl->get_lista_comisiones($empleado);
                $data_becas['lista_becas'] = $lista_becas;
                $data_comision['lista_comisiones'] = $lista_comisiones;
                $data_becas['string_values'] = $string_values;
                $data_comision['string_values'] = $string_values;
                $data['cuerpo_becas'] = $this->load->view('validador_censo/becas_comisiones/becas_cuerpo', $data_becas, TRUE); //Valores que muestrán la lista
                $data['cuerpo_comisiones'] = $this->load->view('validador_censo/becas_comisiones/comisiones_cuerpo', $data_comision, TRUE); //Valores que muestrán la lista
                $this->load->view('validador_censo/becas_comisiones/becas_comisiones_tpl', $data, FALSE); //Valores que muestrán la lista
                //Error, No existe el empleado
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function get_form_becas() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
            $data_becas['string_values'] = $string_values; //Crea la variable
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cclase_beca, enum_ecg::cbeca_interrumpida, enum_ecg::cmotivo_becado);
            $data_becas = carga_catalogos_generales($entidades_, $data_becas);
            $datos_pie = array();
            //Todo lo de comprobante *******************************************
            $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            $data_becas['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
            //**** fi de comprobante *******************************************

            $data = array(
                'titulo_modal' => $string_values['title_becas'],
                'cuerpo_modal' => $this->load->view('validador_censo/becas_comisiones/formulario_becas', $data_becas, TRUE),
                'pie_modal' => $this->load->view('validador_censo/becas_comisiones/becas_pie', $datos_pie, true)
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function get_form_comisiones() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
            $data_comisiones['string_values'] = $string_values; //Crea la variable
            $condiciones_ = array(enum_ecg::ctipo_comision => array('IS_COMISION_ACADEMICA = ' => 0)); //Sólo comisiones que no son academicas, es decir, puras comisiones laborales
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ctipo_comision);
            $data_comisiones = carga_catalogos_generales($entidades_, $data_comisiones, $condiciones_);
            $datos_pie = array();
            //Todo lo de comprobante *******************************************
            $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            $data_comisiones['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
            //**** fi de comprobante *******************************************

            $data = array(
                'titulo_modal' => $string_values['title_comisiones'],
                'cuerpo_modal' => $this->load->view('validador_censo/becas_comisiones/formulario_comisiones', $data_comisiones, TRUE),
                'pie_modal' => $this->load->view('validador_censo/becas_comisiones/comisiones_pie', $datos_pie, true)
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    private function analiza_validacion_becas_comisiones_laborales($array_validacion, $array_post, $name_entidad, $file = null) {
//        pr($array_post);
//        pr($array_validacion);
        $array_result = array();
        //Carga la entidad emp_beca o, emp_comision según sea el caso
        $insert_emp_entidad = $this->config->item($name_entidad);
//        pr($array_post);
        foreach ($array_post as $key => $value) {
            if (array_key_exists($key, $array_validacion)) {//Verifica existencia de la llave
                $array_result['validacion'][] = $array_validacion[$key];
            }
            if (array_key_exists($key, $insert_emp_entidad)) {//Verifica existencia de la llave
                //Nombres insert_emp_beca o, insert_emp_comision
                $array_result['insert_' . $name_entidad][$insert_emp_entidad[$key]['insert']] = $value;
            }
        }

        return $array_result;
    }

    public function get_add_beca() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $tipo_msg = $this->config->item('alert_msg');
            $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
            $data_becas = array();
            $data_becas['string_values'] = $string_values;
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable

            if ($this->input->post()) {//Después de cargar el formulario
                $datos_post = $this->input->post(null, true);
//                pr($datos_post);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_beca'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_becas_comisiones_laborales($validations, $datos_post, 'emp_beca'); //Obtener validaciones de archivo
//                pr($validations);
                $this->form_validation->set_rules($validations['validacion']);

                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                    $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
                    $insert_emp_beca = $validations['insert_emp_beca'];
                    if (isset($datos_post['idc'])) {
                        $id_desencript_comprobante = $this->seguridad->decrypt_base64($datos_post['idc']); //Desencripta la clave del comprobante 
                        $insert_emp_beca['COMPROBANTE_CVE'] = $id_desencript_comprobante; //Asocia cve del comprobante
                    }
                    $insert_emp_beca['EMPLEADO_CVE'] = $result_id_empleado;
                    $result = $this->bcl->insert_becas($insert_emp_beca); //Inserta los datos de las dos tablas
//                    pr($result);
                    if (!empty($result)) {
                        //LLena los arrays para la bitacora
                        $array_datos_entidad['emp_beca'] = $result; //Asigna para bitacora las los datos insertados
                        $array_operacion_id_entidades['emp_beca'] = array('insert' => $result['EMP_BECA_CVE']); //Asigna operación ejecutada a la entidad
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['phl_registro_correcto']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
//                        pr('No se pudo guardar');
                    }
                    echo json_encode($res_j);
                    exit();
                }//*************************Termina bloque de insertar nueva beca
            }
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cclase_beca, enum_ecg::cbeca_interrumpida, enum_ecg::cmotivo_becado);
            $data_becas = carga_catalogos_generales($entidades_, $data_becas);

            //Todo lo de comprobante *******************************************
            $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            if (isset($datos_post['idc'])) {//si existe el id del comprobante
                $data_comprobante['idc'] = $datos_post['idc'];
            }
            $data_becas['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
            //**** fi de comprobante *******************************************


            echo $this->load->view('validador_censo/becas_comisiones/formulario_becas', $data_becas, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function get_add_comision() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $tipo_msg = $this->config->item('alert_msg');
            $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
            $data_comisiones = array();
            $data_comisiones['string_values'] = $string_values;
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
//            pr($_FILES);
            if ($this->input->post()) {//Después de cargar el formulario
//                pr($this->input->post());
                $datos_post = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_comision'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_becas_comisiones_laborales($validations, $datos_post, 'emp_comision'); //Obtener validaciones de archivo
//                pr($validations);
                $this->form_validation->set_rules($validations['validacion']);

                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                    $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
//                  $id_desencript_comprobante = $this->seguridad->decrypt_base64($datos_post['idc']); //Desencripta la clave del comprobante 
//                  $insert_emp_materia_educativo['COMPROBANTE_CVE'] = $id_desencript_comprobante; //Asocia cve del comprobante
                    $insert_emp_comision = $validations['insert_emp_comision'];
                    if (isset($datos_post['idc'])) {
                        $id_desencript_comprobante = $this->seguridad->decrypt_base64($datos_post['idc']); //Desencripta la clave del comprobante 
                        $insert_emp_comision['COMPROBANTE_CVE'] = $id_desencript_comprobante; //Asocia cve del comprobante
                    }
                    $insert_emp_comision['EMPLEADO_CVE'] = $result_id_empleado;
                    $result = $this->bcl->insert_comisiones($insert_emp_comision); //Inserta los datos de las dos tablas
                    if (!empty($result)) {
                        //LLena los arrays para la bitacora
                        $array_datos_entidad['emp_comision'] = $result; //Asigna para bitacora las los datos insertados
                        $array_operacion_id_entidades['emp_comision'] = array('insert' => $result['EMP_COMISION_CVE']); //Asigna operación ejecutada a la entidad
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['phl_registro_correcto']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
//                        pr('No se pudo guardar');
                    }
                    echo json_encode($res_j);
                    exit();
                }//*************************Termina bloque de insertar nueva beca
            }
            $condiciones_ = array(enum_ecg::ctipo_comision => array('IS_COMISION_ACADEMICA = ' => 0)); //Sólo comisiones que no son academicas, es decir, puras comisiones laborales
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ctipo_comision);
            $data_comisiones = carga_catalogos_generales($entidades_, $data_comisiones, $condiciones_);

            //Todo lo de comprobante *******************************************
            $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            if (isset($datos_post['idc'])) {//si existe el id del comprobante
                $data_comprobante['idc'] = $datos_post['idc'];
            }
            $data_comisiones ['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
            //**** fi de comprobante *******************************************


            echo $this->load->view('validador_censo/becas_comisiones/formulario_comisiones', $data_comisiones, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function eliminar_beca() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $datos_post = $this->input->post(null, true);
                $tipo_msg = $this->config->item('alert_msg');
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['becas_comisiones'];
                $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable

                $delete_satisfactorio = FALSE;
                $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD

                $emp_beca = $this->seguridad->decrypt_base64($datos_post['beca_cve']); //Identificador de la material educativo del empleado
                $registro_emp_beca = $this->cg->get_catalogo_general('emp_beca', array('EMP_BECA_CVE' => $emp_beca))[0];

                $delete_emp_beca = $this->cg->delete_registro_general('emp_beca', array('EMP_BECA_CVE' => $emp_beca));
                if ($delete_emp_beca === 1) {//Guarda en bitacora
                    $array_datos_entidad['emp_beca'] = $registro_emp_beca;
                    $array_operacion_id_entidades['emp_beca'] = array('delete' => $registro_emp_beca['EMP_BECA_CVE']); //Asigna operación ejecutada a la entidad
                    $delete_satisfactorio = TRUE;
                } else {
                    $delete_satisfactorio = FALSE;
                }

                if (!empty($datos_post['comprobante'])) {
                    $comprobante = $this->seguridad->decrypt_base64($datos_post['comprobante']); //Identificador de la comprobante 
                    $registro_comprobante = $this->cg->get_catalogo_general('comprobante', array('COMPROBANTE_CVE' => $comprobante))[0];
                    $delete_comprobante = $this->cg->delete_registro_general('comprobante', array('COMPROBANTE_CVE' => $comprobante));

                    if ($delete_comprobante === 1) {//Guarda en bitacora
                        $array_datos_entidad['comprobante'] = $registro_comprobante;
                        $array_operacion_id_entidades['comprobante'] = array('delete' => $registro_comprobante['COMPROBANTE_CVE']); //Asigna operación ejecutada a la entidad
                        //Eliminar archivo

                        $delete_satisfactorio = TRUE;
                    } else {
                        $delete_satisfactorio = FALSE;
                    }
                }

                $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                //Datos de bitacora el registro del usuario
                registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);

                if ($delete_satisfactorio) {//Manda mensaje de que no se pudo borrar el registro
                    $data['error'] = $string_values['succesfull_eliminar']; //Mensaje de que no encontro empleado
                    $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                    $data['borrado_correcto'] = 1; //Tipo de mensaje de error
                } else {
                    $data['error'] = $string_values['error_eliminar']; //Mensaje de que no encontro empleado
                    $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    $this->output->set_status_header('400');
                }
                echo json_encode($data);
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function eliminar_comision() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $datos_post = $this->input->post(null, true);
                $tipo_msg = $this->config->item('alert_msg');
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['becas_comisiones'];
                $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable

                $delete_satisfactorio = FALSE;
                $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD

                $emp_beca = $this->seguridad->decrypt_base64($datos_post['comision_cve']); //Identificador de la material educativo del empleado
                $registro_emp_comision = $this->cg->get_catalogo_general('emp_comision', array('EMP_COMISION_CVE' => $emp_beca))[0];

                $delete_emp_comision = $this->cg->delete_registro_general('emp_comision', array('EMP_COMISION_CVE' => $emp_beca));
                if ($delete_emp_comision === 1) {//Guarda en bitacora
                    $array_datos_entidad['emp_comision'] = $registro_emp_comision;
                    $array_operacion_id_entidades['emp_comision'] = array('delete' => $registro_emp_comision['EMP_COMISION_CVE']); //Asigna operación ejecutada a la entidad
                    $delete_satisfactorio = TRUE;
                } else {
                    $delete_satisfactorio = FALSE;
                }

                if (!empty($datos_post['comprobante'])) {
                    $comprobante = $this->seguridad->decrypt_base64($datos_post['comprobante']); //Identificador de la comprobante 
                    $registro_comprobante = $this->cg->get_catalogo_general('comprobante', array('COMPROBANTE_CVE' => $comprobante))[0];
                    $delete_comprobante = $this->cg->delete_registro_general('comprobante', array('COMPROBANTE_CVE' => $comprobante));

                    if ($delete_comprobante === 1) {//Guarda en bitacora
                        $array_datos_entidad['comprobante'] = $registro_comprobante;
                        $array_operacion_id_entidades['comprobante'] = array('delete' => $registro_comprobante['COMPROBANTE_CVE']); //Asigna operación ejecutada a la entidad
                        //Eliminar archivo

                        $delete_satisfactorio = TRUE;
                    } else {
                        $delete_satisfactorio = FALSE;
                    }
                }

                $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                //Datos de bitacora el registro del usuario
                registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);

                if ($delete_satisfactorio) {//Manda mensaje de que no se pudo borrar el registro
                    $data['error'] = $string_values['succesfull_eliminar']; //Mensaje de que no encontro empleado
                    $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                    $data['borrado_correcto'] = 1; //Tipo de mensaje de error
                } else {
                    $data['error'] = $string_values['error_eliminar']; //Mensaje de que no encontro empleado
                    $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    $this->output->set_status_header('400');
                }
                echo json_encode($data);
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    private function filtrar_datos_becas_comisiones($array_datos, $name_entidad) {
        //emp_beca o emp_comision
        $array_tmp_campos_entidad = $this->config->item($name_entidad); //Obtiene los campos de la entidad "ctipo_material"

        foreach ($array_datos as $key => $value) {
            if (array_key_exists($key, $array_tmp_campos_entidad)) {//Verifica existencia de la llave en la entidad "emp_materia_educativo" para enviar los datos
                $array_datos_res[$key] = $array_datos[$key];
            }
        }

        $array_tmp_campos_entidad = $this->config->item('comprobante'); //Obtiene los campos de la entidad "emp_materia_educativo"
        foreach ($array_datos as $key => $value) {
            if (array_key_exists($key, $array_tmp_campos_entidad)) {//Verifica existencia de la llave en la entidad "emp_materia_educativo" para enviar los datos
                $array_datos_res[$key] = $array_datos[$key];
            }
        }
        return $array_datos_res;
    }

    public function carga_datos_editar_beca() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $datos_post = $this->input->post(null, true);
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
                $data_becas['string_values'] = $string_values; //Crea la variable
                //Carga cátalogos de becas
                $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cclase_beca, enum_ecg::cbeca_interrumpida, enum_ecg::cmotivo_becado);
                $data_becas = carga_catalogos_generales($entidades_, $data_becas);
                //Des encrypta id de la beca para hacer la consulta de las becas
                $cve_beca = intval($this->seguridad->decrypt_base64($datos_post['cve_beca'])); //Identificador de materia_educativo
                $datos_reg_mat_edu = $this->bcl->get_datos_becas($cve_beca); //Datos de becas
                $informacion_becas = $this->filtrar_datos_becas_comisiones($datos_reg_mat_edu, 'emp_beca');
                $data_becas['informacion_becas'] = $informacion_becas;
//                pr($informacion_becas);
                //Carga datos de píe de página ************************************
                $datos_pie = array();
                $datos_pie['cve_beca'] = $datos_post['cve_beca'];
                $datos_pie['comprobantecve'] = $datos_post['comprobantecve'];
                //Todo lo de comprobante *******************************************
                $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
                $data_comprobante['dir_tes'] = array('TIPO_COMPROBANTE_CVE' => $informacion_becas['ctipo_comprobante'], 'COM_NOMBRE' => $informacion_becas['text_comprobante'], 'COMPROBANTE_CVE' => $informacion_becas['comprobante_cve']);
                if (!empty($datos_post['comprobantecve'])) {//Si existe comprobante, manda el identificador
                    $data_comprobante['idc'] = $datos_post['comprobantecve']; //Carga id del comprobante
                }
                $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                $data_becas['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
                //**** fi de comprobante *******************************************

                $data = array(
                    'titulo_modal' => $string_values['title_becas'],
                    'cuerpo_modal' => $this->load->view('validador_censo/becas_comisiones/formulario_becas', $data_becas, TRUE),
                    'pie_modal' => $this->load->view('validador_censo/becas_comisiones/becas_pie', $datos_pie, true)
                );
                echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function carga_datos_editar_comision() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {//Indica que debe intentar eliminar el curso
                $datos_post = $this->input->post(null, true);
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
                $data_comisiones['string_values'] = $string_values; //Crea la variable
                //Carga cátalogos de becas
                $condiciones_ = array(enum_ecg::ctipo_comision => array('IS_COMISION_ACADEMICA = ' => 0)); //Sólo comisiones que no son academicas, es decir, puras comisiones laborales
                $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ctipo_comision);
                $data_comisiones = carga_catalogos_generales($entidades_, $data_comisiones, $condiciones_);
                //Des encrypta id de la beca para hacer la consulta de las becas
                $cve_comision = intval($this->seguridad->decrypt_base64($datos_post['cve_comision'])); //Identificador de materia_educativo
                $datos_reg_comision = $this->bcl->get_datos_comisiones($cve_comision); //Datos de becas
                $informacion_comisiones = $this->filtrar_datos_becas_comisiones($datos_reg_comision, 'emp_comision');
                $data_comisiones['informacion_comisiones'] = $informacion_comisiones;
                //Carga datos de píe de página ************************************
                $datos_pie = array();
                $datos_pie['cve_comision'] = $datos_post['cve_comision'];
                $datos_pie['comprobantecve'] = $datos_post['comprobantecve'];
                //Todo lo de comprobante *******************************************
                $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
                $data_comprobante['dir_tes'] = array('TIPO_COMPROBANTE_CVE' => $informacion_comisiones['ctipo_comprobante'], 'COM_NOMBRE' => $informacion_comisiones['text_comprobante'], 'COMPROBANTE_CVE' => $informacion_comisiones['comprobante_cve']);
                if (!empty($datos_post['comprobantecve'])) {//Si existe comprobante, manda el identificador
                    $data_comprobante['idc'] = $datos_post['comprobantecve']; //Carga id del comprobante
                }
                $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
                $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
                $data_comisiones['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
                //**** fi de comprobante *******************************************

                $data = array(
                    'titulo_modal' => $string_values['tabs_comisiones'],
                    'cuerpo_modal' => $this->load->view('validador_censo/becas_comisiones/formulario_comisiones', $data_comisiones, TRUE),
                    'pie_modal' => $this->load->view('validador_censo/becas_comisiones/comisiones_pie', $datos_pie, true)
                );
                echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function actualizar_datos_editar_becas() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $tipo_msg = $this->config->item('alert_msg');
            $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
            $data_becas = array();
            $data_becas['string_values'] = $string_values;
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
            if ($this->input->post()) {//Después de cargar el formulario
                $datos_post = $this->input->post(null, true); //
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_beca'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_becas_comisiones_laborales($validations, $datos_post, 'emp_beca'); //Obtener validaciones de archivo
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    //Des encrypta id de la beca para hacer la consulta de las becas
                    $cve_beca = intval($this->seguridad->decrypt_base64($datos_post['cve_beca'])); //Identificador de materia_educativo
                    $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                    $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
                    $update_emp_beca = $validations['insert_emp_beca'];
                    $result_update_beca = $this->bcl->update_beca_laboral($cve_beca, $update_emp_beca); //Inserta los datos de las dos tablas
                    if (!empty($result_update_beca)) {//Actualizo la beca correctamente
                        //LLena los arrays para la bitacora
                        $array_datos_entidad['emp_beca'] = $result_update_beca; //Asigna para bitacora las los datos insertados
                        $array_operacion_id_entidades['emp_beca'] = array('update' => $result_update_beca['EMP_BECA_CVE']); //Asigna operación ejecutada a la entidad
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['succesfull_actualizar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
                        //                        pr('No se pudo guardar');
                    }
                    echo json_encode($res_j);
                    exit();
                }
            }//*************************Termina bloque de insertar nueva beca

            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cclase_beca, enum_ecg::cbeca_interrumpida, enum_ecg::cmotivo_becado);
            $data_becas = carga_catalogos_generales($entidades_, $data_becas);

            //Todo lo de comprobante *******************************************
            $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            if (isset($datos_post['idc'])) {//si existe el id del comprobante
                $data_comprobante['idc'] = $datos_post['idc'];
            }
            $data_becas['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
            //**** fi de comprobante *******************************************


            echo $this->load->view('validador_censo/becas_comisiones/formulario_becas', $data_becas, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function actualizar_datos_editar_comision() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $tipo_msg = $this->config->item('alert_msg');
            $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
            $data_becas = array();
            $data_becas['string_values'] = $string_values;
            $result_id_user = $this->obtener_id_usuario(); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->obtener_id_empleado(); //Asignamos id usuario a variable
            if ($this->input->post()) {//Después de cargar el formulario
                $datos_post = $this->input->post(null, true); //
//                pr($datos_post);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_comision'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_becas_comisiones_laborales($validations, $datos_post, 'emp_comision'); //Obtener validaciones de archivo
//                pr($validations);
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    //Des encrypta id de la beca para hacer la consulta de las becas
                    $cve_comision = intval($this->seguridad->decrypt_base64($datos_post['cve_comision'])); //Identificador de materia_educativo
                    $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                    $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
                    $update_emp_comision = $validations['insert_emp_comision'];
                    $result_update_beca = $this->bcl->update_comision_laboral($cve_comision, $update_emp_comision); //Inserta los datos de las dos tablas
                    if (!empty($result_update_beca)) {//Actualizo la beca correctamente
                        //LLena los arrays para la bitacora
                        $array_datos_entidad['emp_comision'] = $result_update_beca; //Asigna para bitacora las los datos insertados
                        $array_operacion_id_entidades['emp_comision'] = array('update' => $result_update_beca['EMP_COMISION_CVE']); //Asigna operación ejecutada a la entidad
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                        $res_j['error'] = $string_values['succesfull_actualizar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = TRUE; //Tipo de mensaje de error
                    } else {//Error al guardar, manda mensaje de error
                        $res_j['error'] = $string_values['error_guardar']; //Mensaje de que no encontro empleado
                        $res_j['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $res_j['satisfactorio'] = FALSE; //Tipo de mensaje de error
                        //                        pr('No se pudo guardar');
                    }
                    echo json_encode($res_j);
                    exit();
                }
            }//*************************Termina bloque de insertar nueva beca

            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);

            //Todo lo de comprobante *******************************************
            $data_comprobante['string_values'] = $this->lang->line('interface')['general'];
            $entidades_comprobante = array(enum_ecg::ctipo_comprobante);
            $data_comprobante['catalogos'] = carga_catalogos_generales($entidades_comprobante, null, null);
            if (isset($datos_post['idc'])) {//si existe el id del comprobante
                $data_comprobante['idc'] = $datos_post['idc'];
            }
            $data_becas['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data_comprobante, TRUE);
            //**** fi de comprobante *******************************************
            echo $this->load->view('validador_censo/becas_comisiones/formulario_comisiones', $data_comprobante, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function genera_array($array_validados, $datos_post, $array_campos) {
        $array_result = array();
        foreach ($datos_post as $keyp => $val) {
            switch ($keyp) {
                case '':
                    break;
                default :
                    $array_result[] = $array_validados[$keyp];
            }
        }
    }

    ///////////////////////////////////Inicio detalle de registros
    public function formacion_salud_detalle($identificador = null, $validar = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $this->lang->load('interface');
            $data['identificador'] = $identificador;
            $fs_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            //$data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['validador_censo'], $this->lang->line('interface')['formacion_salud'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            
            $data['dir_tes'] = $this->fm->get_formacion_salud(array('conditions' => array('EMPLEADO_CVE'=>$this->obtener_id_empleado(), 'FPCS_CVE' => $fs_id), 'fields' => 'emp_for_personal_continua_salud.*, ctipo_formacion_salud.TIP_FORM_SALUD_NOMBRE, csubtipo_formacion_salud.SUBTIP_NOMBRE, TIPO_COMPROBANTE_CVE'))[0]; //Obtener datos
            
            $accion_general = $this->config->item('ACCION_GENERAL');
            if($this->seguridad->decrypt_base64($validar) == $accion_general['VALIDAR']['valor']){ //En caso de que la acción almacenada
                $data = $this->validar_registro(array_merge($data, array('tipo_id'=>'FORMACION_SALUD', 'seccion_actualizar'=>'seccion_formacion', 'identificador_registro'=>$fs_id)));
            } else {
                $data['formulario_validacion'] = $this->historico_registro(array_merge($data, array('tipo_id'=>'FORMACION_SALUD', 'seccion_actualizar'=>'seccion_formacion', 'identificador_registro'=>$fs_id)));
                $data['pie_modal'] = '<div class="col-xs-12 col-sm-12 col-md-12 text-right"><button type="button" id="close_modal_censo" class="btn btn-success" data-dismiss="modal">'.$data['string_values']['cerrar'].'</button></div>';
            }
            
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_visualizar_archivo', $data, TRUE);
            $data['titulo_modal'] = $data['string_values']['title'];
            //pr($data);
            $data['cuerpo_modal'] = $this->load->view('validador_censo/formacion/formacion_salud_detalle', $data, TRUE);

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function formacion_docente_detalle($identificador = null, $validar = null){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            $this->load->model('Formacion_model', 'fm');
            $this->lang->load('interface');
            $data['identificador'] = $identificador;
            $fs_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $validacion_cve_session = $this->obtener_id_validacion();
            $data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['validador_censo'], $this->lang->line('interface')['formacion_docente'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $tmp = $resultado_almacenado = array();
            $tmp_tematica = '0';

            $condiciones_ = array(enum_ecg::cinstitucion_avala => array('IA_TIPO' => $this->config->item('institucion')['imparte'])); //Obtener catálogos para llenar listados desplegables
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cinstitucion_avala, enum_ecg::cmodalidad, enum_ecg::ctipo_formacion_profesional, enum_ecg::ctematica);
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, $condiciones_);
            
            $data['mostrar_hora_fecha_duracion'] = 0;
            //pr($this->session->userdata());
            $data['dir_tes'] = $this->fm->get_formacion_docente(array('conditions'=>array('EMPLEADO_CVE'=>$this->obtener_id_empleado(), 'EMP_FORMACION_PROFESIONAL_CVE'=>$fs_id), 'order'=>'EFO_ANIO_CURSO', 'fields'=>'emp_formacion_profesional.*, cinstitucion_avala.IA_NOMBRE, ctipo_formacion_profesional.TIP_FOR_PRO_NOMBRE, csubtipo_formacion_profesional.SUB_FOR_PRO_NOMBRE, cmodalidad.MOD_NOMBRE, comprobante.TIPO_COMPROBANTE_CVE, ccurso.CUR_NOMBRE'))[0]; //ctipo_curso.TIP_CUR_NOMBRE,
            $data['dir_tes']['tematica'] = $this->fm->get_formacion_docente_tematica(array('conditions'=>array('EMP_FORMACION_PROFESIONAL_CVE'=>$fs_id), 'order'=>'TEM_NOMBRE'));
            
            $accion_general = $this->config->item('ACCION_GENERAL');
            if($this->seguridad->decrypt_base64($validar) == $accion_general['VALIDAR']['valor']){ //En caso de que la acción almacenada
                $data = $this->validar_registro(array_merge($data, array('tipo_id'=>'FORMACION_PROFESIONAL', 'seccion_actualizar'=>'seccion_formacion', 'identificador_registro'=>$fs_id)));
            } else {
                $data['formulario_validacion'] = $this->historico_registro(array_merge($data, array('tipo_id'=>'FORMACION_PROFESIONAL', 'seccion_actualizar'=>'seccion_formacion', 'identificador_registro'=>$fs_id)));
                $data['pie_modal'] = '<div class="col-xs-12 col-sm-12 col-md-12 text-right"><button type="button" id="close_modal_censo" class="btn btn-success" data-dismiss="modal">'.$data['string_values']['cerrar'].'</button></div>';
            }

            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_visualizar_archivo', $data, TRUE);
            $data['titulo_modal'] = $data['string_values']['title'];
            //pr($data['formulario_validacion']);
            $data['cuerpo_modal'] = $this->load->view('validador_censo/formacion/formacion_docente_detalle', $data, TRUE);

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function direccion_tesis_detalle($identificador = null, $validar = null){
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Direccion_tesis_model', 'dt');
            $this->lang->load('interface');
            $data['identificador'] = $identificador;
            $dt_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $data['string_values'] = array_merge($this->lang->line('interface')['validador_censo'], $this->lang->line('interface')['direccion_tesis'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            //pr($this->session->userdata());
            $data['dir_tes'] = $this->dt->get_lista_datos_direccion_tesis(array('conditions' => array('EMPLEADO_CVE'=>$this->obtener_id_empleado(), 'EMP_COMISION_CVE' => $dt_id), 'fields'=>'emp_comision.*, comprobante.COM_NOMBRE, comprobante.TIPO_COMPROBANTE_CVE, ctipo_comprobante.TIP_COM_NOMBRE, cnivel_academico.NIV_ACA_NOMBRE, comision_area.COM_ARE_NOMBRE'))[0]; //Obtener datos

            $accion_general = $this->config->item('ACCION_GENERAL');
            if($this->seguridad->decrypt_base64($validar) == $accion_general['VALIDAR']['valor']){ //En caso de que la acción almacenada
                $data = $this->validar_registro(array_merge($data, array('tipo_id'=>'COMISION_ACADEMICA', 'seccion_actualizar'=>'seccion_direccion_tesis', 'identificador_registro'=>$dt_id)));
            } else {
                $data['formulario_validacion'] = $this->historico_registro(array_merge($data, array('tipo_id'=>'COMISION_ACADEMICA', 'seccion_actualizar'=>'seccion_direccion_tesis', 'identificador_registro'=>$dt_id)));
                $data['pie_modal'] = '<div class="col-xs-12 col-sm-12 col-md-12 text-right"><button type="button" id="close_modal_censo" class="btn btn-success" data-dismiss="modal">'.$data['string_values']['cerrar'].'</button></div>';
            }
            //pr($data['formulario_validacion']);
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_visualizar_archivo', $data, TRUE);
            $data = array(
                'titulo_modal' => $data['string_values']['title'],
                'cuerpo_modal' => $this->load->view('validador_censo/direccionTesis/direccion_tesis_detalle', $data, TRUE)
            );

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function comision_academica_detalle($tipo_comision = null, $identificador = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->model('Comision_academica_model', 'ca');
            $this->lang->load('interface');
            $data['tipo_comision'] = $tipo_comision;
            $data['identificador'] = $identificador;
            $tc_id = $this->seguridad->decrypt_base64($tipo_comision); //Identificador del tipo de comisión
            $ca_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $validar = $this->input->get('dv'); //Bandera que habilita la validación
            //$data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['validador_censo'], $this->lang->line('interface')['comision_academica'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);

            $config = $this->comision_academica_configuracion($tc_id, false);
            $data['catalogos'] = $config['catalogos'];

            $data['mostrar_hora_fecha_duracion'] = 0; //$this->get_valor_validacion($datos_formulario, 'duracion'); //Muestrá validaciones de hora y fecha de inicio y termino según la opción de duración

            $data['dir_tes'] = $this->ca->get_comision_academica(array('conditions' => array('EMPLEADO_CVE'=>$this->obtener_id_empleado(), 'EMP_COMISION_CVE' => $ca_id), 'fields'=>'emp_comision.*, comprobante.COM_NOMBRE, comprobante.TIPO_COMPROBANTE_CVE, ctipo_curso.TIP_CUR_NOMBRE, ccurso.CUR_NOMBRE, cnivel_academico.NIV_ACA_NOMBRE'))[0]; //Obtener datos

            $accion_general = $this->config->item('ACCION_GENERAL');
            if($this->seguridad->decrypt_base64($validar) == $accion_general['VALIDAR']['valor']){ //En caso de que la acción almacenada
                $data = $this->validar_registro(array_merge($data, array('tipo_id'=>'COMISION_ACADEMICA', 'seccion_actualizar'=>'seccion_comision_academica', 'identificador_registro'=>$ca_id)));
            } else {
                $data['formulario_validacion'] = $this->historico_registro(array_merge($data, array('tipo_id'=>'COMISION_ACADEMICA', 'seccion_actualizar'=>'seccion_comision_academica', 'identificador_registro'=>$ca_id)));
                $data['pie_modal'] = '<div class="col-xs-12 col-sm-12 col-md-12 text-right"><button type="button" id="close_modal_censo" class="btn btn-success" data-dismiss="modal">'.$data['string_values']['cerrar'].'</button></div>';
            }
            //pr($data);
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_visualizar_archivo', $data, TRUE);
            $data['titulo_modal'] = $data['string_values']['title'];

            $data['cuerpo_modal'] = $this->load->view($config['plantilla'], $data, TRUE);

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    /**
     * Método que permite agregar formulario de validación a las ventanas que muestran la información del registro (curso, beca, comisión, etc.)
     * seccion_actualizar       Sección que se actualizará al cierre del modal
     * tipo_id                  Obtener tabla y campo donde se almacenará
     * identificador_registro   Identificador del registro (curso, beca, comisión, etc) a validar
    */
    private function validar_registro($data){
        $this->load->helper('date');
        $this->load->model('Validacion_docente_model', 'vd');
        $tipo_id = $data['tipo_id']; //Definido en archivo de configuración general. Arreglo que contiene tablas y campo para la actualización de datos
        $data['tipo'] = $this->seguridad->encrypt_base64($tipo_id);
        $tipo_validacion = $this->config->item('TABLAS')[$tipo_id]; ///Obtener tabla y campo donde se almacenará

        $validacion_cve = $this->obtener_id_validacion(); //Se obtiene identificador de la validación de sesión
        
        $entidades_ = array(enum_ecg::cvalidacion_curso_estado); //Obtener catálogo de estados para la validación de cada curso
        $data['catalogos'] = carga_catalogos_generales($entidades_, null, null);

        ///Obtener validación del curso
        $data['registro_validado'] = $this->vd->get_validacion_registro(array('conditions'=>array("{$tipo_validacion['tabla_validacion']}.validacion_cve"=>$validacion_cve, "{$tipo_validacion['campo']}"=>$data['identificador_registro']), 'table'=>$tipo_validacion['tabla_validacion'], 'order'=>'VAL_CUR_FCH DESC'));
        
        $data['formulario_validacion'] = $this->load->view('validador_censo/validacion_formulario', $data, TRUE);

        return $data;
    }

    private function historico_registro($data){
        $tipo_id = $data['tipo_id']; //Definido en archivo de configuración general. Arreglo que contiene tablas y campo para la actualización de datos
        $data['tipo'] = $this->seguridad->encrypt_base64($tipo_id);
        return $this->load->view('validador_censo/validacion_listado', $data, TRUE);
    }

    public function listado_estado_registro($identificador = null, $tipo = null){
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            $this->load->helper('date');
            $this->load->model('Validacion_docente_model', 'vd');
            $data['identificador'] = $identificador;
            $data['string_values'] = array_merge($this->lang->line('interface')['validador_censo'], $this->lang->line('interface')['direccion_tesis'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);
            $id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $tipo_id = $this->seguridad->decrypt_base64($tipo);
            $tipo_validacion = $this->config->item('TABLAS')[$tipo_id]; ///Obtener tabla y campo donde se almacenará

            $validacion_cve = $this->obtener_id_validacion(); //Se obtiene identificador de la validación de sesión
            $data['registro_validado'] = $this->vd->get_validacion_registro(array('conditions'=>array("{$tipo_validacion['campo']}"=>$id), 'table'=>$tipo_validacion['tabla_validacion'], 'order'=>'VAL_CUR_FCH DESC'));

            echo $this->load->view('validador_censo/validacion_historico_listado', $data, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }
    ///////////////////////////////////Fin detalle de registros
    
    /**
     * Método que almacena la validación del censo, registro por registro(curso, beca, comisión, etc.)
     * @autor       : Jesús Z. Díaz P.
     * @modified    :
     * @access      : public
     */
    public function validar_censo_registro($identificador_registro=null, $identificador_validacion=null){
        if ($this->input->is_ajax_request()) { //Sólo se accede al método a través de una petición ajax
            if($this->input->post()){ //Validar si se recibió información
                $this->lang->load('interface');
                $string_values = array_merge($this->lang->line('interface')['validador_censo'], $this->lang->line('interface')['general']);
                $resultado = array('result'=>false, 'msg'=>'', 'id'=>'');
                $tipo = $this->input->get('tipo'); //Tipo de tabla a utilizar

                if(!is_null($identificador_registro) && !is_null($tipo)){
                    $data['identificador_registro'] = $identificador_registro;
                    $data['identificador_validacion'] = $identificador_validacion;
                    $registro_id = $this->seguridad->decrypt_base64($identificador_registro); //Identificador del registro
                    $validacion_id = (!is_null($identificador_validacion)) ? $this->seguridad->decrypt_base64($identificador_validacion) : $identificador_validacion; //Identificador del registro
                    //pr($_SESSION);
                    if (!is_null($this->input->post()) && !empty($this->input->post())) { //Se verifica que se haya recibido información por método post
                        $validacion_cve = $this->obtener_id_validacion(); ///Obtener de sesión el identificador de la validación que se esta editando
                        //$validacion_gral_cve = $this->session->userdata('validacion_gral_cve'); ///Obtener de sesión el identificador de la validación que se esta editando
                        $data['formulario'] = $this->input->post(null, true); //Se limpian y obtienen datos

                        $this->config->load('form_validation'); //Cargar archivo con validaciones
                        $validations = $this->config->item('form_validacion_registro'); //Obtener validaciones de archivo general
                        $this->form_validation->set_rules($validations); //Añadir validaciones
                        $cvalidacion_curso_estado = $this->config->item('cvalidacion_curso_estado');

                        //////Agregar validación de comentario, si el estado elegido es no valido o en corrección
                        if(in_array($data['formulario']['estado_validacion'], array($cvalidacion_curso_estado['NO_VALIDO']['id'], $cvalidacion_curso_estado['CORRECCION']['id']))){
                            $this->form_validation->set_rules('comentario', 'Comentario', 'required');
                        }

                        if($this->form_validation->run() == TRUE) { //Validar datos
                            $tipo_id = $this->seguridad->decrypt_base64($tipo); //Identificador del tipo
                            $tipo_validacion = $this->config->item('TABLAS')[$tipo_id]; ///Obtener tabla y campo donde se almacenará
                            $validacion_registro = $this->validacion_registro_vo(array_merge($data['formulario'], array('validacion_cve' => $validacion_cve, 'registro' => $registro_id, 'tipo_validacion' => $tipo_validacion))); //'validacion_gral_cve' => $validacion_gral_cve
                            
                            //$this->vdm->get_validacion_registro(array('table'=>$tipo_validacion['tabla_validacion'], 'conditions'=>''));
                            if(is_null($identificador_validacion)){
                                $resultado_almacenado = $this->vdm->insert_validacion_registro($tipo_validacion['tabla_validacion'], $validacion_registro);
                                $resultado['id'] = $this->seguridad->encrypt_base64($resultado_almacenado['data']['identificador']);
                            } else {
                                $resultado_almacenado = $this->vdm->update_validacion_registro(array('HIST_VAL_CURSO_CVE' => $validacion_id), $tipo_validacion['tabla_validacion'], $validacion_registro);
                            }

                            if($resultado_almacenado['result']==true){
                                $resultado['result'] = true;
                                $resultado['msg'] = $string_values['datos_almacenados_correctamente'];
                            } else {
                                $resultado['msg'] = $resultado_almacenado['msg'];
                            }
                            //pr($validacion_registro);
                            //pr($resultado_almacenado);
                        } else {
                            $resultado['msg'] = validation_errors();
                        }
                    } else {
                        $resultado['msg'] = $string_values['error_datos_enviados'];
                    }
                } else {
                    $resultado['msg'] = $string_values['error_datos_enviados'];
                }
                //echo imprimir_resultado($resultado); ///Muestra mensaje
                //pr($_POST); //pr($_SESSION);
                //pr($data);
                echo json_encode($resultado);
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    ////////////////////////Inicio Factory de validación
    private function validacion_registro_vo($validacion){
        $val = new Validacion_registro_dao;
        $val->VALIDACION_CVE = (isset($validacion['validacion_cve']) && !empty($validacion['validacion_cve'])) ? $validacion['validacion_cve'] : NULL;
        $val->VAL_CUR_EST_CVE = (isset($validacion['estado_validacion']) && !empty($validacion['estado_validacion'])) ? $validacion['estado_validacion'] : NULL;
        $val->VAL_CUR_COMENTARIO = (isset($validacion['comentario']) && !empty($validacion['comentario'])) ? $validacion['comentario'] : NULL;
        //$val->VAL_CUR_FCH = (isset($validacion['fecha']) && !empty($validacion['fecha'])) ? $validacion['fecha'] : NULL;
        $val->{$validacion['tipo_validacion']['campo']} = $validacion['registro'];

        return $val;
    }
}

class Validacion_registro_dao {
    //public $HIST_VAL_CURSO_CVE;
    public $VALIDACION_CVE;
    public $VAL_CUR_EST_CVE;
    public $VAL_CUR_COMENTARIO;
    //public $VAL_CUR_FCH;
    //public $EMP_COMISION_CVE;
}

class Emp_comision_dao {
    //public $EMP_COMISION_CVE;
    public $EMPLEADO_CVE;
    public $TIP_COMISION_CVE;
    public $COMPROBANTE_CVE;
}

class Direccion_tesis_dao extends Emp_comision_dao {
    public $EC_ANIO;
    public $COM_AREA_CVE;
    public $NIV_ACADEMICO_CVE;
}

class Comite_educacion_dao extends Emp_comision_dao {
    public $EC_ANIO;
    public $TIP_CURSO_CVE;
}

class Sinodal_examen_dao extends Emp_comision_dao {
    public $EC_ANIO;
    public $NIV_ACADEMICO_CVE;
}

class Coordinador_tutores_dao extends Emp_comision_dao {
    public $EC_ANIO;
    public $EC_FCH_INICIO;
    public $EC_FCH_FIN;
    public $EC_DURACION;
    public $TIP_CURSO_CVE;
    public $CURSO_CVE;
}

class Coordinador_curso_dao extends Emp_comision_dao {
    public $EC_ANIO;
    public $EC_FCH_INICIO;
    public $EC_FCH_FIN;
    public $EC_DURACION;
    public $TIP_CURSO_CVE;
    public $CURSO_CVE;
}

class Formacion_salud_dao {
    //public $FPCS_CVE;
    public $EMPLEADO_CVE;
    public $COMPROBANTE_CVE;
    public $EFPCS_FCH_INICIO;
    public $EFPCS_FCH_FIN;
    public $EFPCS_FOR_INICIAL;
    public $TIP_FORM_SALUD_CVE;
    public $CSUBTIP_FORM_SALUD_CVE;
}

class Formacion_docente_dao{
    //public $EMP_FORMACION_PROFESIONAL_CVE;
    public $EMPLEADO_CVE;
    public $COMPROBANTE_CVE;
    public $EFP_DURACION;
    public $MODALIDAD_CVE;
    public $INS_AVALA_CVE;
    public $EFP_FCH_INICIO;
    public $EFP_FCH_FIN;
    public $CURSO_CVE;
    public $TIP_FOR_PROF_CVE;
    public $SUB_FOR_PRO_CVE;
    public $EFO_ANIO_CURSO;
    public $EFP_NOMBRE_CURSO;
}

class Formacion_docente_tematica_dao{
    //public $RFORM_PROF_TEMATICA_CVE;
    public $TEMATICA_CVE;
    public $EMP_FORMACION_PROFESIONAL_CVE;
}
