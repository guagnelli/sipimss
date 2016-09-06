<div class="list-group">

    <div class="list-group-item">      
        <div>
            <br>
            <?php echo $string_values['title_becas']; ?>
            <br>
        </div>
        <div class='row'>
            <div class="form-group col-xs-4 col-md-4 col-md-offset-8">
                <button type="button" class="btn btn-success btn-lg" id="btn_gregar_beca_modal" data-toggle="modal" data-target="#modal_censo">
                    <?php echo $string_values['btn_agregar_beca']; ?>
                </button>
            </div>
        </div>
        <div class='row'> 
            <div class="form-group col-xs-12 col-md-12">
                <table class="table table-striped table-hover table-bordered" id="tabla_becas">
                    <thead>
                        <tr class="btn-default">
                            <th><?php echo $string_values['title_tab_becas_clase_beca']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_fecha_inicio']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_fecha_termino']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_motivo_beca']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_beca_interrumpida']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_comprobante']; ?></th>
                            <th><?php echo $string_values['tab_titulo_g_ver']; ?></th>
                            <th><?php echo $string_values['tab_titulo_g_validar']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($lista_becas as $key_ai => $val) {
                            $key = $val['emp_beca_cve'];
                            $key = $this->seguridad->encrypt_base64($key);
                            $idcomprobante = $val['comprobante'];
                            if (!is_null($idcomprobante)) {
                                //Btn comprobante
                                $idcomprobante = $this->seguridad->encrypt_base64($idcomprobante); //Encripta
                                $btn_comprobante = '<a href="' . site_url('administracion/ver_archivo/' . $idcomprobante) . '" target="_blank">' . $string_values['lbl_ver_comprobante'] . '</a>';
                            } else {
                                $comprobante = 0;
                                $btn_comprobante = '';
                            }
                            //Crea los row de la tabla
                            echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                            echo "<td>" . $val['nom_beca'] . "</td>";
                            echo "<td>" . $val['fecha_inicio'] . "</td>";
                            echo "<td>" . $val['fecha_fin'] . "</td>";
                            echo "<td>" . $val['nom_motivo_beca'] . "</td>";
                            echo "<td>" . $val['msj_beca_interrumpida'] . "</td>";
                            echo "<td>" . $btn_comprobante . "</td>";
                            echo "<td>"
                            . '<button '
                            . 'type="button" '
                            . 'class="btn btn-link btn-sm" '
                            . 'data-idrow ="' . $key_ai . '"'
                            . 'data-becacve ="' . $key . '"'
                            . 'data-comprobantecve ="' . $idcomprobante . '"'
                            . 'data-toggle="modal"'
                            . 'data-target="#modal_censo"'
                            . 'onclick="funcion_editar_reg_beca(this)" >' .
                            $string_values['tab_titulo_g_ver']
                            . '</button>'
                            . "</td>";
                            echo "<td>"//Botón eliminar
                            . '<button '
                            . 'type="button" '
                            . 'class="btn btn-link btn-sm" '
                            . 'id="btn_editar_mat_educativo" '
                            . 'data-idrow ="' . $key_ai . '"'
                            . 'data-becacve ="' . $key . '"'
                            . 'data-comprobantecve ="' . $idcomprobante . '"'
                            . 'onclick="funcion_eliminar_reg_beca(this)" >' .
                            $string_values['tab_titulo_g_validar']
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