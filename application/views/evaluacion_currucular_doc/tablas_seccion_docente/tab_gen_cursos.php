<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$seleccionar = $this->form_complete->create_element(array('id' => 'checkall_' . $acronimo,
    'value' => '', 'type' => 'checkbox',
    'attributes' => array('class' => 'form-control',
        'placeholder' => $string_values['chek_selct_profesionalizacion'],
        'onclick' => "seleccionar_deseleccionar_tablas(this)",
        'data-tabla' => "trve_" . $acronimo,
        'data-check' => "checkall_" . $acronimo,
        'title' => $string_values['chek_selct_profesionalizacion'])));
?>

<table class="table table-striped table-hover table-bordered" id="trve_<?php echo $acronimo; ?>">
    <thead>
        <tr class='success'>
            <th class="text-center"><?php echo $string_values['lbl_seleccionar'] . "&nbsp" . $seleccionar ?></th>
            <th class="text-center"><?php echo $string_values['title_curso'] ?></th>
            <th class="text-center"><?php echo $string_values['title_tipo_curso'] ?></th>
            <th class="text-center"><?php echo $string_values['title_acciones'] ?></th>
        </tr>
    </thead>
    <tbody>

        <?php
//Generará la tabla que muestrá las actividades del docente
        foreach ($datos_modulo as $key_ai => $value) {
            $key = $this->seguridad->encrypt_base64($value[$pk]);//
            $seccion_metodo = $ver_datos;
            $checkbox_profesionalizacio = $this->form_complete->create_element(array(
                'id' => 'check_' . $key_ai,
                'value' => '', 'type' => 'checkbox',
                'attributes' => array('class' => 'form-control')));

            $ver = '<button type="button" class="btn btn-link btn-sm btn_ver_me" '
                    . 'aria-expanded="false" data-toggle="modal" '
                    . 'data-target="#modal_censo" '
                    . 'data-value="' . $key . '" '
                    . 'data-seccion="' . $seccion_metodo . '" '
                    . 'onclick="ver_curso(this);">' .
                    $string_values['accion_ver'] .
                    '</button>';
            echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
            echo "<td>" . $checkbox_profesionalizacio . "</td>";
            echo "<td>" . $value[$curso] . "</td>";
            echo "<td>" . $value[$tipo_curso] . "</td>";
            echo "<td>" . $ver . "</td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>
<br>