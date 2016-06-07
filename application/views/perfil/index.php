<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->lang->load('interface','spanish');
$string_values = $this->lang->line('interface');

?>

<div class="row" id="contenedor_formulario">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="panel">
            <div class="breadcrumbs6 panel-heading" style="padding-left:20px;">
                <h1 id="titulo_registro">
                    <small>
                        <span class="glyphicon glyphicon-info-sign">
                        </span>
                    </small>
                    <?php echo $string_values['perfil']['lbl_titulo_seccion']; ?>
                </h1>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs nav-stacked col-md-3">
                    <li class="active">
                        <a data-toggle="tab" href="#informacionGeneral">
                            <h5>
                                <?php echo $string_values['perfil']['lbl_informacion_general']; ?>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#formacion">
                            <h5>
                                <?php echo $string_values['perfil']['lbl_formacion']; ?>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#becasComisiones">
                            <h5>
                                <?php echo $string_values['perfil']['lbl_becas_comisiones']; ?>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#actividad">
                            <h5>
                                <?php echo $string_values['perfil']['lbl_actividad']; ?>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#comisionesAcademicas">
                            <h5>
                                <?php echo $string_values['perfil']['lbl_comisiones_academicas']; ?>
                            </h5>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#elaboracionMaterial">
                            <h5>
                                <?php echo $string_values['perfil']['lbl_elaboracion_material']; ?>
                            </h5>
                        </a>
                    </li>
                </ul>
                <div id = 'tabContent' class='tab-content col-md-9'>
                    <div id = 'informacionGeneral' class = 'tab-pane fade in active'>
                        <div class ="row">
                            <?php $this->load->view('perfil/informacionGeneral'); ?>
                        </div>
                    </div>
                    <div id = 'formacion' class = 'tab-pane fade'>
                        <?php $this->load->view('perfil/formacion'); ?>
                    </div>
                    <div id = 'becasComisiones' class = 'tab-pane fade'>
                        <?php $this->load->view('perfil/becasComisiones'); ?>
                    </div>
                    <div id = 'actividad' class = 'tab-pane fade'>
                        <?php $this->load->view('perfil/actividad'); ?>
                    </div>
                    <div id = 'comisionesAcademicas' class = 'tab-pane fade'>
                        <?php $this->load->view('perfil/comisionesAcademicas'); ?>
                    </div>
                    <div id = 'elaboracionMaterial' class = 'tab-pane fade'>
                        <?php $this->load->view('perfil/elaboracionMaterial'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>