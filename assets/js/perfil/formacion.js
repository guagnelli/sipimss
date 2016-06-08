$(function () {
    
    $('#modalFormacionSalud').on('show.bs.modal', function (e) {
        var idFormacion = $(e.relatedTarget).data('idformacion');
        var opcion = $(e.relatedTarget).data('opcion');
        console.log(idFormacion);
        console.log(opcion);
        
    });
    
});