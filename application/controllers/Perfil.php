<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Ricardo Sanchez S
 */
class Perfil extends MY_Controller {

    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->model('Perfil_model', 'modPerfil');
        $this->load->model('Catalogos_generales', 'cg');
        $this->load->model('Actividad_docente_model', 'adm');
        $this->load->library('Ventana_modal');
        $this->load->config('general');

        //$this->lang->load('interface');
    }

    /**
     * 
     * @author Ricardo Sanchez S
     */
    public function index() {
        $rol_seleccionado = $this->session->userdata('rol_seleccionado'); //Rol seleccionado de la pantalla de roles

        $array_menu = get_busca_hijos($rol_seleccionado, $this->uri->segment(1));
        $datosPerfil = $this->loadInfo($this->session->userdata('identificador'));

        $datosPerfil['generos'] = array('F' => 'Femenino', 'M' => 'Masculino');
        $datosPerfil['estadosCiviles'] = dropdown_options($this->modPerfil->getEstadoCivil(), 'CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE');
        $datosPerfil['formacionProfesionalOptions'] = array();
        $datosPerfil['tipoComprobanteOptions'] = array();
        $datosPerfil['array_menu'] = $array_menu;


        $main_content = $this->load->view('perfil/index', $datosPerfil, true);
        $this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
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

    public function get_data_ajax_actividad() {
        $data = array();
        $tipo_msg = $this->config->item('alert_msg');
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['actividad_docente'];
        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
        $actividad_docente = $this->adm->get_actividad_docente_general($result_id_user); //Verifica si existe el ususario ya contiene datos de actividad
//        pr($actividad_docente);
        if ($this->input->post()) { //Validar que la información se haya enviado por método POST para almacenado
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('form_actividad_docente_general'); //Obtener validaciones de archivo
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
                        $actividad_docente_up['CURSO_PRINC_IMPARTE'] = $datos_registro['curso_principal_imapare'];
                        $actividad_docente_up['EMPLEADO_CVE'] = $empleado[0]['EMPLEADO_CVE']; //Asigna cve del empleado
                        $resultado = $this->adm->insert_actividad_docente_general($actividad_docente_up); //Inserta datos del docente
                        if ($resultado == -1) {//hubo un error a la hora de insertar un registro
                            $data['error'] = $string_values['error_insertar']; //Mensaje de que no encontro empleado
                            $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        } else {//Los datos se insertaron correctamente
                            $data['error'] = $string_values['succesfull_insertar']; //Mensaje de que los datos se insertaron correctamente
                            $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de éxito
                            //Datos de bitacora el actividad general del docente del usuario
                            $parametros = $this->config->item('parametros_bitacora');
                            $parametros['USUARIO_CVE'] = $result_id_user; //Asigna id del usuario
//                                    $parametros['BIT_IP'] = $this->get_real_ip();//Le manda la ip del cliente
                            $this->load->model('Login_model', 'lm');
                            $parametros['BIT_RUTA'] = '/perfil#get_data_ajax_actividad/ inserta';
                            $result = $this->lm->set_bitacora($parametros); //Invoca la función para guardar bitacora
                        }
                    } else {//No existe el empleado, manda un mensaje
                        $data['error'] = $this->lang->line('interface')['general']['msg_no_existe_empleado']; //Mensaje de que no encontro empleado
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    }
                } else {//Actualizar
                    //Preguntar si, existira mas de una actividad general por ususario, y si no, como se distingue 
                    $actividad_docente_up['ANIOS_DEDICADOS'] = $datos_registro['actividad_anios_dedicados_docencia'];
                    $actividad_docente_up['EJER_PREDOMI_CVE'] = $datos_registro['ejercicio_predominante'];
                    $actividad_docente_up['CURSO_PRINC_IMPARTE'] = $datos_registro['curso_principal_imapare'];
                    $actividad_docente_up['EMPLEADO_CVE'] = $actividad_docente[0]['EMPLEADO_CVE']; //Asigna cve del empleado
                    $resultado = $this->adm->update_actividad_docente_general($actividad_docente_up); //Verifica si existe el ususario ya contiene datos de actividad
                    if ($resultado == -1) {//hubo un error a la hora de insertar un registro
                        $data['error'] = $string_values['error_actualizar']; //Mensaje de existio un error al actualizar los datos de actividad docente
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    } else {//Los datos se insertaron correctamente
                        $data['error'] = $string_values['succesfull_actualizar']; //Mensaje de que los datos se actualizarón correctamente
                        $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de éxito
                        //Datos de bitacora el actividad general del docente del usuario
                        $parametros = $this->config->item('parametros_bitacora');
                        $parametros['USUARIO_CVE'] = $result_id_user; //Asigna id del usuario
//                                    $parametros['BIT_IP'] = $this->get_real_ip();//Le manda la ip del cliente
                        $this->load->model('Login_model', 'lm');
                        $parametros['BIT_RUTA'] = '/perfil#get_data_ajax_actividad/ actualiza';
                        $result = $this->lm->set_bitacora($parametros); //Invoca la función para guardar bitacora
                    }
                }
            } else {
                $data['error'] = $this->lang->line('interface')['general']['advertencia_agregar_todos_los_datos']; //Mensaje de que no encontro empleado
                $data['tipo_msg'] = $tipo_msg['WARNING']['class']; //Tipo de mensaje de advertencia
            }
        }
        $curso = $this->cg->get_ccurso(); //Obtiene delegaciones del modelo
        $data['cursos'] = dropdown_options($curso, 'CURSO_CVE', 'CUR_NOMBRE'); //Manipulamos la información a mostrar de delegación

        $data['string_values'] = $string_values; //Array de textos que muestra el formulario para actividad

        $ejp = $this->cg->get_ejercicios_profesionales(); //Obtiene delegaciones del modelo
        $data['ejercicios_profesionales'] = dropdown_options($ejp, 'EJE_PRO_CVE', 'EJE_PRO_NOMBRE'); //Manipulamos la información a mostrar de delegación

        $data['actividad_docente'] = $actividad_docente; //

        $main_contet = $this->load->view('perfil/actividad_docente/actividad_tpl', $data, FALSE);
    }

    public function get_data_ajax_actividad_modal() {
        if ($this->input->is_ajax_request()) {

            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar 
            $data_actividad['string_values'] = $string_values; //Crea la variable 
            $data_actividad['boton_guardar'] = 0;
            if ($this->input->post()) {//Después de cargar el formulario
                if ($this->input->post('tipo_actividad_docente', false) > 0) {
                    $data_actividad['boton_guardar'] = 1;
                }
            }

            $tipo_actividad_docente = $this->cg->get_tipo_actividad_docente(); //Obtiene delegaciones del modelo
            $data_actividad['tipo_actividad_docente'] = dropdown_options($tipo_actividad_docente, 'TIP_ACT_DOC_CVE', 'TIP_ACT_DOC_NOMBRE'); //Manipulamos la información a mostrar de delegación

            $data = array(
                'titulo_modal' => 'Actividad docente',
                'cuerpo_modal' => $this->load->view('perfil/actividad_docente/actividad_modal_tpl', $data_actividad, TRUE),
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        }
    }

    /**
     * 
     * @param type $index_tipo_actividad_docente 
     */
    public function get_data_ajax_actividad_cuerpo_modal($index_tipo_actividad_docente = null, $combo=0) {
        if ($this->input->is_ajax_request() && $index_tipo_actividad_docente != null) {//Si es un ajax
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar
            $datos['string_values'] = $string_values; //Almacena textos de actividad en el arreglo



            if ($this->input->post() AND $combo ==='1') {
                $datos_registro = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_ccl'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion($validations, $datos_registro);
                $this->form_validation->set_rules($validations);
                if ($this->form_validation->run()) {
                    
                }
            }
            if ($index_tipo_actividad_docente > 0) {//Checa si debe aparecer el botòn de guardar 
                $valores['identificador'] = $index_tipo_actividad_docente;
                $datos['pie_pag'] = $this->load->view('perfil/actividad_docente/actividad_pie', $valores, true); //Carga la vista correspondiente al index
            }
            $configuracion_formularios_actividad_docente = $this->config->item('actividad_docente_componentes')[$index_tipo_actividad_docente]; //Carga la configuracion de
            //Carga catalogos 
            $datos = carga_catalogos_censo($configuracion_formularios_actividad_docente['catalogos_indexados'], $datos); //Carga los catálogos de la configuración
//            pr($datos);
            echo $this->load->view($configuracion_formularios_actividad_docente['vista'], $datos, TRUE); //Carga la vista correspondiente al index
        }
    }
    
    private function analiza_validacion($array_validacion, $array_componentes){
//        pr($array_componentes);
//        pr($array_validacion);
        $array_result = array();
        foreach ($array_componentes as $key => $value) {
            switch ($key){
                case 'fecha_inicio_pick'://No carga si no hasta duraciòn 
                    break;
                case 'fecha_inicio_pick'://No carga si no hasta duraciòn
                    break;
                case 'duracion':
                    pr('ssss' );
                    if($value === 'hora_dedicadas'){
                        $array_result['hora_dedicadas'] .= $array_validacion['hora_dedicadas'];
                    }else{//fechas_dedicadas
                        $array_result['fecha_inicio_pick'] .= $array_validacion['fecha_inicio_pick'];
                        $array_result['fecha_fin_pick'] .= $array_validacion['fecha_fin_pick'];
                    }
                    break;
                default :
                    array_push($array_result,$value);
//                        $array_result[$key] 
//                        .= $array_validacion[$key];
                    
            }
            
        }
//        pr($array_result);
        return $array_result;
    }

    private function cargar_comprobante() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
        } else {

            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];
        }
    }

}
