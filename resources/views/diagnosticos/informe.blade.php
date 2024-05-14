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
                                <li class="breadcrumb-item"><a href="{{ route('auditorias.index') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Informacion de Diagnosticos</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Informes Consolidados
                                </li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="{{ route('auditorias.index') }}" class="btn btn-transparent py-2 px-3">
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
            <div class="col-lg-4">
                <div class="card border-0 bg-secondary" style="background: #a29bfe;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title mb-0">Creador diagnostico</h4>
                                <span class="mb-0 text-sm">{{ $Grupodiagnostico->user->personal->nombres }}
                                    {{ $Grupodiagnostico->user->personal->apellidos }}</span>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="icon icon-shape bg-white text-dark rounded-circle shadow"
                                    data-toggle="tooltip" title="" data-original-title="Creador del diagnostico">
                                    <i class="fas fa-user-tie fa-2x text-success" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="mt-2 mb-0 text-sm">
                            <span class="text-nowrap"><i class="fas fa-envelope" aria-hidden="true"></i>
                                {{ $Grupodiagnostico->user->personal->correo }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 bg-secondary" style="background: #a29bfe;">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title mb-0">Empresa asociada</h4>
                                <span class="mb-0 nombreEmpresa">{{ $Grupodiagnostico->nombre_empresa }}</span>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="icon icon-shape bg-white text-dark rounded-circle shadow"
                                    data-toggle="tooltip" title="" data-original-title="Empresa asociada">
                                    <i class="fas fa-building text-primary" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="mt-2 mb-0 text-sm">
                            <span class="text-nowrap"><i class="fas fa-address-card" aria-hidden="true"></i> NIT: <span
                                    class="nitEmpresa">{{ $Grupodiagnostico->nit_empresa }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 bg-secondary" style="background: #a29bfe;">
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title mb-0">Grupo perteneciente</h4>
                                <span class="mb-0 nombreGrupoDiag">{{ $Grupodiagnostico->nombre_grupo }} </span>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="icon icon-shape bg-white text-dark rounded-circle shadow"
                                    data-toggle="tooltip" title=""
                                    data-original-title="Grupo al cual pertenece este diagnostico">
                                    <i class="fas fa-folder-open text-yellow" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="mt-2 mb-0 text-sm">
                            <span class="text-nowrap"><i class="fas fa-layer-group" aria-hidden="true"></i>Fecha Creacion:
                                <span class="fechaCreacion">{{ $Grupodiagnostico->created_at->format('d-m-Y') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Card de la descripcion -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0 h4">Nombre del Diagnostico</h3>
                                        <p class="text-sm ">{{ $diagnostico->nombre }}</p>
                                    </div>
                                    <div class="col-4 text-right">
                                        <!-- <a href="#!" class="btn btn-sm btn-primary"></a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="mb-0 h4">Objetivos</h3>
                                        @if ($diagnostico->objetivo != null)
                                            <span class="descripcionDiagnostico mb-0"
                                                style="font-size: .8625rem;">{{ $diagnostico->objetivo }}</span>
                                        @else
                                            <span class="descripcionDiagnostico mb-0" style="font-size: .8625rem;">No se
                                                especificó un
                                                objetivo para este diagnostico.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                               
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Card de los hallazgos -->
            <div class="col-md-12" id="divHallazgos">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0 h4">Informe Consolidado</h3>
                                <h5 class="heading-md text-muted mb-4">El Informe es generados teniendo en cuenta las
                                    preguntas que
                                    fueron respondidas.</h5>
                            </div>
                            <div class="col-4">
                                <div class="row">
                                    <a href="#!" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        data-original-title="Descargar Informe"><i class="fas fa-download"></i></a>
                                    <a href="#!" class="btn btn-sm btn-secondary text-danger " data-toggle="tooltip"
                                        data-original-title="Descargar PDF"><i class="fas fa-file-pdf"></i></a>
                                    <a href="#!" class="btn btn-sm btn-secondary text-success "
                                        data-toggle="tooltip" data-original-title="Descargar Excel"><i
                                            class="fas fa-file-excel"></i></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Hallazgos -->
                        <div class="row">
                            {{-- @foreach ($promedios as $key => $promedio) <div class="col-md-6">
                                    <!-- Aqui se generan los hallazgos -->
                                    <div class="card shadow-lg ">
                                        <div class="card-body">
                                            <div id="moduloHallazgos" class="d-block-inline mb-2">
                                                <h3 class="mb-4">Modulo: {{ substr($key, 5) }} </h3>
                                                <h4 class="mb-4 text-xs">{{ $encabezadosArray[$key] ?? 'No disponible' }} </h4>
                                                <div class="row ml-md-3">
                                                    <div class="col-12">
                                                        <h4 class="mb-1">Calificacion:</h4>

                                                            @switch($promedio['promedio'])
                                                                @case(0)
                                                                    <span class="badge badge-secondary">NO APLICA</span>
                                                                @break

                                                                @case(1)
                                                                    <span class="badge badge-success">CUMPLIDO</span>
                                                                @break

                                                                @case(2)
                                                                    <span class="badge badge-success">MAYORITARIAMENTE CUMPLIDO</span>
                                                                @break

                                                                @case(3)
                                                                    <span class="badge badge-warning">PARCIALMENTE CUMPLIDO</span>
                                                                @break

                                                                @case(4)
                                                                    <span class="badge badge-danger">NO CUMPLIDO</span>
                                                                @break

                                                                @default
                                                                    <span class="badge badge-success">No Aplica</span>
                                                            @endswitch

                                                    </div>
                                                </div>
                                                <hr class="my-4">
                                            </div>
                                        </div>

                                    </div>
                                </div>   @endforeach --}}
                            <div class="table-responsive py-2">
                                <table id="resultados"
                                    class="table table-striped align-items-center table-hover table-bordered  w-100">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col"><strong>numeral</strong></th>
                                            </th>
                                            <th scope="col"><strong>Numero</strong></th>
                                            <th scope="col"><strong>Requisito</strong></th>
                                            <th scope="col"><strong>Cumplimineto tecnico</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($promedios))
                                            @foreach ($promedios as $key => $promedio)
                                                <tr>
                                                    <td><strong>{{ $numeralArray[$key] ?? 'No disponible' }}</strong></td>
                                                    <td><strong>{{ substr($key, 5) }}</strong></td>
                                                    <td>{{ $encabezadosArray[$key] ?? 'No disponible' }}</td>
                                                    <td>
                                                        @switch($promedio['promedio'])
                                                            @case(0)
                                                                <span class="alert alert-secondary text-xs">No Aplica</span>
                                                            @break

                                                            @case(1)
                                                                <span class="alert alert-success text-xs">Cumplido</span>
                                                            @break

                                                            @case(2)
                                                                <span class="alert text-xs"
                                                                    style="background-color: #17a847; color: #000000;"
                                                                    role="alert">
                                                                    Mayoritariamente Cumplido
                                                                </span>
                                                                {{-- <span class="badge badge-success">MAYORITARIAMENTE CUMPLIDO</span> --}}
                                                            @break

                                                            @case(3)
                                                                <span class="alert text-xs"
                                                                    style="background-color: #ffc107; color: #000000;">Parcialmente
                                                                    Cumplido</span>
                                                            @break

                                                            @case(4)
                                                                <span class="alert text-xs"
                                                                    style="background-color: #d42a13e5; color: #000000;">No
                                                                    Cumplido</span>
                                                            @break

                                                            @default
                                                                <span class="alert alert-success">No Aplica</span>
                                                        @endswitch
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <!-- Fin de los hallazgos -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $("#resultados").DataTable({
                responsive: true,
                pageLength: 13,
                lengthMenu: [13, 26, 52],
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
                        sortAscending: ": activar para ordenar la columna de manera ascendente",
                        sortDescending: ": activar para ordenar la columna de manera descendente",
                    },
                },
            });
        });
    </script>
@endsection
