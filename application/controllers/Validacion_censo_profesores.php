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
        $this->load->model('Validacion_docente_model', 'vdm');
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
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['validador_censo'];
        $data = array();

        $data['string_values'] = $string_values;
        $data['order_columns'] = array('dp.nom_dependencia' => 'Matrícula', 'dp.nom_delegacion' => 'Nombre');
        //Manda el identificador de la delegación del usuario
        $data = carga_catalogos_generales(array(enum_ecg::cestado_validacion), $data); //Carga el catálogo de ejercicio predominante
        $main_contet = $this->load->view('validador_censo/validador_censo_tpl', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    public function get_data_buscar_docentes_validar($current_row = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            if (!is_null($this->input->post())) {
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['validador_censo'];
                $filtros = $this->input->post(null, true); //Obtenemos el post o los valores 
                $filtros['current_row'] = (isset($current_row) && !empty($current_row)) ? $current_row : 0;
                $filtros['delegacion_cve'] =  $this->session->userdata('delegacion_cve');
//            $filtros['per_page'] = 10;
//            pr($filtros);
                $resutlado = $this->dvm->get_buscar_docentes_validar($filtros);
//                pr($resutlado);
                $data['string_values'] = $string_values;
                $data['lista_docentes_validar'] = $resutlado['result'];
                $data['total'] = $resutlado['total'];
                $data['current_row'] = $filtros['current_row'];
                $data['per_page'] = $this->input->post('per_page');

                if (isset($data['lista_docentes_validar']) && !empty($data['lista_docentes_validar'])) {
                    $this->listado_resultado_unidades($data, array('form_recurso' => '#form_busqueda_unidades',
                        'elemento_resultado' => '#div_result_unidades_medicas'
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
        $data['controller'] = 'designar_validador';
        $data['action'] = 'get_data_buscar_unidades';
        $pagination = $this->template->pagination_data($data); //Crear mensaje y links de paginación
        //$pagination = $this->template->pagination_data_buscador_asignar_validador($data); //Crear mensaje y links de paginación
        $links = "<div class='col-sm-5 dataTables_info' style='line-height: 50px;'>" . $pagination['total'] . "</div>
                    <div class='col-sm-7 text-right'>" . $pagination['links'] . "</div>";
        $datos['lista_unidades'] = $data['lista_docentes_validar'];
        $datos['string_values'] = $data['string_values'];
        echo $links . $this->load->view('validador_censo/tabla_resultados_validador', $datos, TRUE) . $links . '
                <script>
                $("ul.pagination li a").click(function(event){
                    data_ajax(this, "' . $form['form_recurso'] . '", "' . $form['elemento_resultado'] . '");
                    event.preventDefault();
                });
                </script>';
    }

}
