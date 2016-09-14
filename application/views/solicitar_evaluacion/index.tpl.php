<div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="icon fa fa-info"></i>&nbsp;&nbsp;<?php echo $string_value["lbl_titulo_convocatoria"]?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <?php echo $string_value['lbl_convocatoria']?> 
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
            <strong><?php echo $string_value["lbl_info_nombre"]?></strong><br />
            <strong><?php echo $string_value["lbl_info_matricula"]?></strong><br />
            <strong><?php echo $string_value["lbl_info_categoria"]?></strong>
        </div>
        <!-- /.col -->
        <div class="col-sm-6 ">
            <strong><?php echo $string_value["lbl_info_del"]?></strong><br />
            <strong><?php echo $string_value["lbl_info_adscripcion"]?></strong><br />
            <strong><?php echo $string_value["lbl_info_vigencia"]?></strong>
        </div>
        <!-- /.col -->
      </div><br />
        <!--/ info row -->
      <?php 
      echo form_open('secd'); 
          pr($actividades);
      ?>
      <div class="box-group" id="accordion">    
      <?php
      foreach($actividades as  $id=>$actividad):
      ?>
        
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
            <div class="panel box box-success">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                    <?php echo $string_value[$actividad["lbl"]] ?>
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="box-body  table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Reason</th>
                    </tr>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="label label-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>219</td>
                      <td>Alexander Pierce</td>
                      <td>11-7-2014</td>
                      <td><span class="label label-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>657</td>
                      <td>Bob Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="label label-primary">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>175</td>
                      <td>Mike Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="label label-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                  </tbody>
                 </table>
                </div>
              </div>
            </div>
           
      <?php
      endforeach;
      ?>
      </div>
      <?php
      echo form_close(); ?>  
        
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
       <button type="submit" class="btn btn-primary"><?php echo $string_value["lbl_info_submit"]?></button>

    </div>
    <!-- /.box-footer-->
</div>
            <!-- /.box-body -->

