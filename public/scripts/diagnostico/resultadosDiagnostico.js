var obtenerResultadosDiagnostico = function () {
    $('nav.navbar').addClass('bg-default');

    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: true,
        icon: 'success',
        title: '¡Listo! estos son los resultados del diagnostico.',
        position: 'top-end',
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    var idGrupoDiagnostico = getParameter('idGrupoDiagnostico');
    var idDiagnostico = getParameter('idDiagnostico');

    let datosParaObtenerLosResultados = new FormData();
    datosParaObtenerLosResultados.append("idGrupoDiagnostico", idGrupoDiagnostico);
    datosParaObtenerLosResultados.append("idDiagnostico", idDiagnostico);

    // Obtener informacion general
    var requestInfoGeneral = $.ajax({
        url: "models/diagnostico/resultadosObtenerInfoGeneral.php",
        method: "POST",
        data: datosParaObtenerLosResultados,
        contentType: false,
        processData: false,
        dataType: 'json',

        beforeSend: function (xhr) {

        }
    });
    requestInfoGeneral.done(function (response) {
        if (response.status == 'datosObtenidos') {

            // Cargamos datos del diagnostico a la vista
            $(".nombreDiagnostico").html(response.nombreDiagnostico);
            $(".nombreEmpresa").html(response.nombreEmpresa);
            $(".nombreCreadorDiagnostico").html(response.nombreCreadorDiagnostico);
            $(".nombreGrupoDiagnosticos").html(response.nombreGrupoDiagnosticos);
            $(".fechaCreacionDiagnostico").html(response.fechaCreacionDiagnostico);
            $(".ultimaConexionCreadorDiagnostico").html(response.ultimaConexionCreadorDiagnostico);
            // Datos de la empresa
            $(".nitEmpresa").html(response.nitEmpresa);
            $(".fechaCreacionEmpresa").html(response.fechaCreacionEmpresa);
            // Datos del grupo de Diagnosticos
            $(".nombreGrupoDiag").html(response.nombreGrupoDiagnosticos);
            $(".nombreCreadorGrupo").html(response.nombreCreadorGrupo);
            $(".fechaCreacionGrupo").html(response.fechaCreacionGrupo);
            $(".totalDiagnosticosGrupo").html(response.totalDiagnosticosGrupo);

            if (response.descripcionDiagnostico == "") {
                $(".descripcionDiagnostico").html("No se especificó un objetivo para este diagnostico.");
            } else {
                $(".descripcionDiagnostico").html(response.descripcionDiagnostico);
            }
        }
    });
    requestInfoGeneral.fail(function (jqXHR, textStatus) {});

    // Obtener informacion de los graficos
    var requestGraficos = $.ajax({
        url: "models/diagnostico/resultadosObtenerInfoGrafica.php",
        method: "POST",
        data: datosParaObtenerLosResultados,
        contentType: false,
        processData: false,
        dataType: 'json',

        beforeSend: function (xhr) {}
    });

    requestGraficos.done(function (response) {

        // console.log(response);

        // let htmlConceptoResultado = `

        // `;
        // $('.conceptoResultado').append(htmlConceptoResultado);

        // Este es el segundo grafico que contiene el resultado total de la prueba
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
                        borderWidth: 1

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
                    // },
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
                    // labels: {
                    //     render: function (args) {
                    //         return args.value + '%';
                    //     },
                    //     fontColor: '#8898aa',
                    //     fontStyle: '500',
                    //     fontSize: 14,
                    //     fontFamily: 'Poppins',
                    // },
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
                //             beginAtZero: true,
                //             fontFamily: 'Poppins',
                //         }
                //     }],
                //     xAxes: [{
                //         ticks: {
                //             beginAtZero: true,
                //             fontFamily: 'Poppins',
                //             fontSize: 14,
                //         }
                //     }],

                // }
            }
        });

        // Esta es la grafica horizontal detallada del resultado total de la prueba
        let htmlGraficoDetalladoTotal = `
        <li class="list-group-item border-0 px-0">
            <div class="row align-items-center">
            <div class="col-auto">
                <a href="#!" class="avatar bg-secondary rounded-circle">
                <i class="far fa-check-circle text-success text-lg"></i>
                </a>
            </div>
            <div class="col">
                <h4>Cumplimiento <span class="text-success">${response[1]['resultadoTotalGlobal']}%</span></h4>
                <span class="text-sm"><span class="font-weight-600">${response[1]['totalRespuestasSiCumpleGlobal']}</span> preguntas fueron contestadas como SI CUMPLE de <span class="font-weight-600">${response[1]['totalPreguntasGlobal']}</span> preguntas aplicables en total.</span>
            </div>
            </div>
        </li>

        <li class="list-group-item  px-0">
            <div class="row align-items-center">
            <div class="col-auto">
                <a href="#!" class="avatar bg-secondary rounded-circle">
                <i class="far fa-times-circle text-danger text-lg"></i>
                </a>
            </div>
            <div class="col">
                <h4>Incumplimiento <span class="text-danger">${response[1]['resultadoTotalIncumplimientoGlobal']}%</span></h4>
                <span class="text-sm"><span class="font-weight-600">${response[1]['totalRespuestasNoCumpleGlobal']}</span> preguntas fueron contestadas como NO CUMPLE de <span class="font-weight-600">${response[1]['totalPreguntasGlobal']}</span> preguntas aplicables en total.</span>
            </div>
            </div>
        </li>

        `;
        $('.guiaGraficoDetalladoTotal').append(htmlGraficoDetalladoTotal);


        // Este es el grafico del resultado de cada uno de los modulos
        var arrayTemarios = response[0]['resultadosPorTemarios'];
        var tamañoArrayTemarios = response[0]['resultadosPorTemarios'].length;
        var arrayTodosLosTemarios = new Array();
        var arrayTodosLosTemarios2 = new Array();
        var arrayOrdenTemario = new Array();

        for (let i = 0; i < tamañoArrayTemarios; i++) {
            arrayTodosLosTemarios.push(i + 1 + '. ' + arrayTemarios[i]['nombreTemario']);
            arrayOrdenTemario.push(`Módulo ${i+1}`);
            arrayTodosLosTemarios2.push(` Módulo ${i+1}. ${arrayTemarios[i]['nombreTemario']}`);
        }

        var arrayTodosLosResultadosCumplimiento = new Array();
        var arrayTodosLosResultadosIncumplimiento = new Array();
        for (let i = 0; i < tamañoArrayTemarios; i++) {
            arrayTodosLosResultadosCumplimiento.push(arrayTemarios[i]['resultadoModuloCumplimiento']);
            arrayTodosLosResultadosIncumplimiento.push(arrayTemarios[i]['resultadoModuloIncumplimiento']);
        }

        var colores = ['#5e72e4', '#2dce89', '#11cdef', '#fb6340', '#f5365c',
            '#ffd600', '#11cdef', '#2bffc6', '#8965e0', '#00ffff', '#008b8b',
            '#8b008b', '#8b0000', '#ff00ff', '#4b0082', '#f0e68c', '#ffb6c1', '#ff00ff',
            '#000080', '#ffa500', '#800080', '#ff0000', '#c0c0c0', '#add8e6', '#90ee90',
            '#ffd700', '#a52a2a', '#00ffff'
        ];

        Array.prototype.getRandom = function (cut) {
            var i = Math.floor(Math.random() * this.length);
            if (cut && i in this) {
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
                    data: arrayTodosLosResultadosCumplimiento,
                    label: ' Cumplimiento',
                    backgroundColor: 'rgb(4, 220, 127, 0.3)',
                    borderColor: 'rgb(4, 220, 127)',
                    borderWidth: 1
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

                    // labels: {
                    //     render: function (args) {
                    //         return args.value + '%';
                    //     },
                    //     fontColor: '#8898aa',
                    //     fontStyle: '500',
                    //     fontSize: 14,
                    //     fontFamily: 'Poppins',
                    // },
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
                    onComplete: function () {
                        // var url2 = myChartBarModulos.toBase64Image(); //get image as base64
                        // console.log(url2);
                        // document.getElementById("pieChartBase64").value = url2; //to fill image in html

                        // let btnGenerarInforme = $('#btnGenerarInfome');
                        // btnGenerarInforme.removeClass('disabledButton');
                        // btnGenerarInforme.html('Generar informe');
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
                //             beginAtZero: true,
                //             fontFamily: 'Poppins',
                //         }
                //     }],
                //     xAxes: [{
                //         labels: arrayOrdenTemario,
                //         ticks: {
                //             display: true,
                //             beginAtZero: true,
                //             fontFamily: 'Poppins',
                //             fontSize: 15
                //         }
                //     }],
                // }

            }
        });

        // console.log(arrayTodosLosTemarios2);
        // console.log(arrayTodosLosTemarios);
        // console.log(arrayTodosLosResultadosCumplimiento);
        // console.log(arrayTodosLosResultadosIncumplimiento);

        var domChartRadar = document.getElementById('chart-radar').getContext('2d');
        var charRadarModulos = new Chart(domChartRadar, {
            type: 'radar',
            data: {
                labels: arrayOrdenTemario,
                datasets: [{
                    data: arrayTodosLosResultadosCumplimiento,
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

                layout: {
                 
                },
                labels: {
                    fontFamily: 'Poppins',
                    fontStyle: '600',
                },
                datalabels: { 
                    fontSize: 30
                },

                animation: {
                    // onComplete: function(){
                    //     var url = myChartBarra.toBase64Image(); //get image as base64
                    //     document.getElementById("barChartBase64").value = url; //to fill image in html
                    // },
                    animateScale: !0,
                    animateRotate: !0
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


        for (let i = 0; i < tamañoArrayTemarios; i++) {
            let htmlGraficosDetallados = `
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="h3 mb-4">Módulo ${i+1}. </b>${arrayTemarios[i]['nombreTemario']}</h3>
                </div>
                <div class="col-12 col-md-6">

                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="#!" class="avatar bg-secondary rounded-circle">
                      
                            <i class="far fa-check-circle text-success text-lg"></i>
                            </a>
                        </div>
                        <div class="col">
                            <h4>Cumplimiento <span class="text-success">${arrayTemarios[i]['resultadoModuloCumplimiento']}%</span></h4>
                            <span class="text-sm"><span class="font-weight-600">${arrayTemarios[i]['respuestasSiCumple']}</span> preguntas fueron contestadas como SI CUMPLE de <span class="font-weight-600">${arrayTemarios[i]['respuestasSiAplica']}</span> preguntas aplicables en total.</span>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-md-6">

                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="#!" class="avatar bg-secondary rounded-circle">
                            <i class="far fa-times-circle text-danger text-lg"></i>
                            </a>
                        </div>
                        <div class="col">
                            <h4>Incumplimiento <span class="text-danger">${arrayTemarios[i]['resultadoModuloIncumplimiento']}%</span></h4>
                            <span class="text-sm"><span class="font-weight-600">${arrayTemarios[i]['respuestasNoCumple']}</span> preguntas fueron contestadas como NO CUMPLE de <span class="font-weight-600">${arrayTemarios[i]['respuestasSiAplica']}</span> preguntas aplicables en total.</span>
                        </div>
                    </div>
            
                </div>
                
            </div>

            <hr>

           
            `;
            $('.guiaGraficosDetallados').append(htmlGraficosDetallados);
        }

    });
    requestGraficos.fail(function (jqXHR, textStatus) {});


    // Obtener informacion general
    var requestHallazgos = $.ajax({
        url: "models/diagnostico/resultadosObtenerHallazgos.php",
        method: "POST",
        data: datosParaObtenerLosResultados,
        contentType: false,
        processData: false,
        dataType: 'json',

        beforeSend: function (xhr) {}
    });
    requestHallazgos.done(function (response) {

        var arrayTemarios = response['temarios'];

        console.log(response);

        for (var i = 0; i < arrayTemarios.length; i++) {

            var conteo = i + 1;
            var conteoHallazgos = 0;
            var idTemario = arrayTemarios[i]['idTemario'];
            let legthTemario = 0;
            let templateHallazgosEncontrados = "";

            // console.log(arrayTemarios[i]['hallazgos']);

            if(arrayTemarios[i]['hallazgos'] != undefined){
                legthTemario = arrayTemarios[i]['hallazgos'].length;
                templateHallazgosEncontrados = `
                    <span class=" text-danger">Hallazgos encontrados: ${legthTemario}</span>
                `;
            }else{
                legthTemario = 0;
                templateHallazgosEncontrados = `
                <span class=" text-success">Hallazgos encontrados: ${legthTemario}</span>
            `;
            }

            var htmlModuloHallazgos = `
                <div id="moduloHallazgos${idTemario}" class="d-block-inline mb-6">
                    <h3 class="mb-4">Módulo ${conteo}. ${arrayTemarios[i]['nombreTemario']} - ${templateHallazgosEncontrados}</h3>
                </div>
              
               
            `;

            $('.contentHallazgos').append(htmlModuloHallazgos);

            // var idTemarioHallazgos = arrayTemariosHallazgos[i]['idTemario'];         
            // Se recorren las preguntas
            var hallazgosIterados = arrayTemarios[i]['hallazgos'];
            // console.log(hallazgosIterados);
            if (hallazgosIterados) {
                for (var h = 0; h < arrayTemarios[i]['hallazgos'].length; h++) {

                    var conteoHallazgos = h + 1;
                    // conteoHallazgos = i+1;

                    var htmlHallazgos1 = `
    
                    <div class="row ml-md-3">
                        <div class="col-12 mb-3">
                            <h4 class="mb-0">
                                <a href="#!" class="preguntaHallazgoPopover" data-content=""><i class="fas fa-exclamation-triangle text-danger"></i> Pregunta ${arrayTemarios[i]['hallazgos'][h]['idOrdenPregunta']}.  </a>
                            </h4>
                        </div>

                        <div class="col-12 mb-3">
                            <h4 class="mb-0">Hallazgo: </h4>
                            <span class="text-sm mb-0">${arrayTemarios[i]['hallazgos'][h]['conceptoNegativo']}</span>
                        </div>

                        <div class="col-12 mb-3">
                            <h4 class="mb-0">Evidencias u observaciones</h4>
                            <span class="text-sm mb-0">${arrayTemarios[i]['hallazgos'][h]['observacion']}</span>                                   	                                	               
                        </div>

                        <div class="col-12">
                            <h4 class="mb-1">Imagenes</h4>
                           
                            <div id="container-images-${arrayTemarios[i]['hallazgos'][h]['idPregunta']}" class="grid-container">
                                  
                            </div>
                           
                                                        	                                	               
                        </div>
                    </div>

                    <hr class="my-4">
                    `;

                    // var htmlHallazgos = `
    
                    // <div" class="kt-timeline-v2">
                    //     <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                    //         <div" class="kt-timeline-v2__item">
    
                    //             <a href="#!" class="kt-timeline-v2__item-time preguntaHallazgoPopover" data-content="">${arrayTemarios[i]['hallazgos'][h]['idOrdenPregunta']}. </a>
                    //             <div class="kt-timeline-v2__item-cricle">
                    //                 <i class="fa fa-genderless text-danger"></i>
                    //             </div>

                    //             <div class="kt-timeline-v2__item-text w-50 kt-padding-top-5">
                    //                 <h4 class="title-timeline-kt">Hallazgo:</h4>
                    //                 ${arrayTemarios[i]['hallazgos'][h]['conceptoNegativo']}                                          	                                	               
                    //             </div>
    
                    //             <div class="kt-timeline-v2__item-text w-50 kt-padding-top-5">
                    //                 <h4 class="title-timeline-kt">Observación:</h4>
                    //                 ${arrayTemarios[i]['hallazgos'][h]['observacion']}                                        	                                	               
                    //             </div>
                            
                    //         </div>
          
                    //     </div>
                    // </div>

                    // `;

                    $('#moduloHallazgos'+idTemario).append(htmlHallazgos1);
                    // $('#moduloHallazgos' + idTemario).append(htmlHallazgos);

                    let countImagesPreguntas = 0;
                    let isImages = false;

                    if(arrayTemarios[i]['hallazgos'][h]['imagenes'] != null){
                        countImagesPreguntas = arrayTemarios[i]['hallazgos'][h]['imagenes'].length;
                        isImages = true;
                    }
                  
                    if(isImages){
                       

                        for (let x = 0; x < countImagesPreguntas; x++) {
                            let htmlImagen = `
                            <img class="item-image border rounded" src="assets/img/images-de-evidencias/${arrayTemarios[i]['hallazgos'][h]['imagenes'][x]['url']}"></img> 
                            `;
                           
                            $('#container-images-'+arrayTemarios[i]['hallazgos'][h]['idPregunta']).append(htmlImagen);
                        }
                    }
                    

                    var dataContentPopover = `
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-0">${arrayTemarios[i]['hallazgos'][h]['pregunta']}</p>
                        </div>
                    </div>`;

                    $('.preguntaHallazgoPopover').popover({
                        html: true,
                        title: `${arrayTemarios[i]['hallazgos'][h]['idOrdenPregunta']}. pregunta | ${conteo}. Modulo`,
                        content: dataContentPopover,
                        placement: 'left',
                        trigger: 'focus',
                    })

                }
            } else {
                var htmlHallazgos = `
    
                <div class="kt-timeline-v2">
                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                        <div class="kt-timeline-v2__item">

                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless text-success"></i>
                            </div>
                    
                            <div class="kt-timeline-v2__item-text w-50 kt-padding-top-5">
                                <h4 class="title-timeline-kt">Sin hallazgos</h4>
                                El nivel de cumplimiento de este modulo es satisfactorio.                                         	                                	               
                            </div>

                            <div class="kt-timeline-v2__item-text w-50 kt-padding-top-5">
                                     	                                	               
                            </div>
                        
                        </div>
      
                    </div>
                </div>
                `;
                $('#moduloHallazgos' + idTemario).append(htmlHallazgos);
            }

        }



    });
    requestHallazgos.fail(function (jqXHR, textStatus) {});

}


function listarRecomendaciones() {

    let idDiagnostico = getParameter('idDiagnostico');

    $.ajax({

        url: "models/diagnostico/resultadosRecomendaciones.php?op=listarRecomendaciones",
        type: "GET",
        data: "idDiagnostico=" + idDiagnostico,
        contentType: false,
        processData: false,
        dataType: "json",

        success: function (data) {

            if (data.data.length > 0) {
                for (var i = 0; i < data.data.length; i++) {

                    if (data.session == data.data[i]['idUsuarioCreador']) {
                        var nombreCreador = data.data[i]['nombreCreadorRecomendacion'] + " (Tu)";
                    } else {
                        var nombreCreador = data.data[i]['nombreCreadorRecomendacion'];
                    }

                    let campoHTML = `
                    <div class="dropdown animated"  id="recomendacion` + data.data[i]['idRecomendacion'] + `">
    
                        <a href="#!" class="list-group-item border list-group-item-action flex-column dropdown${data.data[i]['idRecomendacion']} align-items-start py-4 px-4" data-toggle="dropdown" aria-haspopup="true" data-offset="200,-100" aria-expanded="false">
                            <div class="d-flex w-100 justify-content-between">
                                <div>
                                    <div class="d-flex w-100 align-items-center">
                                        <img src="${data.data[i]['avatar']}" alt="Image placeholder" class="avatar avatar-xs mr-2">
                                        <h4 class="mb-1">${nombreCreador}</h4>
                                    </div>
                                </div>
                                <small>` + data.data[i]['fechaCreacionRecomendacion'] + `</small>
                            </div>
                            <input type="hidden" value="` + data.data[i]['idRecomendacion'] + `">
                            <h5 class="mt-3 mb-1" id="labelAsunto${data.data[i]['idRecomendacion']}">` + data.data[i]['asunto'] + `</h5>
                            <p class="text-sm mb-0" id="labelDescripcion${data.data[i]['idRecomendacion']}">` + data.data[i]['recomendacion'] + `</p>
                        </a>
    
                        <div class="dropdown-menu animated fadeIn faster" aria-labelledby="dropdownMenuLink">
                            <h6 class="dropdown-header" style="color: rgba(0,0,0,.72) !important;">Opciones</h6>
                            <a class="dropdown-item" href="#!" onclick="editarRecomendacion(${data.data[i]['idRecomendacion']});"><i class="far fa-edit"></i> Editar</a>
                            <a class="dropdown-item" href="#!" onclick="eliminarRecomendacion(` + data.data[i]['idRecomendacion'] + `);"><i class="far fa-trash-alt pr-1"></i> Eliminar</a>
                        </div>
    
                    </div>              
                    
                    `;

                    $('.contentRecomendaciones').prepend(campoHTML); // agregamos el campo

                }
            }

        }

    });

}

// Enviar form de una nueva observacion
$("#formRecomendacion").submit(function (e) {
    e.preventDefault();

    var idDiagnosticoRecomendacion = getParameter('idDiagnostico');
    let form = $('#formRecomendacion');
    let btn = $('#btnEnviarRecomendacion');

    let recomendacionData = new FormData($(form)[0]);
    recomendacionData.append('idDiagnosticoRecomendacion', idDiagnosticoRecomendacion);;

    form.validate({
        rules: {
            asuntoRecomendacion: {
                required: true
            },
            textRecomendacion: {
                required: true
            },
        },
        messages: {
            asuntoRecomendacion: 'Este campo es obligatorio.',
            textRecomendacion: 'Este campo es obligatorio.',
        }
    });

    if (form.valid()) {
        $.ajax({
            url: "models/diagnostico/resultadosRecomendaciones.php?op=insertarRecomendacion",
            type: "POST",
            data: recomendacionData,
            contentType: false,
            processData: false,
            dataType: "json",

            beforeSend: function () {
                btn.html('<i class="fas fa-spinner fa-spin"></i> Enviando').addClass("disabledButton");
            },

            success: function (data) {

                btn.html('Enviar').removeClass("disabledButton");

                if (data.status = "recomendacionInsertada") {

                    listarUltimaRecomendacion();

                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: 'success',
                        title: '¡Recomendación añadida con exito!',
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                }
            }
        });
    }

});

function listarUltimaRecomendacion() {

    let idDiagnostico = getParameter('idDiagnostico');

    $.ajax({

        url: "models/diagnostico/resultadosRecomendaciones.php?op=listarUltimaRecomendacion",
        type: "GET",
        data: "idDiagnostico=" + idDiagnostico,
        contentType: false,
        processData: false,
        dataType: "json",

        beforeSend: function () {

            $('#areaRecomendacion').collapse('toggle');
            $("#asuntoRecomendacion").val("");
            $('#summernote').val('');

        },

        success: function (data) {

            if (data.idUsuarioSESSION == data.idUsuario) {
                var nombreCreador = data.nombreUsuario + " (Tu)";
            } else {
                var nombreCreador = data.nombreUsuario;
            }

            let campoHTML = `

            <div class="dropdown animated fadeInDown" id="recomendacion${data.idRecomendacion}">

                <a href="#!" class="list-group-item border list-group-item-action flex-column align-items-start py-md-4 px-md-4" data-toggle="dropdown" aria-haspopup="true" data-offset="200,-100" aria-expanded="false">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <div class="d-flex w-100 align-items-center">
                                <img src="${data.avatar}" alt="Image placeholder" class="avatar avatar-xs mr-2">
                                <h4 class="mb-1">${nombreCreador}</h4>
                                  
                            </div>
                        </div>
                        <small>${data.fechaCreacionRecomendacion}</small>
                    </div>
                    <input type="hidden" value="${data.idRecomendacion}">
                    <h5 class="mt-3 mb-1" id="labelAsunto${data.idRecomendacion}">${data.asunto}</h5>
                    <p class="text-sm mb-0" id="labelDescripcion${data.idRecomendacion}">${data.recomendacion}</p>
                </a>

                <div class="dropdown-menu animated fadeIn faster" aria-labelledby="dropdownMenuLink">
                    <h6 class="dropdown-header" style="color: rgba(0,0,0,.72) !important;">Opciones</h6>
                    <a class="dropdown-item" href="#!" onclick="editarRecomendacion(${data.idRecomendacion});"><i class="far fa-edit"></i> Editar</a>
                    <a class="dropdown-item" href="#!" onclick="eliminarRecomendacion(${data.idRecomendacion});"><i class="far fa-trash-alt pr-1"></i> Eliminar</a>
                </div>

            </div>                
            `;

            $('.contentRecomendaciones').prepend(campoHTML); // agregamos el campo

            setTimeout(() => {
                $('#recomendacion' + data.idRecomendacion).removeClass('fadeInDown');
            }, 1000);

        }
    });

}

function editarRecomendacion(idRecomendacion = null, ) {

    let modalEditarRecomendacion = $('#modalEditarRecomendacion');

    modalEditarRecomendacion.modal('show');

    let inputAsuntoRecomendacion = $('#nuevoAsuntoRecomendacion');
    let inputDescripcionRecomendacion = $('#nuevaDescripcionRecomendacion');

    let labelAsuntoRecomendacion = $('#labelAsunto' + idRecomendacion);
    let labelDescripcionRecomendacion = $('#labelDescripcion' + idRecomendacion);

    $.ajax({
        url: "models/diagnostico/resultadosRecomendaciones.php?op=obtenerDescripcion",
        type: "POST",
        data: {
            'idRecomendacion': idRecomendacion
        },
        cache: false,
        dataType: "json",

        beforeSend: function () {

        },

        success: function (data) {

            $(inputAsuntoRecomendacion).val(labelAsuntoRecomendacion.html());
            $(inputDescripcionRecomendacion).val(data.descripcion);

        },

        error: function () {
            alert('error al encontrar la descripcion de la recomendacion, por favor contactar a soporte!')
        }

    })

    $('#formEditarRecomendacion').on('submit', function (event) {

        event.preventDefault();

        let btn = $('#btnGuardarCambiosRecomendacion');
        let form = $('#formEditarRecomendacion');

        let dataEditarRecomendacion = new FormData($(form)[0]);
        dataEditarRecomendacion.append('idRecomendacion', idRecomendacion);

        $.ajax({
            url: "models/diagnostico/resultadosRecomendaciones.php?op=editarRecomendacion",
            type: "POST",
            data: dataEditarRecomendacion,
            contentType: false,
            processData: false,
            dataType: "json",

            beforeSend: function () {
                btn.html('<i class="fas fa-circle-notch fa-spin"></i>');
            },

            success: function (data) {

                btn.html('<i class="fas fa-check"></i>');

                if (data.status == "success") {

                    $(labelAsuntoRecomendacion).html(data.asunto);
                    $(labelDescripcionRecomendacion).html(nl2br(data.descripcion));
                    $('#recomendacion' + idRecomendacion).addClass('flash');

                    setTimeout(() => {
                        $('#recomendacion' + idRecomendacion).removeClass('flash');
                    }, 1000);

                    modalEditarRecomendacion.modal('hide');

                    setTimeout(() => {
                        btn.html('Guardar cambios');
                    }, 200);



                } else {

                    alert('Error al cambiar el nombre, comunicar a soporte!');

                }


                $('#formEditarRecomendacion').off('submit');


            },

        });

    });


}

function eliminarRecomendacion(idRecomendacion) {

    let dataRecomendacion = new FormData();
    dataRecomendacion.append("idRecomendacion", idRecomendacion);

    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podras revertir esto.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '¡Si, borrar!',
        cancelButtonText: 'No, cancelar',
        buttonsStyling: false,
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-neutral',
        }
    }).then((result) => {
        if (result.value) {

            $.ajax({

                url: "models/diagnostico/resultadosRecomendaciones.php?op=eliminarRecomendacion",
                type: "POST",
                data: dataRecomendacion,
                contentType: false,
                processData: false,
                dataType: "json",

                beforeSend: function () {

                },

                success: function (data) {

                    if (data.status == "recomendacionEliminada") {

                        $("#recomendacion" + idRecomendacion).remove();
                        // $("#recomendacion"+idRecomendacion).addClass('zoomOut');

                        // setTimeout(() => {
                        //     $("#recomendacion"+idRecomendacion).remove();
                        // }, 600);

                        // contarNumRecomendaciones();

                    } else {

                        alert(data.msj);

                    }

                }

            });

        }
    });

}



$(function () {
    obtenerResultadosDiagnostico();
    listarRecomendaciones();
});