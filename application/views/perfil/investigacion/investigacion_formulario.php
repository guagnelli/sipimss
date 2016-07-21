<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="list-group">
        <div class="list-group-item">
                <div class="panel-body">
                            <?php if(isset($error)){ ?>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                           <?php echo html_message($error, $tipo_msg); ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class='row'>
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <label for='lbl_tipo_actividad_docente' class="control-label">
                                        <?php echo $string_values['lbl_tipo_actividad_docente']; ?>
                                   </label>
                                   <div class="input-group">
                                       <span class="input-group-addon">
                                           <span class="glyphicon glyphicon-user"> </span>
                                       </span>
                                       <?php 
                                           echo $this->form_complete->create_element(array('id' => 'ctipo_actividad_docente', 'type' => 'dropdown', 
                                               'options' => $ctipo_actividad_docente, 
                                               'first' => array('' => 'Selecciona tipo de actividad'), 
                                               'value' => '',
                                               'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                               'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                               )
                                          )); 
                                       ?>
                                    </div>
                                    <?php   echo form_error_format('ctipo_actividad_docente'); ?>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <div class='row'>
                                <!--<div class="form-group col-xs-10 col-md-10 col-md-offset-1 col-md-offset-1">-->
                                <div class="col-md-6">
                                    <label for='lbl_name_trabajo_investigacion' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_name_trabajo_investigacion']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-education"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'nombre_investigacion', 
                                                'type' => 'text', 
                                                'value' => (isset($nombre_investigacion)) ? $nombre_investigacion : '',
                                                'attributes' => array( 
                                                'class' => 'form-control', 
                                                'placeholder' => $string_values['text_name_trabajo_investigacion'], 
                                                'data-toggle' => 'tooltip', 
                                                'data-placement' => 'top', 
                                                'title' => $string_values['text_name_trabajo_investigacion'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('nombre_investigacion'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for='txt_num_folio' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['txt_num_folio']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-education"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'folio_investigacion', 
                                                'type' => 'text', 
                                                'value' => (isset($folio_investigacion)) ? $folio_investigacion : '',
                                                'attributes' => array( 
                                                'class' => 'form-control', 
                                                'placeholder' => $string_values['txt_num_folio'], 
                                                'data-toggle' => 'tooltip', 
                                                'data-placement' => 'top', 
                                                'title' => $string_values['txt_num_folio'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('folio_investigacion'); ?>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-6">
                                    <label for='lbl_tipo_estudio' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_tipo_estudio']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-oil"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'ctipo_estudio', 'type' => 'dropdown', 
                                                'options' => $ctipo_estudio, 
                                                'first' => array('' => $string_values['drop_tipo_estudio']), 
                                                'value' => (isset($tip_estudio_cve))?$tip_estudio_cve:'',
                                                'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_tipo_estudio'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('ctipo_estudio'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for='lbl_tipo_participacion' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_tipo_participacion']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-oil"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'ctipo_participacion', 'type' => 'dropdown', 
                                                'options' => $ctipo_estudio, 
                                                'first' => array('' => $string_values['drop_tipo_participacion']), 
                                                'value' => (isset($tip_participacion_cve))?$tip_participacion_cve:'',
                                                'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_tipo_participacion'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('ctipo_participacion'); ?>
                                </div>
                            </div>
                        <br>
                            <div class='row'>
                                <div class='col-md-6 col-sm-6 col-lg-6' >
                                    <label for='lbl_tipo_divulgacion' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_tipo_divulgacion']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-oil"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'cmedio_divulgacion', 'type' => 'dropdown', 
                                                'options' => $cmedio_divulgacion, 
                                                'first' => array('' => $string_values['drop_tipo_divulgacion']), 
                                                'value' => (isset($tip_estudio_cve))?$tip_estudio_cve:'',
                                                'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_tipo_divulgacion'],
                                                'onchange' =>  "funcion_mostrar_tipo_publicacion(this)"
                                                ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('cmedio_divulgacion'); ?>
                                </div>
                                <div class='col-md-6 col-sm-6 col-lg-6' >
                                    <span id="help-tipo-comprobante" class="help-block"><?php echo $string_values['Texto_de_ayuda_divulgacion'];?></span>
                                </div>
                            </div>
                            
                            
                    </div>
                </div>
                <div id="div_comprobante" class="list-group-item" style="display: none">
                    <!--Mostrará comprobante -->
                    <div class='row'>
                         <div class="col-md-6">
                                <label for='radio_duracion_fecha' class="control-label">
                                    <?php echo $string_values['lbl_tipo_comprobante']; ?>
                                </label>
                                 <?php 
                                    echo $this->form_complete->create_element(array('id' => 'ctipo_comprobante', 
                                        'type' => 'dropdown', 
                                        'options' => $ctipo_comprobante, 
                                        'first' => array('' => $string_values['drop_tipo_comprobante']), 
                                        'value' => '',
                                        'class'=>'form-control',
                                        'attributes' => array('class' => 'form-control', 'aria-describedby'=>"help-tipo-comprobante",
                                        'placeholder' => $string_values['title_tipo_comprobante'], 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                        'title' => $string_values['title_tipo_comprobante'] ))); 
                                ?>
                                <?php echo form_error_format('ctipo_comprobante'); ?>
                        </div>
                        <div class="col-md-6">
                            <!--<li class="list-group-item">-->
                                <!--<input id="archivo-comprobante" type="file" name="file" class="file" accept="application/pdf">Maneja la carga del archivo-->
                                <!--<input type="file" name="userfile" id="userfile" accept="application/pdf">-->
                                <input type="file" id="userfile" name="userfile" class ="userfile" accept="application/pdf">

                                <label for='lbl_comprobante' class="control-label">
                                    <?php echo $string_values['lbl_comprobante']; ?>
                                </label>
                                <div class="input-group">                                           
                                     <?php
                                        echo $this->form_complete->create_element(
                                        array('id'=>'text_comprobante','type'=>'text',
                                                'value' => '',
                                                'attributes'=>array(
                                                'class'=>'form-control',
                                                'placeholder'=>$string_values['title_cargar_comprobante'],
                                                'min'=> '0',
                                                'max'=> '100',
                                                'data-toggle'=>'tooltip',
                                                'data-placement'=>'bottom',
                                                'title'=>$string_values['title_cargar_comprobante'],
                                                'readonly'=>'readonly',
                                                )
                                            )
                                        );
                                     ?>

                                  <div class="input-group-btn">
                                    <button type="button" aria-expanded="false" class="btn btn-default browse">
                                        <span aria-hidden="true" class="glyphicon glyphicon-file"> </span>
                                    </button>
                                    <a role="button" tabindex="0" data-container="body" data-trigger="focus" data-toggle="popover" data-placement="top" data-title="Comprobante" data-content="Aquí usted puede seleccionar el tipo de comprobante que se le otorgo en el curso y posteriormente subirlo al sistema para su verificación" class="btn btn-default" data-original-title="" title="">
                                        <span aria-hidden="true" class="glyphicon glyphicon-question-sign"> </span>
                                    </a>
                                  </div>
                                </div><span id="help-tipo-comprobante" class="help-block"><?php echo $string_values['texto_ayuda_comprobante'];?></span>
                                <?php echo form_error_format('text_comprobante'); ?>
                        </div>
                    </div>
                </div>
                <div id="div_libro" class="list-group-item" style="display: none">
                    <div class='row'>
                         <div class="col-md-6">
                            <label for='lbl_libro' class="control-label">
                                Bibliografia de libro
                            </label>
                         </div>
                    </div>
                </div>
                <div id="div_revista" class="list-group-item" style="display: none">
                    <div class='row'>
                         <div class="col-md-6">
                            <label for='lbl_libro' class="control-label">
                                Bibliografia de revista
                            </label>
                         </div>
                    </div>
                </div>
        
                <?php if(isset($pie_pag)){ echo $pie_pag; }//Carga boton para guardar datos?>
    </div>
