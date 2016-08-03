<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <label for='lbl_no_existe_usuario' class="alert alert-info">
        <?php if (isset($mensaje)) {
            echo $mensaje;
        } ?>
    </label>