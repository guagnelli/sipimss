<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
    
    <div class="list-group">
        <div class="list-group-item">
                <div class="panel-body">
                            <div class='row'>
                                <!--<div class="form-group col-xs-10 col-md-10 col-md-offset-1 col-md-offset-1">-->
                                <div class="col-md-6">
                                    <label for='lbl_nombre_material_elaborado' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_nombre_material_elaborado']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-education"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'material_elaborado', 
                                                'type' => 'text', 
                                                'value' => isset($material_elaborado) ? $material_elaborado : '',
                                                'attributes' => array( 
                                                'class' => 'form-control', 
                                                'placeholder' => $string_values['ph_material_elaborado'], 
                                                'data-toggle' => 'tooltip', 
                                                'data-placement' => 'top', 
                                                'title' => $string_values['ph_material_elaborado'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('material_elaborado'); ?>
                                </div>
                                <div class="col-md-6">
                                     <label for='lbl_tipo_material' class="control-label">
                                         <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_tipo_material']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'ctipo_material', 'type' => 'dropdown', 
                                                'options' => $ctipo_material, 
                                                'first' => array('' => $string_values['drop_tipo_material']), 
                                                'value' => '',
                                                'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_tipo_material'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('ctipo_material'); ?>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-6">
                                    <label for='lbl_modalidad' class="control-label">
                                         <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_modalidad']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'cmodalidad', 'type' => 'dropdown', 
                                                'options' => $cmodalidad, 
                                                'first' => array('' => $string_values['drop_modalidad']), 
                                                'value' => '',
                                                'attributes' => array('name' => 'modalidad_name', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_modalidad'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('cmodalidad'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for='lbl_tipo_participacion' class="control-label">
                                         <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_tipo_participacion']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'ctipo_participacion', 'type' => 'dropdown', 
                                                'options' => $ctipo_participacion, 
                                                'first' => array('' => $string_values['drop_tipo_participacion']), 
                                                'value' => '',
                                                'attributes' => array('name' => 'ctipo_participacion_name', 'class' => 'form-control', 
                                                'placeholder' => '', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_tipo_participacion'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('ctipo_participacion'); ?>
                                </div>
                            </div>
                        <br>
                            <div class='row'>
                                <div class="col-md-4 text-right">
                                    <label for='lbl_duracion' class="control-label">
                                        <b class="rojo ">*</b>
                                         <?php echo $string_values['lbl_duracion']; ?>
                                    </label>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label>
                                        <?php
                                        echo $this->form_complete->create_element(
                                        array('id'=>'duracion', 'type'=>'radio',
                                                'value' => 'hora_dedicadas',
                                                'attributes'=>array(
                                                'class'=>'radio-inline m-r-sm',
                                                'title'=> $string_values['radio_duracion_horas'],
    //                                                    'disabled'=> '',
    //                                                        'checked'=>"checked",
                                                'onchange' =>"mostrar_horas_fechas('block')"    
                                                )
                                            )
                                        );
                                        echo $string_values['radio_duracion_horas'];
                                        ?>
                                    </label>
                                </div>
                                <div class="col-md-4 text-left">
                                    <label>
                                        <?php
                                       echo $this->form_complete->create_element(
                                       array('id'=>'duracion', 'type'=>'radio',
                                               'value' => 'fecha_dedicadas',
                                               'attributes'=>array(
                                               'class'=>'radio-inline m-r-sm',
                                               'title'=> $string_values['radio_duracion_fecha'],
    //                                                    'disabled'=> '',
                                               'onchange' =>"mostrar_horas_fechas('none')"    
                                               )
                                           )
                                       );
                                       echo $string_values['radio_duracion_fecha'];
                                       ?>
                                    </label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12 col-sm-12 col-lg-12' >
                                    <?php echo form_error_format('duracion'); ?>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-6 col-lg-6' id="div_horas_dedicadas" style="<?php echo $mostrar_hora_fecha_duracion==='hora_dedicadas'?'display: block':'display: none';?>">
                                        <label for='lbl_duracion_horas' class="control-label">
                                            <?php echo $string_values['radio_duracion_horas']; ?>
                                        </label>
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"> </span>
                                        </span>
                                        <?php
                                            echo $this->form_complete->create_element(
                                            array('id'=>'hora_dedicadas','type'=>'number',
                                                    'value' => '',
                                                    'attributes'=>array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>$string_values['radio_duracion_horas'],
                                                    'min'=> '0',
                                                    'max'=> '100',
                                                    'data-toggle'=>'tooltip',
                                                    'data-placement'=>'bottom',
                                                    'title'=>$string_values['radio_duracion_horas'],
//                                                    'style'=>"display: none"
                                                    )
                                                )
                                            );
                                        ?>
                                        </div>
                                        <?php echo form_error_format('hora_dedicadas'); ?>
                                </div>
                                <div class='col-sm-6 col-lg-6 text-center' id="fecha_inicio" style="<?php echo $mostrar_hora_fecha_duracion==='fecha_dedicadas'?'display: block':'display: none';?>">
                                    <label for='lbl_duracion_fecha_inicio' class="control-label">
                                        <?php echo $string_values['lbl_duracion_fecha_inicio']; ?>
                                    </label>

                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker1" >
                                            <?php
                                            echo $this->form_complete->create_element(
                                            array('id'=>'fecha_inicio_pick','type'=>'text',
                                                    'value' => '',
                                                    'attributes'=>array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>$string_values['lbl_duracion_fecha_inicio'],
                                                    'data-toggle'=>'tooltip',
                                                    'title'=>$string_values['lbl_duracion_fecha_inicio'],
//                                                    'style'=>"display: none"
                                                    )
                                                )
                                            );
                                            ?>
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php echo form_error_format('fecha_inicio_pick'); ?>
                                </div>

                                <div class='col-sm-6 text-center' id="fecha_fin" style="<?php echo $mostrar_hora_fecha_duracion==='fecha_dedicadas'?'display: block':'display: none';?>">
                                    <label for='radio_duracion_fecha' class="control-label">
                                        <?php echo $string_values['lbl_duracion_fecha_final']; ?>
                                    </label>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker2'>
                                            <?php
                                            echo $this->form_complete->create_element(
                                            array('id'=>'fecha_fin_pick','type'=>'text',
                                                    'value' => '',
                                                    'attributes'=>array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>$string_values['lbl_duracion_fecha_final'],
                                                    'data-toggle'=>'tooltip',
                                                    'title'=>$string_values['lbl_duracion_fecha_final'],
//                                                    'style'=>"display: none"
                                                    )
                                                )
                                            );
                                            ?>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php echo form_error_format('fecha_fin_pick'); ?>
                                </div>
                            </div>
                        <br>
                            <div class="row">
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
                                        <input id="archivo-comprobante" type="file" name="file" class="file" accept="application/pdf">
                                        <label for='radio_duracion_fecha' class="control-label">
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
                                        </div><span id="help-tipo-comprobante" class="help-block">Seleccionar y subir al sistema el tipo de comprobante que se le otorgo en el curso</span>
                                        <?php echo form_error_format('text_comprobante'); ?>
                                </div>
                            </div>
                            
                    </div>
                </div>
                <?php if(isset($pie_pag)){ echo $pie_pag; }?>
            </div>
