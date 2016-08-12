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
        $this->load->model('Investigacion_docente_model', 'idm');
		$this->load->model('Becas_comisiones_laborales_model', 'bcl');
        $this->load->model('Material_educativo_model', 'mem');
        $this->load->library('Ventana_modal');
        $this->load->config('general');
        //$this->lang->load('interface');
    }

    /**
     * 
     * @author Ricardo Sanchez S
     */
    public function index() {
       //echo "SOY UN INDEX....";
        $rol_seleccionado = $this->session->userdata('rol_seleccionado'); //Rol seleccionado de la pantalla de roles
//        pr($rol_seleccionado);
        $array_menu = get_busca_hijos($rol_seleccionado, $this->uri->segment(1));
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['perfil'];
        $id_usuario = $this->session->userdata('identificador');
        $datosPerfil['array_menu'] = $array_menu;
        
        //modificar formatos
        setlocale(LC_ALL,'es_ES'); 
        $upDate = $this->modPerfil->get_fecha_ultima_actualizacion($id_usuario)->fecha_bitacora;
        $datosPerfil['fecha_ultima_actualizacion'] = $string_values['span_fecha_last_update'] . strftime("%d de %B de %G a las %H:%M:%S", strtotime($upDate));
        //pr($datosPerfil);

        $main_content = $this->load->view('perfil/index', $datosPerfil, true);
        $this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    
    /**/
    public function seccion_info_general(){
        $data = array();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['perfil'];
        $id_usuario = $this->session->userdata('identificador');
       
        /*Esto es de información general*/
        if ($this->input->post()) {
            //pr("Validating-data, Saving-data");
            //pr($this->input->post());
            $this->load->model("Registro_model","reg");
            $empData = $this->input->post();
            foreach($empData as $key=>$field){
                if(empty($field)){
                    unset($empData[$key]);
                }
            }
            $id = $empData["EMPLEADO_CVE"];
            unset($empData["EMPLEADO_CVE"]);
            //pr($empData);
            //echo $this->reg->update_registro_empleado($empData,$id);
            if($this->reg->update_registro_empleado($empData,$id) == 1){
                print("<h1>Cambio realizado correctamente</h1>");
            }
        }
           // pr("Just showing a preview");
            $datosPerfil = $this->loadInfo($id_usuario);
            
            $this->load->library("curp");
            $this->curp->setCURP($datosPerfil["curp"]);
            //solo se manda el combo de sexo cuando es el usuario admin
            $datosPerfil['genero'] = $this->curp->getGenero();
            $datosPerfil['edad'] = $this->curp->getEdad();
            $datosPerfil['estadosCiviles'] = dropdown_options($this->modPerfil->getEstadoCivil(), 'CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE');
            $datosPerfil['formacionProfesionalOptions'] = array();
            $datosPerfil['tipoComprobanteOptions'] = array();
            
            $datosPerfil['antiguedad'] = explode('_',$datosPerfil['antiguedad']);
            
            //pr($datosPerfil);
            $this->load->view('perfil/informacionGeneral', $datosPerfil, FALSE); //Valores que muestrán la lista  
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
//        pr($_SERVER);
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
            $data['curso_principal_entidad_contiene'] = $actividad_docente[0]['TIP_ACT_DOC_PRINCIPAL_CVE']; //Entidad que contiene el curso principal
            $data['datos_tabla_actividades_docente'] = $this->adm->get_actividades_docente($actividad_docente[0]['ACT_DOC_GRAL_CVE']); //Datos de las tablas emp_actividad_docente, emp_educacion_distancia, emp_esp_medica
//            pr($data['datos_tabla_actividades_docente']);
        }

        $this->load->view('perfil/actividad_docente/actividad_tpl', $data, FALSE);
    }
    
    ////////////////////////Inicio Dirección de tesis ////////////////////////
    public function ajax_direccion_tesis(){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            
            $this->lang->load('interface');
            $data['string_values'] = array_merge($this->lang->line('interface')['direccion_tesis'], $this->lang->line('interface')['general']);
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $empleado = $this->cg->getDatos_empleado($result_id_user); //Obtenemos datos del empleado
            
            if (!empty($empleado)) {//Si existe un empleado, obtenemos datos
                $this->load->model('Direccion_tesis_model', 'dt');
                $data['lista_direccion'] = $this->dt->get_lista_datos_direccion_tesis(array('conditions'=>array('EMPLEADO_CVE'=>$empleado[0]['EMPLEADO_CVE'], 'TIP_COMISION_CVE'=>$this->config->item('tipo_comision')['DIRECCION_TESIS']['id'])));
                //pr($data);
                echo $this->load->view('perfil/direccionTesis', $data, true); //Valores que muestrán la lista
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function direccion_tesis_formulario($identificador = null){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            $this->load->model('Direccion_tesis_model', 'dt');
            $this->lang->load('interface');
            $data['identificador'] = $identificador;
            $dt_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la comisión
            $data['idc'] = $this->input->post('idc', true); //Campo necesario para mostrar link de comprobante
            $data['string_values'] = array_merge($this->lang->line('interface')['direccion_tesis'], $this->lang->line('interface')['general'], $this->lang->line('interface')['error']);

            $entidades_ = array(enum_ecg::comision_area, enum_ecg::ctipo_comprobante, enum_ecg::cnivel_academico);
            $data['catalogos'] = carga_catalogos_generales($entidades_, null, null);
            if(!is_null($this->input->post()) && !empty($this->input->post())){ //Se verifica que se haya recibido información por método post
                $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
                
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_direccion_tesis'); //Obtener validaciones de archivo general
                $this->form_validation->set_rules($validations); //Añadir validaciones

                if($this->form_validation->run() == TRUE ){ //Validar datos
                    $datos_formulario['tipo_comision'] = $this->config->item('tipo_comision')['DIRECCION_TESIS']['id'];
                    $datos_formulario['empleado'] = $this->session->userdata('idempleado');
                    $data_com = $this->emp_comision_fac($datos_formulario); //Generar objeto para almacenar
                    if(empty($data['identificador'])){ //Insertar
                        $resultado_almacenado = $this->dt->insert_comision($data_com);
                        $data['identificador'] = $this->seguridad->encrypt_base64($resultado_almacenado['data']['identificador']); //Obtenemos identificador de registro aceptado y se encripta
                    } else { //Actualización
                        $resultado_almacenado = $this->dt->update_comision($dt_id, $data_com);
                    }
                    //////Inicio actualizar comprobante
                    $this->load->model('Administracion_model','admin');
                    if(!empty($datos_formulario['idc'])){
                        $resultado_almacenado = $this->admin->update_comprobante($this->seguridad->decrypt_base64($data['idc']), array('TIPO_COMPROBANTE_CVE'=>$datos_formulario['tipo_comprobante']));
                    }
                    //////Fin actualizar comprobante
                    $data['msg'] = imprimir_resultado($resultado_almacenado); ///Muestra mensaje
                }
            }
            if(!is_null($identificador)){ ///En caso de que se haya elegido alguna convocatoria                
                $data['dir_tes'] = $this->dt->get_lista_datos_direccion_tesis(array('conditions'=>array('EMP_COMISION_CVE'=>$dt_id)))[0]; //Obtener datos
            } else {
                $data['dir_tes'] = (array)$this->emp_comision_fac(array('tipo_comision'=>$this->config->item('tipo_comision')['DIRECCION_TESIS']['id'])); //Generar objeto para ser enviado al formulario
            }
            $data['formulario_carga_archivo'] = $this->load->view('template/formulario_carga_archivo', $data, TRUE);
            $data = array(
                'titulo_modal' => $data['string_values']['title'],
                'cuerpo_modal' => $this->load->view('perfil/direccionTesis/direccion_tesis_formulario', $data, TRUE)
            );

            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
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
    public function eliminar_direccion_tesis($identificador){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            $this->load->model('Direccion_tesis_model', 'dt');
            $datos['identificador'] = $identificador; //Identificador de dirección de tesis
            $datos['msg'] = null;
            $dt_id = $this->seguridad->decrypt_base64($identificador); //Identificador de la dirección de tesis
            $idempleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable
            
            //$datos['string_values'] = $this->lang->line('interface')['general']; //Cargar textos utilizados en vista

            $resultado = $this->dt->delete_comision(array('conditions'=>array('EMP_COMISION_CVE'=>$dt_id))); //Eliminar datos
            //pr($resultado);            
            $this->eliminar_archivo(array('archivo'=>$resultado['data']['COM_NOMBRE'], 'matricula'=>$this->session->userdata('matricula')));
            
            echo json_encode($resultado); ///Muestra mensaje
            exit();
            //echo $this->load->view('evaluacion/convocatoria/dictamen_listado', $datos, true);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }
    
    /**
     * Función que elimina un archivo
     * @method: void eliminar_archivo()
     * @param: $data['archivo']   string     Nombre del archivo
     * @param: $data['matricula']   string      Matrícula del empleado
     * @author: Jesús Z. Díaz P.
     */
    private function eliminar_archivo($data){
        $resultado = false;
        //pr($data);
        if(isset($data['archivo']) && !empty($data['archivo'])){ //Eliminar archivo
            $ruta = $this->config->item('upload_config')['comprobantes']['upload_path']; //Path de archivos
            //pr($ruta);
            $ruta_archivo = $ruta.$this->seguridad->encrypt_carpeta_nombre($data['matricula'])."/".$data['archivo']; ///Definir ruta de almacenamiento, se utiliza la matricula
            //pr($ruta_archivo);
            if(file_exists($ruta_archivo)){
                unlink($ruta_archivo);
                $resultado = true;
            }
        }
        return $resultado;
    }
    
    /////////////////////////Fin dirección de tesis //////////////////////////

    public function get_data_ajax_liscta_actividades() {
        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
        $actividad_docente = $this->adm->get_actividad_docente_general($result_id_user); //Verifica si existe el ususario ya contiene datos de actividad
        $string_values = $this->lang->line('interface')['actividad_docente'];
        $data['string_values'] = $string_values;
        if (!empty($actividad_docente)) {
//            pr($actividad_docente);
            $data['curso_principal'] = $actividad_docente[0]['CURSO_PRINC_IMPARTE']; //Identificador del curso principal 
            $data['curso_principal_entidad_contiene'] = $actividad_docente[0]['TIP_ACT_DOC_PRINCIPAL_CVE']; //Entidad que contiene el curso principal
            $data['datos_tabla_actividades_docente'] = $this->adm->get_actividades_docente($actividad_docente[0]['ACT_DOC_GRAL_CVE']); //Datos de las tablas emp_actividad_docente, emp_educacion_distancia, emp_esp_medica
        }
        echo $this->load->view('perfil/actividad_docente/tabla_actividades_docentes', $data, FALSE);
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
//                $tipo_actividad_docente = $this->cg->get_tipo_actividad_docente(); //Obtiene tipos de actividad del docente
//                $data_actividad['tipo_actividad_docente'] = dropdown_options($tipo_actividad_docente, 'TIP_ACT_DOC_CVE', 'TIP_ACT_DOC_NOMBRE'); //Indicamos que muestré los siguientes datos index y descripción
                $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE < ' => 15));
                $data_actividad = carga_catalogos_generales(array(enum_ecg::ctipo_actividad_docente), $data_actividad, $condiciones_);
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
//                pr('que traes $_FILES');
//                pr($this->input->post());
//                pr($_FILES);
//                pr('fin ------------>');
//                exit();

                $datos_registro = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_ccl'); //Obtener validaciones de archivo
                $valores['mostrar_hora_fecha_duracion'] = $this->get_valor_validacion($datos_registro, 'duracion'); //Muestrá validaciones de hora y fecha de inicio y termino según la opción de duración
                $array_validaciones_extra_actividad = $configuracion_formularios_actividad_docente['validaciones_extra']; //Carga las validaciones extrá de archivo config->general que no se pudieron automatizar con el post, es decir radio button etc
                $result_validacion = $this->analiza_validacion_actividades_docentes($validations, $datos_registro, $array_validaciones_extra_actividad); //Genera las validaciones del formulario que realmente deben ser tomadas en cuenta
                $validations = $result_validacion['validacion'];
                $this->form_validation->set_rules($validations); //Carga las validaciones
//                pr($result_validacion['fechas']);
//                if (!empty($result_validacion['fechas'])) {//Si hay fechas que validar, se modifican los datos de fechas ya volteadas
//                    $this->form_validation->set_data($result_validacion['fechas']); //Carga las validaciones
//                }

                if ($this->form_validation->run()) {//Ejecuta validaciones
                    if ($id_tipo_actividad === '0') {//Guardar un nuevo registro
                        $result_guardar_actividad = $this->guardar_actividad($configuracion_formularios_actividad_docente, $datos_registro, array('TIP_ACT_DOC_CVE' => $index_tipo_actividad_docente));
//                      $result_guardar_actividad = -1;
                        $resultado = array();
                        if (is_array($result_guardar_actividad)) {//Se guardo correctamente, asignna mensaje success y registra en bitacora
                            $resultado['error'] = $this->lang->line('interface')['general']['datos_almacenados_correctamente']; //Mensaje de que no encontro empleado
                            $resultado['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                            //Guarda bitacora
                            //Datos de bitacora el actividad general del docente del usuario
                            $result_id_user = $this->session->userdata('identificador'); //Asigna id del usuario
                            $entity = $configuracion_formularios_actividad_docente['tabla_guardado'];
                            $pk = $configuracion_formularios_actividad_docente['llave_primaria'];
                            $index_pk = $result_guardar_actividad[$entity][$pk];
                            $json = json_encode($result_guardar_actividad);
                            $result = registro_bitacora($result_id_user, null, $entity, $pk . "-" . $index_pk, $json, 'insert');

                            //Cargar comprobante 
                            $config['upload_path'] = './uploads/';
                            $config['allowed_types'] = 'pdf';
                            $config['remove_spaces'] = TRUE;
                            $config['max_size'] = '9000';
                            $config['file_name'] = 'algo_nada';


                            $this->load->library('upload', $config);
                            if (!$this->upload->do_upload('')) {
                                $data['error'] = $this->upload->display_errors();
                            } else {
                                $file_data = $this->upload->data();
                                $data['file_path'] = './uploads/' . $file_data['file_name'];
                            }
//                            pr($datos_registro);
//                            pr($data);
                            //obtener datos del último registro guardado en la entidad correspondiente
                            $entidad_guardado = $configuracion_formularios_actividad_docente['tabla_guardado'];
//                            pr($entidad_guardado);
//                            pr( $result_guardar_actividad);
                            $rs = $this->adm->get_datos_actividad_docente($entidad_guardado, $index_pk);
//                            pr($rs);
                            $resultado['insertar'] = $rs;
                        } else {
                            $resultado['error'] = $this->lang->line('interface')['general']['error_guardar']; //Mensaje de que no encontro empleado
                            $resultado['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        }

                        echo json_encode($resultado);
                        exit();
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
    private function analiza_validacion_actividades_docentes($array_validacion, $array_componentes, $validacion_extra) {
        pr($array_componentes);
//        pr($array_validacion);
        $array_result = array();
        foreach ($array_componentes as $key => $value) {
            switch ($key) {
                case 'enctype':
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
                    } else {//fechas_dedicadas
                        $array_result['validacion'][] = $array_validacion['fecha_inicio_pick'];
                        $array_result['validacion'][] = $array_validacion['fecha_fin_pick'];
                    }
                    break;
                default :
//                    pr($key);
                    $array_result['validacion'][] = $array_validacion[$key];
            }
        }
        //Busca si existen validaciones extra
        foreach ($validacion_extra as $value_extra) {
            if (!array_key_exists($value_extra, $array_componentes)) {
                $array_result['validacion'][] = $array_validacion[$value_extra];
            }
        }
//        $array_result['fechas'] = $array_fechas;
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
        $entidad_guardado_pk = $array_propiedades_actividad['llave_primaria']; //Se obtiene la llave primaria de la entidad de guardado
        //Asignar actividad docente general "actividad_docente_general" ********
        $result_id_user = $this->session->userdata('identificador');
        $actividad_docente_general = $this->adm->get_actividad_docente_general($result_id_user);
        if (empty($actividad_docente_general)) {
            return -1;
        } else {
            $arrar_datos_post['actividad_docente_general'] = $actividad_docente_general[0]['ACT_DOC_GRAL_CVE'];
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
            $index_comprobante = $this->cg->insert_comprobante($array_comprobante); //Guardar valores en entidad
//            $res = guardar_archivos('algo_pasara', 'file');
//            $res = $this->cargar_comprobante($arrar_datos_post);
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
                case 'enctype':
                    break;
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
        $result = $this->adm->insert_emp_actividad_docente_gen($entidad_guardado, $campos_insert, $entidad_guardado_pk); //Guardar valores en entidad
        return $result;
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
        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
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


//        $actividad_docente = $this->adm->get_actividad_docente_general($result_id_user); //Verifica si existe el ususario ya contiene datos de actividad
//        if (!empty($actividad_docente)) {//Verifica datos del usuario, es decir, que exista un registro en la tabla actividad_docente_gral
//            $data['actividad_general_cve'] = $actividad_docente[0]['ACT_DOC_GRAL_CVE'];
//            $data['index_tp_actividad'] = $index_tp_actividad; //Envía index de actividad a la vista 
//            $data['index_entidad'] = $index_entidad; //Envía index de entidad a la vista 
//            $data['is_cur_principal'] = $is_cur_principal; //Envía si es curso principal a la vista
//            if ($is_cur_principal === '1') {//Valida que no sea un curso principal
//                //Curso principal
//                $valor_msj = str_replace('[field]', $texto_tipo_actividad, $string_values['lbl_info_no_elimina_actividad_curso_principal']); //Agrega nombre de la actividad de docente
//                $data['error'] = $valor_msj; //Mensaje de que es curso principal, por lo tanto, no se puede eliminar la actividad 
//                $data['tipo_msg'] = $tipo_msg['WARNING']['class']; //Tipo de mensaje de error
//            } else {
//                //Confirmar que desea eliminar curso
//                $data['pregunta'] = str_replace('[field]', $texto_tipo_actividad, $string_values['lbl_pregunta_eliminar_actividad_docente']);
//            }
//        } else {
//            $data['error'] = $string_values['error_no_registro']; //Mensaje de que no encontró de actividad docente general para el usuario
//        }
//
//        $vista = array(
//            'titulo_modal' => 'Eliminar actividad docente',
//            'cuerpo_modal' => $this->load->view('perfil/actividad_docente/actividad_eliminar_tpl', $data, TRUE),
//        );
//        echo $this->ventana_modal->carga_modal($vista); //Carga los div de modal
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
            pr($this->input->post());
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
            pr($this->upload->data());
            return $data;
        }
    }

//********************Investigación educativa ******************************************************************************/
    public function ajax_investigacion() {
        $data = array();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['investigacion_docente'];
        $data['string_values'] = $string_values;
        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
        $empleado = $this->cg->getDatos_empleado($result_id_user); //Obtenemos datos del empleado
        if (!empty($empleado)) {//Si existe un empleado, obtenemos datos
            $this->load->model('Investigacion_docente_model', 'id');
            $lista_investigacion = $this->id->get_lista_datos_investigacion_docente($empleado[0]['EMPLEADO_CVE']);
            $data['lista_investigaciones'] = $lista_investigacion;
            $this->load->view('perfil/investigacion/investigacion_tpl', $data, FALSE); //Valores que muestrán la lista
        } else {
            //Error, No existe el empleado
        }
        //Consulta datos de empleado en investigación
    }

    public function ajax_cargar_formulario_investigacion() {
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
                'cuerpo_modal' => $this->load->view('perfil/investigacion/investigacion_formulario', $data_investigacion, TRUE),
                'pie_modal' => $this->load->view('perfil/investigacion/investigacion_pie', $datos_pie, true)
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
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
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable
            $datos_pie = array(); //Asignamos id usuario a variable

            if ($this->input->post()) {//Después de cargar el formulario
//                pr($this->input->post());
                $datos_registro = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_investigacion_docente'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_investigacion_docente($validations, $datos_registro, $_FILES);
                $array_to_json = array(); //name_entidad => array(campos con valores)
                $array_operacion_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
//                pr($datos_registro);
                $divulgacion = $datos_registro['cmedio_divulgacion']; //Para mostrar los divs de bibliografia o comprobante
//                pr($validations['emp_act_inv_edu_inser']);
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    $validations['emp_act_inv_edu_inser']['EMPLEADO_CVE'] = $result_id_empleado; //Asigna empleado
                    if (isset($validations['comprobante'])) {//Si existe el comprobante
                        $id_inv = $this->idm->get_ultimo_registro_investigacion($result_id_empleado); //Último registro para hacerlo parte del nombre del comprobante
                        $id_inv = intval($id_inv) + 1;
                        $name_comprobante = 'investigacion_' . $matricula_user . '_' . $datos_registro['ctipo_estudio'] . '_' . $id_inv . '_' . $datos_registro['ctipo_comprobante'] . '_' . rand(10, 2000); //Asigna_nombre del comprobante
                        $validations['comprobante'][$this->config->item('comprobante')['text_comprobante']['insert']] = $name_comprobante;
                        $index_comprobante = $this->cg->insert_comprobante($validations['comprobante']);
                        if ($index_comprobante > 0) {//el comprobante se guardo correctamente
                            $validations['comprobante']['COMPROBANTE_CVE'] = $index_comprobante; //Agrega identificador del registro de comprobante 
                            $validations['emp_act_inv_edu_inser'][$this->config->item('emp_act_inv_edu')['comprobante']['insert']] = $index_comprobante; //Agrega index del comprobante a a la tabla de investigación
                            $array_to_json['comprobante'] = $validations['comprobante']; //Pertenece a bitacora comprobante
                            $array_operacion_entidades['comprobante'] = 'insert-' . $index_comprobante; //Pertenece a bitacora agrega index
                            $this->guardar_archivo($name_comprobante); //Guarda el comprobante
                        }
                        $result_insert_investigacion = $this->idm->insert_investigacion_docente($validations['emp_act_inv_edu_inser']); //Inserta investigación 
                    } else {
                        $result_insert_investigacion = $this->idm->insert_investigacion_docente($validations['emp_act_inv_edu_inser']); //Inserta investigación 
                    }

                    if ($result_insert_investigacion > 0) {//se inserto correctamente, se debe registrar en bitacora
                        $validations['emp_act_inv_edu_inser']['EAID_CVE'] = $result_insert_investigacion; //Agrega identificador del registro de investigación insertado 

                        $array_to_json['emp_act_inv_edu'] = $validations['emp_act_inv_edu_inser']; //Pertenece a bitacora
                        $array_operacion_entidades['emp_act_inv_edu'] = 'insert-' . $result_insert_investigacion; //Pertenece a bitacora

                        $json_datos_entidad = json_encode($array_operacion_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_to_json); //Codifica a json la actualización o insersión a las entidades involucradas
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);


                        $rs = $this->idm->get_datos_investigacion_docente($result_insert_investigacion);
                        if (!empty($rs[0]['cita_publicada'])) {
                            $rs[0]['comprobante_cve'] = 0;
                            $rs[0]['tiene_publicacion'] = $string_values['text_con_cita'];
                        } else {
                            $rs[0]['tiene_publicacion'] = $string_values['text_sin_cita'];
                        }
//                            pr($rs);
                        $resultado['result_datos'] = $rs;
                        $resultado['error'] = $string_values['insert_investigacion_docente']; //
                        $resultado['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                    } else {//No se pudo registrar los datos de investigación
                        $resultado['error'] = $string_values['error_investigacion_docente_insert']; //
                        $resultado['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    }
                    echo json_encode($resultado);
                    exit();
                }//*************************Termina bloque de insertar nueva investigación
            }

            $data_investigacion['divulgacion'] = $divulgacion; //Crea la variable 
            $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE > ' => 14));
            $entidades_ = array(enum_ecg::ctipo_actividad_docente, enum_ecg::ctipo_comprobante, enum_ecg::ctipo_participacion, enum_ecg::ctipo_estudio, enum_ecg::cmedio_divulgacion);
            $data_investigacion = carga_catalogos_generales($entidades_, $data_investigacion, $condiciones_);


            echo $this->load->view('perfil/investigacion/investigacion_formulario', $data_investigacion, TRUE);
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
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula');
            $datos_pie = array();
//            pr($this->input->post());
            if ($this->input->post()) {
                $datos_registro = $this->input->post(null, true);
                if (isset($datos_registro['cve_inv'])) {
                    $datos_pie['cve_inv'] = $datos_registro['cve_inv'];
                    $datos_pie['idrow'] = $datos_registro['idrow'];
                    $datos_pie['comprobantecve'] = $datos_registro['comprobantecve'];
                    $data_investigacion['select_inv'] = $this->idm->get_datos_investigacion_docente(intval($datos_registro['cve_inv'])); //Variable que carga los datos del registro de investigación, será enviada a la vista para cargar los datos
                    $divulgacion = $data_investigacion['select_inv'][0]['med_divulgacion_cve'];
                }
            }

            $data_investigacion['divulgacion'] = $divulgacion; //Crea la variable 
            $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE > ' => 14));
            $entidades_ = array(enum_ecg::ctipo_actividad_docente, enum_ecg::ctipo_comprobante, enum_ecg::ctipo_participacion, enum_ecg::ctipo_estudio, enum_ecg::cmedio_divulgacion);
            $data_investigacion = carga_catalogos_generales($entidades_, $data_investigacion, $condiciones_);

            $data = array(
                'titulo_modal' => 'Investigación',
                'cuerpo_modal' => $this->load->view('perfil/investigacion/investigacion_formulario', $data_investigacion, TRUE),
                'pie_modal' => $this->load->view('perfil/investigacion/investigacion_pie', $datos_pie, true)
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
            $divulgacion = '';
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable
            if ($this->input->post()) {//Después de cargar el formulario
                $datos_registro = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $val = $this->config->item('form_investigacion_docente'); //Obtener validaciones de archivo
                $validations = $this->analiza_validacion_investigacion_docente($val, $datos_registro, $_FILES);
                $array_to_json = array(); //name_entidad => array(campos con valores)
                $array_operacion_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
//                pr($datos_registro);
//                pr($validations);
                //Parametros iniciales que deben persistir en el botón de actualización
                $divulgacion = $datos_registro['cmedio_divulgacion']; //Variable que carga los datos del registro de investigación, será enviada a la vista para cargar los datos
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) {//Si pasa todas las validaciones, actualizar
                    $id_comprobante = intval($datos_registro['comprobantecve']);
                    if ($divulgacion < 3) {//Guardar o actualiza comprobante
                        if ($id_comprobante > 0) {//UPDATE Existe comprobante actualiza
                            $datos_comprobante_actual = $this->cg->get_comprobante($id_comprobante); //Seobtienen los datos del comprobante actual
                            //Generamos el nombre del nuevo comprobante
                            $id_inv = $this->idm->get_ultimo_registro_investigacion($result_id_empleado); //Último registro para hacerlo parte del nombre del comprobante
                            $id_inv = intval($id_inv) + 1;
                            $name_comprobante = 'investigacion_' . $matricula_user . '_' . $datos_registro['ctipo_estudio'] . '_' . $id_inv . '_' . $datos_registro['ctipo_comprobante'] . '_' . rand(10, 2000); //Asigna_nombre del comprobante
                            $validations['comprobante'][$this->config->item('comprobante')['text_comprobante']['insert']] = $name_comprobante;

                            $update_comprobante = $this->cg->update_comprobante($id_comprobante, $validations['comprobante']);
                            if ($update_comprobante['result'] > 0) {//La actualización de la bitacora se efectuo correctamente
                                //Registro bitacora
                                $array_to_json['comprobante'] = $update_comprobante['entidad']; //Pertenece a bitacora comprobante
                                $array_operacion_entidades['comprobante'] = 'update-' . intval($datos_registro['comprobantecve']); //Pertenece a bitacora agrega index
                                //Se elimina el archivo relacionado al comprobante, y se carga el nuevo archivo, o solo se sobreescribe 
                                $config_comprobante = $this->config->item('upload_config')['comprobantes']; //Carga configuración para subir archivo comprobante
                                $path = $config_comprobante['upload_path']; //obtiene el path donde se guarda los comprobantes 
                                eliminar_archivo($path, $datos_comprobante_actual[0]['COM_NOMBRE']);
                                //Se guarda el nuevo comprobante
                                $this->guardar_archivo($name_comprobante); //Guarda el comprobante
                            }
                        } else {//INSERT No existe comprobante, inserta
                            //Generamos el nombre del nuevo comprobante
                            $id_inv = $this->idm->get_ultimo_registro_investigacion($result_id_empleado); //Último registro para hacerlo parte del nombre del comprobante
                            $id_inv = intval($id_inv) + 1;
                            $name_comprobante = 'investigacion_' . $matricula_user . '_' . $datos_registro['ctipo_estudio'] . '_' . $id_inv . '_' . $datos_registro['ctipo_comprobante'] . '_' . rand(10, 2000); //Asigna_nombre del comprobante
                            $validations['comprobante'][$this->config->item('comprobante')['text_comprobante']['insert']] = $name_comprobante;

                            $index_comprobante = $this->cg->insert_comprobante($validations['comprobante']);
                            if ($index_comprobante > 0) {//La insersion  de la bitacora se efectuo correctamente
                                $validations['comprobante']['COMPROBANTE_CVE'] = $index_comprobante; //Agrega identificador del registro de comprobante 
                                $array_to_json['comprobante'] = $validations['comprobante']; //Pertenece a bitacora comprobante
                                $array_operacion_entidades['comprobante'] = 'insert-' . $index_comprobante; //Pertenece a bitacora agrega index
                                $validations['emp_act_inv_edu_update'][$this->config->item('emp_act_inv_edu')['insert']] = $index_comprobante; //Asigna comprobante a la entidad para actualizar
                                //Carga el archivo pdf comprobante al directorio de archivos
                                $this->guardar_archivo($name_comprobante); //Guarda el comprobante
                            }
                        }
                    } else {//Validación para eliminar comprobante
                        if ($id_comprobante > 0) {//DELETE Existe comprobante lo elimina
                            $datos_comprobante_actual = $this->cg->get_comprobante($id_comprobante); //Seobtienen los datos del comprobante actual
                            $config_comprobante = $this->config->item('upload_config')['comprobantes']; //Carga configuración para subir archivo comprobante
                            $path = $config_comprobante['upload_path']; //obtiene el path donde se guarda los comprobantes 
                            eliminar_archivo($path, $datos_comprobante_actual[0]['COM_NOMBRE']); //Elimina archivo
                        }
                    }
//                            pr($validations['emp_act_inv_edu_update']);
//                            pr($datos_registro['cve_inv']);
                    //Actualiza datos de investigación
                    $result_actualizacion_investigacion_docente = $this->idm->update_investigacion_docente(intval($datos_registro['cve_inv']), $validations['emp_act_inv_edu_update']);
                    if ($result_actualizacion_investigacion_docente['result'] > 0) {
                        $array_to_json['emp_act_inv_edu'] = $result_actualizacion_investigacion_docente['entidad']; //Pertenece a bitacora comprobante
                        $array_operacion_entidades['emp_act_inv_edu'] = 'update-' . intval($datos_registro['cve_inv']); //Pertenece a bitacora agrega index
                        if (isset($borrar_comprobante)) {//Borrar comprobante, si existe la variable $borrar_comprobante 
                            $delete_comprobante = $this->cg->delete_comprobante($borrar_comprobante); //Elimina comprobante
                            if ($delete_comprobante['result'] > 0) {//Si se elimino correctamente, agrega a bitacora la acción
                                $array_to_json['comprobante'] = $delete_comprobante['entidad']; //Pertenece a bitacora comprobante
                                $array_operacion_entidades['comprobante'] = 'delete-' . $borrar_comprobante; //Pertenece a bitacora agrega index
                                //Elimina archivo de del servidor ........
                            }
                        }
                        //Registra bitacora
                        $json_datos_entidad = json_encode($array_operacion_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_to_json); //Codifica a json la actualización o insersión a las entidades involucradas
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);

                        $rs = $this->idm->get_datos_investigacion_docente(intval($datos_registro['cve_inv']));
                        if (!empty($rs[0]['cita_publicada'])) {
                            $rs[0]['comprobante_cve'] = 0;
                            $rs[0]['tiene_publicacion'] = $string_values['text_con_cita'];
                        } else {
                            $rs[0]['tiene_publicacion'] = $string_values['text_sin_cita'];
                        }
//                                $resultado['result_datos'] = $result_actualizacion_investigacion_docente['entidad'];
                        $resultado['result_datos'] = $rs;
                        $resultado['idrow'] = $datos_registro['idrow'];
                        $resultado['error'] = $string_values['update_investigacion_docente']; //
                        $resultado['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                    } else {
                        $resultado['error'] = $string_values['error_investigacion_docente_update']; //
                        $resultado['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    }
                    echo json_encode($resultado);
                    exit();
                }
            }

            $data_investigacion['divulgacion'] = $divulgacion; //Crea la variable 
            $condiciones_ = array(enum_ecg::ctipo_actividad_docente => array('TIP_ACT_DOC_CVE > ' => 14));
            $entidades_ = array(enum_ecg::ctipo_actividad_docente, enum_ecg::ctipo_comprobante, enum_ecg::ctipo_participacion, enum_ecg::ctipo_estudio, enum_ecg::cmedio_divulgacion);
            $data_investigacion = carga_catalogos_generales($entidades_, $data_investigacion, $condiciones_);

            echo $this->load->view('perfil/investigacion/investigacion_formulario', $data_investigacion, TRUE); //Carga los div de modal
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
    private function analiza_validacion_investigacion_docente($array_validaciones, $array_elementos_post, $file) {
//        pr($array_validaciones);
//        pr($array_elementos_post);
        $array_result = array();
        $emp_act_inv_edu = $this->config->item('emp_act_inv_edu'); //Campos de la tabla
        $comprobante = $this->config->item('comprobante'); //Campos de la tabla
        foreach ($array_elementos_post as $key => $value) {
//            pr('..... <<<<>>>>'.$key);
            switch ($key) {
                case 'invcve':
                    break;
                case 'carga_file':
                    break;
                case 'userfile':
                    break;
                case 'comprobantecve':
                    break;
                case 'idrow':
                    break;
                case 'cve_inv':
                    break;
                case 'carga_datos':
                    break;
                case 'bibliografia_revista':
                    break;
                case 'bibliografia_libro':
                    break;
                case 'ctipo_comprobante':
                    break;
                case 'text_comprobante':
                    break;
                case 'cmedio_divulgacion'://Sólo en divulgación existen algunas reglas de negoció en cuanto a publicación o comprobante
                    $array_result['validacion'][] = $array_validaciones['cmedio_divulgacion'];
                    $array_result['emp_act_inv_edu_inser'][$emp_act_inv_edu['cmedio_divulgacion']['insert']] = $array_elementos_post['cmedio_divulgacion'];
                    $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu['cmedio_divulgacion']['insert']] = $array_elementos_post['cmedio_divulgacion'];
                    if (!empty($value)) {
                        switch ($value) {
                            case 3://Revista
                                $array_result['validacion'][] = $array_validaciones['bibliografia_revista'];
                                $array_result['emp_act_inv_edu_inser'][$emp_act_inv_edu['bibliografia_revista']['insert']] = $array_elementos_post['bibliografia_revista'];
                                $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu['comprobante']['insert']] = NULL;
                                $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu['bibliografia_libro']['insert']] = $array_elementos_post['bibliografia_revista'];
                                break;
                            case 4://Libro
                                $array_result['validacion'][] = $array_validaciones['bibliografia_libro'];
                                $array_result['emp_act_inv_edu_inser'][$emp_act_inv_edu['bibliografia_libro']['insert']] = $array_elementos_post['bibliografia_libro'];
                                $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu['bibliografia_libro']['insert']] = $array_elementos_post['bibliografia_libro'];
                                $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu['comprobante']['insert']] = NULL;
                                break;
                            default ://Comprobante
                                $array_result['validacion'][] = $array_validaciones['ctipo_comprobante'];
                                $array_result['validacion'][] = $array_validaciones['text_comprobante'];
                                $array_result['comprobante'][$comprobante['ctipo_comprobante']['insert']] = $array_elementos_post['ctipo_comprobante'];
                                $array_result['comprobante'][$comprobante['text_comprobante']['insert']] = $array_elementos_post['text_comprobante'];
                                $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu['bibliografia_revista']['insert']] = NULL;
                                $file_cargado = ($_FILES) ? TRUE : FALSE;
                                if (isset($file) AND intval($file['file']['error']) > 0) {//Si file o, hubo un error, error = 0 = no hubo error, mayor que ceroalgo paso
                                    $array_result['validacion'][] = $array_validaciones['carga_file'];
                                }
                        }
                    }
                    break;
                default :
//                    pr($key);
                    $array_result['validacion'][] = $array_validaciones[$key];
                    $array_result['emp_act_inv_edu_inser'][$emp_act_inv_edu[$key]['insert']] = $value;
                    $array_result['emp_act_inv_edu_update'][$emp_act_inv_edu[$key]['insert']] = $value;
            }
        }

//      pr($array_result);
        return $array_result;
    }

    public function get_data_ajax_eliminar_investigacion() {
        $datos_registro = $this->input->post(null, true);
        $data = array();
        $tipo_msg = $this->config->item('alert_msg');
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['investigacion_docente'];

        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
//        $data['borrado_correcto'] = 0;
//        $data['error'] = $datos_registro;
////        $data['tipo_msg'] = $tipo_msg['SUCCESS']['class'];
//        $data['tipo_msg'] = $tipo_msg['DANGER']['class'];
//        echo json_encode($data);
//        exit();

        if ($this->input->post()) {//Indica que debe intentar eliminar el curso
            $resul_delete_inv = $this->idm->delete_investigacion_docente($datos_registro['index_inv']); //Verifica si existe el ususario ya contiene datos de actividad
            if ($resul_delete_inv['result'] === -1) {//Manda mensaje de que no se pudo borrar el registro
                $data['error'] = $string_values['error_no_elimino_reg_invest']; //Mensaje de que no pudo borrar registro
                $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                $this->output->set_status_header('400');
            } else {
                $array_to_json['emp_act_inv_edu'] = $resul_delete_inv['entidad'];
                $array_operacion_entidades['emp_act_inv_edu'] = array('delete' => $resul_delete_inv['result']);
                $reg_entidad_cve = 'emp_act_inv_edu-' + $resul_delete_inv['result'];
                if (intval($datos_registro['comprobante_cve']) > 0) {
                    $resul_delete_comprobante = $this->cg->delete_comprobante($datos_registro['comprobante_cve']); //Elimina comprobante, si existe
                    if ($resul_delete_comprobante['result'] > 0) {//Elimino correctamente el comprobante
                        $array_to_json['comprobante'] = $resul_delete_comprobante['entidad'];
                        $array_operacion_entidades['comprobante'] = array('delete' => $resul_delete_comprobante['entidad']);
                        $reg_entidad_cve += ',comprobante-' + $resul_delete_comprobante['result'];
                        //eliminar archivo comprobante 
//                      $nombre_comprobante = $resul_delete_comprobante['entidad']['COM_NOMBRE'];
                        $config_comprobante = $this->config->item('upload_config')['comprobantes']; //Carga configuración para subir archivo comprobante
                        $path = $config_comprobante['upload_path']; //obtiene el path donde se guarda los comprobantes 
                        if (intval($resul_delete_comprobante['result']) > 0) {
                            eliminar_archivo($path, $resul_delete_comprobante['entidad']['COM_NOMBRE']); //Elimina el archivo del directorio
                        }
                    }
                }
                $json_datos_entidad = json_encode($array_operacion_entidades); //Codifica a json datos de entidad
                $json_registro_bitacora = json_encode($array_to_json); //Codifica a json la actualización o insersión a las entidades involucradas
                registro_bitacora($result_id_user, null, $json_datos_entidad, $reg_entidad_cve, $json_registro_bitacora, null);

                $data['error'] = $string_values['succesfull_eliminar']; //mensaje Guardado correcto
                $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                $data['borrado_correcto'] = 1; //Tipo de mensaje de error
            }
            echo json_encode($data);
        }
    }

    public function get_fecha_ultima_actualizacion() {
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['perfil'];
        $id_usuario = $this->session->userdata('identificador');
        $fecha_ultima_actualizacion['fecha_ult_act'] = $string_values['span_fecha_last_update'] . $this->modPerfil->get_fecha_ultima_actualizacion($id_usuario)->fecha_bitacora;
        $json = json_encode($fecha_ultima_actualizacion);
        echo $json;
//        pr($datosPerfil);
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
    
    private function emp_comision_fac($comision){
        $com = new stdClass();
        switch ($comision['tipo_comision']) {
            case $this->config->item('tipo_comision')['DIRECCION_TESIS']['id']:
                $com = $this->direccion_tesis_vo($comision);
                break;            
            default:
                # code...
                break;
        }
        
        return $com;
    }

    private function direccion_tesis_vo($comision){
        $com = new Direccion_tesis_dao;
        $com->EMPLEADO_CVE = (isset($comision['empleado']) && !empty($comision['empleado'])) ? $comision['empleado'] : NULL;
        $com->TIP_COMISION_CVE = (isset($comision['tipo_comision']) && !empty($comision['tipo_comision'])) ? $comision['tipo_comision'] : NULL;
        $com->COMPROBANTE_CVE = (isset($comision['idc']) && !empty($comision['idc'])) ? $this->seguridad->decrypt_base64($comision['idc']) : NULL;
        $com->EC_ANIO = (isset($comision['dt_anio']) && !empty($comision['dt_anio'])) ? $comision['dt_anio'] : NULL;
        $com->COM_AREA_CVE = (isset($comision['comision_area']) && !empty($comision['comision_area'])) ? $comision['comision_area'] : NULL;
        $com->NIV_ACADEMICO_CVE = (isset($comision['nivel_academico']) && !empty($comision['nivel_academico'])) ? $comision['nivel_academico'] : NULL;
        
        return $com;
    }
	
	/*     * *********************************** Material educativo **************************** */

    public function seccion_material_educativo() {
        if ($this->input->is_ajax_request()) {
            $data = array();
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['material_educativo'];
            $data['string_values'] = $string_values;
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $empleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable
            if (!empty($empleado)) {//Si existe un empleado, obtenemos datos
                $lista_material_educativo = $this->mem->get_lista_material_educativo($empleado);
                $data['lista_material_educativo'] = $lista_material_educativo;
                $this->load->view('perfil/material_educativo/elaboracion_material_edu_tpl', $data, FALSE); //Valores que muestrán la lista
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
            $datos_pie = array();
            $data = array(
                'titulo_modal' => $string_values['title_material_eduacativo'],
                'cuerpo_modal' => $this->load->view('perfil/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE),
                'pie_modal' => $this->load->view('perfil/material_educativo/material_edu_pie', $datos_pie, true)
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
                $datos_registro = $this->input->post(null, true);
                pr($datos_registro);
                if (!empty($datos_registro['ctipo_material'])) {
                    $index_tipo_mat = $datos_registro['ctipo_material'];
                    $datos_tipo_material ['string_values'] = $string_values;
                    $datos_tipo_material ['cantidad_hojas'] = $this->config->item('opciones_tipo_material')['cantidad_hojas'];
                    $datos_tipo_material ['numero_horas'] = $this->config->item('opciones_tipo_material')['numero_horas'];
                    $datos_mat_edu['formulario_complemento'] = $this->load->view('perfil/material_educativo/formulario_mat_edu_' . $index_tipo_mat, $datos_tipo_material, TRUE);
                }
            }
            $condiciones_ = array(enum_ecg::ctipo_material => array('TIP_MAT_TIPO =' => NULL));
            $entidades_ = array(enum_ecg::ctipo_material);
            $datos_mat_edu = carga_catalogos_generales($entidades_, $datos_mat_edu, $condiciones_);
            echo $this->load->view('perfil/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE);
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

     private function analiza_validacion_material_educativo($array_validacion, $array_post, $file = null) {
//        pr($array_post);
//        pr($array_validacion);
        $array_result = array();
        $insert_emp_materia_educativo = $this->config->item('emp_materia_educativo');
        $insert_ctipo_material = $this->config->item('ctipo_material');
//        pr($insert_emp_materia_educativo);
//        pr($array_post);
        foreach ($array_post as $key => $value) {
            switch ($key) {
                case 'numero_horas'://Cambia el valor a texto del array
                    $value = $this->config->item('opciones_tipo_material')['numero_horas'][$value];
                    break;
                case 'cantidad_hojas'://Cambia el valor a texto del array
                    $value = $this->config->item('opciones_tipo_material')['cantidad_hojas'][$value];
                    break;
            }
            if (array_key_exists($key, $array_validacion)) {//Verifica existencia de la llave
                $array_result['validacion'][] = $array_validacion[$key];
            }
            if (array_key_exists($key, $insert_emp_materia_educativo)) {//Verifica existencia de la llave
                $array_result['insert_emp_mat_educativo'][$insert_emp_materia_educativo[$key]['insert']] = $value;
            }
            if (array_key_exists($key, $insert_ctipo_material)) {//Verifica existencia de la llave
                $array_result['insert_ctipo_material'][$insert_ctipo_material[$key]['insert']] = $value;
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
                $result_id_empleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable
                $datos_post['empleado_cve'] = $result_id_empleado;//Asigna id del empleado al análisis
                $validations = $this->analiza_validacion_material_educativo($validations, $datos_post, $_FILES);
                $array_datos_entidad = array(); //name_entidad => array(campos con valores)
                $array_operacion_id_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD
                //Parametros iniciales que deben persistir en el botón de actualización
                $this->form_validation->set_rules($validations['validacion']);
                if ($this->form_validation->run()) {//Si pasa todas las validaciones, actualizar
                    $insert_ctipo_material = $validations['insert_ctipo_material'];
                    $insert_emp_materia_educativo = $validations['insert_emp_mat_educativo'];
                    $guardado_correcto = FALSE;
                    $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
                    pr($insert_emp_materia_educativo);
                    pr($insert_ctipo_material);

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
                    if ($guardado_correcto) {//Si el guardado fue satisfactorio, guarda bitacora
                        $json_datos_entidad = json_encode($array_operacion_id_entidades); //Codifica a json datos de entidad
                        $json_registro_bitacora = json_encode($array_datos_entidad); //Codifica a json la actualización o insersión a las entidades involucradas
                        //Datos de bitacora el registro del usuario
                        registro_bitacora($result_id_user, null, $json_datos_entidad, null, $json_registro_bitacora, null);
                    } else {//Error al guardar, manda mensaje de error
//                        pr('No se pudo guardar');
                    }
                }
            }
            if ($carga_vista_extra) {
                $index_tipo_mat = $datos_post['ctipo_material'];
                $datos_tipo_material ['string_values'] = $string_values;
                $datos_tipo_material ['cantidad_hojas'] = $this->config->item('opciones_tipo_material')['cantidad_hojas'];
                $datos_tipo_material ['numero_horas'] = $this->config->item('opciones_tipo_material')['numero_horas'];
                $datos_mat_edu['formulario_complemento'] = $this->load->view('perfil/material_educativo/formulario_mat_edu_' . $index_tipo_mat, $datos_tipo_material, TRUE);
            }
            $condiciones_ = array(enum_ecg::ctipo_material => array('TIP_MAT_TIPO =' => NULL));
            $entidades_ = array(enum_ecg::ctipo_material);
            $datos_mat_edu = carga_catalogos_generales($entidades_, $datos_mat_edu, $condiciones_);
            echo $this->load->view('perfil/material_educativo/formulario_mat_edu_general', $datos_mat_edu, TRUE);
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
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $empleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable
            if (!empty($empleado)) {//Si existe un empleado, obtenemos datos
                $lista_becas = $this->bcl->get_lista_becas($empleado);
                $lista_comisiones = $this->bcl->get_lista_comisiones($empleado);
                $data_becas['lista_becas'] = $lista_becas;
                $data_comision['lista_comisiones'] = $lista_comisiones;
                $data_becas['string_values'] = $string_values;
                $data_comision['string_values'] = $string_values;
                $data['cuerpo_becas'] = $this->load->view('perfil/becas_comisiones/becas_cuerpo', $data_becas, TRUE); //Valores que muestrán la lista
                $data['cuerpo_comisiones'] = $this->load->view('perfil/becas_comisiones/comisiones_cuerpo', $data_comision, TRUE); //Valores que muestrán la lista
                $this->load->view('perfil/becas_comisiones/becas_comisiones_tpl', $data, FALSE); //Valores que muestrán la lista
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
            $data = array(
                'titulo_modal' => $string_values['title_becas'],
                'cuerpo_modal' => $this->load->view('perfil/becas_comisiones/formulario_becas', $data_becas, TRUE),
                'pie_modal' => $this->load->view('perfil/becas_comisiones/becas_pie', $datos_pie, true)
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
            $data = array(
                'titulo_modal' => $string_values['title_comisiones'],
                'cuerpo_modal' => $this->load->view('perfil/becas_comisiones/formulario_comisiones', $data_comisiones, TRUE),
                'pie_modal' => $this->load->view('perfil/becas_comisiones/comisiones_pie', $datos_pie, true)
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function get_add_beca() {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $tipo_msg = $this->config->item('alert_msg');
            $string_values = $this->lang->line('interface')['becas_comisiones']; //Carga textos a utilizar 
            $data_becas = array();
            $data_becas['string_values'] = $string_values;
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable

            if ($this->input->post()) {//Después de cargar el formulario
                $datos_registro = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_beca'); //Obtener validaciones de archivo
                $array_to_json = array(); //name_entidad => array(campos con valores)
                $array_operacion_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD

                $this->form_validation->set_rules($validations);
                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    $array_campos_beca = $this->config->item('emp_beca');
                }//*************************Termina bloque de insertar nueva beca
            }
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::cclase_beca, enum_ecg::cbeca_interrumpida, enum_ecg::cmotivo_becado);
            $data_becas = carga_catalogos_generales($entidades_, $data_becas);


            echo $this->load->view('perfil/becas_comisiones/formulario_becas', $data_becas, TRUE);
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
            $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
            $matricula_user = $this->session->userdata('matricula'); //Asignamos id usuario a variable
            $result_id_empleado = $this->session->userdata('idempleado'); //Asignamos id usuario a variable
//            pr($_FILES);
            if ($this->input->post()) {//Después de cargar el formulario
//                pr($this->input->post());
                $datos_registro = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_comision'); //Obtener validaciones de archivo
                $array_to_json = array(); //name_entidad => array(campos con valores)
                $array_operacion_entidades = array(); //INSERT , UPDATE, DELETE Y SU IDENTIFICADOR DE ENTIDAD

                $this->form_validation->set_rules($validations);
                if ($this->form_validation->run()) { //Si pasa todas las validaciones, guardar
                    $array_campos_comision = $this->config->item('emp_comision');
                }//*************************Termina bloque de insertar nueva beca
            }
            $condiciones_ = array(enum_ecg::ctipo_comision => array('IS_COMISION_ACADEMICA = ' => 0)); //Sólo comisiones que no son academicas, es decir, puras comisiones laborales
            $entidades_ = array(enum_ecg::ctipo_comprobante, enum_ecg::ctipo_comision);
            $data_comisiones = carga_catalogos_generales($entidades_, $data_comisiones, $condiciones_);


            echo $this->load->view('perfil/becas_comisiones/formulario_comisiones', $data_comisiones, TRUE);
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
	

}

class Emp_comision_dao{
    //public $EMP_COMISION_CVE;
    public $EMPLEADO_CVE;
    public $TIP_COMISION_CVE;
    public $COMPROBANTE_CVE;
}

class Direccion_tesis_dao extends Emp_comision_dao{
    public $EC_ANIO;
    public $COM_AREA_CVE;
    public $NIV_ACADEMICO_CVE;
}



