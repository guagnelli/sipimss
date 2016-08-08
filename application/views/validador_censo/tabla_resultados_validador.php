<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_unidades);
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/designar_validador/designar_validador.js"></script>
<div id="tabla_designar_validador" class="table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
        <thead>
            <tr class='btn-default'>
                <th><?php echo $string_values['titulo_tab_matricula'] ?></th>
                <th><?php echo $string_values['titulo_tab_nombre'] ?></th>
                <th><?php echo $string_values['titulo_tab_estado_validacion'] ?></th>
                <th><?php echo $string_values['titulo_tab_fecha_ultimo_estado'] ?></th>
                <th><?php echo $string_values['tab_titulo_nombre'] ?></th>
                <!--<th>Opciones</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            ?>
        </tbody>
    </table>
</div>