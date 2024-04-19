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
                                <li class="breadcrumb-item"><a href="">Registro de Actividades</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Nueva Actividad</li>
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
                    <form id="proyectosForm" action="{{ route('actividades.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                        <h5 class="heading  mb-0">Proyecto: {{$proyecto->nombre}}</h5>
                        <h6 class="heading-small text-muted mb-0">Información de la Actividad Nueva que Desea Registrar</h6>
                        <p class="small mb-4"><i class="fas fa-info-circle"></i> Por favor, asegúrate de llenar todos los
                            campos requeridos marcados con <span class="text-danger">*</span> y verificar la información
                            antes de enviar el formulario.</p>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nombres">Nombre de la Actividad <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nombres" name="nombre" class="form-control"
                                            placeholder="Ingrese El Nombre de Su Actividad" required value="{{ old('nombre') }}" >
                                        @if ($errors->has('nombre'))
                                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="personal_asignado">Nombre de la persona Asignada <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="personal_asignado" name="personal_asignado" class="form-control"
                                            placeholder="Ingrese El Nombre de Su Actividad" required value="{{ old('nombre') }}" >
                                        @if ($errors->has('nombre'))
                                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="fecha_estimada">Fecha Estimada</label>
                                        <input type="date" id="fecha_estimada" name="fecha_estimada" class="form-control"
                                            placeholder="Dirección" value="{{ old('fecha_estimada') }}">
                                        @if ($errors->has('fecha_estimada'))
                                            <span class="text-danger">{{ $errors->first('fecha_estimada') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="prioridad">Prioridad<span class="text-danger">*</span></label>
                                        <select name="prioridad" id="prioridad" class="form-control" required>
                                            <option value="" disabled selected>Seleccione su Prioridad</option>
                                            @foreach ($prioridades as $id => $nombre)
                                                <option value="{{ $id }}" {{ old('prioridad') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('prioridad'))
                                            <span class="text-danger">{{ $errors->first('prioridad') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="avance">Avance de Actividad</label>
                                        <input type="number" id="avance" name="avance" class="form-control"
                                            placeholder="Ingrese El Numero de  Avance de Su Actividad" min="0" max="999" required value="{{ old('avance') }}" >
                                        @if ($errors->has('avance'))
                                            <span class="text-danger">{{ $errors->first('avance') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label  " for="avance">Porcentace de Avance</label>
                                        <div class="progress mt-2 " style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width:0%;"
                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="descripcion">Descripción<span
                                                class="text-danger"> *</span></label>
                                        <textarea type="text" id="descripcion" name="descripcion" class="form-control"
                                            placeholder="Descripcion de actividad" rows="5" required value="{{ old('descripcion') }}"></textarea>
                                        @if ($errors->has('descripcion'))
                                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="descripcion">Observaciones</label>
                                        <textarea type="text" id="observaciones" name="observaciones" class="form-control"
                                            placeholder="Observacion de actividad" rows="5" required value="{{ old('observaciones') }}"></textarea>
                                        @if ($errors->has('observaciones'))
                                            <span class="text-danger">{{ $errors->first('observaciones') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="estado">Estado de La Actividad<span class="text-danger">*</span></label>
                                        <select name="estado" id="estado" class="form-control" required>
                                            <option value="" disabled selected>Seleccione su Estado</option>
                                            @foreach ($estados as $id => $nombre)
                                                <option value="{{ $id }}" {{ old('estado') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('estado'))
                                            <span class="text-danger">{{ $errors->first('estado') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <button type="submit" id="btnCrearActividad" class="btn btn-info mb-2">Crear Actividad</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.getElementById('avance').addEventListener('input', function(e) {
        var value = e.target.value;
        if (value === '') {
            value = 0;
        }
        var progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = value + '%';
        progressBar.setAttribute('aria-valuenow', value);
        progressBar.textContent = value + '%';
    });
</script>
@endsection
