<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->lang->load('interface','spanish');
$string_values = $this->lang->line('interface');
//pr($array_menu);
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
                <ul class="nav nav-pills nav-stacked col-md-3">
                    <?php foreach ($array_menu as $value) { 
                        $pos = strpos($value['ruta'], ':');
                        $array_quitar = array('(', ')');
                        if($pos>0){
                            $separa = explode(":", $value['ruta']);
                            $array_quitar = array('(', ')');
                            $val = str_replace($array_quitar, "", $separa[0]);
                        }else{
                            $val = str_replace($array_quitar, "", $value['ruta']);
                            $separa = array();
                        }
                        
                        ?>
                        <li>
                            <a data-toggle="tab" href="#<?php echo $val ?>">
                                <?php echo $value['nombre_modulo']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                
                <div id = 'tabContent' class='tab-content col-md-9'>
                    <?php foreach ($array_menu as $value) { 
                        $pos = strpos($value['ruta'], ':');
                        if($pos>0){
                            $separa = explode(":", $value['ruta']);
                            $val = str_replace($array_quitar, "", $separa[0]);
                        }else{
                            $val = str_replace($array_quitar, "", $value['ruta']);
                        }
                        ?>
                    <div id = '<?php echo $val; ?>' class = 'tab-pane fade'>
                        <div class ="row">
                            <?php 
                                $busca_cadena = strpos($value['ruta'], 'ajax'); //Busca si el metodo a invocar es un ajax
//                                    pr('Invoca ajax' . $busca_cadena);
                                if(!$busca_cadena){//Si no existe, llama a una vista 
                                    $this->load->view($value['ruta_padre']."/".$value['ruta']); 
                                }else{//Si existe el metodo ajax, llama al ajax?>
                            <javascript>
                                    data_ajax(site_url+'/<?php echo $value['ruta_padre']; ?>/<?php echo $separa[0];?>', '<?php echo $separa[1];?>', '<?php echo $separa[2];?>');
                            </javascript>    
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </div>
</div>