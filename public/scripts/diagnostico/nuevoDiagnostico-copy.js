var mostrarPreguntasDiagnostico = function (){

    var idGrupoPreguntas = getParameter('idGrupoPreguntas');
    var idGrupoDiagnostico = getParameter('idGrupoDiagnostico');
        
    let formGrupoPreguntas = new FormData();
    formGrupoPreguntas.append("idGrupoPreguntas", idGrupoPreguntas);
    formGrupoPreguntas.append("idGrupoDiagnostico", idGrupoDiagnostico);

    var request = $.ajax({
        url: 'models/diagnostico/obtenerPreguntasDiagnostico.php',
        method: "POST",
        data: formGrupoPreguntas,
        contentType: false,
        processData: false,
        dataType: 'json',

        beforeSend: function( xhr ) {
            let htmlPreloader = `
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="container-tarjeta pulse-preload">
                            <div class="background-tarjeta">
                                <div class="right-tarjeta">
                                <div class="bar2"></div>
                                <div class="mask-preloader thick"></div>
                                <div class="bar2"></div>
                                <div class="mask-preloader thick"></div>
                                <div class="bar2"></div>
                                <div class="mask-preloader thin"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="col-12">
                        <div class="container-tarjeta pulse-preload">
                            <div class="background-tarjeta">
                                <div class="right-tarjeta">
                                <div class="bar2"></div>
                                <div class="mask-preloader thick"></div>
                                <div class="bar2"></div>
                                <div class="mask-preloader thick"></div>
                                <div class="bar2"></div>
                                <div class="mask-preloader thin"></div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            `;
            $('.contenedor-preguntas').append(htmlPreloader);
        }

    });

    request.done(function(response) {
        var arrayTemarios = response[0]['temario'];
        var arrayPreguntas = response[1]['pregunta'];

        var numeroDeTemarios = arrayTemarios.length;
        var numeroDePreguntas = arrayPreguntas.length;

        // Se recorren los temarios
        for(let i=0; i < numeroDeTemarios; i++) {
            var conteo = i+1;
            var htmlEtapa = `
                <li class="nav-item font-weight-500 border py-3 mx-0">
                    
                    <a class="nav-link" href="#modulo${conteo}">
                        Módulo ${conteo}
                    </a>

                </li>     
            `;
            $('.contenedor-etapas').append(htmlEtapa);

            var htmlModuloEtapa = `
                <div id="modulo${conteo}">
                    <div class="col text-center py-4">
                        <h2 style="color: #525f7f;" class="mb-1">${arrayTemarios[i]['nombreTemario']}</h2>
                        <p class="text-uppercase text-muted font-weight-500">Módulo ${conteo}</p>
                    </div>
                </div>
            `;
            $('.contenedor-preguntas').append(htmlModuloEtapa);

            var idTemario = arrayTemarios[i]['idTemario'];         
            // Se recorren las preguntas
            for(let i=0; i < numeroDePreguntas; i++) {
                var conteoPreguntas = i+1;

                if(arrayPreguntas[i]['idTemarioPreguntas'] == idTemario){
                    var idUnicoInput = generarID();
              
                    var htmlModuloPreguntas = `
                        <div class="col-md-12 mb-3 px-2 px-md-4" id="contenedorPregunta${arrayPreguntas[i]['idPregunta']}">
                            <div class="card border card-body px-3 px-md-4 shadow-none bg-cuadro" id="cardPregunta${arrayPreguntas[i]['idPregunta']}">
                                <div class="form-group fade show my-3 mb-0">
                                    <div class="pregunta">
                                        <span class="text-primary opacity-8 display-4 d-inline txtNumeros">${conteoPreguntas}. </span>
                                        <label for="" class="d-inline txtPreguntas">
                                            ${arrayPreguntas[i]['textoPregunta']}
                                        </label>
                                    </div>
                                
                                    <div class="opcion-respuesta py-3">
                                        <label class="custom-toggle">
                                            <input type="checkbox" class="checkRespuesta" data-pregunta="${arrayPreguntas[i]['idPregunta']}" id="checkbox${idUnicoInput}" name="respuesta${conteoPreguntas}" value="cumple">
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="No cumple" data-label-on="Si cumple"></span>
                                        </label>
                                    </div>

                                    <div class="campo-observaciones input-group input-group-alternative ">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <textarea id="observacion${idUnicoInput}" data-id-checkbox="checkbox${idUnicoInput}" name="observacionRespuesta${conteoPreguntas}" class="form-control form-control-alternative inputTextRespuesta" rows="1" placeholder="Observaciones"></textarea>         
                                    </div>

                                    <div class="section-files-${arrayPreguntas[i]['idPregunta']}">
                                        
                                    </div>

                                </div>

                                <div class="grupo-botones-pregunta">
                                    <ul class="nav" id="contenedorGrupoBotonesPregunta${arrayPreguntas[i]['idPregunta']}">                          
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    $('#modulo'+conteo).append(htmlModuloPreguntas);  

                    // Insertar en el html el input files para subir evidencias de respuesta
                    let htmlbtnUpFiles = `
                    <li class="nav-item">
                        <label class="input-file-pregunta icon icon-sm icon-shape" data-toggle="tooltip" title="Cargar imagenes">
                            <input type="file" class="inputResponseFiles custom-file-input" data-id-inputrespuesta="${idUnicoInput}" id="inputResponseFiles${idUnicoInput}" name="responseFiles${conteoPreguntas}[]" aria-describedby="inputResponseFiles${idUnicoInput}" accept="image/*" multiple="true">
                            <i class="fas fa-upload"></i>
                        </label>
                    </li>
                    `;
                    $('#contenedorGrupoBotonesPregunta'+arrayPreguntas[i]['idPregunta']).append(htmlbtnUpFiles);

                    // Insertar en el html el input files para subir evidencias de respuesta (Antiguo)
                    // let htmlModuleUpFiles = `
                    //     <div class="input-group col-12 col-md-6 mt-4 px-0">
                    //         <div class="custom-file">
                    //             <input type="file" class="inputResponseFiles custom-file-input" data-id-inputrespuesta="${idUnicoInput}" id="inputResponseFiles${idUnicoInput}" name="responseFiles${conteoPreguntas}[]" aria-describedby="inputResponseFiles${idUnicoInput}" accept="image/*" multiple="true">
                    //             <label class="custom-file-label" data-browse="Buscar" for="files${idUnicoInput}">Subir evidencias</label>
                    //         </div>
                    //     </div>
                    // `;
                    // $('.section-files-'+arrayPreguntas[i]['idPregunta']).append(htmlModuleUpFiles);
                    
                    // Insertar en el html un div colapsado para ver los files

                    let countImagesPreguntas = 0;
                    let isImages = false;

                    let htmlModuleViewFiles = `
                    <div class="images-ups mt-3 d-none" id="divImages-${idUnicoInput}">
                        <a class="btn btn-sm btn-primary btn-collapse-files" data-toggle="collapse" href="#collapseSectionFiles${arrayPreguntas[i]['idPregunta']}" role="button" aria-expanded="false" aria-controls="collapseSectionFiles${arrayPreguntas[i]['idPregunta']}">
                            Archivos <span class="badge badge-light font-weight-600" id="countFiles-${idUnicoInput}"> ${countImagesPreguntas} </span>
                        </a>

                        <div class="collapse mt-2" id="collapseSectionFiles${arrayPreguntas[i]['idPregunta']}">
                            <div class="card card-body shadow-none border">
                                <div class="grid-container sectionFiles-${idUnicoInput}">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                   `;
                   $('.section-files-'+arrayPreguntas[i]['idPregunta']).append(htmlModuleViewFiles);

                    if(arrayPreguntas[i]['statusPreguntaAyuda'] == 1){
                        let htmlModuleQuestionsHelp = `
                        <li class="nav-item fade-show item-ayuda">
                            <a href="#!" onclick="obtenerPreguntasAyuda(${arrayPreguntas[i]['idPregunta']}, ${conteoPreguntas});" class="boton-pregunta-ayuda nav-link icon icon-sm icon-shape">
                                <i class="fas fa-book"></i>
                            </a>
                        </li>    
                        `;
                        $('#contenedorGrupoBotonesPregunta'+arrayPreguntas[i]['idPregunta']).append(htmlModuleQuestionsHelp);
                    }

                    var anotacionPregunta = arrayPreguntas[i]['anotacionPregunta'];

                    if(anotacionPregunta == '' || anotacionPregunta == null){
                    }else{
                        var htmlModuloAnotacion = `
                            <li class="nav-item fade show item-ayuda">
                                <a href="#!" data-toggle="popover" data-title="Anotaciones <i class='fas fa-angle-right'></i> <span class='text-primary'>${conteoPreguntas}. Pregunta</span>" data-content="<i></i>${arrayPreguntas[i]['anotacionPregunta']}<i></i>" class="boton-pregunta-anotacion icon icon-sm icon-shape">
                                    <i class="fas fa-info"></i>
                                </a>
                            </li>
                        `;
                        $('#contenedorGrupoBotonesPregunta'+arrayPreguntas[i]['idPregunta']).append(htmlModuloAnotacion);
                    }

                    // Colocar checkbox de si aplica o no aplica
                    var htmlModuloAplica = `
                    <li class="nav-item">
                        <label class="check-pregunta-aplica icon icon-sm icon-shape" data-toggle="tooltip" title="Si aplica">
                            <input class="checkAplica" type="checkbox" id="checkAplica${idUnicoInput}" data-id-checkbox="checkbox${idUnicoInput}" name="checkAplica${conteoPreguntas}" value="No aplica" checked="">
                            <i class="fas fa-check"></i>
                        </label>
                    </li>
                    `;
                    $('#contenedorGrupoBotonesPregunta'+arrayPreguntas[i]['idPregunta']).append(htmlModuloAplica);
                }
            }
        }

        $('.boton-pregunta-anotacion').popover({
            trigger: 'focus',
            html: true,
            placement: "top",
        });
       
        $('[data-toggle="tooltip"]').tooltip({
            // html : true,
            trigger: 'hover',
            placement: 'top',

        });

        // Colapsar automaticamente todos los elementos colapsados
        $('.btn-collapse-files').on('click', function () {
            $('.collapse').collapse('hide');
        });

        $("input:checkbox[class='checkRespuesta']").on('click', function(event) {
            let idCheckbox = $(this).prop('id');
            let idPregunta = $(this).data('pregunta');
        
            if($(this).is(":checked")){
                checkCliqueado = $(this).prop("checked", true);
                respuestaCheckbox = 'Si cumple';
            }else{
                checkCliqueado = $(this).prop("checked", false);
                respuestaCheckbox = 'No cumple';       
            }

            let dataRespuesta = new FormData();
            dataRespuesta.append("idCheckbox", idCheckbox);
            dataRespuesta.append("respuestaCheckbox", respuestaCheckbox);
            dataRespuesta.append("idPregunta", idPregunta);

            var request = $.ajax({
                url: 'models/diagnostico/guardarCadaRespuestaCheckbox.php',
                method: "POST",
                data: dataRespuesta,
                contentType: false,
                processData: false,
                dataType: 'json',

                beforeSend: function( xhr ) {
                }
            });
        
            request.done(function(response) {
                if(response.status == 'respuestaCheckboxGuardada'){}
            });
            
            request.fail(function(jqXHR, textStatus) {
                alert('Error al guardar la respuesta del checkbox');
            });   
        });

        $("input:checkbox[class='checkAplica']").on('click', function(event) {
            
            if($(this).is(":checked")){
                checkCliqueado = $(this).prop("checked", true);
                respuestaCheckboxAplica = '1';
                $(this).parent('label').children('i').prop('class', 'fas fa-check');
                $(this).parent('label').attr('data-original-title', 'Si aplica').tooltip('show');   
                $(this).parent('label').removeClass('check-pregunta-no-aplica').addClass('check-pregunta-si-aplica');
                $(this).closest('.col-md-12').find('.form-group').removeClass('opacity-6-disabled');
                $(this).parents('.grupo-botones-pregunta').find('.item-ayuda').removeClass('opacity-4-disabled');
            }else{
                checkCliqueado = $(this).prop("checked", false);
                respuestaCheckboxAplica = '0';    
                $(this).parent('label').children('i').prop('class', 'fas fa-times');   
                $(this).parent('label').attr('data-original-title', 'No aplica').tooltip('show');   
                $(this).parent('label').removeClass('check-pregunta-si-aplica').addClass('check-pregunta-no-aplica');
                $(this).closest('.col-md-12').find('.form-group').addClass('opacity-6-disabled');
                $(this).parents('.grupo-botones-pregunta').find('.item-ayuda').addClass('opacity-4-disabled');
            }

            let dataIdCheckbox = $(this).data('id-checkbox');

            let dataAplica = new FormData();
            dataAplica.append("dataIdCheckbox", dataIdCheckbox);
            dataAplica.append("respuestaAplica", respuestaCheckboxAplica);

            var request = $.ajax({
                url: 'models/diagnostico/guardarCadaRespuestaAplica.php',
                method: "POST",
                data: dataAplica,
                contentType: false,
                processData: false,
                dataType: 'json',

                beforeSend: function( xhr ) {
                }
            });
        
            request.done(function(response) {
                // if(response.status == 'respuestaAplicaGuardada'){}
            });
            
            request.fail(function(jqXHR, textStatus) {
                alert('Error al guardar la respuesta del checkbox');
            });   
        });

        $('textarea').on('change', function(event){
            let dataIdCheckbox = $(this).data('id-checkbox');
            let observacion = $(this).val();

            let dataObservacion = new FormData();
            dataObservacion.append("dataIdCheckbox", dataIdCheckbox);
            dataObservacion.append("observacion", observacion);

            var request = $.ajax({
                url: 'models/diagnostico/guardarCadaRespuestaTextarea.php',
                method: "POST",
                data: dataObservacion,
                contentType: false,
                processData: false,
                dataType: 'json',
        
                beforeSend: function( xhr ) {}
            });
        
            request.done(function(response) {
                if(response.status == 'respuestaTextareaGuardada'){}
            });
            
            request.fail(function(jqXHR, textStatus) {   
            });  
        });

        // Validar cuando input file cambie
        $('.inputResponseFiles').on('change', function(event) {
            
            let input = $(this);
            let dataIdInputRespuesta = input.data('id-inputrespuesta');
            var idDiagnostico = getParameter('idDiagnostico');
            
            if(input.prop('files') && input.prop('files')[0]){

                let files = input.prop('files');
                // var files2 = JSON.stringify(files);
                // console.log(files);
               
                let dataFiles = new FormData();

                dataFiles.append("idInputRespuesta", "checkbox" + dataIdInputRespuesta);
                dataFiles.append("idDiagnostico", idDiagnostico);

                
                for (let i = 0; i < files.length; i++) {
                    dataFiles.append("files[]", files[i]);
                }

                // dataFiles = JSON.stringify(dataFiles);

                // Solicitud al servidor para guardar las imagenes
                let request = $.ajax({
                    url: 'models/diagnostico/guardarImagenCadaRespuesta.php',
                    method: "POST",
                    data: dataFiles,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
            
                    beforeSend: function( xhr ) {}
                });
            
                request.done(function(response) {

                    if(response.status == 'success'){

                        $('#divImages-'+dataIdInputRespuesta).removeClass('d-none');

                        // Sumar la cantidad de imagenes
                        let labelCountFiles = $('#countFiles-'+dataIdInputRespuesta);
                        let countFiles = parseInt(labelCountFiles.html()) + response.images.length;
                        labelCountFiles.html(countFiles);

                        for (let i = 0; i <  response.images.length; i++) {
                            let htmlImage = `
                            <div class="text-center">
                                <img class="item-image border rounded" src="assets/img/images-de-evidencias/${response.images[i]['url']}"></img>
                                <button type="button" data-id-imagen="${response.images[i]['id']}" data-inputrespuesta="${dataIdInputRespuesta}" data-url-imagen="${response.images[i]['url']}" class="mt-3 btn btn-sm btn-outline-danger text-center btn-delete-image-response">Eliminar</button>
                            </div>
                            `;
                            $('.sectionFiles-'+dataIdInputRespuesta).append(htmlImage);  
                        }
                    }
                });
                
                request.fail(function(jqXHR, textStatus) {   
                    console.log(textStatus);
                });
            }     
        });

        // Eventlistener global que se sigue ejecutando aun que sea un elemento creado dinamicamente
        $(document).on('click', '.btn-delete-image-response', function(e) {
            e.preventDefault();
            
            let btn = $(this);
            btn.addClass('disabled');
            btn.html('En curso');

            let dataIdImagen = btn.data('id-imagen');
            let dataUrlImagen = btn.data('url-imagen');
            let dataIdInputRespuesta = btn.data('inputrespuesta');

            let request = $.ajax({
                url: 'models/diagnostico/eliminarImagenRespuesta.php',
                method: "POST",
                data: {
                    "id": dataIdImagen,
                    "url": dataUrlImagen
                },
                // contentType: "application/json",
                // processData: false,
                dataType: 'json',
        
                beforeSend: function( xhr ) {}
            });
        
            request.done(function(response) {

                if(response.status == 'success'){
                    let divImage = btn.parent();
                    divImage.remove();

                    // Restar el contador de imagenes
                    let labelCountFiles = $('#countFiles-'+dataIdInputRespuesta);
                    let countFiles = parseInt(labelCountFiles.html()) - 1;
                    labelCountFiles.html(countFiles);
                }
            });
            
            request.fail(function(jqXHR, textStatus) {   
                console.log(textStatus);
            });

        });

        var pasoActualWizard = 0;
        $('#smartwizard').smartWizard({
            selected: pasoActualWizard,
            keyNavigation:true, // Teclas derecha, izquierda activadas
            autoAdjustHeight: true, // Ajustarse automaticamente al alto del contenido
            cycleSteps: false, // Permite realizar un ciclo de navegación de pasos
            // useURLhash: true, // Enable selection of the step based on url hash
            showStepURLhash: true,
            lang : {  
                next : 'SIGUIENTE' ,  
                previous : 'ANTERIOR' 
            },
            toolbarSettings: {
                toolbarPosition: 'both', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                toolbarExtraButtons: [
                    $('<button></button>').text('FINALIZAR DIAGNOSTICO')
                    .attr('type','button')
                    .addClass('btn btn-outline-success mt-3 mt-md-0 btnFinalizar')
                    .on('click', function(){  
                        Swal.fire({
                            title: '¿Ya terminaste?',
                            text: "Estamos preparados para generar los resultados.",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: '¡Si, ver resultados!',
                            cancelButtonText: 'No, cancelar',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-neutral',
                            }
                            }).then((result) => {
                            if (result.value) {

                                var idDiagnostico = getParameter('idDiagnostico');
                                var request = $.ajax({
                                    url: 'models/diagnostico/guardarStatusCompletado.php',
                                    method: "POST",
                                    data: {
                                        'idDiagnostico': idDiagnostico,
                                    },
                                    // contentType: false,
                                    // processData: false,
                                    dataType: 'json',
                            
                                    beforeSend: function( xhr ) {}
                                });
                            
                                request.done(function(response) {
                                    if(response.status == "statusGuardado"){
                                        Toast.fire({
                                            icon: 'success',
                                            timer: 500,
                                            title: 'Redireccionando a los resultados.',
                                            position: 'top-end',
                                        });

                                        setTimeout(() => {
                                            verResultadosDiagnostico(true, idGrupoDiagnostico, idDiagnostico);     
                                        }, 500);
                                    }
                                    
                                });
                                
                                request.fail(function(jqXHR, textStatus) {   
                                });

                            } 
                        });   
                    }),
                ]
            }, 
            disabledSteps: [],   
            errorSteps: [],  
            theme: 'default',
            transitionEffect: 'fade',
            transitionSpeed: '500'
        });

        // Cada vez que el usuario pase a otra etapa el navegador se va acomoda a la parte de arriba de la prueba
        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // location.href="#contenedorFullPreguntas";
             // Guardar etapa modulo en la base de datos
             let idDiagnostico = getParameter('idDiagnostico');
             let numeroEtapa = stepNumber;
 
             var request = $.ajax({
                 url: 'models/diagnostico/guardarEtapaDiagnostico.php',
                 method: "POST",
                 data: {
                     'idDiagnostico': idDiagnostico,
                     'numeroEtapa': numeroEtapa
                 },
                 // contentType: false,
                 // processData: false,
                 dataType: 'json',
         
                 beforeSend: function( xhr ) {}
             });
         
             request.done(function(response) {
                 
             });
             
             request.fail(function(jqXHR, textStatus) {   
             });  
             
        });
    
        $.validator.messages.required = ''; 
        $("#formPreguntas").validate({
            highlight: function ( element, errorClass, validClass ) {
                $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).removeClass( "is-invalid" );
            }
        });

        // Se le agregan clases al modal de preguntas de ayuda
        $('#modalPreguntasAyuda').on('show.bs.modal', function (e) {
            $('.body-page').addClass('modal-open-scroll');
            $(this).addClass('tamaño-modal-custom shadow-ultra-lg');
            $('.modal-dialog').addClass('custom-modal-dialog');
        });
    
        // Poner arrastrable el modal de preguntas de ayuda
        $("#modalPreguntasAyuda").draggable({
            handle: ".modal-content"
        }); 

        // Cuando se arrastra el modal los popovers dentro se van a esconder
        $("#modalPreguntasAyuda").on("dragstart", function(event, ui) {
            $('.popover-pregunta-ayuda').popover('hide');
        });

        // Cuando se termine de mostrar el popover se le va a poner el scrollLock
        // Se le cambia el alto del popover si este este mas alto de 120px
        $('.boton-pregunta-anotacion').on('shown.bs.popover', function (event) {
            var idPopover = $(event.target).attr('aria-describedby'); 
            var popoverSeleccionado = $('#'+idPopover).children('.popover-body');
            popoverSeleccionado.scrollLock({
                strict: false,
                animation:  {
                    "top": "top elastic-top",
                    "bottom": "bottom elastic-bottom"
                }
            });

            popoverSeleccionado.height('auto');
            var alturaPopoverBody = popoverSeleccionado.height();
            if(alturaPopoverBody > 120){
                popoverSeleccionado.height(120);
                $('.boton-pregunta-anotacion').popover('update');
            }
        });

        // location.href="#contenedorFullPreguntas";

        //Abrir modal para guardar el diagnostico
        primerGuardadoDiagnostico();
    });
    
    request.fail(function(jqXHR, textStatus) {
    });    

}

var primerGuardadoDiagnostico = function(){
    Swal.mixin({                            
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonText: 'Siguiente',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,   
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-neutral',
        },
        progressSteps: ['1', '2']
      }).queue([
        {
            input: 'text',
            title: '¿Como se va a llamar este diagnostico?',
            text: 'Ejemplo: Diagnostico de noviembre 2019',
            inputPlaceholder: 'Nombre del diagnostico',
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value === '') {
                        resolve('Necesitamos un nombre para identificar al diagnostico!')
                    } else {
                        resolve()
                    }
                });
            }
        },
        {
            input: 'textarea',
            title: '¿Cual es el objetivo de este diagnostico?',
            text: 'Este campo es opcional',
            inputPlaceholder: 'Objetivo del diagnostico (Opcional)',
        },
      ]).then((result) => {
        if (result.value) {
            // JSON.stringify(result.value);
            $("#inputNombreDiagnostico").val(result.value[0]);
            $("#inputDescripDiagnostico").val(result.value[1]);

            if($("#inputNombreDiagnostico").val().length > 0){

                let idGrupoDiagnostico = getParameter('idGrupoDiagnostico');
                let idGrupoPreguntas = getParameter('idGrupoPreguntas');

                let formPreguntasData = new FormData();
                formPreguntasData.append("nombreDiagnostico", result.value[0]);
                formPreguntasData.append("descripcionDiagnostico", result.value[1]);
                formPreguntasData.append("idGrupoDiagnostico", idGrupoDiagnostico);
                formPreguntasData.append("idGrupoPreguntas", idGrupoPreguntas);

                $('input:checkbox[class="checkRespuesta"]').each(function(index) {
                   let idInputRespuesta = $(this).attr('id');
                   let idPregunta = $(this).data('pregunta');
                   let conteo = index+1
                   formPreguntasData.append("idInputRespuesta"+conteo, idInputRespuesta);
                   formPreguntasData.append("idPregunta"+conteo, idPregunta);
                });

                var request = $.ajax({
                    url: 'models/diagnostico/primerGuardadoDiagnostico.php',
                    method: "POST",
                    data: formPreguntasData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
            
                    beforeSend: function( xhr ) {
                        Swal.fire({
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            html: '<span class="swal2-title" style="font-size: 1.3rem;">Estamos preparando todo... <i class="fas fa-sync fa-spin text-success"></i></span>'
                        });
                    }
                });
            
                request.done(function(response) {
                    if(response.status == 'diagnosticoGuardado'){
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 8000,
                            timerProgressBar: true,
                            icon: 'success',
                            title: '¡Todo esta listo, puedes comenzar ahora!',
                            position: 'top-end',
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                              }
                        });

                        $('#labelNombreDiagnostico').html(result.value[0]);
                        history.pushState(null, "", "?view=diagnostico&action=nuevoDiagnostico&idGrupoDiagnostico="+response.idGrupoDiagnosticos+"&idGrupoPreguntas="+response.idGrupoPreguntas+"&idDiagnostico="+response.idDiagnostico); 
                    }else{

                        Swal.fire({
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-neutral',
                            },
                            showConfirmButton: true,
                            confirmButtonText: 'Intentar con otro nombre',
                            icon: 'error',
                            title: 'Ya existe un diagnostico con el mismo nombre',
                            text: response.msj,

                        }).then((result) => {

                            if (result.isConfirmed) {
                                location.reload();
                            } 
                        })
                    }
                });
                
                request.fail(function(jqXHR, textStatus) {
                    alert('Error al guardar como primera instancia el diagnostico');
                });   
                
            }else{
                let timerInterval;
                Swal.fire({
                    title: 'Ha ocurrido un error!',
                    type: 'error',
                    showConfirmButton: false,
                    html: `<p class="mb-3"> No pudimos guardar el diagnostico, por favor comunicar a soporte!</p> 
                        <button class="btn btn-outline-primary mb-3" id="cerrarModal">Entendido!</button>
                        <p class="small">Me voy a cerrar en <strong></strong> segundos.</p>`,
                    timer: 25000,
                    willOpen: () => {
                        const content = Swal.getContent()
                        const $ = content.querySelector.bind(content)
                        const cerrarModal = $('#cerrarModal');

                        cerrarModal.addEventListener('click', () => {
                            Swal.close();
                            clearInterval(timerInterval);
                        });
        
                        timerInterval = setInterval(() => {
                            Swal.getContent().querySelector('strong').textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval); 
                    }
                });
            }
        }else if(result.dismiss === Swal.DismissReason.cancel){
            location.href = "?view=diagnostico";
        }else{}
    });
}

// $(function(){
//     mostrarPreguntasDiagnostico();
// });

$(document).ready(function () {
    mostrarPreguntasDiagnostico();
});