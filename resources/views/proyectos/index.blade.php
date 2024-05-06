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
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Informacion de Proyectos / Procesos</a></li>
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
                    <a href="{{ route('proyectos.create') }}" class="btn btn-info mb-2 ">Crear Nuevo</a>
                    <div class="table-responsive py-2">
                        <table id="proyecto" class="table table-striped align-items-center table-hover w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Fecha Estimada</th>
                                    <th scope="col">Avance</th>
                                    <th scope="col">Prioridad</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($datatable))
                                    @foreach ($datatable as $item)
                                        <tr>
                                            <td><img src="../assets/img/images/grupo.png"
                                                    class="avatar avatar-md bg-transparent "></td>
                                            <td>{{ $item->nombre }}</td>
                                            <td>{{ $item->areas?->nombre }}</td>
                                            <td>{{ $item->fecha_estimada->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="progress text-dark " style="height:10px;">
                                                    <div class="progress-bar progress-bar-striped bg-success"
                                                        role="progressbar"
                                                        style="width:{{ is_null($item->avance) ? 0 : $item->avance }}%;"
                                                        aria-valuenow="{{ is_null($item->avance) ? 0 : $item->avance }}"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>{{ is_null($item->avance) ? 0 : $item->avance }}%
                                            </td>
                                            <td>{{ $item->prioridades?->nombre }}</td>
                                            <td>
                                                @switch($item->estado)
                                                    @case(2)
                                                        <span class="badge badge-warning">En curso</span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge badge-success">Finalizado</span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-danger">Pendiente</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <a class="nav-link pr-0" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                                    <h6 class="dropdown-header" style="color: rgba(0,0,0,.72) !important;">
                                                        Gestionar</h6>
                                                    <a href="{{ route('actividades.show', $item->id) }}"
                                                        class="dropdown-item font-dropdown-documento">
                                                        <i class="fas fa-folder-plus"></i>
                                                        <span>Crear Actividad</span>
                                                    </a>
                                                    <a data-toggle="modal" data-target="#actividadesExistentes"
                                                        class="dropdown-item text-dark "
                                                        onclick="ModalActividad('{{ $item->id }}')">
                                                        <i class="far fa-folder-open"></i>
                                                        <span> Ver Actividades</span>
                                                    </a>
                                                    <a href="{{ route('proyectos.edit', $item->id) }}"
                                                        class="dropdown-item font-dropdown-documento">
                                                        <i class="far fa-edit"></i>
                                                        <span>Editar</span>
                                                    </a>
                                                    <a href="#" class="dropdown-item font-dropdown-documento"
                                                        onclick="AlertRegistro('{{ $item->id }}')">
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
    <!-- Modal de Actividades -->
    <div class="modal fade" id="actividadesExistentes" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                <div class="modal-body" id="actividades">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="../scripts/proyectos/datatable.js"></script>
    <script>
        function AlertRegistro(id) {
            $('#actividadesExistentes').modal('hide');
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
                        url: '/proyectos/' + id,
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
        function AlertActividades(id) {
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
                        url: '/actividades/' + id,
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
