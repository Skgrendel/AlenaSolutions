var funcionesPersonalizarInforme = function(){

    $('nav.navbar').addClass('bg-default');

    let idDiagnostico = getParameter('idDiagnostico');

    let dataDiagnosticoID = new FormData();
    dataDiagnosticoID.append("idDiagnostico", idDiagnostico);

    $.ajax({

        url: "models/diagnostico/resultadosObtenerInfoGeneral.php",
        type: "POST",
        data: dataDiagnosticoID,
        contentType: false,
        processData: false,
        dataType: "json",

        success: function(data){

            //cargamos datos sobre el diagnostico a la vista
            $(".nombreDiagnostico").html(data.nombreDiagnostico);
            $(".nombreEmpresa").html(data.nombreEmpresa);
            
        }

    });

    var idGrupoDiagnostico = getParameter('idGrupoDiagnostico');
 
    let datosParaObtenerLosResultados = new FormData();
    datosParaObtenerLosResultados.append("idGrupoDiagnostico", idGrupoDiagnostico);
    datosParaObtenerLosResultados.append("idDiagnostico", idDiagnostico);

    // Obtener informacion de los graficos
    var requestGraficos = $.ajax({
        url: "models/diagnostico/resultadosObtenerInfoGrafica.php",
        method: "POST",
        data: datosParaObtenerLosResultados,
        contentType: false,
        processData: false,
        dataType: 'json',

        beforeSend: function( xhr ) {
        }
    });
    requestGraficos.done(function(response) {

        // Chart.defaults.global.defaultFontFamily = "Poppins";
        var barChart = document.getElementById("chart-barra").getContext('2d');              
        var myChartBarra = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: ['Porcentaje'],
                datasets: [{

                    data: [response[1]['resultadoTotalGlobal']], 
                    label: "Cumplimiento",   
                    backgroundColor: 'rgb(4, 220, 127, 0.3)',
                    borderColor: 'rgb(4, 220, 127)',
                    borderWidth: 1,

                },
                {
                    data: [response[1]['resultadoTotalIncumplimientoGlobal']], 
                    label: "Incumplimiento",
                    backgroundColor: 'rgb(255, 15, 63, 0.3)',
                    borderColor: "rgb(255, 15, 63)",
                    borderWidth: 1
                }
            ]
            },
          
            options: {
                animation: {
                    // onComplete: function(){
                    //     var url = myChartBarra.toBase64Image(); //get image as base64
                    //     document.getElementById("barChartBase64").value = url; //to fill image in html
                    // }
                    onComplete: function(){
                        var url = myChartBarra.toBase64Image(); //get image as base64
                        document.getElementById("barChartBase64").value = url; //to fill image in html
                    },
                    animateScale: !0,
                    animateRotate: !0
                },  
                title: {
                    display: false,
                    text: 'Porcentaje total de todos los modulos',
                    fontFamily: 'Poppins',
                    fontStyle: '500',
                    
                    padding: 40,
                    fontSize: 14,
                },
                plugins: {
                    labels: {
                        render: function (args) {
                            return args.value+'%';
                        },
                        fontColor: '#8898aa',
                        fontStyle: '500',
                        fontSize: 14,
                        fontFamily: 'Poppins',
                    }
                },       
                responsive: !0,

                tooltips: {
                    titleFontFamily: 'Poppins',
                    titleFontStyle: 500,
                    titleFontSize: 14,
                    bodyFontFamily: 'Poppins',
                    bodyFontStyle: 300,
                    xPadding: 10,
                    yPadding: 10,
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontFamily: 'Poppins',
                        fontStyle: '400',
                        fontSize: 14.5,
                    }
                },
                layout: {
                    // padding: {
                    //     left: 0,
                    //     right: 0,
                    //     top: 50,
                    //     bottom: 0
                    // }
                },
                // scales: {
                //     yAxes: [{
                //         ticks: {
                //             beginAtZero:true,
                //             fontFamily: 'Poppins',
                //         }
                //     }],
                //     xAxes: [{
                //         ticks: {
                //             beginAtZero:true,
                //             fontFamily: 'Poppins',
                //             fontSize: 14,
                //         }
                //     }],
                    
                // }
            }
        });

        // let htmlGraficoDetalladoTotal = `
        // <li class="list-group-item border-0 px-0">
        //     <div class="row align-items-center">
        //     <div class="col-auto">
        //         <a href="#!" class="avatar bg-secondary rounded-circle">
        //         <i class="far fa-check-circle text-success text-lg"></i>
        //         </a>
        //     </div>
        //     <div class="col">
        //         <h4>Cumplimiento <span class="text-success">${response[1]['resultadoTotalGlobal']}%</span></h4>
        //         <span class="text-sm"><span class="font-weight-600">${response[1]['totalRespuestasSiCumpleGlobal']}</span> preguntas fueron contestadas como SI CUMPLE de <span class="font-weight-600">${response[1]['totalPreguntasGlobal']}</span> preguntas aplicables en total.</span>
        //     </div>
        //     </div>
        // </li>

        // <li class="list-group-item  px-0">
        //     <div class="row align-items-center">
        //     <div class="col-auto">
        //         <a href="#!" class="avatar bg-secondary rounded-circle">
        //         <i class="far fa-times-circle text-danger text-lg"></i>
        //         </a>
        //     </div>
        //     <div class="col">
        //         <h4>Incumplimiento <span class="text-danger">${response[1]['resultadoTotalIncumplimientoGlobal']}%;</span></h4>
        //         <span class="text-sm"><span class="font-weight-600">${response[1]['totalRespuestasNoCumpleGlobal']}</span> preguntas fueron contestadas como NO CUMPLE de <span class="font-weight-600">${response[1]['totalPreguntasGlobal']}</span> preguntas aplicables en total.</span>
        //     </div>
        //     </div>
        // </li>`;
        // $('.guiaGraficoDetalladoTotal').append(htmlGraficoDetalladoTotal);

        // Este es el grafico del resultado de cada uno de los modulos
        var arrayTemarios = response[0]['resultadosPorTemarios'];
        var tamañoArrayTemarios = response[0]['resultadosPorTemarios'].length;
        var arrayTodosLosTemarios = new Array(); 
        var arrayTodosLosTemarios2 = new Array(); 
        var arrayOrdenTemario = new Array(); 
        for (let i = 0; i < tamañoArrayTemarios; i++) {
            arrayTodosLosTemarios.push(i+1+'. '+arrayTemarios[i]['nombreTemario']);     
            arrayOrdenTemario.push(`Modulo ${i+1}`);    
            arrayTodosLosTemarios2.push(` Modulo ${i+1}. ${arrayTemarios[i]['nombreTemario']}`);     
        }   

        var arrayTodosLosResultados = new Array(); 
        var arrayTodosLosResultadosIncumplimiento = new Array(); 
        for (let i = 0; i < tamañoArrayTemarios; i++) {
            arrayTodosLosResultados.push(arrayTemarios[i]['resultadoModuloCumplimiento']); 
            arrayTodosLosResultadosIncumplimiento.push(arrayTemarios[i]['resultadoModuloIncumplimiento']);         
        }   

        var colores = ['#5e72e4', '#2dce89', '#11cdef', '#fb6340', '#f5365c', 
        '#ffd600', '#11cdef', '#2bffc6', '#8965e0', '#00ffff', '#008b8b', 
        '#8b008b', '#8b0000', '#ff00ff', '#4b0082', '#f0e68c', '#ffb6c1', '#ff00ff',
        '#000080', '#ffa500', '#800080', '#ff0000', '#c0c0c0', '#add8e6', '#90ee90',
        '#ffd700', '#a52a2a', '#00ffff']; 

        Array.prototype.getRandom = function(cut){
            var i= Math.floor(Math.random()*this.length);
            if(cut && i in this){
                return this.splice(i, 1)[0];
            }
            return this[i];
        }

        var coloresBGRandom = new Array();
        var bordersColors = new Array();
        for (let i = 0; i < tamañoArrayTemarios; i++) {
            coloresBGRandom.push(colores.getRandom());  
            bordersColors.push('#fff');
        } 

        var barChartModulos = document.getElementById('chart-pie-modulos').getContext('2d');  
        var myChartBarModulos = new Chart(barChartModulos, {     
            type: 'bar',
            data: {
                labels: arrayOrdenTemario,

                datasets: [{
                    data: arrayTodosLosResultados,
                    label: ' Cumplimiento',
                    backgroundColor: 'rgb(4, 220, 127, 0.3)',
                    borderColor: 'rgb(4, 220, 127)',
                    borderWidth: 1
                },{
                    data: arrayTodosLosResultadosIncumplimiento,
                    label: ' Incumplimiento',
                    backgroundColor: 'rgb(255, 15, 63, 0.3)',
                    borderColor: "rgb(255, 15, 63)",
                    borderWidth: 1
                }],
            },
            options: {
                responsive: true,
                plugins: {

                    labels: {
                        render: function (args) {
                            return args.value+'%';
                        },
                        fontColor: '#8898aa',
                        fontStyle: '500',
                        fontSize: 14,
                        fontFamily: 'Poppins',
                    }
                },
                animation: {
                    onComplete: function(){
                        var url2 = myChartBarModulos.toBase64Image(); //get image as base64
                        document.getElementById("pieChartBase64").value = url2; //to fill image in html
                    },
                    animateScale: !0,
                    animateRotate: !0
                },
                title: {
                    display: false,
                    text: 'Resultado en cada uno de los modulos',
                    fontFamily: 'Poppins',
                    fontStyle: '500',
                    padding: 40,
                    fontSize: 13,
                },
                tooltips: {
                    mode: 'point',
                    caretSize: 5,
                    titleFontFamily: 'Poppins',
                    titleFontStyle: 500,
                    titleFontSize: 14,
                    bodyFontFamily: 'Poppins',
                    bodyFontStyle: 300,
                    xPadding: 10,
                    yPadding: 10,
                    intersect: false,
                },
                legend: {
                    display: false,
                    position: "bottom",
                    labels: {
                        fontFamily: 'Poppins',
                        fontStyle: '400',
                    },
                },
                layout: {
                    // padding: {
                    //     left: 0,
                    //     right: 0,
                    //     top: 50,
                    //     bottom: 0
                    // }
                },
                // scales: {
                //     yAxes: [{
                //         ticks: {
                //             beginAtZero:true,
                //             fontFamily: 'Poppins',
                //         }
                //     }],
                //     xAxes: [{
                //         labels: arrayOrdenTemario,
                //         ticks: {
                //             display: true,
                //             beginAtZero:true,
                //             fontFamily: 'Poppins',
                //         }
                //     }],
                    
                // }
                
            }
        });

        var domChartRadar = document.getElementById('chart-radar').getContext('2d');
        var chartRadarModulos = new Chart(domChartRadar, {
            type: 'radar',
            data: {
                labels: arrayOrdenTemario,
                datasets: [{
                    data: arrayTodosLosResultados,
                    label: ' Cumplimiento',
                    backgroundColor: 'rgb(4, 220, 127, 0.3)',
                    borderColor: 'rgb(4, 220, 127)',
                    borderWidth: 1,
                }, {
                    data: arrayTodosLosResultadosIncumplimiento,
                    label: ' Incumplimiento',
                    backgroundColor: 'rgb(255, 15, 63, 0.3)',
                    borderColor: "rgb(255, 15, 63)",
                    borderWidth: 1
                    
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    scales: {
                        
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                let index = context[0].dataIndex;
                                // console.log(index);
                                let indexString = arrayTodosLosTemarios2[index];
                                // console.log(arrayTodosLosTemarios2);
                                return indexString;
                            }
                        }
                    }

                },

                animation: {
                    onComplete: function(){
                        let url3 = chartRadarModulos.toBase64Image(); //get image as base64
                        // console.log(url3);
                        let input = document.getElementById("radarChartBase64").value = url3; //to fill image in html
                        // console.log(document.getElementById("radarChartBase64"));
                    },
                    animateScale: !0,
                    animateRotate: !0
                },

                layout: {
                 
                },
                labels: {
                    fontFamily: 'Poppins',
                    fontStyle: '600',
                },
                datalabels: { 
                    fontSize: 30
                },

            
                tooltips: {
                    titleFontFamily: 'Poppins',
                    titleFontStyle: 500,
                    titleFontSize: 14,
                    bodyFontFamily: 'Poppins',
                    bodyFontStyle: 300,
                    xPadding: 10,
                    yPadding: 10,
                },

                title: {
                    display: false,
                    text: 'Chart.js Radar Chart'
                },

                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontFamily: 'Poppins',
                        fontStyle: '600',
                        font: {
                            size: 20
                        }
                    },
                },

                scales: {
                    r: {
                        angleLines: {
                            display: true
                        },
                        pointLabels: {
                          font: 60
                        },
                        suggestedMin: 50,
                        suggestedMax: 100,
                        fontSize: 30,

                    }
                }


            },
        });
        
        // for (let i = 0; i < tamañoArrayTemarios; i++) {
        //     let htmlGraficosDetallados = `
        //     <div class="row mb-4">
        //         <div class="col-12">
        //             <h3 class="h3 mb-4">${i+1}. </b>${arrayTemarios[i]['nombreTemario']}</h3>
        //         </div>
        //         <div class="col-12 col-md-6">

        //             <div class="row align-items-center">
        //                 <div class="col-auto">
        //                     <a href="#!" class="avatar bg-secondary rounded-circle">
                      
        //                     <i class="far fa-check-circle text-success text-lg"></i>
        //                     </a>
        //                 </div>
        //                 <div class="col">
        //                     <h4>Cumplimiento <span class="text-success">${arrayTemarios[i]['resultadoModuloCumplimiento']}%</span></h4>
        //                     <span class="text-sm"><span class="font-weight-600">${arrayTemarios[i]['respuestasSiCumple']}</span> preguntas fueron contestadas como SI CUMPLE de <span class="font-weight-600">${arrayTemarios[i]['respuestasSiAplica']}</span> preguntas aplicables en total.</span>
        //                 </div>
        //             </div>

        //         </div>

        //         <div class="col-12 col-md-6">

        //             <div class="row align-items-center">
        //                 <div class="col-auto">
        //                     <a href="#!" class="avatar bg-secondary rounded-circle">
        //                     <i class="far fa-times-circle text-danger text-lg"></i>
        //                     </a>
        //                 </div>
        //                 <div class="col">
        //                     <h4>Incumplimiento <span class="text-danger">${arrayTemarios[i]['resultadoModuloIncumplimiento']}%</span></h4>
        //                     <span class="text-sm"><span class="font-weight-600">${arrayTemarios[i]['respuestasNoCumple']}</span> preguntas fueron contestadas como NO CUMPLE de <span class="font-weight-600">${arrayTemarios[i]['respuestasSiAplica']}</span> preguntas aplicables en total.</span>
        //                 </div>
        //             </div>
            
        //         </div>
                
        //     </div>

        //     <hr>`;
        //     $('.chart-detallado').append(htmlGraficosDetallados);
        // } 

            
        setTimeout(() => {
            // html2canvas(document.querySelector(".guiaGraficoDetalladoTotal")).then(canvas => {
            //     let img1 = canvas.toDataURL();
            //     $('#chartDetalladoBase64_1').val(img1);
            //     console.log(img1);
          
            // });

            html2canvas(document.querySelector(".chart-detallado2")).then(canvas => {
                let img2 = canvas.toDataURL();
                $('#chartDetalladoBase64_2').val(img2);
                // console.log(img2);
                let divOculto = $('.divOculto');
                divOculto.addClass('d-none');

                let btnGenerarInformeCustom = $('#btnGenerarInformeCustom');
                btnGenerarInformeCustom.removeClass('disabledButton');
          
            });
        }, 200);
        
    });
    requestGraficos.fail(function(jqXHR, textStatus) {   
    });



    $('#listaHerramientas a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show');
    
        var $this = $(this);
        $('#primero').removeClass('activeList');
        $this.removeClass('active');
        
        $this.addClass('activeList');
        $this.toggleClass('activeList');
        
        var $dataList = $this.data('list');
        
    
    
        listFunction($dataList);
    });
    
    function listFunction($dataList) {
    
        let txtVista = $('.txtVista');
    
        switch ($dataList) {
            case 'marcaDeAgua':
    
                txtVista.html('Marca de agua');
                
            break;
            case 'logotipo':
            
                txtVista.html('Logotipo');
                
            break;
    
            case 'adjuntarImages':
            
                txtVista.html('Adjuntar imagenes');
                
            break;
    
            case 'firma':
            
                txtVista.html('Firma');
                
            break;
    
            case 'colores':
    
                txtVista.html('Colores');
    
            break;
        
            default:
                txtVista.html('Vista');
            break;
        }
         
    }

    $("#inputFileMa").fileinput({
        theme: "fas",
        language: "es",
        overwriteInitial: true,
        maxFileSize: 5000,
        maxFilePreviewSize: 10240,
        showPreview: true,
        showRemove: true,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        initialPreviewAsData: true,
        previewFileIcon: true,
        browseOnZoneClick: true,
        removeLabel: "",
        removeClass: "btn btn-outline-danger",
        removeTitle: 'Anular imagen seleccionada',
        msgErrorClass: 'alert alert-block alert-danger',
        elErrorContainer: '#kv-avatar-errors-2',
        // msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: `<div class="col-auto my-2">
                                    <div class="icon-lg icon-shape bg-primary rounded-circle text-white mb-2">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <span class="text-muted">Seleccione una imagen</span>
                                </div>`,
        layoutTemplates: { 
            main2: '{preview} {remove} {browse}'
        },
        allowedFileExtensions: ["jpg", "png", "jpeg"]
    });

    $("#inputFileLogo").fileinput({
        theme: "fas",
        language: "es",
        overwriteInitial: true,
        maxFileSize: 5000,
        maxFilePreviewSize: 10240,
        showPreview: true,
        showRemove: true,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        initialPreviewAsData: true,
        previewFileIcon: true,
        browseOnZoneClick: true,
        removeLabel: "",
        removeClass: "btn btn-outline-danger",
        removeTitle: 'Anular imagen seleccionada',
        msgErrorClass: 'alert alert-block alert-danger',
        elErrorContainer: '#kv-avatar-errors-2',
        // msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: `<div class="col-auto my-2">
                                    <div class="icon-lg icon-shape bg-success rounded-circle text-white mb-2">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <span class="text-muted">Seleccione un logo</span>
                                </div>`,
        layoutTemplates: { 
            main2: '{preview} {remove} {browse}'
        },
        allowedFileExtensions: ["jpg", "png", "jpeg"]
    });

    $("#inputImagesAdjuntas").fileinput({
        language: "es",
        // uploadAsync : true,
        theme : 'explorer-fas',
        uploadUrl: "models/diagnostico/GenerarPDFCustom.php",
        showCancel: false,
        showCaption: false,
        showClose: false,
        showUpload: false,
        maxFileCount: 10,
        maxFileSize: 10000,
        browseClass: "btn btn-sm btn-primary mt-2",
        browseLabel: "Agregar imagen",
        removeClass: "btn btn-sm btn-danger mt-2",
        removeLabel: "Quitar todo",
        
        defaultPreviewContent: `<div class="col-auto mt-3 mb-1">
                                    <div class="icon-sm icon-shape bg-primary rounded-circle text-white mb-2">
                                        <i class="fas fa-images"></i>
                                    </div>
                                    <span class="text-muted">Carga o arrastra las imagenes que quieras adjuntar en el documento.</span>
                                </div>`,
        // preferIconicPreview: true,
        allowedFileExtensions: ["jpg", "jpeg", "png"],
   
      
    });

    $("#inputFileFirma").fileinput({
        theme: "fas",
        language: "es",
        overwriteInitial: true,
        maxFileSize: 5000,
        maxFilePreviewSize: 10240,
        showPreview: true,
        showRemove: true,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        initialPreviewAsData: true,
        previewFileIcon: true,
        browseOnZoneClick: true,
        removeLabel: "",
        removeClass: "btn btn-outline-danger",
        removeTitle: 'Anular imagen seleccionada',
        msgErrorClass: 'alert alert-block alert-danger',
        elErrorContainer: '#kv-avatar-errors-2',
        // msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: `<div class="col-auto my-2">
                                    <div class="icon-lg icon-shape bg-primary rounded-circle text-white mb-2">
                                        <i class="fas fa-image"></i>
                                    </div>
                                    <span class="text-muted">Seleccione una imagen</span>
                                </div>`,
        layoutTemplates: { 
            main2: '{preview} {remove} {browse}'
        },
        allowedFileExtensions: ["jpg", "png", "jpeg"]
    });

}

function validarMarcaAgua(input){

    let inputTextMa = $('#inputTextMa').val();
    let inputFileMa = $('#inputFileMa').val();

    let opMarcaAgua = $('#opMarcaAgua');

    if(input == 'inputTextMa'){

        if(inputTextMa.length > 0){

            $('#marcaDeAgua a[href="#marcaAguaImagen"]').addClass('disabled-tab');
            opMarcaAgua.html('<i class="fas fa-check-circle text-success"></i>');

        }else{

            $('#marcaDeAgua a[href="#marcaAguaImagen"]').removeClass('disabled-tab');
            opMarcaAgua.html('');

        }

    }else{

        $('#inputFileMa').on('fileloaded', function(event, file, previewId, index, reader) {
            $('#marcaDeAgua a[href="#marcaAguaTexto"]').addClass('disabled-tab');
            opMarcaAgua.html('<i class="fas fa-check-circle text-success"></i>');
        });

        $('#inputFileMa').on('filecleared', function(event) {
            $('#marcaDeAgua a[href="#marcaAguaTexto"]').removeClass('disabled-tab');
            opMarcaAgua.html('');
        });

    }
    
}

function validarLogotipo(){

    let opLogotipo = $('#opLogotipo');

    $('#inputFileLogo').on('fileloaded', function(event, file, previewId, index, reader) {
        opLogotipo.html('<i class="fas fa-check-circle text-success"></i>');
        $('#maxHeightLogo').removeClass('disabled-input');
        $('#maxWidthLogo').removeClass('disabled-input');
        $('#posicionLogo').removeClass('disabled-input');
        $('#toggleQuitarLinea').removeClass('disabled-input');
        
        
    });

    $('#inputFileLogo').on('filecleared', function(event) {
        opLogotipo.html('');
        $('#maxHeightLogo').addClass('disabled-input');
        $('#maxWidthLogo').addClass('disabled-input');
        $('#posicionLogo').addClass('disabled-input');
        $('#toggleQuitarLinea').addClass('disabled-input');

        $('#maxHeightLogo').val('');
        $('#maxWidthLogo').val('');
    });

}

function validarImagesAdjuntas(){

    let opAdjuntarImages = $('#opAdjuntarImages');

    $('#inputImagesAdjuntas').on('fileloaded', function(event, file, previewId, index, reader) {
        opAdjuntarImages.html('<i class="fas fa-check-circle text-success"></i>');
        $('#ajustesImagesAdjuntas').removeClass('disabled-input');
        $('.btn-file').addClass('d-none');
    });


    $('#inputImagesAdjuntas').on('filecleared', function(event) {
        opAdjuntarImages.html('');
        $('#ajustesImagesAdjuntas').addClass('disabled-input');
        $('.btn-file').removeClass('d-none');

        let idDiagnostico = getParameter('id');

        let dataDiagnosticoID = new FormData();
        //variables añadidas al form
        dataDiagnosticoID.append("idDiagnostico", idDiagnostico);

        $.ajax({

            url: "models/diagnostico/DeleteFilesPDF.php?op=deleteImagesAdjuntas",
            type: "POST",
            data: dataDiagnosticoID,
            contentType: false,
            processData: false,
            dataType: "json",
    
            success: function(data){
    
               
                
            }
    
        });
    });

    
}

function validarFirma(input){

    let inputTextFirma = $('#inputTextFirma').val();
    let inputFileFirma = $('#inputFileFirma').val();
    let inputNombreAutor = $('#inputNombreAutor').val();
    let inputCargoAutor = $('#inputCargoAutor').val();

    let opFirma = $('#opFirma');

    if(inputTextFirma.length > 0 || inputNombreAutor.length > 0 || inputCargoAutor.length > 0 || inputFileFirma.length > 0){

        opFirma.html('<i class="fas fa-check-circle text-success"></i>');

    }else{

        opFirma.html('');
    }

    if(input == 'inputTextFirma'){

        if(inputTextFirma.length > 0){

            $('#firmaCustom a[href="#tabImagenFirma"]').addClass('disabled-tab');
            $('#utilizarFirmaText').removeClass('disabled-input');

        }else{

            $('#firmaCustom a[href="#tabImagenFirma"]').removeClass('disabled-tab');
            $('#utilizarFirmaText').addClass('disabled-input');

        }


    }else{

        $('#inputFileFirma').on('fileloaded', function(event, file, previewId, index, reader) {
            $('#firmaCustom a[href="#tabTextoFirma"]').addClass('disabled-tab');
        });

        $('#inputFileFirma').on('filecleared', function(event) {
            $('#firmaCustom a[href="#tabTextoFirma"]').removeClass('disabled-tab');
        });

    }
}

//funcion validar colores
$('input[name="colorCustom"]').on('change', function(e){
    if(this.value == "porDefecto"){
        
        $('#opColores').html('');

    }else if(this.checked) {

        $('#opColores').html('<i class="fas fa-check-circle text-success"></i>');

    }else {
        $('#opColores').html('');
    }
});

function obtenerHTML(){
    const contHTML = document.getElementById('contHTML');
    // console.log(contHTML.innerHTML);  
}

//codigo js puro 
function clickColor(value){

    let checkIcon = document.getElementById('checkIcon');
    let headerCard = document.getElementById('headerCard');

    

    checkIcon.classList.remove('text-primary');
    headerCard.classList.remove('bg-primary');

    switch (value) {
        case 'colorAzul':
            checkIcon.style.color = "#5e72e4";
            headerCard.style.backgroundColor = "#5e72e4";
   
        break;

        case 'colorAzulClaro':
            checkIcon.style.color = "#11cdef";
            headerCard.style.backgroundColor = "#11cdef";
          
        break;

        case 'colorVerde':
            checkIcon.style.color = "#2dce89";
            headerCard.style.backgroundColor = "#2dce89";
          
        break;

        case 'colorNaranja':
            checkIcon.style.color = "#fb6340";
            headerCard.style.backgroundColor = "#fb6340";
          
        break;

        case 'colorRojo':
            checkIcon.style.color = "#f5365c";
            headerCard.style.backgroundColor = "#f5365c";
          
        break;

        case 'colorGris':
            checkIcon.style.color = "#adb5bd";
            headerCard.style.backgroundColor = "#adb5bd";
          
        break;

        case 'colorNegro':
            checkIcon.style.color = "#212529";
            headerCard.style.backgroundColor = "#212529";
          
        break;

        case 'colorAzulOscuro':
            checkIcon.style.color = "#172b4d";
            headerCard.style.backgroundColor = "#172b4d";
          
        break;
    
        default:
            $('#opColores').html('');
            checkIcon.style.color = '#5e72e4';        
            headerCard.style.backgroundColor = '#5e72e4';
        break;
    }
}

$("#btnGenerarInformeCustom").click(function () {
    $("#formPersonalizarInforme").submit();
});

$("#formPersonalizarInforme").submit(function (e){

    e.preventDefault();
    
    //variables
    let idDiagnostico = getParameter('idDiagnostico');

    //form
    let dataCustomInforme = new FormData($("#formPersonalizarInforme")[0]);
    //variables añadidas al form
    dataCustomInforme.append("idDiagnostico", idDiagnostico);

    // $('#inputImagesAdjuntas').fileinput('upload');

    $.ajax({
        url: "models/diagnostico/generarPDFCustom.php",
        type: "POST",
        data: dataCustomInforme,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",

        beforeSend: function(){

            let btnGenerarInformeCustom = $('#btnGenerarInformeCustom');
            btnGenerarInformeCustom.addClass('disabledButton');
            btnGenerarInformeCustom.html('Generando PDF, por favor espere <i class="fas fa-circle-notch fa-spin"></i>');
            

        },

        success: function(data){

            let btnGenerarInformeCustom = $('#btnGenerarInformeCustom');
            btnGenerarInformeCustom.removeClass('disabledButton');
            btnGenerarInformeCustom.html('Ver informe');
            
            if(data.status == "true"){
                // console.log(data.prueba);
                $('#labelNombreDiagnosticoResultado').html(data.nombreDiagnostico);
                PDFObject.embed(`assets/temp/pdfCustom/${data.titlePDF}.pdf`, "#divInforme2");
                $("#modalInfome2").modal('show');                
            }  
        }
    });

});

$(function(){
    funcionesPersonalizarInforme();
});

