<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <div class="panel-body input-group">
        <?php     if(!isset($matricula)){ ?>
            <label for='lbl_matricula' class="control-label">
                 <?php echo $string_values['lbl_matricula'] + ' ' + $matricula;  ?>
            </label>
            <label for='lbl_nombre' class="control-label">
                 <?php echo $string_values['lbl_nombre'] + ' ' + $nombre; ?>
            </label>
            <label for='lbl_adscripcion' class="control-label">
                 <?php echo $string_values['lbl_adscripcion'] + ' ' + $adscripcion; ?>
            </label>
            <label for='lbl_categoria' class="control-label">
                 <?php echo $string_values['lbl_categoria'] + ' ' + $categoria; ?>
            </label>
        <?php     }else{?>
            <label for='lbl_no_existe_usuario' class="control-label">
                 <?php echo $string_values['lbl_no_existe_usuario']?>
            </label>
        <?php     }?>

    </div>
