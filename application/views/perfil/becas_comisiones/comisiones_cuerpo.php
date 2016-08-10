<div class="list-group">
    <div>
        <br>
        <?php echo $string_values['title_comisiones']; ?>
        <br>
    </div>
    <div class="list-group-item">      
        <div class='row'>
            <div class="form-group col-xs-4 col-md-4 col-md-offset-8">
                <button type="button" class="btn btn-success btn-lg" id="btn_gregar_comision_modal" data-toggle="modal" data-target="#modal_censo">
                    <?php echo $string_values['btn_agregar_comision']; ?>
                </button>
            </div>
        </div>
        <div class='row'> 
            <div class="form-group col-xs-12 col-md-12">
                <table class="table table-striped table-hover table-bordered" id="tabla_becas">
                    <thead>
                        <tr class="btn-default">
                            <th><?php echo $string_values['title_tab_comision_fecha_inicio']; ?></th>
                            <th><?php echo $string_values['title_tab_comision_fecha_termino']; ?></th>
                            <th><?php echo $string_values['title_tab_comision_comprobante']; ?></th>
                            <th><?php echo $string_values['title_tab_comision_editar']; ?></th>
                            <th><?php echo $string_values['title_tab_comision_eliminar']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
//                            pr($lista_becas);
                        foreach ($lista_comisiones as $key_ai => $val) {
                            $key = $val['cve_investigacion'];
                            $c_bb = $val['cita_publicada'];
                            if (is_null($c_bb)) {//Pone texto referente a que no existe una cita bibliografica
                                $tiene_cita = $string_values['text_sin_cita'];
                                $comprobante = (is_null($val['comprobante_cve'])) ? 0 : $val['comprobante_cve'];
                                //Nota: agregar vinculo para mostrar el documento cargado
                            } else {//Crea boton vinculo para ver cita bibliografica
                                $comprobante = 0;
                                $tiene_cita = '<button '
                                        . 'type="button" '
                                        . 'class="btn btn-link btn-sm" '
                                        . 'id="btn_ver_cita_bibliografica" '
                                        . 'data-cita ="' . $c_bb . '"'
                                        . 'onclick="funcion_ver_cita_bibliografica(this)" >' .
                                        $string_values['text_con_cita']
                                        . '</button>';
                            }
                            //Crea los row de la tabla
                            echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                            echo "<td>" . $val['tpad_nombre'] . "</td>";
                            echo "<td>" . $val['nombre_investigacion'] . "</td>";
                            echo "<td>" . $val['folio_investigacion'] . "</td>";
                            echo "<td>" . $tiene_cita . "</td>";
                            echo "<td>"
                            . '<button '
                            . 'type="button" '
                            . 'class="btn btn-link btn-sm" '
                            . 'id="btn_eliminar_actividad_modal" '
                            . 'data-idrow ="' . $key_ai . '"'
                            . 'data-invcve ="' . $key . '"'
                            . 'data-comprobantecve ="' . $comprobante . '"'
                            . 'data-toggle="modal"'
                            . 'data-target="#modal_censo"'
                            . 'onclick="funcion_editar_reg_investigacion(this)" >' .
                            $string_values['tab_titulo_editar']
                            . '</button>'
                            . "</td>";
                            echo "<td>"//Botón eliminar
                            . '<button '
                            . 'type="button" '
                            . 'class="btn btn-link btn-sm"'
                            . 'id="btn_eliminar_actividad_modal" '
                            . 'data-idrow ="' . $key_ai . '"'
                            . 'data-invcve ="' . $key . '"'
                            . 'data-comprobantecve ="' . $comprobante . '"'
                            . 'onclick="funcion_eliminar_reg_investigacion(this)" >' .
                            $string_values['tab_titulo_eliminar']
                            . '</button>'
                            . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>