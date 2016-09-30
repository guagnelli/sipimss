<!-- <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="icon fa fa-info"></i>&nbsp;&nbsp;<?php //echo $string_value["lbl_titulo_convocatoria"]?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <?php 
      //echo $string_value['lbl_convocatoria'];
      // pr($actividades);
      ?> 

    </div>
    <div class="box-footer text-right">
      <?php //echo $string_value['lbl_link_convocatoria']?>
    </div>
</div> -->
 <div class="box box-primary">
    <!-- <div class="box-header with-border">
      <h3 class="box-title">
          <i class="icon fa fa-info"></i>&nbsp;&nbsp;<?php echo $string_value["lbl_solicitud_titulo"]?>
      </h3>
    </div> -->
    <div class="box-body">
    <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> <?php echo $string_value["lbl_info_prof"]?>
          </h2>
        </div>
        <!-- /.col -->
      </div>
    <!-- /title row -->
    <!-- info row -->
      <div class="row">
        <div class="col-sm-6">
            <strong><?php echo $string_value["lbl_info_nombre"]?></strong>
                    <?php echo $empleado["nombre"]." "
                          .$empleado["apellidoPaterno"]." "
                          .$empleado["apellidoMaterno"]?><br />
            <strong><?php echo $string_value["lbl_info_matricula"]?></strong>
                    <?php echo $empleado["matricula"]?><br />
            <strong><?php //echo $string_value["lbl_info_categoria"]?></strong>
                    <?php //echo $empleado["categoria_PD"]?>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 ">
            <strong><?php echo $string_value["lbl_info_del"]?></strong>
                    <?php echo $empleado["delegacion"]?><br />
            <strong><?php echo $string_value["lbl_info_adscripcion"]?></strong>
                    <?php echo $empleado["nombreUnidadAdscripcion"]?><br />
            <strong><?php //echo $string_value["lbl_info_vigencia"]?></strong>
                    <?php // $empleado["vigencia"]?>
        </div>
        <!-- /.col -->
      </div><br />
        <!--/ info row -->
      <?php 
      echo form_open('solicitar_evaluacion/secd'); 
          //pr($empleado);
      ?>
      <div class="box-group" id="accordion">    
      <?php
      if(isset($actividades)){
        foreach($actividades as  $id=>$actividad):
      ?>
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-success">
          <div class="box-header with-border">
            <h4 class="box-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree<?php echo $id?>" class="collapsed" aria-expanded="false">
                <?php 
                echo $string_value[$labels[$id]] ?>
              </a>
            </h4>
          </div>
          <div id="collapseThree<?php echo $id?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="box-body  table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                <tr>
                  <th style="width: 7%">¿<?php echo $string_value['valido']; ?>?</th>
                  <th style="width: 35%"><?php echo $string_value['curso']; ?></th>
                  <th style="width: 30%"><?php echo $string_value['tipo_curso']; ?></th>
                  <th style="width: 20%"><?php echo $string_value['seccion']; ?></th>
                  <th style="width: 5%"><?php echo $string_value['puntos']; ?></th>
                  <th style="width: 3%"></th>
                </tr>
                <?php
                foreach($actividad as $act_id=>$act_desc):
                ?>
                <tr>
                  <td class="text-center">
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <!-- <input type="checkbox" name="<?php //echo "{$id}"?>[<?php //echo $act_id?>]" value="<?php //echo $act_desc[$cfg_actividad[$id]["pk"]]?>" /> -->
                          <?php echo $this->form_complete->create_element(
                            array('id'=>"{$id}_$act_id",'type'=>'checkbox',
                                'value' => $act_desc[$cfg_actividad[$id]["pk"]],
                                'attributes'=>array(
                                  'class'=>'form-control valido',
                                  'data-toggle'=>'tooltip',
                                  'data-clase'=>$id,
                                  'title'=>'¿'.$string_value['valido'].'?',
                                  'style'=>'width:20px; height: 20px;'
                                )
                              )
                          ); ?>
                        </label>
                      </div>
                    </div>
                  </td>
                  <td>
                  <?php
                    echo $act_desc[$cfg_actividad["$id"]["curso"]];
                  ?>
                  </td>
                  <td>
                    <?php
                    echo $act_desc[$cfg_actividad["$id"]["tipo_curso"]];
                    ?>
                  </td>
                  <td>
                    <?php echo $this->form_complete->create_element(
                      array('id' => "seccion_{$id}_$act_id", 'type' => 'dropdown', 
                        'options' => $catalogos['cseccion'], 'first'=>array(''=>'Selecciona...'), 
                        'attributes' => array('class' => 'form-control', 
                          'disabled'=>'disabled', 'readonly'=>'readonly',
                          'placeholder' => $string_value['seccion'], 'data-toggle' => 'tooltip', 
                          'data-placement' => 'top', 'title' => $string_value['seccion']))); ?>
                  </td>
                  <td>
                    <?php echo $this->form_complete->create_element(
                      array('id'=>"puntos_{$id}_$act_id",'type'=>'text',
                        'value' => '',
                            'attributes'=>array(
                              'class'=>"form-control puntos $id",
                              'data-toggle'=>'tooltip',
                              'disabled'=>'disabled',
                              'data-clase'=>$id,
                              'readonly'=>'readonly',
                              'title'=>$string_value['puntos']
                            )
                        )
                    ); ?>
                  </td>
                  <td>
                    <button class="btn" id="guardar_<?php echo "{$id}_$act_id"; ?>" disabled='disabled' readonly='readonly'><i class="fa fa-save fa-2x"></i></button>
                  </td>
                </tr>
                <?php 
                endforeach;
                ?>
                <tr>
                  <td colspan="4" class="text-right">Total <?php echo $string_value[$labels[$id]]; ?>:</td>
                  <td>
                    <?php echo $this->form_complete->create_element(
                      array('id'=>"puntos_seccion_{$id}",'type'=>'text',
                        'value' => "",
                            'attributes'=>array(
                              'class'=>'form-control seccion',
                              'data-value'=>"$id",
                              'data-toggle'=>'tooltip',
                              'disabled'=>'disabled',
                              'readonly'=>'readonly',
                              'title'=>$string_value['puntos']
                            )
                        )
                    ); ?>
                  </td>
                </tr>
              </tbody>
             </table>
            </div>
          </div>
        </div>
      <?php
        endforeach;
      }
      ?>
    </div>
    <!-- /.box-body -->
    <div class="row">
      <div class="col-lg-12 text-right" style="padding-right:20px;">
        <h2><div id="total"></div></h2>
      </div>
    </div>
    <!-- <div class="box-footer">
       <button type="submit" class="btn btn-primary"><?php //echo $string_value["lbl_info_submit"]?></button>
    </div> -->
    <?php echo form_close(); ?>
    <!-- /.box-footer-->
  </div>
<!-- /.box-body -->
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('.valido').on("click", function() {
    habilitar_puntos(this);
  });
  $('.puntos').on("keyup", function() {
    var clase = $(this).attr('data-clase');
    calcular_puntos_seccion(clase);
  });
});
function habilitar_puntos(elemento){
  var id = $(elemento).attr('id');
  var clase = $(elemento).attr('data-clase');
  if($(elemento).is(":checked")){ //Habilitar elementos para puntuación
    $("#puntos_"+id).removeAttr('disabled');
    $("#puntos_"+id).removeAttr('readonly');
    $("#seccion_"+id).removeAttr('disabled');
    $("#seccion_"+id).removeAttr('readonly');
    $("#guardar_"+id).removeAttr('disabled');
    $("#guardar_"+id).removeAttr('readonly');
  } else { //Deshabilitar y borrar datos
    $("#puntos_"+id).attr('disabled', 'disabled');
    $("#puntos_"+id).attr('readonly', 'readonly');
    $("#puntos_"+id).val('');
    $("#seccion_"+id).attr('disabled', 'disabled');
    $("#seccion_"+id).attr('readonly', 'readonly');
    $("#seccion_"+id).val('');
    $("#guardar_"+id).attr('disabled', 'disabled');
    $("#guardar_"+id).attr('readonly', 'readonly');
  }
  calcular_puntos_seccion(clase);
}
function calcular_puntos_seccion(clase){
  var total = 0;
  $("."+clase).each(function( index ) {
    total += Number($(this).val()); 
  });
  $("#puntos_seccion_"+clase).val(total);
  calcular_puntos_total();
}
function calcular_puntos_total(){
  var total = 0;
  $(".seccion").each(function( index ) {
    total += Number($(this).val()); 
  });
  $("#total").html("Total de puntos:  "+total);
}
</script>