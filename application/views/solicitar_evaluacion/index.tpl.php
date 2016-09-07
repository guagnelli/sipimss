<link rel="alternate" 
      href='<?php echo asset_url()?>new_theme/select2/select2.css' />
<script src='<?php echo asset_url()?>new_theme/select2/select2.js'></script>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <h3 class="pinfo">
                <?php echo $string_value["lbl_titulo"]; ?>
            </h3>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?php echo $string_value["lbl_titulo_convocatoria"]; ?>
            </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $string_value["lbl_convocatoria"]; ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          my footer
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?php echo $string_value["lbl_titulo_solicitudes"]; ?>
            </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove">
                    <i class="fa fa-remove"></i>
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php //echo $string_value["lbl_convocatoria"]; ?>
                    soy un listado
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          my footer
        </div>
    </div>
    
    
</div>
<script>
$(document).ready(function(){
    $(".select2").select2();
});
</script>



