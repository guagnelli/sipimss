<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open('', array('id' => 'form_seleccionar_validador')); ?>
<!--<div class="row" style="display: <?php // echo (isset($status) AND $status === '1') ? 'block' : 'none'; ?>" >-->
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
    </div>
</div>

<?php echo form_close(); ?>
