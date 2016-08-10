<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type='text/javascript'>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'DD-MM-YYYY',
            locale: 'es',
            useCurrent: false
        });
        $('#datetimepicker2').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'DD-MM-YYYY',
            locale: 'es',
            useCurrent: false
        });
    });
</script>
<?php echo form_open_multipart('', array('id' => 'form_comisiones_laborales')); ?>
form_becas_laborales
<div class="list-group">
    <div class='row'>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <label for='lbl_tipo_comision' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['lbl_tipo_comision']; ?>
            </label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-user"> </span>
                </span>
                <?php
                echo $this->form_complete->create_element(array('id' => 'ctipo_comision', 'type' => 'dropdown',
                    'options' => $ctipo_comision,
                    'first' => null,
                    'value' => (isset($tipo_comision_cve)) ? $tipo_comision_cve : '',
                    'attributes' => array('class' => 'form-control',
                        'placeholder' => $string_values['lbl_tipo_comision'],
                        'data-toggle' => 'tooltip', 'data-placement' => 'top',
                        'title' => $string_values['lbl_tipo_comision'])));
                ?>
            </div>
            <?php echo form_error_format('ctipo_comision'); ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class='row'>
        <div class='col-sm-12 text-center' id="fecha_inicio">
            <label for='lbl_comision_periodo' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['lbl_comision_periodo']; ?>
            </label>
        </div>
    </div>
    <br>
    <div class='row'>
        <div class='col-sm-6' id="fecha_inicio">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1" >
                    <?php
                    echo $this->form_complete->create_element(
                            array('id' => 'periodo_fecha_inicio_pick', 'type' => 'text',
                                'value' => (isset($fecha_inicio)) ? $fecha_inicio : '',
                                'attributes' => array(
                                    'class' => 'form-control',
                                    'placeholder' => $string_values['lbl_comision_fecha_inicio'],
                                    'data-toggle' => 'tooltip',
                                    'title' => $string_values['lbl_comision_fecha_inicio'],
                                )
                            )
                    );
                    ?>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <?php echo form_error_format('periodo_fecha_inicio_pick'); ?>

        </div>
        <div class='col-sm-6 ' id="fecha_fin">
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <?php
                    echo $this->form_complete->create_element(
                            array('id' => 'periodo_fecha_fin_pick', 'type' => 'text',
                                'value' => (isset($fecha_fin)) ? $fecha_fin : '',
                                'attributes' => array(
                                    'class' => 'form-control',
                                    'placeholder' => $string_values['lbl_comision_fecha_fin'],
                                    'data-toggle' => 'tooltip',
                                    'title' => $string_values['lbl_comision_fecha_fin'],
                                )
                            )
                    );
                    ?>
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
            </div>
            <?php echo form_error_format('periodo_fecha_fin_pick'); ?>
        </div>
    </div>
    <div class='row'>
        <div class="col-md-6">
            <b class="rojo">*</b>
            <label for='lbl_tipo_comprobante' class="control-label">
                <?php echo $string_values['lbl_tipo_comprobante']; ?>
            </label>
            <?php
            echo $this->form_complete->create_element(array('id' => 'ctipo_comprobante',
                'type' => 'dropdown',
                'options' => $ctipo_comprobante,
                'first' => array('' => $string_values['drop_tipo_comprobante']),
                'value' => (isset($tip_comprobante_cve)) ? $tip_comprobante_cve : '',
                'class' => 'form-control',
                'attributes' => array('class' => 'form-control', 'aria-describedby' => "help-tipo-comprobante",
                    'placeholder' => $string_values['lbl_tipo_comprobante'], 'data-toggle' => 'tooltip', 'data-placement' => 'top',
                    'title' => $string_values['lbl_tipo_comprobante'])));
            ?>
            <?php echo form_error_format('ctipo_comprobante'); ?>
        </div>
        <div class="col-md-6">

            <input id="archivo-comprobante" type="file" name="file" class="file" accept="application/pdf">
            <label for='lbl_comprobante' class="control-label">
                <b class="rojo">*</b>
                <?php echo $string_values['lbl_comprobante']; ?>
            </label>
            <div class="input-group">                                           
                <?php
                echo $this->form_complete->create_element(
                        array('id' => 'text_comprobante', 'type' => 'text',
                            'value' => (isset($text_comprobante)) ? $text_comprobante : '',
                            'attributes' => array(
                                'class' => 'form-control',
                                'placeholder' => $string_values['title_cargar_comprobante'],
                                'min' => '0',
                                'max' => '500',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'bottom',
                                'title' => $string_values['title_cargar_comprobante'],
                                'readonly' => 'readonly',
                            )
                        )
                );
                ?>


                <div class="input-group-btn">
                    <button type="button" aria-expanded="false" class="btn btn-default browse">
                        <span aria-hidden="true" class="glyphicon glyphicon-file"> </span>
                    </button>
                    <a role="button" tabindex="0" data-container="body" data-trigger="focus" data-toggle="popover" data-placement="top" data-title="Comprobante" data-content="Aquí usted puede seleccionar el tipo de comprobante que se le otorgo en el curso y posteriormente subirlo al sistema para su verificación" class="btn btn-default" data-original-title="" title="">
                        <span aria-hidden="true" class="glyphicon glyphicon-question-sign"> </span>
                    </a>
                </div>
            </div><span id="help-tipo-comprobante" class="help-block"><?php echo $string_values['texto_ayuda_comprobante_comision']; ?></span>
            <?php echo form_error_format('text_comprobante'); ?>
            <input type="hidden" name="carga_file" value="">
            <?php echo form_error_format('carga_file'); ?>
        </div>
    </div>
</div>
<?php echo form_close(); ?>