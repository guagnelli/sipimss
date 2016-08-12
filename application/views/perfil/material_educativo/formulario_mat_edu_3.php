<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class='row'>
    <div class="col-sm-6 col-md-6 col-lg-6">
        <label for='lbl_nombre_unidad' class="control-label">
            <b class="rojo">*</b>
            <?php echo $string_values['lbl_nombre_unidad']; ?>
        </label>
        <div class="input-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-oil"> </span>
            </span>
            <?php
            echo $this->form_complete->create_element(array('id' => 'nombre_unidad',
                'type' => 'text',
                'value' => isset($nom_tipo_material) ? $nom_tipo_material : '',
                'attributes' => array(
                    'class' => 'form-control',
                    'placeholder' => $string_values['text_nombre_unidad'],
                    'data-toggle' => 'tooltip',
                    'data-placement' => 'top',
                    'title' => $string_values['text_nombre_unidad'])));
            ?>
        </div>
        <?php echo form_error_format('nombre_unidad'); ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6">
        <label for='lbl_numero_horas' class="control-label">
            <b class="rojo">*</b>
            <?php echo $string_values['lbl_numero_horas']; ?>
        </label>
        <div class="input-group">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"> </span>
            </span>
            <?php
            echo $this->form_complete->create_element(array('id' => 'numero_horas', 'type' => 'dropdown',
                'options' => $numero_horas,
                'first' => array('' => $string_values['drop_numero_horas']),
                'value' => (isset($nom_tipo_material)) ? $nom_tipo_material : '',
                'attributes' => array('class' => 'form-control',
                    'placeholder' => $string_values['text_numero_horas'],
                    'data-toggle' => 'tooltip', 'data-placement' => 'top',
                    'title' => $string_values['text_numero_horas'],
            )));
            ?>
        </div>
        <?php echo form_error_format('numero_horas'); ?>
    </div>
</div>
<input type="hidden" name="tipo_material_regreso" value="<?php echo (isset($id_tipo_material)) ? $id_tipo_material : '0'; ?>">