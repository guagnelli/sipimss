<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->lang->load('interface','spanish');
    $string_values = $this->lang->line('interface');
?>
<div class="list-group">
    <style type="text/css">
        .button-padding {padding-top: 30px}
        .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    </style>

    <div class="list-group-item">
        <div class='row text-right'>
            <font size=1>Fecha de última actualización: <span id="fecha"><?php  echo $fecha_informacion_general; ?></span></font>
        </div>
        <div class='row'>
            <div class="row">
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div id="error">
                        <div id='mensaje_error_div' class='alert'>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <span id='mensaje_error'></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1"></div>
            </div>
        </div>
    </div>
    <div class="list-group-item">
                <div class='row'>
            <h3 class='pinfo'><?php echo $string_values['perfil']['lbl_comisiones_comisiones']; ?></h3>
        </div>
        <div class='row'> 
            <div class="form-group col-xs-12 col-md-12">
                <table class="table table-striped table-hover table-bordered" id="tabla_becas">
                    <thead>
                        <tr class="btn-default">
                            <th>Fecha de inicio</th>
                            <th>Fecha de termino</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class='row'>
            <div class="form-group col-xs-4 col-md-4 col-md-offset-8">
                <button class="btn btn-success btn-lg" id="btnAgregarBeca" data-toggle="modal" data-target="#modalBeca" data-idformacion="0" data-opcion="0">
                    Agregar beca
                </button>
            </div>
        </div>
    </div>
</div>