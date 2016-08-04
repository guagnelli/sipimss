<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_unidades);
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/designar_validador/designar_validador.js"></script>
<div id="tabla_designar_validador" class="table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
        <thead>
            <tr class='btn-default'>
                <th><?php echo $string_values['tab_titulo_unidades'] ?></th>
                <th><?php echo $string_values['tab_titulo_designado'] ?></th>
                <th><?php echo $string_values['tab_delegacion_validador'] ?></th>
                <th><?php echo $string_values['tab_titulo_matricula'] ?></th>
                <th><?php echo $string_values['tab_titulo_nombre'] ?></th>
                <th><?php echo $string_values['tab_categoria_validador'] ?></th>
                <th><?php echo $string_values['tab_titulo_seleccionar_validador'] ?></th>
                <!--<th>Opciones</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($lista_unidades as $key_ai => $val) {
                $id_validador = (empty($val['validador_cve'])) ? 0 : $val['validador_cve'];
                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                echo "<td>" . $val['nom_departamento'] . "</td>";
                echo "<td text-center>" .
                $this->form_complete->create_element(
                        array('id' => 'pago_extra', 'type' => 'checkbox',
                            'value' => $val['validador_cve'],
                            'attributes' => array(
                            'checked' => ($id_validador===0) ? '' : 'checked',
                            'class' => 'text-center',
                            )
                        )
                )
                . "</td>";
                echo "<td>" . $val['nom_delegacion'] . "</td>";
                echo "<td>" . $val['matricula_empleado'] . "</td>";
                echo "<td>" . $val['nom_empleado'] . "</td>";
                echo "<td>" . $val['categoria_cve'] . "</td>";
                echo "<td>"
                . '<button '
                . 'type="button" '
                . 'class="btn btn-link btn-sm" '
                . 'id="btn_eliminar_actividad_modal" '
                . 'data-idrow ="' . $key_ai . '"'
                . 'data-toggle="modal"'
                . 'data-target="#modal_censo"'
                . 'data-idvalidador="' . $id_validador . '"'
                . 'data-delcve="' . $val['delegacion_cve'] . '"'
                . 'data-depcve="' . $val['departamento_cve'] . '"'
                . 'data-tipoevento="cargarseleccion"'
                . 'onclick="funcion_carga_elemento(this)" >' .
                $string_values['tab_titulo_seleccionar_validador']
                . '</button>'
                . "</td>";
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</div>