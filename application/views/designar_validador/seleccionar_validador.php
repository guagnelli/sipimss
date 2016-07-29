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
    </div>
    <?php echo form_close(); ?>
