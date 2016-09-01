<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//    pr($tipo_msg);
$colapso_div_ejercicio_profesional = 'collapse in';
//        $colapso_div_ejercicio_profesional = 'collapse';
//        pr($datos_tabla_actividades_docente);
//        pr($actividades_docente_objet);
?>

<style type="text/css">
    .button-padding {padding-top: 30px}
    .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
</style>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/validacion_censo_profesores/validador_docente.js"></script>

<!-- Inicio informacion personal -->
<?php echo form_open('', array('id' => 'form_validar_docente')); ?>

<div class="list-group">
    <div class="row">
        <div class="col-md-12">
            <label for='lbl_jus_validacion' class="control-label">
                <?php echo $string_values['lbl_jus_validacion']; ?>
            </label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-comment"> </span>
                </span>
                <?php
                echo $this->form_complete->create_element(array('id' => 'comentario_justificacion',
                    'type' => 'textarea',
                    'value' => (isset($comentario_justificacion)) ? $comentario_justificacion : '',
                    'attributes' => array(
                        'class' => 'form-control',
                        'placeholder' => $string_values['lbl_comentario'],
                        'maxlength' => '4000',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'title' => $string_values['lbl_comentario'])));
                ?>
            </div>
            <?php echo form_error_format('comentario_justificacion'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($pie_pag)) {
                echo $pie_pag;
            }
            ?>
        </div>
    </div>

</div>
<?php echo form_close(); ?>
  