<?php // pr( $identificador); ?>
<div class="list-group-item text-center center">
    <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 text-right ">
              <button type="button" id="close_modal_censo" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
    <?php if (isset($cve_comision)) {//Actualizar?> 
        <div class="col-xs-6 col-sm-6 col-md-6 text-left " >
            <button id="btn_actualizar_investigacion_docente" type="button" class="btn btn-success" data-invcve= "<?php echo $cve_comision; ?>"
                    data-comprobantecve= "<?php echo $comprobantecve; ?>" data-idrow="<?php echo $idrow; ?>" onclick="funcion_actualizar_material_educativo(this)" >
                Actualizar 
            </button>
        </div>
    <?php } else { //Guardar ?> 
        <div class="col-xs-6 col-sm-6 col-md-6 text-left" >
            <button id="btn_guardar_investigacion_docente" type="button" class="btn btn-success" onclick="funcion_guardar_material_educativo()" >
                Guardar
            </button>
        </div>
    <?php } ?> 

    </div>
</div>