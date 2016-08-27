<script type="text/javascript">
var confirmar_eliminacion = "<?php echo $string_values['confirmar_eliminacion']; ?>";
</script>
<?php echo js('validacion_censo_profesores/direccion_tesis.js'); ?>
<div class="list-group">
    <div id = 'tab_content_actividad_docente' class='tab-content col-md-12'>
        <div id = 'actividad_docente_tab' class='tab-pane fade in active'>
			<div class="panel-body">
                <div>
                   <br>
                       <h4><?php echo $string_values['title']; ?></h4>
                   <br>
                </div>
                <div id="mensaje"></div>
                <div class="row">
				    <div class='col-sm-12 col-md-12 col-lg-12 text-right'>
				    	<div>
			                <button type="button" id="btn_agregar_direccion_tesis_modal" aria-expanded="false" class="btn btn-success" data-toggle="modal" data-target="#modal_censo" data-value="">
			                    <?php echo $string_values['btn_add_new_direccion']; ?>
			                </button>
			            </div>
				    </div>
				</div><br>
                <?php if(isset($lista_direccion)){?>
                    <div class="row" >
                            <div id="div_direccion_tesis" class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="tabla_direccion_tesis">
                                    <thead>
                                        <tr class='btn-default'>
                                            <th><?php echo $string_values['t_h_anio']; ?></th>
                                            <th><?php echo $string_values['t_h_nivel_academico']; ?></th>
                                            <th><?php echo $string_values['t_h_area']; ?></th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php //Generará la tabla que muestrá las actividades del docente
                                    		foreach ($lista_direccion as $key_ld => $direccion) {
                                    			$id = $this->seguridad->encrypt_base64($direccion['EMP_COMISION_CVE']);
												echo '<tr id="tr_'.$id.'">
													<td>'.$direccion['EC_ANIO'].'</td>
													<td>'.$direccion['NIV_ACA_NOMBRE'].'</td>
													<td>'.$direccion['COM_ARE_NOMBRE'].'</td>
													<td><button type="button" class="btn btn-link btn-sm btn_editar_dt" aria-expanded="false" data-toggle="modal" data-target="#modal_censo" data-value="'.$id.'">'.
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
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
                <?php } ?>
            </div>
	    </div><!--Termina primer tab-->                
    </div>
</div>
