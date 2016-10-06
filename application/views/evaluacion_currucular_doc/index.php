<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php echo css("style-sipimss.css"); ?>

<!--<script type='text/javascript' src="<?php // echo base_url(); ?>assets/js/evaluacion_curricular/index_eva_curricular.js"></script>-->
<script>
    $('.botonF1').hover(function () {
        $('.btn').addClass('animacionVer');
    })
    $('.contenedor').mouseleave(function () {
        $('.btn').removeClass('animacionVer');
    })
</script>

<div class="panel-group" id="accordion">
    <div class="row">
        <div class="col-sm-6">
            <strong><?php echo $string_value_seccion["lbl_info_nombre"]?></strong>
                    <?php echo $empleado["nombre"]." "
                          .$empleado["apellidoPaterno"]." "
                          .$empleado["apellidoMaterno"]?><br />
            <strong><?php echo $string_value_seccion["lbl_info_matricula"]?></strong>
                    <?php echo $empleado["matricula"]?><br />
            <strong><?php //echo $string_value["lbl_info_categoria"]?></strong>
                    <?php //echo $empleado["categoria_PD"]?>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 ">
            <strong><?php echo $string_value_seccion["lbl_info_del"]?></strong>
                    <?php echo $empleado["delegacion"]?><br />
            <strong><?php echo $string_value_seccion["lbl_info_adscripcion"]?></strong>
                    <?php echo $empleado["nombreUnidadAdscripcion"]?><br />
            <strong><?php //echo $string_value["lbl_info_vigencia"]?></strong>
                    <?php // $empleado["vigencia"]?>
        </div>
        <!-- /.col -->
      </div>
    <br>
    <?php
    foreach ($array_menu as $bloque => $value_tab) {
        ?>
        <script >
            /*Guarda los datos de configuración para el uso de ajax en javascript*/
//            hrutes['<?php // echo $value_tab['ruta']; ?>'] = '<?php // echo $value_tab['ruta_padre']; ?>';
        </script>
        <div class="panel box box-success">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo 'seccion_'.$bloque ?>" class="collapsed" aria-expanded="false">
                        <?php echo $string_values[$labels_bloque[$bloque]];?>
                    </a>
                </h4>
            </div>
            <div id="<?php echo 'seccion_'.$bloque ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div id="cuerpo_<?php echo $bloque ?>" class="box-body">
                    <?php // echo $value_tab['tabla'] ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <br>    
    <div class="row">
         <div class="col-sm-12 text-center">
            <?php  //Crea los botones de validación
                if (!empty($botones_validador)) {
                    foreach ($botones_validador as $value) {
                        echo $value . ' &nbsp';
                    }
                }
            ?> 
         </div>    
    </div>    
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 contenedor" >
        <span id="pie"  onclick="funcion_cerrar_validacion_empleado(this)">
            <a class="botonF1" data-toggle='tab' href='#select_buscador_validar_evaluacion'>><?php // echo $string_values['lbl_validar_empleado'];                ?></a>
        </span>
    </div>
</div>