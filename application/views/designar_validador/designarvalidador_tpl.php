<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$fecha_ultima_actualizacion = 'Fecha de última actualizacón: 11 de julio de 2016 ';
?>

<style type="text/css">
    .button-padding {padding-top: 30px}
    .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    /*Oculta el file para cargar comprobante y deja asi solo muestra un botón*/
</style>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/designar_validador/designar_validador.js"></script>

<!-- Inicio informacion personal -->

<?php echo form_open('', array('id' => 'form_busqueda_unidades')); ?>
<div class="list-group">

    <div class="list-group-item">
        <div class='row text-right'>
            <font size=1><?php echo $fecha_ultima_actualizacion; ?></font>
        </div>
        <div class='row' >

            <div class="row" style='display:hidden;' id='div_error_inv_doc'>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <?php /*  if($tipo_msg==='danger' || $tipo_msg==='warning'){
                      $colapso_div_ejercicio_profesional = 'collapse in';
                      }
                      echo html_message($error, $tipo_msg); */ ?>
                    <div id='mensaje_error_inv_doc_div' class='alert'>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id='mensaje_error_inv_doc'></span>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>

        </div>
    </div>
    <div class="list-group-item">

        <div class="panel-body">
            <div>
                <br>
                <h4>Designación de validadores </h4>
                <br>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <label for='lbl_delegacion' class="control-label">
                        <?php echo $string_values['lbl_delegacion']; ?>
                    </label>
                     <?php 
                        echo $this->form_complete->create_element(array('id' => 'delegacion_cve', 
                            'type' => 'dropdown', 
                            'options' => $cdelegacion, 
                            'first' => array('' => $string_values['drop_delegacion']), 
                            'value' => '',
                            'class'=>'form-control',
                            'attributes' => array('class' => 'form-control', 'aria-describedby'=>"help-tipo-comprobante",
                            'placeholder' => $string_values['lbl_delegacion'], 
                            'data-toggle' => 'tooltip', 
                            'data-placement' => 'top', 
                            'title' => $string_values['lbl_delegacion'] ))); 
                    ?>
                </div>
                <div class="col-md-3"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <label for='lbl_unidad' class="control-label">
                        <?php echo $string_values['lbl_unidad']; ?>
                    </label>
                    <div class="input-group">                                           
                         <?php
                            echo $this->form_complete->create_element(
                            array('id'=>'buscar_unidad_medica','type'=>'text',
                                    'value' => '',
                                    'attributes'=>array(
                                    'placeholder'=>$string_values['txt_buscar_unidad'],
                                    'min'=> '0',
                                    'max'=> '100',
                                    'data-toggle'=>'tooltip',
                                    'data-placement'=>'bottom',
                                    'title'=>$string_values['txt_buscar_unidad'],
//                                        'readonly'=>'readonly',
                                    )
                                )
                            );
                         ?>
                        <div class="input-group-btn">
                            <button type="button" aria-expanded="false" class="btn btn-default browse" title="<?php echo$string_values['txt_buscar_unidad'];?>" data-toggle="tooltip" onclick="funcion_buscar_elementos()" >                                <span aria-hidden="true" class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row" >
                <div id="div_result_unidades_medicas" class="row" style="padding:0 20px;">

                </div>
            </div>
        </div>
        <?php echo form_close(); ?>

    </div>
</div>






  