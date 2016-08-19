<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
var confirmar_eliminacion = "<?php echo $string_values['confirmar_eliminacion']; ?>";
</script>
<?php echo js('perfil/formacion.js'); ?>

    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#formacionPersonalSalud">
                <strong>
                    <?php echo $string_values['lbl_formacion_personal_salud']; ?>
                </strong>
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#formacionDocente">
                <strong>
                    <?php echo $string_values['lbl_formacion_docente']; ?>
                </strong>
            </a>
        </li>
    </ul>
    <div id = 'tabContentFormacion' class='tab-content col-md-12'>
        <div id = 'formacionPersonalSalud' class = 'tab-pane fade'>
            <div class="panel">
                <div class="panel-body">
                    <div id="mensaje1"></div>
                    <div class="row">
                        <div class='col-sm-12 col-md-12 col-lg-12 text-right'>
                            <div>
                                <button type="button" aria-expanded="false" class="btn btn-success btn_agregar_formacion_salud_modal" data-toggle="modal" data-target="#modal_censo" data-value="">
                                    <?php echo $string_values['btn_add_new_formacion_salud']; ?>
                                </button>
                            </div>
                        </div>
                    </div><br>                    
                    <div class="panel-group" id="accordionSalud" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOneSalud">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordionSalud" href="#collapseOneSalud" aria-expanded="true" aria-controls="collapseOneSalud">
                                        <?php echo $string_values['lbl_formacion_salud_opc']; //Formación docente ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOneSalud" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOneSalud">
                                <div class="panel-body">                                    
                                    <div id="list_formacion_salud_inicial">                                        
                                        <table class='table table-striped'>
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $string_values['lbl_fecha_inicio']; ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $string_values['lbl_fecha_final']; ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $string_values['lbl_tipo_formacion']; ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $string_values['opciones']; ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($formacion_salud['inicial'] as $key_ini => $fsi) {
                                                    $id = $this->seguridad->encrypt_base64($fsi['FPCS_CVE']);
                                                    echo '<tr id="tr_'.$id.'">
                                                            <td>'.nice_date($fsi['EFPCS_FCH_INICIO'], 'm-Y').'</td>
                                                            <td>'.nice_date($fsi['EFPCS_FCH_FIN'], 'm-Y').'</td>
                                                            <td>'.$fsi['TIP_FORM_SALUD_NOMBRE'].((!empty($fsi['SUBTIP_NOMBRE'])) ? ' > '.$fsi['SUBTIP_NOMBRE'] : '').'</td>
                                                            <td><button type="button" class="btn btn-link btn-sm btn_editar_fi" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'">'.
                                                                   $string_values['editar'].
                                                                '</button>
                                                                <button type="button" class="btn btn-link btn-sm btn_eliminar_fi" data-value="'.$id.'">'.
                                                                       $string_values['eliminar'].
                                                                    '</button>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwoSalud">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionSalud" href="#collapseTwoSalud" aria-expanded="false" aria-controls="collapseTwoSalud">
                                        <?php echo $string_values['lbl_formacion_continua_salud_opc']; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwoSalud" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwoSalud">
                                <div class="panel-body">                                    
                                    <div id="list_formacion_salud_continua">
                                        <table class='table table-striped'>
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php echo $string_values['lbl_fecha_inicio']; ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $string_values['lbl_fecha_final']; ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $string_values['lbl_tipo_formacion']; ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $string_values['opciones']; ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($formacion_salud['continua'] as $key_ini => $fsi) {
                                                    $id = $this->seguridad->encrypt_base64($fsi['FPCS_CVE']);
                                                    echo '<tr id="tr_'.$id.'">
                                                            <td>'.nice_date($fsi['EFPCS_FCH_INICIO'], 'm-Y').'</td>
                                                            <td>'.nice_date($fsi['EFPCS_FCH_FIN'], 'm-Y').'</td>
                                                            <td>'.$fsi['TIP_FORM_SALUD_NOMBRE'].((!empty($fsi['SUBTIP_NOMBRE'])) ? ' > '.$fsi['SUBTIP_NOMBRE'] : '').'</td>
                                                            <td><button type="button" class="btn btn-link btn-sm btn_editar_fi" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'">'.
                                                                   $string_values['editar'].
                                                                '</button>
                                                                <button type="button" class="btn btn-link btn-sm btn_eliminar_fi" data-value="'.$id.'">'.
                                                                       $string_values['eliminar'].
                                                                    '</button>
                                                            </td>
                                                        </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
            </div>
        </div>
        <div id = 'formacionDocente' class = 'tab-pane fade in active'>
            <div class="panel">
                <div class="panel-body">
                    <div id="mensaje"></div>
                    <div class="row">
                        <div class='col-sm-12 col-md-12 col-lg-12 text-right'>
                            <div>
                                <button type="button" aria-expanded="false" class="btn btn-success btn_agregar_formacion_salud_modal" data-toggle="modal" data-target="#modal_censo" data-value="">
                                    <?php echo $string_values['btn_add_new_formacion_docente']; ?>
                                </button>
                            </div>
                        </div>
                    </div><br>
                    
                    <?php
                    foreach ($catalogos['ctipo_formacion_profesional'] as $key_tfp => $formacion) { ?>
                        <div class="panel-group" id="accordion<?php echo $key_tfp; ?>" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?php echo $key_tfp; ?>">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $key_tfp; ?>" href="#collapse<?php echo $key_tfp; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key_tfp; ?>">
                                            <?php echo $formacion; //Formación docente ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?php echo $key_tfp; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $key_tfp; ?>">
                                    <div class="panel-body">
                                        <div id="list_tfp<?php echo $key_tfp; ?>">                                        
                                            <?php
                                            if($this->config->item('tipo_curso')['FORMACION_CONTINUA']['id']==$key_tfp){ 
                                                foreach ($catalogos['csubtipo_formacion_profesional'] as $key_sfp => $subtipo) { ?>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="heading<?php echo $key_tfp.'_'.$key_sfp; ?>">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $key_tfp.'_'.$key_sfp; ?>" href="#collapse<?php echo $key_tfp.'_'.$key_sfp; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key_tfp.'_'.$key_sfp; ?>">
                                                                    <?php echo $subtipo; //Formación docente ?>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapse<?php echo $key_tfp.'_'.$key_sfp; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading<?php echo $key_tfp.'_'.$key_sfp; ?>">
                                                            <div class="panel-body">
                                                                <div id="list_sfp_<?php echo $key_tfp.'_'.$key_sfp; ?>">                                        
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><br>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    <?php } ?>
                        <!-- <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php //echo $string_values['formacion_docente']['lbl_formacion_docente_opc']; //Formación docente ?>
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
                                        <?php //echo $string_values['formacion_docente']['lbl_formacion_educacion_distacion_opc']; ?>
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
                                        <?php //echo $string_values['formacion_docente']['lbl_formacion_desarrollo_contenidos_opc']; ?>
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
                                        <?php //echo $string_values['formacion_docente']['lbl_formacion_disenio_instruccional_opc']; ?>
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
                                        <?php //echo $string_values['formacion_docente']['lbl_formacion_investigacion_educativa_opc']; ?>
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
                                        <?php //echo $string_values['formacion_docente']['lbl_formacion_otros_opc']; ?>
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
                        </div> -->
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        
    </script>
            