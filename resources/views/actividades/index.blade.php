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
                                <li class="breadcrumb-item"><a href="?view=diagnostico">Informacion de Actividades /
                                        Procesos</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">{{$proyecto->nombre}}
                                </li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="{{ route('proyectos.index') }}" class="btn btn-transparent py-2 px-3">
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
                    <a href="{{ route('proyectos.create_activi', $proyecto->id) }}" class="btn btn-info mb-2 ">Crear Actividad</a>
                    <livewire:actividades-datatable :idProyecto="$proyecto->id"/>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if (session('success'))
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('success') }}",
                icon: "{{ session('icon') }}"
            });
        </script>
    @endif
@endsection
