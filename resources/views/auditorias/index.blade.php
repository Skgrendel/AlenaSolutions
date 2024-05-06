@extends('layouts.page.dashboard')

@section('content')
    <!-- Encabezado -->
    <div class="header bg-gradient-info rounded  pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-8">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Informacion de Diagnosticos</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Home
                                </li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="{{ route('home') }}" class="btn btn-transparent py-2 px-3">
                                    <span class="d-none d-md-block">Volver</span>
                                    <span class="d-md-none"><i class="fas fa-arrow-left"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- Contenido -->
    <div id="contenedorFullPreguntas" class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 bg-white rounded mb-4 card ">
                <div class="mt-4 p-2 mr-2">
                    <a href="{{ route('auditorias.create') }}" class="btn btn-info mb-2 ">Crear Nuevo</a>
                    <div class="table-responsive py-2">
                        <table id="grupodiagnostico" class="table table-striped align-items-center table-hover w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Grupo</th>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Fecha Creacion</th>
                                    <th scope="col">Total Diagnosticos</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($datatable))
                                    @foreach ($datatable as $item)
                                        <tr>
                                            <td><img src="../assets/img/images/grupo.png"
                                                    class="avatar avatar-md bg-transparent "></td>
                                            <td>{{ $item->nombre_empresa }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td></td>
                                            <td>
                                                <a class="nav-link pr-0" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                                    <h6 class="dropdown-header" style="color: rgba(0,0,0,.72) !important;">
                                                        Gestionar</h6>
                                                    <a data-toggle="modal" data-target="#crearDiagnostico"
                                                        class="dropdown-item font-dropdown-documento">
                                                        <i class="fas fa-folder-plus"></i>
                                                        <span>Crear Diagnostico</span>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#actividadesExistentes"
                                                        class="dropdown-item font-dropdown-documento"
                                                        onclick="ModalDiagnostico('{{ $item->id }}')">
                                                        <i class="far fa-folder-open"></i>
                                                        <span> Ver Diagnosticos</span>
                                                    </a>
                                                    <a href="{{ route('auditorias.edit', $item->id) }}"
                                                        class="dropdown-item font-dropdown-documento">
                                                        <i class="far fa-edit"></i>
                                                        <span>Editar</span>
                                                    </a>
                                                    <a href="#" class="dropdown-item font-dropdown-documento"
                                                        onclick="Grupos('{{ $item->id }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <span>Eliminar</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de diagnosticos -->
    <div class="modal fade" id="crearDiagnostico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-6">
                        <h4 class="">Crear Nuevo Diagnostico</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" id="diagnosticos">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 40 40"
                        id="Insert-Top-Left--Streamline-Core" height="40" width="40">
                        <desc>Insert Top Left Streamline Icon: https://streamlinehq.com</desc>
                        <g id="insert-top-left--alignment-wrap-formatting-paragraph-image-left-text">
                            <path id="Union" fill="#000000" fill-rule="evenodd"
                                d="M26.42857142857143 0.7142857142857143c-1.183457142857143 0 -2.142857142857143 0.9593885714285714 -2.142857142857143 2.142857142857143 0 1.183457142857143 0.9593999999999999 2.142857142857143 2.142857142857143 2.142857142857143h11.428571428571429c1.1834285714285715 0 2.142857142857143 -0.9593999999999999 2.142857142857143 -2.142857142857143 0 -1.1834685714285715 -0.9594285714285714 -2.142857142857143 -2.142857142857143 -2.142857142857143h-11.428571428571429ZM2.857142857142857 1.427177142857143c-1.577957142857143 0 -2.857142857142857 1.2791857142857141 -2.857142857142857 2.8571371428571433v14.285714285714286c0 1.5779714285714284 1.2791857142857141 2.857142857142857 2.857142857142857 2.857142857142857h14.285714285714286c1.577942857142857 0 2.857142857142857 -1.2791714285714286 2.857142857142857 -2.857142857142857v-14.285714285714286c0 -1.5779514285714284 -1.2792000000000001 -2.8571371428571433 -2.857142857142857 -2.8571371428571433H2.857142857142857ZM24.285714285714285 11.428571428571429c0 -1.183457142857143 0.9593999999999999 -2.142857142857143 2.142857142857143 -2.142857142857143h11.428571428571429c1.1834285714285715 0 2.142857142857143 0.9593999999999999 2.142857142857143 2.142857142857143s-0.9594285714285714 2.142857142857143 -2.142857142857143 2.142857142857143h-11.428571428571429c-1.183457142857143 0 -2.142857142857143 -0.9593999999999999 -2.142857142857143 -2.142857142857143Zm2.142857142857143 6.428571428571429c-1.183457142857143 0 -2.142857142857143 0.9593999999999999 -2.142857142857143 2.142857142857143s0.9593999999999999 2.142857142857143 2.142857142857143 2.142857142857143h11.428571428571429c1.1834285714285715 0 2.142857142857143 -0.9593999999999999 2.142857142857143 -2.142857142857143s-0.9594285714285714 -2.142857142857143 -2.142857142857143 -2.142857142857143h-11.428571428571429ZM0 28.571428571428573c0 -1.183457142857143 0.9593885714285714 -2.142857142857143 2.142857142857143 -2.142857142857143h35.714285714285715c1.1834285714285715 0 2.142857142857143 0.9593999999999999 2.142857142857143 2.142857142857143 0 1.1834285714285715 -0.9594285714285714 2.142857142857143 -2.142857142857143 2.142857142857143H2.142857142857143c-1.1834685714285715 0 -2.142857142857143 -0.9594285714285714 -2.142857142857143 -2.142857142857143Zm2.142857142857143 6.428571428571429c-1.1834685714285715 0 -2.142857142857143 0.9594285714285714 -2.142857142857143 2.142857142857143s0.9593885714285714 2.142857142857143 2.142857142857143 2.142857142857143h35.714285714285715c1.1834285714285715 0 2.142857142857143 -0.9594285714285714 2.142857142857143 -2.142857142857143s-0.9594285714285714 -2.142857142857143 -2.142857142857143 -2.142857142857143H2.142857142857143Z"
                                clip-rule="evenodd" stroke-width="1"></path>
                        </g>
                    </svg>
                    <h4 class="text-center mt-3 ">¿Que tipo de diagnostico va a elegir?</h4>
                    <div class="col-12 mx-auto" style="width: 300px;">
                        <form id="formTipoDiagnostico" method="POST">
                            <div class="form-group">
                                <div class="dropdown bootstrap-select show-tick bg-white form-control"><select
                                        class="selectpicker bg-white show-tick form-control" data-container="body"
                                        data-header="Seleccione el tipo de prueba" id="tipoDiagnostico"
                                        name="tipoDiagnostico" title="Seleccione el tipo de diagnostico"
                                        data-style="btn-neutral font-weight-400" required="" tabindex="-98">
                                        <optgroup data-divider="false" label="Recientes">
                                            <option value="1"
                                                data-content="<span> Auditoria Sagrilaf.</span> <small class='text-muted'>">
                                            </option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="modal-footer mt-3 ">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" id="btnComenzarDiagnostico"
                                        class="btn btn-info">Comenzar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Actividades -->
    <div class="modal fade" id="diagnosticosexistentes" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-6">
                        <h4 class="mb-0">Proyectos / Procesos</h4>
                        <p class="text-sm mb-0">Actividades que pertenecen a este Proyecto / Proceso.</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="diagnosticos">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="../scripts/auditorias/datatable.js"></script>
    <script>
        $('#btnComenzarDiagnostico').on("click", function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $('#formTipoDiagnostico');
            form.validate({
                rules: {
                    tipoDiagnostico: {
                        required: true
                    },
                },
                messages: {
                    tipoDiagnostico: 'Este campo es obligatorio.',
                }
            });

            if (form.valid() && $('#tipoDiagnostico').val() == "1") {
                window.location.href = "{{ route('auditorias.create') }}";
            }
        });
    </script>
    <script>
        function Grupos(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2DCE89',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, bórralo!',
                cancelButtonText: 'No, cancelar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/auditorias/' + id,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(result) {
                            // Recarga la página o haz algo cuando la eliminación sea exitosa
                            location.reload();
                            Swal.fire({
                                title: 'Éxito',
                                text: result.success,
                                icon: 'success'
                            });
                        },
                        error: function(result) {
                            // Muestra un mensaje de error si algo sale mal
                            Swal.fire('Error!', 'No se pudo eliminar el registro.', 'error');
                        }
                    });
                }
            })
        }
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('success') }}",
                icon: "{{ session('icon') }}"
            });
        @endif
    </script>
@endsection
