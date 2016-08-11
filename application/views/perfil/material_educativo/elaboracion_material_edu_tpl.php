<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$fecha_ultima_actualizacion = 'Fecha de última actualizacón: 11 de julio de 2016 ';
//    pr($tipo_msg);
$colapso_div_ejercicio_profesional = 'collapse in';
//        $colapso_div_ejercicio_profesional = 'collapse';
//        pr($datos_tabla_actividades_docente);
//        pr($actividades_docente_objet);
?>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/perfil/material_educativo.js"></script>

<!-- Inicio informacion personal -->

<div class="list-group">
    
    <div class="list-group-item" style='display:none'>
        <div class='row' >
            <div class="row" id='div_error'>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div id='mensaje_error_div' class='alert'>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id='mensaje_error'></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="list-group-item">
        <div class='row'>
            <div class="col-xs-12 col-md-12 col-lg-12 text-left">
                <br>
                    <?php echo $string_values['title_material_eduacativo']; ?>
                <br>
            </div>
        </div>

        <div class='row'>
            <div class="col-xs-12 col-md-12 col-lg-12 text-right">
                <button type="button" class="btn btn-success btn-lg" id="btn_gregar_material_educativo" data-toggle="modal" data-target="#modal_censo">
                    <?php echo $string_values['btn_agregar_material_eduactivo']; ?>
                </button>
            </div>
        </div>
        <br>
        <div class='row'> 
            <div class="form-group col-xs-12 col-md-12">
                <table class="table table-striped table-hover table-bordered" id="tabla_becas">
                    <thead>
                        <tr class="btn-default">
                            <th><?php echo $string_values['title_tab_mat_edu_nombre_mat']; ?></th>
                            <th><?php echo $string_values['title_tab_mat_edu_tipo_mat']; ?></th>
                            <th><?php echo $string_values['title_tab_mat_edu_anio']; ?></th>
                            <th><?php echo $string_values['title_tab_mat_edu_tipo_comprobante']; ?></th>
                            <th><?php echo $string_values['title_tab_mat_edu_tipo_eliminar']; ?></th>
                            <th><?php echo $string_values['title_tab_mat_edu_tipo_editar']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/template" id="template_row_nueva_comision">

</script>


  