<?php defined('BASEPATH') OR exit('No direct script access allowed');

//$tipo_admin = $this->config->item('tipo_admin');

//$tipo_usuario = $this->session->userdata('tipo_admin');
        
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center"><?php echo $string_values['buscador']['tab_head_matricula'] ?></th>
                    <th class="text-center"><?php echo $string_values['buscador']['tab_head_nombre'] ?></th>
                    <th class="text-center"><?php echo $string_values['buscador']['tab_head_delegacion'] ?></th>
                    <th class="text-center"><?php echo $string_values['buscador']['tab_head_adscripcion'] ?></th>
                    <th class="text-center"><?php echo $string_values['buscador']['tab_head_rol'] ?></th>
                    <th class="text-center"><?php echo $string_values['buscador']['tab_head_estado'] ?></th>
                    <th class="text-center"><?php echo $string_values['general']['acciones'] ?></th>
                </tr>
            </thead>
            <tbody>
                    <?php //Generará la tabla que muestrá las actividades del docente
                    $html = "";
                    foreach ($data as $usu) {
                        $html_rol = "";
                        foreach ($usu['rol'] as $rol) {
                            $html_rol .= '- '.$rol['ROL_NOMBRE'].'<br>';
                        }
                        $html .= '<tr id="tr_'.$this->seguridad->encrypt_base64($usu['USUARIO_CVE']).'">
                                <td>'.$usu['USU_MATRICULA'].'</td>
                                <td>'.$usu['nombre'].'</td>
                                <td>'.$usu['nom_delegacion'].'</td>
                                <td>'.$usu['dep_nombre'].'</td>
                                <td>'.$html_rol.'</td>
                                <td>'.$usu['EDO_USUARIO_DESC'].'</td>
                                <td><button type="button" class="btn btn-link btn-sm btn_editar_usu" data-toggle="modal" data-target="#modal_censo" data-value="'.$this->seguridad->encrypt_base64($usu['USUARIO_CVE']).'">'.
                                       $string_values['general']['editar'].
                                    '</button>
                                    <button type="button" class="btn btn-link btn-sm btn_eliminar_usu" data-value="'.$this->seguridad->encrypt_base64($usu['USUARIO_CVE']).'">'.
                                           $string_values['general']['eliminar'].
                                        '</button>
                                </td>
                            </tr>';
                    }
                    echo $html;
                    ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>