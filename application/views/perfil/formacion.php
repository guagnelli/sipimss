<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->lang->load('interface','spanish');
$string_values = $this->lang->line('interface');

?>

<ul class="nav nav-tabs">
    <li class="active">
        <a data-toggle="tab" href="#formacionPersonalSalud">
            <strong>
                <?php echo $string_values['perfil']['lbl_formacion_personal_salud']; ?>
            </strong>
        </a>
    </li>
    <li>
        <a data-toggle="tab" href="#formacionDocente">
            <strong>
                <?php echo $string_values['perfil']['lbl_formacion_docente']; ?>
            </strong>
        </a>
    </li>
</ul>
<div id = 'tabContentFormacion' class='tab-content'>
    <div id = 'formacionPersonalSalud' class = 'tab-pane fade in active'>
        formacion salud
    </div>
    <div id = 'formacionDocente' class = 'tab-pane fade'>
        formacion docente
    </div>
</div>