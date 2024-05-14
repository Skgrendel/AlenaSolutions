$(document).ready(function () {
    $("#proyecto").DataTable({
        responsive: true,
        pageLength: 5,
        lengthMenu: [5, 10, 15, 20],
        order: [ 0, "desc" ],
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

function ModalActividad(id) {
    if (id) {
        $.ajax({
            url: "/proyectos/actividades/" + id,
            type: "GET",
            success: function (response) {
                let tableContent = "";
                const editBaseUrl = "/actividades/";
                const edit = "/edit";

                if (response.length > 0) {
                    response.forEach((element) => {
                        let badge;
                        let estado = Number(element.estado);
                        switch (estado) {
                            case 2:
                                badge =
                                    '<span class="badge badge-warning">En curso</span>';
                                break;
                            case 3:
                                badge =
                                    '<span class="badge badge-success">Finalizado</span>';
                                break;
                            default:
                                badge =
                                    '<span class="badge badge-danger">Pendiente</span>';
                        }



                        tableContent += `
            <tr>
                <td><img src="../assets/img/images/grupo.png" class="avatar avatar-md bg-transparent "></td>
                <td>${element.nombre}</td>
                <td>${element.personal_asignado}</td>
                <td>${element.fecha_estimada ? element.fecha_estimada : 'Sin Fecha'}</td>
                <td>${element.fecha_inicio ? element.fecha_inicio : 'sin Fecha'}</td>
                <td>${element.fecha_final ? element.fecha_final : 'sin Fecha'}</td>
                <td>
                    <div class="progress text-dark " style="height:10px;">
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                            style="width:${element.avance}%;"
                            aria-valuenow="${
                                element.avance
                            }" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>${element.avance}%
                </td>
                <td>${element.prioridades.nombre}</td>
                <td>
                    ${badge}
                </td>
                <td>
                    <a class="nav-link pr-0" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                        <h6 class="dropdown-header" style="color: rgba(0,0,0,.72) !important;">Gestionar</h6>
                        <a href="${
                            editBaseUrl + element.id + edit
                        }" class="dropdown-item text-dark ">
                            <i class="far fa-folder-open"></i>
                            <span>Modificar</span>
                        </a>
                        <a href="#" onclick="$('#actividadesExistentes').modal('hide'); AlertActividades(${
                            element.id
                        });" class="dropdown-item font-dropdown-documento">
                            <i class="fas fa-trash-alt"></i>
                            <span>Eliminar</span>
                        </a>
                </td>
            </tr>
        `;
                    });
                } else {
                    tableContent = '<td colspan="8">No hay registros</td>';
                }
                $("#actividades").html(`
    <div class="table-responsive py-2">
        <table class="table table-striped align-items-center table-hover w-100" id="myTableActividades">
            <thead class="thead-light">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Personal Asignado</th>
                    <th scope="col">Fecha Estimada</th>
                    <th scope="col">Fecha Inicio</th>
                    <th scope="col">Fecha Final</th>
                    <th scope="col">Avance</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Estado</th>
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
                $("#myTableActividades").DataTable({
                    responsive: true,
                    pageLength: 5,
                    lengthMenu:  [5, 10, 15, 20],
                    order: [ 0, "desc" ],
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
