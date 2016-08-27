<script type="text/javascript">
var confirmar_eliminacion = "<?php echo $string_values['confirmar_eliminacion']; ?>";
</script>
<?php echo js('validacion_censo_profesores/comision_academica.js'); ?>
<div class="list-group">
    <div id='tab_content_comision_academica' class='tab-content col-md-12'>
        <div id='comision_academica_tab' class='tab-pane fade in active'>
			<div class="panel-body">
                <div>
                    <h4><?php echo $string_values['title']; ?></h4><br>
                </div>
                <div id="mensaje"></div>
                <?php $inc=0;
                	foreach ($catalogos['ctipo_comision'] as $key_tc => $tipo_comision) { ?>
                	<div class="panel-group" id="accordion_<?php echo $key_tc; ?>" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="head_<?php echo $key_tc; ?>">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion_<?php echo $key_tc; ?>" href="#collapseOne_<?php echo $key_tc; ?>" aria-controls="collapseOne_<?php echo $key_tc; ?>">
									<?php echo $tipo_comision; ?>
									</a>
								</h4>
							</div>
							<div id="collapseOne_<?php echo $key_tc; ?>" class="panel-collapse collapse <?php /*echo ($inc>0) ? '' :*/ 'in'; ?>" role="tabpanel" aria-labelledby="head_<?php echo $key_tc; ?>">
								<div class="panel-body">
									<div class="row">
									    <div class='col-sm-12 col-md-12 col-lg-12 text-right'>
									    	<div>
								                <button type="button" aria-expanded="false" class="btn btn-success btn_agregar_comision_academica_modal" data-toggle="modal" data-target="#modal_censo" data-value="" data-com="<?php echo $this->seguridad->encrypt_base64($key_tc); ?>">
								                    <?php echo $string_values['btn_add_new_comision_academica']; ?>
								                </button>
								            </div>
									    </div>
									</div><br>
									<div class="row" >
			                            <div id="div_comision_academica" class="table-responsive">
			                                <table class="table table-striped table-hover table-bordered" id="tabla_comision_academica">
			                                    <thead>
			                                        <tr class='btn-default'>
			                                        	<?php
			                                        	foreach ($columns[$key_tc] as $title) {
															echo '<th>'.$title.'</th>';
														}
			                                            echo '<th>'.$string_values['t_h_opciones'].'</th>'; ?>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
			                                        <?php //Generará la tabla que muestrá las actividades del docente
		                                    		foreach ($comisiones[$key_tc] as $key_ca => $comision_academica) {
		                                    			$id = $this->seguridad->encrypt_base64($comision_academica['EMP_COMISION_CVE']);
														echo '<tr id="tr_'.$id.'">';
														foreach ($columns[$key_tc] as $key_dato => $dato) {
															echo '<td>'.$comision_academica[$key_dato].'</td>';
														}
														echo '<td><button type="button" class="btn btn-link btn-sm btn_editar_ca" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'" data-com="'.$this->seguridad->encrypt_base64($key_tc).'">'.
							                                       $string_values['tab_titulo_g_ver'].
							                                    '</button>
							                                    <button type="button" class="btn btn-link btn-sm btn_eliminar_dt" data-value="'.$id.'">'.
							                                           $string_values['tab_titulo_g_validar'].
							                                        '</button>
							                                </td>
														</tr>';
													}
				                                	?>
				                                </tbody>
					                        </table>
					                    </div>
					                </div>
								</div>
							</div>
						</div>
					</div>
                <?php $inc++;
            	} ?>
            </div>
	    </div><!--Termina primer tab-->                
    </div>
</div>
