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
                                <li class="breadcrumb-item text-dark active" aria-current="page">Informes Consolidados
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
            <div class="col-lg-4">
                <div class="card border-0 bg-secondary" style="background: #a29bfe;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title mb-0">Creador del diagnostico</h4>
                                <span class="mb-0 nombreCreadorDiagnostico">Eliecer Carrascal Asis</span>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="icon icon-shape bg-white text-dark rounded-circle shadow"
                                    data-toggle="tooltip" title="" data-original-title="Creador del diagnostico">
                                    <i class="fas fa-user-tie fa-2x text-success" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="mt-2 mb-0 text-sm">
                            <span class="text-nowrap"><i class="fas fa-wifi" aria-hidden="true"></i> Ultima conexión: <span
                                    class="ultimaConexionCreadorDiagnostico">Hace 33 segundos</span>
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
                                <span class="mb-0 nombreEmpresa">Triple A</span>
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
                                    class="nitEmpresa">000000000</span>
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
                                <span class="mb-0 nombreGrupoDiag">Análisis Triple A </span>
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
                            <span class="text-nowrap"><i class="fas fa-layer-group" aria-hidden="true"></i> Total
                                diagnosticos: <span class="totalDiagnosticosGrupo">29</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Card de la descripcion -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0 h4">Objetivo</h3>
                                <p class="text-sm ">Objetivo del diagnostico</p>
                            </div>
                            <div class="col-4 text-right">
                                <!-- <a href="#!" class="btn btn-sm btn-primary"></a> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">

                                <span class="descripcionDiagnostico mb-0" style="font-size: .8625rem;">No se especificó un
                                    objetivo para este diagnostico.</span>

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
                            </div>
                            <div class="col-4 text-right">
                                <!-- <a href="#!" class="btn btn-sm btn-primary"></a> -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Hallazgos -->
                        <h5 class="heading-md text-muted mb-4">Los hallazgos son generados teniendo en cuenta las preguntas que fueron respondidas con un <span class="font-weight-bold">No cumple</span>.</h5>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <!-- Aqui se generan los hallazgos -->
                                <div class="contentHallazgos">
                                    <div id="moduloHallazgos30" class="d-block-inline mb-6">
                                        <h3 class="mb-4">Módulo 1 </h3>
                                        <div class="row ml-md-3">
                                            <div class="col-12 mb-3">
                                                <h4 class="mb-0">Descripcion: </h4>
                                                <span class="text-sm mb-0">La cantidad de cámaras no es adecuada para
                                                    cumplir su tarea principal enfocada a la prevención de incidentes</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mb-1">Calificacion</h4>

                                                <div id="container-images-328" class="grid-container">

                                                </div>


                                            </div>
                                        </div>

                                        <hr class="my-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
