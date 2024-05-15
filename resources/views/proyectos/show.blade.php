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
                                <li class="breadcrumb-item"><a href="{{ route('proyectos.index') }}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Nombre del Proyecto:</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">{{ $proyecto->nombre }}
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
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 bg-white rounded mb-4 card ">
                <div class="mt-4 p-2 mr-2">
                    <h6 class="heading-small text-muted mb-0">Información del Nuevo Proyecto
                    </h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="nombres">Nombre del Proyecto</label>
                                    <input type="text" id="nombres" name="nombre" class="form-control"
                                        placeholder="Ingrese El Nombre de Su Proyecto" value="{{$proyecto->nombre}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="area">Area</label>
                                    <input type="text" id="nombres" name="nombre" class="form-control"
                                        placeholder="Ingrese El Nombre de Su Proyecto" value="{{$proyecto->areas->nombre}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" id="estimada">
                                <div class="form-group">
                                    <label class="form-control-label" for="fecha_estimada">Fecha Estimada de
                                        Finalizacion</label>
                                    <input type="date" id="fecha_estimada" name="fecha_estimada"
                                        class="form-control mb-2" value="{{ $proyecto->fecha_estimada }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="prioridad">Prioridad</label>
                                    <input name="prioridad" id="prioridad" class="form-control" value="{{$proyecto->prioridades->nombre}}" readonly></input>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="fechas">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="fecha_estimada">Fecha Inicial</label>
                                            <input type="date" id="fecha_inicio" name="fecha_inicio"
                                                class="form-control mb-2" placeholder="Dirección"
                                                value="{{$proyecto->fecha_inicio }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="fecha_estimada">Fecha Final</label>
                                            <input type="date" id="fecha_final" name="fecha_final"
                                                class="form-control mb-2" placeholder="Dirección"
                                                value="{{ $proyecto->fecha_final }}" readonly>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label  " for="avance">Porcentace de Avance</label>
                                    <div class="progress mt-2 " style="height: 20px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                            role="progressbar" style="width:{{$proyecto->avance}}%;" aria-valuenow="{{$proyecto->avance}}" aria-valuemin="0"
                                            aria-valuemax="100">{{$proyecto->avance}}%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="descripcion">Descripcion</label>
                                    <textarea type="text" id="descripcion" name="descripcion" class="form-control"
                                        placeholder="Descripcion del Proyecto" rows="5" readonly>{{ $proyecto->descripcion }}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                    </div>
                    <h3>Galeria de Imagenes</h3>
                    <div class="row">
                        @if (is_null($proyecto->imagenes))
                            <div class="col-lg-12">
                                <div class="alert bg-gradient-info" role="alert">
                                    <i class="fas fa-info-circle"></i> <strong>Informacion!</strong> No se han subido imagenes para este proyecto.
                                </div>
                            </div>
                            @else
                            @foreach ($proyecto->imagenes as $imagen)
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <a href="/imagen/{{ $imagen }}" class="withDescriptionGlightbox glightbox-content">
                                    <img src="/imagen/{{ $imagen }}" alt="image" class="img-fluid" style="width:350px; height:250px; object-fit: cover;"/>
                                </a>
                            </div>
                        @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
