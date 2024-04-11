

// let dataCustomInforme = new FormData($("#formNuevoGrupoDiagnosticos")[0]);

const crearNuevoGrupoDiagnosticos = () => {
    $("#formNuevoGrupoDiagnosticos").on("submit", function (event) {
      event.preventDefault();
  
      const btn = $(this);
      const form = $(this).closest("form");
  
   
        $(btn).addClass("disabled");
  
        const dataForm = $(form).serialize();
  
        const request = $.ajax({
          url: "models/diagnostico/nuevoGrupoDiagnosticos.php",
          method: "POST",
          data: dataForm,
          dataType: "json",
          cache: false,
        });
  
        request.done(function (response) {
          if (response.status == "grupoCreado") {
            location.href = "?view=diagnostico";
          } else if (response.status == "grupoNoCreado") {
            Toast.fire({
              icon: "error",
              title: response.msj,
            });
            $(btn).removeClass("disabled");
          }
        });
  
        request.fail(function (jqXHR, textStatus) {
          $(btn).removeClass("disabled");
  
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Le vamos a ser sincero... No sabemos lo que paso, por favor inténtelo más tarde.',
            footer: '<a target="_blank" href="https://api.whatsapp.com/send?phone=573016346643&text=Hola,%20vengo%20de%20*TOOLAFT*.%20Hubo%20un%20*error%20desconocido*%20al%20intentar%20iniciar%20sesi%C3%B3n.">Notificar error</a>',
            buttonsStyling: false,
            confirmButtonText: 'Ok',
            customClass: {
              confirmButton: 'btn btn-primary',
            }
          });
        });
     
    });
  };
  
  $(document).ready(function () {
    crearNuevoGrupoDiagnosticos();
  });