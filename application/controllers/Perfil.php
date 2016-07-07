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

    /**
     * author LEAS
     * Guarda actividad docente general
     */
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

    /**
     * author LEAS
     * Carga el modal con opciones de tipo de actividad tipo de actividad
     * @param type $insertar si "insertar" es igual con "0" muestra el combo que 
     * carga los tipos de actividad docente. Si "insertar" es mayor que "0"
     */
    public function get_data_ajax_actividad_modal($insertar = '0') {
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

            if ($insertar === '0') {//Muestra el combo para seleccionar tipo de actividad docente 
                $tipo_actividad_docente = $this->cg->get_tipo_actividad_docente(); //Obtiene tipos de actividad del docente
                $data_actividad['tipo_actividad_docente'] = dropdown_options($tipo_actividad_docente, 'TIP_ACT_DOC_CVE', 'TIP_ACT_DOC_NOMBRE'); //Indicamos que muestré los siguientes datos index y descripción
            }

            $data = array(
                'titulo_modal' => 'Actividad docente',
                'cuerpo_modal' => $this->load->view('perfil/actividad_docente/actividad_modal_tpl', $data_actividad, TRUE),
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        }
    }

    /**
     * @author LEAS
     * @param type $index_tipo_actividad_docente 
     */
    public function get_data_ajax_actividad_cuerpo_modal($index_tipo_actividad_docente = null, $combo = '0', $id_tipo_actividad = '0') {
        if ($this->input->is_ajax_request() && $index_tipo_actividad_docente != null) {//Si es un ajax
            $configuracion_formularios_actividad_docente = $this->config->item('actividad_docente_componentes')[$index_tipo_actividad_docente]; //Carga la configuración  del formularío
            $tipo_msg = $this->config->item('alert_msg');
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar
            $datos['string_values'] = $string_values; //Almacena textos de actividad en el arreglo
            $valores['mostrar_hora_fecha_duracion'] = 0; //


            if ($this->input->post() AND $combo === '1') {
                $datos_registro = $this->input->post(null, true);
                pr($datos_registro);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_ccl'); //Obtener validaciones de archivo
                $valores['mostrar_hora_fecha_duracion'] = $this->get_valor_validacion($datos_registro, 'duracion'); //Muestrá validaciones de hora y fecha de inicio y termino según la opción de duración
                $array_validaciones_extra_actividad = $configuracion_formularios_actividad_docente['validaciones_extra']; //Carga las validaciones extrá de archivo config->general que no se pudieron automatizar con el post, es decir radio button etc
                $validations = $this->analiza_validacion($validations, $datos_registro, $array_validaciones_extra_actividad); //Genera las validaciones del formulario que realmente deben ser tomadas en cuenta 
                pr($validations);
                $this->form_validation->set_rules($validations); //Carga las validaciones
                if ($this->form_validation->run()) {//Ejecuta validaciones
                    if ($id_tipo_actividad === '0') {//Guardar un nuevo registro
                        $result_guardar_actividad = $this->guardar_actividad($configuracion_formularios_actividad_docente, $datos_registro, array('TIP_ACT_DOC_CVE' => $index_tipo_actividad_docente));
//                        $result_guardar_actividad = -1;
                        if ($result_guardar_actividad > 0) {//Se guardo correctamente, asignna mensaje success y registra en bitacora
                            $valores['error'] = $this->lang->line('interface')['general']['datos_almacenados_correctamente']; //Mensaje de que no encontro empleado
                            $valores['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                            //Guarda bitacora
                            //Datos de bitacora el actividad general del docente del usuario
                            $parametros = $this->config->item('parametros_bitacora');
                            $parametros['USUARIO_CVE'] = $this->session->userdata('identificador'); //Asigna id del usuario
//                                    $parametros['BIT_IP'] = $this->get_real_ip();//Le manda la ip del cliente
                            $this->load->model('Login_model', 'lm');
                            $parametros['BIT_RUTA'] = '/perfil/get_data_ajax_actividad_cuerpo_modal/ insertar';
                            $result = $this->lm->set_bitacora($parametros); //Invoca la función para guardar bitacora
                            //Recargar página despues de 5 segundos
                            echo '<script type="text/javascript">
                                setTimeout("parent.window.location.reload()", 5000);
                                parent.window.location.reload(true);
                            </script>';
                        } else {
                            $valores['error'] = $this->lang->line('interface')['general']['error_guardar']; //Mensaje de que no encontro empleado
                            $valores['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        }
                    } else {//Editar valor actividad docente especificada
                    }
                }
            }
            if ($index_tipo_actividad_docente > 0) {//Checa si debe aparecer el botòn de guardar 
                $valores['identificador'] = $index_tipo_actividad_docente;
                $datos['pie_pag'] = $this->load->view('perfil/actividad_docente/actividad_pie', $valores, true); //Carga la vista correspondiente al index
                //Carga catalogos 
                $datos = carga_catalogos_censo($configuracion_formularios_actividad_docente['catalogos_indexados'], $datos); //Carga los catálogos de la configuración
//            pr($datos);
                echo $this->load->view($configuracion_formularios_actividad_docente['vista'], $datos, TRUE); //Carga la vista correspondiente al index
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
     * @param type $array_validacion
     * @param type $array_componentes
     * @param type $validacion_extra Las validaciones extra estan pensadas más 
     *             para "radio button" validaciones_extra, es un array de reglas 
     *             que se encuentrá en 
     * "config"->"general"->"actividad_docente_componentes"->"validaciones_extra"
     * y son de tipo textuales,
     * @return type
     */
    private function analiza_validacion($array_validacion, $array_componentes, $validacion_extra) {
//        pr($array_componentes);
//        pr($array_validacion);
        $array_result = array();
        foreach ($array_componentes as $key => $value) {
            switch ($key) {
                case 'fecha_inicio_pick'://No carga si no hasta duraciòn 
                    break;
                case 'fecha_fin_pick'://No carga si no hasta duraciòn
                    break;
                case 'hora_dedicadas'://No carga si no hasta duraciòn
                    break;
                case 'duracion':
                    if ($value === 'hora_dedicadas') {
                        $array_result[] = $array_validacion['hora_dedicadas'];
                    } else {//fechas_dedicadas
                        $array_result[] = $array_validacion['fecha_inicio_pick'];
                        $array_result[] = $array_validacion['fecha_fin_pick'];
                    }
                    break;
                default :
                    $array_result[] = $array_validacion[$key];
            }
        }
        //Busca si existen validaciones extra
        foreach ($validacion_extra as $value_extra) {
            if (!array_key_exists($value_extra, $array_componentes)) {
                $array_result[] = $array_validacion[$value_extra];
            }
        }
//        pr($array_result);
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
    private function guardar_actividad($array_propiedades_actividad, $arrar_datos_post = null, $array_elementos_no_post = NULL) {
        if (is_null($arrar_datos_post)) {//si es null returna -1 que indica que no se guardo 
            return -1;
        }
        $entidad_guardado = $array_propiedades_actividad['tabla_guardado']; //Se obtiene el nombre de la entidad de guardado
        
        //Asignar actividad docente general "actividad_docente_general" ********
        $result_id_user = $this->session->userdata('identificador');
        $actividad_docente_general = $this->adm->get_actividad_docente_general($result_id_user);
        if(empty($actividad_docente_general)){
            return -1;
        }else{
        $arrar_datos_post['actividad_docente_general'] = $actividad_docente_general[0]['ACT_DOC_GRAL_CVE']; ;
            
        }
        //Guardar comprobante **************************************************
        if (array_key_exists('text_comprobante', $arrar_datos_post)) {
            $entidad_comprobante = $this->config->item('comprobante'); //Campos de la entidad comprobante del archivo general
            $array_comprobante = array();
            foreach ($entidad_comprobante as $key_com => $value_com) {
                $inser = $value_com['insert']; //Obtiene de archivo "general" los campos de comprobante
                $array_comprobante[$inser] = $arrar_datos_post[$key_com]; //Crea el array para guardar comprobante
            }
            //Guarda comprobante
            $index_comprobante = $this->modPerfil->insert_comprobante($array_comprobante); //Guardar valores en entidad
        }//*********************************************************************
        //Guardar actividad
        $array_entidad_guardado = $this->config->item($entidad_guardado); //Se obtiene los campos de la entidad donde se almacenarán los datos 
//        pr($entidad_guardado);
//        pr($arrar_datos_post);
//        pr($array_entidad_guardado);

        $campos_insert = array();
        $campos_insert['TIP_ACT_DOC_CVE'] = $array_elementos_no_post['TIP_ACT_DOC_CVE'];
        foreach ($arrar_datos_post as $key => $value) {//Genera array de campos y valores para insertar
            switch ($key) {
                case 'comprobante':
                    break;
                case 'ctipo_comprobante':
                    break;
                case 'text_comprobante':
                    if (isset($index_comprobante) && $index_comprobante > 0) {
                        //Asigna valor de comprobante
                        $keys_ = $array_entidad_guardado['comprobante']['insert'];
                        $campos_insert[$keys_] = $index_comprobante; //Asigna el valor de comprobante
                    }
                    break;
                case 'fecha_inicio_pick':
                    break;
                case 'fecha_fin_pick':
                    break;
                case 'duracion':
                    if ($value === 'hora_dedicadas') {
                        $keys_ = $array_entidad_guardado['hora_dedicadas']['insert'];
                        $campos_insert[$keys_] = $arrar_datos_post['hora_dedicadas'];
                    } else {
                        $keys_ = $array_entidad_guardado['fecha_inicio_pick']['insert'];
                        $campos_insert[$keys_] = $arrar_datos_post['fecha_inicio_pick'];
                        $keys_ = $array_entidad_guardado['fecha_fin_pick']['insert'];
                        $campos_insert[$keys_] = $arrar_datos_post['fecha_fin_pick'];
                    }
                    break;
                default :
                    $keys_ = $array_entidad_guardado[$key]['insert'];
                    $campos_insert[$keys_] = $value;
            }
        }
        
        //Agrega campos que no se optienen por post como tipo_actividad_cve 
        $result = $this->adm->insert_emp_actividad_docente_gen($entidad_guardado, $campos_insert); //Guardar valores en entidad
        return $result;
//        pr($entidad_guardado);
//        pr($campos_insert);
        return -1;
    }

    private function cargar_comprobante() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '20000';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
        } else {

            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];
        }
    }

}
