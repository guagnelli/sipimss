<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Ricardo Sanchez S
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
        $data['order_columns'] = array('dp.nom_dependencia'=>'Nombre del departamento', 'dp.nom_delegacion' => 'Nombre de la delegación', 'fullname' => 'Nombre del validador');
        $data = carga_catalogos_generales(array(enum_ecg::cdelegacion), $data); //Carga el catálogo de ejercicio predominante
        $main_contet = $this->load->view('designar_validador/designarvalidador_tpl', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    public function get_data_seleccionar_validador() {
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['designar_validador'];
        if (!is_null($this->input->post())) {
            $filtros = $this->input->post(null, true); //Obtenemos el post o los valores 
            $data_selecciona_validador['string_values'] = $string_values;
            $data_selecciona_validador['lista_candidaros'] = $result_candidatos;
            $data = array(
                'titulo_modal' => $string_values['tab_titulo_seleccionar_validador'],
                'cuerpo_modal' => $this->load->view('designar_validador/seleccionar_validador', $data_selecciona_validador, true),
//                'pie_modal' => $this->load->view('designar_validador/', $datos_pie, true)
            );
            echo $this->ventana_modal->carga_modal($data);
        }
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
                    data_ajax(this, "'.$form['form_recurso'].'", "'.$form['elemento_resultado'].'");
                    event.preventDefault();
                });
                </script>';
    }

}
