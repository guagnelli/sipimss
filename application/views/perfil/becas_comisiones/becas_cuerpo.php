<div class="list-group">

    <div class="list-group-item">      
        <div>
            <br>
                <?php echo $string_values['title_becas']; ?>
            <br>
        </div>
        <div class='row'>
            <div class="form-group col-xs-4 col-md-4 col-md-offset-8">
                <button type="button" class="btn btn-success btn-lg" id="btn_gregar_beca_modal" data-toggle="modal" data-target="#modal_censo">
                    <?php echo $string_values['btn_agregar_beca']; ?>
                </button>
            </div>
        </div>
        <div class='row'> 
            <div class="form-group col-xs-12 col-md-12">
                <table class="table table-striped table-hover table-bordered" id="tabla_becas">
                    <thead>
                        <tr class="btn-default">
                            <th><?php echo $string_values['title_tab_becas_fecha_inicio']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_fecha_termino']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_clase_beca']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_motivo_beca']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_beca_interrumpida']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_comprobante']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_editar']; ?></th>
                            <th><?php echo $string_values['title_tab_becas_eliminar']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>