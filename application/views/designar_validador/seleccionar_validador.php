<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open('', array('id' => 'form_seleccionar_validador')); ?>
<div class="row"  >
    <div class="col-lg-8 col-sm-8 text-center" id="div_result_busqueda_sied" >
        <div class="panel-body input-group">
            <label for='lbl_matricula' class="input-group-addon">
                <?php echo $string_values['lbl_matricula'] ?>
            </label>
            <?php echo $this->form_complete->create_element(array('id'=>'bus_matricula','type'=>'text', 'value' => (isset($matricula))? $matricula : '', 'attributes'=>array('placeholder'=>$string_values['titulo_matricula'], 'data-toggle'=>'tooltip', 'data-placement'=>'bottom', 'title'=>$string_values['titulo_matricula'], 'readonly'=>'readonly')));?>
        </div>

        <div class="panel-body input-group">
            <label for='lbl_nombre' class="input-group-addon">
                <?php echo $string_values['lbl_nombre'] ?> 
            </label>
            <?php echo $this->form_complete->create_element(array('id' => 'bus_nombre', 'type' => 'text', 'value' => (isset($nombre)) ? $nombre : '', 'attributes' => array('placeholder' => $string_values['titulo_nombre'], 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $string_values['titulo_nombre'], 'readonly' => 'readonly'))); ?>
            <?php echo $this->form_complete->create_element(array('id' => 'bus_paterno', 'type' => 'text', 'value' => (isset($paterno)) ? $paterno : '', 'attributes' => array('placeholder' => $string_values['titulo_paterno'], 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $string_values['titulo_paterno'], 'readonly' => 'readonly'))); ?>
            <?php echo $this->form_complete->create_element(array('id' => 'bus_materno', 'type' => 'text', 'value' => (isset($materno)) ? $materno : '', 'attributes' => array('placeholder' => $string_values['titulo_materno'], 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $string_values['titulo_materno'], 'readonly' => 'readonly'))); ?>
        </div>

        <div class="panel-body input-group">
            <label for='lbl_adscripcion' class="input-group-addon">
                <?php echo $string_values['lbl_adscripcion']; ?>
            </label>
            <?php echo $this->form_complete->create_element(array('id' => 'bus_clave_adscripcion', 'type' => 'text', 'value' => (isset($adscripcion)) ? $adscripcion : '', 'attributes' => array('placeholder' => $string_values['titulo_adscripcion_clave'], 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $string_values['titulo_adscripcion_clave'], 'readonly' => 'readonly'))); ?>
            <?php echo $this->form_complete->create_element(array('id' => 'bus_nombre_adscripcion', 'type' => 'text', 'value' => (isset($descripcion)) ? $descripcion : '', 'attributes' => array('placeholder' => $string_values['titulo_adscripcion_descripcion'], 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $string_values['titulo_adscripcion_descripcion'], 'readonly' => 'readonly'))); ?>
        </div>

        <div class="panel-body input-group">
            <label for='lbl_categoria' class="input-group-addon" >
                <?php echo $string_values['lbl_categoria']; ?>
            </label>
            <?php echo $this->form_complete->create_element(array('id' => 'bus_clave_categoria', 'type' => 'text', 'value' => (isset($emp_keypue)) ? $emp_keypue : '', 'attributes' => array('placeholder' => $string_values['titulo_categoria_clave'], 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $string_values['titulo_categoria_clave'], 'readonly' => 'readonly'))); ?>
            <?php echo $this->form_complete->create_element(array('id' => 'bus_nombre_categoria', 'type' => 'text', 'value' => (isset($pue_despue)) ? $pue_despue : '', 'attributes' => array('placeholder' => $string_values['titulo_categoria_descripcion'], 'data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => $string_values['titulo_categoria_descripcion'], 'readonly' => 'readonly'))); ?>
        </div>
        <input type="hidden" id="h1" name="bus_delegacion_id_" value="<?php echo isset($delegacion)?$delegacion:'';?>">
        <input type="hidden" id="h2" name="bus_categoria_id_sipimss" value="<?php echo isset($categoria_id_sipimss)?$categoria_id_sipimss:''; ?>">
        <input type="hidden" id="h3" name="bus_base_reg_encontrado" value="<?php echo isset($base_reg_encontrado)?$base_reg_encontrado:'-1'; ?>">
        
        <input type="hidden" id="h6" name="bus_antiguedad" value="<?php echo isset($antiguedad)?$antiguedad:''; ?>">
        <input type="hidden" id="h7" name="bus_sexo" value="<?php echo isset($sexo)?$sexo:''; ?>">
        <input type="hidden" id="h8" name="bus_curp" value="<?php echo isset($curp)?$curp:''; ?>">
        <input type="hidden" id="h9" name="bus_emp_regims" value="<?php echo isset($emp_regims)?$emp_regims:''; ?>">
        <input type="hidden" id="h10" name="bus_fecha_ingreso" value="<?php echo isset($fecha_ingreso)?$fecha_ingreso:''; ?>">
        <input type="hidden" id="h11" name="bus_rfc" value="<?php echo isset($rfc)?$rfc:''; ?>">
        
    </div>
</div>

<?php echo form_close(); ?>
