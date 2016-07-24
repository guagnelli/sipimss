<?php // pr( $identificador); ?>
<div class="list-group-item text-center center">
    <div class="row">
        <!--<div class="col-xs-12 col-sm-12 col-md-6 text-right rightSpring" >-->
            <div class="modal-footer  col-xs-6 col-sm-6 col-md-6 text-left ">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        <!--</div>-->
    <?php if (isset($id_inv)) {//Actualizar?> 
        <div class="col-xs-6 col-sm-6 col-md-6 text-left " >
            <button id="btn_actualizar_investigacion_docente" type="button" class="btn btn-success" onclick="" >
                Actualizar 
            </button>
        </div>
    <?php } else { //Guardar ?> 
        <div class="col-xs-6 col-sm-6 col-md-6 text-left" >
            <button id="btn_guardar_investigacion_docente" type="button" class="btn btn-success" onclick="funcion_guardar_investigacion()" >
                Guardar
            </button>
        </div>
    <?php } ?> 

    </div>
</div>


<!--        <div class="col-md-6">
            <label for='lbl_curso' class="control-label">
                <b class="rojo">*</b>
<?php // echo $string_values['lbl_curso']; ?>
            </label>
            <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-education"> </span>
                </span>
<?php
//                    echo $this->form_complete->create_element(array('id' => 'ccurso', 'type' => 'dropdown', 
//                        'options' => $ccurso, 
//                        'first' => array('' => $string_values['drop_curso']), 
//                        'value' => '',
//                        'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
//                        'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
//                        'title' => $string_values['lbl_curso'] ))); 
?>
           </div>
<?php //   echo form_error_format('ccurso'); ?>
        </div>-->