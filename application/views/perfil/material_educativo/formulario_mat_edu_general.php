<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo form_open('', array('id' => 'form_material_educativo')); ?>
<div class="list-group">
    <div class='row'>
        <div class="col-sm-3 col-md-3 col-lg-3"></div>
        <div class="col-sm-6 col-md-6 col-lg-6">
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
                    'value' => (isset($material_educativo_cve)) ? $material_educativo_cve : '',
                    'attributes' => array('class' => 'form-control',
                        'placeholder' => $string_values['lbl_tipo_material'],
                        'data-toggle' => 'tooltip', 'data-placement' => 'top',
                        'title' => $string_values['lbl_tipo_material'],
                        'onchange' =>  "funcion_cargar_campos_tipo_material_educativo()"
                        )));
                ?>
            </div>
            <?php echo form_error_format('ctipo_material'); ?>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3"></div>
    </div>
    <div class='row'>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <label for='lbl_nombre_material' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['lbl_nombre_material']; ?>
            </label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-oil"> </span>
                </span>
                <?php
                echo $this->form_complete->create_element(array('id' => 'nombre_material',
                    'type' => 'text',
                    'value' => isset($nombre_material) ? $nombre_material : '',
                    'attributes' => array(
                        'class' => 'form-control',
                        'placeholder' => $string_values['texto_name_material'],
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'title' => $string_values['texto_name_material'])));
                ?>
            </div>
            <?php echo form_error_format('nombre_material'); ?>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <label for='lbl_tipo_material_anio_elaboro' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['lbl_tipo_material_anio_elaboro']; ?>
            </label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"> </span>
                </span>
                <?php
                echo $this->form_complete->create_element(
                        array('id' => 'material_educativo_anio', 'type' => 'number',
                            'value' => isset($mat_edu_anio) ? $mat_edu_anio : '',
                            'attributes' => array(
                                'class' => 'form-control',
                                'placeholder' => $string_values['texto_tipo_material_anio_elaboro'],
                                'min' => '1950',
                                'max' => '2050',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => $string_values['texto_tipo_material_anio_elaboro'],
                            )
                        )
                );
                ?>
            </div>
            <?php echo form_error_format('material_educativo_anio'); ?>
        </div>
    </div>
    
    <?php
    if (isset($formulario_complemento)) {
        echo $formulario_complemento;
    }
    ?>

</div>
<?php echo form_close(); ?>