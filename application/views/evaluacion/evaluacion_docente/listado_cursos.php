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
      if(isset($cfg_actividad)){
        foreach($cfg_actividad as $id=>$actividad): 
          foreach ($bloques['bloque_'.$id] as $key_seccion => $seccion) {
            $seccion_id = str_replace("seccion_", "", $key_seccion); ?>
            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
            <div class="panel box box-success">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree<?php echo $id?>" class="collapsed" aria-expanded="false">
                    <?php echo $string_value[$bloques['labels'][$actividad[$seccion_id]['acronimo']]]; ?>
                  </a>
                </h4>
                <div id="msg_<?php echo $id; ?>"></div>
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
                    <?php foreach ($seccion as $key_registro => $registro) { //pr($registro);
                        $identificador = $id."_".$seccion_id."_".$registro[$cfg_actividad[$id][$seccion_id]['pk']];
                        $reg = $registro[$cfg_actividad[$id][$seccion_id]['pk']]; ?>
                        <tr>
                          <td class="text-center">
                            <div class="form-group">
                              <div class="checkbox">
                                <label>
                                  <!-- <input type="checkbox" name="<?php //echo "{$id}"?>[<?php //echo $act_id?>]" value="<?php //echo $act_desc[$cfg_actividad[$id]["pk"]]?>" /> -->
                                  <?php echo $this->form_complete->create_element(
                                    array('id'=>'valido_'.$identificador, 'type'=>'dropdown',
                                        'value' => $catalogos['EVA_CUR_VALIDO'],
                                        'attributes'=>array(
                                          'class'=>'form-control valido',
                                          'data-toggle'=>'tooltip',
                                          //'data-bloque'=>$id,
                                          //'data-seccion'=>$key_seccion,
                                          'data-registro'=>$identificador,
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
                            echo $registro[$cfg_actividad[$id][$seccion_id]['fields']['lbl_'.$seccion_id.'_nombre']];
                          ?>
                          </td>
                          <td>
                            <?php
                            echo $registro[$cfg_actividad[$id][$seccion_id]['fields']['lbl_'.$seccion_id.'_tipo']];
                            ?>
                          </td>
                          <td>
                            <?php echo $this->form_complete->create_element(
                              array('id' => "seccion_".$identificador, 'type' => 'dropdown', 
                                'options' => $catalogos['cseccion'], 'first'=>array(''=>'Selecciona...'), 
                                'attributes' => array('class' => 'form-control', 
                                  'disabled'=>'disabled', 'readonly'=>'readonly',
                                  'placeholder' => $string_value['seccion'], 'data-toggle' => 'tooltip', 
                                  'data-placement' => 'top', 'title' => $string_value['seccion']))); ?>
                          </td>
                          <td>
                            <?php echo $this->form_complete->create_element(
                              array('id'=>"puntos_".$identificador,'type'=>'text',
                                'value' => '',
                                    'attributes'=>array(
                                      'class'=>"form-control puntos $id",
                                      'data-toggle'=>'tooltip',
                                      'disabled'=>'disabled',
                                      'data-bloque'=>$id,
                                      'data-seccion'=>$key_seccion,
                                      'readonly'=>'readonly',
                                      'title'=>$string_value['puntos']
                                    )
                                )
                            ); ?>
                          </td>
                          <td>
                            <button type="button" class="btn btn-guardar" id="guardar_<?php echo $identificador; ?>" data-bloque="<?php echo $id; ?>" 
                              data-seccion="<?php echo $seccion_id;?>" data-registro="<?php echo $reg;?>"><i class="fa fa-save fa-2x"></i></button>
                          </td>
                        </tr>
                        <?php 
                        }
                        ?>
                        <tr>
                          <td colspan="4" class="text-right">Total <?php echo $string_value[$bloques['labels'][$actividad[$seccion_id]['acronimo']]]; ?>:</td>
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
                    <?php } ?>
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
  $('.btn-guardar').on("click", function() {
    guardar_puntos(this);
  });
});
function habilitar_puntos(elemento){
  var id = $(elemento).attr('data-registro');
  var clase = $(elemento).attr('data-clase');
  if($(elemento).val()=="<?php echo $this->config->item('EVA_CUR_VALIDO')['VALIDO']['id']; ?>"){ //Habilitar elementos para puntuación
    $("#puntos_"+id).removeAttr('disabled');
    $("#puntos_"+id).removeAttr('readonly');
    $("#seccion_"+id).removeAttr('disabled');
    $("#seccion_"+id).removeAttr('readonly');
    //$("#guardar_"+id).removeAttr('disabled');
    //$("#guardar_"+id).removeAttr('readonly');
    //$("#guardar_"+id).addClass('btn-success');
    /*$("#guardar_"+id).bind( "click" , function( event ) {
      alert( "The quick brown fox jumps over the lazy dog." );
      timesClicked++;
      if ( timesClicked >= 3 ) {
        $( this ).unbind( event );
      }
    });*/
  } else { //Deshabilitar y borrar datos
    $("#puntos_"+id).attr('disabled', 'disabled');
    $("#puntos_"+id).attr('readonly', 'readonly');
    $("#puntos_"+id).val('');
    $("#seccion_"+id).attr('disabled', 'disabled');
    $("#seccion_"+id).attr('readonly', 'readonly');
    $("#seccion_"+id).val('');
    //$("#guardar_"+id).attr('disabled', 'disabled');
    //$("#guardar_"+id).attr('readonly', 'readonly');
    //$("#guardar_"+id).removeClass('btn-success');
    //$("#guardar_"+id).unbind( "click" );
  }
  calcular_puntos_seccion(clase);
}
function guardar_puntos(elemento){
  //var id = $(elemento).attr('data-registro');
  var seccion = $(elemento).attr('data-seccion');
  var bloque = $(elemento).attr('data-bloque');
  var registro = $(elemento).attr('data-registro');
  if($("#valido_"+bloque+"_"+seccion+"_"+registro).val()=="<?php echo $this->config->item('EVA_CUR_VALIDO')['VALIDO']['id']; ?>" && ($("#seccion_"+bloque+"_"+seccion+"_"+registro).val()=="" || $("#puntos_"+bloque+"_"+seccion+"_"+registro).val()=="")) {
    apprise('<?php echo $string_value["error_guardar_puntos"]; ?>');
  } else {
    if($("#valido_"+bloque+"_"+seccion+"_"+registro).val()=="<?php echo $this->config->item('EVA_CUR_VALIDO')['NO_VALIDO']['id']; ?>") { //Limpiar datos que puedan interferir
      $("#seccion_"+bloque+"_"+seccion+"_"+registro).val('');
      $("#puntos_"+bloque+"_"+seccion+"_"+registro).val('');
    }
    $.ajax({
        url: site_url + '/evaluacion_docente/guardar_puntos_registro/',
        method: 'POST',
        dataType: "json",
        data: {'bloque': bloque, 'seccion': seccion, 'registro': registro},
        beforeSend: function(xhr) {
            $('#msg_'+seccion).html(create_loader());
        }
    })
    .done(function(response) {
        $('#mensaje').html(imprimir_resultado(response));
        if(response.result==true){
            $('#tr_'+data_value).slideUp( "slow", function() { //Ocultar fila del registro
                $('#tr_'+data_value).remove(); //Eliminar fila
            });
        }
    })
    .fail(function(jqXHR, response) {
        $('#msg_'+seccion).html(imprimir_resultado(response));
    })
    .always(function() {
        remove_loader();
    });
  }
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