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
                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                <div id="modulo1" class="tab-pane step-content" style="display: block;">
                                    <div class="col text-center py-4">
                                        <h2 style="color: #525f7f;" class="mb-1">Ámbito de aplicación del régimen de autocontrol y gestión del riesgo integral LA/FT/FPADM.</h2>
                                        <p class="text-uppercase text-muted font-weight-500">Módulo 1</p>
                                    </div>
                                    <div class="col-md-12 mb-3 px-2 px-md-4" id="contenedorPregunta51">
                                        <div class="card border card-body px-3 px-md-4 shadow-none bg-cuadro"
                                            id="cardPregunta51">
                                            <div class="form-group fade show my-3 mb-0">
                                                <div class="pregunta">
                                                    <span class="text-primary opacity-8 display-4 d-inline txtNumeros">1.
                                                    </span>
                                                    <label for="" class="d-inline txtPreguntas">
                                                        El Sagrlaft de la empresa tuvo en cuenta las 40 recomendaciones del
                                                        GAFI?
                                                    </label>
                                                </div>

                                                <div class="opcion-respuesta py-3 col-md-3">
                                                    <div class="dropdown bootstrap-select show-tick bg-white form-control">
                                                        <select
                                                            class="selectpicker bg-white show-tick form-control" data-container="body"
                                                             id="tipoDiagnostico" name="cumplimineto" title="Seleccione el Cumplimiento"
                                                            data-style="btn-neutral font-weight-400" required="" tabindex="-98">
                                                            <optgroup data-divider="false" label="Cumplimiento">
                                                                <option value="1" data-content="<span> Cumplido.</span> <small class='text-muted'>"></option>
                                                                <option value="1" data-content="<span> Mayoritariamente Cumplido.</span> <small class='text-muted'>"></option>
                                                                <option value="1" data-content="<span> Parcialmente Cumplido.</span> <small class='text-muted'>"></option>
                                                                <option value="1" data-content="<span> No Cumplido.</span> <small class='text-muted'>"></option>
                                                                <option value="1" data-content="<span> No Aplicable.</span> <small class='text-muted'>"></option>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="campo-observaciones input-group input-group-alternative ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-pencil-alt"
                                                                aria-hidden="true"></i></span>
                                                    </div>
                                                    <textarea id="observaciond6d74809a0334ada961d16" data-id-checkbox="checkboxd6d74809a0334ada961d16"
                                                        name="observacionRespuesta1" class="form-control form-control-alternative inputTextRespuesta" rows="1"
                                                        placeholder="Observaciones"></textarea>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                Step content
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                Step content
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4">
                                Step content
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            // SmartWizard initialize
            $('#smartwizard2').smartWizard({
                selected: 0,
                theme: 'round',
                transitionEffect: 'fade',
                showStepURLhash: false,
                toolbarSettings: {
                    toolbarPosition: 'bottom',
                    toolbarButtonPosition: 'end',
                    showNextButton: true,
                    showPreviousButton: true,
                    toolbarExtraButtons: []
                }
            });
        });
    </script>
    <script>
        $(function() {
            // SmartWizard initialize
            $('#smartwizard').smartWizard({
                selected: 13,
                theme: 'square',
                transitionEffect: 'fade',
                showStepURLhash: false,
                toolbarSettings: {
                    toolbarPosition: 'bottom',
                    toolbarButtonPosition: 'end',
                    showNextButton: true,
                    showPreviousButton: true,
                    toolbarExtraButtons: []
                },
                lang: { // Language variables for button
                    next: 'Siguiente',
                    previous: 'Anterior',
                },
            });
        });
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
@endsection
