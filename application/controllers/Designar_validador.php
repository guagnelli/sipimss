<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: LEAS 
 * fecha: 29/07/2016
 */
class Designar_validador extends MY_Controller {

    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('empleados_siap');
        $this->load->model('Designar_validador_model', 'dvm');
        $this->load->library('Ventana_modal');
        $this->load->config('general');
        $this->load->library('form_validation');
//        $this->load->library('Ventana_modal');
    }

    /**
     * 
     * @author Leas
     * Fecha creación28072016
     */
    public function index() {
//        $filtros['delegacion_cve'] = '01';
//        $filtros['buscar_unidad_medica'] = 'al';
//           $resutlado = $this->dvm->get_buscar_unidades($filtros);
//           pr($resutlado);
//        $array_siap = array("reg_delegacion" => $datos_registro['reg_delegacion'], 
//            "asp_matricula" => $datos_registro['reg_matricula']);
//        $datos_siap = $this->empleados_siap->buscar_usuario_siap($array_siap);
//        pr();
//        exit();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['designar_validador'];
        $data = array();

        $data['string_values'] = $string_values;
        $data['order_columns'] = array('dp.nom_dependencia' => 'Nombre del departamento', 'dp.nom_delegacion' => 'Nombre de la delegación', 'fullname' => 'Nombre del validador');
        $data = carga_catalogos_generales(array(enum_ecg::cdelegacion), $data); //Carga el catálogo de ejercicio predominante
        $main_contet = $this->load->view('designar_validador/designarvalidador_tpl', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

//    public function get_data_seleccionar_validador() {
//        $this->lang->load('interface', 'spanish');
//        $string_values = $this->lang->line('interface')['designar_validador'];
//        $data_selecciona_validador['mostrar_buscador'] = "display: none";
//        if (!is_null($this->input->post())) {
//            $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
////            $data_selecciona_validador['status'] = '0';
//            pr($datos_post);
//            switch ($datos_post['tipo_evento']) {
//                case 'buscar'://Buscar en el sied por matricula
//                    $this->load->library('empleados_siap');
//                    $datos_siap = $this->empleados_siap->buscar_usuario_siap(array("reg_delegacion" => $datos_post['delegacion_cve'], "asp_matricula" => $datos_post['buscar_unidad_medica']));
////                    $datos_siap['string_values'] = $string_values;
////                    pr($datos_siap);
////                    $data_selecciona_validador['vista_resultado_busqueda'] = $this->load->view('designar_validador/busqueda_sied', $datos_siap, true);
//                    $data_selecciona_validador['matricula'] = $datos_siap['matricula'];
//                    $data_selecciona_validador['nombre'] = $datos_siap['nombre'];
//                    $data_selecciona_validador['materno'] = $datos_siap['materno'];
//                    $data_selecciona_validador['paterno'] = $datos_siap['paterno'];
//                    $data_selecciona_validador['delegacion'] = $datos_siap['delegacion'];
//                    $data_selecciona_validador['adscripcion'] = $datos_siap['adscripcion'];
//                    $data_selecciona_validador['descripcion'] = $datos_siap['descripcion'];
//                    $data_selecciona_validador['pue_despue'] = $datos_siap['pue_despue'];
//                    $data_selecciona_validador['emp_keypue'] = $datos_siap['emp_keypue'];
//                    $data_selecciona_validador['status'] = $datos_siap['status'];
//                    break;
//                case 'cargarseleccion'://Primera carga 
//                    $data_selecciona_validador['candidatos'] = '-1';
//
//                    break;
//                case 'opciones'://Combo de opcoiones
//                    if (isset($datos_post['candidato_a_validador']) AND $datos_post['candidato_a_validador'] > 0) {
//                        $res_obtener_empleado = $this->dvm->get_obtener_empleado($datos_post['candidato_a_validador']);
//                        if (!empty($res_obtener_empleado)) {
//                            $data_selecciona_validador['matricula'] = $res_obtener_empleado[0]['matricula'];
//                            $data_selecciona_validador['nombre'] = $res_obtener_empleado[0]['nombre'];
//                            $data_selecciona_validador['paterno'] = $res_obtener_empleado[0]['paterno'];
//                            $data_selecciona_validador['materno'] = $res_obtener_empleado[0]['materno'];
//                            $data_selecciona_validador['delegacion_id'] = $res_obtener_empleado[0]['delegacion_cve'];
//                            $data_selecciona_validador['delegacion'] = $res_obtener_empleado[0]['nom_delegacion'];
//                            $data_selecciona_validador['adscripcion'] = $res_obtener_empleado[0]['adscripcion_cve'];
//                            $data_selecciona_validador['descripcion'] = $res_obtener_empleado[0]['nom_dependencia_adscripcion'];
//                            $data_selecciona_validador['pue_despue'] = $res_obtener_empleado[0]['nom_categoria'];
//                            $data_selecciona_validador['emp_keypue'] = $res_obtener_empleado[0]['desc_categoria_cve'];
//                            $data_selecciona_validador['status'] = $res_obtener_empleado[0]['status'];
//                        }
//                        pr($data_selecciona_validador);
//                    }
//
//                    break;
//            }
//            if (isset($datos_post['candidato_a_validador'])) {
//                switch ($datos_post['candidato_a_validador']) {
//                    case 0:
//                        //mostrar buscador 
//                        $data_selecciona_validador['mostrar_buscador'] = "display: block";
//                        break;
//                    default :
//                        $data_selecciona_validador['mostrar_buscador'] = "display: none";
//                }
//            }
//            $param['departamento_cve'] = '09NC012520'; //
////            $param['departamento_cve'] = $datos_post['departamento_desc'];
//            $param['delegacion_cve'] = $datos_post['delegacion_cve'];
//            $param['categorias'] = $this->config->item('categorias_designar_validador'); //Categorias permitidas para validador
//            $res_busqueda = $this->dvm->get_buscar_candidatos_validador_por_unidad_delegacion_categoria($param);
////            array_unshift($res_busqueda, array('nom_empleado' => 'Otro candidato', 'empleado_cve' => 0  ));//Agrega al principio del array otro empleado para, se pueda buscar en el sied
//            $lista_candidaros = dropdown_options($res_busqueda, 'empleado_cve', 'nom_empleado');
////            $result_candidatos = 
//            $data_selecciona_validador['string_values'] = $string_values;
//            $data_selecciona_validador['lista_candidaros'] = $lista_candidaros;
//            $data_selecciona_validador['reg_delegacion_cve'] = $datos_post['delegacion_cve'];
//            $data_selecciona_validador['reg_departamento_desc'] = $datos_post['departamento_desc'];
//            $data_selecciona_validador['reg_id_validador'] = $datos_post['id_validaor'];
//            
//            
//            echo $this->load->view('designar_validador/seleccionar_validador', $data_selecciona_validador, true);
//        }
//    }

    public function get_data_cargar_elemento() {
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['designar_validador'];
        $data_selecciona_validador['mostrar_buscador'] = "display: none";
        if (!is_null($this->input->post())) {
            $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
//            $data_selecciona_validador['status'] = '0';

            pr($datos_post);


            $param['departamento_cve'] = '09NC012520'; //
//            $param['departamento_cve'] = $datos_post['departamento_desc'];
            $param['delegacion_cve'] = $datos_post['delegacion_cve'];
            $param['categorias'] = $this->config->item('categorias_designar_validador'); //Categorias permitidas para validador
            $res_busqueda = $this->dvm->get_buscar_candidatos_validador_por_unidad_delegacion_categoria($param);
//            array_unshift($res_busqueda, array('nom_empleado' => 'Otro candidato', 'empleado_cve' => 0  ));//Agrega al principio del array otro empleado para, se pueda buscar en el sied
            $lista_candidaros = dropdown_options($res_busqueda, 'empleado_cve', 'nom_empleado');
//            $result_candidatos = 
            $data_selecciona_validador['string_values'] = $string_values;
            $data_selecciona_validador['lista_candidaros'] = $lista_candidaros;
            $data_selecciona_validador['reg_delegacion_cve'] = $datos_post['delegacion_cve'];
            $data_selecciona_validador['reg_departamento_desc'] = $datos_post['departamento_desc'];
            $data_selecciona_validador['reg_id_validador'] = $datos_post['id_validaor'];
            $data = array(
                'titulo_modal' => $string_values['tab_titulo_seleccionar_validador'],
                'cuerpo_modal' => $this->load->view('designar_validador/carga_validadores_unidad', $data_selecciona_validador, true),
                'pie_modal' => $this->load->view('designar_validador/designar_validador_pie', $data_selecciona_validador, true)
            );
            echo $this->ventana_modal->carga_modal($data);
        }
    }

    public function get_data_cargar_datos_opcion_validador() {
        if (!is_null($this->input->post())) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['designar_validador'];
            $data_selecciona_validador['mostrar_buscador'] = "display: none";
            $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
//            pr($datos_post);
            $data_selecciona_validador['string_values'] = $string_values;
            $data_selecciona_validador['reg_delegacion_cve'] = $datos_post['delegacion_cve'];
            $data_selecciona_validador['reg_departamento_desc'] = $datos_post['departamento_desc'];
            $data_selecciona_validador['reg_id_validador'] = $datos_post['id_validaor'];
            $index_validador = intval($datos_post['candidato_a_validador']);
            switch ($index_validador) {
                case 0://Carga el buscador
                    $data_selecciona_validador = carga_catalogos_generales(array(enum_ecg::cdelegacion), $data_selecciona_validador);
                    echo $this->load->view('designar_validador/busquedor_sied', $data_selecciona_validador, true);
                    break;
                case -1:
                    $data_selecciona_validador['mensaje'] = $string_values['drop_selecciona_validador_nulo'];
                    echo $this->load->view('designar_validador/mensajes', $data_selecciona_validador, true);
                    break;
                default ://Carga el resultado de validador seleccionado 
                    $res_obtener_empleado = $this->dvm->get_obtener_empleado($index_validador);
                    if (!empty($res_obtener_empleado)) {
                        $data_selecciona_validador['matricula'] = $res_obtener_empleado[0]['matricula'];
                        $data_selecciona_validador['nombre'] = $res_obtener_empleado[0]['nombre'];
                        $data_selecciona_validador['paterno'] = $res_obtener_empleado[0]['paterno'];
                        $data_selecciona_validador['materno'] = $res_obtener_empleado[0]['materno'];
                        $data_selecciona_validador['delegacion_id'] = $res_obtener_empleado[0]['delegacion_cve'];
                        $data_selecciona_validador['delegacion'] = $res_obtener_empleado[0]['nom_delegacion'];
                        $data_selecciona_validador['adscripcion'] = $res_obtener_empleado[0]['adscripcion_cve'];
                        $data_selecciona_validador['descripcion'] = $res_obtener_empleado[0]['nom_dependencia_adscripcion'];
                        $data_selecciona_validador['pue_despue'] = $res_obtener_empleado[0]['nom_categoria'];
                        $data_selecciona_validador['emp_keypue'] = $res_obtener_empleado[0]['desc_categoria_cve'];
                        $data_selecciona_validador['status'] = $res_obtener_empleado[0]['status'];
                    }
//
                    echo $this->load->view('designar_validador/seleccionar_validador', $data_selecciona_validador, true);
            }
        }
    }

    public function get_data_buscar_sied_validador() {
        if (!is_null($this->input->post())) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['designar_validador'];
            $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
            $this->load->library('empleados_siap');
            //Datos que vienen desde raíz.......................................
            $data_selecciona_validador['string_values'] = $string_values;
            $data_selecciona_validador['reg_delegacion_cve'] = $datos_post['delegacion_cve'];
            $data_selecciona_validador['reg_departamento_desc'] = $datos_post['departamento_desc'];
            $data_selecciona_validador['reg_id_validador'] = $datos_post['id_validaor'];

            $datos_sipimss = $this->dvm->get_buscar_empleado_delegacion($datos_post['buscar_unidad_medica'], $datos_post['delegacion_busqueda_validador']);
            if (empty($datos_sipimss)) {
                pr($datos_sipimss);
                if (intval($datos_sipimss[0]['status']) === 1) {
                    $data_selecciona_validador['base_reg_encontrado'] = 'sipimss';
                    $data_selecciona_validador['matricula'] = $datos_sipimss[0]['matricula'];
                    $data_selecciona_validador['nombre'] = $datos_sipimss[0]['nombre'];
                    $data_selecciona_validador['materno'] = $datos_sipimss[0]['materno'];
                    $data_selecciona_validador['paterno'] = $datos_sipimss[0]['paterno'];
                    $data_selecciona_validador['delegacion'] = $datos_sipimss[0]['delegacion_cve'];
                    $data_selecciona_validador['adscripcion'] = $datos_sipimss[0]['adscripcion_cve'];
                    $data_selecciona_validador['descripcion'] = $datos_sipimss[0]['nom_dependencia_adscripcion'];
                    $data_selecciona_validador['pue_despue'] = $datos_sipimss[0]['nom_categoria'];
                    $data_selecciona_validador['emp_keypue'] = $datos_sipimss[0]['desc_categoria_cve'];
                    $data_selecciona_validador['categoria_id_sipimss'] = $datos_sipimss[0]['categoria_id'];
                    $data_selecciona_validador['status'] = $datos_sipimss[0]['status'];
                    echo $this->load->view('designar_validador/seleccionar_validador', $data_selecciona_validador, true);
                } else {
                    $data_selecciona_validador['mensaje'] = $string_values['lbl_status_empleado_cero'];
                    echo $this->load->view('designar_validador/mensajes', $data_selecciona_validador, true);
                }
            } else {
                $datos_siap = $this->empleados_siap->buscar_usuario_siap(array("reg_delegacion" => $datos_post['delegacion_busqueda_validador'], "asp_matricula" => $datos_post['buscar_unidad_medica']));
                pr($datos_siap);
                if (isset($datos_siap) AND is_array($datos_siap)) {//Si existe y es un array 
                    if (intval($datos_siap['status']) === 1) {
                        $data_selecciona_validador['base_reg_encontrado'] = 'sied';
                        $data_selecciona_validador['matricula'] = $datos_siap['matricula'];
                        $data_selecciona_validador['nombre'] = $datos_siap['nombre'];
                        $data_selecciona_validador['materno'] = $datos_siap['materno'];
                        $data_selecciona_validador['paterno'] = $datos_siap['paterno'];
                        $data_selecciona_validador['delegacion'] = $datos_siap['delegacion'];
                        $data_selecciona_validador['adscripcion'] = $datos_siap['adscripcion'];
                        $data_selecciona_validador['descripcion'] = $datos_siap['descripcion'];//Adscripción cve
                        $data_selecciona_validador['pue_despue'] = $datos_siap['pue_despue'];//categoría descripción
                        $data_selecciona_validador['emp_keypue'] = $datos_siap['emp_keypue'];//categoría cve
                        $data_selecciona_validador['status'] = $datos_siap['status'];
                        $data_selecciona_validador['categoria_id_sipimss'] = '0';
                        $data_selecciona_validador['antiguedad'] = $datos_siap['antiguedad'];
                        $data_selecciona_validador['sexo'] = $datos_siap['sexo'];
                        $data_selecciona_validador['curp'] = $datos_siap['curp'];
                        $data_selecciona_validador['emp_regims'] = $datos_siap['emp_regims'];
                        $data_selecciona_validador['fecha_ingreso'] = $datos_siap['fecha_ingreso'];
                        $data_selecciona_validador['rfc'] = $datos_siap['rfc'];
                        echo $this->load->view('designar_validador/seleccionar_validador', $data_selecciona_validador, true);
                    } else {
                        $data_selecciona_validador['mensaje'] = $string_values['lbl_status_empleado_cero'];
                        echo $this->load->view('designar_validador/mensajes', $data_selecciona_validador, true);
                    }
                } else {
                    $data_selecciona_validador['mensaje'] = $string_values['lbl_no_se_encontro_empleado_sied'];
                    echo $this->load->view('designar_validador/mensajes', $data_selecciona_validador, true);
                }
            }
        }
    }

    /**
     * Guarda los datos que se encuentran en los campos de datos de validador
     */
    public function get_data_seleccionar_validador() {
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['designar_validador'];
        if (!is_null($this->input->post())) {
            $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
//            $data_selecciona_validador['status'] = '0';
            contrasenia_formato();
            if(isset($datos_post['base_reg_encontrado'])){
                switch (intval($datos_post['base_reg_encontrado'])){
                    case -1://Datos del empleado 
                        break;
                    case 0:
                        break;
                }
            }else{
                $data_selecciona_validador['mensaje'] = $string_values['lbl_no_se_encontro_empleado_sied'];
                echo $this->load->view('designar_validador/mensajes', $data_selecciona_validador, true);
            }
            pr($datos_post);
        }
    }

    public function get_data_buscar_datos_opcion_validador() {
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['designar_validador'];
        $data_selecciona_validador['mostrar_buscador'] = "display: none";
        if (!is_null($this->input->post())) {
            $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
            pr($datos_post);
            if (intval($datos_post['candidato_a_validador']) === 0) {
                $data_selecciona_validador['mostrar_buscador'] = "display: block";
            } else {
                $data_selecciona_validador['mostrar_buscador'] = "display: none";
            }

            $data_selecciona_validador['string_values'] = $string_values;
            $data_selecciona_validador['reg_delegacion_cve'] = $datos_post['delegacion_cve'];
            $data_selecciona_validador['reg_departamento_desc'] = $datos_post['departamento_desc'];
            $data_selecciona_validador['reg_id_validador'] = $datos_post['id_validaor'];
        }
        echo $this->load->view('designar_validador/seleccionar_validador', $data_selecciona_validador, true);
    }

    public function get_data_buscar_unidades($current_row = null) {
        if (!is_null($this->input->post())) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['designar_validador'];
            $filtros = $this->input->post(null, true); //Obtenemos el post o los valores 
            $filtros['current_row'] = (isset($current_row) && !empty($current_row)) ? $current_row : 0;
//            $filtros['per_page'] = 10;
//            pr($filtros);
            $resutlado = $this->dvm->get_buscar_unidades($filtros);
//                pr($resutlado);
            $data['string_values'] = $string_values;
            $data['lista_unidades'] = $resutlado['result'];
            $data['total_unidades'] = $resutlado['total'];
            $data['current_row'] = $filtros['current_row'];
            $data['per_page'] = $this->input->post('per_page');

            if (isset($data['lista_unidades']) && !empty($data['lista_unidades'])) {
                $this->listado_resultado_unidades($data, array('form_recurso' => '#form_busqueda_unidades',
                    'elemento_resultado' => '#div_result_unidades_medicas'
                )); //Generar listado en caso de obtener datos
            } else {
                echo $string_values ['resp_sin_resultados'];
            }
        }
    }

    private function listado_resultado_unidades($data, $form) {
        $pagination = $this->template->pagination_data_buscador_asignar_validador($data); //Crear mensaje y links de paginación
        $links = "<div class='col-sm-5 dataTables_info' style='line-height: 50px;'>" . $pagination['total'] . "</div>
                    <div class='col-sm-7 text-right'>" . $pagination['links'] . "</div>";
        $datos['lista_unidades'] = $data['lista_unidades'];
        $datos['string_values'] = $data['string_values'];
        echo $links . $this->load->view('designar_validador/tabla_resultados_dv', $datos, TRUE) . $links . '
                <script>
                $("ul.pagination li a").click(function(event){
                    data_ajax(this, "' . $form['form_recurso'] . '", "' . $form['elemento_resultado'] . '");
                    event.preventDefault();
                });
                </script>';
    }

}
