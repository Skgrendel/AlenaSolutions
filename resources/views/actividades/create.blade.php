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
                                <li class="breadcrumb-item"><a href="">Registro de Actividades</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Nueva Actividad</li>
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
                    <form id="proyectosForm" action="{{ route('actividades.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                        <h5 class="heading  mb-0">Proyecto: {{ $proyecto->nombre }}</h5>
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
                                            placeholder="Ingrese El Nombre de Su Actividad" required
                                            value="{{ old('nombre') }}">
                                        @if ($errors->has('nombre'))
                                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="personal_asignado">Nombre de la persona
                                            Asignada <span class="text-danger">*</span></label>
                                        <input type="text" id="personal_asignado" name="personal_asignado"
                                            class="form-control" placeholder="Ingrese El Nombre de la Persona Asignada"
                                            required
                                            value="{{ Auth::user()->personal->nombres . ' ' . Auth::user()->personal->apellidos }}">
                                        @if ($errors->has('nombre'))
                                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="fecha_estimada">Fecha Estimada de
                                            Finalizacion<span
                                            class="text-danger">*</span></label>
                                        <input type="date" id="fecha_estimada" name="fecha_estimada"
                                            class="form-control mb-2" required value="{{ old('fecha_estimada') }}">
                                        @if ($errors->has('fecha_estimada'))
                                            <span class="text-danger">{{ $errors->first('fecha_estimada') }}</span>
                                        @endif
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
                            <div class="row" id="fechas">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <!-- Fecha y Hora de Inicio -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="fecha_inicio">Fecha y Hora de Inicio</label>
                                                <input type="datetime-local" id="fecha_inicio" name="fecha_inicio"
                                                    class="form-control mb-2"
                                                    value="{{ old('fecha_inicio') }}">
                                                @if ($errors->has('fecha_inicio'))
                                                    <span class="text-danger">{{ $errors->first('fecha_inicio') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Fecha y Hora Final -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="fecha_final">Fecha y Hora Final</label>
                                                <input type="datetime-local" id="fecha_final" name="fecha_final"
                                                    class="form-control mb-2"
                                                    value="{{ old('fecha_final') }}">
                                                @if ($errors->has('fecha_final'))
                                                    <span class="text-danger">{{ $errors->first('fecha_final') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="avance">Avance de Actividad</label>
                                        <input type="number" id="avance" name="avance" class="form-control"
                                            placeholder="Ingrese El Numero de Avance de Su Actividad" min="0"
                                            max="100" required
                                            oninput="this.value = Math.max(0, Math.min(100, this.value));">
                                        @if ($errors->has('avance'))
                                            <span class="text-danger">{{ $errors->first('avance') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label  " for="avance">Porcentace de Avance</label>
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
                                        <label class="form-control-label" for="descripcion">Descripción<span
                                                class="text-danger"> *</span></label>
                                        <textarea type="text" id="descripcion" name="descripcion" class="form-control"
                                            placeholder="Descripcion de actividad" rows="5" required value="">{{ old('descripcion') }}</textarea>
                                        @if ($errors->has('descripcion'))
                                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="descripcion">Observaciones</label>
                                        <textarea type="text" id="observaciones" name="observaciones" class="form-control"
                                            placeholder="Observacion de actividad" rows="5" value="">{{ old('observaciones') }}</textarea>
                                        @if ($errors->has('observaciones'))
                                            <span class="text-danger">{{ $errors->first('observaciones') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="nav" id="input">
                                        <li class="nav-item mr-2">
                                            <label class="input-file-pregunta icon icon-sm icon-shape"
                                                data-toggle="tooltip" title=""
                                                data-original-title="Cargar Evidencias">
                                                <input type="file" class="inputResponseFiles custom-file-input"
                                                    data-id-inputrespuesta="images" id="documentos"
                                                    name="responseFiles[]" aria-describedby="inputResponseFilesimages"
                                                    accept="*" multiple="true" aria-invalid="false" multiple>
                                                <i class="fas fa-upload" aria-hidden="true"></i>
                                            </label>
                                        </li>
                                        <span id="fileError" class="text-danger"></span>
                                        <li class="nav-item">
                                            <a type="button" class="btn btn-success d-none" href="#"
                                                id="buttonId"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr class="my-4">
                            <button type="submit" id="btnCrearActividad" class="btn btn-info mb-2">Crear
                                Actividad</button>
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
            var avance = document.getElementById('avance');

            if (e.target.checked) {
                fecha.disabled = true;
                fecha.value = '';
                fechas.classList.remove('d-none');
                avance.value = 100;
                avance.dispatchEvent(new Event('input'));
            } else {
                fecha.disabled = false;
                fechas.classList.add('d-none');
                fecha_inicio.value = '';
                fecha_final.value = '';
                avance.value = 0;
                avance.dispatchEvent(new Event('input'));
            }
        });
    </script>
    <script>
        document.getElementById('avance').addEventListener('input', function() {
            if (this.value > 100) {
                this.value = 100;
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
    <script>
        document.getElementById('documentos').addEventListener('change', function() {
            var files = this.files;
            var errorElement = document.getElementById('fileError');
            errorElement.textContent = ''; // Borra cualquier mensaje de error anterior
            for (var i = 0; i < files.length; i++) {
                if (files[i].size > 5 * 1024 * 1024) { // 5 MB
                    errorElement.textContent = 'El archivo ' + files[i].name +
                        ' es demasiado grande. No puede ser mayor de 5 MB.';
                    this.value = '';
                    break;
                }
            }

        });
    </script>
    <script>
        // Selecciona el input de archivo y el botón
        var inputFile = document.getElementById('documentos');
        var button = document.getElementById('buttonId'); // Reemplaza 'buttonId' con el id de tu botón

        // Agrega un evento de escucha de cambio al input de archivo
        inputFile.addEventListener('change', function() {
            // Obtiene la cantidad de archivos seleccionados
            var fileCount = this.files.length;

            if (fileCount > 3) {
                button.classList.remove('d-none');
                button.classList.add('btn-danger');
                button.textContent = 'Solo se permiten 3 archivos';
                return;
            } else if (fileCount === 0) {
                button.classList.add('d-none');
            } else {
                // Actualiza el texto del botón con la cantidad de archivos seleccionados
                button.classList.remove('btn-danger');
                button.classList.add('btn-success');
                button.classList.remove('d-none');
                button.textContent = fileCount + ' archivos seleccionados';
            }

        });
    </script>
@endsection
