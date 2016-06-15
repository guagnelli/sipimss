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
    <?php echo form_open('', array('id'=>'actividad_docente')); ?>
    <div class='row'> 
        <div class="form-group col-xs-3 col-md-3">
            <label for='perfil_apellido_paterno' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['tl_titulo']; ?>
            </label>
            
            <?php echo form_error_format('perfil_apellido_paterno'); ?>
        </div>
    </div>
    <div class='row'> 
        <div class="form-group col-xs-3 col-md-3">
            <label for='perfil_apellido_paterno' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['stl_actividad_salud']; ?>
            </label>
            
            <?php echo form_error_format('perfil_apellido_paterno'); ?>
        </div>
    </div>
    <div class='row'> 
        <div class="form-group col-xs-3 col-md-3">
            <label for='perfil_apellido_paterno' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['stl_actividad_docente']; ?>
            </label>
            
            <?php echo form_error_format('perfil_apellido_paterno'); ?>
        </div>
    </div>
    
    
    <?php echo form_close(); ?>
  