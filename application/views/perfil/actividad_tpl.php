<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $this->lang->load('interface','spanish');
    $string_values = $this->lang->line('interface')['actividad_docente'];
?>

    <style type="text/css">
        .button-padding {padding-top: 30px}
        .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    </style>

    <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/perfil/informacionGeneral.js"></script>
    
    <!-- Inicio informacion personal -->
    <?php echo form_open('', array('id'=>'form_actividad_docente')); ?>
    
    <div class="list-group">
        <div class="list-group-item">
            <?php if(isset($error)){ ?>
                    <div class="row">
                        <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        <div class="col-md-10 col-sm-10 col-xs-10">
                                <?php echo html_message($error, $tipo_msg); ?>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1"></div>
                    </div>
             <?php } ?>
        </div>
        <div class="list-group-item">
            
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                         <?php echo $string_values['lbl_actividad_eps'];?>
                      </a>
                    </h4>
                  </div>
                    
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <!--Datos de Ejercicio profecional en salud-->
                        
                    </div>
                  </div>
                </div>
                
                
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <?php echo $string_values['lbl_actividad_di'];?>
                      </a>
                    </h4>
                  </div>
                    
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <!--Datos de Desarrollo deinvestigacion-->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><?php echo $string_values['tab_titulo_form_prof'] ?></th>
                                        <th><?php echo $string_values['tab_titulo_cedula_prof'] ?></th>
                                        <th><?php echo $string_values['tab_titulo_editar'] ?></th>
                                        <th><?php echo $string_values['tab_titulo_eliminar'] ?></th>
                                        <!--<th>Opciones</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                   </td>
                                        <!--<td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="data_ajax(site_url+\'/bonos_titular/get_data_ajax_info_emp/'. hash('sha512',$v['emp']) .'\', null, \'#modal_content\')">'.$v['emp_matricula'].'</button></td>-->
                                        <td ></td>
                                        <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                        <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                        <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                        <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                </tbody>
                            </table>

                        </div>
                        
                    </div>
                  </div>
                </div>
                
                
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         <?php echo $string_values['lbl_actividad_eps'];?>
                      </a>
                    </h4>
                  </div>
                    
                  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <!--Ejercicio profecional en salud-->
                        <div class='row'>
                            <div class="form-group col-xs-5 col-md-5">
                                <label for='perfil_anios_dedicados_docencia' class="control-label">
                                    <b class="rojo">*</b>
                                    <?php echo $string_values['lbl_anios_dad']; ?>
                                </label>
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-inbox"> </span>
                                </span>
                                <?php
                                    echo $this->form_complete->create_element(
                                    array('id'=>'actividad_anios_dedicados_docencia','type'=>'number','value' => '',
                                            'attributes'=>array(
                                            'class'=>'form-control',
                                            'placeholder'=>$string_values['lbl_anios_dad'],
                                            'min'=> '0',
                                            'max'=> '50',
                                            'data-toggle'=>'tooltip',
                                            'data-placement'=>'bottom',
                                            'title'=>$string_values['lbl_anios_dad'],
                                            )
                                        )
                                    );
                                ?>
                                </div>
                            </div>
                            
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                <label for='perfil_ejercicio_predominante' class="control-label">
                                    <b class="rojo">*</b>
                                    <?php echo $string_values['lbl_ejercicio_pd']; ?>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-inbox"> </span>
                                    </span>
                                    <?php 
                                        echo $this->form_complete->create_element(array('id' => 'ejercicio_predominante', 'type' => 'dropdown', 'options' => array(''), 
                                            'first' => array('' => 'Selecciona ejercicio'), 
                                            'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                            'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                            'title' => $string_values['lbl_ejercicio_pd'] ))); 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                <label for='perfil_ejercicio_predominante' class="control-label">
                                    <b class="rojo">*</b>
                                    <?php echo $string_values['lbl_curso_principal']; ?>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-inbox"> </span>
                                    </span>
                                    <?php 
                                      echo $this->form_complete->create_element(array('id' => 'curso_principal_imapare', 'type' => 'dropdown', 'options' => array(''), 
                                            'first' => array('' => 'Selecciona curso'), 
                                            'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                            'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                            'title' => $string_values['lbl_curso_principal'] )));
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php echo $string_values['tab_titulo_pro_salud_actividad'] ?></th>
                                            <th><?php echo $string_values['tab_titulo_pro_salud_anio'] ?></th>
                                            <th><?php echo $string_values['tab_titulo_pro_salud_duracion'] ?></th>
                                            <th><?php echo $string_values['tab_titulo_editar'] ?></th>
                                            <th><?php echo $string_values['tab_titulo_eliminar'] ?></th>
                                            <!--<th>Opciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                       </td>
                                            <!--<td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="data_ajax(site_url+\'/bonos_titular/get_data_ajax_info_emp/'. hash('sha512',$v['emp']) .'\', null, \'#modal_content\')">'.$v['emp_matricula'].'</button></td>-->
                                            <td ></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
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
    
    
    <?php echo form_close(); ?>
  