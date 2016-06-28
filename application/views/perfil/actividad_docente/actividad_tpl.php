<?php defined('BASEPATH') OR exit('No direct script access allowed');
        $fecha_ultima_actualizacion = 'Fecha de última actualizacón: 11 de julio de 2016 ';
//    pr($tipo_msg);
        $colapso_div_ejercicio_profesional = 'collapse in';
//        $colapso_div_ejercicio_profesional = 'collapse';
?>

    <style type="text/css">
        .button-padding {padding-top: 30px}
        .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    </style>

    <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/perfil/actividad_docente.js"></script>
    
    <!-- Inicio informacion personal -->
    <?php echo form_open('', array('id'=>'form_actividad_docente')); ?>
    
    <div class="list-group">
        <div class="list-group-item">
            <div class='row text-right'>
                <font size=1><?php  echo $fecha_ultima_actualizacion; ?></font>
            </div>
            <div class='row'>
                <?php if(isset($error)){ ?>
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <?php  if($tipo_msg==='danger' || $tipo_msg==='warning'){
                                         $colapso_div_ejercicio_profesional = 'collapse in';
                                       } 
                                       echo html_message($error, $tipo_msg); ?>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>
                 <?php } ?>
            </div>
        </div>
        <div class="list-group-item">
            
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                 <div>
                    <br>
                    <h4>Actividad en salud</h4>
                    <br>
                </div>
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
                
                <div>
                    <br>
                    <h4>Actividad docente</h4>
                    <br>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         <?php echo $string_values['lbl_actividad_eps'];?>
                      </a>
                    </h4>
                  </div>
                    
                  <div id="collapseThree" class="panel-collapse <?php echo $colapso_div_ejercicio_profesional; ?>" role="tabpanel" aria-labelledby="headingThree" >
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
                                    <span class="glyphicon glyphicon-calendar"> </span>
                                </span>
                                <?php
                                    echo $this->form_complete->create_element(
                                    array('id'=>'actividad_anios_dedicados_docencia','type'=>'number',
                                            'value' => empty($actividad_docente)?'':$actividad_docente[0]['ANIOS_DEDICADOS'],
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
                                <?php   echo form_error_format('actividad_anios_dedicados_docencia'); ?>
                            </div>
                            
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                <label for='lbl_ejercicio_pd' class="control-label">
                                    <b class="rojo">*</b>
                                    <?php echo $string_values['lbl_ejercicio_pd']; ?>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-user"> </span>
                                    </span>
                                    <?php 
                                        echo $this->form_complete->create_element(array('id' => 'ejercicio_predominante', 'type' => 'dropdown', 
                                            'options' => $ejercicios_profesionales, 
                                            'first' => array('' => 'Selecciona ejercicio'), 
                                            'value' => empty($actividad_docente)?'':$actividad_docente[0]['EJER_PREDOMI_CVE'],
                                            'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                            'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                            'title' => $string_values['lbl_ejercicio_pd'] ))); 
                                    ?>
                                </div>
                                <?php   echo form_error_format('ejercicio_predominante'); ?>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1 ">
                                <label for='perfil_ejercicio_predominante' class="control-label">
                                    <b class="rojo">*</b>
                                    <?php echo $string_values['lbl_curso_principal']; ?>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-book"> </span>
                                    </span>
                                    <?php 
                                      echo $this->form_complete->create_element(array('id' => 'curso_principal_imapare', 
                                            'type' => 'dropdown', 'options' => $cursos,
                                            'first' => array('' => 'Selecciona curso'),
//                                            'value' => empty($actividad_docente)?'':$actividad_docente[0]['CURSO_PRINC_IMPARTE'],
                                            'value' => 1,
                                            'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                            'placeholder' => 'Categoría','data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                            'title' => $string_values['lbl_curso_principal'] )));
                                    ?>
                                </div>
                                <?php   echo form_error_format('curso_principal_imapare'); ?>
                            </div>
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1 ">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1 ">
                                    <!--<a class="btn btn-success " data-toggle="tab" href="#get_data_ajax_actividad" >-->
                                        <?php // echo $string_values['btn_guardar_cp']; ?>
                                    <!--</a>-->

                                    <button type="button" class="btn btn-success" id="btn_guardar_actividad" value="ajax">
                                        <?php echo $string_values['btn_guardar_cp']; ?>
                                        <?php // echo $string_values['perfil']['btn_informacion_general_editar_nombre']; ?> 
                                    </button>
                             </div>    
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                
                                
                            </div>
                            <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                <button type="button" class="btn btn-success btn-lg" id="btn_agregar_actividad_modal" data-toggle="modal" data-target="#modal_censo">
                                    <?php echo $string_values['btn_add_new_actividad']; ?>
                                </button>
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
  