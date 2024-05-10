$(document).ready(function () {
    $("#grupodiagnostico").DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [5, 10, 15, 20],
        order: [0, "desc"],
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ elementos",
            info: "Mostrando de _START_ a _END_ de _TOTAL_ elementos",
            infoEmpty: "Mostrando 0 a 0 de 0 elementos",
            infoFiltered: "(filtrado de _MAX_ elementos en total)",
            infoPostFix: "",
            loadingRecords: "Cargando registros...",
            zeroRecords: "No se encontraron registros",
            emptyTable: "No hay datos disponibles en la tabla",
            paginate: {
                first: "Primero",
                previous: "<<",
                next: ">>",
                last: "Último",
            },
            aria: {
                sortAscending:
                    ": activar para ordenar la columna de manera ascendente",
                sortDescending:
                    ": activar para ordenar la columna de manera descendente",
            },
        },
    });
});

function ModalDiagnostico(id) {
    if (id) {
        $.ajax({
            url: "Grupodiagnosticos/" + id,
            type: "GET",
            success: function (response) {
                let tableContent = "";
                const editBaseUrl = "/diagnosticos/";
                const edit = "/edit";

                console.log(response);

                if (response.length > 0) {
                    response.forEach((element) => {
                        let fecha = new Date(element["created_at"]);
                        let fechaFormateada = `${fecha.getDate()}-${
                            fecha.getMonth() + 1
                        }-${fecha.getFullYear()}`;
                        tableContent += `
            <tr>
                <td><img src="../assets/img/images/grupo.png" class="avatar avatar-md bg-transparent "></td>
                <td>${element["nombre"]}</td>
                <td>${element["objetivo"]}</td>
                <td>${fechaFormateada}</td>
                <td>
                    <a class="nav-link pr-0" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                        <h6 class="dropdown-header" style="color: rgba(0,0,0,.72) !important;">Gestionar</h6>
                        <a href="${
                            editBaseUrl + element["id"] + edit
                        }" class="dropdown-item text-dark ">
                            <i class="far fa-folder-open"></i>
                            <span>Ver Informe</span>
                        </a>
                        <a href="#" onclick="$('#diagnosticosexistentes').modal('hide'); diagnosticosDelete(${
                            element["id"]
                        });" class="dropdown-item font-dropdown-documento">
                            <i class="fas fa-trash-alt"></i>
                            <span>Eliminar</span>
                        </a>
                </td>
            </tr>
        `;
                    });
                } else {
                    tableContent = '<td colspan="5">No hay registros</td>';
                }

                $("#diagnosticostrue").html(`
    <div class="table-responsive py-2">
        <table class="table table-striped align-items-center table-hover w-100" id="diagnosticosexistentestabla">
            <thead class="thead-light">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">objetivo</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                 ${tableContent}
            </tbody>
        </table>
    </div>
`);
                // Inicializar DataTables
                $("#diagnosticosexistentestabla").DataTable({
                    responsive: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 15, 20],
                    order: [0, "desc"],
                    language: {
                        processing: "Procesando...",
                        search: "Buscar:",
                        lengthMenu: "Mostrar _MENU_ elementos",
                        info: "Mostrando de _START_ a _END_ de _TOTAL_ elementos",
                        infoEmpty: "Mostrando 0 a 0 de 0 elementos",
                        infoFiltered: "(filtrado de _MAX_ elementos en total)",
                        infoPostFix: "",
                        loadingRecords: "Cargando registros...",
                        zeroRecords: "No se encontraron registros",
                        emptyTable: "Cargando datos...",
                        paginate: {
                            first: "Primero",
                            previous: "<<",
                            next: ">>",
                            last: "Último",
                        },
                        aria: {
                            sortAscending:
                                ": activar para ordenar la columna de manera ascendente",
                            sortDescending:
                                ": activar para ordenar la columna de manera descendente",
                        },
                    },
                });
            },
            error: function (error) {
                if (error.responseJSON && error.responseJSON.error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: error.responseJSON.error,
                    });
                }
            },
        });
    } else {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ingrese un numero de contrato",
        });
    }
}

function ModalCrear(id) {
    if (id) {
        $("#btnComenzarDiagnostico").on("click", function (e) {
            e.preventDefault();
            var btn = $(this);
            var form = $("#formTipoDiagnostico");
            form.validate({
                rules: {
                    tipoDiagnostico: {
                        required: true,
                    },
                },
                messages: {
                    tipoDiagnostico: "Este campo es obligatorio.",
                },
            });

            if (form.valid() && $("#tipoDiagnostico").val() == "1") {
                var id_diagnostico = id;
                if (id_diagnostico) {
                    window.location.href = "diagnosticos/" + id_diagnostico;
                } else {
                    Swal.fire({
                        title: "Error!",
                        text: "No se pudo obtener el id del diagnostico.",
                        icon: "error",
                    });
                }
            }
        });
    }
}
