<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->lang->load('interface','spanish');
$string_values = $this->lang->line('interface');

?>

    <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/perfil/formacion.js"></script>

    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#formacionPersonalSalud">
                <strong>
                    <?php echo $string_values['perfil']['lbl_formacion_personal_salud']; ?>
                </strong>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#formacionDocente">
                <strong>
                    <?php echo $string_values['perfil']['lbl_formacion_docente']; ?>
                </strong>
            </a>
        </li>
    </ul>
    <div id = 'tabContentFormacion' class='tab-content col-md-12'>
        <div id = 'formacionPersonalSalud' class = 'tab-pane fade in active'>
            <div class="panel">
                <div class="panel-body">                    
                    <div class="panel-group" id="accordionSalud" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOneSalud">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordionSalud" href="#collapseOneSalud" aria-expanded="true" aria-controls="collapseOneSalud">
                                        <?php echo $string_values['formacion_salud']['lbl_formacion_salud_opc']; //Formación docente ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOneSalud" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOneSalud">
                                <div class="panel-body">                                    
                                    <div id="list_formacion_salud">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwoSalud">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionSalud" href="#collapseTwoSalud" aria-expanded="false" aria-controls="collapseTwoSalud">
                                        <?php echo $string_values['formacion_salud']['lbl_formacion_continua_salud_opc']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwoSalud" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwoSalud">
                                <div class="panel-body">                                    
                                    <div id="list_formacion_salud">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
        <div id = 'formacionDocente' class = 'tab-pane fade'>
            <div class="panel">
                 <div class="breadcrumbs6 panel-heading" style="padding-left:20px;">
                    <h3 id="titulo_registro">
                        <?php echo $string_values['formacion_docente']['tit_formacion_docente']; ?>
                    </h3>
                </div>
                <div class="panel-body"> 
                    <div class="clearfix"></div>
                        <button class="btn-link btn-sm pull-right" 
                                id="btnAgregarFormacionDocente" 
                                data-toggle="modal" 
                                data-target="#modal_censo"
                                data-idformacion="0"
                                data-opcion="0"
                                onclick="open_formulario_formacion();"
                                >
                            <?php echo $string_values['perfil']['btn_formacion_salud_agregar_formacion_profesional']; ?>
                        </button>
                    <div class="clearfix"></div>    
                    <!-- -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo $string_values['formacion_docente']['lbl_formacion_docente_opc']; //Formación docente ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div id="list_formacion_desarrollo_contenidos">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php echo $string_values['formacion_docente']['lbl_formacion_educacion_distacion_opc']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <div id="list_formacion_desarrollo_contenidos">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <?php echo $string_values['formacion_docente']['lbl_formacion_desarrollo_contenidos_opc']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <div id="list_formacion_desarrollo_contenidos">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <?php echo $string_values['formacion_docente']['lbl_formacion_disenio_instruccional_opc']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <div id="list_formacion_desarrollo_contenidos">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <?php echo $string_values['formacion_docente']['lbl_formacion_investigacion_educativa_opc']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <div id="list_formacion_desarrollo_contenidos">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingSix">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        <?php echo $string_values['formacion_docente']['lbl_formacion_otros_opc']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                                <div class="panel-body">
                                    <div id="list_formacion_desarrollo_contenidos">                                        
                                        {list_table, button_modal_form_docente, form_docente}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 

                    -->
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        function open_formulario_formacion() {
            data_ajax(site_url + "/perfil/ajax_cargar_formulario_formacion", 'null', '#modal_censo');
        }
    </script>
            