<?php ?>
<div class='col-sm-12 col-md-12 col-lg-4 text-right'>
    <label class="control-label">
        * <?php echo $string_values['lbl_rama_conocimiento']; ?>:
        <!--</label>-->
</div>
<div class='col-sm-12 col-md-12 col-lg-8 text-left'>
    <div class="form-group">
        <div class="input-group">
            <?php
            echo $this->form_complete->create_element(array('id' => 'ctipo_licenciatura',
                'type' => 'dropdown',
                'value' => (isset($dir_tes['TIP_LICENCIATURA_CVE'])) ? $dir_tes['TIP_LICENCIATURA_CVE'] : '',
                'options' => $catalogos['ctipo_licenciatura'],
                'first' => array('' => 'Selecciona...'),
                'attributes' => array('class' => 'form-control',
                    'placeholder' => $string_values['lbl_rama_conocimiento'],
                    'data-toggle' => 'tooltip', 'data-placement' => 'top',
                    'title' => $string_values['lbl_rama_conocimiento'])));
            ?>
        </div>
    </div>
    <?php //echo form_error_format('curso');  ?>	
</div>
<script type="text/javascript">
    if ($('#ctipo_licenciatura').length) {
        $("#ctipo_licenciatura").change(function () {
            if ($(this).val() != "") {
                data_ajax(site_url + "/perfil/licenciaturas_formacion/" + $('#ctipo_licenciatura').val() + "/", null, '#capa_licenciaturas');
            }
        });
    }
<?php if (isset($dir_tes['TIP_LICENCIATURA_CVE']) && !empty($dir_tes['TIP_LICENCIATURA_CVE'])) { ?>
        data_ajax(site_url + "/perfil/licenciaturas_formacion/" + $('#ctipo_licenciatura').val() + "/", null, '#capa_licenciaturas');
<?php } ?>
</script>