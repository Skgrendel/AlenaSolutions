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
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Tabla de Personal</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Informacion de Registros
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
                <div class="card-body mt-4 p-2 mr-2">
                    <a href="{{ route('personals.create') }}" class="btn btn-info mb-2 ">Crear Nuevo</a>
                    <table id="personal" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>Tipo Documento</th>
                                <th>Numero Documento</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($datatable))
                                @foreach ($datatable as $item)
                                    <tr>
                                        <td>{{ $item->tipo_documento }}</td>
                                        <td>{{ $item->numero_documento }}</td>
                                        <td>{{ $item->nombres }}</td>
                                        <td>{{ $item->apellidos }}</td>
                                        <td>{{ $item->correo }}</td>
                                        <td>
                                            @if ($item->estado == 1)
                                                <span class="badge badge-success text-md">Activo</span>
                                            @else
                                                <span class="badge badge-danger text-md">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>

                                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left">
                                                <a href="{{ route('personals.show', $item->id) }}" class="dropdown-item">
                                                    <i
                                                        class="fas fa-eye
                                                        "></i>
                                                    <span>Ver</span>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ route('personals.edit', $item->id) }}" class="dropdown-item">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Editar</span>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item"
                                                    onclick="AlertRegistro('{{ $item->id }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <span>Eliminar</span>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="6">No hay registros</td>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="../scripts/personal/datatable.js"></script>
    <script src="../scripts/personal/AlertEliminar.js"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: "{{ session('tittle') }}",
                text: "{{ session('success') }}",
                icon: "{{ session('icon') }}"
            });
        @endif
    </script>
@endsection
