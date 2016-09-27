<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="icon fa fa-info"></i>&nbsp;&nbsp;<?php echo $string_value["lbl_titulo_convocatoria"]?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <?php 
      echo $string_value['lbl_convocatoria'];
      // pr($actividades);
      ?> 

    </div>
    <!-- /.box-body -->
    <div class="box-footer text-right">
      <?php echo $string_value['lbl_link_convocatoria']?>
    </div>
    <!-- /.box-footer-->
</div>
 <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">
          <i class="icon fa fa-info"></i>&nbsp;&nbsp;<?php echo $string_value["lbl_solicitud_titulo"]?>
      </h3>
    </div>
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
                  <th style="width: 10%">Selecccionar</th>
                  <th style="width: 50%">Curso</th>
                  <th style="width: 40%">Tipo de curso</th>
                </tr>
                <?php
                foreach($actividad as $act_id=>$act_desc):
                ?>
                <tr>
                  <td class="text-center">
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="<?php echo "{$id}"?>[<?php echo $act_id?>]" value="<?php echo $act_desc[$cfg_actividad[$id]["pk"]]?>" />
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
                </tr>
                <?php 
                endforeach;
                ?>
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
    <div class="box-footer">
       <button type="submit" class="btn btn-primary"><?php echo $string_value["lbl_info_submit"]?></button>
    </div>
    <?php echo form_close();?>
    <!-- /.box-footer-->
  </div>
<!-- /.box-body -->
</div>