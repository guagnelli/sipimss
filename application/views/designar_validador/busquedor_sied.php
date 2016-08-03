<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php echo form_open('', array('id' => 'form_buscador_validador')); ?>
<div class="row" >
    <div class="col-lg-12 col-sm-12" >
        <div class="panel-body input-group"  >
            <span class="input-group-addon">
                <?php echo $string_values['lbl_buscar_otro_usuario']; ?>
            </span>

            <?php
            echo $this->form_complete->create_element(
                    array('id' => 'buscar_unidad_medica', 'type' => 'text',
                        'value' => '',
                        'attributes' => array(
                            'placeholder' => $string_values['txt_buscar_matricula'],
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'bottom',
                            'onkeypress' => 'return runScript(event);',
                            'title' => $string_values['txt_buscar_matricula'],
                        //                                        'readonly'=>'readonly',
                        )
                    )
            );
            ?>
            <div class="input-group-btn">
                <button type="button" id="btn_buscar_b" aria-expanded="false" class="btn btn-default browse" 
                        title="<?php echo$string_values['txt_buscar_unidad']; ?>" data-toggle="tooltip" 
                        data-tipoevento ="buscar" 
                        data-idvalidador="<?php echo $reg_id_validador; ?>"
                        data-delcve="<?php echo $reg_delegacion_cve; ?>"
                        data-depcve="<?php echo $reg_departamento_desc; ?>"
                        onclick="funcion_buscar_validador(this)" >
                    <span aria-hidden="true" class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
