<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->lang->load('interface','spanish');
    $string_values = $this->lang->line('interface');
?>
<div class="list-group">
    <style type="text/css">
        .button-padding {padding-top: 30px}
        .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    </style>

    <div class="list-group-item">
        <div class='row text-right'>
            <font size=1>Fecha de última actualización: <span id="fecha"><?php  echo $fecha_informacion_general; ?></span></font>
        </div>
        <div class='row'>
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div id="error">
                        <div id='mensaje_error_div' class='alert'>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span id='mensaje_error'></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>
        </div>
    </div>
    <div class="list-group-item">      
        <div class='row'>
            <h3 class='pinfo'><?php echo $string_values['perfil']['lbl_becas_comisiones_becas_comisiones']; ?> </h3>
        </div>
        <div class='row'> 
            <div class="form-group col-xs-12 col-md-12">
                <table class="table table-striped table-hover table-bordered" id="tabla_becas">
                    <thead>
                        <tr class="btn-default">
                            <th>Fecha de inicio</th>
                            <th>Fecha de termino</th>
                            <th>Clase de beca</th>
                            <th>Proceso educativo por el que fue becado</th>
                            <th>La beca fue interrumpida</th>
                            <th>Causa de la interrupción</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-xs-4 col-md-4 col-md-offset-8">
                <button class="btn btn-success btn-lg" id="btnAgregarBeca" data-toggle="modal" data-target="#modalBeca" data-idformacion="0" data-opcion="0">
                    Agregar beca
                </button>
            </div>
        </div>
    </div>
</div>


    <div class="modal fade" id="modalBeca" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar beca</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-xs-5 col-md-5">  
                            <label for='eb_fch_inicio' class="control-label">
                                <b class="rojo">*</b>
                                Fecha inicio
                            </label>
                            <div class="input-group" id='datetimepickerBecaInicio'>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                <?php
                                    echo $this->form_complete->create_element(
                                    array('id'=>'eb_fch_inicio','type'=>'text',
                                            'value' => '',
                                            'attributes'=>array(
                                            'class'=>'form-control',
                                            'placeholder'=> 'Fecha inicio',
                                            'data-toggle'=>'tooltip',
                                            'title'=> 'Fecha inicio',
                                            )
                                        )
                                    );
                                    ?>
                            </div>
                        </div>
                        <div class="form-group col-xs-6 col-md-6 col-md-offset-1">
                            <label for='eb_fch_fin' class="control-label">
                                <b class="rojo">*</b>
                                Fecha fin
                            </label>
                            <div class="input-group" id='datetimepickerBecaFin'>
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                                <?php
                                    echo $this->form_complete->create_element(
                                    array('id'=>'eb_fch_fin','type'=>'text',
                                            'value' => '',
                                            'attributes'=>array(
                                            'class'=>'form-control',
                                            'placeholder'=> 'Fecha fin',
                                            'data-toggle'=>'tooltip',
                                            'title'=> 'Fecha fin',
                                            )
                                        )
                                    );
                                    ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-5 col-md-5">
                            <label for='cla_beca_cve' class="control-label">
                                <b class="rojo">*</b>
                                <?php echo $string_values['perfil']['lbl_becas_comisiones_cla_beca_cve']; ?>
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"> </span>
                                </span>
                                <?php
                                echo $this->form_complete->create_element(
                                        array(
                                            'id' => 'cla_beca_cve',
                                            'type' => 'dropdown',
                                            'options' => $cla_beca_cve_Options,
                                            'first' => array('' => $string_values['perfil']['plh_becas_comisiones_cla_beca_cve']),
                                            'attributes' => array(
                                                'autocomplete' => 'off',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',

                                            )
                                        )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="form-group col-xs-6 col-md-6 col-md-offset-1">
                            <label for='formacion_salud_tipo_comprobante' class="control-label">
                                <b class="rojo">*</b>
                                <?php echo $string_values['perfil']['lbl_becas_comisiones_motivo_becado_cve']; ?>
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"> </span>
                                </span>
                                <?php
                                echo $this->form_complete->create_element(
                                        array(
                                            'id' => 'motivo_becado_cve',
                                            'type' => 'dropdown',
                                            'options' => $motivo_becado_Options,
                                            'first' => array('' => $string_values['perfil']['plh_becas_comisiones_motivo_becado_cve']),
                                            'attributes' => array(
                                                'autocomplete' => 'off',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',

                                            )
                                        )
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-5 col-md-5">
                            <label for='beca_comisiones_beca_interrumpida' class="control-label">
                                <?php echo $string_values['perfil']['lbl_becas_comisiones_beca_interrumpida']; ?>
                            </label> 
                            <div class=""input-group>
                                <input type="checkbox" name="beca_interrumpida"  id="beca_interrumpida"> Sí
                            </div>
                        </div>
                        <div class="form-group col-xs-6 col-md-6 col-md-offset-1">
                            <label for='beca_interrimpidia_cve' class="control-label">
                                <?php echo $string_values['perfil']['lbl_becas_comisiones_beca_interrimpidia_cve']; ?>
                            </label> 
                            <div class='input-group'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"> </span>
                                </span>
                                <?php
                                echo $this->form_complete->create_element(
                                        array(
                                            'id' => 'beca_interrimpidia_cve',
                                            'type' => 'dropdown',
                                            'options' => $cbecaInterrumpida_Options,
                                            'first' => array('' => $string_values['perfil']['lbl_becas_comisiones_beca_interrimpidia_cve']),
                                            'attributes' => array(
                                                'autocomplete' => 'off',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',

                                            )
                                        )
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-5 col-md-5">
                            <label for='formacion_salud_tipo_comprobante' class="control-label">
                                <?php echo $string_values['perfil']['lbl_formacion_salud_tipo_comprobante']; ?>
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"> </span>
                                </span>
                                <?php
                                echo $this->form_complete->create_element(
                                        array(
                                            'id' => 'formacion_salud_tipo_comprobante',
                                            'type' => 'dropdown',
                                            'options' => $tipoComprobanteOptions,
                                            'first' => array('' => $string_values['perfil']['plh_formacion_salud_tipo_comprobante']),
                                            'attributes' => array(
                                                'autocomplete' => 'off',
                                                'data-toggle' => 'tooltip',
                                                'data-placement' => 'bottom',

                                            )
                                        )
                                );
                                ?>
                            </div>
                        </div> 
                        <div class="form-group col-xs-6 col-md-6 col-md-offset-1">
                            <label for='formacion_salud_comprobante' class="control-label">
                                <?php echo $string_values['perfil']['lbl_formacion_salud_comprobante']; ?>
                            </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil"> </span>
                                </span>
                                <span class="btn btn-default btn-file">
                                    Seleccionar archivo
                                    <?php
                                    echo $this->form_complete->create_element(
                                            array(
                                                'id' => 'formacion_salud_tipo_comprobante',
                                                'type' => 'upload',
                                                'attributes' => array(
                                                    'autocomplete' => 'off',
                                                    'data-toggle' => 'tooltip',
                                                    'data-placement' => 'bottom',

                                                )
                                            )
                                    );
                                    ?>
                                </span>
                            </div>
                        </div>   
                    </div>
                </div>
                        <div class="modal-footer">            
                            <button type="button" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                </div>
            </div>
        </div>