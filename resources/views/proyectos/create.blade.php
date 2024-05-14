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
                                <li class="breadcrumb-item"><a href="">Registro de Proyectos / Procesos</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Nuevo</li>
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
                    <form id="proyectosForm" action="{{ route('proyectos.store') }}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-0">Información del Nuevo Proyecto que Desea Registrar
                        </h6>
                        <p class="small mb-4"><i class="fas fa-info-circle"></i> Por favor, asegúrate de llenar todos los
                            campos requeridos marcados con <span class="text-danger">*</span> y verificar la información
                            antes de enviar el formulario.</p>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nombres">Nombre del Proyecto <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nombres" name="nombre" class="form-control"
                                            placeholder="Ingrese El Nombre de Su Proyecto" required
                                            value="{{ old('nombre') }}">
                                        @if ($errors->has('nombre'))
                                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="area">Area<span class="text-danger">
                                                *</span></label>
                                        <select name="area" id="area" class="form-control" required>
                                            <option value=""selected disabled>Seleccione su Area</option>
                                            @foreach ($areas as $id => $nombre)
                                                <option value="{{ $id }}"
                                                    {{ Auth::user()->personal->area == $id ? 'selected' : '' }}>
                                                    {{ $nombre }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('area'))
                                            <span class="text-danger">{{ $errors->first('area') }}</span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6" id="estimada">
                                    <div class="form-group">
                                        <label class="form-control-label" for="fecha_estimada">Fecha Estimada de Finalizacion</label>
                                        <input type="date" id="fecha_estimada" name="fecha_estimada" class="form-control mb-2"
                                            placeholder="Dirección" value="{{ old('fecha_estimada') }}">
                                        @if ($errors->has('fecha_estimada'))
                                            <span class="text-danger">{{ $errors->first('fecha_estimada') }}</span>
                                        @endif
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="finalizado" name="finalizado">
                                            <label class="form-check-label" for="defaultCheck1">
                                               Finalizado
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="prioridad">Prioridad<span
                                                class="text-danger">*</span></label>
                                        <select name="prioridad" id="prioridad" class="form-control" required>
                                            <option value="" disabled selected>Seleccione su Prioridad</option>
                                            @foreach ($prioridades as $id => $nombre)
                                                <option value="{{ $id }}"
                                                    {{ old('prioridad') == $id ? 'selected' : '' }}>{{ $nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('prioridad'))
                                            <span class="text-danger">{{ $errors->first('prioridad') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none" id="fechas">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="fecha_estimada">Fecha Inicial</label>
                                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control mb-2"
                                                    placeholder="Dirección" value="{{ old('fecha_estimada') }}">
                                                @if ($errors->has('fecha_inicio'))
                                                    <span class="text-danger">{{ $errors->first('fecha_inicio') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="fecha_estimada">Fecha Final</label>
                                                <input type="date" id="fecha_final" name="fecha_final" class="form-control mb-2"
                                                    placeholder="Dirección" value="{{ old('fecha_estimada') }}">
                                                @if ($errors->has('fecha_inicio'))
                                                    <span class="text-danger">{{ $errors->first('fecha_final') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label class="form-control-label" for="descripcion">Descripcion<span
                                                class="text-danger"> *</span></label>
                                        <textarea type="text" id="descripcion" name="descripcion" class="form-control"
                                            placeholder="Descripcion del Proyecto" rows="5" required value="{{ old('descripcion') }}"></textarea>
                                        @if ($errors->has('descripcion'))
                                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <button type="submit" id="btnCrearActividad" class="btn btn-info mb-2">Crear
                                Proyecto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>
    document.getElementById('finalizado').addEventListener('change', function(e) {
        var fecha = document.getElementById('fecha_estimada');
        var fechas = document.getElementById('fechas');
        var fecha_inicio = document.getElementById('fecha_inicio');
        var fecha_final = document.getElementById('fecha_final');

        if (e.target.checked) {
            fecha.disabled = true;
            fechas.classList.remove('d-none');
        } else {
            fecha.disabled = false;
            fechas.classList.add('d-none');
            fecha_inicio.value = '';
            fecha_final.value = '';
        }
    });
</script>

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
