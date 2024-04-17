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
                                <li class="breadcrumb-item"><a href="{{ route('proderiAdmi') }}"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Reportes</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Area Administrativa</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="{{ route('proderiAdmi') }}" class="btn btn-transparent py-2 px-3">
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
            <div class="col-xl-12">
                <iframe title="Operaciones" class="rounded" width="100%" height="720" src="
                https://app.powerbi.com/view?r=eyJrIjoiMTE0ZmM2MWYtZjZhNy00Y2JhLThiNzktMTkyMzE1ZTY1MDRiIiwidCI6ImE3MDViNGI5LWE3Y2UtNDA3YS04YTdlLTY0NThlYjVkZDQxNiJ9"
                frameborder="0" allowFullScreen="true"></iframe>
            </div>
        </div>
    </div>
    
@endsection
