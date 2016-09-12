<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="div_tabla_res_busqueda_docentes" class="table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_resultados_validacion_evaluacion">
        <thead>
            <tr class="bg-info">
                <th><?php echo $string_values['lbl_seleccionar'] . "&nbsp" . $seleccionar ?></th>
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
//            foreach ($lista_docentes_validar as $key => $val) {
//                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
//                echo "<td>" . $checkbox_profesionalizacio . "</td>";
////                echo "<td> </td>";
//                echo "<td>" . $val['matricula'] . "</td>";
//                echo "<td>" . $val['nom_docente'] . "</td>";
//                echo "<td>" . $val['nom_categoria'] . "</td>";
//                echo "<td>" . $val['nom_delegacion'] . "</td>";
//                echo "<td>" . $val['unidad_adscripcion'] . "</td>";
//                echo "<td>" . $val['nom_estado_validacion'] . "</td>";
//                echo "<td>" . $val['fecha_ultima_actualizacion'] . "</td>";
//                echo "<td> ";
//                echo "<span  " . $link_ver_curso . "><a data-toggle='tab' href='#select_perfil_validar_evaluacion'> " . $string_values['lbl_validar_empleado'] . " </a></span>";
//                echo "<span class='text-center'>" . $link_ver_comentario . "</span>";
//                echo "</td> ";
//                echo "</tr>";
//            }
            ?>
        </tbody>
    </table>
</div>