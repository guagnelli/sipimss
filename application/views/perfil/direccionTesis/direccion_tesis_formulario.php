<script type="text/javascript">
$(function() {
	$("#datetimepicker1").datetimepicker( {
	    format: "YYYY", // Notice the Extra space at the beginning
	    viewMode: "years",
	    //pickTime: false
	    //minViewMode: "years"
	});
	if($('#btn_guardar_direccion_tesis').length){
        $('#btn_guardar_direccion_tesis').on('click', function() {
            //data_ajax(site_url+'/perfil/direccion_tesis_formulario/'+$(this).attr('data-value'), '#formularioDireccionTesis', '#modal_content');
            $.ajax({
	            url: site_url + '/usuario/validar_usuario_siap',
	            method: 'POST',
	            dataType: "json",
	            data: { m: mat, d: del },
	            beforeSend: function(xhr) {
	                $('#mensaje').html(create_loader('1px'));
	                $('#delegacion').attr('disabled', 'disabled');
	                $('#matricula').attr('disabled', 'disabled');
	                $("#btn_usuario_enviar").attr('disabled', 'disabled');
	            }
	        })
	        .done(function(response) {
	            
	        })
	        .fail(function(jqXHR, response) {
	            $('#mensaje').html(imprimir_resultado(response));
	        })
	        .always(function() {
	            $('#delegacion').removeAttr('disabled');
	            $('#matricula').removeAttr('disabled', 'disabled');
	            $("#btn_usuario_enviar").removeAttr('disabled');
	            remove_loader();
	        });
        });
    }

    $('.btn_subir_comprobante').click(function() {
        cargar_archivo($(this).attr('data-key'), "#formularioDireccionTesis");
    });    
});
</script>
<style type="text/css">
.userfile {
	display: none !important;
}
</style>
<div id="capa_html">
	<?php echo form_open_multipart('mi_solicitud/salvar_documentacion', array('id'=>'formularioDireccionTesis')); ?>
	<div id="capa_direccion_tesis" style="padding:20px;">
		<div class="row">
			<div class='col-lg-12'>
				<h2><?php echo $string_values['title']; ?></h2><br>
			</div>
		</div>
		<?php if(isset($msg) && !is_null($msg)){ echo $msg; } //Imprimir mensaje ?>
		<div class="row">
		    <div class='col-sm-12 col-md-12 col-lg-4 text-right'>
		        <label class="control-label">
		            <?php echo $string_values['t_h_anio']; ?>:
		        </label>
		    </div>
		    <div class='col-sm-12 col-md-12 col-lg-8 text-left'>
		        <div class="form-group">
		            <div class="input-group date datepicker" id="datetimepicker1">
		                <?php
		                echo $this->form_complete->create_element(
		                	array('id'=>'DT_ANIO','type'=>'text',
		                		'value' => $dir_tes['EC_ANIO'],
		                        'attributes'=>array(
			                        'class'=>'form-control',
			                        'placeholder'=>$string_values['t_h_anio'],
			                        'data-toggle'=>'tooltip',
			                        'title'=>$string_values['t_h_anio']
		                        )
		                    )
		                );
		                //$js_fch_fin_reg = (isset($dato_convocatoria[0]['DT_ANIO']) && !empty($dato_convocatoria[0]['FCH_FIN_REG_DOCENTE'])) ? "defaultDate:moment('".$dato_convocatoria[0]['FCH_FIN_REG_DOCENTE']."')" : '';
		                ?>
		                <span class="input-group-addon">
		                    <span class="fa fa-calendar"></span>
		                </span>
		            </div>
		        </div>
		        <?php echo form_error_format('DT_ANIO'); ?>
		    </div>
		</div>

		<div class="row">
		    <div class='col-sm-12 col-md-12 col-lg-4 text-right'>
		        <label class="control-label">
		            <?php echo $string_values['t_h_nivel_academico']; ?>:
		        </label>
		    </div>
		    <div class='col-sm-12 col-md-12 col-lg-8 text-left'>
		        <div class="form-group">
		            <div class="input-group">
		                <?php
		                echo $this->form_complete->create_element(array('id'=>'nivel_academico', 'type'=>'dropdown', 'value'=>$dir_tes['NIV_ACADEMICO_CVE'], 'options'=>$catalogos['cnivel_academico'], 'first'=>array(''=>'Selecciona...'), 'attributes'=>array('class'=>'form-control', 'placeholder'=>$string_values['t_h_nivel_academico'], 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>$string_values['t_h_nivel_academico'])));
		                ?>		                
		            </div>
		        </div>
		        <?php echo form_error_format('t_h_nivel_academico'); ?>
		    </div>
		</div>
		<div class="row">
		    <div class='col-sm-12 col-md-12 col-lg-4 text-right'>
		        <label class="control-label">
		            <?php echo $string_values['t_h_area']; ?>:
		        </label>
		    </div>
		    <div class='col-sm-12 col-md-12 col-lg-8 text-left'>
		        <div class="form-group">
		            <div class="input-group">
		                <?php
		                echo $this->form_complete->create_element(array('id'=>'comision_area', 'type'=>'dropdown', 'value'=>$dir_tes['EMP_COMISION_CVE'], 'options'=>$catalogos['comision_area'], 'first'=>array(''=>'Selecciona...'), 'attributes'=>array('class'=>'form-control', 'placeholder'=>$string_values['t_h_area'], 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>$string_values['t_h_area'])));
		                ?>
		            </div>
		        </div>
		        <?php echo form_error_format('t_h_area'); ?>
		    </div>
		</div>
		<?php $userfile = ((!empty($dir_tes['COMPROBANTE_CVE'])) ? $this->seguridad->encrypt_sha512($dir_tes['COMPROBANTE_CVE']) : null); ?>
		<div class="row">
            <div class="col-md-6">
                    <label for='' class="control-label">
                        <?php echo $string_values['lbl_tipo_comprobante']; ?>
                    </label>
                     <?php 
                        echo $this->form_complete->create_element(array('id' => 'tipo_comprobante_'.$userfile, 
                            'type' => 'dropdown', 
                            'options' => $catalogos['ctipo_comprobante'], 
                            'first' => array('' => $string_values['drop_tipo_comprobante']), 
                            'value' => $dir_tes['TIPO_COMPROBANTE_CVE'],
                            'class'=>'form-control',
                            'attributes' => array('class' => 'form-control', 'aria-describedby'=>"help-tipo-comprobante",
                            'placeholder' => $string_values['title_tipo_comprobante'], 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                            'title' => $string_values['title_tipo_comprobante'] ))); 
                    ?>
                    <?php echo form_error_format('tipo_comprobante'); ?>
            </div>            
            <div class="col-md-6" id="capa_carga_archivo_<?php echo $userfile; ?>">
                    <!-- <input type="file" id="userfile" name="userfile" class ="userfile" accept="application/pdf"> -->
                    <?php 
                    echo $this->form_complete->create_element(array('id'=>'userfile_'.$userfile, 'type'=>'upload', 'attributes'=>array(
                            'class'=>'userfile',
                            'accept'=>'application/pdf',
                            'autocomplete'=>'off'
                        )));
                    echo $this->form_complete->create_element(array('id'=>'extension_'.$userfile, 'type'=>'hidden', 'value'=>implode(',', $this->config->item('extension_comprobante')))); ?>
                    <label for='lbl_comprobante' class="control-label">
                        <?php echo $string_values['lbl_comprobante']; ?>
                    </label>
                    <div class="input-group">                                           
                        <?php
                            echo $this->form_complete->create_element(
                            array('id'=>'text_comprobante','type'=>'text',
                                    'value' => '',
                                    'attributes'=>array(
                                    'class'=>'form-control',
                                    'placeholder'=>$string_values['title_cargar_comprobante'],
                                    'min'=> '0',
                                    'max'=> '100',
                                    'data-toggle'=>'tooltip',
                                    'data-placement'=>'bottom',
                                    'title'=>$string_values['title_cargar_comprobante'],
                                    'readonly'=>'readonly',
                                    )
                                )
                            );
                        ?>                       
                      <div class="input-group-btn">
                        <button type="button" aria-expanded="false" class="btn btn-default browse">
                            <span aria-hidden="true" class="glyphicon glyphicon-file"> </span>
                        </button>
                      </div>
                    </div>
                    <div>
                    	<?php echo $this->form_complete->create_element(array(
                                    'id'=>'btn_subir_archivo',
                                    'type'=>'button',
                                    'value'=>$string_values['subir_archivo'],
                                    'attributes'=>array(
                                        'class'=>'btn-success btn_subir_comprobante pull-right',
                                        'data-key'=> $userfile
                                    ))); ?>
                    </div>
                    <?php echo form_error_format('text_comprobante'); ?>
            </div>
            <div id="error_carga_archivo_<?php echo $userfile; ?>"></div>
        </div>
	</div>
	<div class="list-group-item text-center center">
	    <div class="row">
	        <!-- <?php /*if (isset($cve_inv)) {//Actualizar?> 
	            <div class="col-xs-6 col-sm-6 col-md-6 text-right" >
	                <button id="btn_guardar_direccion_tesis" type="button" class="btn btn-success" data-invcve= "<?php echo $cve_inv; ?>"
	                        data-comprobantecve= "<?php echo $comprobantecve; ?>" data-idrow="<?php echo $idrow; ?>" onclick="guardar_direccion_tesis(this)" >
	                    Actualizar 
	                </button>
	            </div>
	        <?php } else { //Guardar ?> 
	            <div class="col-xs-6 col-sm-6 col-md-6 text-right" >
	                <button id="btn_guardar_direccion_tesis" type="button" class="btn btn-success" onclick="guardar_direccion_tesis()" >
	                    Guardar
	                </button>
	            </div>
	        <?php }*/ ?> -->
	        <div class="col-xs-6 col-sm-6 col-md-6 text-right" >
	            <button id="btn_guardar_direccion_tesis" type="button" class="btn btn-success" data-value="<?php echo $identificador; ?>">
	                <?php echo $string_values['guardar']; ?>
	            </button>
	        </div>
	        <div class="col-xs-6 col-sm-6 col-md-6 text-left">
	            <button type="button" id="close_modal_censo" class="btn btn-success" data-dismiss="modal"><?php echo $string_values['cerrar']; ?></button>
	        </div>
	    </div>
	</div>
	<?php echo form_close(); ?>
</div>