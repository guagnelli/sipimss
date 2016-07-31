<?php defined('BASEPATH') OR exit('No direct script access allowed');
    if(!isset($lista_candidaros)){
        $lista_candidaros = array('Raúl','José','Arturo','Francisco','Otro');
    }
?>
    <?php echo form_open('', array('id' => 'form_seleccionar_validador')); ?>
    <div class="list-group">
        <div class="list-group-item">
            <label for='' class="control-label">
                <?php echo $string_values['tab_titulo_seleccionar_validador']; ?>
           </label>
        </div>
        <div class="list-group-item">
            <label for='lbl_validador' class="control-label">
                <?php echo $string_values['lbl_validador']; ?>
            </label>
             <?php 
                echo $this->form_complete->create_element(array('id' => 'candidato_a_validador',
                    'type' => 'dropdown',
                    'options' => $lista_candidaros,
                    'first' => array('' => $string_values['drop_selecciona_validador']),
                    'value' => '',
                    'class'=>'form-control',
                    'attributes' => array('class' => 'form-control', 'aria-describedby'=>"help-tipo-comprobante",
                    'placeholder' => $string_values['lbl_validador'], 'data-toggle' => 'tooltip', 'data-placement' => 'top',
                    ))); 
            ?>
        </div>
        <div class="list-group-item">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="panel-body input-group">
                        <span class="input-group-addon">
                            <?php echo $string_values['lbl_buscar_otro_usuario'];?>
                        </span>

                        <?php
                           echo $this->form_complete->create_element(
                           array('id'=>'buscar_unidad_medica','type'=>'text',
                                   'value' => '',
                                   'attributes'=>array(
                                   'placeholder'=>$string_values['txt_buscar_matricula'],
                                   'data-toggle'=>'tooltip',
                                   'data-placement'=>'bottom',
                                   'onkeypress'=>'return runScript(event);',
                                   'title'=>$string_values['txt_buscar_matricula'],
       //                                        'readonly'=>'readonly',
                                   )
                               )
                           );
                        ?>
                        <div class="input-group-btn" >
                            <button type="button" id="btn_buscar_b" aria-expanded="false" class="btn btn-default browse" title="<?php echo$string_values['txt_buscar_unidad'];?>" data-toggle="tooltip" onclick="funcion_buscar_sied()" ><span aria-hidden="true" class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
         <?php echo form_close(); ?>
                <?php echo form_open('', array('id' => 'form_buscar_sied')); ?>
                <div class="col-lg-12 col-sm-12" id="div_result_busqueda_sied">
                    
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
