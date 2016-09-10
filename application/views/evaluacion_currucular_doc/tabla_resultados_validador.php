<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_unidades);
?>
<div id="tabla_designar_validador" class="table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
        <thead>
            <tr class="bg-info">
                <th></th>
                <th><?php echo $string_values['titulo_tab_matricula'] ?></th>
                <th><?php echo $string_values['titulo_tab_nombre'] ?></th>
                <th><?php echo $string_values['titulo_tab_categoria'] ?></th>
                <th><?php echo $string_values['titulo_tab_delegacion'] ?></th>
                <th><?php echo $string_values['titulo_tab_unidad'] ?></th>
                <th><?php echo $string_values['titulo_tab_estado_validacion'] ?></th>
                <th><?php echo $string_values['titulo_tab_fecha_ultimo_estado'] ?></th>
                <th><?php echo $string_values['titulo_tab_acciones'] ?></th>
                <!--<th>Opciones</th>-->
            </tr>
        </thead >
        <tbody>
            <?php
            foreach ($lista_docentes_validar as $key_ai => $val) {
//                pr($val['hist_validacion_cve']);
                
                $solicitud_cve = $this->seguridad->encrypt_base64(intval($val['solicitu_cve']));
                $empleado_cve = $this->seguridad->encrypt_base64(intval($val['empleado_cve']));
                $matricula = $this->seguridad->encrypt_base64($val['matricula']);
                
                $hist_val_cve = $this->seguridad->encrypt_base64(intval($val['historia_validacion_cve']));
                $estado_val = $this->seguridad->encrypt_base64(intval($val['estado_validacion']));
                
                $convocatoria_cve = $this->seguridad->encrypt_base64(intval($val['convocatori_cve']));
                $link_ver_comentario = '';
                if(intval($val['is_comentario'])===1){//link_ver_comentario
                $link_ver_comentario = '<button '
                            . 'id="btn_ver_comentario" '
                            . 'type="button" '
                            . 'class="btn btn-link btn-sm" '
                            . 'data-idrow ="' . $key_ai . '"'
                            . 'data-histvalcve="' . $hist_val_cve . '"' 
                            . 'data-toggle="modal"'
                            . 'data-target="#modal_censo"'
                            . 'onclick="ver_comentario_estado_doc(this)" >' .
                            $string_values['link_ver_comentario']
                            . '</button>';
                }
                
                $link_ver_curso = 'class="text-center" onclick="funcion_ver_validacion_empleado(this)" '
                        . 'data-empcve="' . $empleado_cve . '"' 
                        . 'data-matricula="' . $matricula . '"' 
                        . 'data-estval="' . $estado_val . '"' 
                        . 'data-histvalcve="' . $hist_val_cve . '"' 
                        . 'data-solicitudcve="' . $solicitud_cve . '"' 
                        . 'data-convocatoriacve="' . $convocatoria_cve . '"';
                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                echo "<td> </td>";
                echo "<td>" . $val['matricula'] . "</td>";
                echo "<td>" . $val['nom_docente'] . "</td>";
                echo "<td>" . $val['nom_categoria'] . "</td>";
                echo "<td>" . $val['nom_delegacion'] . "</td>";
                echo "<td>" . $val['unidad_adscripcion'] . "</td>";
                echo "<td>" . $val['nom_estado_validacion'] . "</td>";
                echo "<td>" . $val['fecha_ultima_actualizacion'] . "</td>";
                echo "<td> ";
                echo "<span  " . $link_ver_curso . "><a data-toggle='tab' href='#select_perfil_validar'> " .$string_values['lbl_validar_empleado']. " </a></span>";
                echo "<span class='text-center'>" . $link_ver_comentario . "</span>";
                echo "</td> ";
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</div>