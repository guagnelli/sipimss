<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_unidades);
?>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/designar_validador/designar_validador.js"></script>
<div id="tabla_designar_validador" class="table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
        <thead>
            <tr class="bg-info">
                <th><?php echo $string_values['titulo_tab_matricula'] ?></th>
                <th><?php echo $string_values['titulo_tab_nombre'] ?></th>
                <th><?php echo $string_values['titulo_tab_categoria'] ?></th>
                <th><?php echo $string_values['titulo_tab_fecha_ultimo_estado'] ?></th>
                <th><?php echo $string_values['titulo_tab_estado_validacion'] ?></th>
                <th><?php echo $string_values['titulo_tab_ver_ultimo_comentario'] ?></th>
                <th><?php echo $string_values['titulo_tab_validar_cursos'] ?></th>
                <!--<th>Opciones</th>-->
            </tr>
        </thead >
        <tbody>
            <?php
            foreach ($lista_docentes_validar as $key_ai => $val) {
                $empleado_cve = $this->seguridad->encrypt_base64($val['empleado_cve']);
                $matricula = $this->seguridad->encrypt_base64($val['matricula']);
                $estado_val = $this->seguridad->encrypt_base64($val['estado_validacion']);
                $validador_cve = $this->seguridad->encrypt_base64($val['validador_cve']);
                $hist_val_cve = $this->seguridad->encrypt_base64($val['hist_validacion_cve']);
                $val_grl_cve = $this->seguridad->encrypt_base64($val['validaor_grl_cve']);
                $usuario_cve = $this->seguridad->encrypt_base64($val['usuario_cve']);
                $link_ver_ultimo_comentario = '<a href="#select_perfil_validar" data-toggle="tab" aria-expanded="true"> ';
                $link_ver_curso_2 = '<button type="button" id="btn_ver_validacion_empleado" aria-expanded="false" '
                        . 'class="nav nav-pills nav-stacked" title="'.$string_values['lbl_validar_empleado'].'" '
                        . 'data-toggle="tooltip" onclick="funcion_ver_validacion_empleado(this)"'
                        . 'data-empcve="' . $empleado_cve . '"' 
                        . 'data-matricula="' . $matricula . '"' 
                        . 'data-estval="' . $estado_val . '"' 
                        . 'data-validadorcve="' . $validador_cve . '"' 
                        . 'data-histvalcve="' . $hist_val_cve . '"' 
                        . 'data-valgrlcve="' . $val_grl_cve . '"' 
                        . 'data-usuariocve="' . $usuario_cve . '"' 
                        . '<span class="glyphicon-class">'.$string_values['lbl_validar_empleado'].'</span>'
                        . '<span aria-hidden="true" class="glyphicon glyphicon-arrow-right"></span></button>';
                $link_ver_curso = 'class="text-center" onclick="funcion_ver_validacion_empleado(this)" '
                        . 'data-empcve="' . $empleado_cve . '"' 
                        . 'data-matricula="' . $matricula . '"' 
                        . 'data-estval="' . $estado_val . '"' 
                        . 'data-validadorcve="' . $validador_cve . '"' 
                        . 'data-histvalcve="' . $hist_val_cve . '"' 
                        . 'data-valgrlcve="' . $val_grl_cve . '"' 
                        . 'data-usuariocve="' . $usuario_cve . '"';
                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                echo "<td>" . $val['matricula'] . "</td>";
                echo "<td>" . $val['nom_docente'] . "</td>";
                echo "<td>" . $val['emp_categoria'] . "</td>";
                echo "<td>" . $val['fecha_estado_validacion'] . "</td>";
                echo "<td>" . $val['nombre_estado_validacion'] . "</td>";
                echo "<td class='text-center'>" . $link_ver_ultimo_comentario . "</td>";
                echo "<td  " . $link_ver_curso . "><a data-toggle='tab' href='#select_perfil_validar'> " .$string_values['lbl_validar_empleado']. " </a></td>";
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</div>