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
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Nuevo Grupo de Diagnostico</a></li>
                                <li class="breadcrumb-item text-dark active" aria-current="page">Nuevo</li>
                            </ol>
                        </nav>

                    </div>
                    <div class="col-4">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0">
                                <a id="volver" type="button" class="btn btn-transparent py-2 px-3">
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
                    <!-- SmartWizard html -->
                    <form method="POST" id="myForm" action="{{ route('diagnosticos.store') }}">
                        @csrf

                        <input type="text" hidden id="id_diagnostico" name="id_diagnostico" value="{{ $empresa->id }}">
                        <input type="text" hidden id="inputNombreDiagnostico" name="inputNombreDiagnostico">
                        <input type="text" hidden id="inputDescripDiagnostico" name="inputDescripDiagnostico">

                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1">
                                        <div class="num">1</div>
                                        <span>Modulo 1</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2">
                                        <span class="num">2</span>
                                        <span>Modulo 2</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-3">
                                        <span class="num">3</span>
                                        <span>Modulo 3</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-4">
                                        <span class="num">4</span>
                                        <span>Modulo 4</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-5">
                                        <span class="num">5</span>
                                        <span>Modulo 5</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-6">
                                        <span class="num">6</span>
                                        <span>Modulo 6</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-7">
                                        <span class="num">7</span>
                                        <span>Modulo 7</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-8">
                                        <span class="num">8</span>
                                        <span>Modulo 8</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-9">
                                        <span class="num">9</span>
                                        <span>Modulo 9</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-10">
                                        <span class="num">10</span>
                                        <span>Modulo 10</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-11">
                                        <span class="num">11</span>
                                        <span>Modulo 11</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-12">
                                        <span class="num">12</span>
                                        <span>Modulo 12</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#step-13">
                                        <span class="num">13</span>
                                        <span>Modulo 13</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                @for ($i = 1; $i <= 13; $i++)
                                    <div id="step-{{ $i }}" class="tab-pane" role="tabpanel"
                                        aria-labelledby="step-{{ $i }}">
                                        <div id="modulo{{ $i }}" class="tab-pane step-content"
                                            style="display: block;">
                                            <div class="col text-center py-4">
                                                @foreach ($encabezados as $encabezado)
                                                    @if ($encabezado->id == $i)
                                                        <h2 style="color: #525f7f;" class="mb-1">{{ $encabezado->nombre }}</h2>
                                                        <p class="text-uppercase text-muted font-weight-500">Módulo{{ $i }}</p>
                                                        <input type="text" name="grupo{{$i}}" value="{{$i}}" hidden>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @foreach ($mods["mod{$i}"] as $pregunta)
                                                <div class="col-md-12 mb-3 px-2 px-md-4"
                                                    id="contenedorPregunta{{ $pregunta->id }}">
                                                    <div class="card border card-body px-3 px-md-4 shadow-none bg-cuadro"
                                                        id="cardPregunta{{ $pregunta->id }}">
                                                        <div class="form-group fade show my-3 mb-0">
                                                            <div class="pregunta">
                                                                <span
                                                                    class="text-primary opacity-8 display-4 d-inline txtNumeros">{{ $pregunta->id }}
                                                                </span>
                                                                <input type="text" hidden value="{{ $pregunta->id }}" name="preguntas_id{{ $pregunta->id }}">
                                                                <label for="" class="d-inline txtPreguntas">
                                                                    {{ $pregunta->pregunta }}
                                                                </label>
                                                            </div>
                                                            <div class="opcion-respuesta py-3 col-md-3">
                                                                <div
                                                                    class="dropdown bootstrap-select show-tick bg-white form-control">
                                                                    <select
                                                                        class="selectpicker bg-white show-tick form-control"
                                                                        data-container="body"
                                                                        id="tipoDiagnostico{{ $pregunta->id }}"
                                                                        name="cumplimineto{{ $pregunta->id }}"
                                                                        title="Seleccione el Cumplimiento"
                                                                        data-style="btn-neutral font-weight-400"
                                                                        tabindex="-98">
                                                                        <optgroup data-divider="false"
                                                                            label="Cumplimiento">
                                                                            @foreach ($calificaciones as $id => $nombre)
                                                                                <option value="{{ $id }}"
                                                                                    data-content="<span> {{ $nombre }}</span> <small class='text-muted'>">
                                                                                </option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="campo-observaciones input-group input-group-alternative ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-pencil-alt"
                                                                            aria-hidden="true"></i></span>
                                                                </div>
                                                                <textarea id="observaciones{{ $pregunta->id }}" data-id-checkbox="observaciones{{ $pregunta->id }}"
                                                                    name="observaciones{{ $pregunta->id }}" class="form-control form-control-alternative" rows="1"
                                                                    placeholder="Observaciones"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#smartwizard').smartWizard({
                selected: 0, // Initial selected step, 0 = first step
                theme: 'square', // theme for the wizard, related css need to include for other than default theme
                justified: true, // Nav menu justification. true/false
                autoAdjustHeight: true, // Automatically adjust content height
                backButtonSupport: true, // Enable the back button support
                enableUrlHash: true, // Enable selection of the step based on url hash
                toolbar: {
                    position: 'top', // none|top|bottom|both
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    extraHtml: `<button class="btn btn-success btn-sm" onclick="onFinish()">Guardar</button>
                <button class="btn btn-secondary btn-sm " onclick="onCancel()">Cancelar</button>` // Extra html to show on toolbar
                },
                lang: { // Language variables for button
                    next: 'Siguiente',
                    previous: 'Anterior',
                },
            });
        });
    </script>
    <script>
        function onFinish() {
            document.getElementById('myForm').submit();
        }
        function onCancel() {
            $('#smartwizard').smartWizard("reset");
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#volver').on("click", function(e) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2DCE89',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Cancelar!',
                    cancelButtonText: 'No, Quedarme!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('auditorias.index') }}";
                    }
                })
            });
        });
    </script>
    <script>
        var primerGuardadoDiagnostico = function() {
            Swal.mixin({
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'Siguiente',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-neutral',
                },
                progressSteps: ['1', '2']
            }).queue([{
                    input: 'text',
                    title: '¿Como se va a llamar este diagnostico?',
                    text: 'Ejemplo: Diagnostico de noviembre 2019',
                    inputPlaceholder: 'Nombre del diagnostico',
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            if (value === '') {
                                resolve('Necesitamos un nombre para identificar al diagnostico!')
                            } else {
                                resolve()
                            }
                        });
                    }
                },
                {
                    input: 'textarea',
                    title: '¿Cual es el objetivo de este diagnostico?',
                    text: 'Este campo es opcional',
                    inputPlaceholder: 'Objetivo del diagnostico (Opcional)',
                },
            ]).then((result) => {
                if (result.value) {
                    // JSON.stringify(result.value);
                    $("#inputNombreDiagnostico").val(result.value[0]);
                    $("#inputDescripDiagnostico").val(result.value[1]);

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.location.href = "{{ route('auditorias.index') }}";
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            primerGuardadoDiagnostico();
        });
    </script>
@endsection
