function listarGruposDiagnosticos(){
    
    tablaGrupos = $('#tablaGrupos').DataTable({ 
        
        "drawCallback": function(){
            $('.tooltip-tabla-grupos').tooltip({
                html : true,
                trigger: 'hover',

            });
        },
        stateSave: false,
        lengthChange: false,
        "pageLength": 20,
        responsive: true, 
        "autoWidth": false,
        "destroy": true,
        "order": [[2, "desc"]],
        dom: "Bfrtip",
        buttons: [],
        "ajax": {
            "method": "POST",
            "url": "models/diagnostico/obtenerGruposDiagnosticos.php",
            error: function(error){
                console.log(error.responseText);
            }  
        },
        "columns": [
            {
                "data":"nombreImagenGrupo",
                render: function(data, type, row){
                    return `
                    <div class="media align-items-center">
                        <a class="avatar2 rounded-circle mr-3 tooltip-tabla-grupos" data-toggle="tooltip" data-placement="top" title="`+data[1]+`">
                            <img src="`+data[0]+`">
                        </a>
                        <div class="media-body">
                            <span class="name mb-0 font-weight-500">`+data[1]+`</span>
                            <br>
                            <a class="tooltip-tabla-grupos" data-toggle="tooltip" data-placement="bottom"  title="Creador del grupo"><span>${data[2]}</span></a>
                        </div>
                    </div>
                    
                    `;
                }
            },
            {
                "data":"nombreEmpresa",
                render: function(data){
                    return '<a class="tooltip-tabla-grupos" data-toggle="tooltip" data-placement="top"  title="Empresa del grupo"><span>'+data+'</span></a>'
                }
            },
            {
                "data":"fechaCreacionGrupo"  
            },
            {
                "data":"totalDiagnosticos",
                render: function(data){

                    if(data == 0){
                        return `<span style="font-size: 9.5px;" class="badge text-uppercase badge-pill badge-warning">Sin diagnosticos</span>`
                    }else if(data == 1){
                        return `<span style="font-size: 9.5px;" class="badge text-uppercase badge-pill badge-success">${data} &nbsp; diagnostico</span>`
                    }else{
                        return `<span style="font-size: 9.5px;" class="badge text-uppercase badge-pill badge-success">${data} &nbsp; diagnosticos</span>`
                    }  
                }
            },
            {"defaultContent":`
                <div class="dropdown dropleft">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                        <h6 class="dropdown-header" style="color: rgba(0,0,0,.72) !important;">Gestionar</h6>

                        <a class="verDiagnosticos dropdown-item font-dropdown-documento" href="#!"><i class="far fa-folder-open"></i> Ver diagnosticos existentes</a>
                        <a class="crearNuevoDiagnostico dropdown-item font-dropdown-documento" href="#!"><i class="far fa-plus-square"></i> Crear un nuevo diagnostico</a>

                        
                 
                    </div>
                </div>
            `}
        ],
        language: {    
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },              
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
        
    });
    // Cambio de clases para los botons del datatables
    // $(".dt-buttons .btn").removeClass("btn-secondary").addClass("btn-sm bg-transparent");
    // $(".dt-buttons .btn").css({'border':'1px solid #cad1d7', 'color':'#646c9a'});

    crearNuevoDiagnosticoGrupo("#tablaGrupos tbody", tablaGrupos);
    verDiagnosticosExistentes("#tablaGrupos tbody", tablaGrupos);
    verDiagnosticosDblClick("#tablaGrupos tbody", tablaGrupos);
    // renombrarGrupo("#tablaGrupos tbody", tablaGrupos);
    // eliminarGrupo("#tablaGrupos tbody", tablaGrupos);
}

var verDiagnosticosDblClick = function (tbody, table) {
    $(tbody).on("dblclick", "tr", function () { 
        let tr = $(this).closest('tr');
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev();
        }

        let data = table.row(tr).data();

        if(data.totalDiagnosticos > 0){

            $('.modalNombreGrupo').html(data.nombreImagenGrupo[1]);
            $("#modalVerDiagnosticosGrupo").modal('show');
            
            listarDiagnosticosEnModal(data.idGrupo); //le pasamos el id como parametro a la funcion listarDiagnosticos

        }else{

            let timerInterval;
            Swal.fire({

                title: 'Ups...',
                icon: 'info',
                showConfirmButton: true,
                html: `
                    <div class="row">
                        
                      
                        <div class="col-md-12 mt-3">
                            <p class="">Este grupo aun no cuenta con ningun diagnostico!</p>
                        </div>

                        <div class="col-md-12">
                     

                            <p class="small mt-3">Me voy a cerrar en <strong></strong> segundos.</p>
                           
                        </div>

                    </div>`,

                timer: 30000,
                willOpen: () => {
                    const content = Swal.getContent()
                    const $ = content.querySelector.bind(content)
                    const ups_cerrar = $('#ups_cerrar');

                    timerInterval = setInterval(() => {
                        Swal.getContent().querySelector('strong').textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                    }, 100)
                },
                willClose : () => {
                    clearInterval(timerInterval);  
                }

            });

        }
    });
}

var crearNuevoDiagnosticoGrupo = function (tbody, table) {

    $(tbody).on("click", "a.crearNuevoDiagnostico", function () { 

        let tr = $(this).closest('tr');
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev();
        }

        // Datos de la tabla
        let data = table.row(tr).data();

        $("#modalNuevoDiagnostico").modal('show');
        funcionesModalNuevoDiagnostico(data.idGrupo);

    });
    
}

var funcionesModalNuevoDiagnostico = function (idGrupoDiagnosticos = null) {
    $('#btnComenzarDiagnostico').on("click", function (e) { 
        e.preventDefault();
        var btn = $(this);
        var form = $('#formTipoDiagnostico');

        form.validate({
            rules: {
                tipoDiagnostico: { required: true },
            },
            messages: {
                tipoDiagnostico: 'Este campo es obligatorio.',  
            }
        });

        if (form.valid()){
            mostrarContenedorPreguntas(true, idGrupoDiagnosticos, $('#tipoDiagnostico').val());
        }
    });
}

let verDiagnosticosExistentes = function (tbody, table){

    $(tbody).on("click", "a.verDiagnosticos", function () { 

        let tr = $(this).closest('tr');
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev();
        }
        // Datos de la tabla
        let data = table.row(tr).data();

        if(data.totalDiagnosticos > 0){

            $('.modalNombreGrupo').html(data.nombreImagenGrupo[1]);
            $("#modalVerDiagnosticosGrupo").modal('show');
            
            listarDiagnosticosEnModal(data.idGrupo); //le pasamos el id como parametro a la funcion listarDiagnosticos

        }else{

            let timerInterval;
            Swal.fire({

                title: 'Ups...',
                icon: 'info',
                showConfirmButton: true,
                html: `
                    <div class="row">
                        
                      
                        <div class="col-md-12 mt-3">
                            <p class="">Este grupo aun no cuenta con ningun diagnostico!</p>
                        </div>

                        <div class="col-md-12">
                          
                            <p class="small mt-3">Me voy a cerrar en <strong></strong> segundos.</p>
                           
                        </div>

                    </div>`,

                timer: 30000,
                willOpen: () => {
                    const content = Swal.getContent()
                    const $ = content.querySelector.bind(content)
                    const ups_cerrar = $('#ups_cerrar');

                    timerInterval = setInterval(() => {
                        Swal.getContent().querySelector('strong').textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval);  
                }

            });

        }
      
    });

}

var listarDiagnosticosEnModal = function (idGrupo = null){
    tablaDiagnosticos = $('#tableDiagnosticosPorGrupo').DataTable({ 
        "drawCallback": function(){
            $('.tooltip-tabla-diagnosticos').tooltip({
                html : true,
                trigger: 'hover',

            });
        },
        stateSave: false, 
        lengthChange: false,
        "pageLength": 8,
        responsive: true, 
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "desc"]],
        dom: "Bfrtip",
        buttons: [],
        "ajax": {
            "method": "POST",
            "url": "models/diagnostico/obtenerDiagnosticosDelGrupo.php",
            "data":{
                "idGrupo": idGrupo
            },
            error: function(error){
                alert("Error al listar los diagnosticos:" + error.responseText);
            }
            
        },
        "columns": [
            {"data":"idDiagnostico"},
            {"data":"nombreDiagnostico"},
            {"data":"nombreTipoPrueba"},
            {"data":"fechaCreacionDiagnostico"},
            {"defaultContent":`
                <a href="#!" class="gestionarDiagnostico table-action tooltip-tabla-diagnosticos" data-toggle="tooltip" title="Ver resultados">
                    <i class="fas fa-chart-bar"></i>
                </a>
                <a href="#!" class="editarDiagnostico table-action tooltip-tabla-diagnosticos" data-toggle="tooltip" title="Editar diagnostico">
                    <i class="far fa-edit fa-xl"></i>
                </a>
                <a href="#!" class="generarPDF table-action tooltip-tabla-diagnosticos" data-toggle="tooltip" title="Generar PDF">
                    <i class="far fa-file-pdf"></i>
                </a>
                <a href="#!" class="eliminarDiagnostico table-action tooltip-tabla-diagnosticos" data-toggle="tooltip" title="Eliminar diagnostico">
                    <i class="far fa-trash-alt fa-xl"></i>
                </a>        
            `}
        ],
        language: {    
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },              
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
        
    });
    //cambio de clases para los botons del datatables
    // $(".dt-buttons .btn").removeClass("btn-secondary").addClass("btn-sm bg-transparent");
    // $(".dt-buttons .btn").css({'border':'1px solid #cad1d7', 'color':'#646c9a'});

    verResultadosDiagnosticoModal("#tableDiagnosticosPorGrupo tbody", tablaDiagnosticos);
    editarDiagnosticoModal("#tableDiagnosticosPorGrupo tbody", tablaDiagnosticos);
    eliminarDiagnosticoModal("#tableDiagnosticosPorGrupo tbody", tablaDiagnosticos);
    generarPDFModal("#tableDiagnosticosPorGrupo tbody", tablaDiagnosticos);

}

function verResultadosDiagnosticoModal (tbody, table){

    $(tbody).on("click", "a.gestionarDiagnostico", function () { 

        let tr = $(this).closest('tr');
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev();
        }

        // Datos de la tabla
        let data = table.row(tr).data();

        if(data != undefined){
            verResultadosDiagnostico(true, data.idGrupo, data.idDiagnostico);
        }else{
            alert('error');
        }
        
    });

}

function editarDiagnosticoModal (tbody, table){
    $(tbody).on("click", "a.editarDiagnostico", function () { 

        let tr = $(this).closest('tr');
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev();
        }

        // Datos de la tabla
        let data = table.row(tr).data();

        verEditarDiagnostico(true, data.idGrupo, data.idDiagnostico);
      
    });
}

function generarPDFModal (tbody, table){

    $(tbody).on("click", "a.generarPDF", function () { 

        let tr = $(this).closest('tr');
        if ($(tr).hasClass('child')) {
        tr = $(tr).prev();
        }

        // Datos de la tabla
        let data = table.row(tr).data();
        verPersonalizarDiagnostico(true, data.idGrupo, data.idDiagnostico);
      
    });

}

function eliminarDiagnosticoModal (tbody, table){
    $(tbody).on("click", "a.eliminarDiagnostico", function () { 

        let tr = $(this).closest('tr');
        if ($(tr).hasClass('child')) {
            tr = $(tr).prev();
        }
        // Datos de la columna
        let data = table.row(tr).data();

        $('#modalVerDiagnosticosGrupo').modal('hide');

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '¡Si, borrar!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
                var idDiagnostico = data.idDiagnostico;
                var request = $.ajax({
                    url: 'models/diagnostico/eliminarDiagnostico.php',
                    method: "POST",
                    data: {
                        'idDiagnostico': idDiagnostico,
                    },
                    dataType: 'json',
            
                    beforeSend: function( xhr ) {
                        Toast.fire({
                            icon: 'success',
                            timer: 1000,
                            html: 'Eliminando <b></b> elementos.',
                            position: 'top-end',
                            willOpen: () => {
                                Swal.showLoading();
                                timerInterval = setInterval(() => {
                                Swal.getContent().querySelector('b')
                                    .textContent = Swal.getTimerLeft()
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            }
                        });
                    }
                });
                                    
                request.done(function(response) {
                    if(response.status == "diagnosticoEliminado"){
                        tablaGrupos.ajax.reload();
                        // Eliminar la columna en especifico de la tabla
                        table.row(tr).remove().draw(false);
                        $('#modalVerDiagnosticosGrupo').modal('show');
                       
                    }
                    
                });
                
                request.fail(function(jqXHR, textStatus) {});

            }else{
                $('#modalVerDiagnosticosGrupo').modal('show');
            }
        });
      
    });
}

$(function(){
    listarGruposDiagnosticos();
});