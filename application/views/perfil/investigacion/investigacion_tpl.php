<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$fecha_ultima_actualizacion = 'Fecha de última actualizacón: 11 de julio de 2016 ';
?>

<style type="text/css">
    .button-padding {padding-top: 30px}
    .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    /*Oculta el file para cargar comprobante y deja asi solo muestra un botón*/
    .userfile {visibility: hidden;  position: absolute;}
</style>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/perfil/investigacion_docente.js"></script>

<!-- Inicio informacion personal -->


<div class="list-group">

    <div class="list-group-item">
        <div class='row text-right'>
            <font size=1><?php echo $fecha_ultima_actualizacion; ?></font>
        </div>
        <div class='row' >

            <div class="row" style='display:hidden;' id='div_error_inv_doc'>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <?php /*  if($tipo_msg==='danger' || $tipo_msg==='warning'){
                      $colapso_div_ejercicio_profesional = 'collapse in';
                      }
                      echo html_message($error, $tipo_msg); */ ?>
                    <div id='mensaje_error_inv_doc_div' class='alert'>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id='mensaje_error_inv_doc'></span>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>

        </div>
    </div>
    <div class="list-group-item">

        <div class="panel-body">
            <div>
                <br>
                <h4>Investigación </h4>
                <br>
            </div>

            <div class="row">
                <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">


                </div>
                <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                    <button type="button" class="btn btn-success btn-lg" id="btn_agregar_investigacion_modal" data-toggle="modal" data-target="#modal_censo">
                        <?php echo $string_values['btn_add_new_investigacion']; ?>
                    </button>
                </div>
            </div>

            <div class="row" >
                <div id="tabla_actividades_docente" class="table-responsive">
                    <!--Mostrará la tabla de actividad docente --> 
                    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
                        <thead>
                            <tr class='btn-default'>
                                <th><?php echo $string_values['tab_titulo_tipo_investigacion'] ?></th>
                                <th><?php echo $string_values['tab_titulo_nombre_trabajo_investigacion'] ?></th>
                                <th><?php echo $string_values['tab_titulo_folio'] ?></th>
                                <th><?php echo $string_values['tab_titulo_cita_bibliografica'] ?></th>
                                <th><?php echo $string_values['tab_titulo_editar'] ?></th>
                                <th><?php echo $string_values['tab_titulo_eliminar'] ?></th>
                                <!--<th>Opciones</th>-->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
//                            pr($lista_investigaciones);
                            foreach ($lista_investigaciones as $key_ai => $val) {
                                $key = $val['cve_investigacion'];
                                $c_bb = $val['cita_publicada'];
                                if (is_null($c_bb)) {//Pone texto referente a que no existe una cita bibliografica
                                    $tiene_cita = $string_values['text_sin_cita'];
                                    $comprobante = (is_null($val['comprobante_cve'])) ? $val['comprobante_cve'] : 0;
                                    //Nota: agregar vinculo para mostrar el documento cargado
                                } else {//Crea boton vinculo para ver cita bibliografica
                                    $comprobante = 0;
                                    $tiene_cita = '<button '
                                            . 'type="button" '
                                            . 'class="btn btn-link btn-sm" '
                                            . 'id="btn_ver_cita_bibliografica" '
                                            . 'data-cita ="' . $c_bb . '"'
                                            . 'onclick="funcion_ver_cita_bibliografica(this)" >' .
                                            $string_values['text_con_cita']
                                            . '</button>';
                                }
                                //Crea los row de la tabla
                                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                                echo "<td>" . $val['tpad_nombre'] . "</td>";
                                echo "<td>" . $val['nombre_investigacion'] . "</td>";
                                echo "<td>" . $val['folio_investigacion'] . "</td>";
                                echo "<td>" . $tiene_cita . "</td>";
                                echo "<td>"
                                . '<button '
                                . 'type="button" '
                                . 'class="btn btn-link btn-sm" '
                                . 'id="btn_eliminar_actividad_modal" '
                                . 'data-idrow ="' . $key_ai . '"'
                                . 'data-cve ="' . $key . '"'
                                . 'onclick="funcion_editar_reg_investigacion(this)" >' .
                                $string_values['tab_titulo_editar']
                                . '</button>'
                                . "</td>";
                                echo "<td>"
                                . '<button '
                                . 'type="button" '
                                . 'class="btn btn-link btn-sm"'
                                . 'id="btn_eliminar_actividad_modal" '
                                . 'data-idrow ="' . $key_ai . '"'
                                . 'data-invcve ="' . $key . '"'
                                . 'data-comprovantecve ="' . $comprobante . '"'
                                . 'onclick="funcion_eliminar_reg_investigacion(this)" >' .
                                $string_values['tab_titulo_eliminar']
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
</div>

<script type="text/template" id="template_row_nueva_investigacion">
    <tr id='id_row_"$$key_ai$$"' data-keyrow="$$key_ai$$">
        <td>"$$tpad_nombre$$"</td>
        <td>"$$nombre_investigacion$$"</td>
        <td>"$$folio_investigacion$$"</td>
        <td>"$$tiene_cita$$"</td>
        <td>
        <button type="button" class="btn btn-link btn-sm" id="btn_eliminar_actividad_modal" data-idrow = "$$key_ai$$" 
        data-cve ="$$key$$" onclick="funcion_editar_reg_investigacion(this)" >Editar</button>
        </td>
        <td><button type="button" class="btn btn-link btn-sm" id="btn_eliminar_actividad_modal" data-idrow ="$$key_ai$$"
           data-invcve = "$$key$$" data-comprovantecve ="$$comprobante$$"
            onclick="funcion_eliminar_reg_investigacion(this)" >Eliminar</button>
        </td>
    </tr>;
</script>



  