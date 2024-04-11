// Funcion encargada de obtener las preguntas de ayuda
function obtenerPreguntasAyuda(idPregunta = null, conteoPreguntas = null) {

    // Quitar el fondo negro transparente de atras del modal
    $("#modalPreguntasAyuda").modal({ backdrop: false });

    let formIdPregunta = new FormData();
    formIdPregunta.append("idPregunta", idPregunta);

    var request = $.ajax({
        url: 'models/diagnostico/obtenerPreguntasAyudaDiagnostico.php',
        method: "POST",
        data: formIdPregunta,
        contentType: false,
        processData: false,
        dataType: 'json',

        beforeSend: function(xhr) {
            $('#bodyPreguntasAyuda').html('');
            let htmlPreloader = `
                <div class="container-tarjeta2 pulse-preload" style="width: 400px; border: 0px;">
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
            `;
            $('#bodyPreguntasAyuda').append(htmlPreloader);

            let htmlPreloaderHeader = `Estamos trabajando en ello...`;
            $('#labelPreguntasAyuda').html(htmlPreloaderHeader);
        }
    });

    request.done(function(response) {
        var arrayPreguntasAyuda = response;
        var numeroPreguntasAyuda = arrayPreguntasAyuda.length;
        $('#bodyPreguntasAyuda').html('');

        // Se recorren las preguntas de ayuda
        for(let i=0; i < numeroPreguntasAyuda; i++) {
            var conteoPreguntaAyuda = i+1;
            var anotacionPreguntaAyuda = arrayPreguntasAyuda[i]['anotacionPreguntaAyuda'];

            if(anotacionPreguntaAyuda == '' || anotacionPreguntaAyuda == null){
                var htmlPreguntasAyuda = `
                    <li class="list-group-item"> <p style="font-size: 15px;" class="mb-0"><span class="font-weight-600">${conteoPreguntaAyuda}.</span> ${arrayPreguntasAyuda[i]['preguntaAyuda']}</p></li>
                `;
            }else{
                var htmlPreguntasAyuda = `
                    <li class="list-group-item"> 
                        <p class="mb-0" style="font-size: 15px;">
                            <span class="font-weight-600">${conteoPreguntaAyuda}.</span> ${arrayPreguntasAyuda[i]['preguntaAyuda']} 
                            <a href="#!" class="popover-pregunta-ayuda" data-toggle="popover" title="Anotaciones <i class='fas fa-angle-right'></i> <span class='text-primary'>${conteoPreguntaAyuda}. Pregunta ayuda</span>" data-content="${arrayPreguntasAyuda[i]['anotacionPreguntaAyuda']}">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </p>
                    </li>
                `;     
            }
            $('#bodyPreguntasAyuda').append(htmlPreguntasAyuda);
            
            $('#labelPreguntasAyuda').html(`Preguntas de ayuda <i class="fas fa-angle-right"></i> <span class="text-primary font-weight-600">${conteoPreguntas}. pregunta</span>`);
        }

        // Si el modal supera los 315px de altura, se va a modificar su altura
        // Ponerle scrollLock al modal de preguntas de ayuda
        var ventanaAyudaPreguntas = $('.modal-body-preguntas').height('auto');
        var alturaVentanaPreguntasAyuda = ventanaAyudaPreguntas.height();
        if(alturaVentanaPreguntasAyuda > 315){
            ventanaAyudaPreguntas.height(315);
            ventanaAyudaPreguntas.scrollLock();
        }
  
        $('.popover-pregunta-ayuda').popover({
            trigger: 'click',
            html: true,
            placement: "auto",
        });
        
        //Ponerle scrollLock al popover y modificar su altura
        $('.popover-pregunta-ayuda').on('shown.bs.popover', function (event) {
            let idPopover = $(event.target).attr('aria-describedby'); 
            let popoverSeleccionado = $('#'+idPopover).children('.popover-body');

            popoverSeleccionado.scrollLock({
                strict: true,
            });

            popoverSeleccionado.height('auto');
            var alturaPopoverBody = popoverSeleccionado.height();
            if(alturaPopoverBody > 120){
                popoverSeleccionado.height(120);
                $('.popover-pregunta-ayuda').popover('update');
            }
        });

        // Cuando el contenedor se colapse se va a modificar el ancho del div
        $('#contenedorModalBodyFooter').on('hide.bs.collapse', function () {
            $('#modalPreguntasAyuda').width('31.25rem');
        });

        // Cuando el contenedor se muestre se va a mdofiicar el ancho del div en auto
        $('#contenedorModalBodyFooter').on('show.bs.collapse', function (e) {
            $('#modalPreguntasAyuda').width('auto');
        });

        // Despues de que se termine de mostrar mostrar el contenedor, se va a modificar
        // su alto y se le va a poner scrollLock
        $('#contenedorModalBodyFooter').on('shown.bs.collapse', function () {
            $('#modalPreguntasAyuda').width('auto');
            let ventanaAyudaPreguntas = $('.modal-body-preguntas').height('auto');
            let alturaVentanaPreguntasAyuda = ventanaAyudaPreguntas.height();
            if(alturaVentanaPreguntasAyuda > 315){
                ventanaAyudaPreguntas.height(315);
                ventanaAyudaPreguntas.scrollLock();
            }
        });

        // Cuando el modal de preguntas de ayuda se esconda, vamos a mostrar su contenedor
        // con el fin de que no se quede colapsado el contenedor
        $('#modalPreguntasAyuda').on('hidden.bs.modal', function (e) {
            $('#contenedorModalBodyFooter').collapse('show');
        });
    });
}
//funcion para validar si tiene internet el navegador
function IsOnline()
{
    if(navigator.onLine){
        return true;
    }else{
        return false;
    }
}
//funcion para guardar estados y textos de diagnostico en localstore
function SaveStorage(data, db = 'DataTextarea')
{
    var a = {};
    //validar si existe el array , sino para crearlo
    if(localStorage.getItem(db) !== undefined && localStorage.getItem(db)){
        //convertimos a obj el array
        a = JSON.parse(localStorage.getItem(db)) || {};
        //agregamos o actualizamos el campo
        // a[data[0]] = data[1];
        for(i in data)
        {
            a[i] = data[i];
        }
        //volvemos a guardar en localstore
        localStorage.setItem(db, JSON.stringify(a));
    }else
    {
        for(i in data)
        {
            a[i] = data[i];
        }
        localStorage.setItem(db, JSON.stringify(a));
    }

    
}
//Funcion para envio de data por medio de ajax
function SyncSubmit(data, url)
{
    function DataURIToBlob(dataURI) {
        const splitDataURI = dataURI.split(',')
        const byteString = splitDataURI[0].indexOf('base64') >= 0 ? atob(splitDataURI[1]) : decodeURI(splitDataURI[1])
        const mimeString = splitDataURI[0].split(':')[1].split(';')[0]

        const ia = new Uint8Array(byteString.length)
        for (let i = 0; i < byteString.length; i++)
            ia[i] = byteString.charCodeAt(i)

        return new Blob([ia], { type: mimeString })
    }

    var form_data = new FormData();

    for ( var key in data ) {
        if(key == "files")
        {
            for(i in data[key])
            {
                var file = DataURIToBlob(data[key][i]);
                form_data.append('files[]', file, i+'.png');
            }
        }else
        {
            form_data.append(key, data[key]);
        }
    }
    var request = $.ajax({
        url: url,
        type: "POST",
        data: form_data,
        contentType: false,
        processData: false,
        dataType: 'json',

        beforeSend: function( xhr ) {
        }
    });

    request.done(function(response) {
        if(response.status == 'respuestaCheckboxGuardada'){}
        if(response.status == 'success')
        {
            if(response.delete)
            {
               for (idimg in response.delete)
               {
                var delimg = '[data-id-imagen="'+idimg+'"]';
                $(delimg).parent().remove();
               }
            }
        }
    });
    
    request.fail(function(jqXHR, textStatus) {
        alert('Error al guardar la respuesta del checkbox');
    });  
}
function isObjEmpty(obj) {
    for (var prop in obj) {
      if (obj.hasOwnProperty(prop)) return false;
    }
  
    return true;
  }
//funcion para subir los cambios almacenados en el locaStorage
function SyncOnline()
{
    var DBs = ["DataTextarea","DataAplica","DataCheckbox","DataImagen","DeleteImagen"];
    var URLs = ['models/diagnostico/guardarCadaRespuestaTextarea.php','models/diagnostico/guardarCadaRespuestaAplica.php','models/diagnostico/guardarCadaRespuestaCheckbox.php','models/diagnostico/guardarImagenCadaRespuesta.php','models/diagnostico/eliminarImagenRespuesta.php'];

    for(key in DBs)
    {
        let DB = DBs[key];
        if(localStorage.getItem(DB) !== undefined && localStorage.getItem(DB))
        {
            a = JSON.parse(localStorage.getItem(DB)) || {};
            b = JSON.parse(localStorage.getItem(DB)) || {};
            for(id in a )
            {
                dataSubmit = a[id];
                SyncSubmit(dataSubmit, URLs[key]);

                a = Object.keys(a).filter(llave =>
                    llave !== id).reduce((obj, llave) =>
                    {
                        obj[llave] = a[llave];
                        return obj;
                    }, {}
                );
                // console.log(b);
                
            }
            if(isObjEmpty(a))
            {
                localStorage.removeItem(DB);
            }else
            {
                localStorage.setItem(DB, JSON.stringify(a));
            }
            
        }
    }

}
//llamar funcion de SyncOnline cuando se restrablece conexion.
window.addEventListener('online', SyncOnline);


// Constante de Sweet Alert en Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// Generar un ID aleatorio
function generarID() {
    var d = new Date().getTime();
    var uuid = 'xxxxxxxxxxxx4xxxyxxxxx'.replace(/[xy]/g, function (c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
    return uuid;
}

// Funcion para convertir un text en HTML
function nl2br (str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

// Funcion para que el desplazamiento del scroll sea suave
// $('a[href^="#"]').click(function() {
//     var destino = $(this.hash);
//     if (destino.length == 0) {
//       destino = $('a[name="' + this.hash.substr(1) + '"]');
//     }
//     if (destino.length == 0) {
//       destino = $('html');
//     }
//     $('html, body').animate({ scrollTop: destino.offset().top }, 500);
//     return false;
// });

// Funciones para alternar el contenedor de preguntas
function mostrarContenedorPreguntas(resp = false, idGrupoDiagnostico = null, idGrupoPreguntas = null, nombreGrupo = null){
    if(resp === true){
        location.href = "?view=diagnostico&action=nuevoDiagnostico&idGrupoDiagnostico="+idGrupoDiagnostico+"&idGrupoPreguntas="+idGrupoPreguntas;
    }else if(resp === "crearDiagDeUna"){
        location.href = "?view=diagnostico&action=nuevoDiagnostico&nomGrupo="+nombreGrupo;
    }else if(resp == "volver"){
        history.back();
    }else{
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Puedes continuar con el diagnostico despues, si asi lo deseas",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '¡Si, salir!',
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.value) {
                location.href = "?view=diagnostico";
            }
        });
    }
}

// Funciones para mostrar vistas
var verEditarDiagnostico = function (modificarURL = false, idGrupoDiagnosticos = null, idDiagnostico = null) {
    if(modificarURL === true){
        location.href = "?view=diagnostico&action=editarDiagnostico&idGrupoDiagnostico="+idGrupoDiagnosticos+"&idDiagnostico="+idDiagnostico; 
    }
}

var verResultadosDiagnostico = function (modificarURL = false, idGrupoDiagnosticos = null, idDiagnostico = null) {
    if(modificarURL === true){
        location.href = "?view=diagnostico&action=resultadosDiagnostico&idGrupoDiagnostico="+idGrupoDiagnosticos+"&idDiagnostico="+idDiagnostico; 
    }
}

var verPersonalizarDiagnostico = function (modificarURL = false, idGrupoDiagnosticos = null, idDiagnostico = null) {
    if(modificarURL === true){
        location.href = "?view=diagnostico&action=personalizarDiagnostico&idGrupoDiagnostico="+idGrupoDiagnosticos+"&idDiagnostico="+idDiagnostico; 
    }
}

var crearGrupoDiagnosticos = function(modificarURL = false){
    if(modificarURL === true){
        location.href = "?view=diagnostico&action=crearGrupoDiagnosticos"; 
    }
}

// Switch para llamar funciones dependiendo de la vista
var action = getParameter('action');
switch (action) {
    // case "nuevoGrupoURL":
       
    // break;
    
    // case "resultadosDiagnostico":
    //     obtenerResultadosDiagnostico();
    // break;

    // case "editarDiagnostico":
    //     obtenerDiagnosticoParaEditar();
    // break;

    // Este es por si se recarga la pagina cuando se crea por primera un diagnostico
    case "nuevoDiagnostico":

        var idDiagnostico = getParameter('idDiagnostico') == "" ? "" : getParameter('idDiagnostico');
        var idGrupoDiagnosticos = getParameter('idGrupoDiagnostico');

        if(idDiagnostico !== ""){

            var request = $.ajax({
                url: 'models/diagnostico/verificarDiagnosticoGuardado.php',
                method: "POST",
                data: {'idDiagnostico': idDiagnostico},
                dataType: 'json',
                beforeSend: function( xhr ) {
                      
                }
            });
            request.done(function(response) {
                
                Toast.fire({
                    icon: 'success',
                    title: 'Recuperamos tu diagnostico, puedes seguir trabajando.'
                });
                
                if(response.statusCompletado == 0){
                    verEditarDiagnostico(true, idGrupoDiagnosticos, idDiagnostico);
                }
    
            });
            
            request.fail(function(jqXHR, textStatus) { 
                alert('error al recuperar el diagnostico.')  
            });
        } 
    
    break;

    // case "verRespuestas":

    // break;

    // case "personalizarDiagnostico":
    //     funcionesPersonalizarInforme();
    // break;

    // default:
    //     listarGruposDiagnosticos();
    // break;
}