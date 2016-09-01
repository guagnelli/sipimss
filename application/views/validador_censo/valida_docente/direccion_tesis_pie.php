<?php // pr( $identificador); ?>
<div class="list-group-item text-center center">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 text-right" >
            <button id="btn_guardar_direccion_tesis" type="button" class="btn btn-success" onclick="envio_correccion(this)">
                <?php echo $string_values['lbl_no_validar_n1']; ?>
            </button>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 text-left">
            <button id="btn_guardar_direccion_tesis" type="button" class="btn btn-success" onclick="envio_validacion(this)">
                <?php echo $string_values['lbl_validar_docente_n1']; ?>
            </button>
        </div>
    </div>
</div>