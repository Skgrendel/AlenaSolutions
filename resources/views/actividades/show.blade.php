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
                                <li class="breadcrumb-item"><a href="javascript:void(0);" onclick="window.history.back();"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="">Ver de Actividades</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Actividades</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a href="javascript:void(0);" onclick="window.history.back();"
                                    class="btn btn-transparent py-2 px-3">
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
                    <h5 class="heading  mb-0">Proyecto: {{ $proyecto->nombre }}</h5>
                    <h6 class="heading-small text-muted mb-0">Información de la Actividad</h6>
                    <p class="small mb-4"><i class="fas fa-info-circle"></i> Estás viendo los detalles de la actividad. Asegúrate de revisar toda la información antes de continuar.</p>

                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="nombres">Nombre de la Actividad</label>
                                    <div class="alert border border-info  font-weight-bold bg-white">
                                        {{ $actividades->nombre }}
                                    </div>
                                    @if ($errors->has('nombre'))
                                        <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="personal_asignado">Nombre de la persona
                                        Asignada </label>
                                    <div class="alert border border-info font-weight-bold bg-white">
                                        {{ $actividades->personal_asignado }}
                                    </div>
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
                                    <div class="alert border border-info font-weight-bold bg-white">
                                        {{ $actividades->fecha_estimada }}
                                    </div>
                                    @if ($errors->has('fecha_estimada'))
                                        <span class="text-danger">{{ $errors->first('fecha_estimada') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="prioridad">Prioridad</label>
                                    <div class="alert border border-info font-weight-bold bg-white">
                                        {{ $prioridades[$actividades->prioridad] ?? 'No especificado' }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="avance">Porcentace de Avance</label>
                                    <div class="progress mt-2 " style="height: 20px;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                            role="progressbar" style="width:0%;" aria-valuenow="0" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="descripcion">Descripción</label>
                                    <div class="alert border border-info font-weight-bold bg-white">
                                        {{ $actividades->descripcion }}
                                    </div>
                                    @if ($errors->has('descripcion'))
                                        <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="descripcion">Observaciones</label>
                                        <div class="alert border border-info font-weight-bold bg-white">
                                            {{ $actividades->observaciones }}
                                        </div>
                                    @if ($errors->has('observaciones'))
                                        <span class="text-danger">{{ $errors->first('observaciones') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <!-- Mostrar archivos actuales -->
                        <h6 class="heading-small text-muted mb-3">Evidencias Adjuntas</h6>
                        <div class="form-group">
                            @php
                                // Decodificar la lista de evidencias (archivos adjuntos) desde JSON
                                $evidencias = json_decode($actividades->evidencias, true) ?? [];
                            @endphp
                            @if (!empty($evidencias))
                                <ul class="list-group">
                                    @foreach ($evidencias as $index => $archivo)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ Storage::disk('s3')->temporaryUrl($archivo, \Carbon\Carbon::now()->addMinutes(5)) }}"
                                                target="_blank" download>
                                                📄 {{ basename($archivo) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No hay Evidencias adjuntas.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('avance').addEventListener('input', function() {
            if (this.value > 100) {
                this.value = 100;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var avance = {{ $actividades->avance }}; // Valor actual en la base de datos
            var progressBar = document.querySelector('.progress-bar');
            var inputAvance = document.getElementById('avance');

            // Configurar la barra de progreso
            progressBar.style.width = avance + '%';
            progressBar.setAttribute('aria-valuenow', avance);
            progressBar.textContent = avance + '%';

            // Permitir que el usuario borre y edite el valor
            inputAvance.addEventListener('blur', function() {
                if (this.value !== '' && parseInt(this.value) < avance) {
                    this.value = avance; // Restablecer al valor mínimo solo al salir del input
                }
            });

            // Evitar valores menores en tiempo real sin bloquear la escritura
            inputAvance.addEventListener('input', function() {
                if (this.value !== '' && parseInt(this.value) < avance) {
                    this.style.border = "2px solid red"; // Resaltar el error visualmente
                } else {
                    this.style.border = ""; // Restaurar el borde normal
                }
            });
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
