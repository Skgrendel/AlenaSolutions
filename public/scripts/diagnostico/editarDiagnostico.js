var obtenerDiagnosticoParaEditar = function () {
  var idDiagnostico = getParameter("idDiagnostico");
  var idGrupoDiagnostico = getParameter("idGrupoDiagnostico");

  // Funcion para obtener todos los datos del diagnostico a editar
  let request = $.ajax({
    url: "models/diagnostico/obtenerDiagnosticoParaEditar.php",
    method: "POST",
    data: {
      idDiagnostico: idDiagnostico,
      idGrupoDiagnostico: idGrupoDiagnostico,
    },
    // contentType: false,
    // processData: false,
    dataType: "json",

    beforeSend: function (xhr) {},
  });

  request.done(function (response) {
    // console.log(response);

    // Array con todos los modulos
    var arrayTemarios = response[0]["temario"];
    // Array con todas las preguntas
    var arrayPreguntas = response[1]["pregunta"];
    // Array con otra información del diagnostico
    var arrayDataDiagnostico = response[2];
    // Con statuscompletado nos damos cuenta si se completo el diagnostico
    let statusCompletado = arrayDataDiagnostico["statusCompletado"];
    // Con numeroetapa nos damos cuenta por cual modulo quedo el diagnostico
    var numeroEtapaModulo = arrayDataDiagnostico["numeroEtapa"];

    $("#labelNombreDiagnostico").html(
      arrayDataDiagnostico["nombreDiagnostico"]
    );
    var descripcionDiagnostico = arrayDataDiagnostico["descripcionDiagnostico"];

    // Descripción completa
    descripcionCompleta = descripcionDiagnostico;
    if (descripcionDiagnostico.length > 100) {
      descripcionDiagnostico =
        descripcionDiagnostico.substr(0, 100) + " . . . ";
    }

    // Añadimos la descripcion al html
    $("#labelDescripcionDiagnostico").html(descripcionDiagnostico);
    $("#labelDescripcionDiagnostico").popover({
      title: "Objetivo del diagnostico",
      content: nl2br(descripcionCompleta),
      placement: "bottom",
      html: true,
      trigger: "hover",
    });

    // Numero de modulos y preguntas
    var numeroDeTemarios = arrayTemarios.length;
    var numeroDePreguntas = arrayPreguntas.length;

    // Uso de la api de madiadevides
    // if(navigator.mediaDevices.getUserMedia){
    //     navigator.mediaDevices.getUserMedia({video: true}).then( (stream) => {
    //         console.log(stream);

    //     }).catch( (error) => {
    //         console.log('Ha ocurrido un error. ' + error);

    //     });
    // }

    // Iteramos por cada uno de los modulos para construir toda la prueba
    for (let i = 0; i < numeroDeTemarios; i++) {
      var conteo = i + 1;

      // Html de los modulos del smartwizard
      var htmlEtapa = `
                        <li class="nav-item font-weight-500 border py-3 mx-0">
                            <a class="nav-link" href="#modulo${conteo}">
                                Módulo ${conteo}
                            </a>
                        </li>    
                    `;
      $(".contenedor-etapas").append(htmlEtapa);
      // Html del titulo de cada modulo
      var htmlModuloEtapa = `
                <div id="modulo${conteo}">
                    <div class="col text-center py-4">
                        <h2 style="color: #525f7f;" class="mb-1">${arrayTemarios[i]["nombreTemario"]}</h2>
                        <p class="text-uppercase text-muted font-weight-500">Módulo ${conteo}</p>
                    </div>
                </div>
                `;
      $(".contenedor-preguntas").append(htmlModuloEtapa);

      // Id de cada modulo (este dato esta en la base de datos)
      var idTemario = arrayTemarios[i]["idTemario"];
      //localstorage de checkbokx
      if (
        localStorage.getItem("DataCheckbox") !== undefined &&
        localStorage.getItem("DataCheckbox")
      ) {
        DataCheckbox = JSON.parse(localStorage.getItem("DataCheckbox")) || {};
      }
      //localstorage de observaciones
      if (
        localStorage.getItem("DataTextarea") !== undefined &&
        localStorage.getItem("DataTextarea")
      ) {
        DataTextarea = JSON.parse(localStorage.getItem("DataTextarea")) || {};
      }
      //localstorage de aplica
      if (
        localStorage.getItem("DataAplica") !== undefined &&
        localStorage.getItem("DataAplica")
      ) {
        DataAplica = JSON.parse(localStorage.getItem("DataAplica")) || {};
      }
      //localstorage de imagenes
      if (
        localStorage.getItem("DataImagen") !== undefined &&
        localStorage.getItem("DataImagen")
      ) {
        DataImagen = JSON.parse(localStorage.getItem("DataImagen")) || {};
      }
      const getLengthOfObject = (obj) => {
        let lengthOfObject = Object.keys(obj).length;
        return lengthOfObject;
      };

      // Iteramos por cada una de las preguntas
      for (let i = 0; i < numeroDePreguntas; i++) {
        var conteoPreguntas = i + 1;

        // Verificamos si el idtemario de la pregunta es igual al temario que se esta iterando en el momento
        if (arrayPreguntas[i]["idTemarioPreguntas"] == idTemario) {
          var idUnicoInput = generarID();

          //validar si existe en localstorage y mostrar en ves de la api
          console.log(typeof DataCheckbox);
          if (
            typeof DataCheckbox !== "undefined" &&
            typeof DataCheckbox[arrayPreguntas[i]["idInputRespuesta"]] !==
              "undefined"
          ) {
            if (
              DataCheckbox[arrayPreguntas[i]["idInputRespuesta"]][
                "respuestaCheckbox"
              ] == "No cumple"
            ) {
              htmlCheckRespuesta = `
                            <label class="custom-toggle">
                                <input type="checkbox" class="checkRespuesta" data-pregunta="${arrayPreguntas[i]["idPregunta"]}" id="${arrayPreguntas[i]["idInputRespuesta"]}" name="respuesta${conteoPreguntas}" value="cumple">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No cumple" data-label-on="Si cumple"></span>
                            </label>`;
            } else {
              htmlCheckRespuesta = `
                            <label class="custom-toggle">
                                <input type="checkbox" class="checkRespuesta" data-pregunta="${arrayPreguntas[i]["idPregunta"]}" id="${arrayPreguntas[i]["idInputRespuesta"]}" name="respuesta${conteoPreguntas}" value="cumple" checked="">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No cumple" data-label-on="Si cumple"></span>
                            </label>`;
            }
          } else {
            if (arrayPreguntas[i]["respuesta"] == "No cumple") {
              htmlCheckRespuesta = `
                            <label class="custom-toggle">
                                <input type="checkbox" class="checkRespuesta" data-pregunta="${arrayPreguntas[i]["idPregunta"]}" id="${arrayPreguntas[i]["idInputRespuesta"]}" name="respuesta${conteoPreguntas}" value="cumple">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No cumple" data-label-on="Si cumple"></span>
                            </label>`;
            } else {
              htmlCheckRespuesta = `
                            <label class="custom-toggle">
                                <input type="checkbox" class="checkRespuesta" data-pregunta="${arrayPreguntas[i]["idPregunta"]}" id="${arrayPreguntas[i]["idInputRespuesta"]}" name="respuesta${conteoPreguntas}" value="cumple" checked="">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No cumple" data-label-on="Si cumple"></span>
                            </label>`;
            }
          }
          //validar si existe en localstorage y mostrar en vez de la api
          if (
            typeof DataTextarea !== "undefined" &&
            typeof DataTextarea[arrayPreguntas[i]["idInputRespuesta"]] !==
              "undefined"
          ) {
            var observaciones =
              DataTextarea[arrayPreguntas[i]["idInputRespuesta"]][
                "observacion"
              ];
          } else {
            var observaciones = arrayPreguntas[i]["observacion"];
          }

          // Verificar si la pregunta esta habilitada o deshabilitada
          var classQuestion = "";
          if (arrayPreguntas[i]["enabled"] == 0) {
            classQuestion = "opacity-6-disabled";
          }

          var htmlModuloPreguntas = `
                        <div class="col-md-12 mb-3 px-2 px-md-4 ${classQuestion}" id="contenedorPregunta${arrayPreguntas[i]["idPregunta"]}">
                            <div class="card border card-body px-3 px-md-4 shadow-none bg-cuadro" id="cardPregunta${arrayPreguntas[i]["idPregunta"]}">
                                <div class="form-group fade show my-3 mb-0">
                                    <div class="pregunta">
                                        <span class="text-primary opacity-8 display-4 d-inline txtNumeros">${conteoPreguntas}. </span>
                                        <label for="" class="d-inline txtPreguntas">
                                            ${arrayPreguntas[i]["textoPregunta"]}
                                        </label>
                                    </div>
                                
                                    <div class="opcion-respuesta py-3">
                                        ${htmlCheckRespuesta}
                                    </div>

                                    <div class="campo-observaciones input-group input-group-alternative shadow-none border">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <textarea id="observacion${idUnicoInput}" data-id-checkbox="${arrayPreguntas[i]["idInputRespuesta"]}" name="observacionRespuesta${conteoPreguntas}" class="form-control form-control-alternative inputTextRespuesta" rows="1" placeholder="Observaciones o evidencias">${observaciones}</textarea>         
                                    </div>

                                    <div class="section-files-${arrayPreguntas[i]["idPregunta"]}">
                                        
                                    </div>

                                </div>

                                <div class="grupo-botones-pregunta">
                                    <ul class="nav" id="contenedorGrupoBotonesPregunta${arrayPreguntas[i]["idPregunta"]}">                          
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;

          $("#modulo" + conteo).append(htmlModuloPreguntas);

          // Insertar en el html el input files para subir evidencias de respuesta
          let htmlbtnUpFiles = `
                    <li class="nav-item">
                        <label class="input-file-pregunta icon icon-sm icon-shape" data-toggle="tooltip" title="Cargar imagenes">
                            <input type="file" class="inputResponseFiles custom-file-input" data-id-inputrespuesta="${arrayPreguntas[i]["idInputRespuesta"]}" id="inputResponseFiles${idUnicoInput}" name="responseFiles${conteoPreguntas}[]" aria-describedby="inputResponseFiles${idUnicoInput}" accept="image/*" multiple="true">
                            <i class="fas fa-upload"></i>
                        </label>
                    </li>
                    `;
          $(
            "#contenedorGrupoBotonesPregunta" + arrayPreguntas[i]["idPregunta"]
          ).append(htmlbtnUpFiles);

          // Insertar en el html el input files para subir evidencias de respuesta (Antiguo)
          // let htmlModuleUpFiles = `
          //     <div class="input-group col-12 col-md-6 mt-4 px-0">
          //         <div class="custom-file">
          //             <input type="file" class="inputResponseFiles custom-file-input" data-id-inputrespuesta="${arrayPreguntas[i]['idInputRespuesta']}" id="inputResponseFiles${idUnicoInput}" name="responseFiles${conteoPreguntas}[]" aria-describedby="inputResponseFiles${idUnicoInput}" accept="image/*" multiple="true">
          //             <label class="custom-file-label" data-browse="Buscar" for="files${idUnicoInput}">Subir evidencias</label>
          //         </div>
          //     </div>
          // `;
          // $('.section-files-'+arrayPreguntas[i]['idPregunta']).append(htmlModuleUpFiles);

          //validar si existe en el localstorage para mostrar en vez de la api
          if (
            typeof DataImagen !== "undefined" &&
            typeof DataImagen[arrayPreguntas[i]["idInputRespuesta"]] !==
              "undefined"
          ) {
            // Insertar cada imagen
            countImagesPreguntas = getLengthOfObject(
              DataImagen[arrayPreguntas[i]["idInputRespuesta"]]["files"]
            );
            isImages = true;

            if (isImages == true) {
              // Insertar en el html un div colapsado para ver los files
              let htmlModuleViewFiles = `
                                <div class="images-ups mt-3" id="divImages-${arrayPreguntas[i]["idInputRespuesta"]}">
                                    <a class="btn btn-sm btn-primary btn-collapse-files" data-toggle="collapse" href="#collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}" role="button" aria-expanded="false" aria-controls="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                        Archivos <span class="badge badge-light font-weight-600" id="countFiles-${arrayPreguntas[i]["idInputRespuesta"]}"> ${countImagesPreguntas} </span>
                                    </a>
    
                                    <div class="collapse mt-2" id="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                        <div class="card card-body shadow-none border">
                                            <div class="grid-container sectionFiles-${arrayPreguntas[i]["idInputRespuesta"]}">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
              $(".section-files-" + arrayPreguntas[i]["idPregunta"]).append(
                htmlModuleViewFiles
              );

              for (ImgItem in DataImagen[arrayPreguntas[i]["idInputRespuesta"]][
                "files"
              ]) {
                let htmlImagen = `
                                    <div class="text-center">
                                        <img class="item-image border rounded" src="${
                                          DataImagen[
                                            arrayPreguntas[i][
                                              "idInputRespuesta"
                                            ]
                                          ]["files"][ImgItem]
                                        }"></img>
                                        <button data-id-imagen="${ImgItem}" data-inputrespuesta="${
                  arrayPreguntas[i]["idInputRespuesta"]
                }" data-url-imagen="${
                  DataImagen[arrayPreguntas[i]["idInputRespuesta"]]["files"][
                    ImgItem
                  ]
                }" class="mt-3 btn btn-sm btn-outline-danger text-center btn-delete-image-response">Eliminar</button>
                                    </div>
                                
                                `;
                $(
                  ".sectionFiles-" + arrayPreguntas[i]["idInputRespuesta"]
                ).append(htmlImagen);
              }

              // for (let x = 0; x < countImagesPreguntas; x++) {
              //     let htmlImagen = `
              //         <div class="text-center">
              //             <img class="item-image border rounded" src="assets/img/images-de-evidencias/${arrayPreguntas[i]["imagenes"][x]["url"]}"></img>
              //             <button data-id-imagen="${arrayPreguntas[i]["imagenes"][x]["id"]}" data-inputrespuesta="${arrayPreguntas[i]["idInputRespuesta"]}" data-url-imagen="${arrayPreguntas[i]["imagenes"][x]["url"]}" class="mt-3 btn btn-sm btn-outline-danger text-center btn-delete-image-response">Eliminar</button>
              //         </div>

              //     `;
              //     $(
              //         ".sectionFiles-" + arrayPreguntas[i]["idInputRespuesta"]
              //     ).append(htmlImagen);
              // }
            } else {
              // Insertar en el html un div colapsado para ver los files
              let htmlModuleViewFiles = `
                            <div class="images-ups mt-3 d-none" id="divImages-${arrayPreguntas[i]["idInputRespuesta"]}">
                                <a class="btn btn-sm btn-primary btn-collapse-files" data-toggle="collapse" href="#collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}" role="button" aria-expanded="false" aria-controls="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                    Archivos <span class="badge badge-light font-weight-600" id="countFiles-${arrayPreguntas[i]["idInputRespuesta"]}"> ${countImagesPreguntas} </span>
                                </a>
    
                                <div class="collapse mt-2" id="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                    <div class="card card-body shadow-none border">
                                        <div class="grid-container sectionFiles-${arrayPreguntas[i]["idInputRespuesta"]}">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
              $(".section-files-" + arrayPreguntas[i]["idPregunta"]).append(
                htmlModuleViewFiles
              );
            }
          } else {
            let countImagesPreguntas = 0;
            let isImages = false;

            if (arrayPreguntas[i]["imagenes"] != null) {
              // Insertar cada imagen
              countImagesPreguntas = arrayPreguntas[i]["imagenes"].length;
              isImages = true;
            }

            if (isImages == true) {
              // Insertar en el html un div colapsado para ver los files
              let htmlModuleViewFiles = `
                                <div class="images-ups mt-3" id="divImages-${arrayPreguntas[i]["idInputRespuesta"]}">
                                    <a class="btn btn-sm btn-primary btn-collapse-files" data-toggle="collapse" href="#collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}" role="button" aria-expanded="false" aria-controls="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                        Archivos <span class="badge badge-light font-weight-600" id="countFiles-${arrayPreguntas[i]["idInputRespuesta"]}"> ${countImagesPreguntas} </span>
                                    </a>
    
                                    <div class="collapse mt-2" id="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                        <div class="card card-body shadow-none border">
                                            <div class="grid-container sectionFiles-${arrayPreguntas[i]["idInputRespuesta"]}">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
              $(".section-files-" + arrayPreguntas[i]["idPregunta"]).append(
                htmlModuleViewFiles
              );

              for (let x = 0; x < countImagesPreguntas; x++) {
                let htmlImagen = `
                                    <div class="text-center">
                                        <img class="item-image border rounded" src="assets/img/images-de-evidencias/${arrayPreguntas[i]["imagenes"][x]["url"]}"></img>
                                        <button data-id-imagen="${arrayPreguntas[i]["imagenes"][x]["id"]}" data-inputrespuesta="${arrayPreguntas[i]["idInputRespuesta"]}" data-url-imagen="${arrayPreguntas[i]["imagenes"][x]["url"]}" class="mt-3 btn btn-sm btn-outline-danger text-center btn-delete-image-response">Eliminar</button>
                                    </div>
                                
                                `;
                $(
                  ".sectionFiles-" + arrayPreguntas[i]["idInputRespuesta"]
                ).append(htmlImagen);
              }
            } else {
              // Insertar en el html un div colapsado para ver los files
              let htmlModuleViewFiles = `
                            <div class="images-ups mt-3 d-none" id="divImages-${arrayPreguntas[i]["idInputRespuesta"]}">
                                <a class="btn btn-sm btn-primary btn-collapse-files" data-toggle="collapse" href="#collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}" role="button" aria-expanded="false" aria-controls="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                    Archivos <span class="badge badge-light font-weight-600" id="countFiles-${arrayPreguntas[i]["idInputRespuesta"]}"> ${countImagesPreguntas} </span>
                                </a>
    
                                <div class="collapse mt-2" id="collapseSectionFiles${arrayPreguntas[i]["idPregunta"]}">
                                    <div class="card card-body shadow-none border">
                                        <div class="grid-container sectionFiles-${arrayPreguntas[i]["idInputRespuesta"]}">
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
              $(".section-files-" + arrayPreguntas[i]["idPregunta"]).append(
                htmlModuleViewFiles
              );
            }
          }

          // Insertar en el html las preguntas de ayuda de las preguntas
          if (arrayPreguntas[i]["statusPreguntaAyuda"] == 1) {
            var htmlModuleQuestionsHelp = `
                            <li class="nav-item fade-show item-ayuda">
                                <a href="#!" onclick="obtenerPreguntasAyuda(${arrayPreguntas[i]["idPregunta"]}, ${conteoPreguntas});" class="boton-pregunta-ayuda nav-link icon icon-sm icon-shape">
                                    <i class="fas fa-book"></i>
                                </a>
                            </li>   
                        `;
            $(
              "#contenedorGrupoBotonesPregunta" +
                arrayPreguntas[i]["idPregunta"]
            ).append(htmlModuleQuestionsHelp);
          }

          // Insertar en el html las anotaciones de las preguntas
          var anotacionPregunta = arrayPreguntas[i]["anotacionPregunta"];
          // console.log(arrayPreguntas);
          // console.log(typeof anotacionPregunta);
          if (anotacionPregunta == null || anotacionPregunta == "") {
          } else {
            var htmlModuloAnotacion = `
                            <li class="nav-item fade show item-ayuda">
                                <a href="#!" data-toggle="popover" data-title="Anotaciones <i class='fas fa-angle-right'></i> <span class='text-primary'>${conteoPreguntas}. Pregunta</span>" data-content="<i></i>${arrayPreguntas[i]["anotacionPregunta"]}<i></i>" class="boton-pregunta-anotacion icon icon-sm icon-shape">
                                    <i class="fas fa-info"></i>
                                </a>
                            </li>
                        `;
            $(
              "#contenedorGrupoBotonesPregunta" +
                arrayPreguntas[i]["idPregunta"]
            ).append(htmlModuloAnotacion);
          }

          // Insertar en el html los checkboxs de si aplica o no aplica
          var htmlModuloAplica = `
                    <li class="nav-item">
                        <label class="check-pregunta-aplica icon icon-sm icon-shape" data-toggle="tooltip" title="Si aplica">
                            <input class="checkAplica" type="checkbox" id="checkAplica${idUnicoInput}" data-id-checkbox="${arrayPreguntas[i]["idInputRespuesta"]}" name="checkAplica${conteoPreguntas}" value="No aplica" checked="">
                            <i class="fas fa-check"></i>
                        </label>
                    </li>
                    `;
          $(
            "#contenedorGrupoBotonesPregunta" + arrayPreguntas[i]["idPregunta"]
          ).append(htmlModuloAplica);

          var idCheckAplica = `#checkAplica${idUnicoInput}`;
          //validar si existe en localstorage y mostrar en vez de la api
          if (
            typeof DataAplica !== "undefined" &&
            typeof DataAplica[arrayPreguntas[i]["idInputRespuesta"]] !==
              "undefined"
          ) {
            if (
              DataAplica[arrayPreguntas[i]["idInputRespuesta"]][
                "respuestaAplica"
              ] == "1"
            ) {
              $(idCheckAplica).prop("checked", true);
              $(idCheckAplica)
                .parent("label")
                .children("i")
                .prop("class", "fas fa-check");
              $(idCheckAplica)
                .parent("label")
                .removeClass("check-pregunta-no-aplica")
                .addClass("check-pregunta-si-aplica");
              $(idCheckAplica)
                .closest(".col-md-12")
                .find(".form-group")
                .removeClass("opacity-6-disabled");
              $(idCheckAplica)
                .parents(".grupo-botones-pregunta")
                .find(".item-ayuda")
                .removeClass("opacity-4-disabled");
            } else {
              $(idCheckAplica).prop("checked", false);
              $(idCheckAplica)
                .parent("label")
                .children("i")
                .prop("class", "fas fa-times");
              $(idCheckAplica)
                .parent("label")
                .removeClass("check-pregunta-si-aplica")
                .addClass("check-pregunta-no-aplica");
              $(idCheckAplica)
                .closest(".col-md-12")
                .find(".form-group")
                .addClass("opacity-6-disabled");
              $(idCheckAplica)
                .parents(".grupo-botones-pregunta")
                .find(".item-ayuda")
                .addClass("opacity-4-disabled");
            }
          } else {
            if (arrayPreguntas[i]["statusAplica"] == "1") {
              $(idCheckAplica).prop("checked", true);
              $(idCheckAplica)
                .parent("label")
                .children("i")
                .prop("class", "fas fa-check");
              $(idCheckAplica)
                .parent("label")
                .removeClass("check-pregunta-no-aplica")
                .addClass("check-pregunta-si-aplica");
              $(idCheckAplica)
                .closest(".col-md-12")
                .find(".form-group")
                .removeClass("opacity-6-disabled");
              $(idCheckAplica)
                .parents(".grupo-botones-pregunta")
                .find(".item-ayuda")
                .removeClass("opacity-4-disabled");
            } else {
              $(idCheckAplica).prop("checked", false);
              $(idCheckAplica)
                .parent("label")
                .children("i")
                .prop("class", "fas fa-times");
              $(idCheckAplica)
                .parent("label")
                .removeClass("check-pregunta-si-aplica")
                .addClass("check-pregunta-no-aplica");
              $(idCheckAplica)
                .closest(".col-md-12")
                .find(".form-group")
                .addClass("opacity-6-disabled");
              $(idCheckAplica)
                .parents(".grupo-botones-pregunta")
                .find(".item-ayuda")
                .addClass("opacity-4-disabled");
            }
          }
        }
      }
    }

    $(".boton-pregunta-anotacion").popover({
      trigger: "focus",
      html: true,
      placement: "top",
    });

    $('[data-toggle="tooltip"]').tooltip({
      // html : true,
      trigger: "hover",
      placement: "top",
    });

    // Este se usaba antes, ya no
    // bsCustomFileInput.init();

    // Colapsar automaticamente todos los elementos colapsados
    $(".btn-collapse-files").on("click", function () {
      $(".collapse").collapse("hide");
    });

    // Detectar cuando se le de clic a un input tipo checkbox
    $("input:checkbox[class='checkRespuesta']").on("click", function (event) {
      let idCheckbox = $(this).prop("id");
      let idPregunta = $(this).data("pregunta");

      if ($(this).is(":checked")) {
        checkCliqueado = $(this).prop("checked", true);
        respuestaCheckbox = "Si cumple";
      } else {
        checkCliqueado = $(this).prop("checked", false);
        respuestaCheckbox = "No cumple";
      }

      let dataRespuesta = new FormData();
      dataRespuesta.append("idCheckbox", idCheckbox);
      dataRespuesta.append("respuestaCheckbox", respuestaCheckbox);
      dataRespuesta.append("idPregunta", idPregunta);

      if (IsOnline()) {
        var request = $.ajax({
          url: "models/diagnostico/guardarCadaRespuestaCheckbox.php",
          method: "POST",
          data: dataRespuesta,
          contentType: false,
          processData: false,
          dataType: "json",

          beforeSend: function (xhr) {},
        });

        request.done(function (response) {
          if (response.status == "respuestaCheckboxGuardada") {
          }
        });

        request.fail(function (jqXHR, textStatus) {
          alert("Error al guardar la respuesta del checkbox");
        });
      } else {
        var data = [];
        data[idCheckbox] = {
          idCheckbox: idCheckbox,
          respuestaCheckbox: respuestaCheckbox,
          idPregunta: idPregunta,
        };
        SaveStorage(data, "DataCheckbox"); //guardar en localstorage
      }
    });

    // Detectar cuando se le da clic a un input tipo checkbox con una clase en especifico
    $("input:checkbox[class='checkAplica']").on("click", function (event) {
      if ($(this).is(":checked")) {
        checkCliqueado = $(this).prop("checked", true);
        respuestaCheckboxAplica = "1";
        $(this).parent("label").children("i").prop("class", "fas fa-check");
        $(this)
          .parent("label")
          .attr("data-original-title", "Si aplica")
          .tooltip("show");
        $(this)
          .parent("label")
          .removeClass("check-pregunta-no-aplica")
          .addClass("check-pregunta-si-aplica");
        $(this)
          .closest(".col-md-12")
          .find(".form-group")
          .removeClass("opacity-6-disabled");
        $(this)
          .parents(".grupo-botones-pregunta")
          .find(".item-ayuda")
          .removeClass("opacity-4-disabled");
      } else {
        checkCliqueado = $(this).prop("checked", false);
        respuestaCheckboxAplica = "0";
        $(this).parent("label").children("i").prop("class", "fas fa-times");
        $(this)
          .parent("label")
          .attr("data-original-title", "No aplica")
          .tooltip("show");
        $(this)
          .parent("label")
          .removeClass("check-pregunta-si-aplica")
          .addClass("check-pregunta-no-aplica");
        $(this)
          .closest(".col-md-12")
          .find(".form-group")
          .addClass("opacity-6-disabled");
        $(this)
          .parents(".grupo-botones-pregunta")
          .find(".item-ayuda")
          .addClass("opacity-4-disabled");
      }

      let dataIdCheckbox = $(this).data("id-checkbox");

      let dataAplica = new FormData();
      dataAplica.append("dataIdCheckbox", dataIdCheckbox);
      dataAplica.append("respuestaAplica", respuestaCheckboxAplica);

      if (IsOnline()) {
        var request = $.ajax({
          url: "models/diagnostico/guardarCadaRespuestaAplica.php",
          method: "POST",
          data: dataAplica,
          contentType: false,
          processData: false,
          dataType: "json",

          beforeSend: function (xhr) {},
        });

        request.done(function (response) {
          if (response.status == "respuestaAplicaGuardada") {
          }
        });

        request.fail(function (jqXHR, textStatus) {
          alert("Error al guardar la respuesta del checkbox");
        });
      } else {
        var data = [];
        data[dataIdCheckbox] = {
          dataIdCheckbox: dataIdCheckbox,
          respuestaAplica: respuestaCheckboxAplica,
        };
        SaveStorage(data, "DataAplica"); //guardar en localstorage
      }
    });

    // Detectar cuando un input con la clase especifica cambie
    $(".inputTextRespuesta").on("change", function (event) {
      let dataIdCheckbox = $(this).data("id-checkbox");
      let observacion = $(this).val();

      let dataObservacion = new FormData();
      dataObservacion.append("dataIdCheckbox", dataIdCheckbox);
      dataObservacion.append("observacion", observacion);

      if (IsOnline()) {
        var request = $.ajax({
          url: "models/diagnostico/guardarCadaRespuestaTextarea.php",
          method: "POST",
          data: dataObservacion,
          contentType: false,
          processData: false,
          dataType: "json",

          beforeSend: function (xhr) {},
        });

        request.done(function (response) {
          if (response.status == "respuestaTextareaGuardada") {
          }
        });

        request.fail(function (jqXHR, textStatus) {});
      } else {
        var data = [];
        data[dataIdCheckbox] = {
          dataIdCheckbox: dataIdCheckbox,
          observacion: observacion,
        };
        SaveStorage(data, "DataTextarea"); //guardar en localstorage
      }
    });

    // Validar cuando input file cambie
    $(".inputResponseFiles").on("change", function (event) {
      let input = $(this);
      let dataIdInputRespuesta = input.data("id-inputrespuesta");

      if (input.prop("files") && input.prop("files")[0]) {
        let files = input.prop("files");
        let dataFiles = new FormData();

        dataFiles.append("idInputRespuesta", dataIdInputRespuesta);
        dataFiles.append("idDiagnostico", idDiagnostico);

        if (IsOnline()) {
          for (let i = 0; i < files.length; i++) {
            dataFiles.append("files[]", files[i]);
          }

          // Solicitud al servidor para guardar las imagenes
          let request = $.ajax({
            url: "models/diagnostico/guardarImagenCadaRespuesta.php",
            method: "POST",
            data: dataFiles,
            contentType: false,
            processData: false,
            dataType: "json",
            beforeSend: function (xhr) {},
          });

          request.done(function (response) {
            if (response.status == "success") {
              $("#divImages-" + dataIdInputRespuesta).removeClass("d-none");
              // Sumar la cantidad de imagenes
              let labelCountFiles = $("#countFiles-" + dataIdInputRespuesta);
              let countFiles =
                parseInt(labelCountFiles.html()) + response.images.length;
              labelCountFiles.html(countFiles);

              for (let i = 0; i < response.images.length; i++) {
                let htmlImage = `
                                <div class="text-center">
                                    <img class="item-image border rounded" src="assets/img/images-de-evidencias/${response.images[i]["url"]}"></img>
                                    <button type="button" data-id-imagen="${response.images[i]["id"]}" data-inputrespuesta="${dataIdInputRespuesta}" data-url-imagen="${response.images[i]["url"]}" class="mt-3 btn btn-sm btn-outline-danger text-center btn-delete-image-response">Eliminar</button>
                                </div>
                                `;
                $(".sectionFiles-" + dataIdInputRespuesta).append(htmlImage);
              }
            }
          });
          request.fail(function (jqXHR, textStatus) {
            console.log(textStatus);
          });
        } else {
          if (localStorage.getItem("DataImagen") == null) {
            data = [];
            data[dataIdInputRespuesta] = {
              idInputRespuesta: dataIdInputRespuesta,
              idDiagnostico: idDiagnostico,
              files: {},
            };
          } else {
            data = JSON.parse(localStorage.getItem("DataImagen")) || {};
          }
          const getLengthOfObject = (obj) => {
            let lengthOfObject = Object.keys(obj).length;
            return lengthOfObject;
          };

          function readmultifiles(filesx) {
            var reader = new FileReader();
            function readFile(index) {
              if (index >= filesx.length) {
                let labelCountFiles = $("#countFiles-" + dataIdInputRespuesta);
                let countFiles =
                  parseInt(labelCountFiles.html()) + filesx.length;
                labelCountFiles.html(countFiles);
                SaveStorage(data, "DataImagen");
                return;
              } else {
                var file = filesx[index];
                reader.onload = function (e) {
                  $("#divImages-" + dataIdInputRespuesta).removeClass("d-none");
                  var fileold = generarID();
                  let htmlImage = `
                                <div class="text-center">
                                    <img class="item-image border rounded" src="${reader.result}"></img>
                                    <button type="button" data-id-imagen="offline-${fileold}" data-inputrespuesta="${dataIdInputRespuesta}" data-url-imagen="${reader.result}" class="mt-3 btn btn-sm btn-outline-danger text-center btn-delete-image-response">Eliminar</button>
                                </div>
                                `;
                  $(".sectionFiles-" + dataIdInputRespuesta).append(htmlImage);
                  if (data[dataIdInputRespuesta] === undefined) {
                    data[dataIdInputRespuesta] = {
                      idInputRespuesta: dataIdInputRespuesta,
                      idDiagnostico: idDiagnostico,
                      files: {},
                    };
                  }
                  data[dataIdInputRespuesta]["files"]["offline-" + fileold] =
                    reader.result;

                  readFile(index + 1);
                };
                reader.readAsDataURL(file);
              }
            }
            readFile(0);
          }
          readmultifiles(files);
        }
      }
    });

    // Eventlistener global que se sigue ejecutando aun que sea un elemento creado dinamicamente
    $(document).on("click", ".btn-delete-image-response", function (e) {
      e.preventDefault();

      let btn = $(this);
      btn.addClass("disabled");
      btn.html("En curso");

      let dataIdImagen = btn.data("id-imagen");
      let dataUrlImagen = btn.data("url-imagen");
      let dataIdInputRespuesta = btn.data("inputrespuesta");

      if (IsOnline()) {
        let request = $.ajax({
          url: "models/diagnostico/eliminarImagenRespuesta.php",
          method: "POST",
          data: {
            id: dataIdImagen,
            url: dataUrlImagen,
          },
          // contentType: "application/json",
          // processData: false,
          dataType: "json",

          beforeSend: function (xhr) {},
        });

        request.done(function (response) {
          if (response.status == "success") {
            let divImage = btn.parent();
            divImage.remove();

            // Restar el contador de imagenes
            let labelCountFiles = $("#countFiles-" + dataIdInputRespuesta);
            let countFiles = parseInt(labelCountFiles.html()) - 1;
            labelCountFiles.html(countFiles);
          }
        });

        request.fail(function (jqXHR, textStatus) {
          console.log(textStatus);
        });
      } else {
        //validamos si la imagen a borrar es de cache o de la nube
        // console.log(typeof dataIdImagen);
        if (typeof dataIdImagen == "string") {
          if (dataIdImagen.includes("offline-")) {
            let divImage = btn.parent();
            divImage.remove();
            a = JSON.parse(localStorage.getItem("DataImagen"));
            //eliminamos imagen del localstorage
            a[dataIdInputRespuesta]["files"] = Object.keys(
              a[dataIdInputRespuesta]["files"]
            )
              .filter((llave) => llave !== dataIdImagen)
              .reduce((obj, llave) => {
                obj[llave] = a[dataIdInputRespuesta]["files"][llave];
                return obj;
              }, {});
            if (isObjEmpty(a[dataIdInputRespuesta]["files"])) {
              localStorage.removeItem("DataImagen");
            } else {
              localStorage.setItem("DataImagen", JSON.stringify(a));
            }
            // Restar el contador de imagenes
            let labelCountFiles = $("#countFiles-" + dataIdInputRespuesta);
            let countFiles = parseInt(labelCountFiles.html()) - 1;
            labelCountFiles.html(countFiles);
          }
        } else {
          let divImage = btn.parent();
          divImage.css("-webkit-filter", "blur(3px)");
          //almacenamos solicitud para borrar cuando vuelva el internet
          if (localStorage.getItem("DeleteImagen") == null) {
            data = [];
            data["files"] = {};
            data["files"][dataIdImagen] = dataUrlImagen;
            SaveStorage(data, "DeleteImagen");
            btn.html("Esperando Internet");
          } else {
            data = JSON.parse(localStorage.getItem("DeleteImagen")) || {};
            data["files"][dataIdImagen] = dataUrlImagen;
            SaveStorage(data, "DeleteImagen");
            btn.html("Esperando Internet");
          }
        }
      }
    });

    //Validamos la etapa por la cual quedo el usuario en la prueba
    if (numeroEtapaModulo == null || numeroEtapaModulo == "") {
      numeroEtapaModulo = 0;
    }

    //Validamos si el diagnostico fue completado
    if (statusCompletado == 0) {
      enableAllAnchorsDiagnostico = false;
    } else {
      enableAllAnchorsDiagnostico = true;
    }

    $("#smartwizard").smartWizard({
      selected: numeroEtapaModulo,
      keyNavigation: true, // Teclas derecha, izquierda activadas
      autoAdjustHeight: true, // Ajustarse automaticamente al alto del contenido
      cycleSteps: false, // Permite realizar un ciclo de navegación de pasos
      // useURLhash: true, // Enable selection of the step based on url hash
      showStepURLhash: true,
      anchorSettings: {
        anchorClickable: true, // Activar / Desactivar navegación de anclaje
        enableAllAnchors: enableAllAnchorsDiagnostico, // Activa todos los anclajes en los que se puede hacer clic en todo momento
        markDoneStep: true, // agrega css hecho
        enableAnchorOnDoneStep: true, // Habilita / deshabilita la navegación de pasos realizados
      },
      lang: {
        next: "SIGUIENTE",
        previous: "ANTERIOR",
      },
      toolbarSettings: {
        toolbarPosition: "both", // none, top, bottom, both
        toolbarButtonPosition: "right", // left, right
        showNextButton: true, // show/hide a Next button
        showPreviousButton: true, // show/hide a Previous button
        toolbarExtraButtons: [
          $("<button></button>")
            .text("GUARDAR CAMBIOS")
            .attr("type", "button")
            .addClass("btn btn-outline-success mt-3 mt-md-0 btnFinalizar")
            .on("click", function () {
              Swal.fire({
                title: "¿Esos fueron todos los cambios?",
                text: "Estamos preparados para generar los resultados.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "¡Si, ver resultados!",
                cancelButtonText: "No, cancelar",
                buttonsStyling: false,
                customClass: {
                  confirmButton: "btn btn-primary",
                  cancelButton: "btn btn-neutral",
                },
              }).then((result) => {
                if (result.value) {
                  var idDiagnostico = getParameter("idDiagnostico");
                  var request = $.ajax({
                    url: "models/diagnostico/guardarStatusCompletado.php",
                    method: "POST",
                    data: {
                      idDiagnostico: idDiagnostico,
                    },
                    // contentType: false,
                    // processData: false,
                    dataType: "json",

                    beforeSend: function (xhr) {},
                  });

                  request.done(function (response) {
                    if (response.status == "statusGuardado") {
                      Toast.fire({
                        icon: "success",
                        timer: 500,
                        title: "Redireccionando a los resultados.",
                        position: "top-end",
                      });

                      setTimeout(() => {
                        verResultadosDiagnostico(
                          true,
                          idGrupoDiagnostico,
                          idDiagnostico
                        );
                      }, 500);
                    }
                  });

                  request.fail(function (jqXHR, textStatus) {});
                }
              });
            }),
        ],
      },
      disabledSteps: [],
      errorSteps: [],
      theme: "default",
      transitionEffect: "fade",
      transitionSpeed: "500",
    });

    // Cada vez que el usuario pase a otra etapa el navegador se va acomoda a la parte de arriba de la prueba
    $("#smartwizard").on(
      "showStep",
      function (e, anchorObject, stepNumber, stepDirection) {
        // location.href="#contenedorFullPreguntas";

        // Guardar etapa modulo en la base de datos
        let idDiagnostico = getParameter("idDiagnostico");
        let numeroEtapa = stepNumber;

        var request = $.ajax({
          url: "models/diagnostico/guardarEtapaDiagnostico.php",
          method: "POST",
          data: {
            idDiagnostico: idDiagnostico,
            numeroEtapa: numeroEtapa,
          },
          // contentType: false,
          // processData: false,
          dataType: "json",

          beforeSend: function (xhr) {},
        });

        request.done(function (response) {});

        request.fail(function (jqXHR, textStatus) {});
      }
    );

    $.validator.messages.required = "";

    $("#formPreguntas").validate({
      highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
      },
    });

    // Se le agregan clases al modal de preguntas de ayuda
    $("#modalPreguntasAyuda").on("show.bs.modal", function (e) {
      $(".body-page").addClass("modal-open-scroll");
      $(this).addClass("tamaño-modal-custom shadow-ultra-lg");
      $(".modal-dialog").addClass("custom-modal-dialog");
    });

    // Poner arrastrable el modal de preguntas de ayuda
    $("#modalPreguntasAyuda").draggable({
      handle: ".modal-content",
    });

    // Cuando se arrastra el modal los popovers dentro se van a esconder
    $("#modalPreguntasAyuda").on("dragstart", function (event, ui) {
      $(".popover-pregunta-ayuda").popover("hide");
    });

    // Cuando se termine de mostrar el popover se le va a poner el scrollLock
    // Se le cambia el alto del popover si este este mas alto de 120px
    $(".boton-pregunta-anotacion").on("shown.bs.popover", function (event) {
      var idPopover = $(event.target).attr("aria-describedby");
      var popoverSeleccionado = $("#" + idPopover).children(".popover-body");
      popoverSeleccionado.scrollLock({
        strict: false,
        animation: {
          top: "top elastic-top",
          bottom: "bottom elastic-bottom",
        },
      });

      popoverSeleccionado.height("auto");
      var alturaPopoverBody = popoverSeleccionado.height();
      if (alturaPopoverBody > 120) {
        popoverSeleccionado.height(120);
        $(".boton-pregunta-anotacion").popover("update");
      }
    });

    // location.href="#contenedorFullPreguntas";

    //Abrir modal para guardar el diagnostico
    // primerGuardadoDiagnostico();
  });

  request.fail(function (jqXHR, textStatus) {});
};

$("#labelNombreDiagnostico").dblclick(function () {
  renombrarDiagnostico();
});

$("#labelDescripcionDiagnostico").dblclick(function () {
  editarDescripcionDiagnostico();
});

var renombrarDiagnostico = function () {
  let labelNombreDiagnostico = $("#labelNombreDiagnostico");
  let inputNombreNuevo = $("#nombreNuevoDiagnostico");
  let modalRenombrar = $("#modalRenombrarDiagnostico");

  // Abrir modal
  modalRenombrar.modal("show");

  // cuando el modal ya esté abierto, has lo siguiente:
  $(modalRenombrar).on("shown.bs.modal", function (e) {
    $(inputNombreNuevo).focus();
    $(inputNombreNuevo).focus(function () {
      this.select();
    });

    $(inputNombreNuevo).val(labelNombreDiagnostico.html());

    $(inputNombreNuevo).on("input", function () {
      labelNombreDiagnostico.html($(this).val());
    });
  });

  //====================

  $("#formRenombrarDiagnostico").on("submit", function (event) {
    event.preventDefault();

    // Nuevo nombre

    let idDiagnostico = getParameter("idDiagnostico");
    let btnRenombrarDiagnostico = $("#btnRenombrarDiagnostico");
    let dataNuevoNombre = $(inputNombreNuevo).val();

    if (dataNuevoNombre != "") {
      $.ajax({
        url: "models/diagnostico/renombrarDiagnostico.php",
        type: "POST",
        data: { idDiagnostico: idDiagnostico, nombreNuevo: dataNuevoNombre },
        cache: false,
        dataType: "json",

        beforeSend: function () {
          btnRenombrarDiagnostico.html(
            '<i class="fas fa-circle-notch fa-spin"></i>'
          );
        },

        success: function (data) {
          btnRenombrarDiagnostico.html('<i class="fas fa-check"></i>');

          if (data.status == "nombreCambiado") {
            // $(labelNombreDiagnostico).html(dataNuevoNombre);
            $(modalRenombrar).modal("hide");
            setTimeout(() => {
              btnRenombrarDiagnostico.html("Guardar cambios");
            }, 200);
          } else {
            alert("Error al cambiar el nombre, comunicar a soporte!");
          }
        },
      });
    } else {
    }
  });

  $(modalRenombrar).on("hidden.bs.modal", function (e) {
    $("#formRenombrarDiagnostico").off("submit");
    $(inputNombreNuevo).val("");
  });
};

var editarDescripcionDiagnostico = function () {
  let labelDescripcionDiagnostico = $("#labelDescripcionDiagnostico");
  let inputNuevaDescripcion = $("#nuevaDescripcionDiagnostico");
  let modalEditarDescripcion = $("#modalEditarDescripcion");
  let idDiagnostico = getParameter("idDiagnostico");
  // let descripcionDiagnostico = descripcionCompleta;

  $.ajax({
    url: "models/diagnostico/obtenerDescripcionDiagnostico.php",
    type: "POST",
    data: { idDiagnostico: idDiagnostico },
    cache: false,
    dataType: "json",

    beforeSend: function () {},

    success: function (data) {
      $(inputNuevaDescripcion).val(data.descripcion);
    },

    error: function () {
      alert(
        "error al encontrar la descripcion del diagnostico, por favor contactar a soporte!"
      );
    },
  });

  // Abrir modal
  modalEditarDescripcion.modal("show");

  // cuando el modal ya esté abierto, has lo siguiente:
  $(modalEditarDescripcion).on("shown.bs.modal", function (e) {
    $(inputNuevaDescripcion).focus();
    $(inputNuevaDescripcion).focus(function () {
      this.select();
    });
  });

  //====================

  $("#formEditarDescripcion").on("submit", function (event) {
    event.preventDefault();

    // Nueva descripcion

    let dataNuevaDescripcion = $(inputNuevaDescripcion).val();
    let btnDescripcionDiagnostico = $("#btnDescripcionDiagnostico");

    $.ajax({
      url: "models/diagnostico/editarDescripcionDiagnostico.php",
      type: "POST",
      data: {
        idDiagnostico: idDiagnostico,
        nuevaDescripcion: dataNuevaDescripcion,
      },
      cache: false,
      dataType: "json",

      beforeSend: function () {
        btnDescripcionDiagnostico.html(
          '<i class="fas fa-circle-notch fa-spin"></i>'
        );
      },

      success: function (data) {
        btnDescripcionDiagnostico.html('<i class="fas fa-check"></i>');

        if (data.status == "descripcionCambiada") {
          dataDescripcionCompleta = dataNuevaDescripcion;
          if (dataNuevaDescripcion.length > 100) {
            dataNuevaDescripcion =
              dataNuevaDescripcion.substr(0, 100) + " . . . ";
          }
          $(labelDescripcionDiagnostico).html(dataNuevaDescripcion);
          $(modalEditarDescripcion).modal("hide");
          setTimeout(() => {
            btnDescripcionDiagnostico.html("Guardar cambios");
          }, 200);
          $(labelDescripcionDiagnostico).attr(
            "data-content",
            nl2br(dataDescripcionCompleta)
          );
        } else {
          alert("Error al cambiar el nombre, comunicar a soporte!");
        }
      },
    });
  });

  $(modalEditarDescripcion).on("hidden.bs.modal", function (e) {
    $("#formEditarDescripcion").off("submit");
    $(inputNuevaDescripcion).val("");
  });
};

$(function () {
  obtenerDiagnosticoParaEditar();
});
