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
<?php echo form_open('', array('id' => '')); ?>

<div class="list-group">

    <span>Valida docente </span>
</div>



<?php echo form_close(); ?>
  